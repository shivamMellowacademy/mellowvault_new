<?php

namespace App\Exports;

use App\Models\contact_tb;
use Maatwebsite\Excel\Concerns\FromCollection;

class ContactExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return contact_tb::all();
    }
}
