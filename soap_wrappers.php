<?php
if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) return;

if (class_exists("Weenx_GiftPay_Soap_Wrapper"))
    return;
class Weenx_GiftPay_Soap_Wrapper
{
    protected $senderId;
    protected $plainId;
    protected $encryptId;
    protected $url = WEENX_WC_GATEWAY_GIFT_PAY_DEFAULT_URL;


    public function __construct(string $senderId, string $plainId, string $encryptId, string $url = null)
    {

        $this->senderId = $senderId;
        $this->plainId = $plainId;
        $this->encryptId = $encryptId;
        if ($url) {
            $this->url = $url;
        }
    }

    public function payment($id, $amount, $callback, $language = 'english', $currency = 3)
    {
        $params = array(
            'SenderId' => $this->senderId,
            'PlainId' => $this->plainId,
            'EncryptId' => $this->encryptId,
            'ReservationNumber' => $id,
            'Language' => $this->language($language),
            'Currency' => $currency,
            'Amount' => $amount,
            'CallbackURL' => $callback
        );
        $client = $this->connect();
        $result = $client->GoPayPaymentRequest($params)->PaymentRequestResult;
        return $result;
    }

    public function verify($token)
    {
        $client = $this->connect();
        $params = array(
            'result' => $token,
            'SenderId' => $this->senderId,
            'PlainId' => $this->plainId,
            'EncryptId' => $this->encryptId,
        );

        return $client->PaymentVerify($params)->PaymentVerifyResult;
    }

    protected function connect()
    {
        return new SoapClient($this->url, array('encoding' => 'utf-8'));
    }

    protected function language($language)
    {
        return [
            'farsi' => 0,
            'english' => 1,
            'arabic' => 2,
            'german' => 3,
        ][$language];
    }
}


class Weenx_GoPay_Soap_Wrapper extends Weenx_GiftPay_Soap_Wrapper
{
    protected $url = WEENX_WC_GATEWAY_GO_PAY_DEFAULT_URL;


    public function payment($id, $amount, $callback, $language = 'english', $currency = 3)
    {
        $params = array(
            'SenderId' => $this->senderId,
            'PlainId' => $this->plainId,
            'EncryptId' => $this->encryptId,
            'ReservationNumber' => $id,
            'Currency' => $currency,
            'Amount' => $amount,
            'CallbackURL' => $callback
        );
        $client = $this->connect();
        $result = $client->GoPayPaymentRequest($params)->GoPayPaymentRequestResult;
        return $result;
    }

    public function verify($token)
    {
        $client = $this->connect();
        $params = array(
            'result' => $token,
            'SenderId' => $this->senderId,
            'PlainId' => $this->plainId,
            'EncryptId' => $this->encryptId,
        );

        return $client->GoPayPaymentVerify($params)->GoPayPaymentVerifyResult;
    }
}
