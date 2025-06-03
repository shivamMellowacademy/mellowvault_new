<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employer;

use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\exportEmployers;


class EmployerController extends Controller
{
    public function index()
    {
        $employers = Employer::with(['kyc', 'bankDetail'])->get();
        return view('admin.employers.index', compact('employers'));
    }

    public function exportEmployers()
    {
        $payout = Employer::with(['kyc', 'bankDetail'])->get();

        return Excel::download(new exportEmployers($payout), 'employers.xlsx');
    }

    public function toggleStatus($id)
    {
        $user = Employer::findOrFail($id);
        $user->status = !$user->status;
        $user->save();

        $url = env('URL').'/api/employer-status?email='.$user->email;
        $response = Http::withoutVerifying()->get($url);




        return redirect()->back()->with('success', 'Employer status updated successfully.');
    }

}
