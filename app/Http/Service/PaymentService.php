<?php


namespace App\Http\Service;


use App\Transaction;
use App\User;
use Carbon\Traits\Date;

class PaymentService{

    public function initHireRequestPayment($request) {
        $user = User::find($request['user_id']);
        if ($user != null) {
            $noOfDrivers = sizeof($request['driver_id']);

            if ($noOfDrivers % 2 == 0) {
                $amount = $this->getRequestAmount($request);
                $reference = $this->generateTransaction($amount, $user->email);
                if ($reference['status'] == true) {
                    $transactionData = $reference['data'];
                    $this->createTransaction($transactionData['reference']);
                    return [
                        'reference' => $transactionData['reference'],
                        'amount' => $amount
                    ];
                }else return null;
            }else return null;
        }return null;
    }

    public function getRequestAmount($request) {
        $noOfDrivers = sizeof($request['driver_id']) / 2;

        if ($request['type'] == 'full_term') {
            return $this->getLongTermFee() * $noOfDrivers;
        }else {
            $dateDifference = $request['end_date']->diff($request['start_date']);
            $days = $dateDifference->format('%a') * 1;
            return $days * $this->getShortTermFee() * $noOfDrivers;
        }
    }

    public function getShortTermFee() {
        return 7000;
    }

    public function getLongTermFee() {
        return 2000;
    }

    public  function generateTransaction($amount, $email) {
        $url = "https://api.paystack.co/transaction/initialize";
        $fields = [
            'email' => $email,
            'amount' => $amount * 100,
        ];
        $fields_string = http_build_query($fields);
        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer ".env('PAYSTACK_SECRET_KEY'),
            "Cache-Control: no-cache",
        ));

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

        //execute post

        return json_decode(curl_exec($ch), true);
    }

    public function createTransaction($reference) {
        $transaction = Transaction::make(['reference' => $reference]);
        $transaction->save();
    }

    public function validateTransaction($reference) {
        $transaction = Transaction::whereReference($reference)->first();
        if ($transaction != null) {
            if (!$transaction->used) return true;
        }

        return false;
    }

    public function getTransactionDetails($reference) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/".$reference,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".env('PAYSTACK_SECRET_KEY'),
                "Cache-Control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            return false;
        } else {
            return json_decode($response, true);
        }
    }

    public function updateTransaction($reference, bool $status) {
        $transaction = Transaction::whereReference($reference)->first();
        $transaction->status = $status ? 'success' : 'failed';
        $transaction->save();
    }
}
