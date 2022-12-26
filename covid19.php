<?php
include('simple_html_dom.php');


$html = file_get_html('https://www.worldometers.info/coronavirus/countries-where-coronavirus-has-spread/');

$csv = [];

$head = [];

foreach($html->find('thead th') As $h){
    array_push($head, $h->text());
}

$csv[] = $head;

foreach($html->find('#table3 tbody tr') as $val){

   $td = $val->find('td');
    $temp = [];

    for($i= 0; $i<sizeof($td); $i++){
        $text = $td[$i]->text();
        array_push($temp, $text);
    }

    if(sizeof($td)> 0){
        $csv[] = $temp;
    }

}

$file = fopen('data.csv', 'w');

foreach($csv as $line){
    fputcsv($file, $line);
}

fclose($file);


// // Select the elements you want to scrape
// $address = $html->find('.results__name', 0)->plaintext;

// var_dump($address);
// die();



// $addrress_value = explode(' ', $address);


// // Open the CSV file in write mode
// $csv = fopen('address.csv', 'w');

// fputcsv($csv, $addrress_value);

// fclose($csv);

