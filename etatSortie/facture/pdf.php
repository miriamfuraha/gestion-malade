<?php

require_once 'dompdf/autoload.inc.php';
ob_start();
 require_once 'content.php';
 $html=ob_get_contents();
 ob_clean();
use Dompdf\Dompdf;
use Dompdf\Options;
 $options =  new Options();
 $options->set('defaultFont', 'Courier');
$pdf= new Dompdf($options);
$pdf->setPaper("A5", "landscape");
$pdf->loadHtml($html);
$pdf->render();
$nom="facture";
$pdf->stream($nom, array('Attachment'=>0,false));

?>