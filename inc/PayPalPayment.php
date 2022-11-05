<?php
// 1. Autoload the SDK Package. This will include all the files and classes to your autoloader
// Used for composer based installation
require __DIR__  . '../../vendor/autoload.php';
// Use below for direct download installation
// require __DIR__  . '/PayPal-PHP-SDK/autoload.php';

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;



class PayPalPayment
{
    private $apiContext;
    private $secret;
    private $clientId;

    public function __construct()
    {
        // if (config("paypal.settings.mode") == "live") {
        //     $this->clientId = config("paypal.live_client_id");
        //     $this->secret = config("paypal.live_client_id");
        // } else {
        $this->clientId = "AQLbvWr1l9YJLcKUw85r909zfGwyY4ylAskzYmhitJwM9xAemIaO-LeEDlmtFF-iroP2wyyy3-u9cvpZ";
        $this->secret = "ENr3qN1MGH5nVRWNQ8fkr1RjNko_upirlBQa45tQB4LrDxq8GC7Ec1tjjqxn-B2xw_S8NWUUafWvbdJL";
        // }


        $this->apiContext = new ApiContext(new OAuthTokenCredential($this->clientId, $this->secret));

        $conf = ["settings" => [
            "mode" => 'sandbox',
            "http.ConnectionTimeOut" => 3000,
            "log.logEnabled" => true,
            "log.FileName" => 'paypal.log',
            "log.loglevel" => 'DEBUG'

        ]];


        $this->apiContext->setConfig($conf);
    }

    public function payWithPaypal()
    {
        $name = 'name';
        $price = 150;
        // return $name . ' costs ' . $price;
        // set payer

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");


        $item = new Item();
        $item->setName($name)
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setDescription("Buying From Kemobyte Shop item dsecription")
            ->setPrice($price);

        $itemList = new ItemList();
        $itemList->setItems(array($item));

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($price);


        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Buying From Kemobyte Shop");


        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("http://localhost:8000/status")
            ->setCancelUrl("http://localhost:8000/canceled");

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
        echo 'first<br/>';

        try {
            $payment->create($this->apiContext);
            echo 'second';
            // echo $payment;
            // echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";

            header('location: ' . $payment->getApprovalLink());
            exit();
            // var_dump(header('location : ' .  $payment->getApprovalLink()));
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // dd($ex);
            var_dump($ex);
        }

        $approvalUrl = $payment->getApprovalLink();

        // return redirect($approvalUrl);
        // return 'done';
        header('location : ' . $approvalUrl);
    }
    public function status(Request $request)
    {
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            die('Payment Failed');
        }

        $paymentid = $request->get('paymentId');
        $payment = Payment::get($paymentid, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerid($request->input('PayerID'));
        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() == 'approved') {
            return 'Thank you . Payment Completed Successfully !';
        }

        echo "Payment Failed";
        die($result);
    }
    public function canceled()
    {
        return 'payment canceled';
    }
}
$pay = new PayPalPayment();


$pay->payWithPaypal();
