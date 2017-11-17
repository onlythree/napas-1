<?php

namespace Omnipay\Napas\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;

class CompletePurchaseResponse extends AbstractResponse
{

    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);
        // For encoded parameters, check the hash
        $validHash = $this->checkHash((array) $data, $request->getVpcSecretKey());
        if (! $validHash) {
            $this->data['vpc_ResponseCode'] = -1;
        }
    }

    public function isTestMode()
    {
        return $this->request->getTestMode();
    }

    public function isSuccessful()
    {
        if ($this->getResponseCode() == 0)
            return true;
        return false;
    }

    public function getMessage()
    {
        $code = $this->getResponseCode();
        switch ($code) {
            case -1: $result = "Thông tin không chính xác"; break;
            case 0 : $result = "Giao dịch thành công"; break;
            case 1 : $result = "Ngân hàng không xác nhận. Tài khoản đã bị khóa hoặc tài khoản đã bị khóa"; break;
            case 3 : $result = "Thẻ đã quá hạn"; break;
            case 4 : $result = "Quá hạn ( Sai mã OTP hoặc quá số lần thanh toán trong ngày )"; break;
            case 5 : $result = "Ngân hàng không phản hồi"; break;
            case 6 : $result = "Bank Communication failure"; break;
            case 7 : $result = "Insufficient fund"; break;
            case 8 : $result = "Invalid checksum"; break;
            case 9 : $result = "Transaction type not support"; break;
            case 10 : $result = "Other error"; break;
            case 11 : $result = "Verify card is successful"; break;
            case 12 : $result = "Your payment is unsuccessful. Transaction exceeds amount limit."; break;
            case 13 : $result = "You have been not registered online payment services. Please
contact your bank."; break;
            case 14 : $result = "Invalid OTP (One time password)"; break;
            case 15 : $result = "Invalid static password"; break;
            case 16 : $result = "Incorrect Cardholder's name"; break;
            case 17 : $result = "Incorrect card number"; break;
            case 18 : $result = "Date of validity is incorrect (issue date)"; break;
            case 19 : $result = "Date of validity is incorrect (expiration date) "; break;
            case 20 : $result = "Unsuccessful transaction"; break;
            case 21 : $result = "OTP (One time password) time out"; break;
            case 22 : $result = "Unsuccessful transaction"; break;
            case 22 : $result = "Unsuccessful transaction"; break;
            case 23 : $result = "Your payment is not approved. Your card/account is ineligible for
payment"; break;
            case 24 : $result = "Your payment is unsuccessful. Transaction exceeds amount limit"; break;
            case 25 : $result = "Transaction exceeds amount limit."; break;
            case 26 : $result = "Transactions awaiting confirmation from the bank"; break;
            case 27 : $result = "You have entered wrong authentication information"; break;
            case 28 : $result = "Your payment is unsuccessful. Transaction exceeds time limit"; break;
            case 29 : $result = "Transaction failed. Please contact your bank for information."; break;
            case 30 : $result = "Your payment is unsuccessful. Amount is less than minimum limit."; break;
            case 31 : $result = "Orders not found. Support for query api."; break;
            case 32 : $result = "Orders not to make payments. Support for query api. "; break;
            case 32 : $result = "Orders not to make payments. Support for query api. "; break;
            case 33 : $result = "Duplicate orders. Support for query api. "; break;

            default  : $result = "Lỗi không xác định";
        }

        return $result;
    }

    public function getResponseCode()
    {
        if (isset($this->data['vpc_ResponseCode'])) {
            return (int) $this->data['vpc_ResponseCode'];
        }

        return null;
    }

    private function checkHash($data, $secretKey)
    {
        $md5HashData = $secretKey;
        $vpc_Txn_Secure_Hash = $data["vpc_SecureHash"];
        ksort ($data);
        // sort all the incoming vpc response fields and leave out any with no value
        foreach($data as $key => $value) {
            if ($key != "vpc_SecureHash") {
                $md5HashData .= $value;
            }
        }

        if (strtoupper($vpc_Txn_Secure_Hash) == strtoupper(md5($md5HashData))) {
            return true;
        }
        return false;
    }
}
