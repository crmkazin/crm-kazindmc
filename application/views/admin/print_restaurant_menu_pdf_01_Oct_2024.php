<?php

require_once FCPATH . 'vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en" >
<head>
  <title>' .$restaurant_menus->name . ' Menu Report</title>
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
   <div class="print-head">RESTAURANT MENU</div>
  </div>
  
  <table class="table table-bordered">
			<thead>
				<tr>                                
					<th class="bg-warning text-center"><strong class="text-white">Restaurant</strong></th>
					<th class="bg-warning text-center"><strong class="text-white">Restaurant Address</strong></th> 
					<th class="bg-warning text-center"><strong class="text-white">City</strong></th>
					<th class="bg-warning text-center"><strong class="text-white">Country</strong></th>                                 
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="bg-light-back text-center"><strong>'.$restaurant_menus->name.'</strong></td>
					<td class="bg-light-back text-center"><strong>'.$restaurant_menus->restaurant_address.'</strong></td>
					<td class="bg-light-back text-center"><strong>'.$restaurant_menus->city.'</strong></td>
					<td class="bg-light-back text-center"><strong>'.$restaurant_menus->country.'</strong></td>
				</tr>
			</tbody>
		</table>';

if (!empty($restaurant_menus)) { 

    $html .= '<table class="table table-bordered">                        
                        <tbody><tr>
    <td class="bg-light-back text-center" colspan="2"><strong>Menus</strong></td></tr>';

    foreach ($restaurant_menus->menu_cuisine_map as $menu_type => $cuisine_items) {

      $html .= '<tr style="border-top: 1px solid #000;"><td class="bg-light-back" style="width:15%;">
    <strong> ' . ucfirst(str_replace('_', ' ', $menu_type)) . '</strong>
    </td>
    <td class="bg-light-back">' . $cuisine_items . '</td></tr>';
    }
   
  }
  $html .= '</tbody> </table>';

$html .= '</div></div>
</body>
</html>';
//echo $html;exit;

$mpdf->setAutoTopMargin = true;
$mpdf->setAutoBottomMargin = 'stretch';
$mpdf->WriteHTML($html);
$mpdf->Output(str_replace(' ', '_', $restaurant_menus->name) .'_restaurant_menu.pdf', 'D');