<?php

namespace SonarSoftware\CustomerPortalFramework\Models;

use Inacho\CreditCard as CreditCardValidator;
use InvalidArgumentException;

class CreditCard
{
    private $name;
    private $number;
    private $expiration_month;
    private $expiration_year;

    /**
     * CreditCardPayment constructor.
     * @param $values
     */
    public function __construct($values)
    {
        $this->validateInput($values);
        $this->storeInput($values);
    }

    /**
     * Get the name on the card.
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the credit card number.
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Get the expiration month.
     * @return mixed
     */
    public function getExpirationMonth()
    {
        return $this->expiration_month;
    }

    /**
     * Get the expiration year.
     * @return mixed
     */
    public function getExpirationYear()
    {
        return $this->expiration_year;
    }

    /**
     * Validate the input to the constructor.
     * @param $values
     * @throws InvalidArgumentException
     */
    private function validateInput($values)
    {
        if (!array_key_exists("name",$values))
        {
            throw new InvalidArgumentException("You must supply a name.");
        }

        if (!array_key_exists("number",$values))
        {
            throw new InvalidArgumentException("You must supply a credit card number.");
        }

        if (!array_key_exists("expiration_month",$values))
        {
            throw new InvalidArgumentException("You must supply an expiration month");
        }

        if (!array_key_exists("expiration_year",$values))
        {
            throw new InvalidArgumentException("You must supply an expiration year.");
        }

        $card = CreditCardValidator::validCreditCard($values['number']);
        if ($card['valid'] !== true)
        {
            throw new InvalidArgumentException("The credit card number is not valid.");
        }

        $month = sprintf("%02d", $values['expiration_month']);
        if (strlen($values['expiration_year']) !== 4)
        {
            throw new InvalidArgumentException("You must input a 4 digit year.");
        }

        if (!CreditCardValidator::validDate($values['expiration_year'], $month))
        {
            throw new InvalidArgumentException("Expiration date is not valid.");
        }
    }

    /**
     * Store the input to private vars
     * @param $values
     */
    private function storeInput($values)
    {
        $this->name = trim($values['name']);
        $this->number = trim(str_replace(" ","",$values['number']));
        $this->expiration_month = sprintf("%02d", $values['expiration_month']);
        $this->expiration_year = trim($values['expiration_year']);
    }
}