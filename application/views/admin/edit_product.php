<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Intellitest CRM</title>
<?php include('admin_head_css.php');?> 

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
                                <div class="page-title">Edit Enquiry</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Edit Enquiry</li>
                            </ol>
                        </div>
                    </div>			
<?php if($this->session->flashdata('message')<>''){ echo '<h3>' .$this->session->flashdata('message'). '</h3>'; unset($_SESSION['message']);  } ?>						
                     <div class="row">
						<div class="col-sm-12">
							<div class="card-box">
								<div class="card-head">
									<header>Edit Enquiry</header>
								</div>	
							<form method="post">
								<div class="card-body row">
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <select class="mdl-textfield__input" name="old_product"> 
                                        <option value=""></option>
                                        <?php if(!empty($old_products)){
                                        foreach($old_products as $product){
                                        ?>
                                        <option value="<?=$product->name?>"><?=$product->name?></option>
                                        <?php }}?>
                                        </select>			 
					                    <label class = "mdl-textfield__label">Select From Old Product</label><?php echo form_error('name');?>		 	 
					                  
									  </div>
						            </div>																																																							

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">OR
					                    <label class = "mdl-textfield__label"></label>	 	 
					                  </div>
						            </div>
							
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'new_product','id'=>'new_product','class'=>'mdl-textfield__input'])?>			 
					                    <label class = "mdl-textfield__label">Add New Product</label>	 	 
					                  </div>
						            </div>

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <select class="mdl-textfield__input" name="client" id="client"> 
                                        <option value=""></option>
                                        <?php if(!empty($clients)){
                                        foreach($clients as $client){
                                        if(!is_numeric($client->name)){    
                                        ?>
                                        <option value="<?=$client->company_id?>"><?=$client->name?></option>
                                        <?php } }}?>
                                        </select>			 
					                    <label class = "mdl-textfield__label">Select Client</label>		 	 
					                  
									  </div>
						            </div>

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-upgraded is-dirty">			 
					                
									<select name="branch" id="branch" class="mdl-textfield__input"> 
									<option value=""></option>
									</select>    
										<label class = "mdl-textfield__label">Select Branch</label>		 	 
					                  </div>
						            </div>

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
    									<select name="added_by" id="added_by" class="mdl-textfield__input"> 
    									<option value=""></option>
    									<?php if(!empty($users)){
    									foreach($users as $user){ 
    									if($user->id != $this->session->userdata('id')){    
    									?>
    									<option value="<?=$user->id?>"><?=$user->name?></option>
    									<?php } } }?>
    									</select> 
					                    <label class = "mdl-textfield__label">Assign Job</label>	 	 
					                  </div>
						            </div>



						            <div class="col-lg-4 p-t-20"> 
						            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
									<select name="enquiry_type" id="enquiry_type" class="mdl-textfield__input" required> 
									<option value=""></option>
									<option value="Product Sale">Product Sale</option>
									<option value="Repair">Repair</option>
									<option value="Installation">Installation</option>
									<option value="AMC">AMC</option>
									<option value="Demo">Demo</option>
									<option value="Equipment Renter">Equipment Renter</option>
									<option value="Tender">Tender</option>
									<option value="Testing Services">Testing Services</option>
									</select>    
										<label class = "mdl-textfield__label">Select Enquiry Type</label>		 	 
					                  </div>
						            </div>

							         <div class="col-lg-12 p-t-20 text-center"> 
<?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>	
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
<script>
$(document).ready(function(){
  $("#client").change(function(){
    
	$.ajax({
        type: "POST",
        url: "<?=base_url();?>admin/company/get_branch_ajax",
        data:{'company':$("#client").val()},
        success: function(data){
            $("#branch").empty();
		//	$('#branch').append('<option value="">Select Branch</option>');
            var opts = $.parseJSON(data);
			$('#branch').parent().addClass('is-dirty');
            $.each(opts, function(i, d) {
               $('#branch').append('<option value="' + d.branch_id + '">' + d.city + '</option>');
            });
		//	$('#branch').append('<option value="add_branch">Add New Branch</option>');
        },
		 error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });    
    
  });
});
</script>	
</body>
</html>