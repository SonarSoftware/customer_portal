<?php

namespace App\Billing;

class GoCardless
{
    private $client;
    public function __construct()
    {
        $this->client = new \GoCardlessPro\Client([
            'access_token' => getenv('GOCARDLESS_ACCESS_TOKEN'),
            'environment' => getenv('GOCARDLESS_ENVIRONMENT'),
        ]);
    }

    /**
     *
     */
    public function createRedirect()
    {
        $redirecttFlow = $this->client->redirectFlows()->create([
            'params' => [
                'description' => '',
                'session_token' => '', //TODO: create
                'success_redirect_url' => '',
                'prefilled_customer' => [
                    'given_name' => '',
                    'family_name' => '',
                    'email' => '',
                    'address_line1' => '',
                    'city' => '',
                    'postal_code' => '',
                ]
            ]
        ]);

        //Keep $redirectFlow->id and redirect to $redirectFlow->redirect_url
    }

    public function handleRedirect($id)
    {
        $redirectFlow = $this->client->redirectFlows()->complete(
            $id,
            [
                "params" => [
                    "session_token" => "", //TODO: retrieve
                ]
            ]
        );

        //Keep $redirectFlow->links->mandate, and $redirectFlow->links->customer ?
        //confirmation URL is $redirectFlow->confirmation_url
    }
}