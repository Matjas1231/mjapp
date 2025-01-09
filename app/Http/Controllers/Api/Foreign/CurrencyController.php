<?php

namespace App\Http\Controllers\Api\Foreign;

use App\Http\Controllers\Controller;
use App\Repository\CurrencyRepositoryInterface;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function __construct(
        private CurrencyRepositoryInterface $currencyRepositoryInterface
        )
    {
        $this->currencyRepositoryInterface = $currencyRepositoryInterface;
    }

    public function index(Request $request)
    {
        $request->flash();

        if ($request->query('phrase')) {
            $validatedData = $request->validate([
                'phrase' => 'string|nullable'
            ]);
        }
        $phrase = $validatedData['phrase'] ?? null;

        $allCurrency = $this->currencyRepositoryInterface->getAllFiltered($phrase);
        return view('api.currency.index', [
            'allCurrency' => $allCurrency,
        ]);
    }

    public function downloadData()
    {
        $this->currencyRepositoryInterface->downloadData();
        return redirect()
            ->route('currency.index')
            ->with('success', 'Pobrano najnowsze kursy walut');
    }
}
