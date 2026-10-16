<?php
require_once FCPATH . 'vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en" >
<head>
  <title>Itinerary Details Chart</title>
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
   <div class="print-head">ITINERARY DETAILS</div>
  </div>
  
  <table class="tbl-arrivals" style="border:0;">
  <tbody>
  <tr>
  <td class="">
      <div class="field-name"><strong>No. of Stays </strong><label class="lab-data">' . $data[0]->number_of_nights + 1 . ' Days ,' . $data[0]->number_of_nights . ' Nights' . '</label></div>
  </td>
  <td class="">';

$char = substr($data[0]->enquiry_abbr, 1, 1);
$locations = ['A' => 'azerbaijan', 'B' => 'belarus', 'G' => 'georgia', 'K' => 'kazakhstan'];

$html .= '<div class="field-name"><strong>Country : </strong><label class="lab-data">' . ucfirst($locations[$char]) . '</label></div>
  </td>
  </tr>
  </tbody>
  </table>';

if (!empty($itinerary)) {

    $i = 0;
    $day = 1;
    $itinerary_date = $itinerary[0]->date;
    foreach ($itinerary as $list) {
        if ($i == 0 || $itinerary_date != $list->date) {
            $html .= '
      <table class="table">
      <thead>
      <tr>
        <th colspan="12" class="bg-secondary">
        <strong class="text-white">Day : ' . $day++;
            $html .= ', ' . date('d M Y (l)', strtotime($list->date)) . '</strong>
        </th>
      </tr>
      <tr>
      <th class="bg-warning" width="10%"><strong class="text-white">Time</strong></th>
      <th class="bg-warning" width="70%"><strong class="text-white">Activities</strong></th>
      <th class="bg-warning" width="20%"><strong class="text-white">Remark</strong></th>';
        }
        $html .= '</tr>
      </thead>
      <tbody>
      <tr style="border-bottom: 1px solid #000;">
         <td class="bg-white">' . $list->time . '</td>';

        if ($list->title <> '') {
            $html .= '<td class="bg-white">' . urldecode($list->title) . '</td>';
        } else {
            $html .= '<td class="bg-white">' . urldecode($list->content) . '</td>';
        }
        $html .= '<td class="bg-white">' . $list->remarks . '</td>';
        $itinerary_date = $list->date;
        if (!array_key_exists($i + 1, $itinerary) || $itinerary_date != $itinerary[$i + 1]->date) {
            $html .= '</tr>
</tbody>
</table>';
        }
        $i++;
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
$mpdf->Output('itinerary_details.pdf', 'D');