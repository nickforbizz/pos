<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use Iankumu\Mpesa\Facades\Mpesa;
use Illuminate\Http\Request;

use App\Mpesa\STKPush;
use App\Models\MpesaSTK;
use Carbon\Carbon;

class MpesaSTKPUSHController extends Controller
{
    public $result_code = 1;
    public $result_desc = 'An error occured';

    // Initiate  Stk Push Request
    public function STKPush(Request $request)
    {

        $amount = $request->input('amount');
        $phoneno = $request->input('phonenumber'); 
        $account_number = $request->input('account_number');

        $response = Mpesa::stkpush($phoneno, $amount, $account_number);
        
        /** @var \Illuminate\Http\Client\Response $response */
        $result = $response->json(); 

        MpesaSTK::create([
            'merchant_request_id' =>  $result['MerchantRequestID'],
            'checkout_request_id' =>  $result['CheckoutRequestID']
        ]);

        return $result;
    }

    // This function is used to review the response from Safaricom once a transaction is complete
    public function STKConfirm(Request $request)
    {
        $stk_push_confirm = (new STKPush())->confirm($request);

        if ($stk_push_confirm) {

            $this->result_code = 0;
            $this->result_desc = 'Success';
        }
        return response()->json([
            'ResultCode' => $this->result_code,
            'ResultDesc' => $this->result_desc
        ]);
    }


    function generateAccessToken() {
        $consumer_key = env('MPESA_CONSUMER_KEY');
        $consumer_secret = env('MPESA_CONSUMER_SECRET');
        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Basic ' . base64_encode($consumer_key.':'.$consumer_secret) ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $access_token = json_decode($response);

        return $access_token->access_token;
    }

    public function initiateSTKPush()  {
        $amount = 1;
        $phoneno = "254708374149";
        $timestamp = Carbon::rawParse('now')->format('YmdHms');
        $password = base64_encode(env('BusinessShortCode').env('PassKey').$timestamp);

        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ACCESS_TOKEN'));
        $payload = array(
                "BusinessShortCode"=> env('BusinessShortCode'),    
                "Password"=> $password,    
                "Timestamp"=> $timestamp,    
                "TransactionType"=> "CustomerPayBillOnline",    
                "Amount"=> $amount,    
                "PartyA"=> $phoneno,    
                "PartyB"=> env('PartyB'),    
                "PhoneNumber"=> $phoneno,    
                "CallBackURL"=> "https://mydomain.com/pat",    
                "AccountReference"=>"Test",    
                "TransactionDesc"=>"Test"
        );
        $data_str = json_encode($payload);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_str);

        $response = curl_exec($ch);
        return $response;
    }


    
}
