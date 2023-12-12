<?php

namespace App;


class MSG91 {



    function __construct() {



    }

    private $API_KEY = '223758APRHg1EMKR5b39f7a8';
    private $SENDER_ID = "GIKSIN";

    private $ROUTE_NO = 4;

    private $RESPONSE_TYPE = 'json';



    public function sendSMS($mobileNumber, $message){

        $isError = 0;

        $errorMessage = true;

        //Preparing post parameters

        $postData = array(

            'authkey' => $this->API_KEY,

            'mobiles' => $mobileNumber,

            'message' => $message,

            'sender' => $this->SENDER_ID,

            'route' => $this->ROUTE_NO,

            'response' => $this->RESPONSE_TYPE

        );

     

        $url = "https://control.msg91.com/sendhttp.php";

     

        $ch = curl_init();

        curl_setopt_array($ch, array(

            CURLOPT_URL => $url,

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_POST => true,

            CURLOPT_POSTFIELDS => $postData

        ));

     

     

        //Ignore SSL certificate verification

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

     

     

        //get response

        $output = curl_exec($ch);

     

        //Print error if any

        if (curl_errno($ch)) {

            $isError = true;

            $errorMessage = curl_error($ch);

        }

        curl_close($ch);

        if($isError){

            return array('error' => 1 , 'message' => $errorMessage);

        }else{

            return array('error' => 0 );

        }

    }

    

    public function sendDltSms($flowID, $mobileNumber, $action, $var) {

        $curl = curl_init();

        $string = "";

        if ($action === 'OTP') { // for OTP

            $string = "\"otp\": \"$var[0]\"\n";

        }

        if ($action === 'FORGOT') { // for Forgot Password

            $string = "\"token\": \"$var[0]\"\n";

        }

        

        if ($action === 'UP') { // for username & password

            $string = "\"username\": \"$var[0]\",\n  \"password\": \"$var[1]\"\n";

        }

        

        if ($action === 'COM') { // for complaint_id

            $string = "\"complaint_id\": \"$var[0]\"\n";

        }

        

        if ($action === 'ADMIN') { // for admin creation (role, mobile, password)

            $string = "\"user\": \"$var[0]\",\n  \"mobile\": \"$var[1]\",\n  \"password\": \"$var[2]\"\n";

        }

        if ($action === 'ESCALATION') {
            // Customize the parameters for escalation action
            $string = "\"role\": \"$var[0]\",\n  \"date\": \"$var[1]\",\n  \"initiated\": \"$var[2]\",\n  \"allocated\": \"$var[3]\"\n";
        }


        curl_setopt_array($curl, [

            CURLOPT_URL => "https://api.msg91.com/api/v5/flow/",

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_ENCODING => "",

            CURLOPT_MAXREDIRS => 10,

            CURLOPT_TIMEOUT => 30,

            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

            CURLOPT_CUSTOMREQUEST => "POST",

            CURLOPT_POSTFIELDS => "{\n  \"flow_id\": \"$flowID\",\n  \"sender\": \"$this->SENDER_ID\",\n  \"mobiles\": \"$mobileNumber\",\n $string }",

            CURLOPT_HTTPHEADER => [

                "authkey: $this->API_KEY",

                "content-type: application/JSON"

            ],

        ]);

        

        $response = curl_exec($curl);

        $err = curl_error($curl);

        

        curl_close($curl);

        

        if ($err) {

            echo "cURL Error #:" . $err;

        } else {

            echo $response;

        }

    }

}

?>