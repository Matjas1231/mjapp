<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ComputerResource;
use App\Models\Computer;
use App\Repository\ComputerRepositoryInterface;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    public function __construct(
        private ComputerRepositoryInterface $computerRepository
    )
    {
        $this->computerRepository = $computerRepository;
    }

    public function index(Request $request)
    {
        $paramsMap = [
            'ipAddress' => 'ipaddress',
            'networkName' => 'networkname'
        ];

        $params = $request->query();

        foreach ($params as $key => $param) {
            if (array_key_exists($key, $paramsMap)) {
                $params[$paramsMap[$key]] = $params[$key];
                unset($params[$key]);
            }
        }
        // dd($params);
        return ComputerResource::collection($this->computerRepository->searchComputer($params));
        return ComputerResource::collection($this->computerRepository->all());
    }
}
