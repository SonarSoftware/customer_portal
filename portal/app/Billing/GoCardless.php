<?php

namespace App\Billing;

use App\GoCardlessToken;
use Illuminate\Support\Facades\Redirect;

class GoCardless
{
    private $client;
    public function __construct()
    {
        $this->client = new \GoCardlessPro\Client([
            'access_token' => config("customer_portal.gocardless_access_token"),
            'environment' => config("customer_portal.gocardless_environment"),
        ]);
    }

    /**
     * Setup the redirect flow
     */
    public function createRedirect()
    {
        $token = str_random(32);
        while (GoCardlessToken::where('token','=',$token)->count() > 0)
        {
            $token = str_random(32);
        }
        $gocardlessToken = new GoCardlessToken([
            'token' => $token,
            'account_id' => get_user()->account_id
        ]);

        $params = [
            'params' => [
                'description' => config("customer_portal.company_name"),
                'session_token' => $gocardlessToken->token,
                'success_redirect_url' => action("GoCardlessController@handleReturnRedirect"),
            ]
        ];

        $redirectFlow = $this->client->redirectFlows()->create($params);

        $gocardlessToken->redirect_flow_id = $redirectFlow->id;
        $gocardlessToken->save();

        return $redirectFlow->redirect_url;
    }

    /**
     * @param GoCardlessToken $goCardlessToken
     * @throws \GoCardlessPro\Core\Exception\InvalidStateException
     */
    public function completeRedirect(GoCardlessToken $goCardlessToken)
    {
        $completedFlow = $this->client->redirectFlows()->complete(
            $goCardlessToken->redirect_flow_id,
            [
                "params" => [
                    "session_token" => $goCardlessToken->token
                ]
            ]
        );

        //Store $completedFlow->links->mandate for later use
        return $completedFlow->confirmation_url;
    }
}