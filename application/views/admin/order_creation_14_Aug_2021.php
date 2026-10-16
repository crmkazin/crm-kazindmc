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
                                <div class="page-title">Order Acknowledgement Creation</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">OA</li>
                            </ol>
                        </div>
                    </div>			
<?php //echo '<pre>'; print_r($detail);
    /*if($this->session->flashdata('message')<>''){
        echo '<div class="alert alert-success">' .$this->session->flashdata('message'). '</div>';
    }*/
?>	

                     <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <button type="button" class="btn bg-blue-grey waves-effect" title="Previous Page" onclick="history.back();">
    <i class="material-icons">arrow_back</i>
</button>
                                    <header>OA Detail</header>
                                    <div class="tools">
	                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>
                                <?php if($bid_id==0){ ?>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                    <table class="table table-hover table-checkable order-column full-width" id="example4">
                                        <thead>
                                            <tr>
                                                <th class="center" width="10%">Quotation Date</th>
                                                <th class="center">Quotation Number</th>
                                                <th class="center">Enquiry For</th>
                                                <th class="center">Remarks</th>		
                                                <th class="center">Mode</th>
                                                <th class="center">Company</th>
                                                <th class="center">City</th>
                                                <th class="center">State</th>
                                                <th class="center">Address</th>
                                                <th class="center">Contact Person</th>
                                                <th class="center">Contact Number</th>
                                                <th class="center">Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <tr class="odd gradeX">
                                                    <td class="center"><?=$detail->quotation_date?></td>
                                                    <td class="center"><?=$detail->quotation_number?></td>
                                                    <td class="center"><?=$detail->enquiry_for?></td>
                                                    <td class="center"><?=$detail->remarks?></td>
                                                    <td class="center"><?=$detail->mode?></td>
                                                    <td class="center"><?=$detail->name?></td>                                   
                                                    <td class="center"><?=$detail->city?></td>
                                                    <td class="center"><?=$detail->state?></td>
                                                    <td class="center"><?=$detail->address?></td>
                                                    <td class="center"><?=$detail->contact_person?></td>
                                                    <td class="center"><?=$detail->contact_number?></td>
                                                    <td class="center"><?=$detail->email?></td>
                                                </tr>	
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                <?php }else{ ?>
                                    <div class="card-body">
                                    <div class="table-scrollable">
                                    <table class="table table-hover table-checkable order-column full-width" id="example4">
                                        <thead>
                                            <tr>
                                                <th class="center" width="10%">Bid No.</th>
                                                <th class="center">Publish Date</th>	
                                                <th class="center">Hard Document Date</th>
                                                <th class="center">Hard Copy Submission</th>
                                                <th class="center">Processing Fee</th>
                                                <th class="center">Processing Fee No.</th>
                                                <th class="center">Processing Fee Date</th>
                                                <th class="center">Tender Fee</th>
                                                <th class="center">Tender Fee No.</th>
                                                <th class="center">Tender Fee Date</th>
                                                <th class="center">EMD Fee</th>
                                                <th class="center">EMD Fee No.</th>
                                                <th class="center">EMD Fee Date</th>
                                                <th class="center">Remarks</th>
                                                <th class="center">Category</th>
                                                <th class="center">Status</th>
                                                <th class="center">Contact Person</th>
                                                <th class="center">Contact Number</th>
                                                <th class="center">Contact Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <tr class="odd gradeX">
                                                    <td class="center"><?=$detail->bid_number?></td>
                                                    <td class="center"><?=$detail->publish_date?></td>
                                                    <td class="center"><?=$detail->hard_document_date?></td>
                                                    <td class="center"><?= ucfirst($detail->hard_document_submission)?></td>
                                                    <td class="center"><?=$detail->processing_fee?></td>
                                                    <td class="center"><?=$detail->processing_fee_no?></td>
                                                    <td class="center"><?=$detail->processing_fee_date?></td>
                                                    <td class="center"><?=$detail->tender_fee?></td>
                                                    <td class="center"><?=$detail->tender_fee_no?></td>
                                                    <td class="center"><?=$detail->tender_fee_date?></td>
                                                    <td class="center"><?=$detail->emd_fee?></td>
                                                    <td class="center"><?=$detail->emd_fee_no?></td>
                                                    <td class="center"><?=$detail->emd_fee_date?></td>
                                                    <td class="center"><?=$detail->remarks?></td>
                                                    <td class="center"><?=$detail->category?></td>
                                                    <td class="center"><?=$detail->status?></td>
                                                    <td class="center"><?=$detail->contact_person?></td>
                                                    <td class="center"><?=$detail->contact_number?></td>
                                                    <td class="center"><?=$detail->contact_email?></td>
                                                </tr>	
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
					
                     <div class="row">
                        <div class="col-sm-12">
                                <div class="card-box">
                                        <div class="card-head">
                                                <header>Create</header>
                                        </div>	
                                <form method="post">
                                    <input type="hidden" name="organization" value="<?php echo $detail->company_id; ?>"/>
                                    
                                        <div class="card-body row">								

                                    <div class="col-lg-4 p-t-20"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <input type="text" name="order_no" class="mdl-textfield__input" value="<?php echo "2122".$orderAcknowlegdement_id; ?>" required>
                                    <label class = "mdl-textfield__label">Order No</label>	
                                    <input type="hidden" name="enquiry_for" class="mdl-textfield__input" value="<?php
                                     if(!empty($detail->enquiry_for)){
                                        echo $detail->enquiry_for;
                                        }else
                                        {
                                            echo "";
                                        }
                                         ?>">
                                        
                                    <input type="hidden" name="city" class="mdl-textfield__input" value="<?php 
                                   if(!empty($detail->city)){
                                        echo $detail->city;
                                        }else
                                        {
                                            echo "";
                                        }
                                         ?>">
                                  </div>
                                    </div>								

                                    <div class="col-lg-4 p-t-20"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <input type="text" name="order_date" id="order_date" value="<?php echo date('Y-m-d'); ?>" class="mdl-textfield__input" required>
                                    <label class = "mdl-textfield__label">Order Date</label>	 	 
                                  </div>
                                    </div>								

                                    <div class="col-lg-4 p-t-20"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                        
                                        <select name="performance_security" id="select_id" class="mdl-textfield__input" required>
                                            <option value="yes">Yes</option>
                                             <option value="no">No</option>
                                        </select>
                                        <label class = "mdl-textfield__label">Performance Security</label>	 	 
                                    </div>
                                    </div>
                                    <div class="col-lg-4 p-t-20"> 
                                    
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" id="security_amount">			 
                                        <input type="text" name="security_amount"  value="0" class="mdl-textfield__input" >
                                        <label class = "mdl-textfield__label">Security Amount</label>	 	 
                                    </div>
                                    </div>
                                     
                                    <div class="col-lg-4 p-t-20"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"  id="select_subid" >			 
                                        
                                        <select name="mode_security_submission" class="mdl-textfield__input" >
                                            <option value=""></option>
                                            <option value="online">Online</option>
                                            <option value="dd">DD</option>
                                            <option value="fd">FD</option>
                                        </select>
                                        <label class = "mdl-textfield__label">Mode Of Security Submission</label>	 	 
                                    </div>
                                    </div>        
                                      <div class="col-lg-4 p-t-20"> 
                                    
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"  id="security_duration">			 
                                        <input type="text" name="security_duration" value="" class="mdl-textfield__input" >
                                        <label class = "mdl-textfield__label">Duration</label>	 	 
                                    </div>
                                    </div>      
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <input type="text" name="warranty_start_date" id="warranty_start_date" value="<?php echo date('Y-m-d'); ?>" class="mdl-textfield__input" required>
                                            <label class = "mdl-textfield__label">Warranty Start Date</label>	 	 
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-t-20"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <input type="text" name="delivery_due_date" id="delivery_due_date" value="<?php echo date('Y-m-d'); ?>" class="mdl-textfield__input" required>
                                    <label class = "mdl-textfield__label">Delivery Due Date</label>	 	 
                                  </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <select name="status" class="mdl-textfield__input" id="status" required>
                                        <option></option>
                                        <option value="Complete" <?php if($detail->status == 'Complete'){ echo "selected"; }?>>Complete</option>
                                        <option value="Not Complete" <?php if($detail->status == 'Not Complete'){ echo "selected"; }?>>Not Complete</option>
                                        <option value="Pending" <?php if($detail->status == 'Pending'){ echo "selected"; }?>>Pending</option>
                                        <option value="Work In Progress" <?php if($detail->status == 'Work In Progress'){ echo "selected"; }?>>Work In Progress</option>
                                        <option value="Cancel" <?php if($detail->status == 'Cancel'){ echo "selected"; }?>>Cancel</option>
                                    </select>
                                    <label class = "mdl-textfield__label">Status</label>	 	 
                                  </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <input type="text" name="remarks" class="mdl-textfield__input" required>
                                                        <label class = "mdl-textfield__label">Remarks</label>	 	 
                                  </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <input type="text" name="amount_without_gst" class="mdl-textfield__input" required>
                                                        <label class = "mdl-textfield__label">Amount Without GST</label>	 	 
                                  </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <input type="text" name="amount_with_gst" class="mdl-textfield__input" required>
                                                        <label class = "mdl-textfield__label">Amount With GST</label>	 	 
                                  </div>
                                    </div>


                                    <div class="col-lg-4 p-t-20"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                                        <select name="invoice_status" class="mdl-textfield__input" id="invoice_status" required>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No" selected>No</option>
                                                        </select>
                                                        <label class = "mdl-textfield__label">Invoice Status</label>	 	 
                                  </div>
                                    </div>									

                                    <div class="col-lg-4 p-t-20" id="invoice_no" style="display:none;"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <input type="text" name="invoice_no" class="mdl-textfield__input">
                                                        <label class = "mdl-textfield__label">Invoice No</label>	 	 
                                  </div>
                                    </div>									
                                    

                                         <div class="col-lg-12 p-t-20 text-center"> 
                            <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>	
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
$("#invoice_status").change(function(){ 
	if($(this).val() == 'Yes'){
		$("#invoice_no").show();
	}else{
		$("#invoice_no").hide();
	}	
});
$(document).ready(function(){
	$('#order_date, #delivery_due_date, #warranty_start_date').bootstrapMaterialDatePicker({
		time: false,clearButton: true,
	});
});
$("#select_id").change(function(){ 
    if($(this).val() == 'no'){
        $("#security_amount").hide();
        $("#select_subid").hide();
        $("#security_duration").hide();

    } 
      if($(this).val() == 'yes'){
        $("#security_amount").show();
        $("#select_subid").show();
        $("#security_duration").show();

    } 
});


</script>	
</body>
</html>