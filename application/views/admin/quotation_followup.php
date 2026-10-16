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
                                <div class="page-title">Quotation Followup Detail</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Quotation Followup Detail</li>
                            </ol>
                        </div>
                    </div>			
<?php echo '<h3>' .$this->session->flashdata('message'). '</h3>'; unset($_SESSION['message']); ?>	

                     <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Detail</header>
                                    <div class="tools">
	                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                    <table class="table table-hover table-checkable order-column full-width" id="example4">
                                        <thead>
                                            <tr>
                                                <th class="center">Date</th>
                                        <!--	<th class="center">Enquiry For</th> -->
                                                <th class="center">Quotation Number</th>	
                                                <th class="center">Quotation Status</th>
                                                <th class="center">Remarks</th>		
                                                <th class="center">Mode</th>
                                                <th class="center">Organization</th>
                                        <!--	<th class="center">State</th> -->
                                                <th class="center">City</th>
                                        <!--	<th class="center">Address</th> -->
                                                <th class="center">Contact Person</th>
                                                <th class="center">Contact Number</th>
                                                <th class="center">Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="odd gradeX">
                                                <td class="center"><?=$detail->date?></td>
                                        <!--	<td class="center"><?=$detail->enquiry_for?></td> -->
                                                <td class="center"><?=$detail->quotation_number?></td>
                                                <td class="center">
                                                <?php if($detail->quotation_status == 0){ echo "OPEN"; }else{ echo "CLOSE";}?>
                                                </td>
                                                <td class="center"><?=$detail->remark?></td>
                                                <td class="center"><?=$detail->mode?></td>
                                                <td class="center"><?=$detail->name?></td>
                                        <!--	<td class="center"><?=$detail->state?></td> -->
                                                <td class="center"><?=$detail->city?></td>
                                        <!--	<td class="center"><?=$detail->address?></td> -->
                                                <td class="center"><?=$detail->contact_person?></td>
                                                <td class="center"><?=$detail->contact_number?></td>
                                                <td class="center"><?=$detail->email?></td>
                                            </tr>	
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					<?php
                            $status = '';
                            $key = array_search('Award To Us', array_column($followups, 'close_status'));
                            if($key !== False && is_numeric($key)){
                                $status = 'hide'; 
                            }
                        ?>
                     <div class="row">
						<div class="col-sm-12">
							<div class="card-box">
								<div class="card-head">
									<header>Followup Started</header>
									<?php if($status == 'hide'){ ?>
                                    <span class="label label-success ">Awarded To Us</span>
                                    <?php } ?>
								</div>
								<?php if($status != 'hide'){ ?>
							<form method="post">
								<div class="card-body row">								
								
						            <div class="col-lg-4 p-t-20"> 
						            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
									<select name="followup_status" id="followup_status" class="mdl-textfield__input"> 
									<option value="0">OPEN</option>
									<option value="1" <?php if($this->session->userdata('type') == 3){ echo "disabled";}?>>CLOSE</option>
									</select>    
										<label class = "mdl-textfield__label">Select Close Status</label>		 	 
					                  </div>
						            </div>								
								
						            <div class="col-lg-4 p-t-20" id="close_section" style="display:none;"> 
						            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
									<select name="close_status" id="close_status" class="mdl-textfield__input"> 
									<option value=""></option>
									<option value="Award To Us">Award To Us</option>
									<option value="Not Useful">Not Useful</option>
									<option value="Competitor Call">Competitor Call</option>
									</select>    
										<label class = "mdl-textfield__label">Select Close Status</label>		 	 
					                  </div>
						            </div>								
								
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
										<textarea class="mdl-textfield__input" name="followup_remarks" required> </textarea>			
					                    <label class = "mdl-textfield__label">Remarks</label>	 	 
					                  </div>
						            </div>								
								
							         <div class="col-lg-12 p-t-20 text-center"> 
<?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>	
						            </div>
								</div>
							</form>
							<?php } ?>
							</div>
						</div>
					</div> 					
				
                     <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Followups</header>
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
												<th class="center">Close Reason</th>
												<th class="center">Remarks</th>
												<th class="center">Followup Date</th>	
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$i=1;
										if(!empty($followups)) {
										foreach($followups as $followup) {
										?>										
											<tr class="odd gradeX">
												<td class="center"><?=$i++?></td>
												<td class="center">
												<?php if($followup->status == 0){ echo "OPEN"; }else{ echo "CLOSE";}?>
												</td>
												<td class="center"><?=$followup->close_status?></td>
												<td class="center"><?=$followup->remarks?></td>
												<td class="center"><?=$followup->date?> </td>
											</tr>
										<?php } } ?>	
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
	if($(this).val() == 1){
		$("#close_section").show();
		$("#close_status").attr("required","required");
	}else{
		$("#close_section").hide();
		$("#close_status").removeAttr("required","required");
	}	
});
</script>	
</body>
</html>