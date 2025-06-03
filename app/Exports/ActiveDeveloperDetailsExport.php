<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ActiveDeveloperDetailsExport implements FromView
{
    protected $developers;

    public function __construct($developers)
    {
        $this->developers = $developers;
    }

    public function view(): View
    {
        return view('admin.exports.developer_details', [
            'developers' => $this->developers
        ]);
    }
}
