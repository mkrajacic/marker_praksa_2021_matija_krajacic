<?php
include_once("connection.php");

$eurusd_url = "https://api.hnb.hr/tecajn/v1?valuta=EUR&valuta=USD";
$eurusd_json = file_get_contents($eurusd_url);
$eurusd_array = json_decode($eurusd_json, true);

$variables = array('broj_tecajnice', 'datum_primjene', 'drzava', 'sifra_valute', 'valuta', 'jedinica', 'kupovni_devize', 'srednji_devize', 'prodajni_devize');
$fields = array('Broj tečajnice', 'Datum primjene', 'Država', 'Šifra valute', 'Valuta', 'Jedinica', 'Kupovni za devize', 'Srednji za devize', 'Prodajni za devize');

$currencies_count = sizeof($eurusd_array);

for ($i = 0; $i < $currencies_count; $i++) {
    $var_count = 0;
    foreach ($variables as $var) {
        echo "<b>" . $fields[$var_count] . ": </b>" . $eurusd_array[$i][$fields[$var_count]] . "<br>";
        $var_count++;
    }
    echo "<br>";
}

$errors = array();

for ($i = 0; $i < $currencies_count; $i++) {
    $broj_tecajnice = $eurusd_array[$i]["Broj tečajnice"];
    $datum_primjene = DateTime::createFromFormat('d.m.Y', $eurusd_array[$i]["Datum primjene"]);
    $datum_primjene = $datum_primjene->format('Y-m-d');
    $drzava = $eurusd_array[$i]["Država"];
    $sifra_valute = $eurusd_array[$i]["Šifra valute"];
    $valuta = $eurusd_array[$i]["Valuta"];
    $jedinica = $eurusd_array[$i]["Jedinica"];
    $kupovni_devize = (double)doubleval($eurusd_array[$i]["Kupovni za devize"]);
    $srednji_devize = doubleval((double)$eurusd_array[$i]["Srednji za devize"]);
    $prodajni_devize = (double)$eurusd_array[$i]["Prodajni za devize"];

    $new_currency = $connection->prepare("INSERT into valuta (broj_tecajnice,datum_primjene,drzava,sifra_valute,valuta,jedinica,kupovni_devize,srednji_devize,prodajni_devize) VALUES (?,?,?,?,?,?,?,?,?)");
    $new_currency->bind_param('issisiddd', $broj_tecajnice,$datum_primjene,$drzava,$sifra_valute,$valuta,$jedinica,$kupovni_devize,$srednji_devize,$prodajni_devize);

    $pass=1;
    if ($new_currency->execute()) {
        $pass = 1;
    }else {
        array_push($errors,printf($new_currency->error));
        $pass=0;
    }

    if(sizeof($errors)>0) {
        foreach ($errors as $err) {
            echo $err . "<br>";
        }
    }
    
}
