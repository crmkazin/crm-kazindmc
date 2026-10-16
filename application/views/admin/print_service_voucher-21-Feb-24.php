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
    }
  </style>
</head>
<body>    
<div class="container print-data bg-grey">
 <div class="row">
  <div class="col-lg-12 text-start logo-left bg-new"><img src="<?php echo base_url(); ?>assets/admin/print/images/logo.png" class="mt-2 mb-2"></div>
 </div>
 <div class="row" style="margin:0 30px ">    
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
	<div class="field-name"><strong>Arrival Date</strong></div>
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
	<div class="field-name"><strong>Number Of Nights :</strong> </div>
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
	<label class="lab-data"><?php echo $arrivals->lead_contact; ?></label>                
   </div>
  </div>
  
  <div class="col-lg-4">
   <div class="in-pl">
	<div class="field-name"><strong>Handover to other :</strong></div>
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
  <div class="field-name"><strong>Status: :</strong></div>
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
          <td class="bg-white"><?php echo $list->address_1; ?></td>
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
                      <th class="bg-warning" width="10%"><p class="text-white">Time</p></th>
                      <th class="bg-warning" width="50%"><p class="text-white">Activies</p></th>
                      <th class="bg-warning" width="25%"><p class="text-white">Remark</p></th>
                    </tr>
                </thead> <tbody>     
      <?php } ?>
                    
            <tr>
                
                <td class="bg-white"><?php echo $list->time;  ?> Hrs</td>
                <td class="bg-white"><?php echo urldecode($list->content); ?></td>
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
  
  <div class="col-lg-12 head-space">
   <div class="in-pl">
	<div class="print-sub-head">Guide Details</div>               
   </div>
  </div>
     <?php if($arrivals->guide_id != '0'){ ?>
  <div class="col-lg-4">
   <div class="in-pl">
  <img src="<?php echo ($arrivals->photo<>'')?base_url('assets/guide/'.$arrivals->photo):base_url('assets/admin/images/no-image-icon.png'); ?>" width="75" height="75"" class="fluid mt-2">                
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
  <label class="lab-data"><?php echo $arrivals->isd_codes.'-'.$arrivals->contact_number; ?></label>                
   </div>
  </div>
     <?php }else { ?>
    <div class="col-lg-12"> <p style="text-align: center;color: #fda2a2;">No Guide</p> </div>
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
<!-- partial -->
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
</body>
</html>