<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
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
                                <div class="page-title">Timeline</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="<?php echo base_url('enquiry-followup'); ?>">Queryboard</a></li> &nbsp;<i class="fa fa-angle-right"></i>
                                
                                <li class="active">Timeline</li>
                            </ol>
                        </div>
                    </div>			
<?php echo $this->session->flashdata('message'); unset($_SESSION['message']); 
    //$key = array_search('Confirm', array_column($followups, 'followup_status'));
    //$display = 'none';
    //if($key !== True && !is_numeric($key)){ 
        //$display = 'block';
    //}

?>						
                     <div class="row">
                         <div class="col-sm-12" style="">
							<div class="card-box">
								<div class="card-head">
                                                                    <button type="button" class="btn bg-blue-grey waves-effect" title="Previous Page" onclick="history.back();">
                                                                        <i class="material-icons">arrow_back</i>
                                                                    </button>
									<header>Add Timeline</header>
								</div>	
							<form method="post">
								<div class="card-body row">
								    
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'enquiry_no','id'=>'enquiry_no', 'class'=>'mdl-textfield__input', 'value'=>$followup->enquiry_no, 'readonly'=>'True'])?>			 
					                    <label class = "mdl-textfield__label">Query No</label>		 	 
					                  
									  </div>
						            </div>								    
								    
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'mode','id'=>'mode','required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$followup->mode, 'readonly'=>'True'])?>			 
					                    <label class = "mdl-textfield__label">Mode</label>		 	 
					                  
									  </div>
						            </div>							
							
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'company','id'=>'company','required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$followup->name, 'readonly'=>'True'])?>			 
					                    <label class = "mdl-textfield__label">Company</label>	 	 
					                  </div>
						            </div>

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
							<?php echo form_input(['name'=>'agent','id' =>'agent','required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$followup->contact_person, 'readonly'=>'True'])?>			 
					                    <label class = "mdl-textfield__label">Agent</label> 	 	 
					                  </div>
						            </div>                                                                
                                                            <div class="row card-body" style="width: 100%;">
                                                            
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
							<?php echo form_input(['name'=>'enquiry_type','id'=>'enquiry_type','required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$followup->enquiry_type, 'readonly'=>'True'])?>    
										<label class = "mdl-textfield__label">Enquiry Type</label> 		 	 
					                  </div>
						            </div>
							
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
							<?php echo form_input(['name'=>'status','id'=>'status','required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$followup->status, 'readonly'=>'True'])?>    
										<label class = "mdl-textfield__label">Status</label>		 	 
					                  </div>
						            </div>

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
							<?php echo form_input(['name'=>'remark','id'=>'remark','required'=>'required','class'=>'mdl-textfield__input', 'value'=>$followup->remarks, 'readonly'=>'True'])?>    
										<label class = "mdl-textfield__label">Previous Remark</label>		 	 
					                  </div>
						            </div>
                                                            
							</div>
																
								<div class="col-lg-12 p-t-20"> 
                                                                    <div class="header"> <h3><b>Followup Started</b></h3></div>
								</div>
								<!--
						            <div class="col-lg-4 p-t-20"> 
						            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
									<select name="followup_enquiry_type" id="followup_enquiry_type" class="mdl-textfield__input" required> 
									<option value=""></option>
									<option value="Product Sale">Product Sale</option>
									<option value="Repair">Repair</option>
									<option value="Installation">Installation</option>
									<option value="AMC">AMC</option>
									<option value="Demo">DEMO</option>
									<option value="Equipment Renter">Equipment Renter</option>
									<option value="Tender">Tender</option>
									<option value="Testing Services">Testing Services</option>									
									</select>    
										<label class = "mdl-textfield__label">Select Enquiry Type</label>		 	 
					                  </div>
						            </div> -->								
								
						            <div class="col-lg-4 p-t-20"> 
						            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
								<select name="followup_status" id="followup_status" class="mdl-textfield__input" required> 
                                                                    <option value="pending">Pending</option>
                                                                    <option value="in-progress">In-progress</option>
                                                                    <option value="confirm">Confirm</option>
                                                                    <option value="not-materialized">Not materialized</option>
                                                                </select>    
								<label class = "mdl-textfield__label">Select Status</label>		 	 
                                                            </div>
						            </div>								
								
						            <div class="col-lg-4 p-t-20" id="followup_date_section" style="display:none;"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                                                <input type="date" name="followup_date" class="mdl-textfield__input">    
                                                                <label class = "mdl-textfield__label">Followup Date</label>		 	 
					                  </div>
						            </div>								
								
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
										<textarea class="mdl-textfield__input" name="followup_remarks" required> </textarea>			
					                    <label class = "mdl-textfield__label">Remarks</label>	 	 
					                  </div>
						            </div>								
								
							         <div class="col-lg-12 p-t-20 text-center"> 
									<?php 
										
										if($followup->status != 'cancel-at-arrival'){ 
											echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);
										} 
										
										?>	
						            <input type="button" value="Cancel" name="" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-danger" onclick="history.back();">
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
                                    <header>All Timelines</header>
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
                                                        <th class="center">Status</th>
                                                        <th class="center">Remark</th>
                                                        <th class="center">Date</th>		
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=1;
                                            if(!empty($followups)) {
                                            foreach($followups as $detail) {
                                            ?>
                                            <tr class="odd gradeX">
                                                <td class="center"><?=$i++?></td>
                                                <td class="center"><?=ucfirst($detail->followup_status)?></td>
                                                <td class="center"><?=$detail->followup_remarks?></td>
                                                <td class="center"><?=date('d-m-Y',strtotime($detail->date))?></td>
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
	
<script>
 $("#followup_status").change(function(){ 
	if($(this).val() == 'Future Prospects'){
		$("#followup_date_section").show();
	}else{
		$("#followup_date_section").hide();
	}	
});
</script>	
</body>
</html>