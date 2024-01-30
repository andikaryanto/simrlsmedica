<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function pdf_create($html, $page='',$filename='laporan.pdf', $stream=TRUE,$gudang=0,$paperSize=null)
{
//		define('FPDF_FONTPATH', FULL_PATH_TO_FONT_DIRECTORY);
    require_once("mpdf/mpdf.php");
    	    $mpdf = new mPDF(); 
	    	$mpdf = new mPDF('',
					'',    // format - A4, for example, default ''
					0,     // font size - default 0
					'',    // default font family
					15,    // margin_left
					15,    // margin right
					15,     // margin top
					5,    // margin bottom
					5,     // margin header
					 5,     // margin footer
					 'L'
	    	);

		$src=''.base_url().'images/';
		//$mpdf->SetBasePath($src); 
		$mpdf->jSpacing = 'C';
		if($page != ''){
			$mpdf->AddPage($page);
		}
		$mpdf->WriteHTML($html);
    if ($stream==TRUE) {
		
			$mpdf->Output($filename,'I');
			
			exit;
    } else {
    	//////
    }/////////////////////
}
//function mpdf_create($html, $page='P', $filename, $stream=FALSE, $return_string=FALSE)
//{
//    // Load MPDF Class Structure
//    include_once('mpdf.php');
//    // Initilize mPDF
//    $mpdf = new mPDF();
//		$mpdf->setAutoTopMargin = 'stretch';
//		$mpdf->jSpacing = 'C';
//		$mpdf->AddPage($page);
//    // Quick check on where this file is going
//    if($stream == TRUE){ // If stream is true when called it will output right to the browser
//        $mpdf->WriteHTML($html);
//        $mpdf->Output($filename,'I');
//    }
//    elseif($return_string == TRUE){ // If stream was false but string is true, then we will return
//    // all the data back to the orginal script to manipulate
//        $mpdf->WriteHTML($html);
//        $string = $mpdf->Output(NULL, 'S');
//        return($string);
//    }
//    else{
//        // And if both were false then we are going to save the pdf file
//        $mpdf->WriteHTML($html);
//        // Little issue here,  WE ASSUME that the calling script/controller/model is passing
//        // the path along with the file name including the extension .pdf!!!
//        $mpdf->Output($filename,'F');
//    }
//    exit;
//
//}
?>