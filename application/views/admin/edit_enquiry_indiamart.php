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
                                <div class="page-title">Edit Enquiry Indiamart</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li>
                                    <i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="<?php echo base_url('indiamart-followup'); ?>">Indiamart</a></li> &nbsp;<i class="fa fa-angle-right"></i>
                                &nbsp;
                                <li class="active"> Edit Enquiry Indiamart</li>
                            </ol>
                        </div>
                    </div>			
<?php echo '<h3>' .$this->session->flashdata('message'). '</h3>'; unset($_SESSION['message']);
//echo '<pre>';print_r($enquiry);die;
?>						
                     <div class="row">
						<div class="col-sm-12">
							<div class="card-box">
								<div class="card-head">
                                                                    <button type="button" class="btn bg-blue-grey waves-effect" title="Previous Page" onclick="history.back();">
                                                                        <i class="material-icons">arrow_back</i>
                                                                    </button>
                                                                    <header>Edit Enquiry Indiamart</header>
								</div>	
							<form method="post">
								<div class="card-body row">
                                                            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                <?php echo form_input(['name'=>'enquiry_no','id'=>'enquiry_no','required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>'IT/INQ/IM/21-22/'.$enquiry->id,'readonly'=>'readonly'])?>			 
                                                                <label class = "mdl-textfield__label">Enquiry No</label>		 	 
					                    </div>
						            </div>
                                                                    <div class="col-lg-8"></div>
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                                <?php echo form_input(['name'=>'indiamart_enquiry_no','id'=>'indiamart_enquiry_no','required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$enquiry->indiamart_query_id,'readonly'=>'readonly'])?>			 
                                                                <label class = "mdl-textfield__label">Indiamart Enquiry No</label>		 	 
					                    </div>
						            </div>								    
								    
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
									<select name="mode" id="mode" class="mdl-textfield__input" required> 
                                        <option value=""> </option>
                                        <option disabled value="Phone" <?php if($enquiry->mode == 'Phone'){ echo "selected"; }?> >Phone</option>
                                        <option disabled value="Website" <?php if($enquiry->mode == 'Website'){ echo "selected"; }?>>Website</option>
                                        <option disabled value="Reference" <?php if($enquiry->mode == 'Reference'){ echo "selected"; }?>>Reference</option>
                                        <option disabled value="Visit" <?php if($enquiry->mode == 'Visit'){ echo "selected"; }?>>Visit</option>
                                        <option disabled value="Marketing" <?php if($enquiry->mode == 'Marketing'){ echo "selected"; }?>>Marketing</option>
                                        <option disabled value="Email" <?php if($enquiry->mode == 'Email'){ echo "selected"; }?>>Email</option>
                                        <option value="Indiamart" <?php if($enquiry->mode == 'Indiamart'){ echo "selected"; }?>>Indiamart</option>
									</select> 			 
					                    <label class = "mdl-textfield__label">Mode</label>		 	 
                                                            </div>
						            </div>							
							
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'company','id'=>'company','required'=>'required','class'=>'mdl-textfield__input', 'value'=>$enquiry->name])?>			 
					                    <label class = "mdl-textfield__label">Organization</label>	 	 
					                  </div>
						            </div>
                                                            <input type="hidden" name="company_id" value="<?=$enquiry->company_id?>">
                                                            <input type="hidden" name="branch_id" value="<?=$enquiry->branch_id?>">
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'branch','id' =>'branch','required'=>'required','readonly'=>'True', 'class'=>'mdl-textfield__input', 'value'=>$enquiry->city])?>			 
					                    <label class = "mdl-textfield__label">Branch</label> 	 	 
					                  </div>
						            </div>

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
    									<select name="enquiry_for" id="enquiry_for" class="mdl-textfield__input" required> 
    									<option value=""></option>
    									<?php 
                                                                        $new_product = 1;
                                                                        if(!empty($products)){
    									foreach($products as $product){
    									?>
    									<option value="<?=$product->name?>" <?php if($product->name == $enquiry->enquiry_for){ $new_product=0; echo "selected";}?>> <?=$product->name?> </option>
    									<?php } }
                                                                        if($new_product == 1){
                                                                        ?>
                                                                        <option value="<?php echo $enquiry->enquiry_for; ?>" selected="selected"><?php echo $enquiry->enquiry_for; ?></option>
                                                                        <?php } ?>
    									<option value="Other">Other</option>
    									</select>										 
					                    <label class = "mdl-textfield__label">Enquiry For</label><?php echo form_error('enquiry_for');?>		 	 
					                  </div>
						            </div>
							
						            <div class="col-lg-4 p-t-20"> 
						            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
								<select name="enquiry_type" id="enquiry_type" class="mdl-textfield__input" required> 
                                                                    <option value=""></option>
                                                                    <option value="Product Sale" <?php if($enquiry->enquiry_type == 'Product Sale'){ echo "selected";}?> >Product Sale</option>
                                                                    <option value="Repair" <?php if($enquiry->enquiry_type == 'Repair'){ echo "selected";}?>>Repair</option>
                                                                    <option value="Installation" <?php if($enquiry->enquiry_type == 'Product Sale'){ echo "selected";}?>>Installation</option>
                                                                    <option value="AMC" <?php if($enquiry->enquiry_type == 'Installation'){ echo "selected";}?>>AMC</option>
                                                                    <option value="Demo" <?php if($enquiry->enquiry_type == 'Demo'){ echo "selected";}?>>Demo</option>
                                                                    <option value="Equipment Renter" <?php if($enquiry->enquiry_type == 'Equipment Renter'){ echo "selected";}?>>Equipment Renter</option>
                                                                    <option value="Tender" <?php if($enquiry->enquiry_type == 'Tender'){ echo "selected";}?>>Tender</option>
                                                                    <option value="Testing Services" <?php if($enquiry->enquiry_type == 'Testing Services'){ echo "selected";}?>>Testing Services</option>
                                                                    <option value="Irrelevent" <?php if($enquiry->enquiry_type == 'Irrelevent'){ echo "selected";}?>>Irrelevent</option>
                                                                    <option value="Survey" <?php if($enquiry->enquiry_type == 'Survey'){ echo "selected";}?>>Survey</option>
                                                                    <option value="Other" <?php if($enquiry->enquiry_type == 'Other'){ echo "selected";}?>>Other</option>
                                                                </select>    
										<label class = "mdl-textfield__label">Select Enquiry Type</label>		 	 
					                  </div>
						            </div>							
							
						            <div class="col-lg-4 p-t-20"> 
						            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
									<select name="status" id="status" class="mdl-textfield__input" required> 
									<option value=""></option>
									<option value="Under Process" <?php if($enquiry->status == 'Under Process'){ echo "selected";}?> >Under Process</option>
									<option value="Not Useful" <?php if($enquiry->status == 'Not Useful'){ echo "selected";}?>>Not Useful</option>
									<option value="Not Contactable" <?php if($enquiry->status == 'Not Contactable'){ echo "selected";}?>>Not Contactable</option>
									<option value="Quotation to be sent" <?php if($enquiry->status == 'Quotation to be sent'){ echo "selected";}?>>Quotation to be sent</option>
                                                                        <option value="Low Budget" <?php if($enquiry->status == 'Low Budget'){ echo "selected";}?>>Low Budget</option>
									</select>    
										<label class = "mdl-textfield__label">Select Status</label>		 	 
					                  </div>
						            </div>

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
							<?php echo form_input(['name'=>'remarks','id'=>'remark','required'=>'required','class'=>'mdl-textfield__input', 'value'=>$enquiry->remarks])?>    
										<label class = "mdl-textfield__label">Previous Remark</label>		 	 
					                  </div>
						            </div>
                                                        <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
                                    <?php echo form_input(['name'=>'date','id'=>'date','required'=>'required','class'=>'mdl-textfield__input', 'value'=>date('d-m-Y',strtotime($enquiry->date)) ])?>    
							        <label class = "mdl-textfield__label">Date</label>		 	 
					                  </div>
						            </div>
									
					<div class="col-lg-12 p-t-20 text-center"> 
                                            <?php echo form_submit(['name'=>'update','id'=>'update', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Update']);?>	
                                            
                                            <input type="button" value="Cancel" name="" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-danger" onclick="history.back();" />
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
    $('#date').bootstrapMaterialDatePicker({
        time: false,clearButton: true,format: 'DD-MM-YYYY',
    });
</script>
</body>
</html>