<?php
require_once FCPATH . 'vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en" >
<head>
  <title>Restaurant Details</title>
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



if (!empty($result)) {
    foreach ($result as $results) {

        $html .= '
      <table class="table table-bordered">
          <tbody>
              <tr>
                  <th class="fadetbl">Restaurant Name</th>
                  <th class="bg-white"> ' . $results->name . '</th>
              </tr>
              <tr class="odd gradeX">
                    <th class="fadetbl">Speciality</th>
                    <td class="bg-white">' . strtoupper($results->cuisine) . ' </td>
              </tr>
              <tr class="odd gradeX">
                    <th class="fadetbl">Price Range</th>
                    <td class="bg-white">' . $results->price_range . '</td>
              </tr>
              <tr class="odd gradeX">
                    <th class="fadetbl">Price Range</th>
                    <td class="bg-white">' . $results->price_range . '</td>
              </tr>
              <tr class="odd gradeX">
                    <th class="fadetbl">Opening Time</th>
                    <td class="bg-white"> ' . $results->opening_time . '</td>
              </tr>
                    <tr class="odd gradeX">
                    <th class="fadetbl">Closing Time</th>
                    <td class="bg-white"> ' . $results->closing_time . '</td>
              </tr>
              <tr class="odd gradeX">
                   <th class="fadetbl">Seating Capacity<</th>
                   <td class="bg-white">' . $results->seating_capacity . '</td>
              </tr>
              <tr class="odd gradeX">
                   <th class="fadetbl" width="30%">Address</th>
                   <td class="bg-white"> ' . $results->restaurant_address . '</td>
              </tr>
              <tr class="odd gradeX">
                   <th class="fadetbl">Location</th>
                   <td class="bg-white">' . $results->city . ', ' . $results->country . ' </td>
              </tr>
              <tr>
                   <th class="fadetbl" width="">Image</th>
                   <td class="bg-white text-center"><img src="' . (($results->image != '') ? base_url() : 'assets/admin/images/no-image-icon.png') . 'uploads/restaurants/' . $results->image . '"
                    width="90" height="90"></td>
              </tr>
                   <tr>
                   <th class="fadetbl" width="">Description</th>
                   <td class="bg-white " style="font-size: medium"> ' . $results->description . '</td>
              </tr>
          </tbody></table>';
    }
}


$html .= '</div>
</body>

</html>';
// echo $html;
// exit;
$mpdf->setAutoTopMargin = true;
$mpdf->setAutoBottomMargin = 'stretch';
$mpdf->WriteHTML($html);
$mpdf->Output('Restaurant.pdf', 'D');