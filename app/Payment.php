<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoapClient;

class Payment extends Model
{
    protected $fillable = ['Authority','Status','RefID','order_id'];

    protected $MerchantID;
    protected $Amount;
    protected $Description;
    protected $CallbackURL;
    public function __construct($amount=null, $orderId = null)
    {
        $this->MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX'; //Required
        $this->Amount = $amount; //Amount will be based on Toman - Required
        $this->Description = 'توضیحات تراکنش تستی'; // Required
        $this->CallbackURL = 'http://digistyle.test:10/payment-verify/'.$orderId; // Required
    }

    public function doPayment()
    {
        $client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $client->PaymentRequest(
            [
                'MerchantID' => $this->MerchantID,
                'Amount' => $this->Amount,
                'Description' => $this->Description,
                'CallbackURL' => $this->CallbackURL,
            ]
        );
        return $result;
    }

    public function verifyPayment($Authority,$Status)
    {
        if ($Status == 'OK') {

            $client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

            $result = $client->PaymentVerification(
                [
                    'MerchantID' => $this->MerchantID,
                    'Authority' => $Authority,
                    'Amount' => $this->Amount,
                ]
            );
            return $result;
        }
        else
        {
            return false;
        }
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
