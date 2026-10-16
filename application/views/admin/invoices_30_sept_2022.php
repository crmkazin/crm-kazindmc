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
                                <div class="page-title">Invoice List</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Invoice List</li>
                            </ol>
                        </div>
                    </div>			
<?php 
    if($this->session->flashdata('message')<>''){
        echo '<div class="alert alert-success">' .$this->session->flashdata('message'). '</div>';
    }
?>						
 
                     <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>All Invoices</header>
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
                                                <th class="center">Invoice No</th>
                                                <th class="center">Date</th>
                                                <th class="center">OA No</th>
                                                <th class="center">Organization</th>
                                                <th class="center">City</th>
                                                <th class="center">Work/Equipment</th>
                                                <th class="center">Purchase Order Detail</th>
                                                <th class="center">Taxable Amount</th>
                                                <th class="center">IGST</th>
                                                <th class="center">Total Invoice Value</th>
                                                <th class="center">Received Amount</th>			
                                                <th class="center">Received Amount Date</th>
                                                <th class="center">TDS Deduction</th>
                                                <th class="center">Company GST</th>
                                                <th class="center">Customer GST</th>
                                                <th class="center">Added By</th>
                                                <th class="center">Remarks</th>
                                                <th class="center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i=1;
                                        if(!empty($invoices)) {
                                        foreach($invoices as $invoice) {
                                            if($invoice->invoice_name==''){
                                                $invoice_url = base_url('assets/invoices/OA_').$invoice->order_id.'.pdf';
                                            }else{
                                                $invoice_url = base_url('assets/invoices/').$invoice->invoice_name;;
                                            }
                                        ?>
                                                <tr class="odd gradeX">
                                                    <td class="center"><?=$i++?></td>
                                                    <td class="center"><?=$invoice->invoice_no?></td>
                                                    <td class="center"><?=$invoice->date?></td>
                                                    <td class="center"><?=$invoice->oa_no?></td>
                                                    <td class="center"><?=$invoice->name?></td>
                                                    <td class="center"><?=$invoice->city?></td>
                                                    <td class="center"><?=$invoice->equipment?></td>
                                                    <td class="center"><?=$invoice->purchase_order_detail?></td>
                                                    <td class="center"><?=$invoice->subtotal?></td>
                                                    <td class="center"><?=$invoice->igst?></td>
                                                    <td class="center"><?=$invoice->amount?></td>
                                                    <td class="center"><?=$invoice->received_amount?></td>
                                                    <td class="center"><?=$invoice->received_amount_date?></td>
                                                    <td class="center"><?=$invoice->tds_deduction?></td>
                                                    <td class="center"><?=$invoice->company_gst?></td>
                                                    <td class="center"><?=$invoice->customer_gst?></td>
                                                    <td class="center"><?=$invoice->admin?></td>
                                                    <td class="center"><?=$invoice->remarks?></td>
                                                    <td class="center">
                                                        <a target="_blank" href="<?=$invoice_url; ?>" class="btn btn-xs">Invoice</a>
                                                    <a href="<?=base_url().$invoice->id?>/edit-invoice" class="btn btn-tbl-edit btn-xs"> 
                                                    <i class="fa fa-pencil"></i> </a>												    
                                                    <a href="<?=base_url().$invoice->id?>/delete-invoice"  onclick="return confirm('Are you sure you want to delete this ?');" class="btn btn-tbl-delete btn-xs"> 
                                                    <i class="fa fa-trash-o "></i> </a>	
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