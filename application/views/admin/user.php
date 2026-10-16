<?php include('admin_head_css.php'); ?>
<link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet" />
<style>
    .select2-selection__choice {
        background-color: #e0e0e0;
        border-radius: 1rem;
        font-size: 8px !important;
        color: #000 !important;
        height: 1.5rem !important;
        padding: 0 10px !important;
    }
    .select2-selection_choice_remove{
        transform:scale(0.8) !important;
    }
    .select2-selection{
        border: solid 1px #ccc !important;
        border-radius: 4px !important;
        padding: 0px 8px !important;

    }
    .selected{
        font-size: 12px !important;
    }
    button, input, optgroup, textarea{
            font-size: 12px !important;
    }

    .select2-search__field{
        margin-left: 2px !important;

    }
    select, input{
        height: 38px !important;
    }
</style>
 <div class="page-wrapper">
        <div class="container-fluid">
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-2 col-sm-6  col-6 align-self-center">
                        <h4 class="text-themecolor">Add User</h4>
                        </div>
                        <div class="col-lg-6 only-for-dashbord">
                        </div>
                        <div class="col-lg-4 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('all-user'); ?>">Users</a></li>
                                    <li class="breadcrumb-item active">Add User</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>	
                <div class="page-content">
                    <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>						
                    <div class="row">
			        <div class="col-sm-12">
                            <div class="card-box">
                             
                                    <form method="post">
                                    <div class="card-body row">
                                        
                                    <div class="col-lg-4 col-sm-6 p-t-10"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                              <label class = "mdl-textfield__label">Name</label>	
                                    <?php echo form_input(['name'=>'name','id'=>'name','class'=>'mdl-textfield__input','required'=>'required','value'=>set_value('name')])?>			 
                                       	 
                                      </div>
                                        </div>

                                        <div class="col-lg-4 col-sm-6 p-t-10"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class = "mdl-textfield__label">Email</label>
                                    <?php echo form_input(['name'=>'email','id'=>'email','class'=>'mdl-textfield__input','required'=>'required','value'=>set_value('email')])?>			 
                                        <?php echo form_error('email'); ?>	 	 
                                      </div>
                                        </div>
                                                
                                      
                                                
                                        <div class="col-lg-4 col-sm-6 p-t-10"> 

                                                    <div>
                                                        <div class="d-flex">
                                                            <label class = "mdl-textfield__label">ISD &nbsp;&nbsp; Mobile</label><?php echo form_error('isd_codes');?>
                                                            <!-- <label class = "mdl-textfield__label"></label> -->
                                                        </div>
                                                        
                                                            <div class="d-flex" style="border: 1px solid #ccc;border-radius: 5px;">
                                                                <select name="isd_codes" class="" style="border-width: 0 !important;width: 100px;border-radius: 6px;">
                                                            <?php 
                                                            $selected = '+91';
                                                            $allowed_countries = ['AZ','BY','IN','KZ','GE','AE','AM', 'UZ'];
                                                            foreach($country_isd_codes AS $list){  
                                                                    if(in_array($list->country_code,$allowed_countries)){
                                                                ?>
                                                                        <option value="<?=$list->isd_codes?>" <?php echo ($list->isd_codes==$selected)?'selected':''; ?> ><?=$list->isd_codes.' ('.$list->country.')'; ?></option>
                                                            <?php } } ?>
                                                            </select>
                                                                                                        <div class = " mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        
                                                <?php echo form_input(['name'=>'mobile','id'=>'mobile','type'=>'number','required'=>'required','value'=>set_value('mobile'), 'style' => 'width: 100%; border: none;'])?>			 
                                                    <?php echo form_error('mobile'); ?>	 	 
                                                </div>
                                                </div>
                                           		 	 
                                            </div>

                                        </div>
                                        <div class="col-lg-4 col-sm-6 p-t-10"> 
                                             <label class = "mdl-textfield__label">Password</label>	
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name'=>'password','id'=>'password','class'=>'mdl-textfield__input','required'=>'required','value'=>set_value('password')])?>			 
                                        	 
                                        </div>
                                        </div>

                                        <div class="col-lg-4 col-sm-6 p-t-10"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                  <label class = "mdl-textfield__label">Type</label>	
                                                <select name="type" id="type" class="mdl-textfield__input" required> 
                                                        <option value=""></option>
                                                        <option value="1">Admin</option>
                                                        <option value="2">User</option>
                                                        <option value="3">Accounts</option>
                                                        <option value="4">International</option>
                                                        <option value="5">Sales</option>
                                                        <option value="6">Sales International</option>
                                                        <!--<option value="7">T- Syndicate Group</option>-->
                                                        <?php //if($this->session->userdata('type') == 1){ ?> 
                                                        <!-- <option value="7">HOD</option> -->
                                                        <?php //} ?>
                                                </select>			 
                                               	 
                                            </div>
                                        </div>

                                        <?php //if($this->session->userdata('type') == 1){ ?> 
                                        <!-- <div class="col-lg-4 col-sm-6 p-t-10 hod_type" style="display:none;">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">HOD</label>	
                                                <select name="hod_type" id="hod_type" class="mdl-textfield__input" required> 
                                                    <option value=""></option>
                                                    <?php //foreach($user_data as $hod_data){ ?>
                                                        <option value="<?php //echo $hod_data->id; ?>"><?php //echo $hod_data->name; ?></option>
                                                    <?php //} ?>
                                                </select>			 
                                            </div>
                                        </div> -->
                                        <?php //} ?>

                                        
                                        <div class="col-lg-2 p-t-10 hide"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class = "mdl-textfield__label">Reporting Manager</label>	KazakhstanAzerbaijanBelarusGeorgiaAll
                                                Assigned Location
                                                <select name="head_admin_id" id="head_admin_id" class="mdl-textfield__input"> 
                                                    <option value="">No</option>
                                                    <?php foreach($sales AS $list){ ?>
                                                        <option value="<?=$list->id ?>" data-region="<?php echo $list->region; ?>"><?=$list->name ?></option>
                                                    <?php } ?>                                                        
                                                </select>			 
                                                 	 
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4 col-sm-6 p-t-10 hide"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="region[]" id="region" class="mdl-textfield__input js-example-basic-multiple" multiple=""> 
                                                    <option value="all">All</option>
                                                    <?php foreach($states AS $list){ ?>
                                                        <option value="<?=$list->name; ?>"><?=$list->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4 col-sm-6 p-t-10 hide"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="region_international[]" id="region_international" class="mdl-textfield__input js-example-basic-multiple" multiple=""> 
                                                    <option value="all">All</option>
                                                    <?php foreach($countries AS $list){ ?>
                                                        <option value="<?=$list->name; ?>"><?=$list->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

										<div class="col-lg-4 col-sm-6 p-t-10 hide"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                              <label class = "mdl-textfield__label">Accounts User Type</label> 
                                                <select name="accounts_usertype" id="accounts_usertype" class="mdl-textfield__input"> 
                                                    <option value=""></option>
                                                    <option value="accounts_admin">Admin (Payments All Rights)</option>
                                                    <option value="accounts_user">User (Payments Add,View Rights)</option>
                                                    <option value="accounts_view">User (View Rights)</option>
                                                </select>
											</div>
                                        </div>
										
                                        
                                        <div class="col-lg-4 col-sm-6 p-t-10"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                             <label class = "mdl-textfield__label">Assigned Location</label> 
                                                <select name="location[]" id="location" class="mdl-textfield__input js-example-basic-multiple" multiple style="padding: 10px;"> 
                                                    <option value=""></option>
                                                    <option value="kazakhstan">Kazakhstan</option>
                                                    <option value="azerbaijan">Azerbaijan</option>
                                                    <option value="belarus">Belarus</option>
                                                    <option value="georgia">Georgia</option>
                                                    <option value="armenia">Armenia</option>
                                                    <option value="uzbekistan">Uzbekistan</option>
                                                    <option value="combo">Combo</option>
                                                    <option value="all">All</option>
                                                </select>
                                           
											</div>
                                        </div>
                                                
                                        <div class="col-lg-4 col-sm-6 p-t-10"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                             <label class = "mdl-textfield__label">Status</label>
                                                <select name="status" id="status" class="mdl-textfield__input" required> 
                                                    <option value=""> </option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>			 
                                       	 	 
                                      </div>
                                        </div>
                                        
                                        <div class="col-lg-4 col-sm-6 p-t-10"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                                        <label class = "mdl-textfield__label">Select Country</label>
                                      <?php echo form_input(['name'=>'country','id'=>'country', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('country')])?>    
                                                               		 	 
                                        </div>
                                          </div>
                                        <input type="hidden" name="country_id" id="country_id" value="">

                                          <div class="col-lg-4 col-sm-6 p-t-10"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class = "mdl-textfield__label">State</label>			 

                                      <?php echo form_input(['name'=>'state','id'=>'state',  'class'=>'mdl-textfield__input', 'value'=>set_value('state')])?>    
                                                              		 	 
                                        </div>
                                          </div>
                                        <input type="hidden" name="state_id" id="state_id" value="">

                                         <div class="col-lg-4 col-sm-6 p-t-10"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">		
                                                <label class = "mdl-textfield__label">City</label>		 

                                            <?php echo form_input(['name'=>'city','id'=>'city', 'class'=>'mdl-textfield__input', 'value'=>set_value('city')])?>    
                                                              	 	 
                                            </div>
                                        </div>        
                                        
                                        <div class="col-lg-4 col-sm-6 p-t-10">
                                            <label class="control-label d-block">Combo Access</label>

                                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="combo_access_yes">
                                                <input type="radio" id="combo_access_yes" class="mdl-radio__button" name="combo_access" value="yes">
                                                <span class="mdl-radio__label">YES</span>
                                            </label>

                                            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="combo_access_no">
                                                <input type="radio" id="combo_access_no" class="mdl-radio__button" name="combo_access" value="no" checked>
                                                <span class="mdl-radio__label">NO</span>
                                            </label>
                                        </div>
                                        
                                             <div class="col-lg-12 p-t-10 text-center"> 
                                        <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-info', 'value'=>'Submit']);?>	
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

    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- jQuery UI -->
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> 
<script>
        $(function() {
            $('.js-example-basic-multiple').select2({
                //theme: 'filled',
                placeholder: 'Region',
                width: '450px'
            });
        });
        
        $(document).ready(function(){
            $("#type").on("change",function(){
                $("#region").removeAttr("required").parent().parent().addClass("hide");
                $("#accounts_usertype").removeAttr("required").parent().parent().addClass("hide");
                $("#region_international").removeAttr("required").parent().parent().addClass("hide");
                $("#type").parent().parent().removeClass("col-lg-2").addClass("col-lg-4").next("div").addClass("hide");
                if($(this).val()==="5"){
                    $("#region").attr("required","required").parent().parent().removeClass("hide");
                    $("#type").parent().parent().removeClass("col-lg-4").addClass("col-lg-2").next("div").removeClass("hide");
                }
                if($(this).val()==="6"){
                    $("#region_international").attr("required","required").parent().parent().removeClass("hide");
					$("#type").parent().parent().removeClass("col-lg-4").addClass("col-lg-2").next("div").removeClass("hide");
                }
                if($(this).val()==="3"){
                    $("#accounts_usertype").attr("required","required").parent().parent().removeClass("hide");
                }
            });
            
            $("#head_admin_id").on("change",function(){
                if($("#head_admin_id option:selected").val()==""){
                    $("#region").val([]).change();
                }
                var v = $("#head_admin_id option:selected").attr("data-region").split(',');
                $("#region").val(v).change();
            });
            
        });
            
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
<script>
// $(document).ready(function() {
//     $('#type').on('change', function() {
//         var selectedvalue = $(this).val(); // Get updated value
//         console.log("Selected value:", selectedvalue);

//         if (selectedvalue == '2') {
//             $('.hod_type').show();
//             $('.hod_type').removeClass('hide');
//         }
//     });

// });
</script>
