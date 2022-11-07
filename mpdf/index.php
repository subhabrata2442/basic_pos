<?php

require_once __DIR__ . '/vendor/autoload.php';

//$mpdf = new \Mpdf\Mpdf();
//$mpdf->AddPage('L');
// Define a default page size/format by array - page will be 190mm wide x 236mm height
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [90, 297]]);

ob_start();
//include "mpdf.php"; 
include "invoice.php"; 

$template = ob_get_contents();
ob_end_clean();

$mpdf->WriteHTML($template);



//$mpdf->WriteHTML($invoice);
$mpdf->Output();



?>