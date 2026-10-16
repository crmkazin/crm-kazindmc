<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
<?php include('admin_head_css.php');?> 
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

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
                        
            
                        
</div>		 <!-- end sidebar menu -->
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Query Board</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="<?php echo base_url('enquiry-followup'); ?>">Query Board</a></li>
                                
                            </ol>
                        </div>
                    </div>			
                <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>						
                     <div class="row">
                        <div class="col-sm-12">
                                <div class="card-box">
                                        <div class="card-head">
                                            <button type="button" class="btn bg-blue-grey waves-effect" title="Previous Page" onclick="history.back();">
                                                <i class="material-icons">arrow_back</i>
                                            </button>
                                                <header>Add Query (B2C)</header>
                                        </div>	
                                <form method="post">
                                        <div class="card-body row">
                                        
                                            <div class="col-lg-4 p-t-20"> 
                                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                                    <select name="enquiry_type" id="enquiry_type" class="mdl-textfield__input" required>                                                        
                                                        <option value="B2C">B2C</option>                                                        									
                                                    </select>    
                                                    <label class = "mdl-textfield__label">Query Type</label>		 	 
                                                </div>
                                            </div>
                                            
                                            
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <?php
                                            $location_keys = ($this->session->userdata('locations')=='all')?array_keys($locations):[$this->session->userdata('locations')]; ?>
                                            <select name="booking_type" id="booking_type" class="mdl-textfield__input" required> 
                                                <option value=""></option>
                                                <?php foreach($location_keys AS $list){ 
                                                        foreach($locations[$list] AS $v){
                                                    ?>
                                                <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                                                <?php }} ?>
                                            </select>    
                                            <label class = "mdl-textfield__label">Booking Type</label>		 	 
                                        </div>
                                    </div> 
                                    
                                    <div class="col-lg-4 p-t-20"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                        <?php echo form_input(['name'=>'enquiry_no','id'=>'enquiry_no', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=> set_value('enquiry_no'),'readonly'=>True])?>			 
                                    <label class = "mdl-textfield__label">File No</label><?php echo form_error('enquiry_no');?>
                                    <input type="hidden" name="file_seq" id="file_seq" value=""/>
                                  </div>
                                    </div>
                                    <div class="col-lg-2 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <?php echo form_input(['type'=>'number','min'=>0,'name'=>'number_persons','id'=>'number_persons', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('number_persons')])?>			 
                                            <label class = "mdl-textfield__label">Number Of Persons</label><?php echo form_error('number_persons');?>

                                        </div>
                                    </div>
                                    <div class="col-lg-2 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <?php echo form_input(['type'=>'number','min'=>0,'name'=>'number_child','id'=>'number_child', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('number_child')])?>			 
                                            <label class = "mdl-textfield__label">Number Of Child</label><?php echo form_error('number_child');?>

                                        </div>
                                    </div>
                                    <div class="col-lg-2 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <?php echo form_input(['type'=>'date', 'name'=>'check_in','placeholder'=>'','id'=>'check_in', 'required'=>'required', 'class'=>'dts mdl-textfield__input', 'value'=>set_value('check_in')])?>			 
                                            <label class = "mdl-textfield__label">Check In Date</label><?php echo form_error('check_in');?>

                                        </div>
                                    </div>
                                            
                                    <div class="col-lg-2 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <?php echo form_input(['type'=>'date', 'name'=>'check_out','placeholder'=>'','id'=>'check_out', 'required'=>'required', 'class'=>'dts mdl-textfield__input', 'value'=>set_value('check_out')])?>			 
                                            <label class = "mdl-textfield__label">Check Out Date</label><?php echo form_error('check_out');?>

                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <?php echo form_input(['type'=>'number','min'=>0, 'name'=>'number_of_nights','placeholder'=>'','id'=>'number_of_nights', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('number_of_nights')])?>			 
                                            <label class = "mdl-textfield__label">Number Of Nights</label><?php echo form_error('number_of_nights');?>

                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <?php echo form_input(['type'=>'date', 'name'=>'query_received_on','placeholder'=>'','id'=>'query_received_on', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>(set_value('query_received_on')<>'')?set_value('query_received_on'):date('Y-m-d')])?>			 
                                            <label class = "mdl-textfield__label">Query Received Date</label><?php echo form_error('query_received_on');?>

                                        </div>
                                    </div>                                            
                                    
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <select name="mode" id="mode" class="mdl-textfield__input" required> 
                                                <option value="Email">Email</option>
                                                <option value="Phone">Phone</option>									
                                                <option value="Reference">Reference</option>
                                                <option value="Visit">Visit</option>
                                                <option value="Marketing">Marketing</option>                                                
                                            </select>    
                                            <label class = "mdl-textfield__label">Select mode</label>		 	 
                                        </div>
                                    </div>																																																							

                                    <div class="col-lg-4 p-t-20" id="refered_person" style="display:none;"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                                            <select name="reference_by" id="reference_by" class="mdl-textfield__input"> 
                                            <option value=""> </option>
                                            <?php foreach($users AS $list){ ?>
                                                <option value="<?=$list->name?>"><?=$list->name?></option>
                                            <?php } ?>
                                            </select>    
                                                        <label class = "mdl-textfield__label">Select Reference</label>		 	 
                                  </div>
                                    </div>
                                    <div class="col-lg-4 p-t-20"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="file_handle_by" id="file_handle_by" class="mdl-textfield__input"> 
                                                <option value=""></option>
                                                <?php if(!empty($users)){
                                                foreach($users as $user){ 
                                                if($user->type != '5'){    
                                                ?>
                                                <option value="<?=$user->id?>"><?=$user->name?></option>
                                                <?php } 
                                                        } }?>
                                                </select> 
                                    <label class = "mdl-textfield__label">Handling File By</label>	 	 
                                  </div>
                                    </div>                                     
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <!--	<textarea class="mdl-textfield__input" name="remarks[]" required> </textarea> -->
                                                        <input type="text" class="mdl-textfield__input" name="remarks">
                                        <label class = "mdl-textfield__label">Remarks</label>	 	 
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <select name="sales" id="sales" class="mdl-textfield__input"> 
                                                <option value="0">Select..</option>
                                                 <?php if(!empty($users)){
                                                    foreach($users as $user){ 
                                                    if($user->type == '5'){    
                                                    ?>
                                                <option value="<?=$user->id?>"><?=$user->name?></option>
                                                <?php } 
                                                        } }?>
                                            </select> 
                                          <label class = "mdl-textfield__label">Sales Team</label>	 	 
                                        </div>
                                    </div>
                                            
                    <div class="card-body row">
                        <div class="col-sm-12"><h4 style="background-color: #f9f9f9;padding: 10px 10px;">Client Details</h4></div>
                        <div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                <?php echo form_input(['name'=>'company','id'=>'company','placeholder'=>'Company Name',  'class'=>'mdl-textfield__input', 'value'=>set_value('company')])?>			 
                                <label class = "mdl-textfield__label">Company</label><?php echo form_error('company');?>		 	 
                            </div>
                            <input type="hidden" name="company_id" id="company_id">
                        </div>
                        
                    <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <?php echo form_input(['name'=>'client_name','id'=>'client_name','placeholder'=>'Client Name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('client_name')])?>			 
                    <label class = "mdl-textfield__label">Client Name</label>
                  </div>
                    </div>
                    
                    <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <?php echo form_input(['name'=>'client_designation','id'=>'client_designation','placeholder'=>'Client Designation', 'class'=>'mdl-textfield__input', 'value'=>set_value('client_designation')])?>			 
                    <label class = "mdl-textfield__label">Client Designation</label>
                  </div>
                    </div>

                    <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <?php echo form_input(['name'=>'client_email','placeholder'=>'Client Email Address','type'=>'email','id' =>'client_email', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('client_email')])?>			 
                    <label class = "mdl-textfield__label">Client Email Address</label> 	 	 
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
                    
                    <div class="col-lg-2 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <?php echo form_input(['name'=>'client_contact_number','id'=>'client_contact_number','placeholder'=>'Client Contact Number', 'required'=>'required','type'=>'number', 'class'=>'mdl-textfield__input', 'value'=>set_value('client_contact_number')])?>			 
                    <label class = "mdl-textfield__label">Client Contact Number</label>	 	 
                  </div>
                    </div>

                    <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                <?php echo form_input(['name'=>'country','id'=>'country','placeholder'=>'Country', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('country')])?>    
                    <label class = "mdl-textfield__label">Country</label> 		 	 
                  </div>
                    </div>
                <input type="hidden" name="country_id" id="country_id" value="">

                    <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                <?php echo form_input(['name'=>'state','id'=>'state','placeholder'=>'State',  'class'=>'mdl-textfield__input', 'value'=>set_value('state')])?>    
                                        <label class = "mdl-textfield__label">State</label>		 	 
                  </div>
                    </div>
                <input type="hidden" name="state_id" id="state_id" value="">

                    <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                <?php echo form_input(['name'=>'city','id'=>'city','placeholder'=>'City', 'class'=>'mdl-textfield__input', 'value'=>set_value('city')])?>    
                                        <label class = "mdl-textfield__label">City</label>		 	 
                  </div>
                    </div>

                    <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <textarea class="mdl-textfield__input" id="address" name="address" required><?php echo set_value('address');  ?>  </textarea>			
                    <label class = "mdl-textfield__label">Address</label>	 	 
                  </div>
                    </div>									

                    <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                          <?php echo form_input(['name'=>'gstin','id'=>'gstin','placeholder'=>'GSTIN','class'=>'mdl-textfield__input', 'value'=>set_value('gstin')])?>    
                    <label class = "mdl-textfield__label">Company GSTIN(IF Any)(e.g 18AABCU9603R1ZM )</label>	 	 
                  </div>
                    </div>                  
                    </div>                       
                    <div class="col-lg-12 p-t-20 text-center"> 
                         <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>
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
    
    $( "#company" ).autocomplete({
        source: function( request, response ) {
            // Fetch data
            $.ajax({
             url: "<?=base_url()?>admin/company/company_name_suggesstion",
             type: 'post',
             dataType: "json",
             data: {
              search: request.term
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
            $('#company').val(ui.item.label); // display the selected text
            $('#company_id').val(ui.item.company_id); // save selected id to input
            get_agents();
        }
    });
    
    
    $( "#country" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "<?=base_url()?>admin/company/get_country_ajax",
        type: 'post',
        dataType: "json",
        data: {
         search: request.term
        },
        success: function( data ) {
		
         response( data );
        }
       });
      },
     
      select: function (event, ui) {
        // Set selection
        $('#country').val(ui.item.label); // display the selected text
        $('#country_id').val(ui.item.country_id); // save selected id to input
        
      }
    });
    
    $("#btn_company").on("click",function(){
        let myForm = document.getElementById("frm_company");
        var data = new FormData(myForm);
        $("#btn_company").html('Submitting').attr('disabled','disabled');
        $.ajax({
            url: "admin/enquiry/add_new_company",
            type: "post",
            data: data,
            dataType: 'JSON',
            contentType: false,
            processData: false,
            beforeSend: function(){                
            },
            success: function (data) {
                $("#msgDiv").html('').html(data.msg);
                $("#btn_company").html('Submit').removeAttr('disabled','disabled');
                if(data.response === "e"){
                }
                else if(data.response === "s"){
                    $("#frm_company")[0].reset();
                    //$("#company_id").append('<option value="'+data.details.c_id+'">'+data.details.c_name+'</option>');
                }
            }
        });
    });
    
    $("#btn_agent").on("click",function(){
        if($("#company_id").val()===""){ alert('Please select company to add agents.'); return false; }
        let myForm = document.getElementById("frm_agent");
        var data = new FormData(myForm);
        data.set("company_id",$("#company_id").val());
        $("#btn_agent").html('Submitting').attr('disabled','disabled');
        $.ajax({
            url: "admin/enquiry/add_new_agent",
            type: "post",
            data: data,
            dataType: 'JSON',
            contentType: false,
            processData: false,
            beforeSend: function(){                
            },
            success: function (data) {
                $("#msgDivagent").html('').html(data.msg);
                $("#btn_agent").html('Submit').removeAttr('disabled','disabled');
                if(data.response === "e"){
                }
                else if(data.response === "s"){
                    $("#frm_agent")[0].reset();
                    $("#agent").append('<option value="'+data.details.a_id+'">'+data.details.a_name+'</option>');
                }
            }
        });
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
    
    
    
});  
 
$(document).ready(function(){ 

    $( "#state" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "<?=base_url()?>admin/company/get_state_ajax",
        type: 'post',
        dataType: "json",
        data: {
         search: request.term,
		 country_id : $('#country_id').val()
        },
        success: function( data ) {
		
         response( data );
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#state').val(ui.item.label); // display the selected text
       $('#state_id').val(ui.item.state_id); // save selected id to input
	
       return false;
      }
     });
    $("#booking_type").on("change",function(){
        if($("#booking_type").val() === ''){ $("#enquiry_no").val(''); return false; }
        $.ajax({
            type: "POST",
            url: "<?=base_url();?>admin/enquiry/get_enquiry_num",
            data:{'booking_type':$("#booking_type").val()},
            dataType: 'JSON',
            success: function(data){
                $("#enquiry_no").parent("div").addClass("is-dirty is-focused");
                $("#enquiry_no").val('').val(data.file_num);
                $("#file_seq").val(data.file_seq);
            },
            error: function(jqXHR, textStatus, errorThrown) {
            }
        });
    });
    
     
});

    function get_agents(){
        if($("#company_id").val() === "") { $("#agent").empty(); return false; }
        $.ajax({
            type: "POST",
            url: "<?=base_url();?>admin/company/get_branch_ajax",
            data:{'company':$("#company_id").val()},
            success: function(data){
                $("#agent").empty().parent().addClass("is-dirty");
                //$('#branch').append('<option value="">Select Branch</option>');
                var opts = $.parseJSON(data);
                $.each(opts, function(i, d) {
                   $('#agent').append('<option value="' + d.company_id +'_' +d.contact_person + '">' + d.contact_person + '</option>');
                });
                
            },
                error: function(jqXHR, textStatus, errorThrown) {
            }
        });
    }

$(document).ready(function(){ 

     $( "#city" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "<?=base_url()?>admin/company/get_city_ajax",
        type: 'post',
        dataType: "json",
        data: {
         search: request.term,
		 state_id:$('#state_id').val()
        },
        success: function( data ) {
		
         response( data );
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#city').val(ui.item.label); // display the selected text
    //   $('#company_id').val(ui.item.company_id); // save selected id to input
	
       return false;
      }
     });

});
 



</script>	
</body>
</html>