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
                                <div class="page-title">OA Report</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active"> OA Report</li>
                            </ol>
                        </div>
                    </div>			
<!-- <?php echo '<h3>' .$this->session->flashdata('message'). '</h3>';?>
 -->
<div class="row">
            <div class="col-sm-12">
              <div class="card-box">
                <div class="card-head">
                  <header>Search OA </header>
                </div>  
              <form method="post">
                <div class="card-body row">
                    
                    <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded is-focused" data-upgraded=",MaterialTextfield">   
                    <input type="date" name="from" class="mdl-textfield__input" id="from_date" data-dtp="dtp_8VDID">
                              <label class = "mdl-textfield__label">From</label>     
                            </div>
                        </div>

                         <div class="col-lg-4 p-t-20"> 
                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded is-focused" data-upgraded=",MaterialTextfield">     
                    <input type="date" name="to" class="mdl-textfield__input" id="to_date" data-dtp="dtp_8VDID">
                              <label class = "mdl-textfield__label">To</label>     
                            </div>
                        </div>
                    
                   <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded is-focused" data-upgraded=",MaterialTextfield">   
                    <input type="date" name="order_date" class="mdl-textfield__input" id="" data-dtp="dtp_8VDID">
                              <label class = "mdl-textfield__label">Order Date</label>     
                            </div>
                        </div>

                    <div class="col-lg-4 p-t-20"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">      
                  <select name="performance_security" id="" class="mdl-textfield__input"> 
                    <option value=""></option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                  </select>   
                    <label class = "mdl-textfield__label">Performance Security</label>      
                            </div>
                        </div>     

                    <div class="col-lg-4 p-t-20"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">      
                  <select name="installation" id="" class="mdl-textfield__input"> 
                    <option value=""></option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                  </select>   
                    <label class = "mdl-textfield__label">Installation</label>      
                            </div>
                        </div>
                    
                 <div class="col-lg-4 p-t-20"> 
                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded is-focused" data-upgraded=",MaterialTextfield">   
                    <input type="date" name="installation_date" class="mdl-textfield__input" id="from_date" data-dtp="dtp_8VDID">
                              <label class = "mdl-textfield__label">Installation Date</label>     
                            </div>
                        </div>
                    
                       <div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                <!--select name="status" class="mdl-textfield__input" id="status">
                                    <option></option>
                                    <option value="Complete">Complete</option>
                                    <option value="Not Complete">Not Complete</option>
                                    <option value="Pending" >Pending</option>
                                    <option value="Work In Progress" >Work In Progress</option>
                                    <option value="Cancel" >Cancel</option>
                                </select-->
                                <?php echo form_input(['name'=>'status','id'=>'status','class'=>'mdl-textfield__input', 'value'=>set_value('status')])?>       
                                <label class = "mdl-textfield__label">Status</label>	 	 
                            </div>
                        </div>          
                  
                    <div class="col-lg-4 p-t-20"> 
                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
              <?php echo form_input(['name'=>'remarks','id'=>'remarks','class'=>'mdl-textfield__input', 'value'=>set_value('remarks')])?>       
                              <label class = "mdl-textfield__label">Remarks</label><?php echo form_error('remarks');?>       
                            
                    </div>
                        </div>

                        <div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                <select name="invoice_status" class="mdl-textfield__input" id="invoice_status">
                                    <option value=""></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                                <label class = "mdl-textfield__label">Invoice Status</label>	 	 
                              </div>
                        </div>
                    
                    <div class="col-lg-4 p-t-20" id="div_warranty_start_date"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded is-focused" data-upgraded=",MaterialTextfield">			 
                            <input type="date" name="warranty_start_date" id="warranty_start_date" value="" class="mdl-textfield__input">
                            <label class = "mdl-textfield__label">Warranty Start Date</label>	 	 
                        </div>
                    </div>
                    <div class="col-lg-4 p-t-20"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded is-focused" data-upgraded=",MaterialTextfield">			 
                            <input type="date" name="delivery_due_date" id="delivery_due_date" value="" class="mdl-textfield__input">
                            <label class = "mdl-textfield__label">Delivery Due Date</label>	 	 
                        </div>
                    </div>

                    <div class="col-lg-4 p-t-20"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded is-focused" data-upgraded=",MaterialTextfield">			 
                            <input type="date" name="delivery_actual_date" id="delivery_actual_date" value="" class="mdl-textfield__input">
                            <label class = "mdl-textfield__label">Actual Delivered Date</label>	 	 
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
                                        <input type="checkbox" data-column="1" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked">
                                        <label for="sno" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Organization</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="2" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Branch</label>
                                    </div>
                                </div>						
                                
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield" >             
                                        <input type="checkbox" data-column="3" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="">
                                        <label for="createinvoice" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Enquiry For</label>
                                    </div>
                                </div>
                                    
                                    
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield" >			 
                                        <input type="checkbox" data-column="4" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked" >
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Order Date</label>
                                    </div>
                                </div>
                                 
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="5" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked" >
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Order Number</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="6" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked" >
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Organization Order No.</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="7" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked" >
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Performance Security</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="8" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Security Amount</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="9" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Security Submission Mode</label>
                                    </div>
                                </div>	
								
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="10" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Security Bank</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="11" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Bank Reference No.</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="12" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Warranty Start Date</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="13" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Delivery Due Date </label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="14" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Actual Delivery Date</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="15" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Order Status</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield" >             
                                        <input type="checkbox" data-column="16" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" >
                                        <label for="createinvoice" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Remarks</label>
                                    </div>
                                </div>
                                    
                                    			<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield" >             
                                        <input type="checkbox" data-column="17" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" >
                                        <label for="createinvoice" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Amount With GST</label>
                                    </div>
                                </div>
                                    			<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield" >             
                                        <input type="checkbox" data-column="18" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" >
                                        <label for="createinvoice" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Amount Without GST</label>
                                    </div>
                                </div>
                                    			<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield" >             
                                        <input type="checkbox" data-column="19" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" >
                                        <label for="createinvoice" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">TDS/TCS Deduction</label>
                                    </div>
                                </div>
                                    			<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield" >             
                                        <input type="checkbox" data-column="20" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" >
                                        <label for="createinvoice" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Invoice Status</label>
                                    </div>
                                </div>
                                    			<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield" >             
                                        <input type="checkbox" data-column="21" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" >
                                        <label for="createinvoice" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Invoice No.</label>
                                    </div>
                                </div>
                                    			<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield" >             
                                        <input type="checkbox" data-column="22" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" >
                                        <label for="createinvoice" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Installation Required</label>
                                    </div>
                                </div>
                                    			<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield" >             
                                        <input type="checkbox" data-column="23" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" >
                                        <label for="createinvoice" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Installation Date</label>
                                    </div>
                                </div>
                                    			<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield" >             
                                        <input type="checkbox" data-column="24" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" >
                                        <label for="createinvoice" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Warranty Duration</label>
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
                                    <header>All Order Acknowlegdements</header>
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
                                                <th class="center"><strong>Branch</strong></th>
                                                <th class="center"><strong>Enquiry For</strong></th>
                                                <th class="center"><strong>Order Date</strong></th>
                                                <th class="center"><strong>Order Number</strong></th>
                                                <th class="center"><strong>Organization Order No.</strong></th>	
                                                <th class="center"><strong>Performance Security</strong></th>
                                                <th class="center"><strong>Security Amount</strong></th>
                                                <th class="center"><strong>Security Submission Mode</strong></th>
                                                <th class="center"><strong>Security Bank</strong></th>
                                                <th class="center"><strong>Bank Reference No.</strong></th>
                                                <th class="center"><strong>Warranty Start Date</strong></th>
                                                <th class="center"><strong>Delivery Due Date</strong></th>	
                                                <th class="center"><strong>Actual Delivery Date</strong></th>
                                                <th class="center"><strong>Order Status</strong></th>
                                                <th class="center"><strong>Remarks</strong></th>
                                                <th class="center"><strong>Amount With GST</strong></th>
                                                <th class="center"><strong>Amount Without GST</strong></th>			
                                                <th class="center"><strong>TDS/TCS Deduction</strong></th>
                                                <th class="center"><strong>Invoice Status</strong></th>
                                                <th class="center"><strong>Invoice No.</strong></th>											
                                                <th class="center"><strong>Installation Required</strong></th>
                                                <th class="center"><strong>Installation Date</strong></th>
                                                <th class="center"><strong>Warranty Duration</strong></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i=1;
                                        //echo '<pre>';print_r($oa_details);exit;
                                        if(!empty($oa_details)) {
                                        foreach($oa_details as $details) {
                                        ?>
                                        <tr class="odd gradeX">
                                                <td class="center"><?=$i++?></td>
                                                <td class="center"><?=$details->name?></td>
                                                <td class="center"><?=$details->city?></td>
                                                <td class="center"><?=$details->enquiry_for?></td>
                                                <td class="center"><?=$details->order_date?></td>
                                                <td class="center"><?=$details->order_no?></td>
                                                <td class="center"><?=$details->client_order_no?></td>
                                                <td class="center"><?=$details->performance_security?></td>
                                                <td class="center"><?=$details->security_amount?></td>
                                                <td class="center"><?=$details->mode_security_submission?></td>
                                                <td class="center"><?=$details->security_bank_name; ?></td>
                                                <td class="center"><?=$details->bank_reference_no?></td>
                                                <td class="center"><?=$details->warranty_start_date?></td>
                                                <td class="center"><?=$details->delivery_due_date?></td>
                                                <td class="center"><?=$details->actual_delivered_date?></td>
                                                <td class="center"><?=$details->status?></td>
                                                <td class="center"><?=$details->remarks?></td>
                                                <td class="center"><?=$details->amount_with_gst?></td>
                                                
                                                <td class="center"><?=$details->amount_without_gst?></td>
                                                <td class="center"><?=$details->tds_tcs_deduction?></td>
                                                <td class="center"><?=$details->invoice?></td>
                                                <td class="center"><?=$details->invoice_no?></td>
                                                <td class="center"><?=$details->installation?></td>
                                                
                                                <td class="center"><?=$details->installation_date?></td>
                                                <td class="center"><?=str_replace('_',' ',$details->warranty_duration)?></td>
                                            </tr>
                                        <?php } }	?>

                                        

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
        table.columns( [ 8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24 ] ).visible( false, false );
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
        .append($('<tr><tr><td></td><td></td><td></td><td><strong>OA Report</strong></td></tr><tr><tr>'))
        .append( $("#example4 thead").html())
         .append(
            $("#example4").DataTable().$('tr').clone()
         )
         .table2excel({
             preserveColors:true,
            filename: "OA-report.xls"
        });
        $("#example4").dataTable();
    });
</script>
</html>