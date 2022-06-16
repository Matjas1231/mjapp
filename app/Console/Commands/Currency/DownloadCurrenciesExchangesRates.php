<?php

namespace App\Console\Commands\Currency;

use App\Repository\CurrencyRepositoryInterface;
use Illuminate\Console\Command;

class DownloadCurrenciesExchangesRates extends Command
{
    public function __construct(
        private CurrencyRepositoryInterface $repository
        )
    {
        $this->currencyRepositoryInterface = $repository;
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:download';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download currencies exchanges rates';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return $this->repository->downloadData();
    }
}
