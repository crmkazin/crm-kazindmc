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
                                <div class="page-title">Tender Followup</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Tender Followup</li>
                            </ol>
                        </div>
                    </div>			
<?php echo '<h3>' .$this->session->flashdata('message'). '</h3>'; unset($_SESSION['message']); ?>	

                     <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Tender Detail</header>
                                    <div class="tools">
	                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                    <table class="table table-hover table-checkable order-column full-width" id="example4">
                                        <thead>
                                            <tr>
												<th class="center" style="max-width:75px;">Organization</th>
												<th class="center">City</th>
												<th class="center">Tender For</th>
												<th class="center">Equipment</th>
												<th class="center">E Tender ID</th>
												<th class="center">Last Date</th>
												<th class="center">Pre Bid Date</th>
												<th class="center">Ammendment</th>
												<th class="center">EMD Amount</th>
												<th class="center">Estimated Cost</th>
												<th class="center">Eligibility</th>
												<th class="center">Specifications</th>
												<th class="center">Status</th>
												<th class="center">Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<tr class="odd gradeX">
												<td class="center"><?=$detail->name?></td>
												<td class="center"><?=$detail->city?></td>
												<td class="center"><?=$detail->tender_for?></td>
												<td class="center"><?=$detail->equipment?></td>
												<td class="center"><?=$detail->e_tender_id?></td>
												<td class="center"><?=$detail->status?></td>
												<td class="center"><?php if($detail->last_date == '0000-00-00'){ echo "N/A"; }else{ echo $detail->last_date;} ?></td>
												<td class="center"><?=$detail->pre_bid_date?></td>
												<td class="center"><?=$detail->ammendment?></td>
												<td class="center"><?=$detail->emd_amount?></td>
												<td class="center"><?=$detail->est_cost?></td>
												<td class="center"><?=$detail->specifications?></td>
												<td class="center"><?=$detail->status?></td>
												<td class="center"><?=$detail->remarks?></td>
											</tr>	
										</tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					
                     <div class="row">
						<div class="col-sm-12">
							<div class="card-box">
								<div class="card-head">
									<header>Tender Status <?php if(strtolower($detail->status)=='participate'){ ?><span class="label label-success ">Participating</span><?php } ?></header>
								</div>	
							<form method="post">
								<div class="card-body row" style="display:<?php echo (strtolower($detail->status)=='participate')?'none':''; ?>;">																
																								
									<input type="hidden" name="company" value="<?=$detail->company_id?>">
									<input type="hidden" name="branch" value="<?=$detail->branch_id?>">
									
						        <!--    <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                    <input type="datetime-local" name="followup_date" class="mdl-textfield__input" required>
										<label class = "mdl-textfield__label">Followup Date time</label>	 	 
					                  </div>
						            </div> -->
							
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                    <input type="text" name="remarks" class="mdl-textfield__input" required>
										<label class = "mdl-textfield__label">Remarks</label>	 	 
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
                                    <header>Tender Detail</header>
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
												<th class="center">Remarks</th>
												<th class="center">Date</th> 
												<th class="center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php if(!empty($followups)){
											$i = 1;
										foreach($followups as $followup){
										?>
											<tr class="odd gradeX">
												<td class="center"><?=$i;?></td>
												<td class="center"><?=$followup->remarks?></td>
												<td class="center"><?=$followup->date?></td>
												<td class="center">
												<a href="<?=base_url().$followup->id?>/delete-tender-followup"  onclick="return confirm('Are you sure you want to delete this ?');" class="btn btn-tbl-delete btn-xs"> 
												<i class="fa fa-trash-o "></i> </a>	
												</td>												
											</tr>
										<?php $i++; } }?>	
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

<script>
$("#status").change(function(){ 
	if($(this).val() == '1'){
		$("#bid_no").show();
	}else if($(this).val() == '0'){
		$("#bid_no").hide();
	}else{
	 $("#bid_no").hide();
	}	
});
</script>	