<?php 
require 'vendor/autoload.php';
use Goutte\Client;
$client = new Client();


$url = "https://www.nhs.uk/service-search/find-a-dentist/location/results/Barking%20and%20Dagenham";
$crawler = $client->request('GET', $url);


$crawler->filter('.nhsuk-list > li')->each(function ($node) {
    $href = $node->filter('a')->attr('href');
    $site_url = 'https://www.nhs.uk';
    $link = $site_url.$href;
    var_dump($link .'<br>');
});

