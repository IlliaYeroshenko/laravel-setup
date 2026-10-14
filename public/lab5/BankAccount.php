<?php

require_once "AccountInterface.php";

class BankAccount implements AccountInterface
{
    const MIN_BALANCE = 0;

    protected $balance = 0;

    protected $currency;

    public function __construct($currency)
    {
        $this->currency = $currency;
    }

    public function deposit($amount)
    {
        if ($amount < 0) {
            throw new Exception("Сума поповнення не може бути від'ємною");
        }

        $this->balance = $this->balance + $amount;

        return $this->balance;
    }

    public function withdraw($amount)
    {
        if ($amount < 0) {
            throw new Exception("Сума зняття не може бути від'ємною");
        }

        if ($this->balance - $amount < self::MIN_BALANCE) {
            throw new Exception("Недостатньо коштів");
        }

        $this->balance = $this->balance - $amount;

        return $this->balance;
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function getCurrency()
    {
        return $this->currency;
    }
}

?>
