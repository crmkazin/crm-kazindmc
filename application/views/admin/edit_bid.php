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
                                <div class="page-title">Edit Bid</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="<?=base_url();?>bid">Bids</a></li>
                                &nbsp;<i class="fa fa-angle-right"></i>&nbsp;
                                <li class="active">Edit Bid</li>
                            </ol>
                        </div>
                    </div>			
            <?php
                //echo '<pre>';                print_r($detail);
                echo '<h3>' .$this->session->flashdata('message'). '</h3>'; unset($_SESSION['message']);
            ?>
                     <div class="row">
						<div class="col-sm-12">
							<div class="card-box">
								<div class="card-head">
                                                                    <button type="button" class="btn bg-blue-grey waves-effect" title="Previous Page" onclick="history.back();">
    <i class="material-icons">arrow_back</i>
</button>
									<header>Edit Bid</header>
								</div>	
                        <form method="post" name="myForm" onsubmit="return validateForm()">
                                <div class="card-body row">																																																						

                            <div class="col-lg-4 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                        <?php echo form_input(['name'=>'company','id'=>'company', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$detail->name])?>			 
                            <label class = "mdl-textfield__label">Organisation</label><?php echo form_error('company');?>		 	 
                          </div>
                            </div>									
                        <input type="hidden" name="company_id" id="company_id" value="<?=$detail->company_id?>">

                            <div class="col-lg-4 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                                        <select name="branch" id="branch" class="mdl-textfield__input" required> 
                                        <?php if($branches){ foreach($branches as $branch){?>
                                        <option value="<?=$branch->branch_id?>" <?php if($branch->branch_id == $detail->branch_id){ echo "selected";}?>><?=$branch->city?></option>
                                        <?php } }?>
                                        </select>    
                                                <label class = "mdl-textfield__label">Select Branch</label>		 	 
                          </div>
                            </div>									

                            <div class="col-lg-4 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'contact_person','id'=>'contact_person','placeholder'=>'Contact Person', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$detail->contact_person])?>			 
                            <label class = "mdl-textfield__label">Contact Person</label><?php echo form_error('contact_person');?>		 	 
                          </div>
                            </div>

                            <div class="col-lg-4 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'email','placeholder'=>'Email Address','type'=>'email','id' =>'email','required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$detail->contact_email])?>			 
                            <label class = "mdl-textfield__label">Email Address</label> 	 	 
                          </div>
                            </div>

                            <div class="col-lg-4 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <?php echo form_input(['name'=>'contact_number','id'=>'contact_number','placeholder'=>'Contact Number', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$detail->contact_number])?>			 
                            <label class = "mdl-textfield__label">Contact Number</label><?php echo form_error('contact_number');?>		 	 
                          </div>
                            </div>

                            <div class="col-lg-4 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                                        <select name="category" id="category" class="mdl-textfield__input" required> 
                                        <option value=""></option>
                                        <option value="Pavement" <?php if($detail->category == 'Pavement'){ echo "Selected";}?>>Pavement</option>
                                        <option value="Structure" <?php if($detail->category == 'Structure'){ echo "Selected";}?>>Structure</option>
                                        <option value="Geotech" <?php if($detail->category == 'Geotech'){ echo "Selected";}?>>Geotech</option>
                                        <option value="Gephysics" <?php if($detail->category == 'Gephysics'){ echo "Selected";}?>>Gephysics</option>
                                        <option value="NDT" <?php if($detail->category == 'NDT'){ echo "Selected";}?>>NDT</option>
                                        <option value="Material Test" <?php if($detail->category == 'Material Test'){ echo "Selected";}?>>Material Test</option>
                                        <option value="Others" <?php if($detail->category == 'Others'){ echo "Selected";}?>>Others</option>
                                        </select>    
                                                <label class = "mdl-textfield__label">Category</label>		 	 
                          </div>
                            </div>

                            <div class="col-lg-4 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <select name="tender_for" id="tender_for" class="mdl-textfield__input" required> 
                                        <option value=""></option>
                                        <option value="Sales" <?php if($detail->tender_for == 'Sales'){ echo "selected";}?>>Sales</option>
                                        <option value="Service" <?php if($detail->tender_for == 'Service'){ echo "selected";}?>>Service</option>
                                        </select>    
                                                <label class = "mdl-textfield__label">Select Tender For</label>		 	 
                          </div>
                            </div>

                      <div class="col-lg-4 p-t-20" id="equipment_section" <?php if($detail->tender_for =='Service'){?>style="display:none;"<?php }?>> 
                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <select name="equipment" id="equipment" class="mdl-textfield__input"> 
                                        <option value=""></option>
                                        <?php if(!empty($products)){ foreach($products as $product){?>
                                        <option value="<?=$product->name?>" <?php if($product->name == $detail->equipment){ echo "selected";}?>><?=$product->name?></option>
                                        <?php } }?>
                                        </select>    
                                                <label class = "mdl-textfield__label">Equipment Name</label>		 	 
                          </div>
                            </div>

                            <div class="col-lg-4 p-t-20" id="work_section" <?php if($detail->tender_for =='Sales'){?>style="display:none;" <?php }?>> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                                <input type="text" name="work_name" class="mdl-textfield__input" value="<?=$detail->equipment?>">
                            <label class = "mdl-textfield__label">Work Name</label>	 	 
                          </div>
                            </div>

                            <div class="col-lg-4 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                        <?php echo form_input(['name'=>'e_tender_id','id'=>'e_tender_id', 'class'=>'mdl-textfield__input', 'value'=>$detail->e_tender_id])?>			 
                            <label class = "mdl-textfield__label">E Tender ID/Tender No</label><?php echo form_error('e_tender_id');?>		 	 
                          </div>
                            </div>

                            <div class="col-lg-4 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                <input type="text" id="publish_date_display" date-attr="publish_date" name="" class="mdl-textfield__input datepick" value="<?=($detail->publish_date<>'0000-00-00' && $detail->publish_date<>'')?date('d-m-Y',strtotime($detail->publish_date)):date('d-m-Y');  ?>">
                                <input type="hidden" id="publish_date" name="publish_date" class="mdl-textfield__input" value="<?=($detail->publish_date<>'0000-00-00' && $detail->publish_date<>'')?$detail->publish_date:date('Y-m-d');  ?>">
                            <label class = "mdl-textfield__label">Publish Date</label>	 	 
                          </div>
                            </div>

                            <div class="col-lg-4 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                  <input type="text" name="" id="pre_bid_date_display" date-attr="pre_bid_date" class="mdl-textfield__input datepick" value="<?=($detail->pre_bid_date<>'0000-00-00' && $detail->pre_bid_date<>'')?date('d-m-Y',strtotime($detail->pre_bid_date)):date('d-m-Y');?>">
                                  <input type="hidden" name="pre_bid_date" id="pre_bid_date" class="mdl-textfield__input" value="<?=($detail->pre_bid_date<>'0000-00-00' && $detail->pre_bid_date<>'')?$detail->pre_bid_date:date('Y-m-d');?>">
                            <label class = "mdl-textfield__label">Pre Bid Date</label>	 	 
                          </div>
                            </div>

                            <div class="col-lg-4 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                        <input type="text" name="" id="last_date_display" date-attr="last_date" class="mdl-textfield__input datepick" value="<?=($detail->last_date<>'0000-00-00' && $detail->last_date<>'')?date('d-m-Y',strtotime($detail->last_date)):date('d-m-Y');?>">
                                <input type="hidden" name="last_date" id="last_date" class="mdl-textfield__input" value="<?=($detail->last_date<>'0000-00-00' && $detail->last_date<>'')?$detail->last_date:date('Y-m-d');?>">
                            <label class = "mdl-textfield__label">Submission Date</label>	 	 
                          </div>
                            </div>

                            <div class="col-lg-4 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                <input type="text" name="" id="hard_document_date_display" date-attr="hard_document_date" class="mdl-textfield__input datepick" value="<?=($detail->hard_document_date<>'0000-00-00' && $detail->hard_document_date<>'')?date('d-m-Y',strtotime($detail->hard_document_date)):date('d-m-Y');?>">
                                <input type="hidden" name="hard_document_date" id="hard_document_date" class="mdl-textfield__input" value="<?=($detail->hard_document_date<>'0000-00-00' && $detail->hard_document_date<>'')?$detail->hard_document_date:date('Y-m-d');?>">
                            <label class = "mdl-textfield__label">Tender Hard Document Date</label>	 	 
                          </div>
                            </div>
                            <div class="col-lg-4 p-t-20"> 
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                                    <select name="hard_document_submission" class="mdl-textfield__input" required>
                                        <option value="yes" <?php echo ($detail->hard_document_submission=='yes')?'selected':'';  ?>>Yes</option>
                                        <option value="no" <?php echo ($detail->hard_document_submission=='no' || $detail->hard_document_submission=='')?'selected':''; ?> >No</option>
                                    </select>
                                    <label class = "mdl-textfield__label">Tender Hard Copy Submission</label>	 	 
                                </div>
                            </div>
                            <div class="col-lg-4 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                        <?php echo form_input(['name'=>'ammendment','id'=>'ammendment', 'class'=>'mdl-textfield__input', 'value'=>$detail->ammendment])?>			 
                            <label class = "mdl-textfield__label">Ammendment</label><?php echo form_error('ammendment');?>		 	 
                          </div>
                            </div>

                            <div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <select name="processing_fee" id="processing_fee" class="mdl-textfield__input" required> 
                                <option value=""></option>
                                <option value="DD" <?php if($detail->processing_fee == 'DD'){ echo "selected";}?>>DD</option>
                                <option value="Online" <?php if($detail->processing_fee == 'Online'){ echo "selected";}?>>Online</option>
                                <option value="NEFT" <?php if($detail->processing_fee == 'NEFT'){ echo "selected";}?>>NEFT</option>
                                <option value="RTGS" <?php if($detail->processing_fee == 'RTGS'){ echo "selected";}?>>RTGS</option>
                                <option value="not_applicable" <?php if($detail->processing_fee == 'not_applicable'){ echo "selected";}?>>Not Applicable</option>
                                </select>    
                                <label class = "mdl-textfield__label">Processing Fees</label>		 	 
                            </div>
                            </div>
                            <?php 
                            $style= '';$disabled='';
                            if($detail->processing_fee == 'not_applicable'){
                                $style = 'background:#f5f5f5;';
                                $disabled = 'disabled=""';
                            } ?>
                            <div class="col-lg-4 p-t-20" id="processing_fee_no" style="<?php echo $style; ?>">
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input type="text" name="pf_no" value="<?php echo $detail->processing_fee_no; ?>" class="mdl-textfield__input" <?php echo $disabled; ?>>
                                    <label class = "mdl-textfield__label">No.</label> </div>
                            </div>

                            <div class="col-lg-4 p-t-20" id="processing_fee_date" style="<?php echo $style; ?>"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                <input type="text" name="" id="processing_fee_date_display" date-attr="processing_fee_date_hdn" class="mdl-textfield__input datepick" value="<?=($detail->processing_fee_date<>'0000-00-00' && $detail->processing_fee_date<>'')?date('d-m-Y',strtotime($detail->processing_fee_date)):date('d-m-Y');?>" <?php echo $disabled; ?>>
                                <input type="hidden" name="processing_fee_date" id="processing_fee_date_hdn" class="mdl-textfield__input" value="<?=($detail->processing_fee_date<>'0000-00-00' && $detail->processing_fee_date<>'')?$detail->processing_fee_date:date('Y-m-d');?>" <?php echo $disabled; ?>>
                                <label class = "mdl-textfield__label">Processing Fee Date</label>	 	 
                            </div>
                            </div>

                            <div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <select name="tender_fee" id="tender_fee" class="mdl-textfield__input" required> 
                                    <option value=""></option>
                                    <option value="DD" <?php if($detail->tender_fee == 'DD'){ echo "selected";}?>>DD</option>
                                    <option value="Online" <?php if($detail->tender_fee == 'Online'){ echo "selected";}?>>Online</option>
                                    <option value="FD" <?php if($detail->tender_fee == 'FD'){ echo "selected";}?>>FD</option>
                                    <option value="NEFT" <?php if($detail->tender_fee == 'NEFT'){ echo "selected";}?>>NEFT</option>
                                    <option value="RTGS" <?php if($detail->tender_fee == 'RTGS'){ echo "selected";}?>>RTGS</option>
                                    <option value="not_applicable" <?php if($detail->tender_fee == 'not_applicable'){ echo "selected";}?>>Not Applicable</option>
                                </select>    
                                <label class = "mdl-textfield__label">Tender Fee</label>		 	 
                            </div>
                            </div>
                            <?php 
                            $style= '';$disabled='';
                            if($detail->tender_fee == 'not_applicable'){
                                $style = 'background:#f5f5f5;';
                                $disabled = 'disabled=""';
                            } ?>
                            <div class="col-lg-4 p-t-20" id="tender_fee_no" style="<?php echo $style; ?>">
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input type="text" name="tf_no" value="<?php echo $detail->tender_fee_no; ?>" class="mdl-textfield__input" <?php echo $disabled; ?>>
                                <label class = "mdl-textfield__label">No.</label> 
                                </div>
                            </div>

                            <div class="col-lg-4 p-t-20" id="tender_fee_date" style="<?php echo $style; ?>"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                  <input type="text" id="tender_fee_date_display" date-attr="tender_fee_date_hdn" name="" class="mdl-textfield__input datepick" value="<?=($detail->tender_fee_date<>'0000-00-00' && $detail->tender_fee_date<>'')?date('d-m-Y',strtotime($detail->tender_fee_date)):date('d-m-Y');?>" <?php echo $disabled; ?>>
                                <input type="hidden" id="tender_fee_date_hdn" name="tender_fee_date" class="mdl-textfield__input" value="<?=($detail->tender_fee_date<>'0000-00-00' && $detail->tender_fee_date<>'')?$detail->tender_fee_date:date('Y-m-d');?>" <?php echo $disabled; ?>>
                            <label class = "mdl-textfield__label">Tender Fee Date</label>	 	 
                          </div>
                            </div>

                            <div class="col-lg-4 p-t-20" > 
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <select name="emd_fee" id="emd_fee" class="mdl-textfield__input" required> 
                                        <option value=""></option>
                                        <option value="DD" <?php if($detail->emd_fee == 'DD'){ echo "selected";}?>>DD</option>
                                        <option value="Online" <?php if($detail->emd_fee == 'Online'){ echo "selected";}?>>Online</option>
                                        <option value="FD" <?php if($detail->emd_fee == 'FD'){ echo "selected";}?>>FD</option>
                                        <option value="BG" <?php if($detail->emd_fee == 'BG'){ echo "selected";}?>>BG</option>
                                        <option value="NEFT" <?php if($detail->emd_fee == 'NEFT'){ echo "selected";}?>>NEFT</option>
                                        <option value="RTGS" <?php if($detail->emd_fee == 'RTGS'){ echo "selected";}?>>RTGS</option>
                                        <option value="not_applicable" <?php if($detail->emd_fee == 'not_applicable'){ echo "selected";}?>>Not Applicable</option>
                                    </select>    
                                    <label class = "mdl-textfield__label">EMD Amount</label>		 	 
                                </div>
                            </div>
                            <?php 
                            $style= '';$disabled='';
                            if($detail->emd_fee == 'not_applicable'){
                                $style = 'background:#f5f5f5;';
                                $disabled = 'disabled=""';
                            } ?>
                            <div class="col-lg-4 p-t-20" id="emd_fee_no" style="<?php echo $style; ?>">
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input type="text" name="ef_no" value="<?php echo $detail->emd_fee_no; ?>" class="mdl-textfield__input" <?php echo $disabled; ?>>
                                    <label class = "mdl-textfield__label">No</label> </div>
                            </div>

                            <div class="col-lg-4 p-t-20" id="emd_fee_date" style="<?php echo $style; ?>"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                  <input type="text" id="end_fee_date_display" name="" date-attr="end_fee_date" class="mdl-textfield__input datepick" value="<?=($detail->emd_fee_date<>'0000-00-00' && $detail->emd_fee_date<>'')?date('d-m-Y',strtotime($detail->emd_fee_date)):date('d-m-Y');?>" <?php echo $disabled; ?>>
                                  <input type="hidden" id="end_fee_date" name="end_fee_date" class="mdl-textfield__input" value="<?=($detail->emd_fee_date<>'0000-00-00' && $detail->emd_fee_date<>'')?$detail->emd_fee_date:date('Y-m-d');?>" <?php echo $disabled; ?>>
                            <label class = "mdl-textfield__label">EMD Date</label>	 	 
                          </div>
                            </div>
                            
                            <div class="col-lg-8 p-t-20" id="emd_fee_date" style=""> 
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                  
                                  <select class="mdl-textfield__input" name="emd_status">
                                      <option value=""></option>
                                      <option <?=($detail->emd_status=='pending')?'selected':''; ?> value="pending">Pending</option>
                                      <option <?=($detail->emd_status=='returned')?'selected':''; ?> value="returned">Returned</option>
                                  </select>
                            <label class = "mdl-textfield__label">EMD Status</label>	 	 
                          </div>
                            </div>
                            
                            <div class="col-lg-4 p-t-20" id="emd_fee_date" style=""> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                  <input type="text" id="emd_return_date_display" date-attr="emd_return_date" name="" class="mdl-textfield__input datepick" value="<?=($detail->emd_return_date<>'0000-00-00' && $detail->emd_return_date<>'')?date('d-m-Y',strtotime($detail->emd_return_date)):'';?>" >
                                  <input type="hidden" id="emd_return_date" name="emd_return_date" class="mdl-textfield__input" value="<?=($detail->emd_return_date<>'0000-00-00' && $detail->emd_return_date<>'')?$detail->emd_return_date:'';?>" >
                            <label class = "mdl-textfield__label">EMD Return Date</label>	 	 
                          </div>
                            </div>                            
                            
                            
                            <div class="col-lg-4 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
<?php echo form_input(['name'=>'est_cost','id'=>'est_cost', 'class'=>'mdl-textfield__input','required'=>'required', 'value'=>$detail->est_cost])?>    
                                                <label class = "mdl-textfield__label">Estimated Cost</label>		 	 
                          </div>
                            </div>

                            <div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                                        <select name="eligibility" id="eligibility" class="mdl-textfield__input" required> 
                                        <option value=""></option>
                                        <option value="Yes" <?php if($detail->eligibility == 'Yes'){ echo "selected";}?>>Yes</option>
                                        <option value="No" <?php if($detail->eligibility == 'No'){ echo "selected";}?>>No</option>
                                        </select>    
                                                <label class = "mdl-textfield__label">Eligibility</label>		 	 
                          </div>
                            </div>									

                            <div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                                        <select name="specifications" id="specifications" class="mdl-textfield__input" required> 
                                        <option value=""></option>
                                        <option value="Complied" <?php if($detail->specifications == 'Complied'){ echo "selected";}?>>Complied</option>
                                        <option value="Non-Complied" <?php if($detail->specifications == 'Non-Complied'){ echo "selected";}?>>Non-Complied</option>
                                        </select>    
                                                <label class = "mdl-textfield__label">Specifications</label>		 	 
                          </div>
                            </div>

                            <div class="col-lg-4 p-t-20" id="bid"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
<?php echo form_input(['name'=>'bid_no','id'=>'bid_no', 'class'=>'mdl-textfield__input', 'value'=>$detail->bid_number])?>    
                                                <label class = "mdl-textfield__label">Bid No</label>		 	 
                          </div>
                            </div>

                            <div class="col-lg-4 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <textarea class="mdl-textfield__input" name="remarks"><?=$detail->remarks?></textarea>			
                            <label class = "mdl-textfield__label">Remarks</label>	 	 
                          </div>
                            </div>									

                                </div>
                        <input type="hidden" name="tender_id" value="<?=$detail->tender_id?>">	
                        <div class="card-body row"> 

                        <div class="col-lg-12 p-t-20 text-center"> 
<?php echo form_submit(['name'=>'submit','id'=>'submit','class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Update']);?>	
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
<script>
    /*$('#publish_date, #pre_bid_date, #last_date,#hard_document_date,#processing_fee_date,#tender_fee_date,#end_fee_date,#emd_return_date').bootstrapMaterialDatePicker({
            time: false,clearButton: true
    });*/
    
    $('.datepick').bootstrapMaterialDatePicker({
        time: false,clearButton: true,format: 'DD-MM-YYYY',
    }).on("change",function(d){
        //console.log($(this).attr("date-attr"));
        var dt = d.target.value.split('-');
        $("#"+$(this).attr("date-attr")).val(dt[2]+"-"+dt[1]+"-"+dt[0]);
    });
    
</script>	
  <!-- suggesstion Script -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- jQuery UI -->
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>	
	
<script>

$('.add').click(function() {
    $('.block:last').before('<div class="col-lg-3 p-t-20"></div><div class="col-lg-3 p-t-20"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"><input type="text" class="mdl-textfield__input" name="secondary_contact_person[]" required><label class = "mdl-textfield__label">Contact Person</label></div></div> <div class="col-lg-3 p-t-20"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"><input type="text" class="mdl-textfield__input" name="secondary_email_address[]" required><label class = "mdl-textfield__label">Email Adddress</label></div></div> <div class="col-lg-3 p-t-20"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"><input type="text" class="mdl-textfield__input" name="secondary_contact_number[]" required><label class = "mdl-textfield__label">Contact Number</label></div></div>');

});

$('.optionBox').on('click','.remove',function() {
    $(this).parent().remove();
});

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

function validateForm() {

  var x = document.forms["myForm"]["ammendment"].value;
  if (x != "") {
var y = document.forms["myForm"]["last_date"].value;
  if(y == ""){
  alert("Please filled out last date"); 
  return false;
  }
  }

    if($("#submit").val() == 'Update'){
  
  if (confirm('Are you sure you want to submit - '+$("#bid_no").val()+' ?')){         
    return true;         
  } else {
    return false;
  } 
    }
}


$("#tender_for").change(function(){ 
    
	if($(this).val() == 'Sales'){
		$("#equipment_section").show();
		$("#work_section").hide();
	}else if($(this).val() == 'Service'){
	 $("#work_section").show();   
	 $("#equipment_section").hide();
	}else{
	 $("#work_section").hide();   
	 $("#equipment_section").hide();	    
	}	
});

$("#processing_fee").change(function(){ 
    var pf = $(this).val();
    if(pf === 'not_applicable'){
        $("#processing_fee_no, #processing_fee_date").css('background','#f5f5f5');
        $("input[name=pf_no], input[name=processing_fee_date]").val('').attr('disabled','true');
    }else{
        $("#processing_fee_no, #processing_fee_date").css('background','');
        $("input[name=pf_no], input[name=processing_fee_date]").removeAttr('disabled');
    }	
});

$("#tender_fee").change(function(){ 
    var tf = $(this).val();
    if(tf === 'not_applicable'){
        $("#tender_fee_no, #tender_fee_date").css('background','#f5f5f5');
        $("input[name=tf_no], input[name=tender_fee_date]").val('').attr('disabled','true');
    }else{
        $("#tender_fee_no, #tender_fee_date").css('background','');
        $("input[name=tf_no], input[name=tender_fee_date]").removeAttr('disabled');
    }	
});

$("#emd_fee").change(function(){ 
    var ef = $(this).val();
    if(ef === 'not_applicable'){
        $("#emd_fee_no, #emd_fee_date").css('background','#f5f5f5');
        $("input[name=ef_no], input[name=end_fee_date]").val('').attr('disabled','true');
    }else{
        $("#emd_fee_no, #emd_fee_date").css('background','');
        $("input[name=ef_no], input[name=end_fee_date]").removeAttr('disabled');
    }
});

</script>	
</body>
</html>