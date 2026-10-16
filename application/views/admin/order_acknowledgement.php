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
<?php   include('side_bar.php');?>
			 <!-- end sidebar menu -->
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="icon-and-text-button-demo">
                        <a href="order-acknowledgement" class="btn btn-primary waves-effect">
                            <i class="material-icons">format_list_bulleted</i><br>
                            <span>OA List</span>
                        </a>
                        <a href="awarded-project" class="btn btn-success waves-effect">
                            <i class="material-icons">dvr</i><br>
                            <span>OA Creation - Quotations</span>
                        </a>
                        <a href="awarded-project-bids" class="btn btn-info waves-effect" style="margin-left:5px;">
                            <i class="material-icons">local_offer</i><br>
                            <span>OA Creation - Bids</span>
                        </a>
                        
                        <a href="old-order-creation" class="btn btn-info waves-effect" style="margin-left:5px;">
                            <i class="material-icons">create</i><br>
                            <span>Old OA Creation</span>
                        </a>
                    </div>
                </div>
                    </div>
                    
                    
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Order Acknowledgement</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Order Acknowledgement</li>
                            </ol>
                        </div>
                    </div>			
<!-- <?php 
    if($this->session->flashdata('message')<>''){
        echo '<div class="alert alert-success">' .$this->session->flashdata('message'). '</div>'; unset($_SESSION['message']);
    }
    ?> -->

					<div class="row">
                    <div class="col-md-12">
                        <div class="card card-box">
                            <div class="card-head">
                                <header>Add/Remove Column Fields</header>
                                <input type="checkbox" name="" class="view_all"/>
                                <label style="color:#000 !important;font-weight: 500;font-size: 15px !important;">View All</label>
                            </div>
                            <div class="card-body">
                                <div class="row"> 
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="1" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked">
                                        <label for="sno" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">OA No</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="2" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Invoice No</label>
                                    </div>
                                </div>						

                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield" >			 
                                        <input type="checkbox" data-column="3" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked" >
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Organization</label>
                                    </div>
                                </div>
                                 
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="4" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">City</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="5" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Work/Equipment</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="6" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Order No</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="7" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Creation Date</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="8" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Performance Security</label>
                                    </div>
                                </div>	
								
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="9" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Delivery Due Date</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="10" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Status</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="11" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Amount Without GST</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="12" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Amount With GST</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="13" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Invoice made or not</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="14" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Action</label>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield" >             
                                        <input type="checkbox" data-column="15" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked" >
                                        <label for="createinvoice" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Invoices</label>
                                    </div>
                                </div>
                                
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield" >             
                                        <input type="checkbox" data-column="16" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked" >
                                        <label for="createinvoice" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Create Invoice</label>
                                    </div>
                                </div>
                        								
							</div>                            
                        </div>
                            
                        </div>
                    </div>
                </div>
					

                     <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>All Acknowledgements</header>
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
												<th class="center">OA No</th>
												<th class="center">Invoice No</th>
												<th class="center">Organization</th>
												<th class="center">City</th>
												<th class="center">Work/Equipment</th>
												<th class="center">Order No</th>
												<th class="center">Creation Date</th>
												<th class="center">Performance Security</th>
												<th class="center">Delivery Due Date</th>
												<th class="center">Status</th>
												<th class="center">Amount Without GST</th>
												<th class="center">Amount With GST</th>					
												<th class="center">Invoice made or not</th>
												<th class="center">Action</th>
												<th class="center">Invoices</th>
                                               <th class="center">Create Invoice</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$srno=1;
										if(!empty($details)) {
										foreach($details as $detail) {
										?>
											<tr class="odd gradeX">
											    <td class="center"><?=$srno++?></td>
											    <td class="center"><?= $detail->order_no?></td>
											    <td class="center"><?=$detail->invoice_no?></td>

											    <td class="center">
											    <?php 
                                                                                            
                                                    if(!empty($detail->organization)){ echo $detail->client;  }else { echo $detail->company;}?>
											    </td>

											    <td class="center"><?=$detail->city?></td>
												<td class="center">
												<?php 
												if(!empty($detail->enquiry_for)){ echo $detail->enquiry_for; }else{
												$enquiry = $this->quotation_model->sent_quotations_enquiry($detail->quotation_sent_id);
												if(!empty($enquiry)){
											    $j = 1;
												 foreach($enquiry as $data){
												 echo $data->enquiry;if($j != count($enquiry)){ echo " ,";}  
												 $j++;
												 }
											
												} }												
												?>
												</td>
											    <td class="center"><?=$detail->client_order_no?></td>
												<td class="center"><?=$detail->date?></td>
												<td class="center"><?=$detail->performance_security?></td>
												<td class="center"><?=$detail->delivery_due_date?></td>											    
												<td class="center"><?=$detail->status?></td>											    
												<td class="center"><?=$detail->amount_without_gst?></td>											    
												<td class="center"><?=$detail->amount_with_gst?></td>	
												<td class="center"><?=$detail->invoice?></td>
												<td class="center">
												 <?php if($this->session->userdata('type') == 1){?>   
												<a href="<?=base_url().$detail->id?>/edit-oa" class="btn btn-tbl-edit btn-xs"> 
												<i class="fa fa-pencil"></i> </a>														    
												<a href="<?=base_url().$detail->id?>/delete-oa"  onclick="return confirm('Are you sure you want to delete this ?');" class="btn btn-tbl-delete btn-xs"> 
												<i class="fa fa-trash-o "></i> </a>	
												<?php }?>
												</td>
                                                <td class="center">
                                                    <?php $invoices = explode(',', $detail->invoices);
                                                   
                                                    $previous_invoices = explode(',', $detail->previous_invoices);
                                                    $i=0;
                                                        if(!empty($invoices[0])){
                                                            foreach($invoices AS $list){
                                                                if(trim($list)<>''){
                                                                    echo '<a target="_blank" href="assets/invoices/'.trim($list).'" title="'.trim($list).'"><i class="fa fa-file-pdf-o"></i></a> ';
                                                                }
                                                                if($previous_invoices[$i]!=0){
                                                                    $invoice_number = explode('.',$list);
                                                                    echo '[ ';
                                                                    for($j=1;$j<=$previous_invoices[$i];$j++){
                                                                        $f_name = trim($invoice_number[0]).'_'.$j.'_previous.pdf';
                                                                        echo '<a target="_blank" href="assets/invoices/'.$f_name.'" title="'.$f_name.'"><i class="fa fa-file-pdf-o" style="color:red;"></i></a> ';
                                                                    }
                                                                    echo '] ';
                                                                }
                                                                $i++;
                                                            }
                                                        }
                                                        ?>
                                                </td>
                                                
                                        <?php 
                                                    $txt = 'Create';
                                                    /*if($detail->invoice=='Yes'){
                                                        $txt = 'Invoice';
                                                    }*/ ?>        
												<td class="center">
                                                    <a class="btn btn-xs btn-default" href="<?=base_url().$detail->id?>/generate-invoice"><?php echo $txt; ?></a>
                                                </td>
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

	$(document).ready(function() {
            var table = $('#example4').DataTable({
                                    "scrollX": true
                                    //"scrollY": "200px",
                                    //"paging": false
                            });
            table.columns( [ 4,5,6,7,8,9,10,11,12,13,14 ] ).visible( false, false );
            table.columns.adjust().draw( false );
            $('.mdl-textfield__input').on( 'click', function (e) {
                // Get the column API object
                var column = table.column( $(this).attr('data-column') );
                // Toggle the visibility
                column.visible( ! column.visible() );
                table.columns.adjust().draw( false );
                $('.view_all').prop("checked",false);
                $(".dataTables_info").parent().parent('div').show();
            });
            
            $(".view_all").on('click',function(){
                if($(this).prop("checked") === true){
                    $('.mdl-textfield__input').prop('checked',true);
                    table.columns( '.center' ).visible( true );
                    $(".dataTables_info").parent().parent('div').show();
                }else{
                    $('.mdl-textfield__input').prop("checked",false);
                    table.columns( '.center' ).visible( false );
                    $(".dataTables_info").parent().parent('div').hide();
                }
            });
            
        });


</script>	
</body>
</html>