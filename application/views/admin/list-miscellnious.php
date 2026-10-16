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
<?php include('header.php'); ?>
        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">
 			<!-- start sidebar menu -->
<?php include('side_bar.php');?>
			 <!-- end sidebar menu -->
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="icon-and-text-button-demo">
                        <a href="<?=base_url();?>expenses/travel" class="btn btn-success waves-effect">
                            <i class="material-icons">local_airport</i><br>
                            <span>Travel</span>
                        </a>
                        <a href="<?=base_url();?>expenses/miscellinous-expenses" class="btn btn-info waves-effect">
                            <i class="material-icons">restaurant</i><br>
                            <span>Miscellaneous</span>
                        </a>
                        <a href="<?=base_url();?>expenses/intercity-expenses" class="btn btn-primary waves-effect">
                            <i class="material-icons">directions_car</i><br>
                            <span>Intercity</span>
                        </a>
                    </div>
                </div>
                    </div>
                    
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Miscellaneous List</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Miscellaneous List</li>
                            </ol>
                        </div>
                    </div>			
<?php 
    if($this->session->flashdata('message')<>''){
        echo '<div class="alert alert-success">' .$this->session->flashdata('message'). '</div>'; unset($_SESSION['message']);
    }
?>			
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
                                        <label for="sno" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Name</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="2" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Bill Date</label>
                                    </div>
                                </div>						

                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield" >			 
                                        <input type="checkbox" data-column="3" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;" checked="checked" >
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Bill Amount</label>
                                    </div>
                                </div>
                                 
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="4" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Created</label>
                                    </div>
                                </div>
						
                                <div class="col-lg-3" style="float:left;margin-bottom:10px;"> 
                                    <div class="mdl-js-textfield mdl-textfield--floating-label txt-full-width is-dirty is-upgraded" data-upgraded=",MaterialTextfield">			 
                                        <input type="checkbox" data-column="5" id="" name="" class="mdl-textfield__input" style="display: inline-block;padding-right: 100px;width: 30px;">
                                        <label for="city" class="mdl-textfield__label" style="display: inline-block;padding-left: 45px;margin-top: -6px;color:#000 !important;font-weight: 500;font-size: 15px !important;">Details</label>
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
                                    <header>All Miscellaneous Expenses</header>
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
                                                <th class="center">Name</th>
                                                <th class="center">Bill Date</th>
                                                <th class="center">Bill Amount</th>
                                                <th class="center">Created</th>
                                                <th class="center">Print</th>		
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i=1;
                                        if(!empty($miscellinous)) {
                                        foreach($miscellinous as $data) {
                                            // if($invoice->invoice_name==''){
                                            //     $invoice_url = base_url('assets/invoices/OA_').$invoice->order_id.'.pdf';
                                            // }else{
                                            //     $invoice_url = base_url('assets/invoices/').$invoice->invoice_name;;
                                            // }
                                        ?>
                                                <tr class="odd gradeX">
                                                    <!-- <td class="center"><?=$i++?></td> -->
                                                    <td class="center"><?=$data->id?></td>
                                                    <td class="center"><?=$data->name?></td>
                                                    <td class="center"><?php  $d = explode('-',$data->date); echo $d[2].'-'.$d[1].'-'.$d[0]; ?></td>
                                                    <td class="center"><?=$data->bill_amount?></td>
                                                    <td class="center"><?=$data->created?></td>
                                                    <td class="center"> <a href="<?php echo base_url('expenses/Miscellaneous-details-expenses/').base64_encode($data->id) ;?>"><button class="btn btn-xs btn-info">DETAILS</button> </a>  </td>
                                                    
                                                    <!-- <td class="center">
                                                        <a target="_blank" href="<?=$invoice_url; ?>" class="btn btn-xs">Invoice</a>
                                                    <a href="<?=base_url().$invoice->id?>/edit-invoice" class="btn btn-tbl-edit btn-xs"> 
                                                    <i class="fa fa-pencil"></i> </a>												    
                                                    <a href="<?=base_url().$invoice->id?>/delete-invoice"  onclick="return confirm('Are you sure you want to delete this ?');" class="btn btn-tbl-delete btn-xs"> 
                                                    <i class="fa fa-trash-o "></i> </a>	 
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
<script>
    $(document).ready(function() {
        var table = $('#example4').DataTable({
                                "scrollX": true
                                //"scrollY": "200px",
                                //"paging": false
                        });
        table.columns( [ 4,5 ] ).visible( false, false );
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