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
                                <div class="page-title">Edit Order Acknowledgement</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="<?=base_url();?>order-acknowledgement">Order Acknowledgement</a></li>
                                &nbsp;<i class="fa fa-angle-right"></i>&nbsp;
                                <li class="active">Edit OA</li>
                            </ol>
                        </div>
                    </div>			
<?php echo '<h3>' .$this->session->flashdata('message'). '</h3>'; unset($_SESSION['message']); ?>	
					
                     <div class="row">
						<div class="col-sm-12">
							<div class="card-box">
								<div class="card-head">
                                                                    <button type="button" class="btn bg-blue-grey waves-effect" title="Previous Page" onclick="history.back();">
    <i class="material-icons">arrow_back</i>
</button>
									<header>Edit</header>
								</div>	
							<form method="post">
								<div class="card-body row">								
								
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                    <input type="text" name="oa_no" class="mdl-textfield__input" value="<?=$detail->order_no?>" required>
										<label class = "mdl-textfield__label">OA No</label>	 	 
					                  </div>
						            </div>								
								
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
							<?php echo form_input(['name'=>'company','id'=>'company', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$detail->name])?>			 
					                    <label class = "mdl-textfield__label">Organization</label><?php echo form_error('company');?>		 	 
					                  </div>
						            </div>								
								<input type="hidden" name="company_id" id="company_id" value="<?=$detail->organization?>">
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
									<select name="branch" id="branch" class="mdl-textfield__input" required> 
									<option value=""></option>
									<?php if(!empty($branches)){ foreach($branches as $branch){?>
									<option value="<?=$branch->branch_id?>" <?php if($branch->branch_id == $detail->branch){ echo "selected";}?>><?=$branch->city?></option>
									<?php } }?>
									</select>
									
										<label class = "mdl-textfield__label">Select Branch</label>		 	 
					                  </div>
						            </div>								
								    <?php $check = explode(",",$detail->enquiry_for)?>
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
    									<select style="height:200px;" multiple="multiple" name="enquiry_for[]" id="enquiry_for" class="mdl-textfield__input" required> 
    									<option value=""></option>
    									<?php if(!empty($products)){
    									foreach($products as $product){
    									?>
    									<option value="<?=$product->name?>" <?php if(in_array($product->name, $check)){ echo "selected"; }?>> <?=$product->name?> </option>
    									<?php } }?>
    									</select>										 
					                    <label class = "mdl-textfield__label">Order For</label><?php echo form_error('enquiry_for');?>		 	 
					                  </div>
						            </div>								
								
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                    <input type="text" name="order_no" class="mdl-textfield__input" value="<?=$detail->client_order_no?>" required>
										<label class = "mdl-textfield__label">Organization Order No</label>	 	 
					                  </div>
						            </div>								
								
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                    <input type="date" name="order_date" class="mdl-textfield__input" value="<?=$detail->order_date?>" required>
										<label class = "mdl-textfield__label">Order Date</label>	 	 
					                  </div>
						            </div>								
																								
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
										<input type="text" name="performance_security" class="mdl-textfield__input" value="<?=$detail->performance_security?>" required>
										<label class = "mdl-textfield__label">Security Performace</label>	 	 
					                  </div>
						            </div>
									
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                    <input type="text" name="delivery_due_date" class="mdl-textfield__input" value="<?=$detail->delivery_due_date?>" required>
										<label class = "mdl-textfield__label">Delivery Due Date</label>	 	 
					                  </div>
						            </div>

						            <div class="col-lg-4 p-t-20"> 
                                                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                                                <select name="status" class="mdl-textfield__input" id="status" required>
                                                                    <option value="Complete" <?php if($detail->status == 'Complete'){ echo "selected"; }?>>Complete</option>
                                                                    <option value="Not Complete" <?php if($detail->status == 'Not Complete'){ echo "selected"; }?>>Not Complete</option>
                                                                    <option value="Pending" <?php if($detail->status == 'Pending'){ echo "selected"; }?>>Pending</option>
                                                                    <option value="Work In Progress" <?php if($detail->status == 'Work In Progress'){ echo "selected"; }?>>Work In Progress</option>
                                                                    <option value="Cancel" <?php if($detail->status == 'Cancel'){ echo "selected"; }?>>Cancel</option>
                                                                </select>
                                                                <label class = "mdl-textfield__label">Status</label>	 	 
                                                                </div>
						            </div>
							
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                    <input type="text" name="remarks" class="mdl-textfield__input" value="<?=$detail->remarks?>" required>
										<label class = "mdl-textfield__label">Remarks</label>	 	 
					                  </div>
						            </div>

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                    <input type="text" name="amount_without_gst" class="mdl-textfield__input" value="<?=$detail->amount_without_gst?>" required>
										<label class = "mdl-textfield__label">Amount Without GST</label>	 	 
					                  </div>
						            </div>

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                    <input type="text" name="amount_with_gst" class="mdl-textfield__input" value="<?=$detail->amount_with_gst?>" required>
										<label class = "mdl-textfield__label">Amount With GST</label>	 	 
					                  </div>
						            </div>

									
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
										<select name="invoice_status" class="mdl-textfield__input" id="invoice_status" required>
										<option value="">Invoice made or not</option>
										<option value="Yes" <?php if($detail->invoice == 'Yes'){ echo "selected"; }?>>Yes</option>
										<option value="No" <?php if($detail->invoice == 'No'){ echo "selected"; }?>>No</option>
										</select>
										<label class = "mdl-textfield__label">Invoice Status</label>	 	 
					                  </div>
						            </div>									
									
						            <div class="col-lg-4 p-t-20" id="invoice_no" <?php if($detail->invoice == 'No'){?>style="display:none;" <?php }?>> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                    <input type="text" name="invoice_no" class="mdl-textfield__input" value="<?=$detail->invoice_no?>">
										<label class = "mdl-textfield__label">Invoice No</label>	 	 
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
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#company').val(ui.item.label); // display the selected text
       $('#company_id').val(ui.item.company_id); // save selected id to input
	
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
		//	$('#branch').append('<option value="add_branch">Add New Branch</option>');
        },
		 error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });	
	
       return false;
      }
     });

});

$("#invoice_status").change(function(){ 
	if($(this).val() == 'Yes'){
		$("#invoice_no").show();
	}else{
		$("#invoice_no").hide();
	}	
});
</script>	
</body>
</html>