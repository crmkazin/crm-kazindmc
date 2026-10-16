<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title><?php echo $arrivals->enquiry_no; ?> : Arrival Chart</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <!--link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700&display=swap" rel="stylesheet"-->
  <link href="<?php echo base_url(); ?>assets/admin/print/css/bootstrap.css" rel="stylesheet" type="text/css">
  <link  href="<?php echo base_url(); ?>assets/admin/print/css/style.css" rel="stylesheet">
  
  <script src="<?php echo base_url(); ?>assets/admin/print/js/bootstrap.js"></script>
  <style>
      ul.timeline, ul.timeline_new {
    list-style-type: none;
    position: relative;
}
ul.timeline:before, ul.timeline_new:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 1px;
    height: 100%;
    z-index: 400;
}
ul.timeline > li,ul.timeline_new > li {
    margin: 20px 0;
    padding-left: 45px;
    text-align: justify;
    font-style: italic;
}
ul.timeline > li:before,ul.timeline_new > li:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 1px solid #22c0e8;
    left: 20px;
    width: 20px;
    height: 20px;
    z-index: 400;
}
div.info > div { border: 1px solid #efecec; }
.lbl-bold { font-weight:600!important; }
@media print {
    html { -webkit-print-color-adjust: exact; }
}
  </style>
</head>
<body>    

<div class="container print-data">
 <div class="row">
  <div class="col-lg-12 text-start logo-left"><img src="<?php echo base_url(); ?>assets/admin/print/images/logo.png"></div>
 </div>
 
 <div class="row" style="margin:0 30px ">    
  <div class="col-lg-12">
   <div class="print-head">ARRIVAL CHART</div>
  </div>
  
  <div class="col-lg-12 pb-4 mb-2">
   <div class="in-pl">
	<!--div class="print-sub-head">Booking Details</div-->
	<div class="float-right normal-size"><strong>Status:</strong><?php echo ucfirst($arrivals->status); ?></div>
   </div>
  </div>
  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">File No. : </div>
	<label class="lab-data"><?php echo $arrivals->enquiry_no; ?></label>                
   </div>
  </div>
  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">Agent Name : </div>
	<label class="lab-data"><?php echo $arrivals->filename; ?></label>                
   </div>
  </div>
  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">Arrival Date : </div>
	<label class="lab-data"><?php echo date('d-M-Y',strtotime($arrivals->arrival_date)); ?></label>   
   </div>
  </div>
  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">Check in Date : </div>
	<label class="lab-data"><?php echo date('d-M-Y',strtotime($arrivals->check_in_date)); ?></label>                
   </div>
  </div>
  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">Check Out Date : </div>
	<label class="lab-data"><?php echo date('d-M-Y',strtotime($arrivals->check_out_date)); ?></label>                
   </div>
  </div>
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">Number Of Nights : </div>
	<label class="lab-data"><?php echo $arrivals->number_of_nights; ?></label>                
   </div>
  </div>
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">Group Type : </div>
	<label class="lab-data"><?php echo $arrivals->group_type; ?></label>                
   </div>
  </div>
  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">Hotel : </div>
	<label class="lab-data"><?php echo $arrivals->hotel_name; ?></label>                
   </div>
  </div>
  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">Hotel Address : </div>
	<label class="lab-data"><?php echo $arrivals->address_1.', '.$arrivals->address_2; ?></label>                
   </div>
  </div>
  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">Lead Name : </div>
	<label class="lab-data"><?php echo $arrivals->lead_name; ?></label>                
   </div>
  </div>
  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">Lead Contact : </div>
	<label class="lab-data"><?php echo $arrivals->lead_contact; ?></label>                
   </div>
  </div>
  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">Handover to other : </div>
	<label class="lab-data"><?php echo ucfirst($arrivals->handover_to_client); ?></label>                
   </div>
  </div>
  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">Handover to Kazin : </div>
	<label class="lab-data"><?php echo ucfirst($arrivals->handover_to_kazin); ?></label>                
   </div>
  </div>
  
  <!--div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">Lead Photo : <br><br><img src="<?php //echo base_url('uploads/lead_photo/'.$arrivals->lead_photo) ; ?>" height="75" width="75"></div>
   </div>
  </div-->
  
  <!--div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">Booking Type : </div>
	<label class="lab-data"><?php //echo $arrivals->enquiry_abbr; ?></label>                
   </div>
  </div-->

  <div class="col-lg-12 head-space">
   <div class="in-pl">
	<div class="print-sub-head">Flight Details</div>               
   </div>
  </div>
  <?php if(!empty($arrival_flight)){ ?>
  <div class="col-lg-12">
   <div class="in-pl">
	<table class="table table-bordered">
	  <thead>
		<tr>
		  <th scope="col" width="40px">SN</th>
		  <th scope="col">Airline Name</th>
		  <th scope="col">Flight Number</th>
		  <th scope="col">Departure City</th>
		  <th scope="col">Departure Date / Time</th>
		  <th scope="col">Arrival City</th>
		  <th scope="col">Arrival Date / Time</th>
		  <th scope="col">Number Of Persons</th>
		  <th scope="col">Flight Mode</th>
		</tr>
	  </thead>
	  <tbody>
        <?php $i=0; 
	      
	            foreach($arrival_flight AS $list){
	      ?>
		<tr>
		  <td scope="row"><?php echo ++$i; ?></td>
		  <td><?php echo $list->name; ?></td>
		  <td><?php echo $list->flight_number; ?></td>
		  <td><?php echo $list->departure_city; ?></td>
		  <td><?php echo date('d-M-Y',strtotime($list->departure_date)).' / '.$list->departure_time; ?></td>
		  <td><?php echo $list->arrival_city; ?></td>
		  <td><?php echo date('d-M-Y',strtotime($list->arrival_date)).' / '.$list->arrival_time; ?></td>
		  <td><?php echo $list->number_persons; ?></td>
		  <td><?php echo ucfirst($list->flight_mode); ?></td>
		</tr>
	    <?php } ?>
	  </tbody>
	</table>                
   </div>
  </div>
  <?php } ?>
  
  <div class="col-lg-12 head-space">
   <div class="in-pl">
	<div class="print-sub-head">Itinerary</div>               
   </div>
  </div>
  
  <div class="col-lg-12">
      <div class="row">
        <div class="col-lg-12">
            <?php if(!empty($itinerary)){ ?>
            <ul class="timeline">
                <?php 
                $i = 0;
                $itinerary_date = $itinerary[0];
                foreach($itinerary AS $list){ 
                    if($i==0 || $itinerary_date != $list->date){
                    ?>
                <li class="itinerary_li">
                    <span class="label label-primary itinerary_date" style="padding:5px;background-color: #e4fbfd;font-weight: 600;text-transform: uppercase;">
                    <?php echo date('d M Y (l)',strtotime($list->date)); ?></span>
                    <span class="lbl-bold float-right" style="margin-right:80px;display:<?=($i!=0)?'none':''; ?>;">Remarks</span>
                    <br><br>
                    <?php } ?>
                    <p>
                        <label class="lbl-bold"><?php echo $list->time;  ?></label><strong>Hrs</strong>
                        <span class="txt-edit" style="display:inline-table; width:68%;padding:3px;"><?php echo urldecode($list->content); ?></span>
                        <span class="rm-edit" style="display:inline-flex; width:20%;padding:6px;"><?php echo $list->remarks; ?></span>
                    </p>
                <?php 
                $itinerary_date = $list->date;
                if(!array_key_exists($i+1,$itinerary) || $itinerary_date != $itinerary[$i+1]->date){ ?>
                    </li>                          
                <?php } $i++; } ?>
         
            </ul> <?php }else{ ?>
            <p style="text-align: center;color: #ffcece;">No Itinerary Found</p>
            <?php } ?>
            </div>
        </div>
    </div>
  
  <div class="col-lg-12 head-space">
   <div class="in-pl">
	<div class="print-sub-head">Transportation Details</div>               
   </div>
  </div>
    <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">Name : </div>
	<label class="lab-data"><?php echo $arrivals->vehicle_name; ?></label>                
   </div>
  </div>
  <div class="col-lg-3">
   <div class="in-pl">
	<div class="field-name">Vehicle Type : </div>
	<label class="lab-data"><?php echo $arrivals->vehicle_type; ?></label>                
   </div>
  </div>
  
  <div class="col-lg-2">
   <div class="in-pl">
	<div class="field-name">Capacity : </div>
	<label class="lab-data"><?php echo $arrivals->capacity; ?></label>                
   </div>
  </div>
  
  <div class="col-lg-3">
   <div class="in-pl">
	<div class="field-name">Remarks : </div>
	<label class="lab-data"><?php echo $arrivals->remarks; ?></label>                
   </div>
  </div>
  <?php if(!empty($transportation_images)){ ?>
    <div class="row">
  <?php  foreach($transportation_images AS $list){
  ?>
  <div class="col-lg-2">
   <img src="<?php echo base_url('uploads/transportation/'.$list->image); ?>" width="75" height="75" />
  </div>
  <?php } ?> 
  </div>
  <?php } ?>
  
  <div class="col-lg-12 head-space">
    <div class="in-pl">
         <div class="print-sub-head">Guide Details</div>               
    </div>
  </div> 
  <?php if($arrivals->guide_id != '0'){ ?>
  <div class="col-lg-2">
   <img src="<?php echo ($arrivals->photo<>'')?base_url('assets/guide/'.$arrivals->photo):base_url('assets/admin/images/no-image-icon.png'); ?>" width="75" height="75">
  </div>
  <div class="col-lg-10">
   <div class="row">
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">Guide Name : </div>
	<label class="lab-data"><?php echo $arrivals->guide; ?></label>                
   </div>
  </div>
  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">Gender : </div>
	<label class="lab-data"><?php echo ucfirst($arrivals->gender); ?></label>                
   </div>
  </div>
  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">Contact No. : </div>
	<label class="lab-data"><?php echo $arrivals->isd_codes.'-'.$arrivals->contact_number; ?></label>                
   </div>
  </div>
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name">Location : </div>
	<label class="lab-data"><?php echo $arrivals->location; ?></label>                
   </div>
  </div>
  </div>
  </div>
    <?php }else { ?>
    <div class="col-lg-12"> <p style="text-align: center;color: #ffcece;">No Guide</p> </div>
    <?php } ?>
<div class="col-lg-12">
   <div class="in-pl">
	<div class="print-sub-head head-space">Personal Details</div>               
   </div>
  </div> 
   <?php if(!empty($arrival_persons)){  ?> 
  <div class="col-lg-12">
   <div class="in-pl">
	<table class="table table-bordered">
	  <thead>
		<tr>
		  <th scope="col" width="40px">SN</th>
		  <th scope="col">First Name</th>
		  <th scope="col">Last Name</th>
		  <th scope="col">Category</th>
		  <th scope="col">Age</th>
		</tr>
	  </thead>
	  <tbody>
	      <?php 
	      $i = 0;
	       foreach($arrival_persons AS $list){
	      ?>
		<tr>
		  <td scope="row"><?php echo ++$i; ?></td>
		  <td><?php echo $list->first_name; ?></td>
		  <td><?php echo $list->last_name; ?></td>
		  <td><?php echo ucfirst($list->category); ?></td>
		  <td><?php echo $list->age; ?></td>
		</tr>
		<?php } ?>
	  </tbody>
	</table>                
   </div>
  </div>   
  <?php } ?>
  
  
  <div class="col-lg-12 head-space">
   <div class="in-pl">
	<div class="print-sub-head">Room Details</div>               
   </div>
  </div>
  <?php if(!empty($arrival_room)){  ?>
  <div class="col-lg-12">
   <div class="in-pl">
	<table class="table table-bordered">
	  <thead>
		<tr>
		  <th scope="col" width="40px">SN</th>
                  <th scope="col">Hotel</th>
		  <th scope="col">Check-in</th>
		  <th scope="col">Check-out</th>
		  <th scope="col">Room Category</th>
		  <th scope="col">Adult</th>
		  <th scope="col">Child</th>
		  <th scope="col">Confirmation Number</th>
		</tr>
	  </thead>
	  <tbody>
        <?php $i=0; 
	            foreach($arrival_room AS $list){
	      ?>
		<tr>
		  <td scope="row"><?php echo ++$i; ?></td>
                  <td><?php echo $list->hotel; ?></td>
		  <td><?php echo date('d-M-Y',strtotime($list->checkin_date)); ?></td>
		  <td><?php echo date('d-M-Y',strtotime($list->checkout_date)); ?></td>
		  <td><?php echo ucfirst($list->category); ?></td>
		  <td><?php echo $list->number_adults; ?></td>
		  <td><?php echo $list->number_child; ?></td>
		  <td><?php echo $list->hotel_confirmation_num; ?></td>
		</tr>
	    <?php } ?>
	  </tbody>
	</table>                
   </div>
  </div>
    <?php } ?>

  <div class="col-lg-12 head-space">
   <div class="in-pl">
	<div class="print-sub-head">Hotel Details</div>               
   </div>
  </div>
  
  <div class="col-lg-12">
      <?php if(!empty($arrival_hotel_details)){  ?>
   <div class="in-pl">
	<table class="table table-bordered">
	  <thead>
		<tr>
		  <th scope="col" width="40px">SN</th>
                  <th scope="col">Hotel</th>
                  <th scope="col">Contact Person</th>
                  <th scope="col">Contact Email</th>
                  <th scope="col">Contact Number</th>
		  <th scope="col">Check-in</th>
		  <th scope="col">Check-out</th>
		</tr>
	  </thead>
	  <tbody>
        <?php $i=0; 
                foreach($arrival_hotel_details AS $list){
          ?>
		<tr>
                    <td scope="row"><?php echo ++$i; ?></td>
                    <td><?php echo $list->hotel; ?></td>
                    <td><?php echo ucfirst($list->contact_person_name); ?></td>
                    <td><?php echo $list->email; ?></td>
                    <td><?php echo $list->mobile; ?></td>
                    <td><?php echo date('d-M-Y',strtotime($list->checkin_date)); ?></td>
                    <td><?php echo date('d-M-Y',strtotime($list->checkout_date)); ?></td>
		</tr>
	    <?php } ?>
	  </tbody>
	</table>                
    </div>
      <?php  } else{ ?>
            <p style="text-align: center;color: #ffcece;">No Details Found</p>
            <?php } ?>
    </div>
    
    <?php if(in_array($this->session->userdata('type'),['1','3'])){ ?>
        <div class="col-lg-12 head-space">
            <div class="in-pl">
                 <div class="print-sub-head">Billing</div>               
            </div>
        </div> 
  
        <div class="col-lg-4">
            <div class="in-pl">
                <div class="field-name">Currency : </div>
                <label class="lab-data"><?php echo ucfirst($arrivals->currency); ?></label>                
            </div>
        </div>
  
        <div class="col-lg-4">
         <div class="in-pl">
              <div class="field-name">Amount : </div>
              <label class="lab-data"><?php echo $arrivals->client_billing; ?></label>                
         </div>
        </div>
  
        <div class="col-lg-4">
         <div class="in-pl">
              <div class="field-name">Payment in India : </div>
              <label class="lab-data"> <?php echo $arrivals->payment_received_india; ?> </label>                
         </div>
        </div>
  
        <div class="col-lg-4">
         <div class="in-pl">
              <div class="field-name">Payment in Almaty : </div>
              <label class="lab-data"> <?php echo $arrivals->payment_received_almaty; ?> </label>                
         </div>
        </div>
  
        <div class="col-lg-4">
         <div class="in-pl">
              <div class="field-name">Balance : </div>
              <label class="lab-data"> <?php echo $arrivals->balance_amount; ?> </label>                
         </div>
        </div>
      <?php } ?>  
 </div>
    
    <div class="footer col-lg-12" style="margin-top: 50px;margin-bottom: 10px;bottom: 0;">
        <hr>
        <div class="row p-3">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-3 mb-2"><label class="field-name">Company</label></div>
                    <div class="col-lg-9 mb-2"><?php echo $company->name; ?></div>
                    <div class="col-lg-3"><label class="field-name">Address</label></div>
                    <div class="col-lg-9"><?php echo $company->address; ?></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-4 mb-2"><label class="field-name">Contact Person</label></div>
                    <div class="col-lg-8 mb-2"><?php echo $company->person_name; ?> </div>
                    <div class="col-lg-4"><label class="field-name">Contact Mobile</label></div>
                    <div class="col-lg-8"><?php echo $company->contact_number; ?> </div>
                </div>
            </div>
            <div class="col-lg-12 text-center mt-3"><label class="field-name"><?php echo $company->country; ?></label></div>
            
        </div>
       
        
        
    </div>
</div>
    
<!-- partial -->
  
</body>
</html>