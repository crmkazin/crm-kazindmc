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
                    <?php include('report_links.php'); ?>
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Enquiry Report</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active"> Enquiry Report</li>
                            </ol>
                        </div>
                    </div>			
<!-- <?php echo '<h3>' .$this->session->flashdata('message'). '</h3>'; unset($_SESSION['message']); ?>
 -->
<div class="row">
            <div class="col-sm-12">
              <div class="card-box">
                <div class="card-head">
                  <header>Search Enquiry </header>
                </div>  
              <form method="post">
                <div class="card-body row">

                   <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded is-focused" data-upgraded=",MaterialTextfield">   
                    <input type="text" name="from" class="mdl-textfield__input" id="from_date" data-dtp="dtp_8VDID">
                              <label class = "mdl-textfield__label">From</label>     
                            </div>
                        </div>

                         <div class="col-lg-4 p-t-20"> 
                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded is-focused" data-upgraded=",MaterialTextfield">     
                    <input type="text" name="to" class="mdl-textfield__input" id="to_date" data-dtp="dtp_8VDID">
                              <label class = "mdl-textfield__label">To</label>     
                            </div>
                        </div>
                        <div class="col-lg-4 p-t-20"> 
                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">      
                          
                          <?php echo form_input(['name'=>'company_id','id'=>'company', 'class'=>'mdl-textfield__input', 'value'=>set_value('company_id')])?>     
                    <label class = "mdl-textfield__label">Organization</label>  
                     <!-- <input type="hidden" name="company_id" id="company_id" value="">     -->
                            </div>
                        </div>
                        <div class="col-lg-4 p-t-20"> 
                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
              <?php echo form_input(['name'=>'contact_person','id'=>'contact_person', 'class'=>'mdl-textfield__input', 'value'=>set_value('contact_person')])?>      
                              <label class = "mdl-textfield__label">Contact Person</label><?php echo form_error('contact_person');?>       
                            </div>
                        </div>
                        <div class="col-lg-4 p-t-20"> 
                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
              <?php echo form_input(['name'=>'email','type'=>'email','id' =>'email', 'class'=>'mdl-textfield__input', 'value'=>set_value('email')])?>      
                              <label class = "mdl-textfield__label">Email Address</label>      
                            </div>
                        </div>

                        
                        <div class="col-lg-4 p-t-20"> 
                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <?php echo form_input(['name'=>'contact_number','type'=>'number','id'=>'contact_number', 'class'=>'mdl-textfield__input', 'value'=>set_value('contact_number')])?>      
                              <label class = "mdl-textfield__label">Contact Number</label><?php echo form_error('contact_number');?>       
                            </div>
                        </div>
                        <div class="col-lg-4 p-t-20"> 
                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">      
                          
              <?php echo form_input(['name'=>'country','id'=>'country','class'=>'mdl-textfield__input', 'value'=>set_value('country')])?>    
                    <label class = "mdl-textfield__label">Country</label>       
                            </div>
                        </div>
                        <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
							<?php echo form_input(['name'=>'state','id'=>'state', 'class'=>'mdl-textfield__input', 'value'=>set_value('state')])?>    
										<label class = "mdl-textfield__label">State</label>		 	 
					                  </div>
						            </div>
                        <div class="col-lg-4 p-t-20"> 
                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">      
                          
              <?php echo form_input(['name'=>'city','id'=>'city', 'class'=>'mdl-textfield__input', 'value'=>set_value('city')])?>    
                    <label class = "mdl-textfield__label">City</label>       
                            </div>
                        </div>
                        
                                    <div class="col-lg-4 p-t-20"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                          <?php echo form_input(['name'=>'gst_number','pattern'=>'^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$','id'=>'gst_number', 'class'=>'mdl-textfield__input', 'value'=>set_value('gst_number')])?>    
                                        <label class = "mdl-textfield__label">GST Number</label>	 	 
                                      </div>
                                        </div>


                        <!-- <div class="col-lg-4 p-t-20"> 
                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
              <?php echo form_input(['name'=>'enquiry_mode','id'=>'enquiry_mode','class'=>'mdl-textfield__input', 'value'=>set_value('enquiry_mode')])?>       
                              <label class = "mdl-textfield__label">Enquiry Mode</label><?php echo form_error('enquiry_mode');?>       
                            
                    </div>
                        </div> -->
                        <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
									<select name="enquiry_mode" id="enquiry_mode" class="mdl-textfield__input" > 
									<option value=""> </option>
									<option value="Phone">Phone</option>
									<option value="Website">Website</option>
									<option value="Reference">Reference</option>
									<option value="Visit">Visit</option>
									<option value="Marketing">Marketing</option>
									<option value="Email">Email</option>
									</select>    
										<label class = "mdl-textfield__label">Mode</label>		 	 
					                  </div>
						            </div>	
                                    
                                    <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
    									<select name="enquiry_for" id="enquiry_for" class="mdl-textfield__input" > 
    									<option value=""></option>
    									<?php if(!empty($products)){
    									foreach($products as $product){
    									?>
    									<option value="<?=$product->name?>"> <?=$product->name?> </option>
    									<?php } }?>
    									<option value="Other">Other</option>
    									</select>										 
					                    <label class = "mdl-textfield__label">Enquiry For</label><?php echo form_error('enquiry_for');?>		 	 
					                  </div>
						            </div>

						            <div class="col-lg-4 p-t-20"> 
						            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
									<select name="enquiry_type" id="enquiry_type" class="mdl-textfield__input" > 
									<option value=""></option>
									<option value="Product Sale">Product Sale</option>
									<option value="Repair">Repair</option>
									<option value="Installation">Installation</option>
									<option value="AMC">AMC</option>
									<option value="Demo">Demo</option>
									<option value="Equipment Renter">Equipment Renter</option>
									<option value="Tender">Tender</option>
									<option value="Testing Services">Testing Services</option>
                                                                        <option value="Irrelevent">Irrelevent</option>
                                                                        <option value="Survey">Survey</option>
                                                                        <option value="Other">Other</option>
									</select>    
										<label class = "mdl-textfield__label">Select Enquiry Type</label>		 	 
					                  </div>
						            </div>

						            <div class="col-lg-4 p-t-20"> 
						            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
									<select name="status" id="status" class="mdl-textfield__input" > 
									<option value=""></option>
									<option value="Under Process" >Under Process</option>
									<option value="Not Useful">Not Useful</option>
									<option value="Not Contactable">Not Contactable</option>
									<option value="Quotation to be sent">Quotation to be sent</option>
									<option value="Send Quotation Now">Send Quotation Now</option>
									</select>    
										<label class = "mdl-textfield__label">Select Status</label>		 	 
					                  </div>
						            </div>
                                    <div class="col-lg-4 p-t-20"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                          <select name="financial_year" id="" class="mdl-textfield__input">
                                            <option value=""></option>
                                            <option value="21-22">21-22</option>
                                            <option value="22-23">22-23</option>
                                            <option value="23-24">23-24</option>

                                          </select>  
                                        <label class = "mdl-textfield__label">Financial Year</label>	 	 
                                      </div>
                                        </div>
                     <!-- <div class="col-lg-4 p-t-20"> 
                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
              <?php echo form_input(['name'=>'enquiry_for','id'=>'enquiry_for','class'=>'mdl-textfield__input', 'value'=>set_value('enquiry_for')])?>       
                              <label class = "mdl-textfield__label">Enquiry For</label><?php echo form_error('enquiry_for');?>       
                            
                    </div>
                        </div>          
              

                       <div class="col-lg-4 p-t-20"> 
                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
              <?php echo form_input(['name'=>'enquiry_type','id'=>'enquiry_type','class'=>'mdl-textfield__input', 'value'=>set_value('enquiry_type')])?>       
                              <label class = "mdl-textfield__label">Enquiry Type</label><?php echo form_error('enquiry_type');?>       
                            
                    </div>
                        </div>
                  
                      <div class="col-lg-4 p-t-20"> 
                         <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded is-focused" data-upgraded=",MaterialTextfield">
                    <input type="text" name="date" class="mdl-textfield__input"  id="date" data-dtp="dtp_8VDID">
                              <label class = "mdl-textfield__label">Date</label>     
                            </div>
                        </div>

                    <div class="col-lg-4 p-t-20"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">      
                  <select name="status" id="status" class="mdl-textfield__input"> 
                  <option value=""></option>
                  <option value="Not Useful">Not Useful</option>
                  <option value="Under Process">Under Process</option>
                  <option value="Followup Started">Followup Started</option>
                  <option value="automated-enquiry">Automated-Enquiry</option>
                  <option value="Quotation to be sent">Quotation to be sent</option>
                 <option value="Send Quotation Now">Send Quotation Now</option>

                  </select>   
                    <label class = "mdl-textfield__label">Select Status</label>      
                            </div>
                        </div>



                    <div class="col-lg-4 p-t-20"> 
                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
              <?php echo form_input(['name'=>'remarks','id'=>'remarks','class'=>'mdl-textfield__input', 'value'=>set_value('remarks')])?>       
                              <label class = "mdl-textfield__label">Remarks</label><?php echo form_error('remarks');?>       
                            
                    </div>
                        </div>

                        -->

                       


                        

                       
              
                        
              <input type="hidden" name="state_id" id="state_id" value="">
              
                      

                      

                        
                       <div class="col-lg-12 p-t-20 text-center"> 
<?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?> 
                        </div>
                </div>
              </form>
              </div>
            </div>
          </div>

<div class="row">
                    <div class="col-md-12">
                        <div class="card card-box">
                            <div class="card-head">
                                <header>Add/Remove Column Fields</header>
                                <input type="checkbox" name="" class="view_all"/>
                                <label style="color:#000 !important;font-weight: 500;font-size: 15px !important;">View All</label>
                            </div>
                            <div class="card-body">
                                <div class="row"> 
                                						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="1" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Date</label>
                                    </div>
                                </div>						

                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="2" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Enquiry Mode</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="3" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Enquiry For</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="4" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Enquiry Type</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="5" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Status</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="6" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Remarks</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="7" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Organization</label>
                                    </div>
                                </div>	
								
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="8" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Country</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="9" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">City</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="10" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Contact Person</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="11" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Contact No</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="12" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Email</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="13" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Reference By</label>
                                    </div>
                                </div>
								
								
					</div>                            
                        </div>
                            
                        </div>
                    </div>
                </div>


                     <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>All Enquiries</header>
                                    <div class="tools">
	                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
	                                    <a id="export_to_excel">Export to excel</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                    <table class="table table-hover table-checkable order-column full-width" id="example4">
                                        <thead>
                                            <tr>
												<th class="center">Sr.No</th>
												<th class="center">Date</th>
												<th class="center">Enquiry Mode</th>
												<th class="center">Enquiry For</th>	
												<th class="center">Enquiry Type</th>
												<th class="center">Status</th>
												<th class="center">Remarks</th>
												<th class="center">Organization</th>
												<th class="center">Country</th>	
											<!--	<th class="center">State</th> -->
												<th class="center">City</th>
											<!--	<th class="center">Address</th> -->
												<th class="center">Contact Person</th>
												<th class="center">Contact No</th>			
												<th class="center">Email</th>
												<th class="center">Reference By</th>
											<!--	<th class="center">Followup</th> -->											
											</tr>
                                        </thead>
                                        <tbody>
										<?php
										$i=1;
										if(!empty($enquiry)) {
										foreach($enquiry as $enquiries) {
										?>
											<tr class="odd gradeX">
											    <td class="center"><?=$i++?></td>
												<td class="center"><?=$enquiries->date?></td>
												<td class="center"><?=$enquiries->mode?></td>
												<td class="center"><?=$enquiries->enquiry_for?></td>
												<td class="center"><?=$enquiries->enquiry_type?></td>
												<td class="center"><?=$enquiries->status?></td>
												<td class="center"><?=$enquiries->remarks?></td>
												<td class="center">
												<?php if(is_numeric($enquiries->name)){ echo "No Name Found";}else{ echo $enquiries->name; }?>
												</td>
												<td class="center"><?=$enquiries->country?></td>
										<!--		<td class="center"><?=$enquiries->state?></td> -->
												<td class="center"><?=$enquiries->city?></td>
										<!--		<td class="center"><?=$enquiries->address?></td> -->
												<td class="center"><?=$enquiries->contact_person?></td>
												<td class="center"><?=$enquiries->contact_number?></td>
												<td class="center"><?=$enquiries->email?></td>
												<td class="center"><?php if(!empty($enquiries->reference_by)){ echo $enquiries->reference_by; }else{ echo "Without Reference";}?></td>
											<!--	<td class="center">
												<?php if($enquiries->enquiry_for != 'Other' && $enquiries->status != 'automated-enquiry'){?>    
												<a href="<?=base_url().$enquiries->id.'/';?>followup">Followup</a>
												<?php }else{ echo "Pending at Admin level"; }?>
												</td> -->
											</tr>
										<?php } }	
										
										if(!empty($multiple)) {
										foreach($multiple as $multiples) {
										?>
											<tr class="odd gradeX">
											    <td class="center"><?=$i++?></td>
												<td class="center"><?=$multiples->date?></td>
												<td class="center"><?=$multiples->mode?></td>
												<td class="center"><?=$multiples->enquiry_for?></td>
												<td class="center"><?=$multiples->enquiry_type?></td>
												<td class="center"><?=$multiples->status?></td>
												<td class="center"><?=$multiples->remarks?></td>
												<td class="center">
												<?php if(is_numeric($multiples->name)){ echo "No Name Found";}else{ echo $multiples->name; }?>
												</td>
												<td class="center"><?=$multiples->country?></td>
											<!--	<td class="center"><?=$multiples->state?></td> -->
												<td class="center"><?=$multiples->city?></td>
											<!--	<td class="center"><?=$multiples->address?></td> -->
												<td class="center"><?=$multiples->contact_person?></td>
												<td class="center"><?=$multiples->contact_number?></td>
												<td class="center"><?=$multiples->email?></td>
												<td class="center"><?php if(!empty($multiples->reference_by)){ echo $multiples->reference_by; }else{ echo "Without Reference";}?></td>
											<!--	<td class="center">
												<?php if($multiples->enquiry_for != 'Other' && $multiples->status != 'automated-enquiry'){?>    
												<a href="<?=base_url().$enquiries->id.'/';?>followup">Followup</a>
												<?php }else{ echo "Pending at Admin level"; }?>
												</td> -->
											</tr>
										<?php } }?>											
										
										</tbody>
                                    </table>
                                    </div>
                                </div>
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
       $('#company_name').val(ui.item.label); // display the selected text
       $('#company_id').val(ui.item.company_id); // save selected id to input
	
	$.ajax({
        type: "POST",
        url: "<?=base_url();?>admin/company/get_branch_ajax",
        data:{'company':$("#company_id").val()},
        success: function(data){
        //    $("#branch").empty();
		//	$('#branch').append('<option value="">Select Branch</option>');
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

$("#mode").change(function(){ 
	if($(this).val() == 'Reference'){
		$("#refered_person").show();
	}else{
		$("#refered_person").hide();
	}	
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

	if($("#branch").val() == 'add_branch'){

        $('#contact_person').val('');  
		$('#contact_number').val('');
		$('#email').val('');
		$('#address').val('');
		$('#country').val('');
		$('#state').val('');
		$('#city').val('');	
	
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

$(document).ready(function(){

     $( "#enquiry_one" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "<?=base_url()?>admin/company/enquiry_suggesstion",
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
       $('#enquiry_one').val(ui.item.label); // display the selected text
	
       return false;
      }      
     });

});
$(document).ready(function(){

     $( "#enquiry_two" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "<?=base_url()?>admin/company/enquiry_suggesstion",
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
       $('#enquiry_two').val(ui.item.label); // display the selected text
	
       return false;
      }      
     });

});

$(document).ready(function(){

     $( "#enquiry_three" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "<?=base_url()?>admin/company/enquiry_suggesstion",
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
       $('#enquiry_three').val(ui.item.label); // display the selected text
	
       return false;
      }      
     });

});
</script>
<script>
   $(document).ready(function() {
        var table = $('#example4').DataTable({
                        "scrollX": true
                        //"scrollY": "200px",
                        //"paging": false
                });
        table.columns( [ 4,5,6,7,8,9,10,11,12,13 ] ).visible( false, false );
        table.columns.adjust().draw( false );
        $('.mdl-textfield__input').on( 'click', function (e) {
            // Get the column API object
            var column = table.column( $(this).attr('data-column') );
            // Toggle the visibility
            column.visible( ! column.visible() );
            table.columns.adjust().draw( false );
            $('.view_all').prop("checked",false);
            $(".dataTables_info").parent().parent('div').show();
        });
		
		$(".view_all").on('click',function(){
            if($(this).prop("checked") === true){
                $('.mdl-textfield__input').prop('checked',true);
                table.columns( '.center' ).visible( true );
                $(".dataTables_info").parent().parent('div').show();
            }else{
                $('.mdl-textfield__input').prop("checked",false);
                table.columns( '.center' ).visible( false );
                $(".dataTables_info").parent().parent('div').hide();
            }
        }); 
		
       
    });

</script> 	
<script>
        $('#from_date').bootstrapMaterialDatePicker({
        time: false,clearButton: true,format: 'DD-MM-YYYY',
    }).on("change",function(){
        $(this).parent("div").addClass("is-focused");
        var today = ("0"+new Date().getDate()).slice(-2)+'-'+("0"+(new Date().getMonth()+1)).slice(-2)+'-'+new Date().getFullYear();
        $('#to_date').val(today).parent("div").addClass("is-focused");
        $(this).parent("div").addClass("is-focused");
    });
    
    $('#to_date').bootstrapMaterialDatePicker({
        time: false,clearButton: true,format: 'DD-MM-YYYY',
    }).on("change",function(){
        if($('#from_date').val() === ''){
            alert('Select From Date');
            $(this).val('');
            return false;
        }
        $(this).parent("div").addClass("is-focused");
    });
    $('#date').bootstrapMaterialDatePicker({
            time: false,clearButton: true,format: 'DD-MM-YYYY',
    }).on("change",function(d){
        var dt = d.target.value.split('-');
        $("#last_date").val(dt[2]+"-"+dt[1]+"-"+dt[0]);
    });
</script>
</body>
<script>
    $('#export_to_excel').click(function () {
        $('<table>')
		.append( $("#example4 thead").html())
         .append(
            $("#example4").DataTable().$('tr').clone()
         )
         .table2excel({
            filename: "enquiry-report.xls"
        });
        $("#example4").dataTable();
    });
</script>
<!-- <script>
    $(document).ready(function(){
  
     $( "#company_name" ).autocomplete({
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
        $('#company_name').val(ui.item.label); // display the selected text
        $('#company_id').val(ui.item.company_id); // save selected id to input
       
    //var company_id = ui.item.company_id;   
        
       return false;
      }
     });

  });s
    </script> -->
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
   //    $("#branch").empty();
   //	$('#branch').append('<option value="">Select Branch</option>');
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
</script>
</html>