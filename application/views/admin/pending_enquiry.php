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
                                <div class="page-title">Pending Enquiry Report</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Pending Enquiry Report</li>
                            </ol>
                        </div>
                    </div>			
<?php echo '<h3>' .$this->session->flashdata('message'). '</h3>'; unset($_SESSION['message']); ?>
                     <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>All Pending Enquiries</header>
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
												<th class="center">Sr.No</th>
												<th class="center">Date</th>
												<th class="center">Enquiry Mode</th>
												<th class="center">Enquiry For</th>	
												<th class="center">Enquiry Type</th>
												<th class="center">Status</th>
												<th class="center">Remarks</th>
												<th class="center">Company</th>
												<th class="center">Country</th>	
											<!--	<th class="center">State</th> -->
												<th class="center">City</th>
											<!--	<th class="center">Address</th> -->
												<th class="center">Contact Person</th>
												<th class="center">Contact No</th>			
												<th class="center">Email</th>
												<th class="center">Reference By</th>
											<!--	<th class="center">Followup</th> -->											
											</tr>
                                        </thead>
                                        <tbody>
										<?php
										$i=1;
										if(!empty($enquiry)) {
										foreach($enquiry as $enquiries) {
										?>
											<tr class="odd gradeX">
											    <td class="center"><?=$i++?></td>
												<td class="center"><?=$enquiries->date?></td>
												<td class="center"><?=$enquiries->mode?></td>
												<td class="center"><?=$enquiries->enquiry_for?></td>
												<td class="center"><?=$enquiries->enquiry_type?></td>
												<td class="center"><?=$enquiries->status?></td>
												<td class="center"><?=$enquiries->remarks?></td>
												<td class="center">
												<?php if(is_numeric($enquiries->name)){ echo "No Name Found";}else{ echo $enquiries->name; }?>
												</td>
												<td class="center"><?=$enquiries->country?></td>
										<!--		<td class="center"><?=$enquiries->state?></td> -->
												<td class="center"><?=$enquiries->city?></td>
										<!--		<td class="center"><?=$enquiries->address?></td> -->
												<td class="center"><?=$enquiries->contact_person?></td>
												<td class="center"><?=$enquiries->contact_number?></td>
												<td class="center"><?=$enquiries->email?></td>
												<td class="center"><?php if(!empty($enquiries->reference_by)){ echo $enquiries->reference_by; }else{ echo "Without Reference";}?></td>
											<!--	<td class="center">
												<?php if($enquiries->enquiry_for != 'Other' && $enquiries->status != 'automated-enquiry'){?>    
												<a href="<?=base_url().$enquiries->id.'/';?>followup">Followup</a>
												<?php }else{ echo "Pending at Admin level"; }?>
												</td> -->
											</tr>
										<?php } }	
										
										if(!empty($multiple)) {
										foreach($multiple as $multiples) {
										?>
											<tr class="odd gradeX">
											    <td class="center"><?=$i++?></td>
												<td class="center"><?=$multiples->date?></td>
												<td class="center"><?=$multiples->mode?></td>
												<td class="center"><?=$multiples->enquiry_for?></td>
												<td class="center"><?=$multiples->enquiry_type?></td>
												<td class="center"><?=$multiples->status?></td>
												<td class="center"><?=$multiples->remarks?></td>
												<td class="center">
												<?php if(is_numeric($multiples->name)){ echo "No Name Found";}else{ echo $multiples->name; }?>
												</td>
												<td class="center"><?=$multiples->country?></td>
											<!--	<td class="center"><?=$multiples->state?></td> -->
												<td class="center"><?=$multiples->city?></td>
											<!--	<td class="center"><?=$multiples->address?></td> -->
												<td class="center"><?=$multiples->contact_person?></td>
												<td class="center"><?=$multiples->contact_number?></td>
												<td class="center"><?=$multiples->email?></td>
												<td class="center"><?php if(!empty($multiples->reference_by)){ echo $multiples->reference_by; }else{ echo "Without Reference";}?></td>
											<!--	<td class="center">
												<?php if($multiples->enquiry_for != 'Other' && $multiples->status != 'automated-enquiry'){?>    
												<a href="<?=base_url().$enquiries->id.'/';?>followup">Followup</a>
												<?php }else{ echo "Pending at Admin level"; }?>
												</td> -->
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
</body>
<script>
    $('#export_to_excel').click(function () {
        $("#example4").table2excel({
            filename: "enquiry-report.xls"
        });
    });
</script>
</html>