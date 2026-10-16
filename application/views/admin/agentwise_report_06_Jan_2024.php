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
                        <?php include('report_links.php'); ?>
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Queryboard Report</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active"> Queryboard Report</li>
                            </ol>
                        </div>
                    </div>			
<!-- <?php echo '<h3>' .$this->session->flashdata('message'). '</h3>';?>
 -->
<div class="row">
            <div class="col-sm-12">
              <div class="card-box">
                <div class="card-head">
                  <header>Search Query </header>
                </div>  
              <form method="post">
                <div class="card-body row">                   
                    
                    <div class="col-lg-4 p-t-20"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">      

                          <?php echo form_input(['name'=>'agent_name','id'=>'agent_name', 'class'=>'mdl-textfield__input', 'value'=>''])?>    
                          <label class = "mdl-textfield__label">Agent</label>      
                        </div>
                    </div>
                    <input type="hidden" name="company_details_id" id="company_details_id" value="">
                    
                    <div class="col-lg-2 p-t-20"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">   
                            <select name="location" id="location" class="mdl-textfield__input" style="padding: 10px;">
                                <option value=""></option>
                                <?php 
                                asort($locations);
                                foreach($locations AS $key=>$val){ ?>
                                <option value="<?=$key?>" data-abbr="<?=implode(',',$val)?>"><?= ucfirst($key)?></option>
                                <?php } ?>
                            </select> 
                            <label class = "mdl-textfield__label">Location</label>     
                        </div>
                    </div>
                    <div class="col-lg-2 p-t-20"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">   
                            <select name="booking_type" id="booking_type" class="mdl-textfield__input" style="padding: 10px;">
                            </select> 
                        </div>
                    </div>
                    <div class="col-lg-4 p-t-20"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <select name="status" id="status" class="mdl-textfield__input"> 
                                <option value=""> </option>
                                <option value="In-progress">In-progress</option>
                                <option value="Quotation Sent">Quotation Sent</option>
                                <option value="Confirm">Confirm</option>
                                <option value="Not materialized">Not materialized</option>
                            </select>
                            <label class = "mdl-textfield__label">Status</label>      
                        </div>
                    </div>
                    <div class="col-lg-4 p-t-20"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" data-upgraded=",MaterialTextfield">   
                            <input type="text" name="from" class="mdl-textfield__input" id="from_date" >
                            <label class = "mdl-textfield__label">From Date</label>     
                        </div>
                    </div>

                    <div class="col-lg-4 p-t-20"> 
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" data-upgraded=",MaterialTextfield">     
                        <input type="text" name="to" class="mdl-textfield__input" id="to_date">
                         <label class = "mdl-textfield__label">To Date</label>     
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
                               <header>All Queries</header>
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
                                           <th class="center"><strong>Sr.No</strong></th>
                                           <th class="center"><strong>Company Staff Name</strong></th>
                                           <th class="center"><strong>Agent/Client Email ID</strong></th>
                                           <th class="center"><strong>Contact No.</strong></th>
                                           <th class="center"><strong>File No.</strong></th>
                                           <th class="center"><strong>Travel Date</strong></th>
                                           <th class="center"><strong>Query Received Date</strong></th>	
                                           <th class="center"><strong>No. Of Pax</strong></th>
                                           <th class="center"><strong>No. Of Nights</strong></th>
                                           <th class="center"><strong>Company Name</strong></th>
                                           <th class="center"><strong>Client Type</strong></th>
                                           <th class="center"><strong>City/State</strong></th>
                                           <th class="center"><strong>Handling File</strong></th>			
                                           <th class="center"><strong>Remarks</strong></th>

                                       </tr>
                                   </thead>
                                   <tbody>
                                   <?php
                                   $i=1;
                                   if(!empty($enquiry)) { //echo '<pre>';print_r($enquiry);exit;
                                   foreach($enquiry as $enquiries) {
                                   ?>
                                           <tr class="odd gradeX">
                                                <td class="center"><?=$i++?></td>
                                                <td class="center"><?=$enquiries->contact_person?></td>
                                                <td class="center"><?=$enquiries->email?></td>
                                                <td class="center"><?=$enquiries->contact_person_number?></td>
                                                <td class="center"><?=$enquiries->enquiry_no?></td>
                                                <td class="center"><?=date('d-M-Y',strtotime($enquiries->check_in_date))?></td>
                                                <td class="center"><?=date('d-M-Y',strtotime($enquiries->query_received_date))?></td>
                                                <td class="center"><?=$enquiries->number_persons?></td>
                                                <td class="center"><?=$enquiries->number_of_nights	?></td>
                                                <td class="center"><?=$enquiries->name?></td>  
                                                <td class="center"><?=$enquiries->enquiry_type?></td>
                                                <td class="center"><?=$enquiries->city.' / '.$enquiries->state?></td>
                                                <td class="center"><?=$enquiries->admin_name?></td>
                                                <td class="center"><?=$enquiries->remarks ?></td>
                                           </tr>
                                   <?php } }	?>


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

     $( "#agent_name" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "<?=base_url()?>admin/report/get_agents",
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
       $('#agent_name').val(ui.item.label); // display the selected text
       $('#company_details_id').val(ui.item.company_id); // save selected id to input
	
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
    
    $('#from_date').bootstrapMaterialDatePicker({
        time: false,clearButton: true,format: 'DD-MM-YYYY',
    }).on("change",function(){
        $(this).parent("div").addClass("is-focused");
        var today = ("0"+new Date().getDate()).slice(-2)+'-'+("0"+(new Date().getMonth()+1)).slice(-2)+'-'+new Date().getFullYear();
        $('#to_date').val(today).parent("div").addClass("is-focused");
        $(this).parent("div").addClass("is-focused");
    });
    
    $('#to_date').bootstrapMaterialDatePicker({
        time: false,clearButton: true,format: 'DD-MM-YYYY',
    }).on("change",function(){
        if($('#from_date').val() === ''){
            alert('Select From Date');
            $(this).val('');
            return false;
        }
        $(this).parent("div").addClass("is-focused");
    });
    
    
});

</script>
<script>
   $(document).ready(function() {
        var table = $('#example4').DataTable({ });      
        $("#location").on("change",function(){
            var opts = $("#location option:selected").attr("data-abbr").split(",");
            $("#booking_type").empty();
            $.each(opts,function(i,d){
                $("#booking_type").append("<option value='"+d+"'>"+d+"</option>");
            });
        });
    });

</script> 	
</body>
<script>
    $('#export_to_excel').click(function () {
        $('<table>')
        .append($('<tr><tr><td></td><td></td><td></td><td><strong>Agentwise Report</strong></td></tr><tr><tr>'))
            .append( $("#example4 thead").html())
            .append(
                $("#example4").DataTable().$('tr').clone()
            )
         .table2excel({
            preserveColors:true,
            filename: "Agentwise-report.xls"
        });
        $("#example4").dataTable();
    });
</script>
</html>