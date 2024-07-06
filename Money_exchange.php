<?php
declare(strict_types=1); 

class Money_exchenge{
    public string $kiritlgan_malumot;
    public string $usd_kurs;

    public function __construct($KIRITLGAN_MAALUMOT,$USD_KURS)
    {
        $this -> kiritlgan_malumot = $KIRITLGAN_MAALUMOT;
        $this -> usd_kurs = $USD_KURS;
    }
    public function Exchange(){
        $usd = $this->kiritlgan_malumot / $this->usd_kurs;
        return "<div class='alert alert-success'>after the exchange   " . number_format($usd, 4) . "</div>";
   
}
}