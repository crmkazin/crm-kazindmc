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
                                <div class="page-title">Security Performance Report</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Security Performance Report</li>
                            </ol>
                        </div>
                    </div>			
<!-- <?php echo '<h3>' .$this->session->flashdata('message'). '</h3>'; unset($_SESSION['message']); ?> 
 -->
                     <div class="row">
                        <div class="col-sm-12">
                                <div class="card-box">
                                        <div class="card-head">
                                                <header>Filter Security Performance</header>
                                        </div>	
                                <form method="post">
                                        <div class="card-body row">	
                                                                    
                                <div class="col-lg-4 p-t-20"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?php echo form_input(['name'=>'name','id'=>'name','class'=>'mdl-textfield__input', 'value'=>set_value('name')])?>			 
                                        <label class = "mdl-textfield__label">Organization</label><?php echo form_error('name');?>		 	 

                                                      </div>
                                        </div>																																																							
                                    <input type="hidden" name="company_id" id="company_id" value="">							
                                    <!--    <div class="col-lg-6 p-t-20" id="branch_section" style="display:none;"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                                                    <select name="branch" id="branch" class="mdl-textfield__input"> 
                                                    <option value=""></option>
                                                    </select>    
                                                            <label class = "mdl-textfield__label">Select Branch</label>	 	 
                                      </div>
                                        </div> -->							

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
                                    <?php echo form_input(['name'=>'contact_number','id'=>'contact_number', 'class'=>'mdl-textfield__input', 'value'=>set_value('contact_number')])?>			 
                                        <label class = "mdl-textfield__label">Contact Number</label><?php echo form_error('contact_number');?>		 	 
                                      </div>
                                        </div>

                                        <!--div class="col-lg-4 p-t-20"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <select class="chosen-select mdl-textfield__input" name="groups">
                                            <option value=""></option> 
                                            <?php //if(!empty($groups)){ 
                                            //foreach($groups as $group){
                                            ?>
                                            <option value="<? //=$group->group_name?>"><?//=$group->group_name?></option>
                                            <?php //} } ?>
                                            </select>                			 
                                        <label class = "mdl-textfield__label">Group</label>
                                      </div>
                                        </div-->

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
                                                                    
                    <div class="col-lg-4 p-t-20" style="background-color: #f8fafd;"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded is-focused" data-upgraded=",MaterialTextfield">   
                        <input type="text" name="from" class="mdl-textfield__input" id="from_date" data-dtp="dtp_8VDID">
                              <label class = "mdl-textfield__label">Maturity Date (From)</label>     
                            </div>
                    </div>

                         <div class="col-lg-4 p-t-20" style="background-color: #f8fafd;"> 
                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded is-focused" data-upgraded=",MaterialTextfield">     
                    <input type="text" name="to" class="mdl-textfield__input" id="to_date" data-dtp="dtp_8VDID">
                              <label class = "mdl-textfield__label">Maturity Date (To)</label>     
                            </div>
                        </div>
                        
                    <div class="col-lg-4 p-t-20"> 
                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded is-focused" data-upgraded=",MaterialTextfield">     
                    <input type="text" name="to" class="mdl-textfield__input" id="till_date" data-dtp="dtp_8VDID">
                              <label class = "mdl-textfield__label">Matured Till Date</label>     
                            </div>
                        </div> 
                    <div class="col-lg-2 p-t-20"> 
                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <select name="amount_operator" class="mdl-textfield__input" style="padding:10px;font-size: 13px;">
                                  <option value=""></option>
                                  <option value="lessthan">Less Than Equal To</option>
                                  <option value="greaterthan">Greater Than Equal To</option>
                                  <option value="equalto">Equal To</option>
                              </select>
                        <label class = "mdl-textfield__label">Security Amount Is</label>	 	 
                      </div>
                    </div>
                    <div class="col-lg-2 p-t-20"> 
                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'security_amount','id'=>'security_amount','class'=>'mdl-textfield__input'])?>			 
                        <label class = "mdl-textfield__label">Security Amount</label>	 	 
                      </div>
                    </div>

                                <div class="col-lg-4 p-t-20"> 
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                        <select name="mode_security_submission" class="mdl-textfield__input" style="padding: 10px;">
                                            <option value=""></option>
                                            <option value="online">Online</option>
                                            <option value="dd">DD</option>
                                            <option value="fd">FD</option>
                                            <option value="bg">BG</option>
                                            <option value="from_payment_+_security_date">From Payment + Security Date</option>
                                        </select>
                                        <label class = "mdl-textfield__label">Mode Of Security Submission</label>		 	 
                                    </div>
                                </div>

                                <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name'=>'bank_name', 'id'=>'bank_name', 'class'=>'mdl-textfield__input'])?>			 
                                <label class = "mdl-textfield__label">Bank Name</label>		 	 
                              </div>
                                </div>

                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                  <?php echo form_input(['name'=>'bank_reference_no', 'class'=>'mdl-textfield__input'])?>			 
                                      <label class = "mdl-textfield__label">Bank Reference No.</label>		 	 
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
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Organization</label>
                                    </div>
                                </div>						
                                
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield" >			 
                                        <input type="checkbox" data-column="2" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked" >
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">State</label>
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
                                        <label for="" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Work</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="5" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Client Order No.</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="6" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Order No.</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="7" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Order Date</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="8" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Status</label>
                                    </div>
                                </div>	
								
				<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="9" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Security Amount</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="10" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Mode Security Submission</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="11" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Maturity Date</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="12" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Bank Name</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="13" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Bank Reference No.</label>
                                    </div>
                                </div>
                                    
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="14" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Security Creation Date</label>
                                    </div>
                                </div>
                                    
				<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="15" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
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
                                                <th class="center"><strong>Organization</strong></th>
                                                <th class="center"><strong>State</strong></th>
                                                <th class="center"><strong>City</strong></th>
                                                <th class="center"><strong>Work</strong></th>
                                                <th class="center"><strong>Client Order No.</strong></th>
                                                <th class="center"><strong>Order No.</strong></th>
                                                <th class="center"><strong>Order Date</strong></th>
                                                <th class="center"><strong>Status</strong></th>
                                                <th class="center"><strong>Security Amount</strong></th>
                                                <th class="center"><strong>Mode Security Submission</strong></th>
                                                <th class="center"><strong>Maturity Date</strong></th>
                                                <th class="center"><strong>Bank Name</strong></th>                                                
                                                <th class="center"><strong>Bank Reference No.</strong></th>
                                                <th class="center"><strong>Security Creation Date</strong></th>
                                                <th class="center"><strong>Remarks</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php
                                $i=1;
                                //echo '<pre>';print_r($bids);exit;
                                if(!empty($result)) {
                                foreach($result as $detail) {
                                ?>
                                    <tr class="odd gradeX">
                                        <td class="center"><?=$i++?></td>
                                        <td class="center"><?=$detail->name?></td>
                                        <td class="center"><?=$detail->state?></td>
                                        <td class="center"><?=$detail->city?></td>
                                        <td class="center"><?=$detail->enquiry_for?></td>
                                        <td class="center"><?=$detail->client_order_no?></td>
                                        <td class="center"><?=$detail->order_no?></td>
                                        <td class="center"><?=($detail->order_date<>'' || $detail->order_date <> NULL)?date('d-m-Y',strtotime($detail->order_date)):'';?></td>
                                        <td class="center"><?=$detail->status?></td>
                                        <td class="center"><?=$detail->security_amount?></td>
                                        <td class="center"><?= str_replace('_', ' ', $detail->mode_security_submission)?></td>
                                        <td class="center"><?=($detail->security_duration<>'' || $detail->security_duration <> NULL)?date('d-m-Y',strtotime($detail->security_duration)):'';?></td>
                                        <td class="center"><?=$detail->security_bank_name?></td>
                                        <td class="center"><?=$detail->bank_reference_no?></td>  
                                        <td class="center"><?=($detail->security_creation_date<>'' || $detail->security_creation_date <> NULL)?date('d-m-Y',strtotime($detail->security_creation_date)):''; ?></td>  
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
   $(document).ready(function() {
        var table = $('#example4').DataTable({
                        "scrollX": true
                        //"scrollY": "200px",
                        //"paging": false
                });
            table.columns([5,6,7,12,13,14 ]).visible( false, false );
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
                // $('#company_id').val(ui.item.company_id); // save selected id to input
                return false;
            }
        });
     
     
    
    });
        
        
        
</script>
</body>
<script>
    $('#export_to_excel').click(function () {
        $('<table>') 
        .append($('<tr><tr><td></td><td></td><td></td><td><strong>Security Performance Report</strong></td></tr><tr><tr>'))
        .append(
            $("#example4 thead").html()
         )
        .append(
            $("#example4").DataTable().$('tr').clone()
         )
         .table2excel({
             preserveColors:true,
            filename: "Security-performance-report.xls"
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
        $('#till_date').val("");
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
        $('#till_date').val("");
    });
    $('#till_date').bootstrapMaterialDatePicker({
            time: false,clearButton: true,format: 'DD-MM-YYYY',
    }).on("change",function(d){
        $("#from_date, #to_date").val('');
        //var dt = d.target.value.split('-');
        //$("#till_date").val(dt[2]+"-"+dt[1]+"-"+dt[0]);
    });
    
</script>
</html>