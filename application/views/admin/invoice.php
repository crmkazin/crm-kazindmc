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
                                <div class="page-title">Invoice</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Invoice</li>
                            </ol>
                        </div>
                    </div>			
<!-- <?php echo '<h3>' .$this->session->flashdata('message'). '</h3>'; unset($_SESSION['message']); ?>	
 -->					
                     <div class="row">
						<div class="col-sm-12">
							<div class="card-box">
								<div class="card-head">
									<header>Create</header>
								</div>	
							<form method="post" id="form" action="<?php echo base_url();?>invoice">
								<div class="card-body row">								
								
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                    <input type="text" name="invoice_no" id="invoice_no" class="mdl-textfield__input" value="<?php 
                                      if(!empty($detail->invoice_no)){
                                        echo $detail->invoice_no;
                                        }else
                                        {
                                            echo "";
                                        }
                                         ?>" required>
										<label class = "mdl-textfield__label">Invoice No</label>	 	 
					                  </div>
						            </div>								
								
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded is-focused" data-upgraded=",MaterialTextfield">			 
                                                                  <input type="text" name="date" id="invoice_date" value="<?php echo date('Y-m-d'); ?>" class="mdl-textfield__input" required>
										<label class = "mdl-textfield__label">Date</label>	 	 
					                  </div>
						            </div>								
								
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                    <input type="text" name="oa_no" value="<?php                                      if(!empty($detail->order_no)){
                                                                echo $detail->order_no;
                                                                }else
                                                                {
                                                                    echo "";
                                                                }
                                                                            ?>"
					                    class="mdl-textfield__input" required>
                                                            <label class = "mdl-textfield__label">OA No</label>	 	 
					                  </div>
						            </div>								
								
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">	<!-- 		 
							<?php echo form_input(['name'=>'company','id'=>'company', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$detail->name])?> -->	
							<input type="text" name="company" class="mdl-textfield__input" id="company" value="<?php if(!empty($detail->name)){
                                        echo $detail->name;
                                        }else
                                        {
                                            echo "";
                                        }
                                         ?>">		 
					                    <label class = "mdl-textfield__label">Client</label><?php echo form_error('company');?>		 	 
					                  </div>
						            </div>								
								<input type="hidden" name="company_id" id="company_id" value="<?php 
                                 if(!empty($detail->company_id)){
                                        echo $detail->company_id;
                                        }else
                                        {
                                            echo "";
                                        }
                                         ?>">
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
									<select name="branch" id="branch" class="mdl-textfield__input" required> 
									<option value=""></option>
									<?php 
									if(!empty($branches)){
									 foreach($branches as $branch)
									 {  
									 ?>
									<option value='<?=$branch->branch_id?>' <?php if($branch->branch_id == $detail->branch){ echo "selected";}?>><?=$branch->city?></option>
									<?php 
								     } }?>

									</select>  
									
										<label class = "mdl-textfield__label">Select Branch</label>		 	 
					                  </div>
						            </div>								
								
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
    									<select multiple="multiple" name="enquiry_for[]" id="enquiry_for" class="mdl-textfield__input" required> 
    									<option value=""></option>
    									<?php if(!empty($products)){
    									foreach($products as $product){
    									?>
    									<option value="<?=$product->name?>"
    									 <?php if(!empty($detail->enquiry_for) && (trim($detail->enquiry_for) == trim($product->name))){echo "selected"; }?>> <?=$product->name?> </option>
    									<?php } }?>
    									</select>										 
					                    <label class = "mdl-textfield__label">Enquiry For</label><?php echo form_error('enquiry_for');?>		 	 
					                  </div>
						            </div>								
								<!-- <?php echo $detail->enquiry_for;
                                echo $product->name;
								 ?> -->
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                    <input type="text" name="purchase_order_detail" class="mdl-textfield__input" required>
										<label class = "mdl-textfield__label">Purchase Order Detail</label>	 	 
					                  </div>
						            </div>								
								
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                                                  <input type="text" name="sub_total" value="<?php echo (!empty($detail) && $detail->amount_without_gst<>'')?$detail->amount_without_gst:''; ?>" class="mdl-textfield__input" required id="price">
										<label class = "mdl-textfield__label"> Taxable Amount</label>	 	 
					                  </div>
						            </div>								
									
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
										<select name="igst_tax" class="mdl-textfield__input" required id="selectgst">
										<option value=""></option>
										<option value="igst">IGST 18%</option>
										<option value="cgst_sgst">CGST 9%+SGST 9%</option>
										</select>
										<label class = "mdl-textfield__label">IGST</label>	 	 
					                  </div>
						            </div>									
									  <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded is-focused" data-upgraded=",MaterialTextfield">			 
										<input type="text" name="received_amount" class="mdl-textfield__input" id="total_tax">
										<label class = "mdl-textfield__label">Tax Value</label>	 	 
					                  </div>
						            </div>	

						            <div class="col-lg-4 p-t-20"> 
						             <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded is-focused" data-upgraded=",MaterialTextfield">				 
										<input type="text" name="amount" class="mdl-textfield__input" required id="total">
										<label class = "mdl-textfield__label">Total Invoice Value</label>	 	 
					                  </div>
						            </div>
									
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
										<input type="text" name="received_amount" class="mdl-textfield__input">
										<label class = "mdl-textfield__label">Received Amount</label>	 	 
					                  </div>
						            </div>

						           

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty">			 
                                                                  <input type="text" value="<?php echo date('Y-m-d'); ?>" name="received_amount_date" id="received_amt_date" class="mdl-textfield__input">
										<label class = "mdl-textfield__label">Received Amount Date</label>	 	 
					                  </div>
						            </div>

		 
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                    <input type="text" name="tds_deduction" class="mdl-textfield__input" required>
										<label class = "mdl-textfield__label">TDS Deduction</label>	 	 
					                  </div>
						            </div>
							
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                   <!--  <input type="text" name="company_gst" class="mdl-textfield__input" required> -->
					                   <select name="company_gst" class="mdl-textfield__input" required>
                                                                <option value=""></option>
                                                                <option value="18">gst no.1</option>
                                                                <option value="5">gst no. 2</option>
                                                            </select>
							<label class = "mdl-textfield__label">Company Gst</label>	 	 
					                  </div>
						            </div>							
							
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                    <input type="text" name="customer_gst" class="mdl-textfield__input" required>
										<label class = "mdl-textfield__label">Customer Gst</label>	 	 
					                  </div>
						            </div>							
							
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                    <input type="text" name="remarks" value="<?php
                                     if(!empty($detail->remarks)){
                                        echo $detail->remarks;
                                        }else
                                        {
                                            echo "";
                                        }
                                         ?>"
					                    class="mdl-textfield__input" required>
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
<script>
    $('#invoice_date, #received_amt_date').bootstrapMaterialDatePicker({
        time: false,clearButton: true,
    });
</script>
    <!-- end js include path -->	
  <!-- suggesstion Script -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
            $("#branch").empty();
		//	$('#branch').append('<option value="">Select Branch</option>');
            var opts = $.parseJSON(data);
            $.each(opts, function(i, d) {
               $('#branch').append('<option value="' + d.branch_id + '">' + d.city + '</option>');
            });
		//	$('#branch').append('<option value="add_branch">Add New Branch</option>');
        },
		 error: function(jqXHR, textStatus, errorThrown) {
           //console.log(textStatus, errorThrown);
        }
    });	
	
       return false;
      }
     });

});

var submit = document.querySelector("input[type=submit]");
  
submit.setAttribute("onclick", "return test()");

function test() {
   
var invoice = $("#invoice_no").val();

  if (confirm('Are you sure you want to submit - '+$("#invoice_no").val()+' ?')){         
    return true;         
  } else {
    return false;
  }

}

</script>	
<script>
$(document).ready(function(){
    $("#selectgst").change(function(){
        var gst = 18;
        var price = $('#price').val();
        var tot_price = (price * gst / 100) ;
        sum=Number(tot_price)+Number(price);
        var total_value=sum;
        $('#total_tax').val(tot_price);
        $('#total').val(total_value);
    });
     
    
});
</script>
</body>
</html>