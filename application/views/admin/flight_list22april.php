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
                                <div class="page-title">All Airlines List</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">All Airlines List</li>
                            </ol>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>All Airlines List</header>
                                    <div class="tools">
                                        <a href="add-flight-schedule" class="btn btn-success" style="padding: 6px;"><i class="fa fa-plus"></i> Add Flight Schedule</a>
                                        <a href="add-flight" class="btn btn-success" style="padding: 6px;"><i class="fa fa-plus"></i> Add New</a>
	                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-checkable order-column full-width" id="example4">
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">Airline Name</th>
                                                    <th class="center">Code</th>
                                                    <th class="center">Status</th>
                                                    <th class="center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                            $i=1;
                                            $super_admins = ['rohit@kazindmc.com','pankaj@thavertech.com'];
                                            if(!empty($flights)) {
                                            foreach($flights as $flight) {

                                            ?>
                                                <form method="post">
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?=$i++?></td>
                                                        <td class="center"><?=$flight->name?></td>
                                                        <td class="center"><?=$flight->code?></td>
                                                        <td class="center"><?=ucfirst($flight->status)?></td>
                                                        <td class="center">
                                                            <a href="<?php echo base_url('edit-airlines?id='.base64_encode($flight->id)); ?>" class="btn btn-tbl-edit btn-xs" title="Edit"><i class="fa fa-edit"></i></a> 
                                                            <a href="<?php echo base_url('delete-airlines?id='.base64_encode($flight->id)); ?>" onclick="return confirm('Are you sure you want to delete this User?');" class="btn btn-tbl-delete btn-xs" title="Delete"><i class="fa fa-trash-o "></i></a>
                                                        </td>
                                                    </tr>
                                                </form>
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
                var table = $('#example4').DataTable({});      
           
            });
        </script> 
</body>
</html>