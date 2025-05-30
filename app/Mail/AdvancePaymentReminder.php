<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class AdvancePaymentReminder extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The employee instance
     *
     * @var object
     */
    public $employee;

    /**
     * The payment link
     *
     * @var string
     */
    public $paymentLink;

    /**
     * The employee instance
     *
     * @var object
     */
    public $tax;

    /**
     * Create a new message instance.
     *
     * @param object $employee
     * @param string $paymentLink
     * @return void
     */
    public function __construct($employee, $paymentLink, $tax)
    {
        $this->employee = $employee;
        $this->paymentLink = $paymentLink;
        $this->tax = $tax;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->getLocalizedSubject())
            ->view('emails.advance_payment_reminder')
            ->with([
                'employee' => $this->employee,
                'paymentLink' => $this->paymentLink,
                'tax' => $this->tax
            ]);
    }

    /**
     * Get localized subject line
     *
     * @return string
     */
    protected function getLocalizedSubject()
    {
        return App::isLocale('es') 
            ? '🔴 Urgente: Pago de adelanto de salario pendiente'
            : '🔴 Urgent: Advance Salary Payment Due';
    }
}