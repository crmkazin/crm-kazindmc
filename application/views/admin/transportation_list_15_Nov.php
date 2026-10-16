<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <?php include('admin_head_css.php');?>

</head>
<!-- END HEAD -->

<body
    class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
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
                                <div class="page-title">All Transportations</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">All Transportations</li>
                            </ol>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>All Transportations</header>
                                    <div class="tools">
                                        <a href="add-transport" class="btn btn-success" style="padding: 6px;"><i class="fa fa-plus"></i> Add New</a>
	                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:void(0);"></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-checkable order-column full-width"
                                            id="example4">
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">Country</th>
                                                    <th class="center">State</th>
                                                    <th class="center">City</th>
                                                    <th class="center">Vehicle Name</th>
                                                    <th class="center">Vehicle Type</th>
                                                    <th class="center">Capacity</th>
                                                    <th class="center">Year</th>
                                                    <th class="center">Make</th>
                                                    <th class="center">Luggage Vehicle</th>
                                                    <th class="center">Luggage Capacity</th>
                                                    <th class="center">Remarks</th>
                                                    <th class="center">Images</th>
                                                    <th class="center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $base_url = base_url();
                                            $i=1;
                                            $super_admins = ['rohit@kazindmc.com','pankaj@thavertech.com'];
                                            if(!empty($transportations)) {
                                            foreach($transportations as $transportation) {
                                                $images = explode(',',$transportation->images);
                                                
                                            ?>  
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?=$i++?></td>
                                                        <td class="center"><?=$transportation->country?></td>
                                                        <td class="center"><?=$transportation->state?></td>
                                                        <td class="center"><?=$transportation->city?></td>
                                                        <td class="center"><?=$transportation->vehicle_name?></td>
                                                        <td class="center"><?=$transportation->vehicle_type?></td>
                                                        <td class="center"><?=$transportation->capacity?></td>
                                                        <td class="center"><?=$transportation->year?></td>
                                                        <td class="center"><?=$transportation->make?></td>
                                                        <td class="center"><?=ucfirst($transportation->luggage_transport)?></td>
                                                        <td class="center"><?=$transportation->luggage?></td>
                                                        <td class="center"><?=$transportation->remarks?></td>
                                                        <td class="center">
                                                            <?php 
                                                            if(!empty($images) && $images[0]<>''){
                                                            foreach($images AS $list){ ?>
                                                                <img src="<?=$base_url ?>uploads/transportation/<?=trim($list)?>" width="50" height="50" style="margin-left:1px;border: 1px solid #d2d8dd;"/>
                                                            <?php } } ?>
                                                        </td>
                                                        <td class="center" style="text-align:center;display:flex;">
                                                        <a href="<?php echo base_url('transportation-cost?transport_id=' . base64_encode($transportation->id)); ?>" class="btn btn-tbl-money btn-xs" title="Cost List"><i class="fa fa-money" aria-hidden="true"></i></a>
                                                        <a href="<?php echo base_url('edit-transport?id='.base64_encode($transportation->id)); ?>" class="btn btn-tbl-edit btn-xs" title="Edit"><i class="fa fa-edit"></i></a> 
                                                        <a href="<?php echo base_url('delete-transport?id='.base64_encode($transportation->id)); ?>" onclick="return confirm('Are you sure you want to delete this Transport?');" class="btn btn-tbl-delete btn-xs" title="Delete"><i class="fa fa-trash-o "></i></a>
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

</body>
<script>
    
    $(document).ready(function() {
        var table = $('#example4').DataTable({
            "scrollX": true
            //"scrollY": "200px",
            //"paging": false
        });
    });
    
</script>
</html>