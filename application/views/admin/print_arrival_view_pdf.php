<?php 

$cmb_enquiry_id = $this->db
    ->select('combo_enquiry_id')
    ->where('id', $arrivals->id)
    ->get('arrivals')
    ->row();
    
$cmb_nght = $this->db
    ->select('*')
    ->where('id', $cmb_enquiry_id->combo_enquiry_id)
    ->get('combo_enquiry')
    ->row();
    
    
$nights = $arrivals->number_of_nights;

if (str_starts_with($arrivals->enquiry_no, 'C')) {
    $nights = $cmb_nght->no_of_nights ?? $arrivals->number_of_nights;
}
    
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
  
      .bg-light-back {
        background-color: #ebebeb !important
    }

    .remove-border {
        background-color: #bfbfbf !important
    }
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
  <div class="col-lg-12 text-start logo-left bg-new-file"><img src="'.base_url().'assets/admin/print/images/logo.png" class="mt-2 mb-2 p-2" height="50"></div>
 </div>
 <div class="row" style="margin:0 0px">    
  <div class="col-lg-12">
   <div class="print-head">FILE ARRIVAL DETAILS</div>
  </div>
  
    <table class="tbl-arrivals" style="border:0;">
    <tbody>
    <tr>
    <td class="">
        <div class="field-name text-danger"><strong>File No. : </strong><label class="lab-data">'.$arrivals->enquiry_no.'</label></div>
    </td>
    <td class="">
        <div class="field-name"><strong>Agent Name : </strong><label class="lab-data">'.$arrivals->filename.(($arrivals->agent_reference_num<>'')?" ($arrivals->agent_reference_num)":'').'</label></div>
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
            <div class="field-name"><strong>Number Of Nights : </strong><label class="lab-data">'.$nights.'</label></div>
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
     <tr> 
        <td class="">
            <div class="field-name"><strong>No Of Adults : </strong><label class="lab-data">'.$arrivals->num_adults.'</label></div>
        </td>
        <td class="">
            <div class="field-name"><strong>No Of Child : </strong><label class="lab-data">'.($num_child == 0 ? '0 Child' : $num_child ).'</label></div>
        </td>
        <td class="">
          <div class="field-name"><strong>Child Ages: </strong><label class="lab-data">'.$child_ages.'</label></div>
        </td>
    </tr>
    
</tbody>
  </table>';

  if(!empty($arrival_hotel_details)){
  $html .= '
  <table class="table">
    <thead>
    <tr>
      <th colspan="6" class="bg-secondary">
      <strong class="text-white">Hotel Details</strong>';
      if(empty($arrival_room)){
        //$html .= ' <strong class="text-danger" style="background-color: #FFF;padding: 3px 8px;">&nbsp;(Booked Directly By Guest)&nbsp;</strong>';
      }
    $html .= '</th>
    </tr>
    <tr>
      <th class="bg-warning" width="40px"><strong class="text-white">S.No.</strong></th>
      <th class="bg-warning"><strong class="text-white">Hotel</strong></th>
      <th class="bg-warning"><strong class="text-white">Address</strong></th>
      <th class="bg-warning"><strong class="text-white">Check In</strong></th>
      <th class="bg-warning"><strong class="text-white">Check Out</strong></th>
      <th class="bg-warning"><strong class="text-white">Booking Status</strong></th>
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
      <td class="bg-white">'.(($list->arrival_room_details_id!='')?'Booked By Kazin':'<strong class="text-danger">Booked Directly By Guest</strong>').'</td>
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
            <th colspan="5" class="bg-secondary">
            <strong class="text-white">Flight Details: </strong>
            <strong class="text-white" style="background-color:#e90606;">Arrivals</strong>
            </th>
        </tr>
		<tr>
            <th class="bg-warning"><strong class="text-white">S.No.</strong></th>
            <th class="bg-warning"><strong class="text-white">Airline</strong></th>
            <th class="bg-warning"><strong class="text-white">Departure</strong></th>
            <th class="bg-warning"><strong class="text-white">Arrival</strong></th>
            <th class="bg-warning"><strong class="text-white">No. of Persons</strong></th>                    
		</tr>
	  </thead>
	  <tbody>';
              $i=0;
	            foreach($arrival_flight AS $list){
                if($list->flight_mode == 'inbound'){
            $html.='<tr style="border-bottom: 1px solid #000;">
                    <td class="bg-white">'.++$i.'</td>
                    <td class="bg-white" style="">'.$list->name.'('.$list->flight_number.')</td>
                    <td class="bg-white">'.$list->departure_city.' '.date('d, M Y',strtotime($list->departure_date)).'('.$list->departure_time.')</td>
                    <td class="bg-white"><strong style="color:#e90606;">'.$list->arrival_city.' '.date('d, M Y',strtotime($list->arrival_date)).'('.$list->arrival_time.')</strong></td>
                    <td class="bg-white">'.$list->number_persons.'</td>                    
                </tr>'; }}
	$html.='</tbody>
	</table>';   

  $html .= '
	<table class="table">
	  <thead>
          <tr>
            <th colspan="5" class="bg-secondary">
            <strong class="text-white">Flight Details: </strong>
            <strong class="text-white" style="background-color:#e90606;">Departures</strong>
            </th>
        </tr>
		<tr>
                    <th class="bg-warning"><strong class="text-white">S.No.</strong></th>
                    <th class="bg-warning"><strong class="text-white">Airline</strong></th>
                    <th class="bg-warning"><strong class="text-white">Departure</strong></th>
                    <th class="bg-warning"><strong class="text-white">Arrival</strong></th>
                    <th class="bg-warning"><strong class="text-white">No. of Persons</strong></th>
		</tr>
	  </thead>
	  <tbody>';
              $i=0;
	            foreach($arrival_flight AS $list){
                if($list->flight_mode == 'outbound'){
            $html.='<tr style="border-bottom: 1px solid #000;">
                    <td class="bg-white">'.++$i.'</td>
                    <td class="bg-white" style="">'.$list->name.'('.$list->flight_number.')</td>
                    <td class="bg-white"><strong style="color:#e90606;">'.$list->departure_city.' '.date('d, M Y',strtotime($list->departure_date)).'('.$list->departure_time.')</strong></td>
                    <td class="bg-white">'.$list->arrival_city.' '.date('d, M Y',strtotime($list->arrival_date)).'('.$list->arrival_time.')</td>
                    <td class="bg-white">'.$list->number_persons.'</td>
                </tr>'; }}
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
                <td class="bg-white">'.$list->time.' Hrs</td>
                <td class="bg-white">'.(($list->title<>'')?urldecode($list->title):urldecode($list->content)).'</td>
                <td class="bg-white">'.urldecode($list->remarks).'</td>
            </tr>';
            $itinerary_date = $list->date;
            if(!array_key_exists($i+1,$itinerary) || $itinerary_date != $itinerary[$i+1]->date){
        $html.='</tbody>
        </table>'; }$i++; }
        
    }
	
	
$trans_tr_1 = $trans_tr_2 = '';
	if($arrivals->vehicle_name<>''){ 
	
	$trans_tr_1 = '<tr style="border-bottom: 1px solid #000;">
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
<td class="bg-white">
	<div class="field-name">Luggage Vehicle: <label class="lab-data">'.ucfirst($arrivals->luggage_vehicle).'</label></div>
  </td>

</tr>';

	}
	 if(!empty($data_transportation)){
            foreach($data_transportation AS $list){

	$trans_tr_2 .='
  <tr style="border-bottom: 1px solid #000;border-top: 1px solid #000;">
    <td class="bg-white">
	<div class="field-name">Name : <label class="lab-data">'.$list->vehicle_name.' X '.$list->quantity.'</label></div>
   </td>
  
  <td class="bg-white">
	<div class="field-name">Vehicle Type : <label class="lab-data">'.$list->vehicle_type.'</label></div>
   </td>
  
  <td class="bg-white">
	<div class="field-name">Capacity: <label class="lab-data">'.$list->capacity.'</label></div>
  </td>
</tr>
<tr>
<td class="bg-white">
	<div class="field-name">Luggage Vehicle: <label class="lab-data">'.ucfirst($list->luggage_transport).'</label></div>
  </td>

</tr>
<td class="bg-white">
	<div class="field-name">City: <label class="lab-data">'.ucfirst($list->city).'</label></div>
  </td>

</tr>
';
	}}

  $html.='<table class="table table-bordered">';
    $html.='<thead>';
    $html.='<tr>';
    $html.='<th colspan="4" class="bg-secondary">';
    $html.='<strong class="text-white">Driver Details</strong>';
    $html.='</th>';
    $html.='</tr></thead>';
    
    if (!empty($data_drivers)) :
    
    $html.='<tbody>';
        $html.='<tr><td>Driver Name :</td>';
        $html.='<td>'.htmlspecialchars($data_drivers[0]->driver_name, ENT_QUOTES, 'UTF-8').'</td>';
        $html.='<td>Driver Phone Number :</td>';
        $html.='<td>'.htmlspecialchars($data_drivers[0]->driver_phone_number, ENT_QUOTES, 'UTF-8').'</td>';
    $html.='</tr></tbody></table>';
            
    else:
            $html.='<tr>';
                $html.='<td colspan="4" style="text-align: center;color: #fda2a2;">No driver details.</td>';
            $html.='</tr></table>';
   endif;
	 
	if($trans_tr_1 <>'' || $trans_tr_2 <>''){
			 
	$html.='<table class="table">
		<thead>
		 <tr>
		  <th colspan="3" class="bg-secondary">
		  <strong class="text-white">Transportation Details</strong>
		  </th>
		</tr>'.$trans_tr_1.$trans_tr_2.
	'</thead>
	</table>';
		
		
	} 

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
</tr>';
if(!empty($data_guides)){
	$html .='<tr style="border-top: 1px solid #000;">
<td class="bg-white" colspan="3">
	<div class="field-name">Other Guides : <label class="lab-data">';
	$arr=[]; foreach ($data_guides as $guide){
                $arr[] = ucfirst($guide->name);
	}
    $guide_name=implode(', ',$arr);
	
	$html .=$guide_name.'</label></div>
</td>

</tr>';
}

$html.='</thead>
</table>';
    } else if($arrivals->guide_id == '0' && !empty($data_guides)){
  $html.='<table class="table table-bordered">
    <thead>
     <tr>
      <th colspan="3" class="bg-secondary">
      <strong class="text-white">Guide Details</strong>
      </th>
    </tr>  
    <tr style="border-bottom: 1px solid #000;">
      <td rowspan="2" class="bg-white">';
    $img = ($data_guides[0]->photo<>'')?base_url().'assets/guide/'.trim($data_guides[0]->photo):base_url().'assets/admin/images/no-image-icon.png';
    $html.='<img src="'.$img.'" width=75 height=75 class="fluid mt-2">
      </td>
    <td class="bg-white">
        <div class="field-name">Guide Name : <label class="lab-data">'.$data_guides[0]->name.'</label></div>
                       
    </td>
  <td class="bg-white">
  <div class="field-name">Location : <label class="lab-data">'.$data_guides[0]->location.'</label></div>
  </td>
</tr>
<tr>
<td class="bg-white">
	<div class="field-name">Gender : <label class="lab-data">'.ucfirst($data_guides[0]->gender).'</label></div>
</td>
<td class="bg-white">
  <div class="field-name">Ph No.: <label class="lab-data">'.$data_guides[0]->isd_codes.'-'.$data_guides[0]->contact_number.'</label></div>
</td>
</tr>';
if(!empty($data_guides)){
	$html .='<tr style="border-top: 1px solid #000;">
<td class="bg-white" colspan="3">
	<div class="field-name">Other Guides : <label class="lab-data">';
	$arr=[]; foreach ($data_guides as $key=>$guide){
		if($key>0){
                $arr[] = ucfirst($guide->name);
		}
	}
    $guide_name=implode(', ',$arr);
	
	$html .=$guide_name.'</label></div>
</td>

</tr>';
}

$html.='</thead>
</table>';
    }
	else {
        $html.='<table class="" style="padding:4px;">';
        $html.='<thead><tr><th class="bg-secondary"><strong class="text-white">Guide Details</strong></th></tr></thead>';
        $html.='<tbody><tr><td style="text-align: center;color: #fda2a2;">No Guide</td></tr></tbody></table>';
    }

    
    if(!empty($arrival_room)){
        $first_character = substr($arrivals->enquiry_no, 0, 1);
        $html.='<table class="table table-bordered mt-3">
    <thead>
     <tr>
      <th colspan="11" class="bg-secondary">
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
      <th class="bg-warning"><strong class="text-white">Confirmation No.</strong></th>';
      if(trim($first_character) == 'G'){
        $html .='<th class="bg-warning"><strong class="text-white">No. Of Rooms</strong></th>';
      }
      $html .='<th class="bg-warning"><strong class="text-white">Person Details</strong></th>
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
        <td class="bg-white">'.$list->hotel_confirmation_num.'</td>';
        if(trim($first_character) == 'G'){
          $html .='<td class="bg-white">'.$list->number_of_rooms.'</td>';
        }
        $html .='<td class="bg-white">'.(isset($list->persons_details)?$list->persons_details:'<strong>Lead: </strong>'.$arrivals->lead_name).'</td>
        <td class="bg-white">'.ucfirst($list->breakfast).'</td></tr>';
        }
        $html.='</tbody>
  </table>';
    }
    
if (!empty($restaurant_menus)) {
  $html .= '
  <table class="table">
    <thead>
    <tr>
      <th colspan="14" class="bg-secondary">
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
      <th class="bg-warning"><strong class="text-white">No. Of Non Jain Meal </strong></th>
      <th class="bg-warning"><strong class="text-white">Meal Type</strong></th>
    </tr>
    </thead>
    <tbody>';
  $i = 0;
  $prev_date = null;
  foreach ($restaurant_menus as $list) {
    // Check if the date has changed
    $current_date = date('d-M-Y', strtotime($list->date));
    if ($current_date != $prev_date && $prev_date !== null) {
      // If date changed, add a row with white background
      $html.='<tr class="remove-border"><td colspan="14" ></td></tr>';
    }
    $prev_date = $current_date;

    $html .= '<tr style="border-bottom: 1px solid #000; border-top: 1px solid #000;">
      <td class="bg-white">' . ++$i . '</td>
      <td class="bg-white">' . $current_date . '</td>
      <td class="bg-white">' . $list->buffet . (($list->packed == 1)?'<br>(Packed)':''). '</td>
      <td class="bg-white">' . ucfirst($list->name).'</td>
      <td class="bg-white">' . $list->restaurant_address . '</td>
      <td class="bg-white">' . $list->opening_time . '</td> 
      <td class="bg-white">' . $list->closing_time . '</td>
      <td class="bg-white">' . $list->no_of_person . '</td>
      <td class="bg-white">' . $list->no_of_veg_person . '</td>
      <td class="bg-white">' . $list->no_of_non_veg_person . '</td>
      <td class="bg-white">' . $list->no_of_vegan_person . '</td>
      <td class="bg-white">' . $list->no_of_jain_meal . '</td>
       <td class="bg-white">' . $list->meals . '</td>
    </tr>';
    $count = 0;
    $total_menu_types = count($list->menu_cuisine_map);

    $html .= '<tr style="border-bottom: 1px solid #000; border-top: 1px solid #000;">

    <tr style="border-bottom: 1px solid #000; border-top: 1px solid #000;">
    <td class="bg-light-back text-center" colspan="3"><strong>Final Remarks</strong></td>
    <td class="bg-light-back text-center" colspan="10"><strong style="color:#18c30e;">' . $list->final_remark . '</strong></td>
    </tr><tr>
    <td class="bg-light-back text-center" colspan="13"><strong>Menus</strong></td></tr>';

    foreach ($list->menu_cuisine_map as $menu_type => $cuisine_items) {
      $count++;

      $html .= '<tr><td class="bg-light-back" colspan="3">
    <strong> ' . ucfirst(str_replace('_', ' ', $menu_type)) . '</strong>
    </td>
    <td class="bg-light-back" colspan="10">' . $cuisine_items . '</td></tr>';
    }
  }
  $html .= '</tbody> </table>';
}
	 
$html.='<table class="tbl-arrivals" style="border:0;padding:4px;">
    <tbody>
    <tr>    
        <td class="" style="">
            <div class="field-name"><strong>Company : </strong><label class="lab-data">'.($company->name ?? '').'</label></div>
        </td>
        <td class="">
            <div class="field-name"><strong>Address : </strong><label class="lab-data">'.($company->address ?? '').'</label></div>
        </td>
    </tr>   
    <tr> 
        <td class="">
            <div class="field-name"><strong>Contact Person : </strong><label class="lab-data">'.($company->person_name ?? '').'</label></div>
        </td>
        <td class="">
            <div class="field-name"><style></style><strong>Contact Mobile : </strong><label class="lab-data">'.($company->contact_number ?? '').'</label></div>
        </td>        
    </tr>      
</tbody>
  </table>';
  
$html .= '<table class="table table-bordered">
    <thead>
     <tr style="border-bottom: 1px solid #000;">
      <th class="bg-secondary">
      <strong class="text-white">Welcome to ' . ($company->country ?? '') . ': A Guide to Respectful Travel</strong>
      </th>
    </tr>
    <tr style="border-bottom: 1px solid #000;">
      <td class="bg-white">As part of our commitment to ensuring a harmonious and enjoyable experience for both our guests and hosts in ' . ($company->country ?? '') . ', we kindly request that all visitors observe the following guidelines to uphold the dignity and cleanliness of the places we are privileged to explore:</td>
    </tr>  
   <tr style="border-bottom: 1px solid #000;">
    <td class="bg-white">
  <div class="field-name"><strong>1. Respect Local Traditions:</strong>
  <label class="lab-data">' . ($company->country ?? '') . ' is a country rich in culture and traditions. Please show respect towards local customs, rituals, and etiquette. A little research or inquiry about local norms can enrich your travel experience and foster mutual respect.</label>
  </div>
  </td>                
   </tr> 
   <tr style="border-bottom: 1px solid #000;">
    <td class="bg-white">
    <div class="field-name"><strong>2. Environmental Responsibility:</strong>
    <label class="lab-data">Please help us keep ' . ($company->country ?? '') . '\'s natural landscapes pristine by disposing of litter in designated bins, recycling when possible, and minimizing your environmental footprint during your stay.</label>
    </div>
                  
  </td>
</tr>
   <tr style="border-bottom: 1px solid #000;">
    <td class="bg-white">
    <div class="field-name"><strong>3. Hygiene Practices:</strong>
    <label class="lab-data">Out of respect for future guests and to maintain the high standards of cleanliness that ' . ($company->country ?? '') . ' is proud of, we urge you to follow hygienic practices in hotels and public spaces. This includes using facilities as intended, being mindful of waste disposal, and maintaining personal cleanliness.</label>
    </div>
   </td>
 </tr>
 <tr style="border-bottom: 1px solid #000;">
   <td class="bg-white">
    <div class="field-name"><strong>4. Interactions with Locals:</strong>
    <label class="lab-data">Warmth and hospitality are at the heart of '.(($company->country=='Kazakhstan')?'Kazakh':($company->country ?? '')).' culture. When interacting with local residents, a respectful and polite demeanor goes a long way. Greetings, gratitude, and a smile can bridge the gap between different languages and cultures.</label>
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
  <label class="lab-data">By following these guidelines, you contribute to a positive atmosphere of mutual respect and understanding between tourists and the local community. Our goal is to create memorable experiences for you that are respectful of the environment, local culture, and traditions of ' . ($company->name ?? '') . '.</label> 
</td>
</tr>
<tr>
<td class="bg-white">
  <label class="lab-data"><strong>Thank you for choosing to explore ' . ($company->country ?? '') . ' with Kazin DMC. Let’s make your visit memorable for all the right reasons.</strong></label> 
</td>
</tr>
</thead>
</table>
</div>';
$html.='</div>
</body>
</html>';
//echo $html;
//exit;
$mpdf->setAutoTopMargin = true;
$mpdf->setAutoBottomMargin = 'stretch';
$mpdf->WriteHTML($html);
$mpdf->Output($arrivals->enquiry_no.'_arrival_details.pdf','D');
