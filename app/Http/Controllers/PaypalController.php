<?php
    namespace App\Http\Controllers;

    use App\Http\Requests;
    use PayPal\Api\Amount;
    use PayPal\Api\Details;
    use PayPal\Api\Item;
    use PayPal\Api\ItemList;
    use PayPal\Api\Payer;
    use PayPal\Api\Payment;
    use PayPal\Api\RedirectUrls;
    use PayPal\Api\Transaction;
    use PayPal\Api\PaymentExecution;
    use PayPal\Api\ExecutePayment;
    use Session;
    use PayPal\Api\Currency;
    use PayPal\Auth\OAuthTokenCredential;
    use PayPal\Rest\ApiContext;
    class PaypalController extends Controller
    {

        private $apiContext;
        public function __construct()
        {
            $this->apiContext = new ApiContext(
                new OAuthTokenCredential(
                    config('paypal.client_id'),
                    config('paypal.secret')
                )
            );
            $this->apiContext->setConfig(config('paypal.settings'));
        }
        //public function simplePay()
        //{
        //     $payouts = new \PayPal\Api\Payout();
        //     $senderBatchHeader = new \PayPal\Api\PayoutSenderBatchHeader();
        //     $senderBatchHeader->setSenderBatchId(uniqid())->setEmailSubject("You have a Payout!");
        //     $senderItem = new \PayPal\Api\PayoutItem();
        //     $senderItem->setRecipientType('Email')->setNote('Thanks for your patronage!')->setReceiver('testmimi@gmail.com')->setSenderItemId("001")->setAmount(new \PayPal\Api\Currency('{
        //                             "value":"1.00",
        //                             "currency":"USD"
        //                         }'));
        //     $payouts->setSenderBatchHeader($senderBatchHeader)->addItem($senderItem);
        //     $request = clone $payouts;
        //     try {
        //         $output = $payouts->create(array('sync_mode' => 'false'),$this->apiContext);
        //     } catch (\Exception $ex) {
        //         //  \ResultPrinter::printError("Created Single Synchronous Payout", "Payout", null, $request, $ex);
        //         dd($ex);
        //         exit(1);
                
        //     }
        //     // \ResultPrinter::printResult("Created Single Synchronous Payout", "Payout", $output->getBatchHeader()->getPayoutBatchId(), $request, $output);
        //     return $output;
        // }


        public function simplePay()
        {
            $money = $_POST['money'];
            $type = $_POST['type'];
            $arr = array('value' => $money, 'currency' => $type);
            $temp = json_encode($arr);
            $payouts = new \PayPal\Api\Payout();
            $senderBatchHeader = new \PayPal\Api\PayoutSenderBatchHeader();
            $senderBatchHeader->setSenderBatchId(uniqid())->setEmailSubject("You have a Payout!");
            $senderItem = new \PayPal\Api\PayoutItem();
            $senderItem->setRecipientType('Email')->setNote('Thanks for your patronage!')
            ->setReceiver('dieumy97@gmail.com')->setSenderItemId("001")
            ->setAmount(new \PayPal\Api\Currency($temp));
            $payouts->setSenderBatchHeader($senderBatchHeader)->addItem($senderItem);
            $request = clone $payouts;
            try {
                $output = $payouts->create(array('sync_mode' => 'false'),$this->apiContext);
            } catch (\Exception $ex) {
                //ResultPrinter::printError("Created Single Synchronous Payout", "Payout", null, $request, $ex);
                dd($ex);
                exit(1);
            }
            //ResultPrinter::printResult("Created Single Synchronous Payout", "Payout", $output->getBatchHeader()->getPayoutBatchId(), $request, $output);
            return $output;
        }
    }