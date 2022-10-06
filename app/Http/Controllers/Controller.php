<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function prepareDataFromAjax(array $dataToClean) {
        $result = [];

        foreach($dataToClean as $key => $value) {
            if ($value != 'null') $result[$key] = $value;
            else $result[$key] = null;
        }

        return $result;
    }
}
