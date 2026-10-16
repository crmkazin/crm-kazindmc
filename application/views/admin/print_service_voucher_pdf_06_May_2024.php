<?php 

require_once FCPATH.'vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en" >
<head>
  <title>'.$arrivals->enquiry_no. ': Arrival Chart</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="'.base_url('assets/admin/print/css/bootstrap.css').'" rel="stylesheet">
  <link href="'.base_url('assets/admin/print/css/style.css').'" rel="stylesheet">
  
  <script src="'.base_url().'assets/admin/print/js/bootstrap.js"></script>
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
    <div class="col-sm-12 col-md-12 col-lg-12 text-start logo-left bg-new">
        <table class="tbl-arrivals" style="border:0;">
        <tbody>
            <tr>
                <td style="width:30%;">
                    <img src="'.base_url().'assets/company/'.$arrivals->company_logo.'" class="mt-2 mb-2 p-2" height="50">
                </td>
                <td style="width:70%;text-align:right;color: #FFF;">
                    <div class="field-name"><strong>Contact Name :</strong>
                    <label class="lab-data">'.$arrivals->contact_person.'</label></div>
                    <div class="field-name"><strong>Contact Number :</strong>
                    <label class="lab-data">'.$arrivals->contact_num.'</label> </div>
                    <div class="field-name"><strong>Address :</strong>
                    <label class="lab-data">'.$arrivals->address.'</label> </div> 
                </td>
            </tr>
        </tbody>
        </table>
        </div>
    </div>
    
 <div class="row" style="margin:0 30px">    
  <div class="col-lg-12">
   <div class="print-head">SERVICE VOUCHER</div>
  </div>
  
    <table class="tbl-arrivals" style="border:0;">
    <tbody>
    <tr>
    <td class="">
        <div class="field-name text-danger"><strong>File No. : </strong><label class="lab-data">'.$arrivals->enquiry_no.'</label></div>
    </td>
    <td class="">
        <div class="field-name"><strong>Agent Name : </strong><label class="lab-data">'.$arrivals->filename.'</label></div>
    </td>
    <td class="">
        <div class="field-name"><strong>Arrival Date : </strong><label class="lab-data">'.date('d-M-Y',strtotime($arrivals->arrival_date)).'</label></div>
    </td>
    </tr>
   
    <tr> 
        <td class="">
              <div class="field-name"><strong>Check in Date : </strong><label class="lab-data">'.date('d-M-Y',strtotime($arrivals->check_in_date)).'</label></div>
        </td>
        <td class="">
            <div class="field-name"><style></style><strong>Check Out Date : </strong><label class="lab-data">'.date('d-M-Y',strtotime($arrivals->check_out_date)).'</label></div>
        </td>
        <td class="">
            <div class="field-name"><strong>Number Of Nights : </strong><label class="lab-data">'.$arrivals->number_of_nights.'</label></div>
        </td>
    </tr>
    
    <tr> 
        <td class="">
            <div class="field-name"><strong>Group Type : </strong><label class="lab-data">'.$arrivals->group_type.'</label></div>
        </td>

        <td class="">
            <div class="field-name"><strong>Lead Contact : </strong><label class="lab-data">'.$arrivals->lead_isd_code.' '.$arrivals->lead_contact.'</label></div>
        </td>

        <td class="">
            <div class="field-name"><strong>Handover to other : </strong><label class="lab-data">'.ucfirst($arrivals->handover_to_client).'</label></div>
        </td>
    </tr>

    <tr> 
        <td class="">
            <div class="field-name"><strong>Handover to Kazin : </strong><label class="lab-data">'.ucfirst($arrivals->handover_to_kazin).'</label></div>
        </td>
        <td class="">
            <div class="field-name"><strong>Lead Name : </strong><label class="lab-data">'.$arrivals->lead_name.'</label></div>
        </td>
        <td class="">
            <div class="field-name"><strong>Status : </strong><label class="lab-data">'.ucfirst($arrivals->status).'</label></div>
        </td>
    </tr>
    
</tbody>
  </table>';

  if(!empty($arrival_hotel_details)){
  $html .= '
  <table class="table">
    <thead>
    <tr>
      <th colspan="5" class="bg-secondary">
      <strong class="text-white">Hotel Details</strong>
      </th>
    </tr>
    <tr>
      <th class="bg-warning" width="40px"><strong class="text-white">S.No.</strong></th>
      <th class="bg-warning"><strong class="text-white">Hotel</strong></th>
      <th class="bg-warning"><strong class="text-white">Address</strong></th>
      <th class="bg-warning"><strong class="text-white">Check In</strong></th>
      <th class="bg-warning"><strong class="text-white">Check Out</strong></th>
    </tr>
    </thead>
    <tbody>';
    $i=0; 
        foreach($arrival_hotel_details AS $list){
    $html.='<tr style="border-bottom: 1px solid #000;">
      <td class="bg-white">'.++$i.'</td>
      <td class="bg-white">'.$list->hotel.' <a href="'.$list->map.'">Location</a></td>
      <td class="bg-white">'.$list->address_1.', '.$list->address_2.', '.$list->city.', '.$list->state.'</td>
      <td class="bg-white">'.date('d-M-Y',strtotime($list->checkin_date)).'</td>
      <td class="bg-white">'.date('d-M-Y',strtotime($list->checkout_date)).'</td>
    </tr>';
    }
    $html.='</tbody>
  </table>                
   ';   
   } 
   if(!empty($arrival_flight)){
    $html .= '
	<table class="table">
	  <thead>
          <tr>
            <th colspan="6" class="bg-secondary">
            <strong class="text-white">Flight Details</strong>
            </th>
        </tr>
		<tr>
                    <th class="bg-warning"><strong class="text-white">S.No.</strong></th>
                    <th class="bg-warning"><strong class="text-white">Airline</strong></th>
                    <th class="bg-warning"><strong class="text-white">Departure</strong></th>
                    <th class="bg-warning"><strong class="text-white">Arrival</strong></th>
                    <th class="bg-warning"><strong class="text-white">No. of Persons</strong></th>
                    <th class="bg-warning"><strong class="text-white">Flight Mode</strong></th>
		</tr>
	  </thead>
	  <tbody>';
              $i=0;
	            foreach($arrival_flight AS $list){
            $html.='<tr style="border-bottom: 1px solid #000;">
                    <td class="bg-white">'.++$i.'</td>
                    <td class="bg-white" style="border-bottom:1px solid #ff1d1d !important;">'.$list->name.'('.$list->flight_number.')</td>
                    <td class="bg-white">'.$list->departure_city.' '.date('d, M Y',strtotime($list->departure_date)).'('.$list->departure_time.')</td>
                    <td class="bg-white">'.$list->arrival_city.' '.date('d, M Y',strtotime($list->arrival_date)).'('.$list->arrival_time.')</td>
                    <td class="bg-white">'.$list->number_persons.'</td>
                    <td class="bg-white">'.ucfirst($list->flight_mode).'</td>
                </tr>'; }
	$html.='</tbody>
	</table>';   
      }
    if(!empty($itinerary)){
  
                $i = 0;
                $itinerary_date = $itinerary[0];
                foreach($itinerary AS $list){ 
                    if($i==0 || $itinerary_date != $list->date){
                        $sr = 0;
            $html.='<table class="table table-bordered">
                <thead>
                   
      <tr>
      <th colspan="3" class="bg-secondary">
      <strong class="text-white">Itinerary</strong>
      </th>
    </tr>
                    <tr>
                      <th colspan="3" class="bg-warning">
                      <strong class="ms-3 text-white">'.date('d M Y (l)',strtotime($list->date)).'</strong>
                      </th>
                    </tr>
                    <tr>
                      <th class="fadetbl" width="10%"><p class="text-black">Time</p></th>
                      <th class="fadetbl" width="50%"><p class="text-black">Activities</p></th>
                      <th class="fadetbl" width="25%"><p class="text-black">Remark</p></th>
                    </tr>
                </thead> <tbody>';     
        }
        $html.='<tr style="border-bottom: 1px solid #000;">
                <!--<td class="bg-white"><?=++$sr; ?></td>-->
                <td class="bg-white">'.$list->time.' Hrs</td>
                <td class="bg-white">'.urldecode($list->title).' '.urldecode($list->content).'</td>
                <td class="bg-white">'.$list->remarks.'</td>
            </tr>';
            $itinerary_date = $list->date;
            if(!array_key_exists($i+1,$itinerary) || $itinerary_date != $itinerary[$i+1]->date){
        $html.='</tbody>
        </table>'; }$i++; }
        
     }
$html.='<table class="table">
    <thead>
     <tr>
      <th colspan="3" class="bg-secondary">
      <strong class="text-white">Transportation Details</strong>
      </th>
    </tr>  
  <tr style="border-bottom: 1px solid #000;">
    <td class="bg-white">
	<div class="field-name">Name : <label class="lab-data">'.$arrivals->vehicle_name.'</label></div>
   </td>
  
  <td class="bg-white">
	<div class="field-name">Vehicle Type : <label class="lab-data">'.$arrivals->vehicle_type.'</label></div>
   </td>
  
  <td class="bg-white">
	<div class="field-name">Capacity: <label class="lab-data">'.$arrivals->capacity.'</label></div>
  </td>
</tr>
<tr>
 <td colspan="3" class="bg-white">
  <div class="field-name">Remarks: <label class="lab-data">'.$arrivals->remarks.'</label></div>
  </td>
</tr>
</thead>
</table>';
  if($arrivals->guide_id != '0'){
  $html.='<table class="table table-bordered">
    <thead>
     <tr>
      <th colspan="3" class="bg-secondary">
      <strong class="text-white">Guide Details</strong>
      </th>
    </tr>  
    <tr style="border-bottom: 1px solid #000;">
      <td rowspan="2" class="bg-white">';
    $img = ($arrivals->photo<>'')?base_url().'assets/guide/'.trim($arrivals->photo):base_url().'assets/admin/images/no-image-icon.png';
    $html.='<img src="'.$img.'" width=75 height=75 class="fluid mt-2">
      </td>
    <td class="bg-white">
        <div class="field-name">Guide Name : <label class="lab-data">'.$arrivals->guide.'</label></div>
                       
    </td>
  <td class="bg-white">
  <div class="field-name">Location : <label class="lab-data">'.$arrivals->location.'</label></div>
  </td>
</tr>
<tr>
<td class="bg-white">
	<div class="field-name">Gender : <label class="lab-data">'.ucfirst($arrivals->gender).'</label></div>
</td>
<td class="bg-white">
  <div class="field-name">Ph No.: <label class="lab-data">'.$arrivals->isd_codes.'-'.$arrivals->contact_number.'</label></div>
</td>
</tr>
</thead>
</table>';
    }else {
        $html.='<table class="" style="padding:4px;">';
        $html.='<thead><tr><th class="bg-secondary"><strong class="text-white">Guide Details</strong></th></tr></thead>';
        $html.='<tbody><tr><td style="text-align: center;color: #fda2a2;">No Guide</td></tr></tbody></table>';
    }
    if(!empty($arrival_room)){
    $html.='<table class="table table-bordered mt-3">
    <thead>
     <tr>
      <th colspan="10" class="bg-secondary">
      <strong class="text-white">Rooming Details</strong>
      </th>
    </tr>  
    <tr>
      <th class="bg-warning"><strong class="text-white">S.No.</strong></th>
      <th class="bg-warning"><strong class="text-white">Hotel</strong></th>
      <th class="bg-warning"><strong class="text-white">Check In</strong></th>
      <th class="bg-warning"><strong class="text-white">Check Out</strong></th>
      <th class="bg-warning"><strong class="text-white">Room Category</strong></th>
      <th class="bg-warning"><strong class="text-white">Adults</strong></th>
      <th class="bg-warning"><strong class="text-white">Child</strong></th>
      <th class="bg-warning"><strong class="text-white">Confirmation No.</strong></th>
      <th class="bg-warning"><strong class="text-white">Person Details</strong></th>
      <th class="bg-warning"><strong class="text-white">Breakfast</strong></th>
    </tr>
    </thead>
    <tbody>';
    $i=0;
    
    foreach($arrival_room AS $list){
        $html.='<tr style="border-bottom: 1px solid #000;">
        <td class="bg-white">'.++$i.'</td>
        <td class="bg-white">'.$list->hotel.'</td>
        <td class="bg-white">'.date('d-M-Y',strtotime($list->checkin_date)).'</td>
        <td class="bg-white">'.date('d-M-Y',strtotime($list->checkout_date)).'</td>
        <td class="bg-white">'.ucfirst($list->category).'</td>
        <td class="bg-white">'.$list->number_adults.'</td>
        <td class="bg-white">'.$list->number_child.'</td>
        <td class="bg-white">'.$list->hotel_confirmation_num.'</td>
        <td class="bg-white">'.$list->persons_details.'</td>
        <td class="bg-white">'.ucfirst($list->breakfast).'</td></tr>';
        }
    $html.='</tbody>
  </table>';
    }
$html.='<table class="tbl-arrivals" style="border:0;padding:4px;">
    <tbody>
    <tr>    
        <td class="" style="">
            <div class="field-name"><strong>Company : </strong><label class="lab-data">'.$company->name.'</label></div>
        </td>
        <td class="">
            <div class="field-name"><strong>Address : </strong><label class="lab-data">'.$company->address.'</label></div>
        </td>
    </tr>   
    <tr> 
        <td class="">
            <div class="field-name"><strong>Contact Person : </strong><label class="lab-data">'.$company->person_name.'</label></div>
        </td>
        <td class="">
            <div class="field-name"><style></style><strong>Contact Mobile : </strong><label class="lab-data">'.$company->contact_number.'</label></div>
        </td>        
    </tr>      
</tbody>
  </table>';
    if($company->country=="Kazakhstan") {
    
    $html.='<table class="table table-bordered">
    <thead>
     <tr style="border-bottom: 1px solid #000;">
      <th class="bg-secondary">
      <strong class="text-white">Welcome to Kazakhstan: A Guide to Respectful Travel</strong>
      </th>
    </tr>
    <tr style="border-bottom: 1px solid #000;">
      <td class="bg-white">As part of our commitment to ensuring a harmonious and enjoyable experience for both our guests and hosts in Kazakhstan, we kindly request that all visitors observe the following guidelines to uphold the dignity and cleanliness of the places we are privileged to explore:</td>
    </tr>  
   <tr style="border-bottom: 1px solid #000;">
    <td class="bg-white">
  <div class="field-name"><strong>1. Respect Local Traditions:</strong>
  <label class="lab-data">Kazakhstan is a country rich in culture and traditions. Please show respect towards local customs, rituals, and etiquette. A little research or inquiry about local norms can enrich your travel experience and foster mutual respect.</label>
  </div>
  </td>                
   </tr> 
   <tr style="border-bottom: 1px solid #000;">
    <td class="bg-white">
    <div class="field-name"><strong>2. Environmental Responsibility:</strong>
    <label class="lab-data">Please help us keep Kazakhstan\'s natural landscapes pristine by disposing of litter in designated bins, recycling when possible, and minimizing your environmental footprint during your stay.</label>
    </div>
                  
  </td>
</tr>
   <tr style="border-bottom: 1px solid #000;">
    <td class="bg-white">
    <div class="field-name"><strong>3. Hygiene Practices:</strong>
    <label class="lab-data">Out of respect for future guests and to maintain the high standards of cleanliness that Kazakhstan is proud of, we urge you to follow hygienic practices in hotels and public spaces. This includes using facilities as intended, being mindful of waste disposal, and maintaining personal cleanliness.</label>
    </div>
   </td>
 </tr>
 <tr style="border-bottom: 1px solid #000;">
   <td class="bg-white">
    <div class="field-name"><strong>4. Interactions with Locals:</strong>
    <label class="lab-data">Warmth and hospitality are at the heart of Kazakh culture. When interacting with local residents, a respectful and polite demeanor goes a long way. Greetings, gratitude, and a smile can bridge the gap between different languages and cultures.</label>
    </div>       
   </td>
 </tr>
   <tr style="border-bottom: 1px solid #000;">
   <td class="bg-white">
  <div class="field-name"><strong>5. Adherence to Hotel Policies:</strong>
    <label class="lab-data">Each hotel and accommodation has its own set of rules designed to ensure the comfort and safety of all guests. We ask that you familiarize yourself with and adhere to these policies throughout your stay.</label>
</div>            
  </td>
</tr>
  <tr style="border-bottom: 1px solid #000;">
    <td class="bg-white">
  <label class="lab-data">By following these guidelines, you contribute to a positive atmosphere of mutual respect and understanding between tourists and the local community. Our goal is to create memorable experiences for you that are respectful of the environment, local culture, and traditions of Kazakhstan.</label> 
</td>
</tr>
<tr>
<td class="bg-white">
  <label class="lab-data"><strong>Thank you for choosing to explore Kazakhstan with Kazin DMC. Let’s make your visit memorable for all the right reasons.</strong></label> 
</td>
</tr>
</thead>
</table>
</div>';
 }
$html.='</div>
</body>
</html>';
//echo $html;exit;
$mpdf->setAutoTopMargin = true;
$mpdf->setAutoBottomMargin = 'stretch';
$mpdf->WriteHTML($html);
$mpdf->Output($arrivals->enquiry_no.'_service_voucher.pdf','D');