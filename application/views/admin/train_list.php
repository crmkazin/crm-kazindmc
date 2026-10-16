<?php include('admin_head_css.php');?>
<div class="page-wrapper">
        <!-- start page container -->
        <div class="container-fluid">
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                            <h4 class="text-themecolor">All Trains List</h4>
                        </div>
                        <div class="col-lg-2 only-for-dashbord">
                        </div>
                        <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">All Trains List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content">
                    <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                
                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-striped border table-hover table-checkable order-column full-width" id="flight_list">
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">Train Name</th>
                                                    <th class="center">Country</th>
                                                    <th class="center">Status</th>
                                                    <th class="center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                            $i=1;
                                            $super_admins = ['rohit@kazindmc.com','pankaj@thavertech.com'];
                                            if(!empty($trains)) {
                                            foreach($trains as $train) {

                                            ?>
                                                <form method="post">
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?=$i++?></td>
                                                        <td class="center"><?=$train->train_name?></td>
                                                        <td class="center"><?=$train->country?></td>
                                                        <td class="center"><?=ucfirst($train->status)?></td>
                                                        <td class="center">
                                                            <a href="<?php echo base_url('edit-train?id='.base64_encode($train->id)); ?>" class="btn btn-tbl-edit btn-xs" title="Edit"><i class="fa fa-edit"></i></a> 
                                                            <a href="<?php echo base_url('delete-train?id='.base64_encode($train->id)); ?>" onclick="return confirm('Are you sure you want to delete this Train?');" class="btn btn-tbl-delete btn-xs" title="Delete"><i class="fas fa-trash "></i></a>
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
    </div>

<script>
$(document).ready(function() {
    var table = $('#flight_list').DataTable({
        responsive: true
    });      

});
</script> 