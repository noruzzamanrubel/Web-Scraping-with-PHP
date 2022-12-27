<?php 
require 'vendor/autoload.php';
use Goutte\Client;
$client = new Client();


$url = "https://www.nhs.uk/services/dentist/ilford-lane-family-dental-surgery/XV212376";
$crawler = $client->request('GET', $url);


$file = fopen('test.csv', 'w');

$crawler->filter('.nhsuk-main-wrapper')->each(function ($node) use($file) {
    $name = '';
    $address = '';
    $phone = '';
    try{
        $name = $node->filter('.nhsuk-caption-xl')->text();
        $name = str_replace('-', ' ', $name);   
        $address = $node->filter('#address_panel_address')->text();
        $phone = $node->filter('#contact_info_panel_phone_text')->text();
    } catch(Exception $e) { 

    }

    fputcsv($file, [$name, $address, $phone]);
    
});