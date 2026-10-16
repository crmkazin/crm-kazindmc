<?php

require_once FCPATH . 'vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en" >
<head>
  <title>' .ucfirst($guide->name.' '.$guide->last_name) . ' Details</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="' . base_url('assets/admin/print/css/bootstrap.css') . '" rel="stylesheet">
  <link href="' . base_url('assets/admin/print/css/style.css') . '" rel="stylesheet">
  
  <script src="' . base_url() . 'assets/admin/print/js/bootstrap.js"></script>
  <style>
    @media print {
        html { -webkit-print-color-adjust: exact; }
        .print-data {  page-break-after: always; }
        .noPrint{ display:none;  }
    }   
    strong { font-weight:bold; }
    .tbl-arrivals { margin-bottom: 8px; } 
    .tbl-arrivals td { padding:4px !important; }
    .table td, th { border : 1px solid #000 !important;padding:4px !important; }
    @page *{
    margin-top: 2.54cm; }
    
</style>
</head>
<body>    
<div class="container print-data" id="cnt-print-data">
 <div class="row">
  <div class="col-lg-12 text-start logo-left bg-new-file"><img src="' . base_url() . 'assets/admin/print/images/logo.png" class="mt-2 mb-2 p-2" height="50"></div>
 </div>
 <div class="row" style="margin:0 0px">    
  <div class="col-lg-12">
   <div class="print-head">Guide Details</div>
  </div>
  
				<table class="table table-bordered">
					<tr><td >
				
						<table class="table table-bordered">
							<tbody> 
								<tr>
									<td class="fadetbl" >Name</td>
									<td class="fadetbl" >Contact Number</td>                                
								</tr>                        
													   
								<tr class="odd gradeX">
									<td class="bg-white">'.ucfirst($guide->name.' '.$guide->last_name).'</td>
									<td class="bg-white">'.($guide->isd_codes.' '.$guide->contact_number).'</td>                                
								</tr>  
								<tr>
									<td class="fadetbl" >Gender</td>
									<td class="fadetbl" >Languages</td>									
								</tr>
								<tr>
									<td class="bg-white">'.ucfirst($guide->gender).'</td>
									<td class="bg-white">'.$guide->languages.'</td>									
								</tr>  
								<tr>
									<td class="fadetbl" >Location</td>
									<td class="fadetbl" >City</td>                               
								</tr>                        
													   
								<tr class="odd gradeX">
									<td class="bg-white">'.$guide->location.'</td>
									<td class="bg-white">'.$guide->city.'</td>                                
								</tr>  
								<tr>
									<td class="fadetbl" >State</td>
									<td class="fadetbl">Country</td>
								</tr>
								 <tr>									
									<td class="bg-white">'.$guide->state.'</td>
									<td class="bg-white">'.$guide->country.'</td>
								</tr>
							</tbody>
						</table>
						</td>
						<td class="text-center">
							<img src="'.base_url('assets/guide/'.$guide->photo).'" height="225" width="25%">
						</td>
					</tr>
				 </table>';

$html .= '</div></div>
</body>
</html>';
//echo $html;exit;

$mpdf->setAutoTopMargin = true;
$mpdf->setAutoBottomMargin = 'stretch';
$mpdf->WriteHTML($html);
$mpdf->Output(str_replace(' ', '_', ucfirst(trim($guide->name).'_'.trim($guide->last_name))) .'.pdf', 'D');