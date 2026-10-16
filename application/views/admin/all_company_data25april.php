<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <?php include ('admin_head_css.php'); ?>

</head>
<!-- END HEAD -->

<body
    class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
    <div class="page-wrapper">
        <!-- start header -->
        <?php include ('header.php'); ?>
        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">
            <!-- start sidebar menu -->
            <?php include ('side_bar.php'); ?>
            <!-- end sidebar menu -->
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">All Company Details</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">All Company Details</li>
                            </ol>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>All Company Details</header>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-checkable order-column full-width"
                                            id="example4">
                                            <!-- Table header -->
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">Agent</th>
                                                    <th class="center">Contact Number</th>
                                                    <th class="center">Email</th>
                                                    <th class="center">City</th>
                                                    <th class="center">State</th>
                                                    <th class="center">Country</th>
                                                    <th class="center">Date</th>
                                                    <th class="center">Designation</th>
                                                    <th class="center">Source Of Acquire</th>
                                                    <th class="center">Action</th>
                                                </tr>
                                            </thead>
                                            <!-- Table body -->
                                            <tbody>
                                                <?php
                                                $records_cnt = 0;
                                                if (!empty($company_details)) {
                                                    $i = 1;
                                                    foreach ($company_details as $companies) {
                                                        $records_cnt++;
                                                        ?>
                                                <tr class="odd gradeX">
                                                    <td class="center"><?= $i++ ?></td>
                                                    <td class="center"><?= $companies->contact_person ?></td>
                                                    <td class="center">
                                                        <?= $companies->contact_person_isd_code . ' ' . $companies->contact_person_number ?>
                                                    </td>
                                                    <td class="center"><?= $companies->email ?></td>
                                                    <td class="center"><?= ucwords(strtolower($companies->city)); ?>
                                                    </td>
                                                    <td class="center"><?= ucwords(strtolower($companies->state)); ?>
                                                    </td>
                                                    <td class="center"><?= ucwords(strtolower($companies->country)); ?>
                                                    </td>
                                                    <td class="center">
                                                        <?php $d = strtotime($companies->creation_date);
                                                                echo date('d-M-Y', $d); ?>
                                                    </td>
                                                    <td class="center">
                                                        <?= ucwords(strtolower($companies->designation)); ?>
                                                    </td>
                                                    <td class="center">
                                                        <?= ucwords(strtolower(htmlentities($companies->acquiring_source))); ?>
                                                    </td>
                                                    <td class="center">
                                                        <?php if ($this->session->userdata('type') == 1) { ?>
                                                        <a href="<?php echo base_url() . $companies->company_id; ?>/edit-client"
                                                            class="btn btn-tbl-edit btn-xs" title="Edit"><i
                                                                class="fa fa-edit"></i></a>
                                                        <?php } else if ($companies->user_id == $this->session->userdata('id')) { ?>
                                                        <a href="<?php echo base_url() . $companies->company_id; ?>/edit-client"
                                                            class="btn btn-tbl-edit btn-xs" title="Edit"><i
                                                                class="fa fa-edit"></i></a>
                                                        <?php } ?>
                                                        <?php if ($this->session->userdata('type') == 1) { ?>
                                                        <a href="<?= base_url() . $companies->company_id ?>/delete-client"
                                                            onclick="return confirm('Are you sure you want to delete this ?');"
                                                            class="btn btn-tbl-delete btn-xs" title="Delete">
                                                            <i class="fa fa-trash-o "></i>
                                                        </a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php }
                                                } ?>
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
        <?php include ('admin_footer.php'); ?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
    <?php include ('admin_footer_js.php'); ?>
    <!-- end js include path -->
    <script>
    $(document).ready(function() {
        var table = $('#example4').DataTable({
            "scrollX": true,
            //"scrollY": "200px",
            "pageLength": 10

        });
    });
    </script>
</body>

</html>