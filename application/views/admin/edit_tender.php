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
                                <div class="page-title">Edit Tender</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="<?=base_url();?>tender-list">Tender</a></li>
                                &nbsp;<i class="fa fa-angle-right"></i>&nbsp;
                                <li class="active">Edit Tender</li>
                            </ol>
                        </div>
                    </div>			
<?php echo '<h3>' .$this->session->flashdata('message'). '</h3>'; unset($_SESSION['message']); ?>						
                     <div class="row">
						<div class="col-sm-12">
							<div class="card-box">
								<div class="card-head">
                                                                    <button type="button" class="btn bg-blue-grey waves-effect" title="Previous Page" onclick="history.back();">
    <i class="material-icons">arrow_back</i>
</button>
									<header>Edit Tender</header>
								</div>	
							<form method="post" name="myForm" onsubmit="return validateForm()">
								<div class="card-body row">																																																						
									
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
							<?php echo form_input(['name'=>'company','id'=>'company', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>$detail->name])?>			 
					                    <label class = "mdl-textfield__label">Organization</label><?php echo form_error('company');?>		 	 
					                  </div>
						            </div>									
							<input type="hidden" name="company_id" id="company_id" value="<?=$detail->company_id?>">
							
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
									<select name="branch" id="branch" class="mdl-textfield__input"> 
									<option value=""></option>
									<?php if(!empty($branches)){ foreach($branches as $branch){?>
									<option value="<?=$branch->branch_id?>" <?php if($branch->branch_id == $detail->branch_id){ echo "selected";}?>><?=$branch->city?></option>
									<?php } }?>
									</select>    
										<label class = "mdl-textfield__label">Select Branch</label>		 	 
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

						            <div class="col-lg-4 p-t-20" id="equipment_section" style="display:<?php echo (strtolower($detail->tender_for)=='sales')?'block':'none'; ?>;"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
									<select name="equipment" id="equipment" class="mdl-textfield__input" <?php echo (strtolower($detail->tender_for)=='sales')?'required':''; ?>> 
									<option value=""></option>
									<?php if(!empty($products)){ foreach($products as $product){?>
									<option value="<?=$product->name?>" <?php if($product->name == $detail->equipment){ echo "selected";}?>><?=$product->name?></option>
									<?php } }?>
									</select>    
										<label class = "mdl-textfield__label">Equipment Name</label>		 	 
					                  </div>
						            </div>
                                    
                                    <div class="col-lg-4 p-t-20" id="work_section" style="display:<?php echo (strtolower($detail->tender_for)=='service')?'block':'none'; ?>;"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <input type="text" name="work_name" id="work_name" class="mdl-textfield__input" value="<?php echo (strtolower($detail->tender_for)=='service')?$detail->equipment:''; ?>" <?php echo (strtolower($detail->tender_for)=='service')?'required':''; ?>>
                                            <label class = "mdl-textfield__label">Work Name</label>	 	 
                                        </div>
                                    </div>
                                    
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
							<?php echo form_input(['name'=>'e_tender_id','id'=>'e_tender_id', 'class'=>'mdl-textfield__input', 'value'=>$detail->e_tender_id])?>			 
					                    <label class = "mdl-textfield__label">E Tender ID</label><?php echo form_error('e_tender_id');?>		 	 
					                  </div>
						            </div>

						            <div class="col-lg-4 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                  <?php 
                                  if($detail->pre_bid_date == '0000-00-00' || $detail->pre_bid_date == ''){
                                      $pre_bid_date = date('d-m-Y');
                                  }else{ $pre_bid_date = date('d-m-Y',strtotime($detail->pre_bid_date)); }  ?>
                                <input type="text" name="" id="pre_bid_date_display" class="mdl-textfield__input dts" value="<?=$pre_bid_date?>">
                                <input type="hidden" name="pre_bid_date" id="pre_bid_date" class="mdl-textfield__input" value="<?=$pre_bid_date?>">
                            <label class = "mdl-textfield__label">Pre Bid Date</label>	 	 
                          </div>
                            </div>

                            <div class="col-lg-4 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                  <?php 
                                  if($detail->last_date == '0000-00-00' || $detail->last_date == ''){
                                      $last_date = date('d-m-Y');
                                  }else{ $last_date = date('d-m-Y',strtotime($detail->last_date)); }  ?>
                                  <input type="text" name="" id="last_date_display" class="mdl-textfield__input dts" value="<?=$last_date?>">
                                  <input type="hidden" name="last_date" id="last_date" class="mdl-textfield__input" value="<?=$last_date?>">
                            <label class = "mdl-textfield__label">Last Date</label>	 	 
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
<?php echo form_input(['name'=>'emd_amount','id'=>'emd_amount', 'class'=>'mdl-textfield__input', 'value'=>$detail->emd_amount])?>    
										<label class = "mdl-textfield__label">EMD Amount</label>		 	 
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
<?php echo form_input(['name'=>'tender_fee_amt','id'=>'tender_fee_amt', 'class'=>'mdl-textfield__input','required'=>'required', 'value'=>$detail->tender_fee_amt])?>    
                                                    <label class = "mdl-textfield__label">Tender Fee Amount</label>		 	 
                              </div>
                                </div>
                            
                            <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
<?php echo form_input(['name'=>'processing_fee_amt','id'=>'processing_fee_amt', 'class'=>'mdl-textfield__input','required'=>'required', 'value'=>$detail->processing_fee_amt])?>    
                                                    <label class = "mdl-textfield__label">Processing Fee Amount</label>		 	 
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

						            <div class="col-lg-4 p-t-20"> 
						            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
									<select name="status" id="status" class="mdl-textfield__input" required> 
									<option value=""></option>
									<option value="Participate" <?php if($detail->status == 'Participate'){ echo "selected";}?>>Participate</option>
									<option value="Not Participate" <?php if($detail->status == 'Not Participate'){ echo "selected";}?>>Not Participate</option>
									<option value="Decision Pending" <?php if($detail->status == 'Decision Pending'){ echo "selected";}?>>Decision Pending</option>
									<option value="PreBid" <?php if($detail->status == 'PreBid'){ echo "selected";}?>>PreBid</option>
									</select>    
										<label class = "mdl-textfield__label">Select Status</label>		 	 
					                  </div>
						            </div>
                                    
						            <div class="col-lg-4 p-t-20" id="bid" <?php if($detail->status != 'Participate'){?>style="display:none;" <?php }?>> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
						              <?php if(!empty($bid_no)){ $bid_number = $bid_no->bid_number;}else{ $bid_number = $bid_num; }?>    			 
                                        <?php echo form_input(['name'=>'bid_no','id'=>'bid_no', 'class'=>'mdl-textfield__input', 'value'=>$bid_number])?>    
                                        <?php if(!empty($financial_year_bid_number)){ echo form_hidden('financial_year_bid_number',$financial_year_bid_number); } ?>
										<label class = "mdl-textfield__label">Bid No</label>		 	 
					                  </div>
						            </div>                                    
                                    <div class="col-lg-4 p-t-20"> 
										<div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
											<select name="tender_source" id="tender_source" class="mdl-textfield__input" required> 
												<option value="others" <?php echo ($detail->tender_source=='others')?'selected':''; ?>>Others</option>
												<option value="gem" <?php echo ($detail->tender_source=='gem')?'selected':''; ?>>GEM</option>
											</select>    
											<label class = "mdl-textfield__label">Tender Source</label>		 	 
										</div>
									</div>
                                    <?php if($this->session->userdata('id') == 1){?>
						            <div class="col-lg-4 p-t-20"> 
						            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
									<select name="approval" id="approval" class="mdl-textfield__input"> 
									<option value=""></option>
									<option value="Yes" <?php if($detail->only_for_main_admin == 1){ echo "selected";}?>>Yes</option>
									<option value="No" <?php if($detail->only_for_main_admin == 0){ echo "selected";}?>>No</option>
									</select>    
										<label class = "mdl-textfield__label">Approval Pending</label>		 	 
					                  </div>
						            </div>
                                    <?php }?>

						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
										<textarea class="mdl-textfield__input" name="remarks" required><?=$detail->remarks?></textarea>	
										<input type="hidden" name="financial_year" value="<?php echo $financial_year; ?>" />
					                    <label class = "mdl-textfield__label">Remarks</label>	 	 
					                  </div>
						            </div>									

								</div>
						
							<div class="col-lg-12 p-t-20 text-center"> 
<?php echo form_submit(['name'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Update']);?>	
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
    
    $('#pre_bid_date_display').bootstrapMaterialDatePicker({
            time: false,clearButton: true,format: 'DD-MM-YYYY',
    }).on("change",function(d){
        var dt = d.target.value.split('-');
        $("#pre_bid_date").val(dt[2]+"-"+dt[1]+"-"+dt[0]);
    });
    
    $('#last_date_display').bootstrapMaterialDatePicker({
            time: false,clearButton: true,format: 'DD-MM-YYYY',
    }).on("change",function(d){
        var dt = d.target.value.split('-');
        $("#last_date").val(dt[2]+"-"+dt[1]+"-"+dt[0]);
    });
    
     $(".dts").on("change",function(){
        var pre_date = $('.dts:eq(0)').val().split('-');
        var last_date = $('.dts:eq(1)').val().split('-');
        const pre = new Date(pre_date[2]+"-"+pre_date[1]+"-"+pre_date[0]);
        const last = new Date(last_date[2]+"-"+last_date[1]+"-"+last_date[0]);
        if(pre > last){
            alert('Pre-bid date must be less than last date.');
            var today = ("0"+new Date().getDate()).slice(-2)+'-'+("0"+(new Date().getMonth()+1)).slice(-2)+'-'+new Date().getFullYear();
            $(".dts").val(today);
        }
    });

</script>
	
	
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
			$('#branch').append('<option value="">Select Branch</option>');
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

function validateForm() {

  var x = document.forms["myForm"]["ammendment"].value;
  if (x != "") {
var y = document.forms["myForm"]["last_date"].value;
  if(y == ""){
  alert("Please filled out last date"); 
  return false;
  }
  }
  
    if($("#status").val() == 'Participate'){
  
  if (confirm('Are you sure you want to submit - '+$("#bid_no").val()+' ?')){         
    return true;         
  } else {
    return false;
  } 
    }  
  
  
}

$("#status").change(function(){ 
    
	if($(this).val() == 'Participate'){
		$("#bid").show();
	}else{
	 $("#bid").hide();
	}	
});

$("#tender_for").change(function(){
    if($(this).val() == 'Sales'){
        $("#work_name").removeAttr('required');
        $("#equipment").attr('required','required');
        $("#equipment_section").show();
        $("#work_section").hide();        
    }else if($(this).val() == 'Service'){
        $("#equipment").removeAttr('required');
        $("#work_name").attr('required','required');
        $("#work_section").show();   
        $("#equipment_section").hide();
    }else{
        $("#work_section").hide();   
        $("#equipment_section").hide();	    
    }
});

</script>	
</body>
</html>