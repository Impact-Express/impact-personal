<?php

namespace App\Services\PayPal;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

class PayPalClient
{
    /**
     * Returns PayPal HTTP client instance with environment that has access credentials context.
     * Use this instance to invoke PayPal APIs, provided the credentials have access.
     */
    public static function client() {
        return new PayPalHttpClient(self::environment());
    }

    /**
     * Set up and return PayPal PHP SDK environment with PayPal access credentials.
     * This for development use SandboxEnvironment. In production, use LiveEnvironment.
     */
    protected static function environment() {

        /**
         * TODO: Add to .env and add logic to select function based on environment
         */
        $clientId = config('app.paypal_sandbox_client_id');
        $clientSecret = config('app.paypal_sandbox_client_secret');

        return new SandboxEnvironment($clientId, $clientSecret);
    }
}