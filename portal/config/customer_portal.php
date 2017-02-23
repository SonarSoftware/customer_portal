<?php
return [
    /**
     * BASIC CONFIGURATION OPTIONS
     * YOU SHOULD NOT EDIT THESE PARAMETERS HERE! Copy the .env.example file to .env and edit them there. Changing them here will cause them to be overwritten if you ever upgrade!
     */

    /*
     * Company name to be presented to users (will be shown in the title, for example)
     */
    'company_name' => env('ISP_NAME','ISP'),

    /*
     * What character should be used to separate decimals (e.g. 100.34)
     */
    'decimal_separator' => env('DECIMAL_SEPARATOR,','.'),

    /*
     * What character should be used to separate thousands (e.g. 1,000,000)
     */
    'thousands_separator' => env('THOUSANDS_SEPARATOR',','),

    /*
     * What currency symbol do you use (e.g. $, £, ¥)
     */
    'currency_symbol' => env('CURRENCY_SYMBOL','$'),

    /**
     * The country your ISP operates in
     */
    'country' => env('COUNTRY','US'),

    /**
     * The state or province your ISP operates in. Should be a two character code for the US and Canada (e.g. WI, AB) and the full name for other countries.
     */
    'state' => env('STATE','WI'),

    /**
     * BILLING CONFIGURATION OPTIONS
     */

    /**
     * Do you want to show detailed transactions or just invoices?
     */
    'show_detailed_transactions' => env('SHOW_DETAILED_TRANSACTIONS',false),

    /*
     * If you wish to allow PayPal payments via the portal, set this to true
     */
    'paypal_enabled' => env('PAYPAL_ENABLED',false),

    /*
     * If paypal_enabled is true, these must both be set to valid, live, REST API credentials. These can be
     * generated at https://developer.paypal.com under 'My Apps and Credentials' by clicking 'Create App'.
     * Be sure to create LIVE credentials and not SANDBOX!
     */
    'paypal_api_client_id' => env('PAYPAL_API_CLIENT_ID','foo'),
    'paypal_api_client_secret' => env('PAYPAL_API_CLIENT_SECRET','bar'),

    /*
     * You must input a valid currency code to use for PayPal from https://developer.paypal.com/docs/classic/api/currency_codes/
     * A sane default (USD) is provided, but ensure this is updated if you are not using US dollars.
     */
    'paypal_currency_code' => env('PAYPAL_CURRENCY_CODE','USD'),

    /**
     * TICKETING OPTIONS
     */

    /*
     * If you wish to allow users to open tickets, and respond to their public tickets, then set this to true
     */
    'ticketing_enabled' => env('TICKETING_ENABLED',false),

    /*
     * If ticketing is enabled, you must set the ID of an inbound email account here that will be used to create new tickets
     */
    'inbound_email_account_id' => env('INBOUND_EMAIL_ACCOUNT_ID',null),

    /*
     * Which ticket group ID should tickets created via the portal be assigned to?
     */
    'ticket_group_id' => env('TICKET_GROUP_ID',null),

    /*
     * Which user ID should tickets created via the portal be assigned to? Tickets must be assigned to either a ticket_group_id or a user_id, or both
     */
    'ticket_user_id' => env('TICKET_USER_ID',1),

    /*
     * What priority should tickets be created at? 4 is low, 3 is medium, 2 is high, 1 is critical.
     */
    'ticket_priority' => env('TICKET_PRIORITY',4),

    /**
     * EMAIL CONFIGURATION
     */

    /*
     * What address do you want outbound emails to be sent from?
     */
    'from_address' => env('FROM_ADDRESS','donotreply@isp-portal.net'),

    /*
     * What name should outbound emails be sent from?
     */
    'from_name' => env('FROM_NAME','ISP'),

    /**
     * DATA USAGE
     */
    'data_usage_enabled' => env('DATA_USAGE_ENABLED',true),
    'top_off_requires_immediate_payment' => env('TOP_OFF_REQUIRES_IMMEDIATE_PAYMENT',true),

    /**
     * CONTRACTS
     */
    'contracts_enabled' => env('CONTRACTS_ENABLED',false),
];