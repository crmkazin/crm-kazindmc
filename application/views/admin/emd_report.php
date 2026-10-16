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
                                <div class="page-title">EMD Report</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">EMD Report</li>
                            </ol>
                        </div>
                    </div>			
<!-- <?php echo '<h3>' .$this->session->flashdata('message'). '</h3>'; unset($_SESSION['message']); ?>						
 -->                     <div class="row">
						<div class="col-sm-12">
							<div class="card-box">
								<div class="card-head">
									<header>Search EMD</header>
								</div>	
							<form method="post">
								<div class="card-body row">
                                    
								    
								    <div class="col-lg-2 p-t-20"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?php echo form_input(['name'=>'from_date','id'=>'from_date', 'class'=>'mdl-textfield__input', 'value'=>set_value('from_date')])?>			 
                                        <label class = "mdl-textfield__label">From EMD Date</label><?php echo form_error('from_date');?>		 	 

                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-2 p-t-20"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?php echo form_input(['name'=>'to_date','id'=>'to_date','class'=>'mdl-textfield__input', 'value'=>set_value('to_date')])?>			 
                                        <label class = "mdl-textfield__label">To EMD Date</label><?php echo form_error('to_date');?>		 	 

                                            </div>
                                        </div>
                                    		    <div class="col-lg-2 p-t-20"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?php echo form_input(['name'=>'from_emd_return_date','id'=>'from_emd_return_date', 'class'=>'mdl-textfield__input', 'value'=>set_value('from_emd_return_date')])?>
                                        <label class = "mdl-textfield__label">From EMD Return Date</label><?php echo form_error('from_emd_return_date');?>

                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-2 p-t-20"> 
                                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?php echo form_input(['name'=>'to_emd_return_date','id'=>'to_emd_return_date','class'=>'mdl-textfield__input', 'value'=>set_value('to_emd_return_date')])?>			 
                                        <label class = "mdl-textfield__label">To EMD Return Date</label><?php echo form_error('to_emd_return_date');?>		 	 

                                            </div>
                                        </div>
                                <div class="col-lg-2 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name'=>'from_publish_date','type'=>'text','id' =>'from_publish_date', 'class'=>'mdl-textfield__input', 'value'=>set_value('from_publish_date')])?>			 
                                <label class = "mdl-textfield__label">From Publish Date</label> 	 	 
                              </div>
                                </div>
                                <div class="col-lg-2 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name'=>'to_publish_date','type'=>'text','id' =>'to_publish_date', 'class'=>'mdl-textfield__input', 'value'=>set_value('to_publish_date')])?>			 
                                <label class = "mdl-textfield__label">To Publish Date</label> 	 	 
                              </div>
                                </div>
                                <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name'=>'bid_number','id'=>'bid_number', 'class'=>'mdl-textfield__input', 'value'=>set_value('bid_number')])?>			 
                                <label class = "mdl-textfield__label">Bid Number</label><?php echo form_error('bid_number');?>		 	 
                              </div>
                                </div>
                                 <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name'=>'tender_number','id'=>'tender_number', 'class'=>'mdl-textfield__input', 'value'=>set_value('tender_number')])?>			 
                                <label class = "mdl-textfield__label">Tender Number</label><?php echo form_error('tender_number');?>		 	 
                              </div>
                                </div>                                 
                                                                    
                                <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name'=>'name','id'=>'name','class'=>'mdl-textfield__input', 'value'=>set_value('name')])?>			 
                                <label class = "mdl-textfield__label">Organization</label><?php echo form_error('name');?>		 	 

                                              </div>
                                </div>																																																							
                            <input type="hidden" name="company_id" id="company_id" value="">							
                               
                                <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                            <?php echo form_input(['name'=>'country','id'=>'country','class'=>'mdl-textfield__input', 'value'=>set_value('country')])?>    
                                                    <label class = "mdl-textfield__label">Select Country</label> 		 	 
                              </div>
                                </div>
<!-- 							<input type="hidden" name="country_id" id="country_id" value="">
-->							
                                <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                            <?php echo form_input(['name'=>'state','id'=>'state', 'class'=>'mdl-textfield__input', 'value'=>set_value('state')])?>    
                                                    <label class = "mdl-textfield__label">State</label>		 	 
                              </div>
                                </div>
<!-- 							<input type="hidden" name="state_id" id="state_id" value="">
-->							
                                <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                            <?php echo form_input(['name'=>'city','id'=>'city', 'class'=>'mdl-textfield__input', 'value'=>set_value('city')])?>    
                                                    <label class = "mdl-textfield__label">City</label>		 	 
                              </div>
                                </div>	            									
				
                                <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <select name="deal_by" id="deal_by" style="margin-top: 10px;" class="mdl-textfield__input"> 
                                    <option value=""></option> 
                                    <?php foreach($users AS $list){ ?>   
                                    <option value="<?php echo $list->id; ?>"><?php echo $list->name; ?></option>
                                     <?php } ?>
                                        
                                    </select>
                                      <label class = "mdl-textfield__label">Deal By </label><?php echo form_error('deal_by');?>		 	 
                              </div>
                                </div>

                            <div class="col-lg-4 p-t-20"> 
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <select name="emd_type" id="emd_type" style="margin-top: 10px;" class="mdl-textfield__input"> 
                                        <option value=""></option>
                                        <option value="DD">DD</option>
                                        <option value="Online">Online</option>
                                        <option value="FD">FD</option>
                                        <option value="BG">BG</option>
                                        <option value="NEFT">NEFT</option>
                                        <option value="RTGS">RTGS</option>
                                        <option value="not_applicable">Not Applicable</option>
                                    </select>  
                                <label class = "mdl-textfield__label">EMD Type</label>	 	 
                                </div>
                            </div>
			    
                            <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name'=>'emd_amount','id'=>'emd_amount', 'class'=>'mdl-textfield__input', 'value'=>set_value('emd_amount')])?>
                                <label class = "mdl-textfield__label">Emd Amount </label><?php echo form_error('emd_amount');?> 
                              </div>
                            </div>
                            
                            <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name'=>'emd_type_num','id'=>'emd_type_num', 'class'=>'mdl-textfield__input', 'value'=>set_value('emd_type_num')])?>
                                <label class = "mdl-textfield__label">Emd Type No. (E.g., DD, NEFT no. etc) </label><?php echo form_error('emd_type_num');?> 
                              </div>
                            </div>
                            
                            <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <select class="mdl-textfield__input" name="emd_status">
                                      <option value=""></option>
                                      <option value="pending">Pending</option>
                                      <option value="returned">Returned</option>
                                  </select>
                                <label class = "mdl-textfield__label">Emd Status </label><?php echo form_error('emd_status');?> 
                              </div>
                            </div>
                            
                            <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                      <select name="bid_status" id="bid_status" class="mdl-textfield__input"> 
                                        <option value=""></option>
                                        <option value="Under Evaluation">Under Evaluation</option>
                                        <option value="Opeining Pending">Opening Pending</option>
                                        <option value="Technical Reject">Technical Reject</option>
                                        <option value="Financial Pending">Financial Pending</option>
                                        <option value="Not Lowest">Not Lowest</option>
                                        <option value="Lowest">Lowest</option>
                                        <option value="Tender Cancel">Tender Cancel</option>
                                        <option value="Retender">Re-tender</option>
                                        <option value="Awarded to Other">Awarded to Other</option>
                                        <option value="Awarded to Us">Awarded to Us</option>
                                    </select>
                                <label class = "mdl-textfield__label">Bid Status</label><?php echo form_error('emd_type_num');?> 
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
                                        <input type="checkbox" data-column="1" name="oname" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked">
                                        <label for="oname" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Organization</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="2" name="group" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="group" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Bid Number</label>
                                    </div>
                                </div>						

                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="3" name="cperson" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="cperson" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Tender Number</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="4" name="cnumber" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="cnumber" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">EMD Date</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="5" name="email" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="email" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">EMD Return Date</label>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="6" name="address" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="address" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">EMD Amount</label>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="7" name="city" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">EMD Type</label>
                                    </div>
                                </div>
                                    
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="8" name="city" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">EMD Fee Type No.</label>
                                    </div>
                                </div>
                                    
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="9" name="city" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">EMD Status</label>
                                    </div>
                                </div>
                                  
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="10" name="city" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Tender Fee Amount</label>
                                    </div>
                                </div>
                                    
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="11" name="city" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Processing Fee Amount</label>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="12" name="city" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Estimated Cost</label>
                                    </div>
                                </div>    
                                    
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="13" name="state" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="state" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Country</label>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="14" name="country" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="country" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">State</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="15" name="date" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="date" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">City</label>
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
                                    <header>All Organizations</header>
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
                                                <th class="center"><strong>Organization</strong></th>
                                                <th class="center"><strong>Bid Number</strong></th>
                                                <th class="center"><strong>Tender Number</strong></th>
                                                <th class="center"><strong>EMD Date</strong></th>	
                                                <th class="center"><strong>EMD Return Date</strong></th>
                                                <th class="center"><strong>EMD Amount</strong></th>
                                                <th class="center"><strong>EMD Type</strong></th>
                                                <th class="center"><strong>EMD Fee Type No.</strong></th>
                                                <th class="center"><strong>EMD Status</strong></th>
                                                <th class="center"><strong>Tender Fee Amount</strong></th>
                                                <th class="center"><strong>Processing Fee Amount</strong></th>
                                                <th class="center"><strong>Estimated Cost</strong></th>
                                                <th class="center"><strong>Country</strong></th>
                                                <th class="center"><strong>State</strong></th>
                                                <th class="center"><strong>City</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                    $i=1;
                                    if(!empty($emd)) {
                                    foreach($emd as $list) {
                                    ?>
                                        <tr class="odd gradeX">
                                            <td class="center"><?=$i++?></td>
                                            <td class="center">
                                            <?php  echo $list->name; ?>
                                            </td>
                                            <td class="center"><?=$list->bid_number?></td>
                                            <td class="center"><?=$list->e_tender_id?></td>
                                            <td class="center">
                                                <?php 
                                                if($list->emd_fee_date <> '' && $list->emd_fee_date <> '0000-00-00'){
                                                    $arr = explode('-',$list->emd_fee_date); echo $arr[2].'-'.$arr[1].'-'.$arr[0]; 
                                                }
                                                ?>
                                            </td>
                                            <td class="center">
                                                <?php 
                                                if($list->emd_return_date <> '' && $list->emd_return_date <> '0000-00-00'){
                                                    $arr = explode('-',$list->emd_return_date); echo $arr[2].'-'.$arr[1].'-'.$arr[0]; 
                                                }
                                                ?>
                                            </td>
                                            <td class="center"><?=$list->emd_amount ?></td>
                                            <td class="center"><?=$list->emd_fee ?></td>
                                            <td class="center"><?=$list->emd_fee_no ?></td>                                            
                                            <td class="center"><?=$list->emd_status ?></td>
                                            <td class="center"><?=$list->tender_fee_amt ?></td>
                                            <td class="center"><?=$list->processing_fee_amt?></td>
                                            <td class="center"><?=$list->est_cost?></td>
                                            <td class="center"><?=$list->country?></td>
                                            <td class="center"><?=$list->state?></td>
                                            <td class="center"><?=$list->city?></td>
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
  <!-- Script -->
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
	   
	//var company_id = ui.item.company_id;   
		
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
       //$('#country_id').val(ui.item.country_id); // save selected id to input
	
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
       //$('#state_id').val(ui.item.state_id); // save selected id to input
	
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
    
    $('#from_emd_return_date').bootstrapMaterialDatePicker({
        time: false,clearButton: true,format: 'DD-MM-YYYY',
    }).on("change",function(){
        $(this).parent("div").addClass("is-focused");
        var today = ("0"+new Date().getDate()).slice(-2)+'-'+("0"+(new Date().getMonth()+1)).slice(-2)+'-'+new Date().getFullYear();
        $('#to_emd_return_date').val(today).parent("div").addClass("is-focused");
        $(this).parent("div").addClass("is-focused");
    });
    
    $('#to_emd_return_date').bootstrapMaterialDatePicker({
        time: false,clearButton: true,format: 'DD-MM-YYYY',
    }).on("change",function(){
        if($('#from_emd_return_date').val() === ''){
            alert('Select From EMD Return Date');
            $(this).val('');
            return false;
        }
        $(this).parent("div").addClass("is-focused");
    });
    
    $('#from_publish_date').bootstrapMaterialDatePicker({
        time: false,clearButton: true,format: 'DD-MM-YYYY',
    }).on("change",function(){
        $(this).parent("div").addClass("is-focused");
        var today = ("0"+new Date().getDate()).slice(-2)+'-'+("0"+(new Date().getMonth()+1)).slice(-2)+'-'+new Date().getFullYear();
        $('#to_publish_date').val(today).parent("div").addClass("is-focused");
        $(this).parent("div").addClass("is-focused");
    });
    
    $('#to_publish_date').bootstrapMaterialDatePicker({
        time: false,clearButton: true,format: 'DD-MM-YYYY',
    }).on("change",function(){
        if($('#from_publish_date').val() === ''){
            alert('Select From Publish Date');
            $(this).val('');
            return false;
        }
        $(this).parent("div").addClass("is-focused");
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
        table.columns( [ 2,3,4,5,6,7,8,9,10,11,12,13,14,15 ] ).visible( false, false );
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
        .append($('<tr><tr><td></td><td></td><td></td><td><strong>EMD Report</strong></td></tr><tr><tr>'))
		.append( $("#example4 thead").html())
         .append(
            $("#example4").DataTable().$('tr').clone()
         )
         .table2excel({
             preserveColors:true,
            filename: "EMD-report.xls"
        });
        $("#example4").dataTable();
    });
</script>
</html>