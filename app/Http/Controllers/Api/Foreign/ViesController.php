<?php

namespace App\Http\Controllers\Api\Foreign;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViesController extends Controller
{

    public function index(Request $request)
    {
        $companyData = [];

        if ($request->query()) {
            $data = $request->query();
            $companyData = $this->sendData($data);

            if (!$companyData['status']) {
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

        return view('vies.index', [
            'companyData' => $companyData,
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
        $url = "https://ec.europa.eu/taxation_customs/vies/services/checkVatService";

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

        // $countryCodeToCheck = 'pl';
        // $nipToCheck = '8721002039';


}
