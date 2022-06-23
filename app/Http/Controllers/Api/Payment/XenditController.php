<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Xendit\Xendit;

class XenditController extends Controller
{
    private $token = "xnd_development_IJ7psD7QfHsAgwoWlwikb46EIYefKQFJ6l6DE4MDdVdw31zykR7FRyIzJjXHZgV";

    public function getVaList(){
        Xendit::setApiKey($this->token);
        $getVABanks = \Xendit\VirtualAccounts::getVABanks();
        // dd($getVABanks);
        return response()->json([
            "data" => $getVABanks
        ])->setStatusCode(200);
    }

    public function createVa(){
        Xendit::setApiKey($this->token);
        $params = [
            "external_id" => \uniqid(),
            "bank_code" => "MANDIRI",
            "name" => "Kempot"
        ];

        $createVA = \Xendit\VirtualAccounts::create($params);

        return response()->json([
            "data" => $createVA
        ])->setStatusCode(200);
    }
}
