<?php include ('admin_head_css.php'); ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-4 col-sm-8 col-8 align-self-center">
                            <h4 class="text-themecolor">Merge Address</h4>
                        </div>
                        <div class="col-lg-2 only-for-dashbord">
                        </div>
                        <div class="col-lg-6 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Merge Address</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <?php echo $this->session->flashdata('message');
                unset($_SESSION['message']);
                echo validation_errors(); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-box">
                            
                            <div class="card-body">
                                <form method="get" autocomplete="off" class="content">
                                    <div class="card-body row">

                                        <div class="col-lg-3">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Company</label>
                                                <?php echo form_input(['name' => 'company', 'id' => 'company', 'placeholder' => 'Company Name', 'class' => 'mdl-textfield__input bg-white']) ?>
                                            </div>
                                            <input type="hidden" name="company_id" id="company_id">
                                        </div>

                                        <div class="col-lg-3">
                                            <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-md btn-primary m-t-20', 'style' => 'float:left;', 'value' => 'Search']); ?>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-scrollable">
                                    <table
                                        class="table table-hover table-checkable order-column full-width client-table"
                                        id="example4">
                                        <!-- Table header -->
                                        <thead>
                                            <tr>
                                                <th class="center">Sr.No</th>
                                                <th class="center">Company Name</th>
                                                <th class="center">Total Address</th>
                                                <th class="center">Agent</th>
                                                <!-- <th class="center">Total Agents</th> -->
                                                <th class="center">Contact Number</th>
                                                <th class="center">Email</th>
                                                <th class="center">City</th>
                                                <th class="center">State</th>
                                                <th class="center">Country</th>
                                                <th class="center">Date</th>
                                                <th class="center remove">Company Logo</th>
                                                <th class="center">Designation</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <!-- Table body -->
                                        <tbody>
                                            <?php
                                            $records_cnt = 0;
                                            if (!empty($company)) {
                                                $i = $offset + 1;
                                                foreach ($company as $companies) {
                                                    $records_cnt++;
                                                    ?>
                                            <tr class="odd gradeX">
                                                <td class="center"><?= $i++ ?></td>
                                                <td class="center"><?= ucwords(strtolower($companies->name)); ?>
                                                </td>
                                                <td class="center">
                                                    <a class="btn btn-primary" href="<?php echo base_url() . $companies->company; ?>/company-all-details"
                                                        style="padding: 3px 10px;" title="View"><?= $companies->totalRows ?></a>
                                                </td>
                                                <td class="center"><?= $companies->contact_person ?></td>
                                                <td class="center"><?= $companies->contact_person_number ?></td>
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
                                                <td class="center remove"><img class="img-width"
                                                        src="<?= base_url('assets/company/') . $companies->company_logo; ?>"
                                                        alt=""></td>
                                                <td class="center">
                                                    <?= ucwords(strtolower($companies->designation)); ?>
                                                </td>
                                                    <td></td>
                                            </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- <div class="col-md-12 dataTables_paginate paging_simple_numbers" id=""> -->
                                <?php //echo 'Showing ' . $records_cnt . ' of ' . $total . ' Records'; ?>
                                <?php //echo $links; ?>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page content -->
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#company").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/company/company_name_suggesstion",
                    type: 'POST',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                        dt = data;
                        $(".err").html('');;
                    }
                });
            },
            select: function(event, ui) {
                // Set selection
                $('#company').val(ui.item.label); // display the selected text
                $('#company_id').val(ui.item.company_id); // save selected id to input
                get_agents();
            }
        });
    });
</script>