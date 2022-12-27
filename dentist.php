<?php 
require 'vendor/autoload.php';
use Goutte\Client;
$client = new Client();

$url = "https://www.nhs.uk/service-search/find-a-dentist/location/results/Barking%20and%20Dagenham";
$crawler = $client->request('GET', $url);

ini_set ( 'max_execution_time', -1);

$file = fopen('dentist.csv', 'w');
$site_url = 'https://www.nhs.uk';

$crawler->filter('.nhsuk-list > li')->each(function ($node) {
    
    global $client;
    global $site_url;
    $href = $node->filter('a')->attr('href');
    $parent_urls = $site_url.$href;

    $child_crawler = $client->request('GET', $parent_urls);

    $child_crawler->filter('.results__name')->each(function ($node) {

        global $client;
        global $file;
        global $site_url;
        $child_href = $node->filter('a')->attr('href');
        $child_url = $site_url . $child_href;

        $sub_child_crawler = $client->request('GET', $child_url);

        $sub_child_crawler->filter('.nhsuk-main-wrapper')->each(function ($node) use($file) {

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
    });

});

