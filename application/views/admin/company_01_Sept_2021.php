<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Intellitest CRM</title>
<?php include('admin_head_css.php');?> 
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
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
                                <div class="page-title">Client</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="<?php echo base_url('clients'); ?>">Clients</a></li>
                                &nbsp;<i class="fa fa-angle-right"></i>&nbsp;
                                <li class="active"> Add Client</li>
                            </ol>
                        </div>
                    </div>			
<?php echo '<h3>' .$this->session->flashdata('message'). '</h3>';?>						
                     <div class="row">
						<div class="col-sm-12">
							<div class="card-box">
								<div class="card-head">
                                                                    <button type="button" class="btn bg-blue-grey waves-effect" title="Previous Page" onclick="history.back();">
                                                                        <i class="material-icons">arrow_back</i>
                                                                    </button>
                                                                    <header>Add Client</header>
								</div>	
							<form method="post">
								<div class="card-body row">
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'name','id'=>'name','placeholder'=>'organization name', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('name')])?>			 
					                    <label class = "mdl-textfield__label">Organization Name</label><?php echo form_error('name');?>		 	 
					                  
									  </div>
						            </div>																																																							
							<input type="hidden" name="company_id" id="company_id" value="">
							
						            <div class="col-lg-4 p-t-20" id="branch_section" style="display:none;"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
									<select name="branch" id="branch" class="mdl-textfield__input"> 
									<option value=""></option>
									</select>    
									<!--	<label class = "mdl-textfield__label">Select Branch</label>	-->	 	 
					                  </div>
						            </div>							
							
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'contact_person','id'=>'contact_person','placeholder'=>'contact person', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('contact_person')])?>			 
					                    <label class = "mdl-textfield__label">Contact Person</label><?php echo form_error('contact_person');?>		 	 
					                  </div>
						            </div>

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'email','placeholder'=>'email address','type'=>'email','id' =>'email', 'class'=>'mdl-textfield__input', 'value'=>set_value('email')])?>			 
					                    <label class = "mdl-textfield__label">Email Address</label> 	 	 
					                  </div>
						            </div>

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'contact_number','id'=>'contact_number','placeholder'=>'contact number', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('contact_number')])?>			 
					                    <label class = "mdl-textfield__label">Contact Number</label><?php echo form_error('contact_number');?>		 	 
					                  </div>
						            </div>
                                
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <select multiple="multiple" class="chosen-select mdl-textfield__input" name="groups[]" required>
                                        <option value=""></option> 
                                        <?php if(!empty($groups)){ 
                                        foreach($groups as $group){
                                        ?>
                                        <option value="<?=$group->group_name?>"><?=$group->group_name?></option>
                                        <?php } } ?>
                                        </select>                			 
					                    <label class = "mdl-textfield__label">Group</label>
					                  </div>
						            </div> 

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
							<?php echo form_input(['name'=>'country','id'=>'country','placeholder'=>'country', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('country')])?>    
										<label class = "mdl-textfield__label">Select Country</label> 		 	 
					                  </div>
						            </div>
							<input type="hidden" name="country_id" id="country_id" value="">
							
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
							<?php echo form_input(['name'=>'state','id'=>'state','placeholder'=>'state', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('state')])?>    
										<label class = "mdl-textfield__label">State</label>		 	 
					                  </div>
						            </div>
							<input type="hidden" name="state_id" id="state_id" value="">
							
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
							<?php echo form_input(['name'=>'city','id'=>'city','placeholder'=>'city', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('city')])?>    
										<label class = "mdl-textfield__label">City</label>		 	 
					                  </div>
						            </div>

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
										<textarea class="mdl-textfield__input" id="address" name="address" required> </textarea>			
					                    <label class = "mdl-textfield__label">Address</label>	 	 
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
					
					<!--
                     <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>All Companies</header>
                                    <div class="tools">
	                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                    <table class="table table-hover table-checkable order-column full-width" id="example4">
                                        <thead>
                                            <tr>
												<th class="center">Sr.No</th>
												<th class="center">Name</th>
												<th class="center">Contact Person</th>
												<th class="center">Contact Number</th>	
												<th class="center">Email</th>
												<th class="center">Address</th>
												<th class="center">Date</th>		
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$i=1;
										if(!empty($company)) {
										foreach($company as $companies) {
										?>
											<tr class="odd gradeX">
											    <td class="center"><?=$i++?></td>
												<td class="center">
												<?php if(is_numeric($companies->name)){
												echo "Name Not Found";	
												}else{
												echo $companies->name;	
												}?>
												</td>
												<td class="center"><?=$companies->contact_person?></td>
												<td class="center"><?=$companies->contact_number?></td>
												<td class="center"><?=$companies->email?></td>
												<td class="center"><?=$companies->address.','.$companies->city.','.$companies->state.','.$companies->country?></td>
												<td class="center"><?=$companies->date?></td>
											</tr>
										<?php } }?>	
										</tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>	 -->				
					
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
  <!-- Script -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- jQuery UI -->
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>	
	
<script>

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

});
 
$("#branch").change(function(){

	if($("#branch").val() == ''){

        $('#contact_person').val('');  
		$('#contact_number').val('');
		$('#email').val('');
		$('#address').val('');
		$('#country').val('');
		$('#state').val('');
		$('#city').val('');
		$('#submit').val('Add Branch');	
	
	}
	
	$.ajax({
        type: "POST",
        url: "<?=base_url();?>admin/company/branch_detail_ajax",
        data:{'branch_id':$("#branch").val()},
        success: function(data){
				
            var opts = $.parseJSON(data);
            $('#contact_person').val(opts.contact_person);  
            $('#contact_number').val(opts.contact_number);
            $('#email').val(opts.email);
            $('#address').val(opts.address);
            $('#country').val(opts.country);
            $('#state').val(opts.state);
            $('#city').val(opts.city);
            $('#submit').val('update');	
			
        },
		 error: function(jqXHR, textStatus, errorThrown) {
          
        }
    });	
});

</script>	
</body>
</html>