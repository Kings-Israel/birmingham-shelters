<?php

namespace App;

use Braintree;

class PaymentGateway
{
    protected Braintree\Gateway $braintree;

    public function __construct()
    {
        $this->braintree = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key'),
        ]);
    }

    public function getClientToken(): string
    {
        return $this->braintree->ClientToken()->generate();
    }

    public function charge(array $details)
    {
        return $this->braintree->transaction()
        ->sale([
            'amount' => $details['amount'],
            'paymentMethodNonce' => $details['nonce'],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
    }
}
