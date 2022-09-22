<?php

namespace App\Http\Controllers\Api\Foreign;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeeplController extends Controller
{
    public function index()
    {
        return view('api.deepl.index');
    }

    public function translate(Request $request)
    {
        if ($request->ajax()) {
            return response()->json([
                'translatedText' => $this->getTranslate($request['dataToTranslation'], 'EN')
            ]);
        }
    }

    private function getTranslate($phrase, $targetLang, $parameters = [])
    {
        return 'CURL jest gotowy, na razie brak tłumaczrń z racji braku podpiętej karty kredytowej';

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://api-free.deepl.com/v2/translate');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $phrase);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Authorization: DeepL-Auth-Key',
			'Content-Type: application/x-www-form-urlencoded'
		]);
		$json_str = curl_exec($ch);
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);

		$result = json_decode($json_str, false);

		if (isset($result->message)) return $result->message;

		if (isset($result->translations)) return $result->translations[0]->text;

		exit;
    }
}
