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
                                <div class="page-title">Sent Quotations</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="<?php echo base_url('quotation'); ?>">Quotations</a></li> &nbsp;<i class="fa fa-angle-right"></i>
                                &nbsp;
                                <li class="active">Sent Quotations</li>
                            </ol>
                        </div>
                    </div>			
<?php echo '<h3>' .$this->session->flashdata('message'). '</h3>'; unset($_SESSION['message']); ?>

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
                                        <label for="sno" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Followup</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="2" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Quotation Number</label>
                                    </div>
                                </div>						

                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield" >			 
                                        <input type="checkbox" data-column="3" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked" >
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Enquiry</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="4" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Status</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="5" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Remark</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="6" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Organization</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="7" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Branch</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="8" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Contact Person</label>
                                    </div>
                                </div>	
								
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="9" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Email</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="10" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Email CC</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="11" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Price</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="12" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Payment</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="13" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Gst</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="14" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Validity</label>
                                    </div>
                                </div>
								
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="15" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Delivery</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="16" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Warranty</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="17" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Quotation</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="18" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Date</label>
                                    </div>
                                </div>
								<div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="19" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Action</label>
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
                                    <header>All Sent Quotations</header>
                                    <div class="tools">
	                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
	                            <!--        <a id="export_to_excel">Export to excel</a> -->
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                    <table id="example4" class="table table-hover table-checkable order-column full-width table2excel">
                                        <thead>
                                            <tr>
                                                <th class="center">Sr.No</th>
                                                <th class="center noExl">Followup</th> 
                                                <th class="center">Quotation Number</th>
                                                <th class="center">Enquiry For</th>
                                                <th class="center">Status</th>
                                                <th class="center">Remark</th>
                                                <th class="center">Organization</th>
                                                <th class="center">Branch</th>
                                                <th class="center">Contact Person</th>
                                                <th class="center">Email</th>
                                                <th class="center">Email CC</th>
                                                <th class="center">Price</th>
                                                <th class="center">Payment</th>		
                                                <th class="center">Gst</th>
                                                <th class="center">Validity</th>
                                                <th class="center">Delivery</th>
                                                <th class="center">Warranty</th>
                                                <th class="center noExl">Quotation</th>
                                                <th class="center">Date</th>
                                                <th class="center noExl">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                    $i=1;
                                    if(!empty($quotations)) {
                                    foreach($quotations as $detail) {
                                    ?>
                                        <tr class="odd gradeX">
                                        <td class="center"><?=$i++?></td>
                                        <td class="center noExl">
                                            <a href="<?=base_url().$detail->qid.'/'?>quotation-followup" class="btn btn-default btn-xs">Followup</a>
                                            </td>											    
                                            <td class="center"><?=$detail->quotation_number?></td>
                                            <td class="">
                                            <?php     
                                            $enquiry = $this->quotation_model->sent_quotations_enquiry($detail->id);
                                            echo '<ol>';
                                            if(!empty($enquiry)){
                                                //$j = 1;
                                                foreach($enquiry as $data){
                                                    if($data->enquiry<>''):
                                                        echo '<li>'.$data->enquiry.'</li>';
                                                    //if($j != count($enquiry)){ echo " ,";}  
                                                //$j++;
                                                endif;
                                             }
                                             echo '</ol>';
                                            } ?>												
                                            </td>
                                            <td class="center"><?php if($detail->quotation_status == 1){ echo "Close"; }else{ echo "Open";}?>
                                            </td>
                                            <td class="center"><?=$detail->remark?></td>
                                            <td class="center">
                                            <?php if(is_numeric($detail->organization)){
                                            echo "Name Not Found";	
                                            }else{
                                            echo $detail->organization;	
                                            }?>												    
                                            </td>
                                            <td class="center"><?=$detail->city?></td>
                                            <td class="center"><?=$detail->contact_person?></td>
                                            <td class="center"><?=$detail->email_to?></td>
                                            <td class="center"><?=$detail->email_cc?></td>
                                            <td class="center"><?=$detail->price?></td>
                                            <td class="center"><?=$detail->payment?></td>
                                            <td class="center"><?=$detail->gst?></td>
                                            <td class="center"><?=$detail->validity?></td>
                                            <td class="center"><?=$detail->delivery?></td>
                                            <td class="center"><?=$detail->warranty?></td>
                                            <td class="center noExl">
                                                <a href="<?=base_url().'assets/sent_quotations/'.$detail->pdf?>" target="_blank" class="btn btn-xs bg-cyan" style="padding: 3px;">
                                                   Show
                                                </a>
                                                <a href="<?=base_url().'assets/sent_quotations/'.$detail->pdf?>" download="" class="btn btn-xs bg-teal" style="padding: 3px;">
                                                   Download
                                                </a>
                                            </td>
                                            <td class="center"><?=date('d-M-Y H:i:s',strtotime($detail->date))?></td>
                                            <td class="center noExl"><a href="<?=base_url().$detail->id?>/resend-quotation">Resend</a></td>
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

</body>
<script>
    /*$('#export_to_excel').click(function () {
        $("#example4").table2excel({
            filename: "sent-quotations.xls"
        });
    });*/
	
	$(document).ready(function() {
            var table = $('#example4').DataTable({
                            "scrollX": true
                            //"scrollY": "200px",
                            //"paging": false
                    });
            table.columns( [ 4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19 ] ).visible( false, false );
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
</html>