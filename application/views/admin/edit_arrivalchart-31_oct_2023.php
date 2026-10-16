<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
<?php include('admin_head_css.php');?> 
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<style>
    .div_color{ background-color:#f8f8f9; }
    
</style>
 </head>
 <!-- END HEAD -->
<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
    <div class="page-wrapper">
        <!-- start header -->
<?php include('header.php');?>
        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">
 			<!-- start sidebar menu -->
<?php include('side_bar.php');?>
                        
    <div class="modal fade" id="myModalhotel" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">          
          <h4 class="modal-title">Add Hotel</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div id="msgDiv"></div>
                    <form method="post" id="frm_hotel">
                        <div class="card-body row">                            
                    <div class="col-lg-6 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <?php echo form_input(['name'=>'hotel_name','id'=>'hotel_name','placeholder'=>'Name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>''])?>			 
                    <label class = "mdl-textfield__label">Hotel Name</label>
                        </div>
                    </div>																																																							
                    
                    <div class="col-lg-6 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <select name="category" class="mdl-textfield__input" style="padding-top:13px;">
                            <?php for($i=1;$i<=6;$i++){ ?>
                                <option value="<?=$i ?>"><?=$i ?> Star</option>
                            <?php } ?>
                        </select>
                    <label class = "mdl-textfield__label">Hotel Category</label>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <?php echo form_input(['name'=>'person_name','id'=>'person_name','placeholder'=>'Contact Person Name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>''])?>			 
                    <label class = "mdl-textfield__label">Contact Person Name</label>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <?php echo form_input(['name'=>'hotel_email','placeholder'=>'Email Address','type'=>'email','id' =>'hotel_email', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>''])?>			 
                    <label class = "mdl-textfield__label">Email Address</label> 	 	 
                  </div>
                    </div>
                    
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">               
                     <select name="isd_codes" class="mdl-textfield__input" style="padding-top:13px;">
                    <?php 
                    $char = substr($arrivals->enquiry_abbr,1,1);
                    $selected = '+91';
                    if($char == 'K'){ 
                        $selected = 'KZ';
                    }else if($char == 'A'){
                        $selected = 'AZ';
                    }else if($char == 'B'){
                        $selected = 'BY';
                    }
                    //$allowed_countries = ['AZ','BY','IN','KZ'];
                    foreach($country_isd_codes AS $list){                          
                        ?>
                              <option value="<?=$list->isd_codes?>" <?php echo ($list->country_code==$selected)?'selected':''; ?> ><?=$list->isd_codes.' ('.$list->country.')'; ?></option>
                    <?php  } ?>
                  </select>
                    <label class = "mdl-textfield__label">ISD Code</label>	 	 
                  </div>
                    </div>                    
                    
                    <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <?php echo form_input(['name'=>'contact_number','id'=>'contact_number','placeholder'=>'Contact Number', 'required'=>'required','type'=>'number', 'class'=>'mdl-textfield__input', 'value'=>''])?>			 
                    <label class = "mdl-textfield__label">Contact Number</label>	 	 
                  </div>
                    </div>

                    <div class="col-lg-3 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <textarea class="mdl-textfield__input" id="address_1" name="address_1" required> </textarea>			
                    <label class = "mdl-textfield__label">Address 1</label>	 	 
                  </div>
                    </div>
                    
                    <div class="col-lg-3 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <textarea class="mdl-textfield__input" id="address_2" name="address_2"> </textarea>			
                    <label class = "mdl-textfield__label">Address 2</label>	 	 
                  </div>
                    </div>	
                    
                    <div class="col-lg-6 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                <?php echo form_input(['name'=>'country','id'=>'country','placeholder'=>'Country', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>''])?>    
                                        <label class = "mdl-textfield__label">Select Country</label> 		 	 
                  </div>
                    </div>
                <input type="hidden" name="country_id" id="country_id" value="">

                    <div class="col-lg-6 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                <?php echo form_input(['name'=>'state','id'=>'state','placeholder'=>'State',  'class'=>'mdl-textfield__input', 'value'=>set_value('state')])?>    
                                        <label class = "mdl-textfield__label">State</label>		 	 
                  </div>
                    </div>
                <input type="hidden" name="state_id" id="state_id" value="">

                    <div class="col-lg-6 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                <?php echo form_input(['name'=>'city','id'=>'city','placeholder'=>'City', 'class'=>'mdl-textfield__input', 'value'=>set_value('city')])?>    
                                        <label class = "mdl-textfield__label">City</label>		 	 
                  </div>
                    </div>

                    <div class="col-lg-6 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <?php echo form_input(['name'=>'pincode','id'=>'pincode','placeholder'=>'Pincode', 'class'=>'mdl-textfield__input', 'value'=>set_value('pincode')])?>    
                                        <label class = "mdl-textfield__label">Pincode</label>		 	 
                  </div>
                    </div>                    							

                      <div class="col-lg-6 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <textarea class="mdl-textfield__input" id="remarks" name="remarks"> </textarea>
                    <label class = "mdl-textfield__label">Remarks</label>	 	 
                  </div>
                    </div>
                        </div>
                </form>
                </div>                    
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btn_hotel">Submit</button>
        </div>
      </div>
    </div>
  </div>
                        
<div class="modal fade" id="myModaltransportation" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">          
          <h4 class="modal-title">Add Transportation</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div id="msgDivagent"></div>
                    <form method="post" id="frm_transportation">
                        <div class="card-body row">                            
                    
                    <div class="col-lg-6 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <?php echo form_input(['name'=>'vehicle_type','id'=>'vehicle_type','placeholder'=>'Vehicle type', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>''])?>			 
                    <label class = "mdl-textfield__label">Vehicle type</label>
                  </div>
                    </div>
                            
                    <div class="col-lg-6 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <?php echo form_input(['name'=>'capacity','id'=>'capacity','placeholder'=>'Capacity', 'class'=>'mdl-textfield__input', 'value'=>''])?>			 
                    <label class = "mdl-textfield__label">Capacity</label>
                  </div>
                    </div>
        
                    
                    <div class="col-lg-12 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <textarea class="mdl-textfield__input" id="remarks" name="remarks" required> </textarea>		 
                    <label class = "mdl-textfield__label">Remarks</label>	 	 
                  </div>
                    </div>
                        </div>
                </form>
                </div>                    
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btn_transportation">Submit</button>
        </div>
      </div>
    </div>
  </div>
        
    <div class="modal fade" id="myModalguide" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">          
          <h4 class="modal-title">Add Guide</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div id="msgDivguide"></div>
                    <form method="post" id="frm_guide">
                        <div class="card-body row">                            
                    <div class="col-lg-6 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <?php echo form_input(['name'=>'guide_name','id'=>'guide_name','placeholder'=>'Name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>''])?>			 
                    <label class = "mdl-textfield__label">Name</label>
                        </div>
                    </div>	
                    
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">               
                     <select name="isd_codes" class="mdl-textfield__input" style="padding-top:13px;">
                    <?php 
                    $selected = '+91';
                    //$allowed_countries = ['AZ','BY','IN','KZ'];
                    foreach($country_isd_codes AS $list){                          
                        ?>
                              <option value="<?=$list->isd_codes?>" <?php echo ($list->isd_codes==$selected)?'selected':''; ?> ><?=$list->isd_codes.' ('.$list->country.')'; ?></option>
                    <?php  } ?>
                  </select>
                    <label class = "mdl-textfield__label">ISD Code</label>	 	 
                  </div>
                    </div>                    
                    
                    <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <?php echo form_input(['name'=>'contact_number','id'=>'contact_number','placeholder'=>'Contact Number', 'required'=>'required','type'=>'number', 'class'=>'mdl-textfield__input', 'value'=>''])?>			 
                    <label class = "mdl-textfield__label">Contact Number</label>	 	 
                  </div>
                    </div>

                    
                    <div class="col-lg-6 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <select name="gender" class="mdl-textfield__input">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    <label class = "mdl-textfield__label">Gender</label> 	 	 
                  </div>
                    </div>								
                    <div class="col-lg-6 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <?php echo form_input(['name'=>'location','id'=>'location','placeholder'=>'Location', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>''])?>			 
                    <label class = "mdl-textfield__label">Location</label>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <input type="file" name="photo" class="mdl-textfield__input"/>
                        <label class = "mdl-textfield__label">Photo</label>
                        </div>
                    </div>
                    
                      <div class="col-lg-6 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <textarea class="mdl-textfield__input" id="remarks" name="remarks" required> </textarea>
                    <label class = "mdl-textfield__label">Remarks</label>	 	 
                  </div>
                    </div>
                        </div>
                </form>
                </div>                    
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btn_guide">Submit</button>
        </div>
      </div>
    </div>
  </div>    
    
    <div class="modal fade" id="myModalpersondetails" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:1200px;">
      <div class="modal-content">
        <div class="modal-header">          
          <h4 class="modal-title">Edit Persons Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div id="msgDivperson"></div>
                    <form method="post" id="frm_persondetails" onsubmit="formSubmit()">
                        <div class="card-body" style="background-color:#fbfbfb;">
                            <?php if(!empty($arrival_persons)){
                                foreach($arrival_persons AS $list){
                            ?>                            
                    <div class="row" >
                    <div class="col-lg-3 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <?php echo form_input(['name'=>'edit_first_name[]','id'=>'edit_first_name','placeholder'=>'First Name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$list->first_name])?>			 
                    <label class = "mdl-textfield__label">First Name</label>
                  </div>
                    </div>
                    <input type="hidden" name="edit_persondetails[]" value="<?=$list->id?>"/>	 
                    <div class="col-lg-3 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <?php echo form_input(['name'=>'edit_last_name[]','id'=>'edit_last_name','placeholder'=>'Last Name','required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$list->last_name])?>			 
                    <label class = "mdl-textfield__label">Last Name</label>
                  </div>
                    </div>
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <select name="edit_gender[]" class="mdl-textfield__input" style="padding:8px;" required>
                            <option value="male" <?php echo ($list->gender=='male')?'selected="selected"':''; ?>>Male</option>
                            <option value="female" <?php echo ($list->gender=='female')?'selected="selected"':''; ?>>Female</option>
                            <option value="transgender" <?php echo ($list->gender=='transgender')?'selected="selected"':''; ?>>Transgender</option>
                        </select>
                    <label class = "mdl-textfield__label">Gender</label>	 	 
                  </div>
                    </div>
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <select name="edit_person_category[]" class="mdl-textfield__input person-category" style="padding:8px;" required>
                            <option value="adult" <?php echo ($list->category=='adult')?'selected="selected"':''; ?>>Adult</option>
                            <option value="child" <?php echo ($list->category=='child')?'selected="selected"':''; ?>>Child</option>
                            <option value="infant" <?php echo ($list->category=='infant')?'selected="selected"':''; ?>>Infant</option>
                        </select>
                    <label class = "mdl-textfield__label">Category</label>	 	 
                  </div>
                    </div>
                    <?php $age_arr = ['infant'=>['min'=>'1','max'=>'2'],'child'=>['min'=>'3','max'=>'11']];  ?>
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <select name="edit_age[]" class="mdl-textfield__input child-age" style="padding:8px;">
                            <?php if($list->category<>'adult'){ for($i=$age_arr[$list->category]['min'];$i<=$age_arr[$list->category]['max'];$i++){ ?>
                                <option value="<?=$i?>" <?php echo ($list->age==$i)?'selected="selected"':''; ?> ><?=$i?></option>    
                            <?php }}else{ ?>
                            <option value=""></option>
                            <?php } ?>
                        </select>
                    <label class = "mdl-textfield__label">Age</label>	 	 
                  </div><i title="Remove" class="fa fa-window-close edit-remove" style="color:red;cursor: pointer;float: right;margin-top: -15px;position:relative;" data-id="<?=$list->id?>" data-module="person_details"></i>
                    </div>
                    
                        </div>
                        <?php }} ?>
                        </div>
                        
                        
                         <div class="card-body person-details_cls" id="person-details">                            
                    <div class="row" >
                    <div class="col-lg-3 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <?php echo form_input(['name'=>'first_name[]','id'=>'first_name','placeholder'=>'First Name', 'class'=>'mdl-textfield__input', 'value'=>''])?>			 
                    <label class = "mdl-textfield__label">First Name</label>
                  </div>
                    </div>
                            
                    <div class="col-lg-3 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <?php echo form_input(['name'=>'last_name[]','id'=>'last_name','placeholder'=>'Last Name', 'class'=>'mdl-textfield__input', 'value'=>''])?>			 
                    <label class = "mdl-textfield__label">Last Name</label>
                  </div>
                    </div>
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <select name="gender[]" class="mdl-textfield__input" style="padding:8px;" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="transgender">Transgender</option>
                        </select>
                    <label class = "mdl-textfield__label">Gender</label>	 	 
                  </div>
                    </div>
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <select name="person_category[]" class="mdl-textfield__input person-category" style="padding:8px;" >
                            <option value="adult">Adult</option>
                            <option value="child">Child</option>
                            <option value="infant">Infant</option>
                        </select>
                    <label class = "mdl-textfield__label">Category</label>	 	 
                  </div>
                    </div>
                    
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <select name="age[]" class="mdl-textfield__input child-age" style="padding:8px;">
                            <option value=""></option>    
                        </select>
                    <label class = "mdl-textfield__label">Age</label>	 	 
                  </div>
                    </div>
                        </div>
                        </div>
                        
                        <div class="row"><div class="col-lg-12"><button type="button" class="btn btn-xs btn-success" style="float:right;" onclick="add_element('person-details')"><i class="fa fa-plus"></i></button></div></div>
                        <div class="row"><div class="col-lg-7"><button type="submit" class="btn btn-primary" style="float:right;" id="btn_personaldetails">Update</button></div></div>
                </form>
                </div>                    
            </div>
        </div>
      </div>
    </div>
  </div>
   
                  
<div class="modal fade" id="myModalrooms" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:1200px;">
      <div class="modal-content">
        <div class="modal-header">          
          <h4 class="modal-title">Edit Room Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body ui-front">
            <div class="row">
                <div class="col-md-12">
                    <div id="msgDivroom"></div>
                    <form method="post" id="frm_roomdetails" onsubmit="formSubmitRooms()">
                        <div class="card-body" style="background-color:#fbfbfb;">                            
                        <?php if(!empty($arrival_room)){
                                foreach($arrival_room AS $list){
                            ?>
                    <div class="row">
                        <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <input type="text" name="edit_hotel_names[]" value="<?php echo $list->hotel_name; ?>" placeholder="" id="" class="mdl-textfield__input hotel-names" required>
                    <label class = "mdl-textfield__label">Hotel</label>
                  </div>
                    <input type="hidden" name="edit_hotel_ids[]" value="<?php echo $list->hotel_id; ?>" class="hotel-ids">
                    </div>
                    
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <input type="date" name="edit_physical_arrival_date[]" placeholder="" id="" value="<?php echo $list->physical_arrival_date; ?>" class="mdl-textfield__input" required>
                    <label class = "mdl-textfield__label">Physical Arrival Date</label>
                  </div>
                    </div>
                        
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <input type="date" name="edit_rooms_check_in[]" value="<?php echo $list->checkin_date; ?>" placeholder="" id="" class="mdl-textfield__input dt-room" data-operator="plus" required>
                    <label class = "mdl-textfield__label">Check-in Date</label>
                  </div>
                    </div>
                    <input type="hidden" name="edit_roomdetails[]" value="<?=$list->id?>"/>	 
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <input type="date" name="edit_rooms_check_out[]" value="<?php echo $list->checkout_date; ?>" placeholder="" id="" class="mdl-textfield__input dt-room" data-operator="minus" required>
                        <label class = "mdl-textfield__label">Check-out Date</label>
                    </div>
                    </div>
                    
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <select name="edit_room_category[]" class="mdl-textfield__input room-category" style="padding:8px;" required>
                            <option value="single" <?php echo ($list->category=='single')?'selected="selected"':''; ?>>Single</option>
                            <option value="double" <?php echo ($list->category=='double')?'selected="selected"':''; ?>>Double</option>
                            <option value="twin" <?php echo ($list->category=='twin')?'selected="selected"':''; ?>>Twin</option>
                        </select>
                    <label class = "mdl-textfield__label">Category</label>	 	 
                  </div>
                    </div>
                    
                    <div class="col-lg-1 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'edit_number_adults[]','id'=>'','placeholder'=>'Adults', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$list->number_adults])?>
                    <label class = "mdl-textfield__label">Adults</label>	 	 
                  </div>
                    </div>
                    
                    <div class="col-lg-1 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'edit_number_child[]','id'=>'','placeholder'=>'Childs/Infants', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$list->number_child])?>			 
                    <label class = "mdl-textfield__label">Childs/Infants</label>	 	 
                  </div>
                    <i title="Remove" class="fa fa-window-close edit-remove" style="color:red;cursor: pointer;float: right;margin-top: -15px;position:relative;" data-id="<?=$list->id?>" data-module="room_details"></i>
                    </div>
                        </div>
                        <?php }} ?>
                        </div>
                        
                        <div class="card-body room-details_cls" id="room-details">                            
                    <div class="row" >
                        <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <input type="text" name="hotel_names[]" value="" placeholder="" id="" class="mdl-textfield__input hotel-names" >
                    <label class = "mdl-textfield__label">Hotel</label>
                  </div>
                    <input type="hidden" name="hotel_ids[]" class="hotel-ids">
                    </div>
                    
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <input type="date" name="physical_arrival_date[]" placeholder="" id="" value="" class="mdl-textfield__input">
                    <label class = "mdl-textfield__label">Physical Arrival Date</label>
                  </div>
                    </div>
                        
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <input type="date" name="rooms_check_in[]" value="" placeholder="" id="" class="mdl-textfield__input dt-room" data-operator="plus">
                    <label class = "mdl-textfield__label">Check-in Date</label>
                  </div>
                    </div>
                            
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <input type="date" name="rooms_check_out[]" value="" placeholder="" id="" class="mdl-textfield__input dt-room" data-operator="minus">
                        <label class = "mdl-textfield__label">Check-out Date</label>
                    </div>
                    </div>
                    
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <select name="room_category[]" class="mdl-textfield__input room-category" style="padding:8px;">
                            <option value="single">Single</option>
                            <option value="double">Double</option>
                            <option value="twin">Twin</option>
                        </select>
                    <label class = "mdl-textfield__label">Category</label>	 	 
                  </div>
                    </div>
                    
                    <div class="col-lg-1 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'number_adults[]','id'=>'','placeholder'=>'Adults', 'class'=>'mdl-textfield__input', 'value'=>''])?>			 
                    <label class = "mdl-textfield__label">Adults</label>	 	 
                  </div>
                    </div>
                    
                    <div class="col-lg-1 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'number_child[]','id'=>'','placeholder'=>'Childs/Infants', 'class'=>'mdl-textfield__input', 'value'=>''])?>			 
                    <label class = "mdl-textfield__label">Childs/Infants</label>	 	 
                  </div>
                    </div>
                    
                        </div>
                        </div>
                        <div class="row"><div class="col-lg-12"><button class="btn btn-xs btn-success" style="float:right;" onclick="add_element('room-details')"><i class="fa fa-plus"></i></button></div></div>
                        <div class="row"><div class="col-lg-7"><button type="submit" class="btn btn-primary" style="float:right;" id="btn_roomdetails">Update</button></div></div>
                </form>
                </div>                    
            </div>
        </div>
      </div>
    </div>
  </div>
 
 <div class="modal fade" id="myModalflightdetails" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:1200px;">
      <div class="modal-content">
        <div class="modal-header">          
          <h4 class="modal-title">Edit Flight Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body ui-front">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" id="frm_add_airline">
                        <div class="card-header">Add New Airline</div>
                        <div class="card-body" id="">                            
                            <div class="row" >
                                <div class="col-lg-4 p-t-20"> 
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <input type="text" name="airline_name" value="" placeholder="" id="" class="mdl-textfield__input" required>
                                        <label class = "mdl-textfield__label">Airline Name</label>
                                    </div>
                                </div>
                                <div class="col-lg-2 p-t-20"> 
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <input type="text" name="airline_code" value="" placeholder="" id="" class="mdl-textfield__input" required>
                                        <label class = "mdl-textfield__label">Code</label>
                                    </div>
                                </div>
                                <div class="col-lg-2 p-t-20"> 
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <button type="button" class="btn btn-success" id="btn-addairline">Add</button>
                                    </div>
                                </div>
                                <div class="col-lg-4 p-t-20"> 
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <div id="msgAirlineDiv"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            
            <div class="row">
                <div class="col-md-12">
                    <div id="msgflightDiv"></div>
                    <form method="post" id="frm_flightdetails" onsubmit="formSubmitFlights()">
                        <div class="card-header">Edit Flight Details</div>
                        <div class="card-body" id="">
                    <?php foreach($arrival_flights AS $list){ ?>
                        <div class="row div_color">
                        <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <input type="text" name="edit_airline_name[]" value="<?php echo $list->name; ?>" placeholder="" id="" class="mdl-textfield__input airline-names" required>
                    <label class = "mdl-textfield__label">Airline</label>
                  </div>
                    <input type="hidden" name="edit_airline_ids[]" value="<?php echo $list->a_id; ?>" class="airline-ids">
                    </div>
                        <input type="hidden" name="edit_flightdetails[]" value="<?php echo $list->id; ?>" >
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <input type="text" name="edit_flight_number[]" value="<?php echo $list->flight_number; ?>" placeholder="" id="" class="mdl-textfield__input" required>
                    <label class = "mdl-textfield__label">Flight Number</label>
                  </div>
                    </div>
                    
                     <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <select name="edit_flight_type[]" class="mdl-textfield__input" style="padding:8px;" required>
                            <option value="arrival" <?php echo ($list->flight_type=='arrival')?'selected="selected"':''; ?>>Arrival</option>
                            <option value="departure" <?php echo ($list->flight_type=='departure')?'selected="selected"':''; ?>>Departure</option>
                        </select>
                    <label class = "mdl-textfield__label">Type</label>	 	 
                  </div>
                    </div>
                    
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <input type="text" name="edit_departure_city[]" placeholder="" id="" value="<?php echo $list->departure_city; ?>" class="mdl-textfield__input">
                    <label class = "mdl-textfield__label">Departure City</label>
                  </div>
                    </div>
                    
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <input type="date" name="edit_departure_date[]" placeholder="" id="" value="<?php echo ($list->departure_date!='0000-00-00' && $list->departure_date!='')?$list->departure_date:''; ?>" class="mdl-textfield__input" >
                    <label class = "mdl-textfield__label">Departure Date</label>
                  </div>
                    </div>
                    
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <input type="text" name="edit_arrival_city[]" placeholder="" id="" value="<?php echo $list->arrival_city; ?>" class="mdl-textfield__input">
                    <label class = "mdl-textfield__label">Arrival City</label>
                  </div>
                    </div>
                            
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <input type="date" name="edit_arrival_date[]" value="<?php echo ($list->arrival_date!='0000-00-00' && $list->arrival_date!='')?$list->arrival_date:''; ?>" placeholder="" id="" class="mdl-textfield__input">
                        <label class = "mdl-textfield__label">Arrival Date</label>
                    </div>
                    <i title="Remove" class="fa fa-window-close edit-remove" style="color:red;cursor: pointer;float: right;margin-top: -15px;position:relative;" data-id="<?=$list->id?>" data-module="flight_details"></i>
                    </div>
                    
                    </div>
                    <?php } ?>
                    </div>
                        
                <div class="card-body flight-details_cls" id="flight-details">                            
                    <div class="row" >
                        <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <input type="text" name="airline_name[]" value="" placeholder="" id="" class="mdl-textfield__input airline-names">
                    <label class = "mdl-textfield__label">Airline</label>
                  </div>
                    <input type="hidden" name="airline_ids[]" class="airline-ids">
                    </div>
                        
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <input type="text" name="flight_number[]" value="" placeholder="" id="" class="mdl-textfield__input">
                    <label class = "mdl-textfield__label">Flight Number</label>
                  </div>
                    </div>
                    
                     <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <select name="flight_type[]" class="mdl-textfield__input" style="padding:8px;">
                            <option value="arrival">Arrival</option>
                            <option value="departure">Departure</option>
                        </select>
                    <label class = "mdl-textfield__label">Type</label>	 	 
                  </div>
                    </div>
                    
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <input type="text" name="departure_city[]" placeholder="" id="" value="" class="mdl-textfield__input">
                    <label class = "mdl-textfield__label">Departure City</label>
                  </div>
                    </div>
                    
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <input type="date" name="departure_date[]" placeholder="" id="" value="" class="mdl-textfield__input" >
                    <label class = "mdl-textfield__label">Departure Date</label>
                  </div>
                    </div>
                    
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <input type="text" name="arrival_city[]" placeholder="" id="" value="" class="mdl-textfield__input">
                    <label class = "mdl-textfield__label">Arrival City</label>
                  </div>
                    </div>
                            
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <input type="date" name="arrival_date[]" value="" placeholder="" id="" class="mdl-textfield__input">
                        <label class = "mdl-textfield__label">Arrival Date</label>
                    </div>
                    </div>
                    
                    </div>
                    </div>
                        <div class="row"><div class="col-lg-12"><button class="btn btn-xs btn-success" style="float:right;" onclick="add_element('flight-details')"><i class="fa fa-plus"></i></button></div></div>
                        <div class="row"><div class="col-lg-7"><button type="submit" class="btn btn-primary" style="float:right;" id="btn_flightdetails">Submit</button></div></div>
                </form>
                </div>                    
            </div>
        </div>
      </div>
    </div>
  </div>
 
    
                    
                        
			 <!-- end sidebar menu -->
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Edit Arrival</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="<?php echo base_url('arrivals'); ?>">Arrival Chart</a></li> &nbsp;<i class="fa fa-angle-right"></i>
                                &nbsp;
                                <li class="active">Edit Arrival</li>
                            </ol>
                        </div>
                    </div>			
<?php echo  $this->session->flashdata('message'); unset($_SESSION['message']); echo validation_errors(); ?>						
                     <div class="row">
                        <div class="col-sm-12">
                                <div class="card-box">
                                    <div class="card-head">
                                        <button type="button" class="btn bg-blue-grey waves-effect" title="Previous Page" onclick="history.back();">
                                            <i class="material-icons">arrow_back</i>
                                        </button>
                                            <header>Edit Arrival</header>
                                    <button type="button" style="float:right;cursor:pointer;" id="add_company" data-toggle="modal" data-target="#myModalhotel" class="btn-success">Add New Hotel</button>
                                    <button type="button" style="float:right;cursor:pointer;margin-right:5px;" id="edit_flight_details" data-toggle="modal" data-target="#myModalflightdetails" class="btn-info">Edit Flight Details</button>
                                    </div>	
                                <form method="post">
                                    <input type="hidden" value="<?php echo $arrivals->enq_id; ?>" name="enq_id" id="enq_id">
                                        <div class="card-body row">
                                        
                                    <div class="col-lg-1 p-t-20 div_color">
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">			 
                                            <?php
                                            $location_keys = ($this->session->userdata('locations')=='all')?array_keys($locations):[$this->session->userdata('locations')]; ?>
                                            <!--select name="booking_type" id="booking_type" class="mdl-textfield__input" > 
                                                <option value=""></option>
                                                <?php //foreach($location_keys AS $list){ 
                                                        //foreach($locations[$list] AS $v){
                                                    ?>
                                                <option value="<?php echo $v; ?>" <?php //echo ($v==$arrivals->enquiry_abbr)?'selected disabled="disabled" style="background-color:#dfdfdf;"':''; ?>><?php //echo $v; ?></option>
                                                <?php //}} ?>
                                            </select-->    
                                            <?php echo $arrivals->enquiry_abbr; ?>
                                            <label class = "mdl-textfield__label">Booking Type</label>		 	 
                                        </div>
                                    </div> 
                                    
                                    <div class="col-lg-1 p-t-20 div_color"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                        <?php echo form_input(['name'=>'enquiry_no','id'=>'enquiry_no', 'class'=>'mdl-textfield__input', 'value'=>$arrivals->enquiry_no,'readonly'=>True])?>			 
                                    <label class = "mdl-textfield__label">File No</label><?php echo form_error('enquiry_no');?>
                                    <input type="hidden" name="file_seq" id="file_seq" value=""/>
                                  </div>
                                    </div>
                                    
                                    <!--div class="col-lg-1 p-t-20 div_color"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <?php echo form_input(['type'=>'text', 'name'=>'number_of_nights','placeholder'=>'','id'=>'number_of_nights', 'class'=>'mdl-textfield__input', 'value'=>$arrivals->number_of_nights])?>			 
                                            <label class = "mdl-textfield__label">No. Of Nights</label><?php echo form_error('number_of_nights');?>

                                        </div>
                                    </div-->
                                    
                                    <div class="col-lg-2 p-t-20 div_color"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                         <?php echo form_input(['type'=>'text', 'name'=>'','placeholder'=>'','id'=>'', 'class'=>'mdl-textfield__input', 'value'=>$arrivals->name,'readonly'=>True])?>			 
                                        
                                    <label class = "mdl-textfield__label">Filename</label>	 	 
                                  </div>
                                    </div>
                                    
                                    <div class="col-lg-1 p-t-20 div_color" style="border: 1px solid #b7c0c7;border-right: 0;"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <?php echo form_input(['name'=>'number_persons','id'=>'number_persons',  'class'=>'mdl-textfield__input', 'value'=>$arrivals->number_persons])?>			 
                                            <label class = "mdl-textfield__label">No. Of Persons</label><?php echo form_error('number_persons');?>

                                        </div>
                                    </div>
                                    <div class="col-lg-1 p-t-20 div_color" style="border-top: 1px solid #b7c0c7;border-bottom: 1px solid #b7c0c7;"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <?php echo form_input(['name'=>'number_child','id'=>'number_child', 'class'=>'mdl-textfield__input', 'value'=>$arrivals->number_child])?>			 
                                            <label class = "mdl-textfield__label">No. Of Child</label><?php echo form_error('number_persons');?>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="col-lg-1 p-t-20 div_color" style="border: 1px solid #b7c0c7;border-left: 0;">
                                        <button type="button" data-toggle="modal" data-target="#myModalpersondetails" class="btn btn-xs btn-info" style="white-space:normal;">Edit Persons Details</button>
                                    </div>
                                    
                                    <div class="col-lg-2 p-t-20 div_color" style="border-top: 1px solid #b7c0c7;border-bottom: 1px solid #b7c0c7;"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <?php echo form_input(['type'=>'date', 'name'=>'check_in','placeholder'=>'','id'=>'check_in', 'class'=>'dts mdl-textfield__input', 'value'=>$arrivals->check_in_date])?>			 
                                            <label class = "mdl-textfield__label">Check In Date</label><?php echo form_error('check_in');?>

                                        </div>
                                    </div>
                                            
                                    <div class="col-lg-2 p-t-20 div_color" style="border-top: 1px solid #b7c0c7;border-bottom: 1px solid #b7c0c7;"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <?php echo form_input(['type'=>'date', 'name'=>'check_out','placeholder'=>'','id'=>'check_out', 'class'=>'dts mdl-textfield__input', 'value'=>$arrivals->check_out_date])?>			 
                                            <label class = "mdl-textfield__label">Check Out Date</label><?php echo form_error('check_out');?>

                                        </div>
                                    </div>
                                    <div class="col-lg-1 p-t-20 div_color" style="border: 1px solid #b7c0c7;border-left:0;">
                                        <button type="button" style="white-space:normal;" data-toggle="modal" data-target="#myModalrooms" class="btn btn-xs btn-info">Edit Rooms Details</button>
                                    </div>
                                    
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <?php echo form_input(['type'=>'date', 'name'=>'arrival_date','placeholder'=>'','id'=>'arrival_date', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$arrivals->arrival_date])?>			 
                                            <label class = "mdl-textfield__label">Arrival Date</label><?php echo form_error('arrival_date');?>

                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 p-t-20"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <select name="handling_staff" id="handling_staff" class="mdl-textfield__input"> 
                                                <option value=""></option>
                                                <?php 
                                                foreach($users as $user){                                                   
                                                ?>
                                                <option value="<?=$user->id?>" <?php echo ($user->id==$arrivals->handling_staff_id)?'selected="selected"':''; ?>><?=$user->name?></option>
                                                <?php  } ?>
                                        </select> 
                                    <label class = "mdl-textfield__label">Handling Staff</label>	 	 
                                  </div>
                                    </div>
                                    
                                    <div class="col-lg-3 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php 
                                          echo form_input(['name'=>'transportation','id'=>'transportation','placeholder'=>'Transportation', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$arrivals->vehicle_type]);
                                          ?>   
                                            <label class = "mdl-textfield__label">Transportation</label>		 	 
                                        </div>
                                    </div>
                                    <input type="hidden" name="transportation_id" id="transportation_id" value="<?php echo $arrivals->transportation_id; ?>">
                                    <div class="col-lg-1 p-t-20">
                                        <button type="button" style="width: 100%;" data-toggle="modal" data-target="#myModaltransportation" class="mdl-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-success">Add</button>
                                    </div>
                                    
                                    <div class="col-lg-3 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                             <?php 
                                          echo form_input(['name'=>'guide','id'=>'guide','placeholder'=>'Guide', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$arrivals->guide]);
                                          ?>     
                                            <label class = "mdl-textfield__label">Guide</label>		 	 
                                        </div>
                                    </div>
                                    <input type="hidden" name="guide_id" id="guide_id" value="<?php echo $arrivals->guide_id; ?>">
                                    <div class="col-lg-1 p-t-20">
                                        <button type="button" style="width: 100%;" data-toggle="modal" data-target="#myModalguide" class="mdl-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-success">Add</button>
                                    </div>
                                                                         
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php $group_type = ['Family','Men','Friends','Mice','Ladies']; ?>
                                            <select id="group_type" name="group_type" class="mdl-textfield__input">
                                                <?php foreach($group_type AS $list){ ?>
                                                    <option value="<?=$list?>" <?php echo ($arrivals->group_type==$list)?'selected="selected"':''; ?>><?=$list?></option>
                                                <?php } ?>
                                            </select>
                                        <label class = "mdl-textfield__label">Group Type</label>	 	 
                                  </div>
                                    </div>
                                    
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <select name="handover_to_client" id="handover_to_client" class="mdl-textfield__input"> 
                                            <option value="yes" <?php echo ($arrivals->handover_to_client=='yes')?'selected="selected"':''; ?>>Yes</option>
                                            <option value="no" <?php echo ($arrivals->handover_to_client=='no')?'selected="selected"':''; ?>>No</option>
                                        </select> 
                                        <label class = "mdl-textfield__label">Handover To Client</label>	 	 
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            
                                        <select name="handover_to_kazin" id="handover_to_kazin" class="mdl-textfield__input"> 
                                            <option value="yes" <?php echo ($arrivals->handover_to_kazin=='yes')?'selected="selected"':''; ?>>Yes</option>
                                            <option value="no" <?php echo ($arrivals->handover_to_kazin=='no')?'selected="selected"':''; ?>>No</option>
                                        </select> 
                                        <label class = "mdl-textfield__label">Handover To Kazin</label>	 	 
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            
                                        <select name="currency" id="currency" class="mdl-textfield__input"> 
                                            <option value="dollar" <?php echo ($arrivals->currency=='dollar')?'selected="selected"':''; ?>>Dollar ($)</option>
                                            <option value="inr" <?php echo ($arrivals->currency=='inr')?'selected="selected"':''; ?>>INR (&#8377;)</option>
                                        </select> 
                                        <label class = "mdl-textfield__label">Currency</label>	 	 
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <input type="text" class="mdl-textfield__input" name="client_billing" id="client_billing" value="<?php echo $arrivals->client_billing; ?>" readonly>
                                        <label class = "mdl-textfield__label">Client Billing (Amount)</label>	 	 
                                  </div>
                                    </div>
                                    
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input type="number" min="0" class="mdl-textfield__input payment" name="payment_india" id="payment_india" value="<?php echo $arrivals->payment_received_india; ?>">
                                        <label class = "mdl-textfield__label">Payment Received In India</label>	 	 
                                  </div>
                                    </div>
                                    
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input type="number" min="0" class="mdl-textfield__input payment" name="payment_almaty" id="payment_almaty" value="<?php echo $arrivals->payment_received_almaty; ?>">
                                        <label class = "mdl-textfield__label">Payment Received In ALMATY</label>	 	 
                                  </div>
                                    </div>
                                    
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input type="number" min="0" class="mdl-textfield__input" name="balance_amount" id="balance_amount" value="<?php echo $arrivals->balance_amount; ?>">
                                        <label class = "mdl-textfield__label">Balance Amount</label>	 	 
                                  </div>
                                    </div>
                                    
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            
                                        <select name="status" id="status" class="mdl-textfield__input"> 
                                            <option value="in-progress" <?php echo ($arrivals->status=='in-progress')?'selected="selected"':''; ?>>In Progress</option>
                                            <option value="complete" <?php echo ($arrivals->status=='complete')?'selected="selected"':''; ?>>Complete</option>
                                        </select> 
                                        <label class = "mdl-textfield__label">Status</label>	 	 
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" name="arrival_id" value="<?php echo base64_encode($arrivals->id); ?>"/>
                                   <div class="col-lg-12 p-t-20 text-center"> 
                                        <?php echo form_submit(['name'=>'add','id'=>'add', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Update']);?>
                                        <input type="button" value="Cancel" name="" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-danger" onclick="history.back();">
                                    </div>                                
                                    
                            </div>						

                        </form>
                        </div>
                    </div>
                </div>
					
                </div>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page container -->
        <!-- start footer -->
<?php include('admin_footer.php');?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
<?php include('admin_footer_js.php');?>
    <!-- end js include path -->	

 <!-- suggesstion Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- jQuery UI -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    
<script>
    $(document).ready(function(){
        $("#frm_roomdetails").on('keydown.autocomplete', ".hotel-names", function() {
            var ele = $(this);
            var idx = ele.index(".hotel-names");
            /*var d = $('.hotel-names').eq(idx).attr("id");*/
            
            $(this).autocomplete({
            source: function( request, response ) {
                // Fetch data
                $.ajax({
                 url: "<?=base_url()?>admin/arrivalchart/hotel_name_suggesstion",
                 type: 'post',
                 dataType: "json",
                 data: {
                  search: request.term,'location':''
                 },
                 success: function( data ) {
                    /*$.each(data, function (index, item) {
                         $('#'+d).appendTo("<ul><li class=''>" + item.label + "</li></ul>");
                    });*/ 
                    response( data)
                 }
                });
            },
            select: function (event, ui) {
                // Set selection
                $(this).val(ui.item.label); // display the selected text
                $(".hotel-ids").eq(idx).val(ui.item.h_id);
                //$('#hotel_id').val(ui.item.h_id); // save selected id to input
            }
            });
        });
        
        $("#frm_flightdetails").on('keydown.autocomplete', ".airline-names", function() {
            var ele = $(this);
            var idx = ele.index(".airline-names");
            /*var d = $('.hotel-names').eq(idx).attr("id");*/
            
            $(this).autocomplete({
            source: function( request, response ) {
                // Fetch data
                $.ajax({
                 url: "<?=base_url()?>admin/arrivalchart/airline_name_suggesstion",
                 type: 'post',
                 dataType: "json",
                 data: {
                  search: request.term,'location':''
                 },
                 success: function( data ) {
                    /*$.each(data, function (index, item) {
                         $('#'+d).appendTo("<ul><li class=''>" + item.label + "</li></ul>");
                    });*/ 
                    response( data)
                 }
                });
            },
            select: function (event, ui) {
                // Set selection
                $(this).val(ui.item.label); // display the selected text
                $(".airline-ids").eq(idx).val(ui.item.a_id);
                //$('#hotel_id').val(ui.item.h_id); // save selected id to input
            }
            });
        });
        
        $( "#transportation" ).autocomplete({
        source: function( request, response ) {
            // Fetch data
            $.ajax({
             url: "<?=base_url()?>admin/arrivalchart/transportation_name_suggesstion",
             type: 'post',
             dataType: "json",
             data: {
              search: request.term,'location':'kazakistan'
             },
             success: function( data ) {
              response( data );
              dt = data;
              $(".err").html('');;
             }
            });
        },
        select: function (event, ui) {
            // Set selection
            $('#transportation').val(ui.item.label); // display the selected text
            $('#transportation_id').val(ui.item.t_id); // save selected id to input
        }
        });
        
        $( "#guide" ).autocomplete({
            source: function( request, response ) {
            // Fetch data
            $.ajax({
             url: "<?=base_url()?>admin/arrivalchart/guide_name_suggesstion",
             type: 'post',
             dataType: "json",
             data: {
              search: request.term,'location':'kazakistan'
             },
             success: function( data ) {
              response( data );
              dt = data;
              $(".err").html('');;
             }
            });
        },
        select: function (event, ui) {
            // Set selection
            $('#guide').val(ui.item.label); // display the selected text
            $('#guide_id').val(ui.item.g_id); // save selected id to input
        }
        });
        
        
        $(".dts").on("change",function(){
            if($('.dts:eq(0)').val()==="" || $('.dts:eq(1)').val()==="") { return false; }
            const pre = new Date($('.dts:eq(0)').val());
            const last = new Date($('.dts:eq(1)').val());        
            if(pre > last){
                alert('Check-in date must be less than Check-out date.');
                $(".dts").val('');
            }else{
                const diffInMs   =  Math.abs(last- pre);
                const diffInDays = Math.round(diffInMs/(1000 * 60 * 60 * 24));
                $("#number_of_nights").val(diffInDays);
            }
        });
        
    $("#btn_hotel").on("click",function(){
        let myForm = document.getElementById("frm_hotel");
        var data = new FormData(myForm);
        $("#btn_hotel").html('Submitting').attr('disabled','disabled');
        $.ajax({
            url: "<?php echo base_url('admin/arrivalchart/add_hotel'); ?>",
            type: "post",
            data: data,
            dataType: 'JSON',
            contentType: false,
            processData: false,
            beforeSend: function(){                
            },
            success: function (data) {
                $("#msgDiv").html('').html(data.msg);
                $("#btn_hotel").html('Submit').removeAttr('disabled','disabled');
                if(data.response === "e"){
                }
                else if(data.response === "s"){
                    $("#frm_hotel")[0].reset();
                }
            }
        });
    });
    
    $("#btn_transportation").on("click",function(){
        let myForm = document.getElementById("frm_transportation");
        var data = new FormData(myForm);
        $("#btn_transportation").html('Submitting').attr('disabled','disabled');
        $.ajax({
            url: "<?php echo base_url('admin/arrivalchart/add_transportation'); ?>",
            type: "post",
            data: data,
            dataType: 'JSON',
            contentType: false,
            processData: false,
            beforeSend: function(){                
            },
            success: function (data) {
                $("#msgDivagent").html('').html(data.msg);
                $("#btn_transportation").html('Submit').removeAttr('disabled','disabled');
                if(data.response === "e"){
                }
                else if(data.response === "s"){
                    $("#frm_transportation")[0].reset();
                }
            }
        });
    });
    
    $("#btn_guide").on("click",function(){
        let myForm = document.getElementById("frm_guide");
        var data = new FormData(myForm);
        $("#btn_guide").html('Submitting').attr('disabled','disabled');
        $.ajax({
            url: "<?php echo base_url('admin/arrivalchart/add_guide'); ?>",
            type: "post",
            data: data,
            dataType: 'JSON',
            contentType: false,
            processData: false,
            beforeSend: function(){                
            },
            success: function (data) {
                $("#msgDivguide").html('').html(data.msg);
                $("#btn_guide").html('Submit').removeAttr('disabled','disabled');
                if(data.response === "e"){
                }
                else if(data.response === "s"){
                    $("#frm_guide")[0].reset();
                }
            }
        });
    });
    
    $("#frm_persondetails").on('change', '.person-category', function(){
        var ele = $(this);
        var idx = ele.index(".person-category");
        var child = {min:3,max:11};
        var infant = {min:1,max:2};
        var d;
        if(ele.val()!="adult"){  
            $('.child-age').eq(idx).attr("required","required").empty().append('<option value=""></option>').parent().addClass("is-focused");
            if(ele.val() == "child"){ d = child; }else{ d = infant; }
            
            for(var i=d.min;i<=d.max;i++) {
                   $('.child-age').eq(idx).append('<option value="' + i + '">' + i + '</option>');
                }
            
        }else { $('.child-age').eq(idx).removeAttr("required").empty().append('<option value=""></option>'); }
    });
    
    $("#frm_persondetails").on('click', '.fa-remove', function(e){
        e.preventDefault();
        $(this).parent().remove(); //Remove field html
    });
   
    $("#frm_roomdetails").on('click', '.fa-remove', function(e){
        e.preventDefault();
        $(this).parent().remove(); //Remove field html
    });
    
    $(".edit-remove").on("click",function(e){
        if(!confirm('Are You Sure?')){
            return false;
        }
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: "<?php echo site_url('edit_remove_details'); ?>",
            type: "post",
            data: { 'module_id': ele.attr("data-id") , 'module':ele.attr("data-module"),'enq_id':$("#enq_id").val() },
            dataType : 'JSON',
            //contentType : false,
            //processData: false,
            beforeSend: function(){
            },
            success: function (res) {
                if(res.response === "s"){
                    ele.parent().parent().remove();                     
                }
            }
        });
    });
    
    $("#frm_roomdetails").on('change', '.dt-room', function(){
        var ele = $(this);
        var idx = ele.index(".dt-room");
        var op = $('.dt-room:eq('+idx+')').attr("data-operator");
        var checkin_idx = checkout_idx = "";
        if(op=="plus"){
            checkin_idx = idx;
            checkout_idx = parseInt(idx) + 1;
        }else {
            checkin_idx = parseInt(idx) - 1;
            checkout_idx = idx;
        }
        
        if($('.dt-room:eq('+checkin_idx+')').val()==="" || $('.dt-room:eq('+checkout_idx+')').val()==="") { return false; }
        const pre = new Date($('.dt-room:eq('+checkin_idx+')').val());
        const last = new Date($('.dt-room:eq('+checkout_idx+')').val());        
        if(pre > last){
            alert('Check-in date must be less than Check-out date.');
            $('.dt-room:eq('+checkin_idx+')').val('');
            $('.dt-room:eq('+checkout_idx+')').val('');
        }
    });
    
    $(".payment").on("blur",function(){
        $("#err_billing").html('');
        if($(this).val()==''){ $(this).val("0").parent("div").addClass("is-focused"); }
        if($("#client_billing").val()==''){
            $("#err_billing").html('<div class="alert alert-danger" style="padding: 0 5px;">Client Billing Amount Cannot Be Empty!</div>');
            $(this).val(0);
            return false;
        } 
        var balance_amt = parseInt($("#client_billing").val())-(parseInt($(".payment:eq(0)").val()) + parseInt($(".payment:eq(1)").val()));
        $("#balance_amount").val(balance_amt).parent("div").addClass("is-focused");
    });
    
        
});
    
    function formSubmit(){
        event.preventDefault();
        let myForm = document.getElementById("frm_persondetails");
        var data = new FormData(myForm);
        data.set('id',$("#enq_id").val());
        $("#btn_personaldetails").attr("disabled","disabled");
        $.ajax({
            url: "<?php echo site_url('edit_personal_details'); ?>",
            type: "post",
            data: data,
            dataType : 'JSON',
            contentType : false,
            processData: false,
            success: function (data) {
                $("#msgDivperson").html("").html(data.msg);
                $("#btn_personaldetails").removeAttr("disabled");
                if(data.response === "s"){
                    window.location.reload();    
                }
             }
        });
    }
    
    function formSubmitRooms(){
        event.preventDefault();
        let myForm = document.getElementById("frm_roomdetails");
        var data = new FormData(myForm);
        data.set('id',$("#enq_id").val());
        
        $("#btn_roomdetails").attr("disabled","disabled");
        $.ajax({
            url: "<?php echo site_url('edit_room_details'); ?>",
            type: "post",
            data: data,
            dataType : 'JSON',
            contentType : false,
            processData: false,
            success: function (data) {
                $("#msgDivroom").html("").html(data.msg);
                $("#btn_roomdetails").removeAttr("disabled");
                if(data.response === "s"){
                    window.location.reload();    
                }
             }
        });
    }
    
    function formSubmitFlights(){
        event.preventDefault();
        let myForm = document.getElementById("frm_flightdetails");
        var data = new FormData(myForm);
        data.set('id',$("#enq_id").val());
        $("#btn_flightdetails").attr("disabled","disabled");
        $.ajax({
            url: "<?php echo site_url('edit_flight_details'); ?>",
            type: "post",
            data: data,
            dataType : 'JSON',
            contentType : false,
            processData: false,
            success: function (data) {
                $("#msgflightDiv").html("").html(data.msg);
                $("#btn_flightdetails").removeAttr("disabled");
                if(data.response === "s"){
                    window.location.reload();    
                }
             }
        });
    }
    
    function add_element(id){
        event.preventDefault();
        var x = Math.floor((Math.random() * 1000) + 1);
        var h = $("#"+id).clone().attr('id',id+'_'+x);
        h.find('input').val('');
        h.find('select').val('');
        h.append('<i title="Remove" class="fa fa-remove" style="color:red;cursor: pointer;float: right;margin-top: -15px;position:relative;"></i>');
        h.insertAfter("."+id+"_cls:last");
    }
    
    
    
</script>


</body>
</html>