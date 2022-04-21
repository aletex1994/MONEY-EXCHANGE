<?php

class MoneyEx{

    private $valori;

    private function __construct(){}

    public static function now($moneta){
        $risultato=new static();
        $url = "https://freecurrencyapi.net/api/v2/latest?apikey=3d5afcd0-839c-11ec-870a-dbfb92cfaeb6&base_currency=$moneta";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $risultato->valori = curl_exec($ch);
        curl_close($ch);
        return $risultato;
    }

    public static function fromDateToNow($moneta,$dataPartenza){
        $today=date("Y-m-d"); 
        $risultato=new static();
        $url = "https://freecurrencyapi.net/api/v2/historical?apikey=3d5afcd0-839c-11ec-870a-dbfb92cfaeb6&base_currency=$moneta&date_from=$dataPartenza&date_to=$today";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $risultato->valori = curl_exec($ch);
        curl_close($ch);
        return $risultato;

    }

    public static function fromDateToDate($moneta,$dataArrivo,$dataPartenza){
        $risultato=new static();
        $url = "https://freecurrencyapi.net/api/v2/historical?apikey=3d5afcd0-839c-11ec-870a-dbfb92cfaeb6&base_currency=$moneta&date_from=$dataPartenza&date_to=$dataArrivo";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $risultato->valori = curl_exec($ch);
        curl_close($ch);
        return $risultato;

    }



    public function decodificaRisultato($valuta){

        $json = $this->valori;
        $obj = json_decode($json,true);
        return $obj['data'][$valuta];
        
    }

    public function stampaFileJson(){
        return $this->valori;
    }

}


$val="EUR";
$cambio="USD";
$dataOK="2022-01-01";

$try2 = MoneyEx::now($val);

echo $try2->decodificaRisultato($cambio);



?>