<?php
include('simple_html_dom.php');


$html = file_get_html('https://www.nhs.uk/service-search/find-a-dentist/results/Chipping%20Barnet?latitude=51.65338377069162&longitude=-0.20731108117981376');

$file = fopen('html.csv', 'w');

fputcsv($file, [$html]);

fclose($file);

