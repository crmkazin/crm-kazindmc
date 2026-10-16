<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title><?php echo $arrivals->enquiry_no; ?> : Arrival Chart</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/admin/print/css/bootstrap.css" rel="stylesheet" type="text/css">
  <link  href="<?php echo base_url(); ?>assets/admin/print/css/style.css" rel="stylesheet">
  
  <script src="<?php echo base_url(); ?>assets/admin/print/js/bootstrap.js"></script>
  <style>
    @media print {
        html { -webkit-print-color-adjust: exact; }
        .print-data {  page-break-after: always; }
        .noPrint{ display:none;  }
    }
  </style>
</head>
<body>    
<div class="container print-data bg-grey" id="cnt-print-data">
 <div class="row">
  <div class="col-lg-4 text-start logo-left bg-new"><img src="<?php echo base_url(); ?>assets/company/<?php echo $arrivals->company_logo; ?>" class="mt-2 mb-2"></div>
  <div class="col-lg-8 bg-new" style="color: #FFF;text-align: right;">
        <div class="field-name"><strong>Contact Name :</strong></div>
        <label class="lab-data"><?php echo $arrivals->contact_person; ?></label>  <br>
        <div class="field-name"><strong>Contact Number :</strong></div>
        <label class="lab-data"><?php echo $arrivals->contact_num; ?></label>  <br>
        <div class="field-name"><strong>Address :</strong></div>
        <label class="lab-data"><?php echo $arrivals->address; ?></label>  
    </div>
 </div>
 <div class="row" style="margin:0 0px ">    
  <div class="col-lg-12">
   <div class="print-head">SERVICE VOUCHER</div>
  </div>
  
  <div class="col-lg-12">
   <div class="in-pl">
	
   </div>
  </div>  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name text-danger"><strong>File No. :</strong></div>
	<label class="lab-data"><?php echo $arrivals->enquiry_no; ?></label>                
   </div>
  </div>
  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name"><strong>Agent Name :</strong></div>
	<label class="lab-data"><?php echo $arrivals->filename; ?></label>                
   </div>
  </div>
  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name ms-9"><strong>Arrival Date</strong></div>
	<label class="lab-data"><?php echo date('d-M-Y',strtotime($arrivals->arrival_date)); ?></label>                
   </div>
  </div>
  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name"><strong>Check in Date :</strong></div>
	<label class="lab-data"><?php echo date('d-M-Y',strtotime($arrivals->check_in_date)); ?></label>                
   </div>
  </div>
  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name"><strong>Check Out Date :</strong></div>
	<label class="lab-data"><?php echo date('d-M-Y',strtotime($arrivals->check_out_date)); ?></label>                
   </div>
  </div>
  
     <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name ms-9" ><strong>Number Of Nights :</strong> </div>
	<label class="lab-data"><?php echo $arrivals->number_of_nights; ?></label>                
   </div>
  </div>
     
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name"><strong>Group Type :</strong></div>
	<label class="lab-data"><?php echo $arrivals->group_type; ?></label>                
   </div>
  </div>
  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name"><strong>Lead Contact :</strong></div>
	<label class="lab-data"><?php echo $arrivals->lead_isd_code;echo $arrivals->lead_contact; ?></label>                
   </div>
  </div>
  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name ms-9"><strong>Handover to other :</strong></div>
	<label class="lab-data"><?php echo ucfirst($arrivals->handover_to_client); ?></label>                
   </div>
  </div>
  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name"><strong>Handover to Kazin :</strong></div>
	<label class="lab-data"><?php echo ucfirst($arrivals->handover_to_kazin); ?></label>                
   </div>
  </div>

  <div class="col-lg-4">
   <div class="in-pl">
  <div class="field-name"><strong>Lead Name :</strong></div>
  <label class="lab-data"><?php echo $arrivals->lead_name; ?></label>                
   </div>
  </div>

  <div class="col-lg-4">
   <div class="in-pl">
  <div class="field-name ms-9"><strong>Status: :</strong></div>
  <label class="lab-data text-success"><?php echo ucfirst($arrivals->status); ?></label>                
   </div>
  </div>
  <?php if(!empty($arrival_hotel_details)){ ?>
  <div class="col-lg-12">
   <div class="in-pl">
  <div class="print-sub-head head-space">Hotel Details</div>               
   </div>
  </div> 

  <div class="col-lg-12">
   <div class="in-pl">
  <table class="table table-bordered">
    <thead>
    <tr>
      <th class="bg-warning" width="40px"><strong class="text-white">S.No.</strong></th>
      <th class="bg-warning"><strong class="text-white">Hotel</strong></th>
      <th class="bg-warning"><strong class="text-white">Address</strong></th>
      <th class="bg-warning"><strong class="text-white">Check In</strong></th>
      <th class="bg-warning"><strong class="text-white">Check Out</strong></th>
    </tr>
    </thead>
    <tbody>
        <?php $i=0; 
                foreach($arrival_hotel_details AS $list){
          ?>
        <tr>
          <td class="bg-white"><?php echo ++$i; ?></td>
          <td class="bg-white"><?php echo $list->hotel; ?></td>
        <td class="bg-white"><?php echo $list->address_1; echo ", "; echo $list->address_2;echo ", "; echo $list->city;echo ", "; echo $list->state; ?></td>
          <td class="bg-white"><?php echo date('d-M-Y',strtotime($list->checkin_date)); ?></td>
          <td class="bg-white"><?php echo date('d-M-Y',strtotime($list->checkout_date)); ?></td>
        </tr>
                <?php } ?>
    </tbody>
  </table>                
   </div>
  </div>   
  <?php } ?>
  
     <?php if(!empty($arrival_flight)){ ?>
<div class="col-lg-12">
   <div class="in-pl">
	<div class="print-sub-head head-space">Flight Details</div>               
   </div>
  </div> 
  
  <div class="col-lg-12">
   <div class="in-pl">
	<table class="table table-bordered">
	  <thead>
		<tr>
		  <th class="bg-warning"><strong class="text-white">S.No.</strong></th>
      <th class="bg-warning"><strong class="text-white">Airline</strong></th>
      <th class="bg-warning"><strong class="text-white">Departure</strong></th>
      <th class="bg-warning"><strong class="text-white">Arrival</strong></th>
      <th class="bg-warning"><strong class="text-white">No. of Persons</strong></th>
      <th class="bg-warning"><strong class="text-white">Flight Mode</strong></th>
		</tr>
	  </thead>
	  <tbody>
              <?php $i=0;
	            foreach($arrival_flight AS $list){
	      ?>
		<tr>
                    <td class="bg-white"><?php echo ++$i; ?></td>
                    <td class="bg-white"><?php echo $list->name; ?> (<?php echo $list->flight_number; ?>)</td>
                    <td class="bg-white"><?php echo $list->departure_city; ?> <?php echo date('d, M Y',strtotime($list->departure_date)).'('.$list->departure_time.')'; ?></td>
                    <td class="bg-white"><?php echo $list->arrival_city; ?> <?php echo date('d, M Y',strtotime($list->arrival_date)).'('.$list->arrival_time.')'; ?></td>
                    <td class="bg-white"><?php echo $list->number_persons; ?></td>
                    <td class="bg-white"><?php echo ucfirst($list->flight_mode); ?></td>
                </tr>
		<?php } ?>
	  </tbody>
	</table>                
   </div>
  </div>   
     <?php } ?>
     
    <?php if(!empty($itinerary)){ ?>
  <div class="col-lg-12 head-space">
   <div class="in-pl">
	<div class="print-sub-head">Itinerary</div>               
   </div>
  </div>
  <div class="col-md-12 mt-2">
      <div class="in-pl">
      <?php 
                $i = 0;
                $itinerary_date = $itinerary[0];
                foreach($itinerary AS $list){ 
                    if($i==0 || $itinerary_date != $list->date){
                        $sr = 0;
                    ?>
           <table class="table table-bordered">
                <thead>
                    <tr>
                      <th colspan="4" class="bg-warning">
                      <strong class="ms-3 text-white"><?php echo date('d M Y (l)',strtotime($list->date)); ?></strong>
                      </th>
                    </tr>
                    <tr>
                      <th class="fadetbl" width="10%"><p class="text-black">Time</p></th>
                      <th class="fadetbl" width="50%"><p class="text-black">Activities</p></th>
                      <th class="fadetbl" width="25%"><p class="text-black">Remark</p></th>
                    </tr>
                </thead> <tbody>     
      <?php } ?>
                    
            <tr>
                
                <td class="bg-white"><?php echo $list->time;  ?> Hrs</td>
                <td class="bg-white"><?php echo urldecode($list->title).' '.urldecode($list->content); ?></td>
                <td class="bg-white"><?php echo $list->remarks; ?></td>
            </tr>         
             
      <?php 
            $itinerary_date = $list->date;
            if(!array_key_exists($i+1,$itinerary) || $itinerary_date != $itinerary[$i+1]->date){ ?>
            </tbody>
        </table>
            <?php }$i++; }   ?>
        </div>
     </div>
    <?php }  ?>
  
  <div class="col-lg-12 head-space">
   <div class="in-pl">
	<div class="print-sub-head">Transportation Details</div>               
   </div>
  </div>  
     <?php if($arrivals->vehicle_name<>''){ ?>
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">Name : </div>
	<label class="lab-data"><?php echo $arrivals->vehicle_name; ?></label>                
   </div>
  </div>
  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">Vehicle Type : </div>
	<label class="lab-data"><?php echo $arrivals->vehicle_type; ?></label>                
   </div>
  </div>
  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">Capacity: </div>
	<label class="lab-data"><?php echo $arrivals->capacity; ?></label>                
   </div>
  </div>

  <div class="col-lg-4">
   <div class="in-pl">
  <div class="field-name">Remarks: </div>
  <label class="lab-data"><?php echo $arrivals->remarks; ?></label>                
   </div>
  </div>
  <?php } 
        if(!empty($data_transportation)){
            foreach($data_transportation AS $list){
    ?><div class="clearfix"></div>
     <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">Name : </div>
	<label class="lab-data"><?php echo $list->vehicle_name; ?> X <?php echo $list->quantity; ?></label>                
   </div>
  </div>
  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">Vehicle Type : </div>
	<label class="lab-data"><?php echo $list->vehicle_type; ?></label>                
   </div>
  </div>
  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">Capacity: </div>
	<label class="lab-data"><?php echo $list->capacity; ?></label>                
   </div>
  </div>

  <div class="col-lg-4">
   <div class="in-pl">
  <div class="field-name">Remarks: </div>
  <label class="lab-data"><?php echo $list->remarks; ?></label>                
   </div>
  </div>
    <?php }}
    if($arrivals->vehicle_name == '' && empty($data_transportation)){
    ?>
    <div class="col-lg-12">
        <p style="text-align: center;color: #fda2a2;">No Transportation Details</p>
    </div>
    <?php } ?>
     
     
            <div class="col-lg-12 head-space">
                <div class="in-pl">
                    <div class="print-sub-head">Guide Details</div>
                </div>
            </div>
            <?php if ($arrivals->guide_id != '0') { ?>
            <div class="col-lg-4">
                <div class="in-pl">
                    <img src="<?php echo ($arrivals->photo <> '') ? base_url('assets/guide/' . $arrivals->photo) : base_url('assets/admin/images/no-image-icon.png'); ?>"
                        width="75" height="75" class=" fluid mt-2">
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name">Guide Name : </div>
                    <label class="lab-data"><?php echo $arrivals->guide; ?></label>
                </div>
                <div class="in-pl">
                    <div class="field-name">Location : </div>
                    <label class="lab-data"><?php echo $arrivals->location; ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name">Gender : </div>
                    <label class="lab-data"><?php echo ucfirst($arrivals->gender); ?></label>
                </div>
                <div class="in-pl">
                    <div class="field-name">Ph No.: </div>
                    <label
                        class="lab-data"><?php echo $arrivals->isd_codes . '-' . $arrivals->contact_number; ?></label>
                </div>
            </div>

            <div class="col-lg-12">
                <label class="lab-data"> Other Guides : </label>
                <?php if(!empty($data_guides)){ $arr=[]; foreach ($data_guides as $guide): ?>
                <?php $arr[] = ucfirst($guide->name); ?>
                <?php endforeach;
                echo implode(', ',$arr); 
                } ?>
            </div>
            <?php } else if ($arrivals->guide_id == '0' && !empty($data_guides)) { ?>
            <div class="col-lg-4">
                <div class="in-pl">
                    <img src="<?php echo ($data_guides[0]->photo <> '') ? base_url('assets/guide/' . $data_guides[0]->photo) : base_url('assets/admin/images/no-image-icon.png'); ?>"
                        width="75" height="75" class=" fluid mt-2">
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name">Guide Name : </div>
                    <label class="lab-data"><?php echo $data_guides[0]->name; ?></label>
                </div>
                <div class="in-pl">
                    <div class="field-name">Location : </div>
                    <label class="lab-data"><?php echo $data_guides[0]->location; ?></label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="in-pl">
                    <div class="field-name">Gender : </div>
                    <label class="lab-data"><?php echo ucfirst($data_guides[0]->gender); ?></label>
                </div>
                <div class="in-pl">
                    <div class="field-name">Ph No.: </div>
                    <label
                        class="lab-data"><?php echo $data_guides[0]->isd_codes . '-' . $data_guides[0]->contact_number; ?></label>
                </div>
            </div>
            <div class="col-lg-12">
                <label class="lab-data"> Other Guides : </label>
                <?php
                  foreach ($data_guides as $key => $guide) {
                     if ($key > 0) {
                        $arr[] = ucfirst($guide->name);
                     }
                  }
                  if(!empty($arr)){ echo implode(', ',$arr); }
                  ?>
            </div>
            <?php } else { ?>
            <div class="col-lg-12">
                <p style="text-align: center;color: #fda2a2;">No Guide</p>
            </div>
            <?php } ?>
    
   <?php if(!empty($arrival_room)){ ?> 
  <div class="col-lg-12 head-space">
   <div class="in-pl">
  <div class="print-sub-head">Room Confirmation</div>               
   </div>
  </div>
  <div class="col-lg-12">
   <div class="in-pl">
  <table class="table table-bordered">
    <thead>
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
    <tbody>
    <?php $i=0; 
        foreach($arrival_room AS $list){
    ?>
    <tr>
        <td class="bg-white"><?php echo ++$i; ?></td>
        <td class="bg-white"><?php echo $list->hotel; ?></td>
        <td class="bg-white"><?php echo date('d-M-Y',strtotime($list->checkin_date)); ?></td>
        <td class="bg-white"><?php echo date('d-M-Y',strtotime($list->checkout_date)); ?></td>
        <td class="bg-white"><?php echo ucfirst($list->category); ?></td>
        <td class="bg-white"><?php echo $list->number_adults; ?></td>
        <td class="bg-white"><?php echo $list->number_child; ?></td>
        <td class="bg-white"><?php echo $list->hotel_confirmation_num; ?></td>
        <td class="bg-white"><?php echo $list->persons_details; ?></td>
        <td class="bg-white"><?php echo ucfirst($list->breakfast); ?></td>
    </tr>
    <?php } ?>
    </tbody>
  </table>                
   </div>
  </div>   
   <?php } ?>
   
   
               <!-- Restaurant Menu -->

         <div class="col-lg-12 head-space">
            <div class="in-pl">
               <div class="print-sub-head">Restaurant Bookings</div>
            </div>
         </div>

         <?php if (!empty($restaurant_menus)) { ?>

            <div class="col-lg-12">
               <div class="in-pl">
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th class="bg-warning"><strong class="text-white">S.No.</strong></th>
                           <th class="bg-warning"><strong class="text-white">Date</strong></th>
                           <th class="bg-warning"><strong class="text-white">Buffet</strong></th>
                           <th class="bg-warning"><strong class="text-white">Restaurant</strong></th>
                           <th class="bg-warning"><strong class="text-white">Restaurant Address</strong></th>
                           <th class="bg-warning"><strong class="text-white">Start Time</strong></th>
                           <th class="bg-warning"><strong class="text-white">End Time</strong></th>
                           <th class="bg-warning"><strong class="text-white">Total Person</strong></th>
                           <th class="bg-warning"><strong class="text-white">No. Of Veg Person</strong></th>
                           <th class="bg-warning"><strong class="text-white">No. Of Non Veg Person</strong></th>
                           <th class="bg-warning"><strong class="text-white">No. Of Vegan Person</strong></th>
                           <th class="bg-warning"><strong class="text-white">No. Of Jain Meal</strong></th>
                           <th class="bg-warning"><strong class="text-white">Meal Type</strong></th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $i = 0;
                        foreach ($restaurant_menus as $menu) {
                           ?>
                           <tr>
                              <td class="bg-white"><?php echo ++$i; ?></td>
                              <td class="bg-white"><?php echo date('d-M-Y', strtotime($menu->date)); ?></td>
                              <td class="bg-white"><?php echo $menu->buffet; ?></td>
                              <td class="bg-white"><?php echo ucfirst($menu->name); ?></td>
                              <td class="bg-white">
                                 <?php echo ucfirst($menu->r_city) . ',
                                 ' . ucfirst($menu->r_country) ?>
                              </td>
                              <td class="bg-white"><?php echo $menu->opening_time; ?></td>
                              <td class="bg-white"><?php echo $menu->closing_time; ?></td>
                              <td class="bg-white"><?php echo $menu->no_of_person; ?></td>
                              <td class="bg-white"><?php echo $menu->no_of_veg_person; ?></td>
                              <td class="bg-white"><?php echo $menu->no_of_non_veg_person; ?></td>
                              <td class="bg-white"><?php echo $menu->no_of_vegan_person; ?></td>
                              <td class="bg-white"><?php echo $menu->no_of_jain_meal; ?></td>
                              <td class="bg-white"><?php echo $menu->meals; ?></td>
                           </tr>
                           <tr>
                              <td class="bg-white"></td>
                              <?php
                              $count = 0;
                              $total_menu_types = count($menu->menu_cuisine_map);
                              foreach ($menu->menu_cuisine_map as $menu_type => $cuisine_items) {
                                 $count++;
                                 ?>
                                 <th class="bg-white"><?php echo ucfirst(str_replace('_', ' ', $menu_type)); ?></th>
                                 <?php
                                 // Check if it's the 4th iteration or the last iteration
                                 if ($count === 4 || $count === $total_menu_types) {
                                    // Calculate the colspan dynamically
                                    $remaining_cols = 13 - ($count - 1) * 2;
                                    ?>
                                    <td class="bg-white" colspan="<?php echo $remaining_cols; ?>">
                                       <?= $cuisine_items ?>
                                    </td>
                                    <?php
                                 } else {
                                    ?>
                                    <td class="bg-white"><?= $cuisine_items ?></td>
                                    <?php
                                 }
                                 // Check if count is a multiple of 4 and if there are more items in the array
                                 if ($count % 4 == 0 && $count < $total_menu_types) {
                                    echo '</tr><tr colspan="' . $remaining_cols . '"><td class="bg-white"></td>'; // Close the current row and start a new row with colspan
                                 }
                              }
                              ?>
                           </tr>

                        <?php } ?>
                     </tbody>
                  </table>
               </div>
            </div>
         <?php } else { ?>
            <div class="col-lg-12">
               <p style="text-align: center;color: #fda2a2;">No Restaurant Menu</p>
            </div>
         <?php } ?>   
<!-- partial -->
 </div> 
    <div class="row" style="margin:0 30px ">
    <div class="footer col-lg-12" style="margin-top: 50px;margin-bottom: 10px;bottom: 0;">
        <hr>
        <div class="row p-3">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-3 mb-2"><label class="field-name">Company</label></div>
                    <div class="col-lg-9 mb-2"><label class="lab-data" > <?php echo $company->name; ?> </label></div>
                    <div class="col-lg-3"><label class="field-name">Address</label></div>
                    <div class="col-lg-9"><label class="lab-data" > <?php echo $company->address; ?> </label></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-4 mb-2"><label class="field-name">Contact Person</label></div>
                    <div class="col-lg-8 mb-2"><label class="lab-data" > <?php echo $company->person_name; ?> </label> </div>
                    <div class="col-lg-4"><label class="field-name">Contact Mobile</label></div>
                    <div class="col-lg-8"><label class="lab-data" > <?php echo $company->contact_number; ?> </label> </div>
                </div>
            </div>
            <!--<div class="col-lg-12 text-center mt-3"><label class="field-name"><?php echo $company->country; ?></label></div>-->
            
        </div>
    </div>
        </div>
     <?php if($company->country=="Kazakhstan") { ?>
    
  
    
    <div class="row" style="margin:0 30px ">
   <div class="print-sub-head head-space ms-2">Welcome to Kazakhstan: A Guide to Respectful Travel</div>
   <p>As part of our commitment to ensuring a harmonious and enjoyable experience for both our guests and hosts in Kazakhstan, we kindly request that all visitors observe the following guidelines to uphold the dignity and cleanliness of the places we are privileged to explore:</p>
   <div class="col-lg-12 mt-1">
   <div class="in-pl">
  <div class="field-name"><strong>1. Respect Local Traditions:</strong></div>
  <label class="lab-data">Kazakhstan is a country rich in culture and traditions. Please show respect towards local customs, rituals, and etiquette. A little research or inquiry about local norms can enrich your travel experience and foster mutual respect.</label>                
   </div> 
   </div>  
   <div class="col-lg-12 mt-1">
   <div class="in-pl">
  <div class="field-name"><strong>2. Environmental Responsibility:</strong></div>
  <label class="lab-data">Please help us keep Kazakhstan's natural landscapes pristine by disposing of litter in designated bins, recycling when possible, and minimizing your environmental footprint during your stay.</label>                
   </div>   
 </div>
   <div class="col-lg-12 mt-1">
   <div class="in-pl">
  <div class="field-name"><strong>3. Hygiene Practices:</strong></div>
  <label class="lab-data">Out of respect for future guests and to maintain the high standards of cleanliness that Kazakhstan is proud of, we urge you to follow hygienic practices in hotels and public spaces. This includes using facilities as intended, being mindful of waste disposal, and maintaining personal cleanliness.</label>                
   </div>   
 </div>
   <div class="col-lg-12 mt-1">
   <div class="in-pl">
  <div class="field-name"><strong>4. Interactions with Locals:</strong></div>
  <label class="lab-data">Warmth and hospitality are at the heart of Kazakh culture. When interacting with local residents, a respectful and polite demeanor goes a long way. Greetings, gratitude, and a smile can bridge the gap between different languages and cultures.</label>                
   </div>  
   </div> 
   <div class="col-lg-12 mt-1">
   <div class="in-pl">
  <div class="field-name"><strong>5. Adherence to Hotel Policies:</strong></div>
  <label class="lab-data"> Each hotel and accommodation has its own set of rules designed to ensure the comfort and safety of all guests. We ask that you familiarize yourself with and adhere to these policies throughout your stay.</label>                
   </div> 
   </div>
   <div class="col-lg-12"> 
  <label class="lab-data">By following these guidelines, you contribute to a positive atmosphere of mutual respect and understanding between tourists and the local community. Our goal is to create memorable experiences for you that are respectful of the environment, local culture, and traditions of Kazakhstan.</label> 
</div>
<div class="col-lg-12 mt-2 mb-4"> 
  <label class="lab-data"><strong>Thank you for choosing to explore Kazakhstan with Kazin DMC. Let’s make your visit memorable for all the right reasons.</strong></label> 
</div>
</div>

  <?php } ?>
    </div> 
</body>

<br>
    <div class="content row noPrint">
        <div class="col-md-12 text-center">
            <button class="btn btn-primary btn-sm" onclick="window.print();">Print</button>
            <button class="btn btn-warning btn-sm" onclick="window.open('<?php echo base_url('print_service_voucher?id='. base64_encode($arrivals->id).'&print=pdf'); ?>','_blank')">Save As Pdf</button>
            <!--button class="btn btn-success btn-sm" onclick="exportHTMLToDoc()">Save As Doc</button-->
        </div>
    </div>
    <br>

</html>
<script>
    function exportHTMLToDoc(){
       var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
            "xmlns:w='urn:schemas-microsoft-com:office:word' "+
            "xmlns='http://www.w3.org/TR/REC-html40'>"+
            "<head><meta charset='utf-8'><title>"+'<?php echo $arrivals->enquiry_no; ?>'+"</title></head><body>";
       var footer = "</body></html>";
       var sourceHTML = header+document.getElementById("cnt-print-data").innerHTML+footer;
       
       var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
       var fileDownload = document.createElement("a");
       document.body.appendChild(fileDownload);
       fileDownload.href = source;
       fileDownload.download = '<?php echo $arrivals->enquiry_no.'_service_voucher'; ?>.doc';
       fileDownload.click();
       document.body.removeChild(fileDownload);
    }
    
</script>