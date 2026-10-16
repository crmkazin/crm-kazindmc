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
<?php  include('side_bar.php');?>
			 <!-- end sidebar menu -->
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Tender</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="<?=base_url();?>tender-list">Tender</a></li>
                                &nbsp;<i class="fa fa-angle-right"></i>&nbsp;
                                <li class="active">Add New</li>
                            </ol>
                        </div>
                    </div>			
<!-- <?php echo '<h3>' .$this->session->flashdata('message'). '</h3>'; unset($_SESSION['message']); ?>						
 -->                     <div class="row">
                    <div class="col-sm-12">
                            <div class="card-box">
                                    <div class="card-head">
                                        <button type="button" class="btn bg-blue-grey waves-effect" title="Previous Page" onclick="history.back();">
                                        <i class="material-icons">arrow_back</i>
                                        </button>
                                            <header>Add Tender</header>
                                    </div>	
                            <form method="post" name="myForm" onsubmit="return validateForm()" autocomplete="off">
                                    <div class="card-body row">																																																						

                                <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                            <?php echo form_input(['name'=>'company','id'=>'company', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>set_value('company')])?>			 
                                <label class = "mdl-textfield__label">Organisation</label><?php echo form_error('company');?>		 	 
                              </div>
                                </div>									
                            <input type="hidden" name="company_id" id="company_id" value="">

                                <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                                            <select name="branch" id="branch" class="mdl-textfield__input" required> 
                                            <option value=""></option>
                                            <option value="add_branch">Add New Branch</option>
                                            </select>    
                                                    <label class = "mdl-textfield__label">Select Branch</label>		 	 
                              </div>
                                </div>									

                                <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                                            <select name="tender_for" id="tender_for" class="mdl-textfield__input" required> 
                                            <option value=""></option>
                                            <option value="Sales">Sales</option>
                                            <option value="Service">Service</option>
                                            </select>    
                                                    <label class = "mdl-textfield__label">Select Tender For</label>		 	 
                              </div>
                                </div>

                                <div class="col-lg-4 p-t-20" id="equipment_section" style="display:none;"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                                            <select name="equipment" id="equipment" class="mdl-textfield__input"> 
                                            <option value=""></option>
                                            <?php if(!empty($products)){ foreach($products as $product){?>
                                            <option value="<?=$product->name?>"><?=$product->name?></option>
                                            <?php } }?>
                                            </select>    
                                                    <label class = "mdl-textfield__label">Equipment Name</label>		 	 
                              </div>
                                </div>

                                <div class="col-lg-4 p-t-20" id="work_section" style="display:none;"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                                    <input type="text" name="work_name" class="mdl-textfield__input" >
                                <label class = "mdl-textfield__label">Work Name</label>	 	 
                              </div>
                                </div>

                                <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                            <?php echo form_input(['name'=>'e_tender_id','id'=>'e_tender_id', 'class'=>'mdl-textfield__input', 'value'=>set_value('e_tender_id')])?>			 
                                <label class = "mdl-textfield__label">E Tender ID/Tender No</label><?php echo form_error('e_tender_id');?>		 	 
                              </div>
                                </div>

                                <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                      <input type="text" name="" id="pre_bid_date_display" value="<?php echo date('d-m-Y'); ?>" class="mdl-textfield__input dts" >
                                      <input type="hidden" name="pre_bid_date" id="pre_bid_date" value="<?php echo date('d-m-Y'); ?>" class="mdl-textfield__input" >
                                <label class = "mdl-textfield__label">Pre Bid Date</label>	 	 
                              </div>
                                </div>

                                <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                      <input type="text" name="" value="<?php echo date('d-m-Y'); ?>" id="last_date_display" class="mdl-textfield__input dts">
                                      <input type="hidden" name="last_date" value="<?php echo date('d-m-Y'); ?>" id="last_date" class="mdl-textfield__input">
                                <label class = "mdl-textfield__label">Last Date</label>	 	 
                              </div>
                                </div>

                                <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                            <?php echo form_input(['name'=>'ammendment','id'=>'ammendment', 'class'=>'mdl-textfield__input', 'value'=>set_value('ammendment')])?>			 
                                <label class = "mdl-textfield__label">Ammendment</label><?php echo form_error('ammendment');?>		 	 
                              </div>
                                </div>

                                <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
<?php echo form_input(['name'=>'emd_amount','id'=>'emd_amount', 'class'=>'mdl-textfield__input', 'value'=>set_value('emd_amount')])?>    
                                                    <label class = "mdl-textfield__label">EMD Amount</label>		 	 
                              </div>
                                </div>

                                <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
<?php echo form_input(['name'=>'est_cost','id'=>'est_cost', 'class'=>'mdl-textfield__input','required'=>'required', 'value'=>set_value('est_cost')])?>    
                                                    <label class = "mdl-textfield__label">Estimated Cost</label>		 	 
                              </div>
                                </div>
                    
                    <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
<?php echo form_input(['name'=>'tender_fee_amt','id'=>'tender_fee_amt', 'class'=>'mdl-textfield__input','required'=>'required', 'value'=>set_value('tender_fee_amt')])?>    
                                                    <label class = "mdl-textfield__label">Tender Fee Amount</label>		 	 
                              </div>
                                </div>
                            
                            <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
<?php echo form_input(['name'=>'processing_fee_amt','id'=>'processing_fee_amt', 'class'=>'mdl-textfield__input','required'=>'required', 'value'=>set_value('processing_fee_amt')])?>    
                                                    <label class = "mdl-textfield__label">Processing Fee Amount</label>		 	 
                              </div>
                                </div>
                    
                    
                                <div class="col-lg-4 p-t-20"> 
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                                            <select name="eligibility" id="eligibility" class="mdl-textfield__input" required> 
                                            <option value=""></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            </select>    
                                                    <label class = "mdl-textfield__label">Eligibility</label>		 	 
                              </div>
                                </div>									

                                <div class="col-lg-4 p-t-20"> 
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                                            <select name="specifications" id="specifications" class="mdl-textfield__input" required> 
                                            <option value=""></option>
                                            <option value="Complied">Complied</option>
                                            <option value="Non-Complied">Non-Complied</option>
                                            </select>    
                                                    <label class = "mdl-textfield__label">Specifications</label>		 	 
                              </div>
                                </div>

                                <div class="col-lg-4 p-t-20"> 
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                            <select name="status" id="status" class="mdl-textfield__input" required> 
                                            <option value=""></option>
                                            <option value="Participate">Participate</option>
                                            <option value="Not Participate">Not Participate</option>
                                            <option value="Decision Pending">Decision Pending</option>
                                            <option value="PreBid">PreBid</option>
                                            </select>    
                                                    <label class = "mdl-textfield__label">Select Status</label>		 	 
                              </div>
                                </div>

                                <div class="col-lg-4 p-t-20" id="bid" style="display:none;"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
<?php echo form_input(['name'=>'bid_no','id'=>'bid_no', 'class'=>'mdl-textfield__input', 'value'=>$bid_no])?> 
<?php echo form_hidden('financial_year_bid_number',$financial_year_bid_number); ?>    
                                                    <label class = "mdl-textfield__label">Bid No</label>		 	 
                              </div>
                                </div>
                                <div class="col-lg-4 p-t-20"> 
                                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
                                    <select name="tender_source" id="tender_source" class="mdl-textfield__input" required> 
                                        <option value="others">Others</option>
                                        <option value="gem">GEM</option>
                                    </select>    
                                            <label class = "mdl-textfield__label">Tender Source</label>		 	 
                              </div>
                                </div>
                                <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                  <textarea class="mdl-textfield__input" name="remarks" required> </textarea>
                                  <input type="hidden" name="financial_year" value="<?php echo $financial_year; ?>" />
                                <label class = "mdl-textfield__label">Remarks</label>	 	 
                              </div>
                                </div>									

                                    </div>
                            <div class="card-head">
                                <div class="col-lg-12"><h3>Organization Detail</h3></div>
                            </div>						
                            <div class="card-body row"> 

                                <div class="col-lg-3 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name'=>'contact_person','id'=>'contact_person','placeholder'=>'Contact Person', 'class'=>'mdl-textfield__input', 'value'=>set_value('contact_person')])?>			 
                                <label class = "mdl-textfield__label">Contact Person</label><?php echo form_error('contact_person');?>		 	 
                              </div>
                                </div>

                                <div class="col-lg-3 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name'=>'email','placeholder'=>'Email Address','type'=>'email','id' =>'email', 'class'=>'mdl-textfield__input', 'value'=>set_value('email')])?>			 
                                <label class = "mdl-textfield__label">Email Address</label> 	 	 
                              </div>
                                </div>

                                <div class="col-lg-3 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php echo form_input(['name'=>'contact_number','id'=>'contact_number','placeholder'=>'Contact Number', 'class'=>'mdl-textfield__input', 'value'=>set_value('contact_number')])?>			 
                                <label class = "mdl-textfield__label">Contact Number</label><?php echo form_error('contact_number');?>		 	 
                              </div>
                                </div>

                                            <div class="block">
                                                    <span class="add"><i class="fa fa-plus btn btn-success"></i></span>
                                            </div>

                                <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                            <?php echo form_input(['name'=>'country','id'=>'country','placeholder'=>'Country', 'class'=>'mdl-textfield__input', 'value'=>'India','required'=>''])?>    
                                                    <label class = "mdl-textfield__label">Select Country</label> 		 	 
                              </div>
                                </div>
                            <input type="hidden" name="country_id" id="country_id" value="">

                                <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                            <?php echo form_input(['name'=>'state','id'=>'state','placeholder'=>'State', 'class'=>'mdl-textfield__input', 'value'=>set_value('state'),'required'=>''])?>    
                                                    <label class = "mdl-textfield__label">State</label>		 	 
                              </div>
                                </div>
                            <input type="hidden" name="state_id" id="state_id" value="">

                                <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                            <?php echo form_input(['name'=>'city','id'=>'city','placeholder'=>'city', 'class'=>'mdl-textfield__input', 'value'=>set_value('city'),'required'=>''])?>    
                                                    <label class = "mdl-textfield__label">City</label>		 	 
                              </div>
                                </div>

                                <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <textarea class="mdl-textfield__input" id="address" name="address"> </textarea>			
                                <label class = "mdl-textfield__label">Address</label>	 	 
                              </div>
                                </div>	
                                
                                <div class="col-lg-4 p-t-20"> 
                                  <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 

                            <?php echo form_input(['name'=>'gstin','id'=>'gstin','placeholder'=>'GSTIN', 'class'=>'mdl-textfield__input', 'value'=>set_value('gstin')])?>    
                                                    <label class = "mdl-textfield__label">GSTIN</label>		 	 
                              </div>
                                </div>
                                

                            <div class="col-lg-12 p-t-20 text-center"> 
<?php echo form_submit(['name'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>	
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

$('.add').click(function() {
    $('.block:last').before('<div class="col-lg-3 p-t-20"></div><div class="col-lg-3 p-t-20"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-upgraded is-dirty"><input type="text" class="mdl-textfield__input" name="secondary_contact_person[]" required><label class = "mdl-textfield__label">Contact Person</label></div></div> <div class="col-lg-3 p-t-20"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-upgraded is-dirty"><input type="text" class="mdl-textfield__input" name="secondary_email_address[]" required><label class = "mdl-textfield__label">Email Adddress</label></div></div> <div class="col-lg-3 p-t-20"><div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-upgraded is-dirty"><input type="text" class="mdl-textfield__input" name="secondary_contact_number[]" required><label class = "mdl-textfield__label">Contact Number</label></div></div>');

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

</script>	
</body>
</html>