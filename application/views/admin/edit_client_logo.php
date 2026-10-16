<?php include('admin_head_css.php'); ?>
<div class="page-wrapper">
  <!-- start page container -->
  <div class="container-fluid">
    <!-- start page content -->
    <div class="page-content-wrapper">
      <div class="page-bar">
        <div class="row page-titles">
          <div class="col-lg-3 col-sm-6  col-6 align-self-center">
            <h4 class="text-themecolor">Edit Company Logo</h4>
          </div>
          <div class="col-lg-4 only-for-dashbord"></div>
          <div class="col-lg-5 col-sm-6 col-6 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
              <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item">
                  <a href="
										<?php echo base_url('dashboard'); ?>">Home </a>
                </li>
                <li class="breadcrumb-item">
                  <a href="
										<?php echo base_url('clients'); ?>">Agents </a>
                </li>
                <li class="breadcrumb-item active">Edit Company Logo</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="page-content"> <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?> 
        <div class="row">
          <div class="col-sm-12">
            <div class="card-box">
              <div class="card-head">
                <button type="button" class="btn btn-dark" title="Previous Page" onclick="history.back();">
                  <i class="fas fa-arrow-left"></i>
                </button>
                <header>Edit Company Logo</header>
              </div>
              <form method="post" enctype="multipart/form-data">
                <div class="card-body row">
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"> <?php if(is_numeric($client->client)){ $client_name =  "Name Not Found"; }else{ $client_name = $client->client; }?> <?php echo form_input(['name'=>'name','id'=>'name','placeholder'=>'Name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$client_name])?> <label class="mdl-textfield__label">Company Name</label> <?php echo form_error('name');?> </div>
                  </div>
                  <input type="hidden" name="company_id" id="company_id" value="
										<?=$client->company?>">
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"> <?php echo form_input(['name'=>'contact_person','id'=>'contact_person','placeholder'=>'Agent Name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$client->contact_person])?> <label class="mdl-textfield__label">Agent Name</label> <?php echo form_error('contact_person');?> </div>
                  </div>
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"> <?php echo form_input(['name'=>'designation','id'=>'designation','placeholder'=>'Agent Designation','required'=>'required',  'class'=>'mdl-textfield__input', 'value'=>$client->designation])?> <label class="mdl-textfield__label">Agent Designation</label> <?php echo form_error('designation');?> </div>
                  </div>
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"> <?php 
                                                        $placeholder = 'Email Address';
                                                        if($client->email==''){
                                                            $placeholder = 'Not Available';
                                                        }
                                                        echo form_input(['name'=>'email','placeholder'=>$placeholder,'type'=>'email','id' =>'email', 'required'=>'required', 'readonly'=>'readonly', 'class'=>'mdl-textfield__input', 'value'=>$client->email])?> <label class="mdl-textfield__label">Email Address</label> <?php echo form_error('email');?> </div>
                  </div>
                  <div class="col-lg-1 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                      <select name="isd_codes" class="mdl-textfield__input" style="padding-top:13px;" disabled> <?php                                                                     
                                                                    $selected = ($client->contact_person_isd_code<>'')?$client->contact_person_isd_code:'+91';
                                                                    foreach($country_isd_codes AS $list){  ?> <option value="
														<?=$list->isd_codes?>" <?php echo ($list->isd_codes==$selected)?'selected':''; ?>> <?=$list->isd_codes.' ('.$list->country.')'?> </option> <?php } ?> </select>
                      <label class="mdl-textfield__label">ISD</label> <?php echo form_error('isd_codes');?>
                    </div>
                  </div>
                  <div class="col-lg-3 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"> <?php echo form_input(['name'=>'contact_number','id'=>'contact_number','placeholder'=>'Contact Number', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$client->contact_person_number])?> <label class="mdl-textfield__label">Contact Number</label> <?php echo form_error('contact_number');?> </div>
                  </div>
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"> <?php echo form_input(['name'=>'country','id'=>'country','placeholder'=>'Country', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$client->country])?> <label class="mdl-textfield__label">Select Country</label>
                    </div>
                  </div>
                  <input type="hidden" name="country_id" id="country_id" value="">
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"> <?php echo form_input(['name'=>'state','id'=>'state','placeholder'=>'State', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$client->state])?> <label class="mdl-textfield__label">State</label>
                    </div>
                  </div>
                  <input type="hidden" name="state_id" id="state_id" value="">
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"> <?php echo form_input(['name'=>'city','id'=>'city','placeholder'=>'city', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$client->city])?> <label class="mdl-textfield__label">City</label>
                    </div>
                  </div>
                  <!--div class="col-lg-4 p-t-20"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"><textarea class="mdl-textfield__input" id="address" name="address" required readonly>
												<?php //echo $client->address ?></textarea><label class = "mdl-textfield__label">Address</label></div></div-->
                  <!--div class="col-lg-4 p-t-20"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
												<?php //echo form_input(['name'=>'gstin','id'=>'gstin','placeholder'=>'GSTIN',  'class'=>'mdl-textfield__input', 'value'=>$client->gstin])?><label class = "mdl-textfield__label">GSTIN (e.g 18AABCU9603R1ZM)</label></div></div-->
                  <div class="col-lg-4 p-t-20">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"> <?php
                              echo form_upload([
                                'name' => 'company_logo',
                                'id' => 'company_logo',
                                'class' => 'mdl-textfield__input',
                                 'required' => 'required',
                              ]);
                        ?> <label class="mdl-textfield__label">Only JPG/JPEG/PNG/GIF (Size <=2MB) (Dimensions:200 X 200) </label>
                    </div>
                  </div>
                  <div class="col-lg-12 p-t-20 text-center"> <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?> <input type="button" value="Cancel" name="" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-danger" onclick="window.location.href='
														<?php echo base_url('clients'); ?>'">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
/*
  $(document).ready(function(){
  
     $( "#name" ).autocomplete({
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
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#name').val(ui.item.label); // display the selected text
       $('#company_id').val(ui.item.company_id); // save selected id to input
	   
	   var company_id = ui.item.company_id;
	   
	$.ajax({
        type: "POST",
        url: "<?=base_url();?>admin/company/get_branch_ajax",
        data:{'company':$("#company_id").val()},
        success: function(data){
            $("#branch").empty();
			$('#branch').append('<option value="">Select Branch</option>');
            var opts = $.parseJSON(data);
            $.each(opts, function(i, d) {
               $('#branch').append('<option value="' + d.branch_id + '">' + d.city + '</option>');
            });
			$('#branch').append('<option value="">Add New Branch</option>');
        },
		 error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });		   
	$("#branch_section").show();	
       return false;
      }
     });

  }); */

$(document).ready(function(){

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
	
       return false;
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

});

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
    
    $("input[type='text']").attr("readonly","readonly");
    
});

</script>	