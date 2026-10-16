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
    .div_color {
        background-color: #f8f8f9;
    }
    </style>
</head>
<!-- END HEAD -->

<body
    class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
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
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name'=>'hotel_name','id'=>'hotel_name','placeholder'=>'Name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>''])?>
                                                    <label class="mdl-textfield__label">Hotel Name</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="category" class="mdl-textfield__input"
                                                        style="padding-top:13px;">
                                                        <?php for($i=1;$i<=6;$i++){ ?>
                                                        <option value="<?=$i ?>"><?=$i ?> Star</option>
                                                        <?php } ?>
                                                    </select>
                                                    <label class="mdl-textfield__label">Hotel Category</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name'=>'person_name','id'=>'person_name','placeholder'=>'Contact Person Name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>''])?>
                                                    <label class="mdl-textfield__label">Contact Person Name</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name'=>'hotel_email','placeholder'=>'Email Address','type'=>'email','id' =>'hotel_email', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>''])?>
                                                    <label class="mdl-textfield__label">Email Address</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-2 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="isd_codes" class="mdl-textfield__input"
                                                        style="padding-top:13px;">
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
                                                        <option value="<?=$list->isd_codes?>"
                                                            <?php echo ($list->country_code==$selected)?'selected':''; ?>>
                                                            <?=$list->isd_codes.' ('.$list->country.')'; ?></option>
                                                        <?php  } ?>
                                                    </select>
                                                    <label class="mdl-textfield__label">ISD Code</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name'=>'contact_number','id'=>'contact_number','placeholder'=>'Contact Number', 'required'=>'required','type'=>'number', 'class'=>'mdl-textfield__input', 'value'=>''])?>
                                                    <label class="mdl-textfield__label">Contact Number</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <textarea class="mdl-textfield__input" id="address_1"
                                                        name="address_1" required> </textarea>
                                                    <label class="mdl-textfield__label">Address 1</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <textarea class="mdl-textfield__input" id="address_2"
                                                        name="address_2"> </textarea>
                                                    <label class="mdl-textfield__label">Address 2</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                                    <?php echo form_input(['name'=>'country','id'=>'country','placeholder'=>'Country', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>''])?>
                                                    <label class="mdl-textfield__label">Select Country</label>
                                                </div>
                                            </div>
                                            <input type="hidden" name="country_id" id="country_id" value="">

                                            <div class="col-lg-6 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                                    <?php echo form_input(['name'=>'state','id'=>'state','placeholder'=>'State',  'class'=>'mdl-textfield__input', 'value'=>set_value('state')])?>
                                                    <label class="mdl-textfield__label">State</label>
                                                </div>
                                            </div>
                                            <input type="hidden" name="state_id" id="state_id" value="">

                                            <div class="col-lg-6 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                                    <?php echo form_input(['name'=>'city','id'=>'city','placeholder'=>'City', 'class'=>'mdl-textfield__input', 'value'=>set_value('city')])?>
                                                    <label class="mdl-textfield__label">City</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name'=>'pincode','id'=>'pincode','placeholder'=>'Pincode', 'class'=>'mdl-textfield__input', 'value'=>set_value('pincode')])?>
                                                    <label class="mdl-textfield__label">Pincode</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <textarea class="mdl-textfield__input" id="remarks"
                                                        name="remarks"> </textarea>
                                                    <label class="mdl-textfield__label">Remarks</label>
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
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name'=>'vehicle_type','id'=>'vehicle_type','placeholder'=>'Vehicle type', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>''])?>
                                                    <label class="mdl-textfield__label">Vehicle type</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name'=>'capacity','id'=>'capacity','placeholder'=>'Capacity', 'class'=>'mdl-textfield__input', 'value'=>''])?>
                                                    <label class="mdl-textfield__label">Capacity</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name'=>'year','id'=>'year','placeholder'=>'Year', 'class'=>'mdl-textfield__input', 'value'=>''])?>
                                                    <label class="mdl-textfield__label">Year</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name'=>'make','id'=>'make','placeholder'=>'Make', 'class'=>'mdl-textfield__input', 'value'=>''])?>
                                                    <label class="mdl-textfield__label">Make</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name'=>'luggage','id'=>'luggage','placeholder'=>'Luggage', 'class'=>'mdl-textfield__input', 'value'=>''])?>
                                                    <label class="mdl-textfield__label">Luggage</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <textarea class="mdl-textfield__input" id="remarks" name="remarks"
                                                        required> </textarea>
                                                    <label class="mdl-textfield__label">Remarks</label>
                                                </div>
                                            </div>


                                            <div class="col-lg-6 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                                                    <input type="file" name="upload_images[]"
                                                        class="mdl-textfield__input" style="margin-top:22px;"
                                                        multiple />
                                                    <label class="mdl-textfield__label">Images (Maximum:6 Images Allowed
                                                        Of 2MB Each)</label>
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
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name'=>'guide_name','id'=>'guide_name','placeholder'=>'First Name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>''])?>
                                                    <label class="mdl-textfield__label">First Name</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name'=>'guide_last_name','id'=>'guide_last_name','placeholder'=>'Last Name',  'class'=>'mdl-textfield__input', 'value'=>''])?>
                                                    <label class="mdl-textfield__label">Last Name</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-2 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="isd_codes" class="mdl-textfield__input"
                                                        style="padding-top:13px;">
                                                        <?php 
                    $selected = '+91';
                    //$allowed_countries = ['AZ','BY','IN','KZ'];
                    foreach($country_isd_codes AS $list){                          
                        ?>
                                                        <option value="<?=$list->isd_codes?>"
                                                            <?php echo ($list->isd_codes==$selected)?'selected':''; ?>>
                                                            <?=$list->isd_codes.' ('.$list->country.')'; ?></option>
                                                        <?php  } ?>
                                                    </select>
                                                    <label class="mdl-textfield__label">ISD Code</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name'=>'contact_number','id'=>'contact_number','placeholder'=>'Contact Number', 'required'=>'required','type'=>'number', 'class'=>'mdl-textfield__input', 'value'=>''])?>
                                                    <label class="mdl-textfield__label">Contact Number</label>
                                                </div>
                                            </div>


                                            <div class="col-lg-6 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="gender" class="mdl-textfield__input">
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                    <label class="mdl-textfield__label">Gender</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name'=>'location','id'=>'location','placeholder'=>'Location', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>''])?>
                                                    <label class="mdl-textfield__label">Location</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <input type="file" name="photo" class="mdl-textfield__input" />
                                                    <label class="mdl-textfield__label">Photo</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <textarea class="mdl-textfield__input" id="remarks" name="remarks"
                                                        required> </textarea>
                                                    <label class="mdl-textfield__label">Remarks</label>
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

            <!--div class="modal fade" id="myModalpersondetails" role="dialog">
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
                            <?php //if(!empty($arrival_persons)){
                               // foreach($arrival_persons AS $list){
                            ?>                            
                    <div class="row" >
                    <div class="col-lg-3 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <?php //echo form_input(['name'=>'edit_first_name[]','id'=>'edit_first_name','placeholder'=>'First Name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$list->first_name])?>			 
                    <label class = "mdl-textfield__label">First Name</label>
                  </div>
                    </div>
                    <input type="hidden" name="edit_persondetails[]" value="<?=$list->id?>"/>	 
                    <div class="col-lg-3 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <?php //echo form_input(['name'=>'edit_last_name[]','id'=>'edit_last_name','placeholder'=>'Last Name','required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$list->last_name])?>			 
                    <label class = "mdl-textfield__label">Last Name</label>
                  </div>
                    </div>
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <select name="edit_gender[]" class="mdl-textfield__input" style="padding:8px;" required>
                            <option value="male" <?php //echo ($list->gender=='male')?'selected="selected"':''; ?>>Male</option>
                            <option value="female" <?php //echo ($list->gender=='female')?'selected="selected"':''; ?>>Female</option>
                            <option value="transgender" <?php //echo ($list->gender=='transgender')?'selected="selected"':''; ?>>Transgender</option>
                        </select>
                    <label class = "mdl-textfield__label">Gender</label>	 	 
                  </div>
                    </div>
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <select name="edit_person_category[]" class="mdl-textfield__input person-category" style="padding:8px;" required>
                            <option value="adult" <?php //echo ($list->category=='adult')?'selected="selected"':''; ?>>Adult</option>
                            <option value="child" <?php //echo ($list->category=='child')?'selected="selected"':''; ?>>Child</option>
                            <option value="infant" <?php //echo ($list->category=='infant')?'selected="selected"':''; ?>>Infant</option>
                        </select>
                    <label class = "mdl-textfield__label">Category</label>	 	 
                  </div>
                    </div>
                    <?php //$age_arr = ['infant'=>['min'=>'1','max'=>'2'],'child'=>['min'=>'3','max'=>'11']];  ?>
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <select name="edit_age[]" class="mdl-textfield__input child-age" style="padding:8px;">
                            <?php //if($list->category<>'adult'){ for($i=$age_arr[$list->category]['min'];$i<=$age_arr[$list->category]['max'];$i++){ ?>
                                <option value="<?=$i?>" <?php //echo ($list->age==$i)?'selected="selected"':''; ?> ><?=$i?></option>    
                            <?php //}}else{ ?>
                            <option value=""></option>
                            <?php //} ?>
                        </select>
                    <label class = "mdl-textfield__label">Age</label>	 	 
                  </div><i title="Remove" class="fa fa-window-close edit-remove" style="color:red;cursor: pointer;float: right;margin-top: -15px;position:relative;" data-id="<?=$list->id?>" data-module="person_details"></i>
                    </div>
                    
                        </div>
                        <?php //}} ?>
                        </div>
                        
                        
                         <div class="card-body person-details_cls" id="person-details">                            
                    <div class="row" >
                    <div class="col-lg-3 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <?php //echo form_input(['name'=>'first_name[]','id'=>'first_name','placeholder'=>'First Name', 'class'=>'mdl-textfield__input', 'value'=>''])?>			 
                    <label class = "mdl-textfield__label">First Name</label>
                  </div>
                    </div>
                            
                    <div class="col-lg-3 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <?php //echo form_input(['name'=>'last_name[]','id'=>'last_name','placeholder'=>'Last Name', 'class'=>'mdl-textfield__input', 'value'=>''])?>			 
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
  </div-->


            <div class="modal fade" id="myModalrooms" role="dialog">
                <div class="modal-dialog modal-lg" style="max-width:95%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit / Create Rooming List</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body ui-front">
                            <div class="row">
                                <div class="col-md-4"><select class="mdl-textfield__input"
                                        id="roominglist_hotels"></select></div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="msgDivroom"></div>
                                    <form method="post" id="frm_roomdetails" onsubmit="formSubmitRooms()">

                                        <div class="card-body" style="background-color:#fbfbfb;">
                                            <?php if(!empty($arrival_room)){
                                foreach($arrival_room AS $list){
                            ?>

                                            <div class="row">
                                                <div class="col-lg-6"
                                                    style="background-color:#f1efeb;padding:7px 15px;"><input
                                                        type="radio" name="rdo_list" class="rdo-select"
                                                        checked="checked"></div>
                                                <div class="col-lg-6"
                                                    style="background-color:#f1efeb;text-align:right;">
                                                    <label class="" style="font-weight: 400;">Hotel Confirmation Number
                                                        : </label>
                                                    <input type="text" name="edit_confirmation_number[]"
                                                        autocomplete="off" placeholder="" id=""
                                                        value="<?php echo isset($list->hotel_confirmation_num)?$list->hotel_confirmation_num:''; ?>"
                                                        class="" required="">
                                                </div>
                                                <input type="hidden" name="edit_hotel_details_ids[]"
                                                    class="hotel-details-ids" value="<?php echo $list->hotel_id; ?>">
                                                <input type="hidden" name="edit_arrival_hotel_details_ids[]"
                                                    class="arrival-hotel-details-ids"
                                                    value="<?php echo $list->arrival_hotel_details_id; ?>">

                                                <!--div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <input type="text" name="edit_hotel_names[]" value="<?php echo $list->hotel_name; ?>" placeholder="" id="" class="mdl-textfield__input hotel-names" required>
                    <label class = "mdl-textfield__label">Hotel</label>
                  </div>
                    <input type="hidden" name="edit_hotel_ids[]" value="<?php //echo $list->hotel_id; ?>" class="hotel-ids">
                    </div-->

                                                <!--div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <input type="date" name="edit_physical_arrival_date[]" placeholder="" id="" value="<?php //echo $list->physical_arrival_date; ?>" class="mdl-textfield__input" required>
                    <label class = "mdl-textfield__label">Physical Arrival Date</label>
                  </div>
                    </div-->

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="date" name="edit_rooms_check_in[]"
                                                            value="<?php echo $list->checkin_date; ?>" placeholder=""
                                                            id="" class="mdl-textfield__input dt-room check-in"
                                                            data-operator="plus" required>
                                                        <label class="mdl-textfield__label">Check-in Date</label>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="edit_roomdetails[]" value="<?=$list->id?>" />
                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="date" name="edit_rooms_check_out[]"
                                                            value="<?php echo $list->checkout_date; ?>" placeholder=""
                                                            id="" class="mdl-textfield__input dt-room check-out"
                                                            data-operator="minus" required>
                                                        <label class="mdl-textfield__label">Check-out Date</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <select name="edit_room_category[]"
                                                            class="mdl-textfield__input room-category"
                                                            style="padding:8px;" required>

                                                            <?php 
                            /*$adult_max = $child_max = $child_bed = '';
                            foreach($hotel_room_categories AS $room_list){ 
                                    if($room_list->category_name==$list->category){
                                        $adult_max = $room_list->number_adults;
                                        $child_max = $room_list->number_childs;
                                        $child_bed = $room_list->child_bed;
                                    }*/
                            $adult_max = $list->number_adults;
                            $child_max = $list->number_childs;
                            $child_bed = $list->child_bed;
                            ?>
                                                            <option value="<?php echo $list->category; ?>"
                                                                data-adults="<?php //echo $room_list->number_adults; ?>"
                                                                data-childs="<?php //echo $room_list->number_childs; ?>"
                                                                data-childbed="<?php //echo $room_list->child_bed; ?>">
                                                                <?php echo $list->category; ?></option>
                                                            <?php //} ?>
                                                        </select>
                                                        <label class="mdl-textfield__label">Category</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-1 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <?php echo form_input(['name'=>'edit_number_adults[]','id'=>'','placeholder'=>'Adults', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$list->number_adults,'max'=>$adult_max,'readonly'=>'readonly'])?>
                                                        <label class="mdl-textfield__label">Adults</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-1 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <?php echo form_input(['name'=>'edit_number_child[]','id'=>'','placeholder'=>'Childs/Infants', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$list->number_child,'max'=>$child_max,'readonly'=>'readonly'])?>
                                                        <label class="mdl-textfield__label">Childs/Infants</label>
                                                    </div>

                                                </div>

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <select name="edit_child_bed[]"
                                                            class="mdl-textfield__input room-childbed"
                                                            style="padding:8px;" required>
                                                            <option value="N/A">N/A</option>
                                                            <option value="<?php echo $child_bed; ?>">
                                                                <?php echo $child_bed; ?></option>
                                                        </select>
                                                        <label class="mdl-textfield__label">Child Bed</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <select name="edit_breakfast[]" class="mdl-textfield__input"
                                                            style="padding:8px;" required>
                                                            <option value="yes"
                                                                <?php echo ($list->breakfast=='yes')?'selected="selected"':''; ?>>
                                                                Yes</option>
                                                            <option value="no"
                                                                <?php echo ($list->breakfast=='no')?'selected="selected"':''; ?>>
                                                                No</option>
                                                        </select>
                                                        <label class="mdl-textfield__label">Breakfast Included</label>
                                                    </div>
                                                    <i title="Remove" class="fa fa-window-close edit-remove"
                                                        style="color:red;cursor: pointer;float: right;margin-top: -15px;position:relative;"
                                                        data-id="<?=$list->id?>" data-module="room_details"></i>
                                                </div>

                                                <div class="" style="background-color:#f5fbff;padding: 0 15px;">
                                                    <?php if(array_key_exists($list->id,$arrival_persons)){ 
                            foreach($arrival_persons[$list->id] AS $persons_list){ ?>

                                                    <input type="hidden" name="edit_person_details[]"
                                                        value="<?php echo $persons_list->id;  ?>" />
                                                    <div class="row">
                                                        <div class="col-lg-1">
                                                            <div
                                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                <input type="text" name="edit_first_name[]"
                                                                    placeholder="" id=""
                                                                    value="<?=$persons_list->first_name ?>"
                                                                    class="mdl-textfield__input" required>
                                                                <label class="mdl-textfield__label">First Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1">
                                                            <div
                                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                <input type="text" name="edit_last_name[]"
                                                                    placeholder="" id=""
                                                                    value="<?=$persons_list->last_name ?>"
                                                                    class="mdl-textfield__input" required>
                                                                <label class="mdl-textfield__label">Last Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1">
                                                            <div
                                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                <select name="edit_person_category[]"
                                                                    class="mdl-textfield__input person-category"
                                                                    style="padding:8px;" required>
                                                                    <option value="adult"
                                                                        <?php echo ($persons_list->category=='adult')?'selected="selected"':''; ?>>
                                                                        Adult</option>
                                                                    <option value="child"
                                                                        <?php echo ($persons_list->category=='child')?'selected="selected"':''; ?>>
                                                                        Child</option>
                                                                    <option value="infant"
                                                                        <?php echo ($persons_list->category=='infant')?'selected="selected"':''; ?>>
                                                                        Infant</option>
                                                                </select>
                                                                <label class="mdl-textfield__label">Category</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-1">
                                                            <div
                                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                <select name="edit_age[]"
                                                                    class="mdl-textfield__input child-age"
                                                                    style="padding:8px;">
                                                                    <option value="<?php echo $persons_list->age; ?>">
                                                                        <?php echo $persons_list->age; ?></option>
                                                                </select>
                                                                <label class="mdl-textfield__label">Age</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div
                                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                <input type="text" name="edit_passport_number[]"
                                                                    placeholder="" id=""
                                                                    value="<?php echo $persons_list->passport_number; ?>"
                                                                    class="mdl-textfield__input" required>
                                                                <label class="mdl-textfield__label">Passport No.</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1">
                                                            <div
                                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                <input type="text" name="edit_nationality[]"
                                                                    placeholder="" id=""
                                                                    value="<?php echo $persons_list->nationality; ?>"
                                                                    class="mdl-textfield__input" required>
                                                                <label class="mdl-textfield__label">Nationality</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div
                                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                <select name="edit_smoking[]"
                                                                    class="mdl-textfield__input" style="padding:8px;"
                                                                    required>
                                                                    <option value="smoking"
                                                                        <?php echo ($persons_list->smoking_status=='smoking')?'selected="selected"':''; ?>>
                                                                        Smoking</option>
                                                                    <option value="non-smoking"
                                                                        <?php echo ($persons_list->smoking_status=='non-smoking')?'selected="selected"':''; ?>>
                                                                        Non-smoking</option>
                                                                </select>
                                                                <label class="mdl-textfield__label">Smoking</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1">
                                                            <div
                                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                <select name="edit_meals[]" class="mdl-textfield__input"
                                                                    style="padding:8px;" required>
                                                                    <option value="veg"
                                                                        <?php echo ($persons_list->meals=='veg')?'selected="selected"':''; ?>>
                                                                        Veg</option>
                                                                    <option value="non-veg"
                                                                        <?php echo ($persons_list->meals=='non-veg')?'selected="selected"':''; ?>>
                                                                        Non-veg</option>
                                                                    <option value="other"
                                                                        <?php echo ($persons_list->meals=='other')?'selected="selected"':''; ?>>
                                                                        Other</option>
                                                                </select>
                                                                <label class="mdl-textfield__label">Meals</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div
                                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                <input type="text" name="edit_remarks[]" placeholder=""
                                                                    id="" value="<?php echo $persons_list->remarks; ?>"
                                                                    class="mdl-textfield__input">
                                                                <label class="mdl-textfield__label">Remarks</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php    }
                        ?>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <?php }} ?>
                                        </div>

                                        <div class="card-body room-details_cls" id="room-details">
                                            <div class="row">
                                                <div class="col-lg-6"
                                                    style="background-color:#f1efeb;padding:7px 15px;"><input
                                                        type="radio" name="rdo_list" class="rdo-select"
                                                        checked="checked"></div>
                                                <div class="col-lg-6"
                                                    style="background-color:#f1efeb;text-align:right;">
                                                    <label class="" style="font-weight: 400;">Hotel Confirmation Number
                                                        : </label>
                                                    <input type="text" name="confirmation_number[]" autocomplete="off"
                                                        placeholder="" id="" value="" class="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!--div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <input type="text" name="hotel_names[]" value="" placeholder="" id="" class="mdl-textfield__input hotel-names" >
                    <label class = "mdl-textfield__label">Hotel</label>
                  </div>
                    <input type="hidden" name="hotel_ids[]" class="hotel-ids">
                    </div-->
                                                <input type="hidden" name="hotel_details_ids[]"
                                                    class="hotel-details-ids">
                                                <input type="hidden" name="arrival_hotel_details_ids[]"
                                                    class="arrival-hotel-details-ids">
                                                <!--div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <input type="date" name="physical_arrival_date[]" placeholder="" id="" value="" class="mdl-textfield__input">
                    <label class = "mdl-textfield__label">Physical Arrival Date</label>
                  </div>
                    </div-->

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="date" name="rooms_check_in[]" value=""
                                                            placeholder="" id=""
                                                            class="mdl-textfield__input dt-room check-in"
                                                            data-operator="plus">
                                                        <label class="mdl-textfield__label">Check-in Date</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="date" name="rooms_check_out[]" value=""
                                                            placeholder="" id=""
                                                            class="mdl-textfield__input dt-room check-out"
                                                            data-operator="minus">
                                                        <label class="mdl-textfield__label">Check-out Date</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <select name="room_category[]"
                                                            class="mdl-textfield__input room-category"
                                                            style="padding:8px;">

                                                        </select>
                                                        <label class="mdl-textfield__label">Category</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-1 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <?php echo form_input(['name'=>'number_adults[]','id'=>'','placeholder'=>'Adults', 'class'=>'mdl-textfield__input room-adults', 'value'=>''])?>
                                                        <label class="mdl-textfield__label">Adults</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-1 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <?php echo form_input(['name'=>'number_child[]','id'=>'','placeholder'=>'Childs/Infants', 'class'=>'mdl-textfield__input room-childs', 'value'=>''])?>
                                                        <label class="mdl-textfield__label">Childs/Infants</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-1 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                                                        <select name="child_bed[]"
                                                            class="mdl-textfield__input room-childbed"
                                                            style="padding:8px;">

                                                        </select>
                                                        <label class="mdl-textfield__label">Child Bed</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <select name="breakfast[]" class="mdl-textfield__input"
                                                            style="padding:8px;" required>
                                                            <option value="yes">Yes</option>
                                                            <option value="no">No</option>
                                                        </select>
                                                        <label class="mdl-textfield__label">Breakfast Included</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-1 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                                                        <button class="btn btn-xs btn-success add-person-details"
                                                            style="float:right;">Persons<br>Details</button>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="div-person-details"
                                                style="background-color:#f5fbff;padding: 0 15px;">


                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12"><button class="btn btn-xs btn-success"
                                                    style="float:right;" onclick="add_element('room-details')"><i
                                                        class="fa fa-plus"></i></button></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-7"><button type="submit" class="btn btn-primary"
                                                    style="float:right;" id="btn_roomdetails">Update</button></div>
                                        </div>
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
                                    <div id="msgflightDiv"></div>
                                    <form method="post" id="frm_flightdetails" onsubmit="formSubmitFlights()">
                                        <div class="card-header">Edit Flight Details</div>
                                        <div class="card-body" id="">
                                            <?php foreach($arrival_flights AS $list){ ?>
                                            <div class="row div_color">
                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="text" name="edit_airline_name[]"
                                                            value="<?php echo $list->name; ?>" placeholder="" id=""
                                                            class="mdl-textfield__input airline-names" required>
                                                        <label class="mdl-textfield__label">Airline</label>
                                                    </div>
                                                    <input type="hidden" name="edit_airline_ids[]"
                                                        value="<?php echo $list->a_id; ?>" class="airline-ids">
                                                </div>
                                                <input type="hidden" name="edit_flightdetails[]"
                                                    value="<?php echo $list->id; ?>">

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <select name="edit_departure_airport[]" id=""
                                                            class="mdl-textfield__input" style="padding:8px;" required>
                                                            <option value="">Select..</option>
                                                            <?php foreach($departure_airports AS $list_airports){ ?>
                                                            <option
                                                                value="<?php echo $list_airports->departure_airport; ?>"
                                                                <?php echo ($list_airports->departure_airport==$list->departure_airport)?'selected="selected"':''; ?>>
                                                                <?php echo $list_airports->departure_airport; ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                        <label class="mdl-textfield__label">Departure Airport</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <!--input type="text" name="edit_flight_number[]" value="<?php echo $list->flight_number; ?>" placeholder="" id="" class="mdl-textfield__input" required-->
                                                        <select name="edit_flight_number[]" id=""
                                                            class="mdl-textfield__input" style="padding:8px;" required>
                                                            <option value="<?php echo $list->flight_number; ?>">
                                                                <?php echo $list->flight_number; ?></option>
                                                        </select>
                                                        <label class="mdl-textfield__label">Flight Number</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="text" name="edit_departure_city[]" placeholder=""
                                                            id="" value="<?php echo $list->departure_city; ?>"
                                                            class="mdl-textfield__input">
                                                        <label class="mdl-textfield__label">Departure City</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="date" name="edit_departure_date[]" placeholder=""
                                                            id=""
                                                            value="<?php echo ($list->departure_date!='0000-00-00' && $list->departure_date!='')?$list->departure_date:''; ?>"
                                                            class="mdl-textfield__input dts-flight"
                                                            data-operator="plus">
                                                        <label class="mdl-textfield__label">Departure Date</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="time" name="edit_departure_time[]" placeholder=""
                                                            id="" value="<?php echo $list->departure_time; ?>"
                                                            class="mdl-textfield__input">
                                                        <label class="mdl-textfield__label">Departure Time</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="text" name="edit_arrival_city[]" placeholder=""
                                                            id="" value="<?php echo $list->arrival_city; ?>"
                                                            class="mdl-textfield__input">
                                                        <label class="mdl-textfield__label">Arrival City</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="date" name="edit_arrival_date[]"
                                                            value="<?php echo ($list->arrival_date!='0000-00-00' && $list->arrival_date!='')?$list->arrival_date:''; ?>"
                                                            placeholder="" id="" class="mdl-textfield__input dts-flight"
                                                            data-operator="minus">
                                                        <label class="mdl-textfield__label">Arrival Date</label>
                                                    </div>

                                                </div>

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="time" name="edit_arrival_time[]"
                                                            value="<?php echo $list->arrival_time; ?>" placeholder=""
                                                            id="" class="mdl-textfield__input">
                                                        <label class="mdl-textfield__label">Arrival Time</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="text" name="edit_number_persons[]"
                                                            value="<?php echo $list->number_persons; ?>" placeholder=""
                                                            id="" class="mdl-textfield__input">
                                                        <label class="mdl-textfield__label">Number Of Persons</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <select name="edit_flight_mode[]"
                                                            class="mdl-textfield__input flight-modes"
                                                            style="padding:8px;" required>
                                                            <option value="inbound"
                                                                <?php echo ($list->flight_mode=='inbound')?'selected="selected"':''; ?>>
                                                                Inbound</option>
                                                            <option value="outbound"
                                                                <?php echo ($list->flight_mode=='outbound')?'selected="selected"':''; ?>>
                                                                Out-Bound</option>
                                                        </select>
                                                        <label class="mdl-textfield__label">Flight Mode</label>
                                                    </div>
                                                    <i title="Remove" class="fa fa-window-close edit-remove"
                                                        style="color:red;cursor: pointer;float: right;margin-top: -15px;position:relative;"
                                                        data-id="<?=$list->id?>" data-module="flight_details"></i>
                                                </div>

                                            </div>
                                            <?php } ?>
                                        </div>

                                        <div class="card-body flight-details_cls" id="flight-details">
                                            <div class="row">
                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="text" name="airline_name[]" value="" placeholder=""
                                                            id="" class="mdl-textfield__input airline-names">
                                                        <label class="mdl-textfield__label">Airline</label>
                                                    </div>
                                                    <input type="hidden" name="airline_ids[]" class="airline-ids">
                                                </div>

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <select name="departure_airport[]" id=""
                                                            class="mdl-textfield__input" style="padding:8px;">
                                                            <option value="">Select..</option>
                                                            <?php foreach($departure_airports AS $list){ ?>
                                                            <option value="<?php echo $list->departure_airport; ?>">
                                                                <?php echo $list->departure_airport; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <label class="mdl-textfield__label">Departure Airport</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <!--input type="text" name="flight_number[]" value="" placeholder="" id="" class="mdl-textfield__input"-->
                                                        <select name="flight_number[]" id=""
                                                            class="mdl-textfield__input" style="padding:8px;">

                                                        </select>
                                                        <label class="mdl-textfield__label">Flight Number</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="text" name="departure_city[]" placeholder="" id=""
                                                            value="" class="mdl-textfield__input">
                                                        <label class="mdl-textfield__label">Departure City</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="date" name="departure_date[]" placeholder="" id=""
                                                            value="" class="mdl-textfield__input dts-flight"
                                                            data-operator="plus">
                                                        <label class="mdl-textfield__label">Departure Date</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="time" name="departure_time[]" placeholder="" id=""
                                                            value="" class="mdl-textfield__input">
                                                        <label class="mdl-textfield__label">Departure Time</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="text" name="arrival_city[]" placeholder="" id=""
                                                            value="" class="mdl-textfield__input">
                                                        <label class="mdl-textfield__label">Arrival City</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="date" name="arrival_date[]" value="" placeholder=""
                                                            id="" class="mdl-textfield__input dts-flight"
                                                            data-operator="minus">
                                                        <label class="mdl-textfield__label">Arrival Date</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="time" name="arrival_time[]" value="" placeholder=""
                                                            id="" class="mdl-textfield__input">
                                                        <label class="mdl-textfield__label">Arrival Time</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="text" name="number_persons[]" value=""
                                                            placeholder="" id="" class="mdl-textfield__input">
                                                        <label class="mdl-textfield__label">Number Of Persons</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <select name="flight_mode[]"
                                                            class="mdl-textfield__input flight-modes"
                                                            style="padding:8px;">
                                                            <option value="inbound">Inbound</option>
                                                            <option value="outbound">Out-Bound</option>
                                                        </select>
                                                        <label class="mdl-textfield__label">Flight Mode</label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12"><button class="btn btn-xs btn-success"
                                                    style="float:right;" onclick="add_element('flight-details')"><i
                                                        class="fa fa-plus"></i></button></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-7"><button type="submit" class="btn btn-primary"
                                                    style="float:right;" id="btn_flightdetails">Submit</button></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
                    //$allowed_users = ['1','2'];
                    $readonly='';
                    $disabled='';
                    if(!in_array($this->session->userdata('type'),$allowed_users)){
                        $readonly='readonly';    
                        $disabled = 'disabled="disabled"';
                    }
            ?>

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
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="<?php echo base_url('arrivals'); ?>">Arrival Chart</a>
                                </li> &nbsp;<i class="fa fa-angle-right"></i>
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
                                    <button type="button" class="btn bg-blue-grey waves-effect" title="Previous Page"
                                        onclick="history.back();">
                                        <i class="material-icons">arrow_back</i>
                                    </button>
                                    <header>Edit Arrival</header>
                                    <?php  if(in_array($this->session->userdata('type'),$allowed_users)){ ?>
                                    <!--button type="button" style="float:right;cursor:pointer;" id="add_company" data-toggle="modal" data-target="#myModalhotel" class="btn-success">Add New Hotel</button-->
                                    <button type="button" style="float:right;cursor:pointer;margin-right:5px;"
                                        id="edit_flight_details" data-toggle="modal" data-target="#myModalflightdetails"
                                        class="btn-info">Edit Flight Details</button>
                                    <button type="button" onclick="rooms_model()" class="btn-info"
                                        style="float:right;cursor:pointer;margin-right:5px;">Edit/Create Rooming
                                        List</button>
                                    <?php } ?>
                                </div>

                                <div class="card-body">

                                    <form method="post" id="frm_hoteldetails" enctype="multipart/form-data">

                                        <div class="row">
                                            <div class="col-lg-3 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['type'=>'date', 'name'=>'arrival_date','placeholder'=>'','id'=>'arrival_date', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$arrivals->arrival_date/*,'readonly'=>$readonly*/])?>
                                                    <label class="mdl-textfield__label">Physical Arrival
                                                        Date</label><?php //echo form_error('arrival_date');?>

                                                </div>
                                            </div>
                                        </div>

                                        <?php 
                                $edit_checkout = '';
                                if(!empty($arrival_hotel_details)){ ?>
                                        <?php foreach($arrival_hotel_details AS $list){ ?>
                                        <div class="row">
                                            <input type="hidden" name="edit_hotel_details_id[]"
                                                value="<?php echo $list->id;  ?>" />
                                            <div class="col-lg-3 div_color"
                                                style="border-top: 1px solid #b7c0c7;border-bottom: 1px solid #b7c0c7;border-left: 1px solid #b7c0c7;">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['type'=>'date', 'name'=>'edit_checkin[]','placeholder'=>'','id'=>'', 'class'=>'mdl-textfield__input check-dts', 'value'=>$list->checkin_date])?>
                                                    <label class="mdl-textfield__label">Check In
                                                        Date</label><?php echo form_error('');?>

                                                </div>
                                            </div>

                                            <div class="col-lg-3 div_color"
                                                style="border-top: 1px solid #b7c0c7;border-bottom: 1px solid #b7c0c7;border-left: 1px solid #b7c0c7;">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['type'=>'date', 'name'=>'edit_checkout[]','placeholder'=>'','id'=>'', 'class'=>'mdl-textfield__input', 'value'=>$list->checkout_date])?>
                                                    <label class="mdl-textfield__label">Check Out
                                                        Date</label><?php echo form_error('');?>
                                                    <?php $edit_checkout = $list->checkout_date;  ?>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 div_color" style="border: 1px solid #b7c0c7;">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php 
                                          echo form_input(['name'=>'edit_hotel[]','id'=>'','placeholder'=>'Hotel', 'class'=>'mdl-textfield__input hotel-names', 'value'=>$list->hotel_name]);
                                          ?>
                                                    <label class="mdl-textfield__label">Hotel</label>
                                                    <input type="hidden" name="edit_hotel_ids[]"
                                                        value="<?php echo $list->hotel_id; ?>" class="hotel-ids">
                                                </div>
                                            </div>
                                            <div class="col-lg-1 div_color"
                                                style="border-top: 1px solid #b7c0c7;border-bottom: 1px solid #b7c0c7;border-right: 1px solid #b7c0c7;padding:22px;">
                                                <button type="button" data-module="arrival_hotels"
                                                    class="btn btn-danger btn-xs arrival-hotel-remove"
                                                    data-id="<?php echo $list->id; ?>" title="Remove">Remove</button>
                                            </div>
                                        </div>
                                        <?php } } ?>

                                        <div class="row hotel_details_cls" id="hotel_details" style="padding-top:10px;">
                                            <div class="col-lg-3 div_color_new"
                                                style="border-top: 1px solid #b7c0c7;border-bottom: 1px solid #b7c0c7;border-left: 1px solid #b7c0c7;">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['type'=>'date', 'name'=>'check_in[]','placeholder'=>'','id'=>'', 'class'=>'dts mdl-textfield__input check-dts', 'value'=>($edit_checkout != '')?$edit_checkout:$arrivals->check_in_date,'onkeydown'=>"return false"])?>
                                                    <label class="mdl-textfield__label">Check In
                                                        Date</label><?php echo form_error('check_in');?>

                                                </div>
                                            </div>

                                            <div class="col-lg-3 div_color_new"
                                                style="border-top: 1px solid #b7c0c7;border-bottom: 1px solid #b7c0c7;border-left: 1px solid #b7c0c7;">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['type'=>'date', 'name'=>'check_out[]','placeholder'=>'','id'=>'', 'class'=>'dts mdl-textfield__input', 'value'=>$arrivals->check_out_date,'onkeydown'=>"return false"])?>
                                                    <label class="mdl-textfield__label">Check Out
                                                        Date</label><?php echo form_error('check_out');?>

                                                </div>
                                            </div>

                                            <div class="col-lg-4 div_color_new" style="border: 1px solid #b7c0c7;">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php 
                                          echo form_input(['name'=>'hotel[]','id'=>'','placeholder'=>'Hotel', 'class'=>'mdl-textfield__input hotel-names', 'value'=>'','required'=>'required']);
                                          ?>
                                                    <label class="mdl-textfield__label">Hotel</label>
                                                    <input type="hidden" name="hotel_ids[]" class="hotel-ids">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-10" id="msgDivHotel">

                                            </div>
                                            <div class="col-lg-2">
                                                <button class="btn btn-xs btn-success"
                                                    onclick="add_ele_hotel('hotel_details')"><i
                                                        class="fa fa-plus"></i></button>
                                                <button type="button" class="btn btn-xs btn-success btn-pink"
                                                    id="btn_save">Save</button>
                                            </div>
                                        </div>
                                        <br>
                                    </form>

                                    <form method="post" enctype="multipart/form-data">
                                        <input type="hidden" value="<?php echo $arrivals->enq_id; ?>" name="enq_id"
                                            id="enq_id">
                                        <div class="row">
                                            <div class="col-lg-1 p-t-20 div_color">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                                                    <?php
                                            $location_keys = ($this->session->userdata('locations')=='all')?array_keys($locations):[$this->session->userdata('locations')]; ?>
                                                    <!--select name="booking_type" id="booking_type" class="mdl-textfield__input" > 
                                                <option value=""></option>
                                                <?php //foreach($location_keys AS $list){ 
                                                        //foreach($locations[$list] AS $v){
                                                    ?>
                                                <option value="<?php //echo $v; ?>" <?php //echo ($v==$arrivals->enquiry_abbr)?'selected disabled="disabled" style="background-color:#dfdfdf;"':''; ?>><?php //echo $v; ?></option>
                                                <?php //}} ?>
                                            </select-->
                                                    <?php echo $arrivals->enquiry_abbr; ?>
                                                    <label class="mdl-textfield__label">Booking Type</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-1 p-t-20 div_color">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name'=>'enquiry_no','id'=>'enquiry_no', 'class'=>'mdl-textfield__input', 'value'=>$arrivals->enquiry_no,'readonly'=>True])?>
                                                    <label class="mdl-textfield__label">File
                                                        No</label><?php echo form_error('enquiry_no');?>
                                                    <input type="hidden" name="file_seq" id="file_seq" value="" />
                                                </div>
                                            </div>

                                            <!--div class="col-lg-1 p-t-20 div_color"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <?php echo form_input(['type'=>'text', 'name'=>'number_of_nights','placeholder'=>'','id'=>'number_of_nights', 'class'=>'mdl-textfield__input', 'value'=>$arrivals->number_of_nights])?>			 
                                            <label class = "mdl-textfield__label">No. Of Nights</label><?php echo form_error('number_of_nights');?>

                                        </div>
                                    </div-->

                                            <div class="col-lg-2 p-t-20 div_color">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['type'=>'text', 'name'=>'','placeholder'=>'','id'=>'', 'class'=>'mdl-textfield__input', 'value'=>$arrivals->name,'readonly'=>True])?>

                                                    <label class="mdl-textfield__label">Agent Name</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-2 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php 
                                          echo form_input(['name'=>'lead_name','id'=>'lead_name','placeholder'=>'Lead Name', 'class'=>'mdl-textfield__input', 'value'=>$arrivals->lead_name,'required'=>'required']);
                                          ?>
                                                    <label class="mdl-textfield__label">Lead Name</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-2 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <!--select name="lead_isd_code" class="mdl-textfield__input" style="padding-top:13px;">
                                            <?php 
                                              //$selected = $arrivals->lead_isd_code;
                                              //$allowed_countries = ['AZ','BY','IN','KZ','GE'];
                                              //foreach($country_isd_codes AS $list){  
                                                //if(in_array($list->country_code,$allowed_countries)){
                                            ?>
                                            <option value="<?//=$list->isd_codes?>"
                                              <?php //echo ($list->isd_codes == $selected) ? 'selected' : ''; ?>>
                                              <?//=$list->isd_codes.' ('.$list->country.')'; ?></option>
                                            <?php //} } ?>
                                          </select-->
                                                    <?php echo form_input(['name'=>'lead_isd_code','id'=>'lead_isd_code','placeholder'=>'ISD Code', 'class'=>'mdl-textfield__input', 'value'=>'','required'=>'required','value'=>isset($arrivals->lead_isd_code)?$arrivals->lead_isd_code:'']); ?>
                                                    <label class="mdl-textfield__label">ISD</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php 
                                          echo form_input(['name'=>'lead_contact','id'=>'lead_contact','placeholder'=>'Lead Contact', 'class'=>'mdl-textfield__input', 'value'=>$arrivals->lead_contact,'required'=>'required']);
                                          ?>
                                                    <label class="mdl-textfield__label">Lead Contact</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-1 p-t-20 hide">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
                                                    style="padding:0;">
                                                    <input type="file" class="btn btn-xs btn-info mdl-textfield__input"
                                                        style="white-space: normal;display:none;" name="lead_photo"
                                                        id="lead_photo" />
                                                    <label for="lead_photo" class="btn btn-xs btn-info">Lead
                                                        Photo</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php 
                                          echo form_input(['name'=>'number_rooms','id'=>'number_rooms','placeholder'=>'Number Of Rooms', 'class'=>'mdl-textfield__input', 'value'=>$arrivals->number_rooms,'required'=>'required']);
                                          ?>
                                                    <label class="mdl-textfield__label">Number Of Rooms</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-2 p-t-20" style="">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name'=>'number_persons','id'=>'number_persons',  'class'=>'mdl-textfield__input', 'value'=>$arrivals->number_persons])?>
                                                    <label class="mdl-textfield__label">No. Of
                                                        Adults</label><?php echo form_error('number_persons');?>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 p-t-20" style="">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['name'=>'number_child','id'=>'number_child', 'class'=>'mdl-textfield__input', 'value'=>$arrivals->number_child])?>
                                                    <label class="mdl-textfield__label">No. Of
                                                        Child</label><?php echo form_error('number_child');?>
                                                </div>
                                            </div>

                                            <!--div class="col-lg-2 p-t-20 div_color" style="border: 1px solid #b7c0c7;border-left: 0;">
                                        <?php //if(in_array($this->session->userdata('type'),$allowed_users)){ ?>
                                        <button type="button" data-toggle="modal" data-target="#myModalpersondetails" class="btn btn-xs btn-info" style="white-space:normal;">Edit Persons Details</button>
                                        <?php //} ?>
                                    </div-->

                                            <!--div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <?php //echo form_input(['type'=>'date', 'name'=>'arrival_date','placeholder'=>'','id'=>'arrival_date', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$arrivals->arrival_date,'readonly'=>$readonly])?>			 
                                            <label class = "mdl-textfield__label">Arrival Date</label><?php //echo form_error('arrival_date');?>

                                        </div>
                                    </div-->
                                            <input type="hidden" name="hdn_arrival_date" id="hdn_arrival_date"
                                                value="<?php echo $arrivals->arrival_date; ?>">
                                            <div class="col-lg-4 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="handling_staff" id="handling_staff"
                                                        class="mdl-textfield__input" <?=$disabled?>>
                                                        <option value=""></option>
                                                        <?php 
                                                foreach($users as $user){                                                   
                                                ?>
                                                        <option value="<?=$user->id?>"
                                                            <?php echo ($user->id==$arrivals->handling_staff_id)?'selected="selected"':''; ?>>
                                                            <?=$user->name?></option>
                                                        <?php  } ?>
                                                    </select>
                                                    <label class="mdl-textfield__label">Handling Staff</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php 
                                          echo form_input(['name'=>'transportation','id'=>'transportation','placeholder'=>'Transportation', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$arrivals->vehicle_name]);
                                          ?>
                                                    <label class="mdl-textfield__label">Transportation</label>
                                                </div>
                                            </div>
                                            <input type="hidden" name="transportation_id" id="transportation_id"
                                                value="<?php echo $arrivals->transportation_id; ?>">
                                            <!--div class="col-lg-1 p-t-20">
                                        <button type="button" style="width: 100%;" data-toggle="modal" data-target="#myModaltransportation" class="mdl-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-success">Add</button>
                                    </div-->

                                            <div class="col-lg-3 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php 
                                          echo form_input(['name'=>'guide','id'=>'guide','placeholder'=>'Guide', 'class'=>'mdl-textfield__input', 'value'=>$arrivals->guide]);
                                          ?>
                                                    <label class="mdl-textfield__label">Guide</label>
                                                </div>
                                            </div>
                                            <input type="hidden" name="guide_id" id="guide_id"
                                                value="<?php echo $arrivals->guide_id; ?>">
                                            <div class="col-lg-1" style="padding-top:35px !important;">
                                                <input type="checkbox" name="chk_guide"
                                                    <?php echo ($arrivals->guide_id == '0')?'checked="checked"':'';  ?>>
                                                No Guide
                                            </div>
                                            <!--div class="col-lg-1 p-t-20">
                                        <button type="button" style="width: 100%;" data-toggle="modal" data-target="#myModalguide" class="mdl-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-success">Add</button>
                                    </div-->

                                            <div class="col-lg-4 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php $group_type = ['Family','Men','Friends','Mice','Ladies','Couple']; ?>
                                                    <select id="group_type" name="group_type"
                                                        class="mdl-textfield__input" <?=$disabled?>>
                                                        <?php foreach($group_type AS $list){ ?>
                                                        <option value="<?=$list?>"
                                                            <?php echo ($arrivals->group_type==$list)?'selected="selected"':''; ?>>
                                                            <?=$list?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <label class="mdl-textfield__label">Group Type</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="handover_to_client" id="handover_to_client"
                                                        class="mdl-textfield__input" <?=$disabled?>>
                                                        <option value="yes"
                                                            <?php echo ($arrivals->handover_to_client=='yes')?'selected="selected"':''; ?>>
                                                            Yes</option>
                                                        <option value="no"
                                                            <?php echo ($arrivals->handover_to_client=='no')?'selected="selected"':''; ?>>
                                                            No</option>
                                                    </select>
                                                    <label class="mdl-textfield__label">Handover To Client</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                                    <select name="handover_to_kazin" id="handover_to_kazin"
                                                        class="mdl-textfield__input" <?=$disabled?>>
                                                        <option value="yes"
                                                            <?php echo ($arrivals->handover_to_kazin=='yes')?'selected="selected"':''; ?>>
                                                            Yes</option>
                                                        <option value="no"
                                                            <?php echo ($arrivals->handover_to_kazin=='no')?'selected="selected"':''; ?>>
                                                            No</option>
                                                    </select>
                                                    <label class="mdl-textfield__label">Handover To Kazin</label>
                                                </div>
                                            </div>
                                            <?php if(in_array($this->session->userdata('type'),['1','3'])){ ?>
                                            <div class="col-lg-4 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                                    <select name="currency" id="currency" class="mdl-textfield__input"
                                                        <?=$disabled?>>
                                                        <option value="dollar"
                                                            <?php echo ($arrivals->currency=='dollar')?'selected="selected"':''; ?>>
                                                            Dollar ($)</option>
                                                        <option value="inr"
                                                            <?php echo ($arrivals->currency=='inr')?'selected="selected"':''; ?>>
                                                            INR (&#8377;)</option>
                                                    </select>
                                                    <label class="mdl-textfield__label">Currency</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <input type="text" class="mdl-textfield__input"
                                                        name="client_billing" id="client_billing"
                                                        value="<?php echo $arrivals->client_billing; ?>" readonly>
                                                    <label class="mdl-textfield__label">Client Billing (Amount)</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <input type="number" min="0" class="mdl-textfield__input"
                                                        name="balance_amount" id="balance_amount"
                                                        value="<?php echo $arrivals->balance_amount; ?>" readonly>
                                                    <label class="mdl-textfield__label">Balance Amount</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <input type="number" min="0" class="mdl-textfield__input"
                                                        name="payment_india" id=""
                                                        value="<?php echo $arrivals->payment_received_india; ?>"
                                                        readonly>
                                                    <label class="mdl-textfield__label">Payment In India</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <input type="number" min="0" class="mdl-textfield__input"
                                                        name="payment_other " id=""
                                                        value="<?php echo $arrivals->payment_received_other; ?>"
                                                        readonly>
                                                    <label class="mdl-textfield__label">Payment In other Country</label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="col-lg-6 p-t-20">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                                    <select name="status" id="status" class="mdl-textfield__input">
                                                        <option value="in-progress"
                                                            <?php echo ($arrivals->status=='in-progress')?'selected="selected"':''; ?>>
                                                            In Progress</option>
                                                        <option value="complete"
                                                            <?php echo ($arrivals->status=='complete')?'selected="selected"':''; ?>>
                                                            Complete</option>
                                                        <option value="cancel"
                                                            <?php echo ($arrivals->status=='cancel')?'selected="selected"':''; ?>>
                                                            Cancel</option>
                                                        <option value="file-closed"
                                                            <?php echo ($arrivals->status=='file-closed')?'selected="selected"':''; ?>>
                                                            File Closed</option>
                                                    </select>
                                                    <label class="mdl-textfield__label">Status</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 p-t-20">
                                                <button type="button" style="cursor:pointer;" id="edit_flight_details"
                                                    data-toggle="modal" data-target="#addPaymentDetails"
                                                    class="btn-info p-2">Add Payment Details</button>
                                                <button type="button" style="cursor:pointer;" id="edit_flight_details"
                                                    data-toggle="modal" data-target="#viewPaymentDetails"
                                                    class="btn-info p-2">View Payment Details</button>
                                            </div>



                                            <input type="hidden" name="arrival_id"
                                                value="<?php echo base64_encode($arrivals->id); ?>" />
                                            <div class="col-lg-12 p-t-20 text-center">
                                                <?php echo form_submit(['name'=>'add','id'=>'add', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Update']);?>
                                                <input type="button" value="Cancel" name=""
                                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-danger"
                                                    onclick="history.back();">
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

            <!-- model button -->
            <div class="modal fade" id="addPaymentDetails" role="dialog">
                <div class="modal-dialog modal-lg" style="max-width:600px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Payment Details</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body ui-front">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="msgflightDiv"></div>
                                    <form method="post" action="payment-details">
                                        <input type="hidden" value="<?php echo base64_encode($arrivals->id); ?>"
                                            name="arr_id" id="enq_id">
                                        <div class="card-body" id="">
                                            <div class="row div_color">
                                                <div class="col-lg-12 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="text" name="billing_amount_text"
                                                            value="<?php echo $arrivals->client_billing; ?>"
                                                            class="mdl-textfield__input airline-names" required>
                                                        <label class="mdl-textfield__label">Client Billing
                                                            Amount</label>
                                                    </div>
                                                </div>
                                                <?php if ($arrivals->currency !== ''): ?>
                                                <input type="hidden" name="main_currency"
                                                    value="<?php echo $arrivals->currency; ?>">
                                                <?php endif; ?>
                                                <div class="col-lg-12 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <select name="main_currency" id="select_currency_static"
                                                            class="mdl-textfield__input" style="padding-top:30px;"
                                                            required onchange="updateCurrency()"
                                                            <?php echo ($arrivals->currency !== '') ? 'disabled' : ''; ?>>
                                                            <option value="dollar"
                                                                <?php echo ($arrivals->currency == 'dollar') ? 'selected' : ''; ?>>
                                                                USD ($)</option>
                                                            <option value="inr"
                                                                <?php echo ($arrivals->currency == 'inr') ? 'selected' : ''; ?>>
                                                                INR (&#8377;)</option>
                                                        </select>
                                                        <label class="mdl-textfield__label mb-2">Currency</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body" id="">
                                            <div class="row div_color">
                                                <div class="col-lg-12 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <select name="select_payment_mode"
                                                            class="mdl-textfield__input flight-modes"
                                                            style="padding-top:30px;">
                                                            <option value="none">Select Payment Mode</option>
                                                            <option value="cash_on_arrival">Cash On Arrival</option>
                                                            <option value="bank_in_india">Bank In India</option>
                                                            <option value="cash_in_india">Cash In India</option>
                                                            <option value="remittance">Remittance</option>
                                                        </select>
                                                        <label class="mdl-textfield__label">Payment Mode</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <select name="" id="selected_currency"
                                                            class="mdl-textfield__input" style="padding-top:30px;">
                                                            <option value="">Select Currency</option>
                                                            <option value="dollar">USD (&dollar;)</option>
                                                            <option value="inr">INR (&#8377;)</option>
                                                        </select>
                                                        <label class="mdl-textfield__label">Currency</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="text" name="payment_india" placeholder="" id=""
                                                            class="mdl-textfield__input airline-names">
                                                        <label class="mdl-textfield__label">Payment Recieved in
                                                            India</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <select name="other_country" id="other_country"
                                                            class="mdl-textfield__input" style="padding-top:30px;">
                                                            <option value="">Select Country</option>
                                                            <?php 
                                                    asort($locations);
                                                    foreach($locations AS $key=>$val){  ?>
                                                            <option value="<?=$key?>"
                                                                data-abbr="<?=implode(',',$val)?>"><?= ucfirst($key)?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                        <label class="mdl-textfield__label">Currency</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="text" name="payment_other" placeholder=""
                                                            id="payment_other"
                                                            class="mdl-textfield__input airline-names">
                                                        <label class="mdl-textfield__label">Payment Recieved in Selected
                                                            Country</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="date" name="pay_date" placeholder="" id=""
                                                            class="mdl-textfield__input airline-names">
                                                        <label class="mdl-textfield__label">Date</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="text" name="remarks" placeholder="" id=""
                                                            class="mdl-textfield__input airline-names">
                                                        <label class="mdl-textfield__label">Remarks</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body flight-details_cls p-0" id="flight-details">
                                            <div class="row">
                                                <div class="col-lg-12 mt-3">
                                                    <button class="btn btn-md btn-primary" style="float:right;"
                                                        type="submit">Add</button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 p-t-20">
                                                    <div
                                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <input type="text" value="<?= $arrivals->balance_amount;?>"
                                                            placeholder="" id=""
                                                            class="mdl-textfield__input airline-names">
                                                        <label class="mdl-textfield__label">Balanced Amount</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="viewPaymentDetails" role="dialog">
                <div class="modal-dialog modal-lg" style="max-width:1000px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Payment Details</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body ui-front">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-body" id="">
                                        <div class="row div_color">
                                            <div class="col-lg-12 p-t-20">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th>
                                                                Client Billing Amount
                                                            </th>
                                                            <td>
                                                                <?php echo $arrivals->client_billing; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>
                                                                Currency
                                                            </th>
                                                            <td>
                                                                <?php echo strtoupper($arrivals->currency);?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>
                                                                Balance Amount
                                                            </th>
                                                            <td>
                                                                <?php echo $arrivals->balance_amount; ?>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="card-body pt-2 p-0" id="">
                                            <div class="row div_color">
                                                <div class="col-lg-12 p-t-20">
                                                    <table class="table table-responsive">
                                                        <tbody>
                                                            <tr>
                                                                <th>
                                                                    Sr. No.
                                                                </th>
                                                                <th>
                                                                    Payment mode
                                                                </th>
                                                                <th>
                                                                    Currency
                                                                </th>
                                                                <th>
                                                                    Payment India
                                                                </th>
                                                                <th>
                                                                    Other country
                                                                </th>
                                                                <th>
                                                                    Other country Payment
                                                                </th>
                                                                <th>
                                                                    Payment Date
                                                                </th>
                                                                <th>
                                                                    Remarks
                                                                </th>
                                                            </tr>
                                                            <?php if($payment_data) :?>
                                                            <? $count = 1; ?>
                                                            <?php foreach($payment_data as $payment):?>
                                                            <tr>
                                                                <td> <?php echo $count+1?></td>
                                                                <td>
                                                                    <?=  str_replace('_', ' ', strtoupper($payment->payment_mode));?>

                                                                </td>
                                                                <td>
                                                                    <?= strtoupper($payment->currency); ?>
                                                                </td>
                                                                <td>
                                                                    <?= $payment->payment_recieved_in_india?>
                                                                </td>
                                                                <td>
                                                                    <?= $payment->other_country?>
                                                                </td>
                                                                <td>
                                                                    <?= $payment->payment_recieved_in_other?>
                                                                </td>
                                                                <td>
                                                                    <?= $payment->date?>
                                                                </td>
                                                                <td>
                                                                    <?= $payment->remarks?>
                                                                </td>
                                                            </tr>
                                                            <?php $count++; ?>
                                                            <?php endforeach;?>

                                                            <?php endif;?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


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
            <script src="assets/js/bootstrap.js"></script>
            <script>
            /*function rooms_model(){
        event.preventDefault();
        if($("#hotel_id").val()==''){
            alert("Please Select Hotel To Proceed");
            return false;
        }
        var hotel_id = $("#hotel_id").val();
        var cnt = $('.room-category').length;
        $.ajax({
            url: "<?php //echo base_url('admin/hotel/get_rooms_category'); ?>",
            type: "post",
            data: { 'hotel_id': hotel_id },
            dataType: 'JSON',
            //contentType: false,
            //processData: false,
            beforeSend: function(){                
            },
            success: function (data) {
                $('.room-category:eq('+(cnt-1)+')').empty();
                if(data.response === "e"){
                }
                else if(data.response === "s"){
                    $('.room-category:eq('+(cnt-1)+')').append('<option value="">Select..</option>');
                    $.each(data.details, function(i, d) {
                        $('.room-category:eq('+(cnt-1)+')').append('<option value="' + d.category_name + '" data-adults="'+d.number_adults+'" data-childs="'+d.number_childs+'" data-childbed="'+d.child_bed+'">' + d.category_name + '</option>');
                    });
                }
            }
        });
        $("#hotel-name").html($("#hotel").val());
        $("#myModalrooms").modal("toggle");
        $("#myModalrooms").modal("toggle");
    }*/

            function rooms_model() {
                event.preventDefault();
                var enq_id = $("#enq_id").val();
                $.ajax({
                    url: "<?php echo base_url('admin/arrivalchart/get_hotel_details'); ?>",
                    type: "post",
                    data: {
                        'enq_id': enq_id
                    },
                    dataType: 'JSON',
                    //contentType: false,
                    //processData: false,
                    beforeSend: function() {},
                    success: function(data) {
                        //$('.room-category:eq(0)').empty();
                        if (data.response === "e") {
                            alert('No hotel(s) details found!');
                            return false;
                        } else if (data.response === "s") {
                            $('#roominglist_hotels').empty().append(
                                '<option value="">Select Hotel..</option>');
                            $.each(data.details, function(i, d) {
                                $('#roominglist_hotels').append('<option data-attr="' + d.id +
                                    '" value="' + d.hotel_id + '">' + d.hotel_name + '</option>'
                                );
                            });
                            $("#myModalrooms").modal("toggle");
                        }
                    }
                });
            }

            $(document).ready(function() {
                $("#hotel").autocomplete({
                    source: function(request, response) {
                        // Fetch data
                        $.ajax({
                            url: "<?=base_url()?>admin/arrivalchart/hotel_name_suggesstion",
                            type: 'post',
                            dataType: "json",
                            data: {
                                search: request.term,
                                'location': '<?php echo $arrivals->enquiry_abbr; ?>'
                            },
                            success: function(data) {
                                response(data);
                                dt = data;
                                $(".err").html('');;
                            }
                        });
                    },
                    select: function(event, ui) {
                        // Set selection
                        $('#hotel').val(ui.item.label); // display the selected text
                        $('#hotel_id').val(ui.item.h_id); // save selected id to input
                    }
                });

                $("#roominglist_hotels").on("change", function() {
                    event.preventDefault();
                    var hotel_id = $(this).val();
                    var hotel_details_id = $("#roominglist_hotels option:selected").attr("data-attr");
                    var radioIdx = $(":radio[name='rdo_list']").index($(
                        ":radio[name='rdo_list']:checked"));
                    $.ajax({
                        url: "<?php echo base_url('admin/hotel/get_rooms_category'); ?>",
                        type: "post",
                        data: {
                            'hotel_id': hotel_id,
                            'enq_id': $("#enq_id").val(),
                            'hotel_details_id': hotel_details_id
                        },
                        dataType: 'JSON',
                        //contentType: false,
                        //processData: false,
                        beforeSend: function() {},
                        success: function(data) {
                            $('.room-category:eq(' + radioIdx + ')').empty();
                            if (data.response === "e") {} else if (data.response === "s") {
                                $('.hotel-details-ids:eq(' + radioIdx + ')').val(hotel_id);
                                $('.arrival-hotel-details-ids:eq(' + radioIdx + ')').val(
                                    hotel_details_id);
                                $('.room-category:eq(' + radioIdx + ')').empty().append(
                                    '<option value="">Select..</option>');
                                $.each(data.details.room_categories, function(i, d) {
                                    $('.room-category:eq(' + radioIdx + ')').append(
                                        '<option value="' + d.category_name +
                                        '" data-adults="' + d.number_adults +
                                        '" data-childs="' + d.number_childs +
                                        '" data-childbed="' + d.child_bed +
                                        '">' + d.category_name + '</option>');
                                });
                                $('.check-in:eq(' + radioIdx + ')').val(data.details
                                    .hotel_details.checkin_date);
                                $('.check-out:eq(' + radioIdx + ')').val(data.details
                                    .hotel_details.checkout_date);
                            }
                        }
                    });
                });

                $("#frm_hoteldetails").on('keydown.autocomplete', ".hotel-names", function() {
                    var ele = $(this);
                    var idx = ele.index(".hotel-names");
                    /*var d = $('.hotel-names').eq(idx).attr("id");*/

                    $(this).autocomplete({
                        source: function(request, response) {
                            // Fetch data
                            $.ajax({
                                url: "<?=base_url()?>admin/arrivalchart/hotel_name_suggesstion",
                                type: 'post',
                                dataType: "json",
                                data: {
                                    search: request.term,
                                    'location': '<?php echo $arrivals->enquiry_abbr; ?>'
                                },
                                success: function(data) {
                                    /*$.each(data, function (index, item) {
                                         $('#'+d).appendTo("<ul><li class=''>" + item.label + "</li></ul>");
                                    });*/
                                    response(data)
                                }
                            });
                        },
                        select: function(event, ui) {
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
                        source: function(request, response) {
                            // Fetch data
                            $.ajax({
                                url: "<?=base_url()?>admin/arrivalchart/airline_name_suggesstion",
                                type: 'post',
                                dataType: "json",
                                data: {
                                    search: request.term,
                                    'location': ''
                                },
                                success: function(data) {
                                    /*$.each(data, function (index, item) {
                                         $('#'+d).appendTo("<ul><li class=''>" + item.label + "</li></ul>");
                                    });*/
                                    response(data)
                                }
                            });
                        },
                        select: function(event, ui) {
                            // Set selection
                            $(this).val(ui.item.label); // display the selected text
                            $(".airline-ids").eq(idx).val(ui.item.a_id);
                            //$('#hotel_id').val(ui.item.h_id); // save selected id to input
                        }
                    });
                });

                $("#transportation").autocomplete({
                    source: function(request, response) {
                        // Fetch data
                        $.ajax({
                            url: "<?=base_url()?>admin/arrivalchart/transportation_name_suggesstion",
                            type: 'post',
                            dataType: "json",
                            data: {
                                search: request.term,
                                'location': '<?php echo $arrivals->enquiry_abbr; ?>'
                            },
                            success: function(data) {
                                response(data);
                                dt = data;
                                $(".err").html('');;
                            }
                        });
                    },
                    select: function(event, ui) {
                        // Set selection
                        $('#transportation').val(ui.item.label); // display the selected text
                        $('#transportation_id').val(ui.item.t_id); // save selected id to input
                    }
                });

                $("#guide").autocomplete({
                    source: function(request, response) {
                        // Fetch data
                        $.ajax({
                            url: "<?=base_url()?>admin/arrivalchart/guide_name_suggesstion",
                            type: 'post',
                            dataType: "json",
                            data: {
                                search: request.term,
                                'location': '<?php echo $arrivals->enquiry_abbr; ?>'
                            },
                            success: function(data) {
                                response(data);
                                dt = data;
                                $(".err").html('');;
                            }
                        });
                    },
                    select: function(event, ui) {
                        // Set selection
                        $('#guide').val(ui.item.label); // display the selected text
                        $('#guide_id').val(ui.item.g_id); // save selected id to input
                    }
                });


                $(".dts").on("change", function() {
                    if ($('.dts:eq(0)').val() === "" || $('.dts:eq(1)').val() === "") {
                        return false;
                    }
                    const pre = new Date($('.dts:eq(0)').val());
                    const last = new Date($('.dts:eq(1)').val());
                    if (pre > last) {
                        alert('Check-in date must be less than Check-out date.');
                        $(".dts").val('');
                    } else {
                        const diffInMs = Math.abs(last - pre);
                        const diffInDays = Math.round(diffInMs / (1000 * 60 * 60 * 24));
                        $("#number_of_nights").val(diffInDays);
                    }
                });

                $("#frm_flightdetails").on('change', '.dts-flight', function() {
                    var ele = $(this);
                    var idx = ele.index(".dts-flight");
                    var op = $('.dts-flight:eq(' + idx + ')').attr("data-operator");
                    var checkin_idx = checkout_idx = "";
                    if (op == "plus") {
                        checkin_idx = idx;
                        checkout_idx = parseInt(idx) + 1;
                    } else {
                        checkin_idx = parseInt(idx) - 1;
                        checkout_idx = idx;
                    }

                    if ($('.dts-flight:eq(' + checkin_idx + ')').val() === "" || $('.dts-flight:eq(' +
                            checkout_idx + ')').val() === "") {
                        return false;
                    }
                    const pre = new Date($('.dts-flight:eq(' + checkin_idx + ')').val());
                    const last = new Date($('.dts-flight:eq(' + checkout_idx + ')').val());
                    if (pre > last) {
                        alert('Departure date must be less than Arrival date.');
                        $('.dts-flight:eq(' + checkin_idx + ')').val('');
                        $('.dts-flight:eq(' + checkout_idx + ')').val('');
                    }
                });

                $("#btn_hotel").on("click", function() {
                    let myForm = document.getElementById("frm_hotel");
                    var data = new FormData(myForm);
                    $("#btn_hotel").html('Submitting').attr('disabled', 'disabled');
                    $.ajax({
                        url: "<?php echo base_url('admin/arrivalchart/add_hotel'); ?>",
                        type: "post",
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        beforeSend: function() {},
                        success: function(data) {
                            $("#msgDiv").html('').html(data.msg);
                            $("#btn_hotel").html('Submit').removeAttr('disabled',
                                'disabled');
                            if (data.response === "e") {} else if (data.response === "s") {
                                $("#frm_hotel")[0].reset();
                            }
                        }
                    });
                });

                $("#btn_transportation").on("click", function() {
                    let myForm = document.getElementById("frm_transportation");
                    var data = new FormData(myForm);
                    $("#btn_transportation").html('Submitting').attr('disabled', 'disabled');
                    $.ajax({
                        url: "<?php echo base_url('admin/arrivalchart/add_transportation'); ?>",
                        type: "post",
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        beforeSend: function() {},
                        success: function(data) {
                            $("#msgDivagent").html('').html(data.msg);
                            $("#btn_transportation").html('Submit').removeAttr('disabled',
                                'disabled');
                            if (data.response === "e") {} else if (data.response === "s") {
                                $("#frm_transportation")[0].reset();
                            }
                        }
                    });
                });

                $("#btn_guide").on("click", function() {
                    let myForm = document.getElementById("frm_guide");
                    var data = new FormData(myForm);
                    $("#btn_guide").html('Submitting').attr('disabled', 'disabled');
                    $.ajax({
                        url: "<?php echo base_url('admin/arrivalchart/add_guide'); ?>",
                        type: "post",
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        beforeSend: function() {},
                        success: function(data) {
                            $("#msgDivguide").html('').html(data.msg);
                            $("#btn_guide").html('Submit').removeAttr('disabled',
                                'disabled');
                            if (data.response === "e") {} else if (data.response === "s") {
                                $("#frm_guide")[0].reset();
                            }
                        }
                    });
                });

                $("#frm_roomdetails").on('change', '.person-category', function() {
                    var ele = $(this);
                    var idx = ele.index(".person-category");
                    var child = {
                        min: 3,
                        max: 11
                    };
                    var infant = {
                        min: 1,
                        max: 2
                    };
                    var d;
                    if (ele.val() != "adult") {
                        $('.child-age').eq(idx).attr("required", "required").empty().append(
                            '<option value="">Select..</option>').parent().addClass("is-focused");
                        if (ele.val() == "child") {
                            d = child;
                        } else {
                            d = infant;
                        }

                        for (var i = d.min; i <= d.max; i++) {
                            $('.child-age').eq(idx).append('<option value="' + i + '">' + i +
                                '</option>');
                        }

                    } else {
                        $('.child-age').eq(idx).removeAttr("required").empty().append(
                            '<option value="NA">NA</option>').parent().addClass("is-focused");
                    }
                });

                $("#frm_persondetails").on('click', '.fa-remove', function(e) {
                    e.preventDefault();
                    $(this).parent().remove(); //Remove field html
                });

                $("#frm_roomdetails").on('click', '.fa-remove', function(e) {
                    e.preventDefault();
                    $(this).parent().remove(); //Remove field html
                });

                $("#frm_flightdetails").on('click', '.fa-remove', function(e) {
                    e.preventDefault();
                    $(this).parent().remove(); //Remove field html
                });

                $("#frm_hoteldetails").on('click', '.fa-remove', function(e) {
                    e.preventDefault();
                    $(this).parent().parent().remove(); //Remove field html
                });

                $(".edit-remove").on("click", function(e) {
                    if (!confirm('Are You Sure?')) {
                        return false;
                    }
                    e.preventDefault();
                    var ele = $(this);
                    $.ajax({
                        url: "<?php echo site_url('edit_remove_details'); ?>",
                        type: "post",
                        data: {
                            'module_id': ele.attr("data-id"),
                            'module': ele.attr("data-module"),
                            'enq_id': $("#enq_id").val()
                        },
                        dataType: 'JSON',
                        //contentType : false,
                        //processData: false,
                        beforeSend: function() {},
                        success: function(res) {
                            if (res.response === "s") {
                                ele.parent().parent().remove();
                            }
                        }
                    });
                });

                $("#frm_roomdetails").on('change', '.dt-room', function() {
                    var ele = $(this);
                    var idx = ele.index(".dt-room");
                    var op = $('.dt-room:eq(' + idx + ')').attr("data-operator");
                    var checkin_idx = checkout_idx = "";
                    if (op == "plus") {
                        checkin_idx = idx;
                        checkout_idx = parseInt(idx) + 1;
                    } else {
                        checkin_idx = parseInt(idx) - 1;
                        checkout_idx = idx;
                    }

                    if ($('.dt-room:eq(' + checkin_idx + ')').val() === "" || $('.dt-room:eq(' +
                            checkout_idx + ')').val() === "") {
                        return false;
                    }
                    const pre = new Date($('.dt-room:eq(' + checkin_idx + ')').val());
                    const last = new Date($('.dt-room:eq(' + checkout_idx + ')').val());
                    if (pre > last) {
                        alert('Check-in date must be less than Check-out date.');
                        $('.dt-room:eq(' + checkin_idx + ')').val('');
                        $('.dt-room:eq(' + checkout_idx + ')').val('');
                    }
                });

                $(".payment").on("blur", function() {
                    $("#err_billing").html('');
                    if ($(this).val() == '') {
                        $(this).val("0").parent("div").addClass("is-focused");
                    }
                    if ($("#client_billing").val() == '') {
                        $("#err_billing").html(
                            '<div class="alert alert-danger" style="padding: 0 5px;">Client Billing Amount Cannot Be Empty!</div>'
                        );
                        $(this).val(0);
                        return false;
                    }
                    var balance_amt = parseInt($("#client_billing").val()) - (parseInt($(
                        ".payment:eq(0)").val()) + parseInt($(".payment:eq(1)").val()));
                    $("#balance_amount").val(balance_amt).parent("div").addClass("is-focused");
                });

                $("#frm_roomdetails").on('change', '.room-category', function() {
                    var ele = $(this);
                    var idx = ele.index(".room-category");
                    var adult_max = $('.room-category option:selected').eq(idx).attr("data-adults");
                    var child_max = $('.room-category option:selected').eq(idx).attr("data-childs");
                    var child_bed = $('.room-category option:selected').eq(idx).attr("data-childbed");
                    $('#frm_roomdetails .room-adults').eq(idx).attr("max", adult_max);
                    $('#frm_roomdetails .room-childs').eq(idx).attr("max", child_max);
                    $('#frm_roomdetails .room-childbed').eq(idx).empty().append(
                        '<option value="N/A">N/A</option><option value="' + child_bed + '">' +
                        child_bed + '</option>').parent("div").addClass("is-focused");
                });

                $("#frm_roomdetails").on('click', '.add-person-details', function() {
                    event.preventDefault();
                    var ele = $(this);
                    var idx = ele.index(".add-person-details");

                    if ($('#frm_roomdetails .room-adults').eq(idx).val() > $(
                            '#frm_roomdetails .room-adults').eq(idx).attr('max')) {
                        alert("Maximum allowed value is " + $('#frm_roomdetails .room-adults').eq(idx)
                            .attr('max'));
                        $('#frm_roomdetails .room-adults').eq(idx).focus();
                        return false;
                    }
                    if ($('#frm_roomdetails .room-childs').eq(idx).val() > $(
                            '#frm_roomdetails .room-childs').eq(idx).attr('max')) {
                        alert("Maximum allowed value is " + $('#frm_roomdetails .room-childs').eq(idx)
                            .attr('max'));
                        $('#frm_roomdetails .room-childs').eq(idx).focus();
                        return false;
                    }

                    var total_persons = parseInt($('#frm_roomdetails .room-adults').eq(idx).val()) +
                        parseInt($('#frm_roomdetails .room-childs').eq(idx).val());
                    var html = '<div class="row">';
                    html +=
                        '<div class="col-lg-1"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused"><input type="text" name="first_name[]" placeholder="" id="" value="" class="mdl-textfield__input" required><label class = "mdl-textfield__label">First Name</label></div></div>';
                    html +=
                        '<div class="col-lg-1"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused"><input type="text" name="last_name[]" placeholder="" id="" value="" class="mdl-textfield__input" required><label class = "mdl-textfield__label">Last Name</label></div></div>';
                    html +=
                        '<div class="col-lg-1"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">';
                    html +=
                        '<select name="person_category[]" class="mdl-textfield__input person-category" style="padding:8px;" required>';
                    html += '<option value="adult">Adult</option>';
                    html += '<option value="child">Child</option>';
                    html += '<option value="infant">Infant</option>';
                    html += '</select>';
                    html += '<label class = "mdl-textfield__label">Category</label></div></div>';
                    html +=
                        '<div class="col-lg-1"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">';
                    html +=
                        '<select name="age[]" class="mdl-textfield__input child-age" style="padding:8px;">'
                    html += '<option value="NA">NA</option>';
                    html += '</select>';
                    html += '<label class = "mdl-textfield__label">Age</label></div></div>';
                    html +=
                        '<div class="col-lg-2"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused"><input type="text" name="passport_number[]" placeholder="" id="" value="" class="mdl-textfield__input" required><label class = "mdl-textfield__label">Passport No.</label></div></div>';
                    html +=
                        '<div class="col-lg-1"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused"><input type="text" name="nationality[]" placeholder="" id="" value="" class="mdl-textfield__input" required><label class = "mdl-textfield__label">Nationality</label></div></div>';
                    html +=
                        '<div class="col-lg-2"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">';
                    html +=
                        '<select name="smoking[]" class="mdl-textfield__input" style="padding:8px;" required>';
                    html += '<option value="smoking">Smoking</option>';
                    html += '<option value="non-smoking">Non-smoking</option>';
                    html += '</select>';
                    html += '<label class = "mdl-textfield__label">Smoking</label></div></div>';
                    html +=
                        '<div class="col-lg-1"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">';
                    html +=
                        '<select name="meals[]" class="mdl-textfield__input" style="padding:8px;" required>';
                    html +=
                        '<option value="veg">Veg</option><option value="non-veg">Non-veg</option><option value="other">Other</option>';
                    html += '</select><label class = "mdl-textfield__label">Meals</label></div></div>';
                    html +=
                        '<div class="col-lg-2"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused"><input type="text" name="remarks[]" placeholder="" id="" value="" class="mdl-textfield__input"><label class = "mdl-textfield__label">Remarks</label></div></div>';
                    html += '</div>';
                    $('#frm_roomdetails .div-person-details').eq(idx).html('');
                    for (var i = 1; i <= total_persons; i++) {
                        $('#frm_roomdetails .div-person-details').eq(idx).append(html);
                    }
                    //html.appendTo($('#frm_roomdetails .div-person-details').eq(idx));
                });

                $("#frm_flightdetails").on('change', "select[name^=flight_number]", function() {
                    var element_idx = $("select[name^=flight_number]").index(this);
                    var flight_num = $("select[name='flight_number[]']").eq(element_idx).val();
                    if (flight_num == "" || flight_num == "undefined") {
                        $("input[name='departure_city[]']").eq(element_idx).val('');
                        $("input[name='departure_time[]']").eq(element_idx).val('');
                        $("input[name='arrival_city[]']").eq(element_idx).val('');
                        $("input[name='arrival_time[]']").eq(element_idx).val('');
                        return false;
                    }
                    $.ajax({
                        url: "<?php echo site_url('get_flight_schedule'); ?>",
                        type: "post",
                        data: {
                            'flight_number': flight_num
                        },
                        dataType: 'JSON',
                        //contentType : false,
                        //processData: false,
                        beforeSend: function() {},
                        success: function(res) {

                            if (res.response === "s") {
                                $("input[name='departure_city[]']").eq(element_idx).val(res
                                    .details.departure_city);
                                $("input[name='departure_time[]']").eq(element_idx).val(res
                                    .details.departure_time);
                                $("input[name='arrival_city[]']").eq(element_idx).val(res
                                    .details.arrival_city);
                                $("input[name='arrival_time[]']").eq(element_idx).val(res
                                    .details.arrival_time);
                            }
                        }
                    });

                });

                $("#frm_flightdetails").on('change', "select[name^=departure_airport]", function() {
                    var element_idx = $("select[name^=departure_airport]").index(this);
                    var airport = $("select[name='departure_airport[]']").eq(element_idx).val();

                    $("input[name='departure_city[]']").eq(element_idx).val('');
                    $("input[name='departure_time[]']").eq(element_idx).val('');
                    $("input[name='arrival_city[]']").eq(element_idx).val('');
                    $("input[name='arrival_time[]']").eq(element_idx).val('');
                    $("select[name='flight_number[]']").eq(element_idx).empty().append(
                        '<option value="">Select..</option>').parent().addClass(
                        "is-dirty is-focused");
                    if (airport == "" || airport == "undefined") {
                        return false;
                    }
                    $.ajax({
                        url: "<?php echo site_url('get_flight_numbers'); ?>",
                        type: "post",
                        data: {
                            'airport': airport
                        },
                        dataType: 'JSON',
                        //contentType : false,
                        //processData: false,
                        beforeSend: function() {},
                        success: function(res) {
                            if (res.response === "s") {
                                $.each(res.details, function(index, item) {
                                    $("select[name='flight_number[]']").eq(
                                        element_idx).append('<option value="' +
                                        item.flight_number + '">' + item
                                        .flight_number + '</option>');
                                });
                            }
                        }
                    });
                });

                $("#frm_flightdetails").on('change', "select[name^=edit_flight_number]", function() {
                    var element_idx = $("select[name^=edit_flight_number]").index(this);
                    var flight_num = $("select[name='edit_flight_number[]']").eq(element_idx).val();
                    if (flight_num == "" || flight_num == "undefined") {
                        $("input[name='edit_departure_city[]']").eq(element_idx).val('');
                        $("input[name='edit_departure_time[]']").eq(element_idx).val('');
                        $("input[name='edit_arrival_city[]']").eq(element_idx).val('');
                        $("input[name='edit_arrival_time[]']").eq(element_idx).val('');
                        return false;
                    }
                    $.ajax({
                        url: "<?php echo site_url('get_flight_schedule'); ?>",
                        type: "post",
                        data: {
                            'flight_number': flight_num
                        },
                        dataType: 'JSON',
                        //contentType : false,
                        //processData: false,
                        beforeSend: function() {},
                        success: function(res) {

                            if (res.response === "s") {
                                $("input[name='edit_departure_city[]']").eq(element_idx)
                                    .val(res.details.departure_city);
                                $("input[name='edit_departure_time[]']").eq(element_idx)
                                    .val(res.details.departure_time);
                                $("input[name='edit_arrival_city[]']").eq(element_idx).val(
                                    res.details.arrival_city);
                                $("input[name='edit_arrival_time[]']").eq(element_idx).val(
                                    res.details.arrival_time);
                            }
                        }
                    });

                });

                $("#frm_flightdetails").on('change', "select[name^=edit_departure_airport]", function() {
                    var element_idx = $("select[name^=edit_departure_airport]").index(this);
                    var airport = $("select[name='edit_departure_airport[]']").eq(element_idx).val();

                    $("input[name='edit_departure_city[]']").eq(element_idx).val('');
                    $("input[name='edit_departure_time[]']").eq(element_idx).val('');
                    $("input[name='edit_arrival_city[]']").eq(element_idx).val('');
                    $("input[name='edit_arrival_time[]']").eq(element_idx).val('');
                    $("select[name='edit_flight_number[]']").eq(element_idx).empty().append(
                        '<option value="">Select..</option>').parent().addClass(
                        "is-dirty is-focused");
                    if (airport == "" || airport == "undefined") {
                        return false;
                    }
                    $.ajax({
                        url: "<?php echo site_url('get_flight_numbers'); ?>",
                        type: "post",
                        data: {
                            'airport': airport
                        },
                        dataType: 'JSON',
                        //contentType : false,
                        //processData: false,
                        beforeSend: function() {},
                        success: function(res) {
                            if (res.response === "s") {
                                $.each(res.details, function(index, item) {
                                    $("select[name='edit_flight_number[]']").eq(
                                        element_idx).append('<option value="' +
                                        item.flight_number + '">' + item
                                        .flight_number + '</option>');
                                });
                            }
                        }
                    });
                });

                $("#btn_save").on("click", function() {
                    let myForm = document.getElementById("frm_hoteldetails");
                    var data = new FormData(myForm);
                    data.set('id', $("#enq_id").val());
                    $("#btn_save").html('Saving...').attr('disabled', 'disabled');
                    $.ajax({
                        url: "<?php echo base_url('admin/arrivalchart/update_hotel_details'); ?>",
                        type: "post",
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        beforeSend: function() {},
                        success: function(data) {
                            $("#msgDivHotel").html('').html(data.msg);
                            $("#btn_save").html('Save').removeAttr('disabled', 'disabled');
                            if (data.response === "e") {} else if (data.response === "s") {
                                $.each(data.details, function(i, d) {
                                    html =
                                        '<div class="row"><div class="col-lg-3 div_color" style="border-top: 1px solid #b7c0c7;border-bottom: 1px solid #b7c0c7;border-left: 1px solid #b7c0c7;">';
                                    html +=
                                        '<div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-dirty txt-full-width">';
                                    html +=
                                        '<input type="date" class="mdl-textfield__input" value="' +
                                        d.checkin_date +
                                        '" readonly="readonly"><label class = "mdl-textfield__label">Check In Date</label></div></div>';
                                    html +=
                                        '<div class="col-lg-3 div_color" style="border-top: 1px solid #b7c0c7;border-bottom: 1px solid #b7c0c7;border-left: 1px solid #b7c0c7;">';
                                    html +=
                                        '<div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-dirty txt-full-width">';
                                    html +=
                                        '<input type="date" class="mdl-textfield__input" value="' +
                                        d.checkout_date +
                                        '" readonly="readonly"><label class = "mdl-textfield__label">Check Out Date</label></div></div>';
                                    html +=
                                        '<div class="col-lg-4 div_color" style="border: 1px solid #b7c0c7;">';
                                    html +=
                                        '<div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-dirty txt-full-width">';
                                    html +=
                                        '<input type="text" class="mdl-textfield__input" value="' +
                                        d.hotel_name +
                                        '" readonly="readonly"><label class = "mdl-textfield__label">Hotel</label></div></div>';
                                    html +=
                                        '<div class="col-lg-1 div_color" style="border-top: 1px solid #b7c0c7;border-bottom: 1px solid #b7c0c7;border-right: 1px solid #b7c0c7;padding:22px;">';
                                    html +=
                                        '<button type="button" data-module="arrival_hotels" class="btn btn-danger btn-xs arrival-hotel-remove" data-id="' +
                                        d.id +
                                        '" title="Remove">Remove</button></div></div>';
                                    $(html).insertBefore(
                                        ".hotel_details_cls:eq(0)");
                                });
                                $("input[name='hotel[]']").eq(0).val('');
                                $("input[name='hotel_ids[]']").eq(0).val('');
                                var cnt = $(".hotel_details_cls").length;
                                var ele = [];
                                for (var i = 1; i <= cnt - 1; i++) {
                                    ele[i - 1] = '.hotel_details_cls:eq(' + i + ')';
                                }
                                $(ele.toString()).remove();
                            }
                        }
                    });
                });

                $(".check-dts, #arrival_date ").on("change", function() {
                    //if($('.check-dts:eq(0)').val()==="" || $('.check-dts:eq(1)').val()==="") { return false; }
                    const pre = new Date($('#arrival_date').val());
                    $(".check-dts").each(function(index, element) {
                        const last = new Date($('.check-dts:eq(' + index + ')').val());
                        if (pre > last) {
                            alert('Arrival date must be less than check-in date.');
                            $("#arrival_date").val($('.check-dts:eq(' + index + ')').val());
                            return false;
                        } else {
                            $("#hdn_arrival_date").val($("#arrival_date").val());
                        }
                    });
                });

                $("#frm_hoteldetails").on("click", ".arrival-hotel-remove", function(e) {
                    if (!confirm(
                            'Are You Sure? All hotel, roomimg and persons list will be removed!')) {
                        return false;
                    }
                    e.preventDefault();
                    var ele = $(this);
                    $.ajax({
                        url: "<?php echo site_url('admin/arrivalchart/edit_remove_hotel_details'); ?>",
                        type: "post",
                        data: {
                            'id': ele.attr("data-id"),
                            'enq_id': $("#enq_id").val()
                        },
                        dataType: 'JSON',
                        //contentType : false,
                        //processData: false,
                        beforeSend: function() {},
                        success: function(res) {
                            if (res.response === "s") {
                                window.location.reload();
                            }
                        }
                    });
                });

                $("#frm_roomdetails").on("blur", ".room-childs", function(e) {
                    var ele = $(this);
                    var idx = ele.index(".room-childs");
                    if (ele.val() === '0') {
                        $(".room-childbed").eq(idx).val('N/A').css('pointer-events', 'none').parent()
                            .addClass("is-dirty");
                    } else {
                        $(".room-childbed").eq(idx).css('pointer-events', '');
                    }
                });


            });

            function formSubmit() {
                event.preventDefault();
                let myForm = document.getElementById("frm_persondetails");
                var data = new FormData(myForm);
                data.set('id', $("#enq_id").val());
                $("#btn_personaldetails").attr("disabled", "disabled");
                $.ajax({
                    url: "<?php echo site_url('edit_personal_details'); ?>",
                    type: "post",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $("#msgDivperson").html("").html(data.msg);
                        $("#btn_personaldetails").removeAttr("disabled");
                        if (data.response === "s") {
                            window.location.reload();
                        }
                    }
                });
            }

            function formSubmitRooms() {
                event.preventDefault();
                let myForm = document.getElementById("frm_roomdetails");
                var data = new FormData(myForm);
                data.set('id', $("#enq_id").val());
                data.set('hotels_cnt', $('#roominglist_hotels option').length - 1);
                $("#btn_roomdetails").attr("disabled", "disabled");
                $.ajax({
                    url: "<?php echo site_url('edit_room_details'); ?>",
                    type: "post",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $("#msgDivroom").html("").html(data.msg);
                        $("#btn_roomdetails").removeAttr("disabled");
                        if (data.response === "s") {
                            window.location.reload();
                        }
                    }
                });
            }

            function formSubmitFlights() {
                event.preventDefault();
                var flight = 0; //$(".flight-modes").length;

                $(".flight-modes").each(function(i, d) {
                    if ($(".airline-names").eq(i).val() !== '' && $(".airline-names").eq(i).val() !==
                        undefined) {
                        flight++;
                    }
                });

                if (flight > 2) {
                    if (!confirm('Added more than two(2) flight details.')) {
                        return false;
                    }
                }
                var flight_mode = '';
                for (var i = 0; i < flight; i++) {
                    if (flight_mode === $(".flight-modes option:selected").eq(i).val()) {
                        alert('Added same flight modes.');
                        return false;
                    }
                    flight_mode = $(".flight-modes option:selected").eq(i).val();
                }

                let myForm = document.getElementById("frm_flightdetails");
                var data = new FormData(myForm);
                data.set('id', $("#enq_id").val());
                $("#btn_flightdetails").attr("disabled", "disabled");
                $.ajax({
                    url: "<?php echo site_url('edit_flight_details'); ?>",
                    type: "post",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $("#msgflightDiv").html("").html(data.msg);
                        $("#btn_flightdetails").removeAttr("disabled");
                        if (data.response === "s") {
                            window.location.reload();
                        }
                    }
                });
            }

            function add_element(id) {
                event.preventDefault();
                $("#roominglist_hotels").val("");
                var x = Math.floor((Math.random() * 1000) + 1);
                var h = $("#" + id).clone().attr('id', id + '_' + x);
                h.find('input').val('');
                h.find('select').val('');
                h.find(".room-category").empty();
                h.append(
                    '<i title="Remove" class="fa fa-remove" style="color:red;cursor: pointer;float: right;margin-top: -15px;position:relative;"></i>'
                );
                h.insertAfter("." + id + "_cls:last");
            }

            function add_ele_hotel(id) {
                event.preventDefault();
                var checkout = $("input[name='check_out[]']").length;
                var x = Math.floor((Math.random() * 1000) + 1);
                var h = $("#" + id).clone().attr('id', id + '_' + x).css("margin-top", "5px");
                h.find('input').val("");
                h.append(
                    '<div class="col-lg-1"><i title="Remove" class="fa fa-remove" style="color:red;cursor: pointer;margin-top: -15px;position:relative;"></i></div>'
                );
                h.insertAfter("." + id + "_cls:last");
                //var d  = new Date($("input[name='check_out[]']").eq(checkout-1).val());
                $("input[name='check_in[]']").eq(checkout).val($("input[name='check_out[]']").eq(checkout - 1).val());
                $("input[name='check_out[]']").eq(checkout).val($("input[name='check_out[]']").eq(checkout - 1).val());
            }
            </script>

            <script>
            $(document).ready(function() {
                // Disable payment_other input field on page load
                $('input[id="payment_other"]').prop('disabled', true);

                // Payment mode change event
                $('select[name="select_payment_mode"]').change(function() {
                    var disableInputs = $(this).val() === 'remittance';
                    $('select[name="other_country"], input[name="payment_india"]').prop('disabled',
                        disableInputs);
                    if (disableInputs) {
                        $('input[name="payment_india"]').val('');
                    }
                });

                // Other country change event
                $('select[name="other_country"]').change(function() {
                    var disablePaymentOther = $(this).val() === '';
                    $('input[id="payment_other"]').prop('disabled', disablePaymentOther);
                });
            });


            // Function to update the second dropdown based on the first dropdown
            function updateCurrency() {
                var selectCurrency = document.getElementById('select_currency_static');
                var selectedCurrency = document.getElementById('selected_currency');

                selectedCurrency.value = selectCurrency.value;
                selectedCurrency.disabled = true;
            }

            // Call the updateCurrency() function once when the page is loaded
            document.addEventListener('DOMContentLoaded', function() {
                updateCurrency();
            });
            </script>


</body>

</html>