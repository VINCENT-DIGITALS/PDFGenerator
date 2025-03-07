<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Check which form to generate
$form = isset($_GET['form']) ? $_GET['form'] : '1a';

// Define the path to the HTML template
$formPath = "forms/form_" . $form . ".html";

if (!file_exists($formPath)) {
    die("Form not found.");
}

// Set DOMPDF options
$options = new Options();
$options->set('defaultFont', 'Arial');
$options->set('isHtml5ParserEnabled', true);

$dompdf = new Dompdf($options);

// Load the correct HTML file
$html = file_get_contents($formPath);
$dompdf->loadHtml($html);

// Set A4 paper size
$dompdf->setPaper('A4', 'portrait');

// Render and output the PDF
$dompdf->render();
$dompdf->stream("PhilRice_Form_$form.pdf", ["Attachment" => true]);
?>
