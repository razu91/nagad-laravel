# Laravel Nagad Payment Gateway Package [BD]

# Installation

```bash
composer require razu1991/nagad-laravel
```

# Setup

## 1 ) vendor publish (config)

```bash
php artisan vendor:publish --provider="Razu\Nagad\NagadServiceProvider" --tag=config
```

## 2 ) Config setup

- `config/nagad.php`

````php
<?php

return [
    'sandbox_mode' => env('NAGAD_MODE', 'sandbox'),
    'merchant_id' => env('NAGAD_MERCHANT_ID','683002007104225'),
    'merchant_number' => env('NAGAD_MERCHANT_NUMBER','01711428036'),
    'callback_url' => env('NAGAD_CALLBACK_URL', 'http://127.0.0.1:8000/nagad/callback'),
    'public_key' => env('NAGAD_PUBLIC_KEY',''),
    'private_key' => env('NAGAD_PRIVATE_KEY','')
];

# env setup

```bash
NAGAD_MERCHANT_ID=683002007104225
NAGAD_MERCHANT_NUMBER=01711428036
NAGAD_CALLBACK_URL=http://127.0.0.1:8000/nagad/callback
NAGAD_MODE=sandbox // sandbox or live
NAGAD_PUBLIC_KEY="" //sandbox <optional>
NAGAD_PRIVATE_KEY=""  // sandbox <optional>
```
# Usage

## get callback url

```php
<?php
use NagadPaymentGateway;

$redirectUrl = NagadPaymentGateway::tnxID($id)
             ->amount($amount)
             ->getRedirectUrl();
return $redirectUrl;
```
````

## IPN (Instant Payment Notification) // verify payment

```php
<?php
use NagadPaymentGateway;

$verify = (object) NagadPaymentGateway::ipn();
if($verify->status === 'Success'){
    $order = json_decode($verify->additionalMerchantInfo);
    $order_id = $order->tnx_id;
    // your functional task with order_id
}
if ($verify->status === 'Aborted') {
    dd($verify);
    // redirect or other what you want
}
dd($verify);

```

# Note:

`~Sandbox`

- Need a merchant account.
- Register a Nagad number and need sandbox balance (contact with nagad)

`~ Live`

- Need a merchant account (live server)
- Contact with Nagad and provide your live server ip address.

# Any query

- shahnaouzrazu21@gmail.com
