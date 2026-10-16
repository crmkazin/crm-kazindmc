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
        echo '<div class="alert alert-success">' .$this->session->flashdata('message'). '</div>'; unset($_SESSION['message']);
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
                                                <th class="center">Organization</th>
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
                                    <input type="text" name="order_no" class="mdl-textfield__input" onkeypress="return validateNum(event)" value="<?php echo $orderAcknowlegdement_id; ?>" required>
                                    <input type="hidden" name="financialyear" class="mdl-textfield__input" value="<?php echo $financialyear; ?>">
                                    <label class = "mdl-textfield__label">OA No</label>	
                                    <input type="hidden" name="enquiry_for" class="mdl-textfield__input" value="<?php
                                     if(!empty($detail->enquiry_for)){
                                        echo $detail->enquiry_for;
                                        }elseif(!empty($detail->equipment))
                                        {
                                            echo $detail->equipment;
                                        }
                                         ?>">
                                        
                                    <input type="hidden" name="city" class="mdl-textfield__input" value="<?php 
                                   if(!empty($detail->branch_id)){
                                        echo $detail->branch_id;
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
                                    <label class = "mdl-textfield__label">OA Date</label>	 	 
                                  </div>
                                    </div>								

                                    <div class="col-lg-4 p-t-20"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                        
                                        <select name="performance_security" id="select_id" class="mdl-textfield__input" style="padding:9px;" required>
                                            <option value="yes">Yes</option>
                                             <option value="no">No</option>
                                        </select>
                                        <label class = "mdl-textfield__label">Performance Security</label>	 	 
                                    </div>
                                    </div>
                                <div class="row divPerformance" style="width: 100%; margin-left: 3px;background-color: #f9f9f9;">
                                           
                                    <div class="col-lg-4 p-t-20" id="div_est_cost"> 
                                    
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" id="">			 
                                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  name="" id="estimated_cost"  value="<?php echo (isset($detail->est_cost)?$detail->est_cost:''); ?>" class="mdl-textfield__input">
                                        <label class = "mdl-textfield__label">Order Value</label>	 	 
                                    </div>
                                    </div>       
                                     
                                    <div class="col-lg-4 p-t-20" id="div_percentage"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                        
                                        <select name="security_percentage" id="security_percentage" class="mdl-textfield__input" style="padding:9px;" required>
                                            <option value=""></option>    
                                            <?php for($i=1;$i<=50;$i++){ ?>
                                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                <?php } ?>
                                        </select>
                                        <label class = "mdl-textfield__label">Select Security Percentage(%)</label>	 	 
                                    </div>
                                    </div> 
                                            
                                    <div class="col-lg-4 p-t-20"> 
                                    
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" id="security_amount">			 
                                        <input type="text" name="security_amount" id="security_amt" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"   value="0" class="mdl-textfield__input">
                                        <label class = "mdl-textfield__label">Security Amount</label>	 	 
                                    </div>
                                    </div>
                                     
                                    <div class="col-lg-4 p-t-20"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"  id="select_subid" >			 
                                        
                                        <select name="mode_security_submission" class="mdl-textfield__input" style="padding:9px;" required>
                                            <option value=""></option>
                                            <option value="online">Online</option>
                                            <option value="dd">DD</option>
                                            <option value="fd">FD</option>
                                            <option value="bg">BG</option>
                                            <option value="from_payment_+_security_date">From Payment + EMD</option>
                                        </select>
                                        <label class = "mdl-textfield__label">Mode Of Security Submission</label>	 	 
                                    </div>
                                    </div>
                                    <div class="col-lg-2 p-t-20"> 
                                    
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"  id="security_duration">			 
                                        <input type="text" name="security_bank_name" value="" class="mdl-textfield__input" required="">
                                        <label class = "mdl-textfield__label">Bank Name</label>	 	 
                                    </div>
                                    </div>
                                                <div class="col-lg-2 p-t-20"> 
                                    
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"  id="security_duration">			 
                                        <input type="text" name="bank_reference_no" value="" class="mdl-textfield__input" required="">
                                        <label class = "mdl-textfield__label">Reference No.</label>	 	 
                                    </div>
                                    </div>
                                    
                                    <div class="col-lg-2 p-t-20">                      
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"  id="security_duration">			 
                                            <input type="text" name="security_creation_date" id="security_creation_date" value="<?php echo date('Y-m-d'); ?>" class="mdl-textfield__input" >
                                            <label class = "mdl-textfield__label">Security Creation Date </label>	 	 
                                        </div>
                                    </div>
                                    
                                      <div class="col-lg-2 p-t-20"> 
                                    
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"  id="security_duration">			 
                                        <input type="text" name="security_duration" id="security_duration" value="<?php echo date('Y-m-d'); ?>" class="mdl-textfield__input" >
                                        <label class = "mdl-textfield__label">Maturity Date </label>	 	 
                                    </div>
                                    </div>
                                            </div>
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <select name="installation" id="installation" class="mdl-textfield__input" style="padding:9px;" required>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                            <label class = "mdl-textfield__label">Testing</label>	 	 
                                        </div>
                                    </div>  
                                             <div class="col-lg-4 p-t-20" id="div_installation_date"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <input type="text" name="installation_date" id="installation_date" value="<?php echo date('Y-m-d'); ?>" class="mdl-textfield__input" required>
                                            <label class = "mdl-textfield__label">Testing Date</label>	 	 
                                        </div>
                                    </div>
                                            
                                        <div class="col-lg-4 p-t-20" id="div_warranty_start_date"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <select name="warranty_duration" id="warranty_duration" style="padding:9px;" class="mdl-textfield__input">
                                                <option value="N/A">N/A</option>
                                                <?php for($i=1;$i<=10;$i++){ ?>
                                                <option value="<?php echo $i; ?>_year"><?php echo $i; ?> Year</option>
                                                <?php } ?>
                                            </select>
                                            <label class = "mdl-textfield__label">Warranty Time</label>	 	 
                                        </div>
                                    </div>    
                                            
                                            <div class="col-lg-4 p-t-20" id="div_warranty_start_date"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <input type="text" name="warranty_start_date" id="warranty_start_date" value="" placeholder="N/A" class="mdl-textfield__input">
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
                                            <input type="text" name="delivery_actual_date" id="delivery_actual_date" value="" placeholder="N/A" class="mdl-textfield__input">
                                            <label class = "mdl-textfield__label">Actual Delivered Date</label>	 	 
                                        </div>
                                    </div>        
                                                
                                    <div class="col-lg-4 p-t-20"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <select name="status" class="mdl-textfield__input" id="status" style="padding:9px;" required>
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
                                    <input type="text" id="amount_without_gst" name="amount_without_gst" class="mdl-textfield__input" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" required>
                                                        <label class = "mdl-textfield__label">Amount Without GST</label>	 	 
                                  </div>
                                    </div>
                                     
                                     <div class="col-lg-4 p-t-20"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <select name="gst_percentage" id="gst_percentage" class="mdl-textfield__input" style="padding:9px;" required>
                                            <option value=""></option>    
                                            <?php for($i=1;$i<=50;$i++){ ?>
                                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                <?php } ?>
                                        </select>
                                                        <label class = "mdl-textfield__label">GST Percentage</label>	 	 
                                    </div>
                                    </div>
                                            
                                    <div class="col-lg-4 p-t-20"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <input type="text" id="amount_with_gst" name="amount_with_gst" class="mdl-textfield__input" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" required>
                                                        <label class = "mdl-textfield__label">Amount With GST</label>	 	 
                                  </div>
                                    </div>

                                      <!--div class="col-lg-4 p-t-20"> 
                                      <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <input type="text" name="tds_tcs_deducted" class="mdl-textfield__input" required>
                                     <label class = "mdl-textfield__label">TDS/TCS(Deducted If Any)</label>	 	 
                                  </div>
                                    </div-->          
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <select name="invoice_status" class="mdl-textfield__input" id="invoice_status" style="padding:9px;" required>
                                                <!--option value="Yes">Yes</option-->
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
    /*if($(this).val() == 'Yes'){
            $("#warranty_start_date").show();
    }else{
            $("#warranty_start_date").hide();
    }*/	
});

$("#installation").change(function(){ 
	if($(this).val() == 'yes'){
		$("#div_installation_date").show();
	}else{
		$("#div_installation_date").hide();
	}	
});

$(document).ready(function(){
    $('#order_date, #delivery_due_date, #warranty_start_date, #delivery_actual_date, #installation_date,#security_duration,#security_creation_date').bootstrapMaterialDatePicker({
        time: false,clearButton: true,
    });
    
    $("#security_percentage").on("change",function(){
        let percentage = parseInt($(this).val());
        if(percentage != "" && $("#estimated_cost").val() != ""){
            calc = parseInt($("#estimated_cost").val()) * parseFloat(percentage/100);
            $("#security_amt").val(Math.round(calc));
        }
    });
    
    
});
$("#select_id").change(function(){ 
    if($(this).val() == 'no'){
        $(".divPerformance .mdl-textfield__input").removeAttr('required');
        $(".divPerformance").hide();
        //$(".divPerformance").hide();
        /*$("#security_amount").hide();
        $("#select_subid").hide();
        $("#security_duration").hide();
        $("#div_percentage").hide();
        $("#div_est_cost").hide();*/
    } 
    if($(this).val() == 'yes'){
        $(".divPerformance").show();
        $(".divPerformance .mdl-textfield__input").attr('required','true');
        
        //$(".divPerformance").show();
          /*
        $("#security_amount").show();
        $("#select_subid").show();
        $("#security_duration").show();
        $("#div_percentage").show();
        $("#div_est_cost").show();*/
    } 
});

    function validateNum(event){
        return (event.charCode >= 48 && event.charCode <= 57);
    }
    
    $("#gst_percentage").on("change",function(){
        if($(this).val() != "" && $("#amount_without_gst").val() != ""){
            calc = parseInt($("#amount_without_gst").val()) * parseFloat(parseInt($(this).val())/100);
            $("#amount_with_gst").val(parseInt($("#amount_without_gst").val())+parseInt(Math.round(calc))).focus();
            $("#amount_with_gst").parent("div").addClass('is-dirty');
        }
    });
    
    $("#amount_without_gst").on("focus",function(){
        $("#gst_percentage, #amount_with_gst").val('');
    });
    
</script>	
</body>
</html>