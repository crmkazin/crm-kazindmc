<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
<?php include('admin_head_css.php');?> 
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet">
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
			 <!-- end sidebar menu -->
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Edit User</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="<?=base_url();?>all-user">Users</a><i class="fa fa-angle-right"></i></li>
                                <li class="active">Edit User</li>
                            </ol>
                        </div>
                    </div>			
<?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
                     <div class="row">
                            <div class="col-sm-12">
                                    <div class="card-box">
                                            <div class="card-head">
                                                    <header>Edit User</header>
                                            </div>	
                                    <form method="post">
                                            <div class="card-body row">


                                        <div class="col-lg-4 p-t-20"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?php echo form_input(['name'=>'name','id'=>'name','class'=>'mdl-textfield__input','required'=>'required','value'=>$user->name])?>			 
                                        <label class = "mdl-textfield__label">Name</label>	 	 
                                      </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?php echo form_input(['name'=>'email','id'=>'email','class'=>'mdl-textfield__input','required'=>'required','value'=>$user->email])?>			 
                                              <label class = "mdl-textfield__label">Email</label><?php echo form_error('email'); ?>	 	 
                                      </div>
                                        </div>
                                        
                                        <div class="col-lg-2 p-t-20"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="isd_codes" class="mdl-textfield__input" style="padding-top:13px;">
                                                  <?php 
                                                  $selected = ($user->isd_code<>'')?$user->isd_code:'+91';
                                                  $allowed_countries = ['AZ','BY','IN','KZ','GE','AE'];
                                                  foreach($country_isd_codes AS $list){  
                                                      if(in_array($list->country_code,$allowed_countries)){
                                                      ?>
                                                            <option value="<?=$list->isd_codes?>" <?php echo ($list->isd_codes==$selected)?'selected':''; ?> ><?=$list->isd_codes.' ('.$list->country.')' ?></option>
                                                  <?php }} ?>
                                                </select>
                                                <label class = "mdl-textfield__label">ISD</label><?php echo form_error('isd_codes');?>		 	 
                                            </div>
                                        </div>
                                                
                                                
                                        <div class="col-lg-2 p-t-20"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?php echo form_input(['name'=>'mobile','id'=>'name','class'=>'mdl-textfield__input','type'=>'number','required'=>'required','value'=>$user->contact_number])?>			 
                                        <label class = "mdl-textfield__label">Mobile</label>	<?php echo form_error('mobile'); ?>	 	  	 
                                      </div>
                                        </div> 
                                                
                                        <div class="col-lg-4 p-t-20"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?php echo form_input(['name'=>'password','id'=>'new_product','class'=>'mdl-textfield__input','required'=>'required','value'=>$user->password])?>			 
                                        <label class = "mdl-textfield__label">Password</label>	 	 
                                      </div>
                                        </div> 
                                        <?php 
                                        $type_col = 'col-lg-4';
                                        $class_head = 'hide';
                                        if($user->type == 5 || $user->type == 6){ 
                                            $type_col = 'col-lg-2';
                                            $class_head = '';
                                        } ?>
                                        <div class="<?=$type_col ?> p-t-20"> 
                                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="type" id="type" class="mdl-textfield__input" required> 
                                                    <option value=""> </option>
                                                    <option value="1" <?php if($user->type == 1){ echo "selected";}?>>Admin</option>
                                                    <option value="2" <?php if($user->type == 2){ echo "selected";}?>>User</option>
                                                    <option value="3" <?php if($user->type == 3){ echo "selected";}?>>Accounts</option>
                                                    <option value="4" <?php if($user->type == 4){ echo "selected";}?>>International</option>
                                                    <option value="5" <?php if($user->type == 5){ echo "selected";}?>>Sales</option>
                                                    <option value="6" <?php if($user->type == 6){ echo "selected";}?>>Sales International</option>
                                                </select>			 
                                                <label class = "mdl-textfield__label">Type</label>	 	 
                                            </div>
                                        </div> 
                                        <?php 
                                            $update_id =  '';
                                            $head_admin_id = '';
                                        foreach($sales AS $list){ 
                                                if($user->id == $list->id){ 
                                                    $update_id =  $list->department_heads_id;
                                                    $head_admin_id = $list->head_admin_id;
                                                }
                                        } ?>
                                        <div class="col-lg-2 p-t-20 <?=$class_head ?>"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="head_admin_id" id="head_admin_id" class="mdl-textfield__input"> 
                                                    <option value="">No</option>
                                                    <?php foreach($sales AS $list){ 
                                                        if($user->id == $list->id) continue;
                                                    ?>
                                                        <option value="<?=$list->id ?>" <?=($head_admin_id==$list->id)?'selected="selected"':''; ?> data-region="<?php echo $list->region; ?>"><?=$list->name ?></option>
                                                    <?php } ?>                                                        
                                                </select>			 
                                                <label class = "mdl-textfield__label">Reporting Manager</label>	 	 
                                            </div>
                                            <input type="hidden" name="hdn_update_id" value="<?=$update_id ?>">
                                        </div>
                                        
                                        <?php
                                        $class = $class_accounts = $class_international ='hide'; $required = $accounts_required = $international_required = '';
                                        if($user->type=='5'){
                                            $class = ''; $required='required="required"';
                                        }
										if($user->type=='3'){
                                            $class_accounts = ''; $accounts_required = 'required="required"';
                                        }
                                        if($user->type=='6'){
                                            $class_international = ''; $international_required='required="required"';
                                        }
                                        ?>
                                        <div class="col-lg-4 p-t-20 <?=$class?>"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="region[]" id="region" class="mdl-textfield__input js-example-basic-multiple" multiple="" <?=$required ?>> 
                                                    <option value="all" <?=($user->region=='all')?'selected="selected"':''; ?>>All</option>
                                                    <?php 
                                                    $region = explode(',',$user->region);
                                                    foreach($states AS $list){ 
                                                        $selected = '';
                                                        if(in_array($list->name,$region)){
                                                            $selected = 'selected="selected"';
                                                        }
                                                        ?>
                                                        <option value="<?=$list->name; ?>" <?=$selected; ?>><?=$list->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>        
                                        <div class="col-lg-4 p-t-20 <?=$class_international?>"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="region_international[]" id="region_international" class="mdl-textfield__input js-example-basic-multiple" multiple="" <?=$international_required ?>> 
                                                    <option value="all" <?=($user->region=='all')?'selected="selected"':''; ?>>All</option>
                                                    <?php 
                                                    $region = explode(',',$user->region);
                                                    foreach($countries AS $list){ 
                                                        $selected = '';
                                                        if(in_array($list->name,$region)){
                                                            $selected = 'selected="selected"';
                                                        }
                                                        ?>
                                                        <option value="<?=$list->name; ?>" <?=$selected; ?>><?=$list->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div> 
										<div class="col-lg-4 p-t-20 <?=$class_accounts?>"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="accounts_usertype" id="accounts_usertype" class="mdl-textfield__input" <?=$accounts_required ?>> 
                                                    <option value=""></option>
                                                    <option value="accounts_admin" <?php echo ($user->admin_type=='accounts_admin')?'selected="selected"':''; ?>>Admin (Payments All Rights)</option>
                                                    <option value="accounts_user" <?php echo ($user->admin_type=='accounts_user')?'selected="selected"':''; ?>>User (Payments Add,View Rights)</option>
                                                    <option value="accounts_view" <?php echo ($user->admin_type=='accounts_view')?'selected="selected"':''; ?>>User (View Rights)</option>
                                                </select>
                                            <label class = "mdl-textfield__label">Accounts User Type</label> 
											</div>
                                        </div>
										
                                        <div class="col-lg-4 p-t-20"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="location" id="location" class="mdl-textfield__input" required> 
                                                    <option value=""></option>
                                                    <option value="kazakhstan" <?php echo ($user->location=='kazakhstan')?'selected':''; ?>>Kazakhstan</option>
                                                    <option value="azerbaijan" <?php echo ($user->location=='azerbaijan')?'selected':''; ?>>Azerbaijan</option>
                                                    <option value="belarus" <?php echo ($user->location=='belarus')?'selected':''; ?>>Belarus</option>
                                                    <option value="georgia" <?php echo ($user->location=='georgia')?'selected':''; ?>>Georgia</option>
                                                    <option value="all" <?php echo ($user->location=='all')?'selected':''; ?>>All</option>
                                                </select>	
                                        <label class = "mdl-textfield__label">Assigned Location</label>	 	 
                                      </div>
                                        </div>
                                        	
                                         <div class="col-lg-4 p-t-20"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="status" id="status" class="mdl-textfield__input" required> 
                                                    <option value=""> </option>
                                                    <option value="1" <?php if($user->status == 1){ echo "selected";}?>>Active</option>
                                                    <option value="2" <?php if($user->status == 2){ echo "selected";}?>>Inactive</option>
                                                    </select>			 
                                        <label class = "mdl-textfield__label">Status</label>	 	 
                                      </div>
                                        </div>
                                        
                                        <div class="col-lg-4 p-t-20"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                                      <?php echo form_input(['name'=>'country','id'=>'country','placeholder'=>'Country', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$user->country])?>    
                                                              <label class = "mdl-textfield__label">Select Country</label> 		 	 
                                        </div>
                                          </div>
                                        <input type="hidden" name="country_id" id="country_id" value="">

                                          <div class="col-lg-4 p-t-20"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                                      <?php echo form_input(['name'=>'state','id'=>'state','placeholder'=>'State',  'class'=>'mdl-textfield__input', 'value'=>$user->state])?>    
                                                              <label class = "mdl-textfield__label">State</label>		 	 
                                        </div>
                                          </div>
                                        <input type="hidden" name="state_id" id="state_id" value="">

                                         <div class="col-lg-4 p-t-20"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                                            <?php echo form_input(['name'=>'city','id'=>'city','placeholder'=>'City', 'class'=>'mdl-textfield__input', 'value'=>$user->city])?>    
                                                              <label class = "mdl-textfield__label">City</label>		 	 
                                            </div>
                                        </div>
                                                
                                                
                                    <div class="col-lg-12 p-t-20 text-center"> 
                                        <?php echo form_submit(['name'=>'update','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Update']);?>	
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
</body>
</html>