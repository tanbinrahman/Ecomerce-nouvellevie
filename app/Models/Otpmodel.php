<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SMSClient;
class Otpmodel extends Model
{
    use HasFactory;

    public static function sendCode($phone){

        // dd($phone);
        $doc_user_otp_code=rand(111111,999999);
        require_once(__DIR__."/SMSClient.php");
        $message = "Your registration code is. $doc_user_otp_code ";
        $recipient="880".(int) $phone;       // For SINGLE_SMS or OTP
        $requestType = 'SINGLE_SMS';    // options available: "SINGLE_SMS", "OTP"
        $messageType = 'TEXT';
        $client = new SMSClient("61421514", "YxgBOG80A", "http://www.sms4bd.net");
        $response = $client->SendSMS("nouvellevie", $recipient,
        $doc_user_otp_code, date('d:m:Y'), SMSType::Standard);
        return $doc_user_otp_code;
    }
}
