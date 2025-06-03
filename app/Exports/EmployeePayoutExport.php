<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EmployeePayoutExport implements FromView
{
    protected $payout;

    public function __construct($payout)
    {
        $this->payout = $payout;
    }

    public function view(): View
    {
        return view('admin.exports.employee_payout', [
            'payout' => $this->payout
        ]);
    }
}
