<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DeveloperDetialExcel implements FromView
{
    protected $payout;

    public function __construct($payout)
    {
        $this->payout = $payout;
    }

    public function view(): View
    {
        return view('admin.exports.developer_detial', [
            'payout' => $this->payout
        ]);
    }
}
