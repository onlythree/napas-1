<?php

namespace Omnipay\Napas\Message;

use Omnipay\Common\CreditCard;
use Omnipay\Common\Item;
use Omnipay\Common\Message\AbstractRequest;
use Symfony\Component\HttpFoundation\Response;

/**
 * Napas Purchase Request
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * @var array
     */
    protected $endpoints = array(
        // 'authorize' => 'https://secure.payu.com.tr/order/alu/v3',
        'purchase' => 'https://payment.napas.com.vn/gateway/vpcpay.do',
        'sandbox' => 'https://sandbox.napas.com.vn/gateway/vpcpay.do',
    );

    /**
     * vpc_Version
     */
    public function getVpcVersion()
    {
        return $this->getParameter('vpc_Version');
    }
    public function setVpcVersion($value)
    {
        return $this->setParameter('vpc_Version', $value);
    }

    /**
     * vpc_Command
     */
    public function getVpcCommand()
    {
        return $this->getParameter('vpc_Command');
    }
    public function setVpcCommand($value)
    {
        return $this->setParameter('vpc_Command', $value);
    }

    /**
     * vpc_AccessCode
     */
    public function getVpcAccessCode()
    {
        return $this->getParameter('vpc_AccessCode');
    }
    public function setVpcAccessCode($value)
    {
        return $this->setParameter('vpc_AccessCode', $value);
    }

    /**
     * vpc_MerchTxnRef
     */
    public function getVpcMerchTxnRef()
    {
        return $this->getParameter('vpc_MerchTxnRef');
    }
    public function setVpcMerchTxnRef($value)
    {
        return $this->setParameter('vpc_MerchTxnRef', $value);
    }

    /**
     * vpc_Merchant
     */
    public function getVpcMerchant()
    {
        return $this->getParameter('vpc_Merchant');
    }
    public function setVpcMerchant($value)
    {
        return $this->setParameter('vpc_Merchant', $value);
    }

    /**
     * vpc_OrderInfo
     */
    public function getVpcOrderInfo()
    {
        return $this->getParameter('vpc_OrderInfo');
    }
    public function setVpcOrderInfo($value)
    {
        return $this->setParameter('vpc_OrderInfo', $value);
    }

    /**
     * vpc_Amount
     */
    public function getVpcAmount()
    {
        return $this->getParameter('vpc_Amount');
    }
    public function setVpcAmount($value)
    {
        return $this->setParameter('vpc_Amount', $value);
    }

    /**
     * vpc_ReturnURL
     */
    public function getVpcReturnURL()
    {
        return $this->getParameter('vpc_ReturnURL');
    }
    public function setVpcReturnURL($value)
    {
        return $this->setParameter('vpc_ReturnURL', $value);
    }

    /**
     * vpc_BackURL
     */
    public function getVpcBackURL()
    {
        return $this->getParameter('vpc_BackURL');
    }
    public function setVpcBackURL($value)
    {
        return $this->setParameter('vpc_BackURL', $value);
    }

    /**
     * vpc_Locale
     */
    public function getVpcLocale()
    {
        return $this->getParameter('vpc_Locale');
    }
    public function setVpcLocale($value)
    {
        return $this->setParameter('vpc_Locale', $value);
    }

    /**
     * vpc_Currency
     */
    public function getVpcCurrency()
    {
        return $this->getParameter('vpc_Currency');
    }
    public function setVpcCurrency($value)
    {
        return $this->setParameter('vpc_Currency', $value);
    }

    /**
     * vpc_TicketNo
     */
    public function getVpcTicketNo()
    {
        return $this->getParameter('vpc_TicketNo');
    }
    public function setVpcTicketNo($value)
    {
        return $this->setParameter('vpc_TicketNo', $value);
    }

    /**
     * vpc_PaymentGateway
     */
    public function getVpcPaymentGateway()
    {
        return $this->getParameter('vpc_PaymentGateway');
    }
    public function setVpcPaymentGateway($value)
    {
        return $this->setParameter('vpc_PaymentGateway', $value);
    }

    /**
     * vpc_CardType
     */
    public function getVpcCardType()
    {
        return $this->getParameter('vpc_CardType');
    }
    public function setVpcCardType($value)
    {
        return $this->setParameter('vpc_CardType', $value);
    }

    /**
     * Secret key
     */
    public function getVpcSecretKey()
    {
        return $this->getParameter('vpc_SecretKey');
    }
    public function setVpcSecretKey($value)
    {
        return $this->setParameter('vpc_SecretKey', $value);
    }

    /**
     * @param $endpoint
     * @return mixed
     */
    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->endpoints['sandbox'] : $this->endpoints['purchase'];
    }


    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidCreditCardException
     */
    public function getData()
    {
        $data = array();

        $vpc_Version = $this->getVpcVersion();
        if ($vpc_Version)
            $data['vpc_Version'] = $vpc_Version;

        $vpc_Command =  $this->getVpcCommand();
        if ($vpc_Command)
            $data['vpc_Command'] = $vpc_Command;

        $vpc_AccessCode = $this->getVpcAccessCode();
        if ($vpc_AccessCode)
            $data['vpc_AccessCode'] = $vpc_AccessCode;

        $vpc_MerchTxnRef = $this->getVpcMerchTxnRef();
        if ($vpc_MerchTxnRef)
            $data['vpc_MerchTxnRef'] = $vpc_MerchTxnRef;

        $vpc_Merchant = $this->getVpcMerchant();
        if ($vpc_Merchant)
            $data['vpc_Merchant'] = $vpc_Merchant;

        $vpc_OrderInfo = $this->getVpcOrderInfo();
        if ($vpc_OrderInfo)
            $data['vpc_OrderInfo'] = $vpc_OrderInfo;

        $vpc_Amount = $this->getVpcAmount();
        if ($vpc_Amount)
            $data['vpc_Amount'] = $vpc_Amount;
        
        $vpc_ReturnURL = $this->getVpcReturnURL();
        if ($vpc_ReturnURL)
            $data['vpc_ReturnURL'] = $vpc_ReturnURL;

        $vpc_BackURL = $this->getVpcBackURL();
        if ($vpc_BackURL)
            $data['vpc_BackURL'] = $vpc_BackURL;

        $vpc_Currency = $this->getVpcCurrency();
        if ($vpc_Currency)
            $data['vpc_Currency'] = $vpc_Currency;

        $vpc_TicketNo = $this->getVpcTicketNo();
        if ($vpc_TicketNo)
            $data['vpc_TicketNo'] = $vpc_TicketNo;

        $vpc_PaymentGateway = $this->getVpcPaymentGateway();
        if ($vpc_PaymentGateway)
            $data['vpc_PaymentGateway'] = $vpc_PaymentGateway;

        $vpc_CardType = $this->getVpcCardType();
        if ($vpc_CardType)
            $data['vpc_CardType'] = $vpc_CardType;
        
        $vpc_Locale = $this->getVpcLocale();
        if ($vpc_Locale)
            $data['vpc_Locale'] = $vpc_Locale;

        // Product Details
        /*
        $items = $this->getItems();
        if( !empty($items)){
            foreach ($this->getItems() as $key => $item) {
                $data['ORDER_PNAME[' . $key . ']'] = $item->getName();
                $data['ORDER_PCODE[' . $key . ']'] = $item->getName();
                $data['ORDER_PINFO[' . $key . ']'] = $item->getName();
                $data['ORDER_PRICE[' . $key . ']'] = $item->getPrice();
                $data['ORDER_VAT[' . $key . ']'] = $this->getOrderVat();
                $data['ORDER_PRICE_TYPE[' . $key . ']'] = $this->getParameter('orderPriceType'); // todo : cana sor
                $data['ORDER_QTY[' . $key . ']'] = $item->getQuantity();
            }
        }*/

        $data["vpc_SecureHash"] = $this->generateHash($data);
        return $data;
    }

    /**
     * @param $data
     * @return Response
     */
    protected function createResponse($data)
    {
        return $this->response = new Response($this, $data);
    }
    /**
     * @param $data
     * @return PurchaseResponse
     */
    public function sendData($data)
    {
        return new PurchaseResponse($this,$data);
    }

    public function generateHash($data)
    {
        $md5HashData = $this->getVpcSecretKey();
        ksort($data);
        foreach ($data as $key => $val) {
            if (strlen($val) > 0) {
                $md5HashData .= $val;
            }
        }
        return strtoupper(md5($md5HashData));
    }
}
