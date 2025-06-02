<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employer;

class EmployerController extends Controller
{
    public function index()
    {
        $employers = Employer::with(['kyc', 'bankDetail'])->get();
        return view('admin.employers.index', compact('employers'));
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
