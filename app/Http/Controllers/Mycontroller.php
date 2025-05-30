<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ContactExport;
use Maatwebsite\Excel\Facades\Excel;

class Mycontroller extends Controller
{
    public function export() 
    {
        return Excel::download(new ContactExport, 'conatct.xlsx');
    }
}
