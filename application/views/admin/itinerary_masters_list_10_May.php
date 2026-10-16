<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
<?php include('admin_head_css.php'); ?> 
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
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Masters</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Masters</li>
                            </ol>
                        </div>
                        
                    </div>			
            <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
            
                     <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>List Masters</header>
                                    <div class="tools">
                                        
                                        <a href="<?=base_url();?>itinerary-masters-create" class="btn btn-success" style="padding:6px;" title="Create Masters"><i class="fa fa-plus"></i> Add </a>
                                        <!--a id="export_to_excel" style="padding:6px;" class="btn btn-info" title="Export"><i class="fa fa-download"></i> Export </a-->
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
                                                <th class="center">Category</th>
                                                <th class="center">Departing Time</th>	
                                                <th class="center">Duration</th>
                                                <th class="center">Entry Ticket</th>
                                                <th class="center">City</th>
                                                <th class="center">Country</th>
                                                <th class="center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //echo '<pre>';print_r($company); print_r($this->session->userdata); die;
                                            $i=1;
                                            if(!empty($result)) {
                                            foreach($result as $companies) {
                                            ?>
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?=$i++?></td>
                                                            <td class="center">
                                                            <?php echo $companies->site_name; ?>
                                                            </td>                                                            
                                                            <td class="center"><?=ucfirst(($companies->category=='sitescene')?'Sightseeing':$companies->category)?></td>
                                                            <td class="center"><?=$companies->departing_time_from_hotel?></td>
                                                            <td class="center"><?=$companies->duration?></td>
                                                            <td class="center">
                                                             <?php echo ucfirst($companies->entry_ticket)  ?>
                                                            </td>
                                                            <td class="center"><?=ucwords(strtolower($companies->city)); ?></td>
                                                            <td class="center"><?=ucwords(strtolower($companies->country)); ?></td>
                                                            
                                                            <td class="center">
                                                                <a href="<?php echo base_url('edit_masters?id='.base64_encode($companies->id)); ?>" class="btn btn-tbl-edit btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                                                                
                                                            <?php if($this->session->userdata('type') == 1){?>  
                                                                <a href="<?=base_url('delete-masters?id='.base64_encode($companies->id))?>"  onclick="return confirm('Are you sure you want to delete this ?');" class="btn btn-tbl-delete btn-xs" title="Delete"> 
                                                            <i class="fa fa-trash-o "></i> </a>													
                                                            <?php }?>
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
  <!-- Script -->
</body>
<script>
    $('#export_to_excel').click(function () {
        $("#example4").table2excel({
            filename: "data.xls"
        });
    });
    
    $(document).ready(function() {
        var table = $('#example4').DataTable({
            "scrollX": true
            //"scrollY": "200px",
            //"paging": false
        });
        
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