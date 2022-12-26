<?php 
require 'vendor/autoload.php';
use Goutte\Client;
$client = new Client();


$url = "https://www.nhs.uk/service-search/find-a-dentist/results/Barking?latitude=51.538171889055995&longitude=0.07892426510177879";
$crawler = $client->request('GET', $url);

$file = fopen('data.csv', 'w');

$crawler->filter('.nhsuk-grid-column-two-thirds')->each(function ($node) use($file) {
    $name = $node->filter('.results__name a')->text();
    $address = $node->filter('div>:nth-child(3)')->text();
    $phone = $node->filter('div>:nth-child(4)')->text();
    fputcsv($file, [$name, $address, $phone]);
});

// $crawler = $client->request('GET', 'https://www.nhs.uk/service-search/find-a-dentist/location/results/Barnet');

// $link = $crawler->filter('.nhsuk-list li a')->attr('href');

// $select_link = $crawler->selectLink($link)->links();

// // var_dump($select_link);

// $res = $client->click($select_link);
// echo $res;


// // ​$h1 = $crawler->filter("h1")->text();

// // echo($h1."\n");
