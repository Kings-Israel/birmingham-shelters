<?php

namespace App;

use Braintree;
use Braintree\Error\ErrorCollection;

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

    public function retrieveErrors(ErrorCollection $errors): string
    {
        return collect($errors)
                ->map(fn($error) => "Error {$error->code}: {$error->message}")
                ->implode('\n');
    }

    public function charge(array $details)
    {
        $options = ['submitForSettlement' => true];

        return $this->braintree->transaction()
                ->sale(
                    array_merge($details, ['options' => $options])
                );
    }
}
