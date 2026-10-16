<?php

require_once FCPATH . 'vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en" >
<head>
  <title>' . $arrivals->enquiry_no . ': Arrival Chart</title>
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
  
  <table class="tbl-arrivals" style="border:0;">
  <tbody>
  <tr>
  <td class="">
      <div class="field-name text-danger"><strong>File No. : </strong><label class="lab-data">' . $arrivals->enquiry_no . '</label></div>
  </td>
  <td class="">
      <div class="field-name"><strong>Agent Name : </strong><label class="lab-data">' . $arrivals->filename . '</label></div>
  </td>
  <td class="">
      <div class="field-name"><strong>Arrival Date : </strong><label class="lab-data">' . date('d-M-Y', strtotime($arrivals->arrival_date)) . '</label></div>
  </td>
  </tr>
 
  <tr> 
      <td class="">
            <div class="field-name"><strong>Check in Date : </strong><label class="lab-data">' . date('d-M-Y', strtotime($arrivals->check_in_date)) . '</label></div>
      </td>
      <td class="">
          <div class="field-name"><style></style><strong>Check Out Date : </strong><label class="lab-data">' . date('d-M-Y', strtotime($arrivals->check_out_date)) . '</label></div>
      </td>
      <td class="">
          <div class="field-name"><strong>Number Of Nights : </strong><label class="lab-data">' . $arrivals->number_of_nights . '</label></div>
      </td>
  </tr>
  
  <tr> 
      <td class="">
          <div class="field-name"><strong>Group Type : </strong><label class="lab-data">' . $arrivals->group_type . '</label></div>
      </td>

      <td class="">
          <div class="field-name"><strong>Lead Contact : </strong><label class="lab-data">' . $arrivals->lead_isd_code . ' ' . $arrivals->lead_contact . '</label></div>
      </td>

      <td class="">
          <div class="field-name"><strong>Handover to other : </strong><label class="lab-data">' . ucfirst($arrivals->handover_to_client) . '</label></div>
      </td>
  </tr>

  <tr> 
      <td class="">
          <div class="field-name"><strong>Handover to Kazin : </strong><label class="lab-data">' . ucfirst($arrivals->handover_to_kazin) . '</label></div>
      </td>
      <td class="">
          <div class="field-name"><strong>Lead Name : </strong><label class="lab-data">' . $arrivals->lead_name . '</label></div>
      </td>
      <td class="">
          <div class="field-name"><strong>Status : </strong><label class="lab-data">' . ucfirst($arrivals->status) . '</label></div>
      </td>
  </tr>
  
</tbody>
</table>';

if (!empty($restaurant_menus)) {
  $html .= '
  <table class="table">
    <thead>
    <tr>
      <th colspan="13" class="bg-secondary">
      <strong class="text-white">Restaurant Details</strong>
      </th>
    </tr>
    <tr>
      <th class="bg-warning" width="40px"><strong class="text-white">S.No.</strong></th>
      <th class="bg-warning"><strong class="text-white">Date</strong></th>
      <th class="bg-warning"><strong class="text-white">Buffet</strong></th>
      <th class="bg-warning"><strong class="text-white">Restaurant</strong></th>
      <th class="bg-warning"><strong class="text-white">Restaurant Address</strong></th>
      <th class="bg-warning"><strong class="text-white">Start Time</strong></th>
      <th class="bg-warning"><strong class="text-white">End Time</strong></th>
      <th class="bg-warning"><strong class="text-white">Total Person</strong></th>
      <th class="bg-warning"><strong class="text-white">No. Of Veg Person</strong></th>
      <th class="bg-warning"><strong class="text-white">No. Of Non Veg Person</strong></th>
      <th class="bg-warning"><strong class="text-white">No. Of Vegan Person </strong></th>
      <th class="bg-warning"><strong class="text-white">No. Of Jain Meal Person</strong></th>
      <th class="bg-warning"><strong class="text-white">Meal Type</strong></th>
    </tr>
    </thead>
    <tbody>';
  $i = 0;
  $prev_date = null;
  $r_id = base64_decode($this->input->get('restaurant_id'));
  $restaurant_name ='';
  foreach ($restaurant_menus as $list) {
    // Check if the date has changed
    if($list->restaurant_id != $r_id && $r_id != 'all'){ continue; }
    $current_date = date('d-M-Y', strtotime($list->date));
    if ($current_date != $prev_date && $prev_date !== null) {
      // If date changed, add a row with white background
      //$html.='<tr class="remove-border"><td colspan="13" ></td></tr>';
      }
    $prev_date = $current_date;
    $restaurant_name =  $list->name ;

    $html .= '<tr style="border-bottom: 1px solid #000; border-top: 1px solid #000;" class="tr_rows">
      <td class="bg-white"><strong>' . ++$i . '</strong></td>
      <td class="bg-white"><strong>' . $current_date . '</strong></td>
      <td class="bg-white"><strong>' . $list->buffet . (($list->packed == 1)?'<br>(Packed)':'').'</strong></td>
      <td class="bg-white"><strong>' . $list->name . '</strong></td>
      <td class="bg-white"><strong>' . $list->restaurant_address . '</strong></td>
      <td class="bg-white"><strong>' . $list->opening_time . '</strong></td> 
      <td class="bg-white"><strong>' . $list->closing_time . '</strong></td>
      <td class="bg-white"><strong>' . $list->no_of_person . '</strong></td>
      <td class="bg-white"><strong>' . $list->no_of_veg_person . '</strong></td>
      <td class="bg-white"><strong>' . $list->no_of_non_veg_person . '</strong></td>
      <td class="bg-white"><strong>' . $list->no_of_vegan_person . '</strong></td>
      <td class="bg-white"><strong>' . $list->no_of_jain_meal . '</strong></td>
      <td class="bg-white"><strong>' . $list->meals . '</strong></td>
    </tr>';
    $count = 0;
    $total_menu_types = count($list->menu_cuisine_map);

    $html .= '<tr style="border-bottom: 1px solid #000; border-top: 1px solid #000;">

    <tr style="border-bottom: 1px solid #000; border-top: 1px solid #000;">
    <td class="bg-light-back text-center" colspan="3"><strong>Final Remarks</strong></td>
    <td class="bg-light-back text-center" colspan="10"><strong style="color:#18c30e;">' . $list->final_remark . '</strong></td>
    </tr>
    <tr>
    <td class="bg-light-back text-center" colspan="13"><strong>Menus</strong></td></tr>';

    foreach ($list->menu_cuisine_map as $menu_type => $cuisine_items) {
      $count++;

      $html .= '<tr style="border-top: 1px solid #000;"><td class="bg-light-back" colspan="3">
    <strong> ' . ucfirst(str_replace('_', ' ', $menu_type)) . '</strong>
    </td>
    <td class="bg-light-back" colspan="10">' . $cuisine_items . '</td></tr>';
    }
    $html .= ' <tr><td style="background-color:Gray;height:12px;" colspan="13" ></td></tr> ';
  }
  $html .= '</tbody> </table>';
}

$html .= '<table class="tbl-arrivals" style="border:0;padding:4px;">
    <tbody>
    <tr>    
        <td class="" style="">
            <div class="field-name"><strong>Company : </strong><label class="lab-data">' . $company->name . '</label></div>
        </td>
        <td class="">
            <div class="field-name"><strong>Address : </strong><label class="lab-data">' . $company->address . '</label></div>
        </td>
    </tr>   
    <tr> 
        <td class="">
            <div class="field-name"><strong>Contact Person : </strong><label class="lab-data">' . $company->person_name . '</label></div>
        </td>
        <td class="">
            <div class="field-name"><style></style><strong>Contact Mobile : </strong><label class="lab-data">' . $company->contact_number . '</label></div>
        </td>        
    </tr>      
</tbody>
  </table>';

$html .= '<table class="table table-bordered">
    <thead>
     <tr style="border-bottom: 1px solid #000;">
      <th class="bg-secondary">
      <strong class="text-white">Welcome to ' . $company->country . ': A Guide to Respectful Travel</strong>
      </th>
    </tr>
    <tr style="border-bottom: 1px solid #000;">
      <td class="bg-white">As part of our commitment to ensuring a harmonious and enjoyable experience for both our guests and hosts in ' . $company->country . ', we kindly request that all visitors observe the following guidelines to uphold the dignity and cleanliness of the places we are privileged to explore:</td>
    </tr>  
   <tr style="border-bottom: 1px solid #000;">
    <td class="bg-white">
  <div class="field-name"><strong>1. Respect Local Traditions:</strong>
  <label class="lab-data">' . $company->country . ' is a country rich in culture and traditions. Please show respect towards local customs, rituals, and etiquette. A little research or inquiry about local norms can enrich your travel experience and foster mutual respect.</label>
  </div>
  </td>                
   </tr> 
   <tr style="border-bottom: 1px solid #000;">
    <td class="bg-white">
    <div class="field-name"><strong>2. Environmental Responsibility:</strong>
    <label class="lab-data">Please help us keep ' . $company->country . '\'s natural landscapes pristine by disposing of litter in designated bins, recycling when possible, and minimizing your environmental footprint during your stay.</label>
    </div>
                  
  </td>
</tr>
   <tr style="border-bottom: 1px solid #000;">
    <td class="bg-white">
    <div class="field-name"><strong>3. Hygiene Practices:</strong>
    <label class="lab-data">Out of respect for future guests and to maintain the high standards of cleanliness that ' . $company->country . ' is proud of, we urge you to follow hygienic practices in hotels and public spaces. This includes using facilities as intended, being mindful of waste disposal, and maintaining personal cleanliness.</label>
    </div>
   </td>
 </tr>
 <tr style="border-bottom: 1px solid #000;">
   <td class="bg-white">
    <div class="field-name"><strong>4. Interactions with Locals:</strong>
    <label class="lab-data">Warmth and hospitality are at the heart of '.(($company->country=='Kazakhstan')?'Kazakh':$company->country).' culture. When interacting with local residents, a respectful and polite demeanor goes a long way. Greetings, gratitude, and a smile can bridge the gap between different languages and cultures.</label>
    </div>       
   </td>
 </tr>
   <tr style="border-bottom: 1px solid #000;">
   <td class="bg-white">
  <div class="field-name"><strong>5. Adherence to Hotel Policies:</strong>
    <label class="lab-data">Each hotel and accommodation has its own set of rules designed to ensure the comfort and safety of all guests. We ask that you familiarize yourself with and adhere to these policies throughout your stay. Please note that failure to comply with these policies may result in penalties or additional charges imposed by the hotel. Additionally, hotels may request a security deposit upon check-in.</label>
</div>            
  </td>
</tr>
  <tr style="border-bottom: 1px solid #000;">
    <td class="bg-white">
  <label class="lab-data">By following these guidelines, you contribute to a positive atmosphere of mutual respect and understanding between tourists and the local community. Our goal is to create memorable experiences for you that are respectful of the environment, local culture, and traditions of ' . $company->name . '.</label> 
</td>
</tr>
<tr>
<td class="bg-white">
  <label class="lab-data"><strong>Thank you for choosing to explore ' . $company->country . ' with Kazin DMC. Let’s make your visit memorable for all the right reasons.</strong></label> 
</td>
</tr>
</thead>
</table>
</div>';
$html .= '</div>
</body>
</html>';
// echo $html;
// exit;
$mpdf->setAutoTopMargin = true;
$mpdf->setAutoBottomMargin = 'stretch';
$mpdf->WriteHTML($html);

if($r_id == 'all'){
$restaurant_name ='';
}
$mpdf->Output($arrivals->enquiry_no .'_'.urlencode(str_replace(' ', '_', $restaurant_name)) .'_restaurant_details.pdf', 'D');