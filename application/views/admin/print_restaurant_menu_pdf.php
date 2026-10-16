<?php

require_once FCPATH . 'vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en" >
<head>
  <title>' . $restaurant->name . ' Menu Report</title>
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
  </div>';

if (!empty($restaurant_menus)) {
  $html .= '<table class="table table-bordered">
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
					<td class="bg-light-back text-center"><strong>' . $restaurant->name . '</strong></td>
					<td class="bg-light-back text-center"><strong>' . $restaurant->restaurant_address . '</strong></td>
					<td class="bg-light-back text-center"><strong>' . $restaurant->city . '</strong></td>
					<td class="bg-light-back text-center"><strong>' . $restaurant->country . '</strong></td>
				</tr>
			</tbody>
		</table>';
}

if (!empty($restaurant_menus)) {
     $menu_count = count($restaurant_menus);
      $i = 1;
      foreach ($restaurant_menus as $arr_id => $meals) { 
          // Only display the heading if there are multiple menus
          if ($menu_count > 1) { 
            $html .='<h3 class="text-center mb-1"><strong>Menu Type - '.$i++.'</strong></h3>';
            }      

    $html .= '
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="bg-warning text-center" style="width:30%"><strong>Meal Type</strong></th>
                            <th class="bg-warning text-center"><strong>Cuisines</strong></th>
                        </tr>
                    </thead>
                    <tbody>';
    foreach ($meals as $meal_type => $cuisines) {
      $html .= '<tr>
                                <td class="bg-light-back text-center" style="width:30%"><strong>' . ucfirst(str_replace('_', ' ', $meal_type)) . '</strong></td>
                                <td class="bg-light-back text-center">' . implode(', ', $cuisines) . '</td>
                            </tr>';
    }
    $html .= ' </tbody>
              </table>
            ';
  }
}

$html .= '</div></div>
</body>
</html>';
// echo $html;
// exit;

$mpdf->setAutoTopMargin = true;
$mpdf->setAutoBottomMargin = 'stretch';
$mpdf->WriteHTML($html);
$mpdf->Output(str_replace(' ', '_', $restaurant->name) . '_restaurant_menu.pdf', 'D');
