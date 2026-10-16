<?php include ('admin_head_css.php'); ?>
 <div class="page-wrapper">
        <!-- start page container -->
        <div class="container-fluid">
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-4 col-sm-6  col-6 align-self-center">
                            <h4 class="text-themecolor">All Company Details</h4>
                        </div>
                        <div class="col-lg-2 only-for-dashbord">
                        </div>
                        <div class="col-lg-6 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">All Company Details</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content">
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
                                            id="all_company_data">
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
                                                        <?php if ($this->session->userdata('type') == 1 || in_array($this->session->userdata('id'), [101,70])) { ?>
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
                                                            <i class="fas fa-trash"></i>
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
    </div>
<script>
$(document).ready(function() {
    var table = $('#all_company_data').DataTable({
        // "scrollX": true,
        //"scrollY": "200px",
        // "pageLength": 10
        responsive: true
    });
});
</script>