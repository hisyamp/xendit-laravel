<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Xendit\Xendit;
use Carbon\Carbon;

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

    public function createVa(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        // dd(Carbon::now()->addDays(1));
        Xendit::setApiKey($this->token);
        $params = [
            "external_id" => \uniqid(),
            "bank_code" => $request->bank,
            "name" => $request->nama,
            "expected_amount" => 50000,
            "is_closed" => true,
            "expiration_date" => Carbon::now()->addDays(1),
            "is_single_use" => true
        ];

        $createVA = \Xendit\VirtualAccounts::create($params);

        return response()->json([
            "status" => "success",
            "data" => $createVA
        ])->setStatusCode(200);
    }

    public function createQr(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        // dd(Carbon::now()->addDays(1));
        Xendit::setApiKey($this->token);
        $params = [
            "external_id" => \uniqid(),
            "type" => "DINAMIC",
            "expected_amount" => 50000,
            // "callback_url" => ,
            "expiration_date" => Carbon::now()->addDays(1),
            "is_single_use" => true
        ];

        $createVA = \Xendit\QRCode::create($params);

        return response()->json([
            "status" => "success",
            "data" => $createVA
        ])->setStatusCode(200);
    }
}
