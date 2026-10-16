<?php
require_once FCPATH . 'vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en" >
<head>
  <title>Itinerary</title>
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
 <div class="row" style="margin:0 0px">    
  <div class="col-lg-12">
   <div class="print-head">RESTAURANT DETAILS</div>
  </div>';

$html .= '
      <table class="table table-bordered">
          <thead>
              <tr>
                  <th class="fadetbl" width="30%">Restaurant Name</th>
                  <th class="fadetbl" width="30%">Speciality</th>
                  <th class="fadetbl" width="">Price Range</th>
              </tr>
          </thead>
          <tbody>';

if (!empty($result)) {
    foreach ($result as $results) {

        $html .= '<tr class="odd gradeX">
    <td class="bg-white"> ' . $results->name . '</td>
<td class="bg-white">' . strtoupper($results->cuisine) . ' </td>
<td class="bg-white">' . $results->price_range . '</td>
</tr>';
    }
}
$html .= '
</tbody>
</table>';

$html .= '
      <table class="table table-bordered">
          <thead>
              <tr>
                  <th class="fadetbl" width="30%">Opening Time</th>
                  <th class="fadetbl" width="30%">Closing Time</th>
                  <th class="fadetbl" width="">Seating Capacity</th>
              </tr>
          </thead>
          <tbody>';

if (!empty($result)) {
    foreach ($result as $results) {

        $html .= '<tr class="odd gradeX">
    <td class="bg-white"> ' . $results->opening_time . '</td>
    <td class="bg-white">' . $results->closing_time . ' </td>
    <td class="bg-white">' . $results->seating_capacity . '</td>
    </tr>';
    }
}
$html .= '
</tbody>
</table>';

$html .= '
      <table class="table table-bordered">
          <thead>
              <tr>
                  <th class="fadetbl" width="30%">Address</th>
                  <th class="fadetbl" width="30%">Location</th>
                  <th class="fadetbl" width="">Image</th>
              </tr>
          </thead>
          <tbody>';

if (!empty($result)) {
    foreach ($result as $results) {

        $html .= '<tr class="odd gradeX">
    <td class="bg-white"> ' . $results->restaurant_address . '</td>
<td class="bg-white">' . $results->city . ', ' . $results->country . ' </td>
<td class="bg-white text-center"><img src="' . (($results->image != '') ? base_url() : 'assets/admin/images/no-image-icon.png') . 'uploads/restaurants/' . $results->image . '"
width="90" height="90"></td>
</tr>';
    }
}
$html .= '
</tbody>
</table>';


$html .= '
<table class="table table-bordered">
    <thead>
        <tr>
            <th class="fadetbl" width="25%">Description</th>
    </thead>
    <tbody>';

if (!empty($result)) {
    foreach ($result as $results) {
        $html .= '<tr class="odd gradeX">
            <td class="bg-white " style="font-size: medium"> ' . $results->description . '</td>
        </tr>';
    }
}
$html .= '
    </tbody>
</table>';

$html .= '</div>
</body>

</html>';
// echo $html;
// exit;
$mpdf->setAutoTopMargin = true;
$mpdf->setAutoBottomMargin = 'stretch';
$mpdf->WriteHTML($html);
$mpdf->Output('restaurant.pdf', 'D');