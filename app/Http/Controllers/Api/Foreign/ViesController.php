<?php

namespace App\Http\Controllers\Api\Foreign;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SoapClient;

class ViesController extends Controller
{

    public function index(Request $request)
    {
        $companyData = [];

        if ($request->query()) {
            $data = $request->query();
            $companyData = $this->sendData($data);

            if (isset($companyData['status'])  && !$companyData['status']) {
                return redirect()
                    ->route('vies.index')
                    ->with('error', $companyData['message']);
            }

            if ($companyData['valid'] == 'false') {
                return redirect()
                    ->route('vies.index')
                    ->with('error', 'Błędny NIP - firma nie istnieje');
            }
        }

        $countryCodes = [
            'AT' => 'Austria',
            'BE' => 'Belgia',
            'BG' => 'Bułgaria',
            'CY' => 'Cypr',
            'CZ' => 'Czechy',
            'DE' => 'Niemcy',
            'DK' => 'Dania',
            'EE' => 'Estonia',
            'EL' => 'Grecja',
            'ES' => 'Hiszpania',
            'FI' => 'Finlandia',
            'FR' => 'Francja',
            'HR' => 'Chorwacja',
            'HU' => 'Węgry',
            'IE' => 'Irlandia',
            'IT' => 'Włochy',
            'LT' => 'Litwa',
            'LU' => 'Luksemburg',
            'LV' => 'Łotwa',
            'MT' => 'Malta',
            'NL' => 'Holandia',
            'PL' => 'Polska',
            'PT' => 'Portugalia',
            'RO' => 'Rumunia',
            'SE' => 'Szwecja',
            'SI' => 'Słowenia',
            'SK' => 'Słowacja',
            'XI' => 'Irlandii Północnej',
        ];

        return view('api.vies.index', [
            'companyData' => $companyData,
            'countryCodes' => $countryCodes
        ]);
    }

    private function sendData(array $data)
    {
        $xmlData ='
        <soapenv:Envelope
            xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
            xmlns:urn="urn:ec.europa.eu:taxud:vies:services:checkVat:types">
            <soapenv:Header/>
            <soapenv:Body>
                <urn:checkVat>
                    <urn:countryCode>' . $data['country_code'] . '</urn:countryCode>
                    <urn:vatNumber>' . $data['nip'] . '</urn:vatNumber>
                </urn:checkVat>
            </soapenv:Body>
        </soapenv:Envelope>
        ';
        $url = 'https://ec.europa.eu/taxation_customs/vies/services/checkVatService';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: text/xml']);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $xmlData);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);

        if (strpos($output, 'INVALID_INPUT')) return [
            'status' => false,
            'message' => 'Błędny format'
        ];

        if (strpos($output, 'IP_BLOCKED')) return [
            'status' => false,
            'message' => 'IP zablokowane'
        ];

        // NIP
        preg_match('~<vatNumber>([^{]*)</vatNumber>~i', $output, $match);
        $nip = $match[1];

        // Kod kraju
        preg_match('~<countryCode>([^{]*)</countryCode>~i', $output, $match);
        $countryCode = $match[1];

        // Czy NIP jest prawdziwy
        preg_match('~<valid>([^{]*)</valid>~i', $output, $match);
        $valid = $match[1];

        // Nazwa firmy
        preg_match('~<name>([^{]*)</name>~i', $output, $match);
        $companyName = $match[1];

        // Adres firmy
        preg_match('~<address>([^{]*)</address>~i', $output, $match);
        $companyAddress = $match[1];
        str_replace('\r\n', '',$companyAddress);

        return [
            'nip' => $nip,
            'countryCode' => $countryCode,
            'valid' => $valid,
            'companyName' => $companyName,
            'companyAddress' => $companyAddress,
        ];
    }
}
