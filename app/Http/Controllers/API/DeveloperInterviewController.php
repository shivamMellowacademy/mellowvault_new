<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeveloperOrder;
use App\Models\DeveloperInterviewSchedule;
use App\Services\GoogleCalendarService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class DeveloperInterviewController extends Controller
{
    public function scheduleInterview(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'interviewdateone' => 'required|date',
            'from_time' => 'required',
            'to_time' => 'required',
        ]);

        $developerOrder = DeveloperOrder::where('dev_id', $request->developerId)->first();

        if (!$developerOrder) {
            return response()->json(['message' => 'Developer not found'], 404);
        }

        $calendar = new GoogleCalendarService();
        $meetLink = $calendar->createInterviewEvent(
            $request->name,
            $request->email,
            $request->interviewdateone
        );

        // Create interview schedule
        DeveloperInterviewSchedule::create([
            'dev_id' => $developerId,
            'u_id' => $developerOrder->u_id,
            'fname' => $request->name,
            'lname' => $developerOrder->lname,
            'phone' => $developerOrder->phone,
            'email' => $request->email,
            'perhr' => $developerOrder->perhr,
            'code' => $developerOrder->code,
            'address_one' => $developerOrder->address_one,
            'language' => $developerOrder->language ?? '',
            'interviewdateone' => $request->interviewdateone,
            'interviewdatetwo' => $request->from_time,
            'interviewdatethree' => $request->to_time,
            'from_time' => $request->from_time,
            'to_time' => $request->to_time,
            'meet_link' => $meetLink,
            'interviewlink' => $meetLink,
            'schinterviewdatetime' => now(),
            'status' => 'Scheduled',
            'approve_status' => 'Pending',
        ]);

        $developerOrder->update([
            'interviewdateone' => $request->interviewdateone,
            'interviewdatetwo' => $request->from_time,
            'interviewdatethree' => $request->to_time,
            'interviewlink' => $meetLink,
        ]);

        $htmlContent = "
            <h2>Interview Scheduled</h2>
            <p><strong>Candidate:</strong> {$request->name}</p>
            <p><strong>Email:</strong> {$request->email}</p>
            <p><strong>Date:</strong> {$request->interviewdateone}</p>
            <p><strong>Time:</strong> {$request->from_time} - {$request->to_time}</p>
            <p><strong>Google Meet Link:</strong> <a href='{$meetLink}'>{$meetLink}</a></p>
            <br><p>Thanks,</p>
        ";

        $recipients = [
            'admin@email.com',
            $developerOrder->email,
            $request->email,
        ];

        foreach ($recipients as $to) {
            if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
                Log::warning("Invalid email skipped: " . json_encode($to));
                continue;
            }

            Mail::html($htmlContent, function ($message) use ($to) {
                $message->to($to)->subject('Interview Scheduled');
            });
        }

        return response()->json([
            'success' => true,
            'message' => 'Interview scheduled successfully and emails sent.',
            'meet_link' => $meetLink,
        ]);
    }

    public function InterviewFeedback(Request $request)
    {
        $request->validate([
            'employer_id' => 'required|integer',
            'developer_id' => 'required|integer',
            'status' => 'required|string',
            'review' => 'required|string',
        ]);

        $u_id = $request->employer_id;
        $dev_id = $request->developer_id;

        // Fetch developer order using Eloquent
        $order = DeveloperOrder::where('dev_id', $dev_id)->first();

        if (!$order) {
            return response()->json([
                'message' => 'Developer order not found.',
                'status' => false,
            ], 404);
        }

        // Prepare data for interview schedule
        $data = [
            'dev_id' => $dev_id,
            'fname' => $order->fname,
            'lname' => $order->lname,
            'phone' => $order->phone,
            'email' => $order->email,
            'perhr' => $order->perhr,
            'code' => $order->code,
            'address_one' => $order->address_one,
            'status' => $request->status,
            'review' => $request->review,
        ];

        // Update or insert in DeveloperInterviewSchedule
        $interview = DeveloperInterviewSchedule::updateOrCreate(
            ['dev_id' => $dev_id],
            $data
        );

        // Update DeveloperOrder with feedback info
        $order->update([
            'status' => $request->status,
            'review' => $request->review,
        ]);

        return response()->json([
            'message' => 'Interview feedback processed successfully.',
            'status' => true,
            'data' => $interview,
        ]);
    }


}
