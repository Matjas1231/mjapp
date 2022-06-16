<?php
namespace App\Repository\Api\Currency;

use App\Models\Currency;
use App\Repository\CurrencyRepositoryInterface;
use GuzzleHttp\Psr7\Request;

class CurrencyRepository implements CurrencyRepositoryInterface
{
    public function __construct(
        private Currency $currencyModel
        )
    {
        $this->currencyModel = $currencyModel;
    }

    public function getAllFiltered(?string $phrase)
    {
        $currency = $this->currencyModel->where('name', 'LIKE', '%' . $phrase . '%')
                                    ->orWhere('currency_code', 'LIKE', '%' . $phrase . '%')
                                    ->simplePaginate(30);
        return $currency;
    }

    public function downloadData()
    {
        $currencyArray = [];
        $ch = curl_init();
        $url = 'http://api.nbp.pl/api/exchangerates/tables/A/?format=json';
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $result = curl_exec($ch);
        curl_close($ch);
        $jsonDecode = json_decode($result, true);

        $currencyArray = array_merge($currencyArray, $jsonDecode[0]['rates']);

        $ch = curl_init();
        $url = 'http://api.nbp.pl/api/exchangerates/tables/B/?format=json';
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $result = curl_exec($ch);
        curl_close($ch);
        $jsonDecode = json_decode($result, true);

        $currencyArray = array_merge($currencyArray, $jsonDecode[0]['rates']);

        foreach ($currencyArray as $js) {
            $currency = $this->currencyModel->where('currency_code', 'LIKE', $js['code'])->first();
            if ($currency) {
                if (!array_key_exists('mid', $js)) {
                    $js['mid'] = $js['bid']/$js['ask'];
                }

                $currency->exchange_rate = $js['mid'];
                $currency->save();
            } else {
                if (!array_key_exists('mid', $js)) {
                    $js['mid'] = ($js['bid']/$js['ask']);
                }

                $currency = $this->currencyModel->newInstance();
                $currency->name = $js['currency'];
                $currency->currency_code = $js['code'];
                $currency->exchange_rate = $js['mid'];
                $currency->save();
            }
        }
    }

    public function getlatest()
    {
        return $this->currencyModel->orderBy('updated_at', 'DESC')->first();
    }
}

