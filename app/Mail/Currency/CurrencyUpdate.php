<?php

namespace App\Mail\Currency;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CurrencyUpdate extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        private array $lastCurrency,
    ) {
        $this->lastCurrency = $lastCurrency;

        $this->subject('Zaktualizowano waluty z NBP');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('api.currency.mail.updated')
                ->with([
                    'name' => $this->lastCurrency['name'],
                    'currency_code' => $this->lastCurrency['currency_code'],
                    'updated_at' => $this->lastCurrency['updated_at'],
                ]);
    }
}
