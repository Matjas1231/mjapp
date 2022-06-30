<?php

namespace App\Observers;

use App\Mail\Currency\CurrencyFirstDownload;
use App\Mail\Currency\CurrencyUpdate;
use App\Models\Currency;
use Illuminate\Support\Facades\Mail;

class CurrencyObserver
{
    /**
     * Handle the Currency "created" event.
     *
     * @param  \App\Models\Currency  $currency
     * @return void
     */
    public function created(Currency $currency)
    {
        //
    }

    /**
     * Handle the Currency "updated" event.
     *
     * @param  \App\Models\Currency  $currency
     * @return void
     */
    public function updated(Currency $currency)
    {
        $lastCurrency = $currency->all(['name', 'currency_code','updated_at'])->sortByDesc('updated_at')->first();
        $lastCurrency = $lastCurrency->toArray();

        $lastCurrency['updated_at'] = date('Y-m-d H:i:s', strtotime($lastCurrency['updated_at']));

        Mail::to(env('MAIL_FROM_ADDRESS'))
            ->send(new CurrencyUpdate($lastCurrency));
    }

    /**
     * Handle the Currency "deleted" event.
     *
     * @param  \App\Models\Currency  $currency
     * @return void
     */
    public function deleted(Currency $currency)
    {
        //
    }

    /**
     * Handle the Currency "restored" event.
     *
     * @param  \App\Models\Currency  $currency
     * @return void
     */
    public function restored(Currency $currency)
    {
        //
    }

    /**
     * Handle the Currency "force deleted" event.
     *
     * @param  \App\Models\Currency  $currency
     * @return void
     */
    public function forceDeleted(Currency $currency)
    {
        //
    }
}
