<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Intellitest CRM</title>
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
			 <!-- end sidebar menu -->
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Branch</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Branch</li>
                            </ol>
                        </div>
                    </div>			
<?php echo '<h3>' .$this->session->flashdata('message'). '</h3>'; unset($_SESSION['message']); ?>						
                     <div class="row">
						<div class="col-sm-12">
							<div class="card-box">
								<div class="card-head">
									<header>Add Branch</header>
								</div>	
							<form>
								<div class="card-body row">
						            <div class="col-lg-6 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" id="prefetch">			 					                
<?php echo form_input(['name'=>'company','id'=>'company', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('company')])?>
										<label class = "mdl-textfield__label">Company</label>		 	 
									<div id="company_suggesstion"> </div>				
									</div>
						            </div>																																																													

						            <div class="col-lg-6 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'contact_person', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('contact_person')])?>			 
					                    <label class = "mdl-textfield__label">Contact Person</label><?php echo form_error('contact_person');?>		 	 
					                  </div>
						            </div>

						            <div class="col-lg-6 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'email','type'=>'email', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('email')])?>			 
					                    <label class = "mdl-textfield__label">Email Address</label><?php echo form_error('email');?>		 	 
					                  </div>
						            </div>

						            <div class="col-lg-6 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'contact_number', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('contact_number')])?>			 
					                    <label class = "mdl-textfield__label">Contact Number</label><?php echo form_error('contact_number');?>		 	 
					                  </div>
						            </div>

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
									<select name="country" id="country" class="mdl-textfield__input" required> 
									<option value=""> </option>
									<?php if(!empty($countries)){ foreach($countries as $country){?>
									<option value="<?=$country->name?>"><?=$country->name?></option>
									<?php } }?>
									</select>    
										<label class = "mdl-textfield__label">Select Country</label>		 	 
					                  </div>
						            </div>

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
									<select name="state" id="state" class="mdl-textfield__input" required> 
									<option value=""></option>
									</select>    
										<label class = "mdl-textfield__label">Select State</label>		 	 
					                  </div>
						            </div>

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
									<select name="city" id="city" class="mdl-textfield__input" required> 
									<option value=""></option>
									</select>    
										<label class = "mdl-textfield__label">Select City</label>		 	 
					                  </div>
						            </div>
<input type="text" id="userid" value='0' >
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
										<textarea class="mdl-textfield__input" name="address" required> </textarea>			
					                    <label class = "mdl-textfield__label">Address</label>	 	 
					                  </div>
						            </div>									
								
							         <div class="col-lg-12 p-t-20 text-center"> 
<?php echo form_submit(['name'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>	
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
	
  <!-- Script -->
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
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#company').val(ui.item.label); // display the selected text
       $('#userid').val(ui.item.value); // save selected id to input
       return false;
      }
     });

  });

$("#country").change(function(){ 
	$.ajax({
        type: "POST",
        url: "<?=base_url();?>admin/company/get_state_ajax",
        data:{'country':$("#country").val()},
        success: function(data){
            $("#state").empty();
		//	$('#state').append('<option value="">Select State</option>');
            var opts = $.parseJSON(data);
            $.each(opts, function(i, d) {
               $('#state').append('<option value="' + d.name + '">' + d.name + '</option>');
            });
        },
		 error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });	
});

$("#state").change(function(){ 
	$.ajax({
        type: "POST",
        url: "<?=base_url();?>admin/company/get_city_ajax",
        data:{'state':$("#state").val()},
        success: function(data){
            $("#city").empty();	
		//	$('#city').append('<option value="">Select City</option>');
            var opts = $.parseJSON(data);
            $.each(opts, function(i, d) {
               $('#city').append('<option value="' + d.name + '">' + d.name + '</option>');
            });
        },
		 error: function(jqXHR, textStatus, errorThrown) {
          
        }
    });	
});

</script>	
</body>
</html>