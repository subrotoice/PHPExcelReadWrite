<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xls;

$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('app.xls');



if ( isset($_GET['confirmedId']) ) {

    // Edit block

    $cell = $_GET['confirmedId']; 

    $value = "Confirmed";

    $worksheet = $spreadsheet->getActiveSheet();

    $worksheet->getCell($cell)->setValue($value);

    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');

    $writer->save('app.xls'); 

    // Display the sheet content

    // var_dump($data);

    // Google sheet api

    // https://www.nidup.io/blog/manipulate-google-sheets-in-php-with-api

    echo "Subroto " . $_GET['confirmedId'];

}



if ( isset($_GET['notReceivedId']) ) {

    // Edit block

    $cell = $_GET['notReceivedId']; 

    $value = "Not Received";

    $worksheet = $spreadsheet->getActiveSheet();

    $worksheet->getCell($cell)->setValue($value);

    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');

    $writer->save('app.xls'); 

    echo "Subroto " . $_GET['notReceivedId'];

}

?>