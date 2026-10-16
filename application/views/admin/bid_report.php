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
                                <div class="page-title">Bid Report</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Bid Report</li>
                            </ol>
                        </div>
                    </div>			
<!-- <?php echo '<h3>' .$this->session->flashdata('message'). '</h3>'; unset($_SESSION['message']); ?> 
 -->
                     <div class="row">
						<div class="col-sm-12">
							<div class="card-box">
								<div class="card-head">
									<header>Filter Bid</header>
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
					                
							<?php echo form_input(['name'=>'company','id'=>'company','class'=>'mdl-textfield__input', 'value'=>set_value('company')])?>    
										<label class = "mdl-textfield__label">Organization</label>		 	 
					                  </div>
                                      <input type="hidden" name="company_id" id="company_id" value="">
						            </div>
                                    <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'contact_person','type'=>'text','id' =>'contact_person', 'class'=>'mdl-textfield__input', 'value'=>set_value('contact_person')])?>			 
					                    <label class = "mdl-textfield__label">Contact Person</label> 	 	 
					                  </div>
						            </div>
						            
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'contact_email','type'=>'text','id' =>'contact_email', 'class'=>'mdl-textfield__input', 'value'=>set_value('contact_email')])?>			 
					                    <label class = "mdl-textfield__label">Contact Email</label> 	 	 
					                  </div>
						            </div>
						            

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'contact_number','id'=>'contact_number','class'=>'mdl-textfield__input'])?>			 
					                    <label class = "mdl-textfield__label">Contact Number</label>	 	 
					                  </div>
						            </div>
                                    <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
							<?php echo form_input(['name'=>'country','id'=>'country','class'=>'mdl-textfield__input'])?>    
										<label class = "mdl-textfield__label">Select Country</label> 		 	 
					                  </div>
						            </div>
							<input type="hidden" name="country_id" id="country_id" value="">
							
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
							<?php echo form_input(['name'=>'state','id'=>'state','class'=>'mdl-textfield__input', 'value'=>set_value('state')])?>    
										<label class = "mdl-textfield__label">State</label>		 	 
					                  </div>
						            </div>
							<input type="hidden" name="state_id" id="state_id" value="">
							
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
							<?php echo form_input(['name'=>'city','id'=>'city','class'=>'mdl-textfield__input', 'value'=>set_value('city')])?>    
										<label class = "mdl-textfield__label">City</label>		 	 
					                  </div>
						            </div>									
											

                        <!-- <div class="col-lg-4 p-t-20"> 
                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">      
                          
              <?php echo form_input(['name'=>'company_id','id'=>'company_id', 'class'=>'mdl-textfield__input', 'value'=>set_value('company_id')])?>    
                    <label class = "mdl-textfield__label">Organization</label>      
                            </div>
                        </div> -->
                        <!-- <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'contact_person','id'=>'contact_person', 'class'=>'mdl-textfield__input', 'value'=>set_value('contact_person')])?>			 
					                    <label class = "mdl-textfield__label">Contact Person</label>	 	 
					                  </div>
						            </div> -->

						            <!-- <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'email','type'=>'email','id' =>'email', 'class'=>'mdl-textfield__input', 'value'=>set_value('email')])?>			 
					                    <label class = "mdl-textfield__label">Email Address</label> 	 	 
					                  </div>
						            </div> -->
                                    <!-- <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'contact_number','id'=>'contact_number','class'=>'mdl-textfield__input'])?>			 
					                    <label class = "mdl-textfield__label">Contact Number</label>	 	 
					                  </div>
						            </div> -->
						            <!-- <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
							<?php echo form_input(['name'=>'country','id'=>'country','class'=>'mdl-textfield__input'])?>    
										<label class = "mdl-textfield__label">Select Country</label> 		 	 
					                  </div>
						            </div>
							<input type="hidden" name="country_id" id="country_id" value=""> -->
							
						            <!-- <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
							<?php echo form_input(['name'=>'state','id'=>'state','class'=>'mdl-textfield__input', 'value'=>set_value('state')])?>    
										<label class = "mdl-textfield__label">State</label>		 	 
					                  </div>
						            </div>
							<input type="hidden" name="state_id" id="state_id" value=""> -->
							
						            <!-- <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
							<?php echo form_input(['name'=>'city','id'=>'city','class'=>'mdl-textfield__input', 'value'=>set_value('city')])?>    
										<label class = "mdl-textfield__label">City</label>		 	 
					                  </div>
						            </div>									 -->
															
						
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
							<?php echo form_input(['name'=>'bid_no','id'=>'bid_no','class'=>'mdl-textfield__input', 'value'=>set_value('bid_no')])?>    
										<label class = "mdl-textfield__label">Bid No.</label>		 	 
					                  </div>
						            </div>									
									
																	
									
									<!-- <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
							<?php echo form_input(['name'=>'city','id'=>'bid_no','class'=>'mdl-textfield__input', 'value'=>set_value('city')])?>    
										<label class = "mdl-textfield__label">City</label>		 	 
					                  </div>
						            </div>									 -->
									

						           <!--  <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'equipment','id'=>'equipment','placeholder'=>'Work/Equipment', 'class'=>'mdl-textfield__input', 'value'=>set_value('equipment')])?>			 
					                    <label class = "mdl-textfield__label">Work/Equipment</label>	 	 
					                  </div>
						            </div> -->

						              <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'tendor_no','id'=>'tendor_no','class'=>'mdl-textfield__input', 'value'=>set_value('tendor_no')])?>			 
					                    <label class = "mdl-textfield__label">E Tender Id</label>	 	 
					                  </div>
						            </div>

						          
						           
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded is-focused" data-upgraded=",MaterialTextfield">			 
										<input type="text" name="publish_date" class="mdl-textfield__input" id="publish_date" data-dtp="dtp_8VDID">
					                    <label class = "mdl-textfield__label">Publish Date</label>	 	 
					                  </div>
						            </div>											
                                
                                  <!-- <div class="col-lg-4 p-t-20"> 
						               <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded is-focused" data-upgraded=",MaterialTextfield">			 
										<input type="text" name="hard_document_date" class="mdl-textfield__input" id="publish_date2" data-dtp="dtp_8VDID">
					                    <label class = "mdl-textfield__label">Hard Document Date</label>	 	 
					                  </div>
						            </div>												 -->



						            <div class="col-lg-4 p-t-20"> 
						            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
									<select name="status" id="status" class="mdl-textfield__input"> 
									<option value=""></option>
									<option value="Awarded to us">AWARDED TO US</option>
									<option value="incomplete">INCOMPLETE</option>
									<option value="complete">COMPLETE</option>

									</select>    
										<label class = "mdl-textfield__label">Select Status</label>		 	 
					                  </div>
						            </div>

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'remarks', 'id'=>'remarks', 'class'=>'mdl-textfield__input'])?>			 
					                    <label class = "mdl-textfield__label">Remarks</label>		 	 
					                  </div>
						            </div>

                                   <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'process_fee', 'class'=>'mdl-textfield__input'])?>			 
					                    <label class = "mdl-textfield__label">Processing Fee</label>		 	 
					                  </div>
						            </div>

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'process_fee_no', 'class'=>'mdl-textfield__input'])?>			 
					                    <label class = "mdl-textfield__label">Processing Fee No</label>		 	 
					                  </div>
						            </div>

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'process_fee_date', 'class'=>'mdl-textfield__input'])?>			 
					                    <label class = "mdl-textfield__label">Processing Fee Date</label>		 	 
					                  </div>
						            </div>	
                             
                                <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'tender_fee', 'class'=>'mdl-textfield__input',])?>			 
					                    <label class = "mdl-textfield__label">Tender Fee</label>		 	 
					                  </div>
						            </div>

						             <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'tender_fee_no', 'class'=>'mdl-textfield__input',])?>			 
					                    <label class = "mdl-textfield__label">Tender Fee No.</label>		 	 
					                  </div>
						            </div>

						             <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'tender_fee_date', 'class'=>'mdl-textfield__input'])?>			 
					                    <label class = "mdl-textfield__label">Tender Fee Date</label>		 	 
					                  </div>
						            </div>

						             <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'emd_fee', 'class'=>'mdl-textfield__input'])?>			 
					                    <label class = "mdl-textfield__label">Emd Fee</label>		 	 
					                  </div>
						            </div>	

									   <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'emd_fee_no', 'class'=>'mdl-textfield__input'])?>			 
					                    <label class = "mdl-textfield__label">Emd Fee No</label>		 	 
					                  </div>
						            </div>	
						            
                                                            <div class="col-lg-4 p-t-20"> 
						             <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded is-focused" data-upgraded=",MaterialTextfield">	
										<input type="text" name="emd_fee_date" class="mdl-textfield__input" id="publish_date3" data-dtp="dtp_8VDID">
					                    <label class = "mdl-textfield__label">Emd Fee Date</label>	 	 
					                  </div>
						            </div>	
						           
						         <div class="col-lg-4 p-t-20"> 
						             <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded is-focused" data-upgraded=",MaterialTextfield">	
										<input type="text" name="emd_return_date" class="mdl-textfield__input" id="emd_return_date" data-dtp="dtp_8VDID">
					                    <label class = "mdl-textfield__label">Emd Return Date</label>	 	 
					                  </div>
						            </div>
						           								
							<input type="hidden" name="company_id" id="company_id" value="">																		

							<div class="col-lg-12 p-t-20 text-center"> 
<?php echo form_submit(['name'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>	
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
                                        <label for="sno" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Bid No</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="2" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Organization</label>
                                    </div>
                                </div>						

                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield" >			 
                                        <input type="checkbox" data-column="3" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked" >
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">City</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="4" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">E Tender ID/Tender No</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="5" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Tender For</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="6" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Work</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="7" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Contact Person</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="8" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Contact Email</label>
                                    </div>
                                </div>	
								
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="9" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Contact Number</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="10" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Publish Date</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="11" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Hard Document Date</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="12" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Last Submission Date</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="13" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Processing Fee Amt.</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="14" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Processing Fee Mode</label>
                                    </div>
                                </div>
								
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="15" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Processing Fee Details</label>
                                    </div>
                                </div>
				<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="16" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Tender Fee Amt.</label>
                                    </div>
                                </div>
				<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="17" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Tender Fee Mode</label>
                                    </div>
                                </div>											
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="18" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Tender Fee Details</label>
                                    </div>
                                </div>
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="19" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Emd Fee Amt.</label>
                                    </div>
                                </div>
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="20" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Emd Fee Mode</label>
                                    </div>
                                </div>
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="21" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Emd Fee Details</label>
                                    </div>
                                </div>
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="22" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Estimated Cost</label>
                                    </div>
                                </div>
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="23" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">EMD Status</label>
                                    </div>
                                </div>
                                    <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="24" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">EMD Return Date</label>
                                    </div>
                                </div>
                                    <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="25" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Category</label>
                                    </div>
                                </div>
                                    <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="26" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Follow Up Details</label>
                                    </div>
                                </div>
                                    
                                    <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="27" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Remarks</label>
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
                                    <header>All Bids</header>
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
                                                <th class="center"><strong>Sr.No</strong></th>
                                                <th class="center"><strong>Bid No</strong></th>
                                                <th class="center"><strong>Organization</strong></th>
                                                <th class="center"><strong>City</strong></th>
                                                <th class="center"><strong>E Tender Id</strong></th>
                                                <th class="center"><strong>Tender For</strong></th>
                                                <th class="center"><strong>Work</strong></th>
                                                <th class="center"><strong>Contact Person</strong></th>
                                                <th class="center"><strong>Contact Email</strong></th>
                                                <th class="center"><strong>Contact Number</strong></th>
                                                <th class="center"><strong>Publish Date</strong></th>
                                                <th class="center"><strong>Hard Document Date</strong></th>
                                                <th class="center"><strong>Last Submission Date</strong></th>
                                                <th class="center"><strong>Processing Fee Amt.</strong></th>
                                                <th class="center"><strong>Processing Fee Mode</strong></th>
                                                <th class="center"><strong>Processing Fee Details</strong></th>
                                                <th class="center"><strong>Tender Fee Amt.</strong></th>
                                                <th class="center"><strong>Tender Fee Mode</strong></th>
						<th class="center"><strong>Tender Fee Details</strong></th>
                                                <th class="center"><strong>Emd Fee Amt.</strong></th>
                                                <th class="center"><strong>Emd Fee Mode</strong></th>
                                                <th class="center"><strong>Emd Fee Details</strong></th>
                                                <th class="center"><strong>Estimated Cost</strong></th>
                                                <th class="center"><strong>EMD Status</strong></th>
                                                <th class="center"><strong>EMD Return Date</strong></th>
                                                <th class="center"><strong>Category</strong></th>
                                                <th class="center"><strong>Follow Up Details</strong></th>
                                                <th class="center"><strong>Remarks</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php
                                $i=1;
                                //echo '<pre>';print_r($bids);exit;
                                if(!empty($bids)) {
                                foreach($bids as $detail) {
                                ?>
                                        <tr class="odd gradeX">
                                            <td class="center"><?=$i++?></td>
                                            <td class="center"><?=$detail->bid_number?></td>
                                            <td class="center">
                                            <?php if(is_numeric($detail->name)){
                                            echo "Name Not Found";	
                                            }else{
                                            echo $detail->name;	
                                            }?>												
                                            </td>
                                            <td class="center"><?=$detail->city?></td>
                                            <td class="center"><?=$detail->e_tender_id?></td>
                                            <td class="center"><?=$detail->tender_for?></td>
                                            <td class="center"><?=$detail->equipment?></td>
                                            <td class="center"><?=$detail->contact_person?></td>
                                            <td class="center"><?=$detail->contact_email?></td>
                                            <td class="center"><?=$detail->contact_number?></td>
                                            <td class="center"><?=($detail->publish_date=='0000-00-00' || $detail->publish_date=='1970-01-01')?'N/A':$detail->publish_date;?></td>
                                            <td class="center"><?=($detail->hard_document_date=='0000-00-00' || $detail->hard_document_date=='1970-01-01')?'N/A':$detail->hard_document_date;?></td>
                                            <td class="center"><?=($detail->last_date=='0000-00-00' || $detail->last_date=='1970-01-01')?'N/A':$detail->last_date;?></td>
                                            <td class="center"><?=$detail->processing_fee_amt?></td>
                                            <td class="center"><?=$detail->processing_fee?></td>                                                
                                            <td class="center"><?='Ref. No. '.$detail->processing_fee_no.' <br>Dated: '.(($detail->processing_fee_date=='0000-00-00' || $detail->processing_fee_date=='1970-01-01')?'N/A':$detail->processing_fee_date); ?></td>
                                            <td class="center"><?=$detail->tender_fee_amt?></td>
                                            <td class="center"><?=$detail->tender_fee?></td>
                                            <td class="center"><?='Ref. No. '.$detail->tender_fee_no.' <br>Dated: '.(($detail->tender_fee_date=='0000-00-00' || $detail->tender_fee_date=='1970-01-01')?'N/A':$detail->tender_fee_date); ?></td>
                                            <td class="center"><?=$detail->emd_amount?></td>
                                            <td class="center"><?=$detail->emd_fee?></td>
                                            <td class="center"><?='Ref. No. '.$detail->emd_fee_no.' <br>Dated: '.(($detail->emd_fee_date=='0000-00-00' || $detail->emd_fee_date=='1970-01-01')?'N/A':$detail->emd_fee_date);?></td>
                                            <td class="center"><?=$detail->est_cost?></td>
                                            <td class="center"><?=ucfirst($detail->emd_status)?></td>
                                            <td class="center"><?=($detail->emd_return_date=='0000-00-00' || $detail->emd_return_date=='1970-01-01')?'':$detail->emd_return_date;?></td>
                                            <td class="center"><?=$detail->category?></td>
                                            <td class="center"><?=$detail->followup_details?></td>
                                            <td class="center"><?=$detail->remarks?></td>
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

</script>	
<script>
   $(document).ready(function() {
        var table = $('#example4').DataTable({
                        "scrollX": true
                        //"scrollY": "200px",
                        //"paging": false
                });
        table.columns( [ 5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27 ] ).visible( false, false );
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
</body>
<script>
    $('#export_to_excel').click(function () {
        $('<table>') 
        .append($('<tr><tr><td></td><td></td><td></td><td><strong>Bid Report</strong></td></tr><tr><tr>'))
        .append(
            $("#example4 thead").html()
         )
        .append(
            $("#example4").DataTable().$('tr').clone()
         )
         .table2excel({
             preserveColors:true,
            filename: "Bid-report.xls"
        });
        $("#example4").dataTable();
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
    $('#publish_date2').bootstrapMaterialDatePicker({
            time: false,clearButton: true,format: 'DD-MM-YYYY',
    }).on("change",function(d){
        var dt = d.target.value.split('-');
        $("#last_date").val(dt[2]+"-"+dt[1]+"-"+dt[0]);
    });
    $('#publish_date').bootstrapMaterialDatePicker({
            time: false,clearButton: true,format: 'DD-MM-YYYY',
    }).on("change",function(d){
        var dt = d.target.value.split('-');
        $("#last_date").val(dt[2]+"-"+dt[1]+"-"+dt[0]);
    });
    $('#publish_date3').bootstrapMaterialDatePicker({
            time: false,clearButton: true,format: 'DD-MM-YYYY',
    }).on("change",function(d){
        var dt = d.target.value.split('-');
        $("#last_date").val(dt[2]+"-"+dt[1]+"-"+dt[0]);
    });
    $('#emd_return_date').bootstrapMaterialDatePicker({
            time: false,clearButton: true,format: 'DD-MM-YYYY',
    }).on("change",function(d){
        var dt = d.target.value.split('-');
        $("#last_date").val(dt[2]+"-"+dt[1]+"-"+dt[0]);
    });
</script>
</html>