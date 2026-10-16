<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <?php include ('admin_head_css.php'); ?>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
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
                                <div class="page-title">Add / Edit Guide Cost</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Add Cost</li>
                            </ol>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>All Guide Costs</header>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-checkable order-column full-width"
                                            id="example4">
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">Valid From</th>
                                                    <th class="center">Valid To</th>
                                                    <th class="center">12 Hours Day Shift Cost</th>
                                                    <th class="center">12 Hours Night Shift Cost</th>
                                                    <th class="center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                if (!empty($guide_cost)) {
                                                    foreach ($guide_cost as $list) {
                                                        ?>
                                                <tr class="odd gradeX">
                                                    <td class="center"><?= $i++ ?></td>
                                                    <td class="center">
                                                        <?= date('d-m-Y', strtotime($list->valid_from)); ?>
                                                    </td>
                                                    <td class="center">
                                                        <?= date('d-m-Y', strtotime($list->valid_to)); ?>
                                                    </td>
                                                    <td class="center"><?= $list->day_shift_cost ?></td>
                                                    <td class="center"><?= $list->night_shift_cost ?></td>
                                                    <td class="center"><a title="Edit" class="btn btn-tbl-edit btn-xs"
                                                            href="<?php echo current_url() . '?guide_id=' . $this->input->get('guide_id') . '&id=' . base64_encode($list->id); ?>"><i
                                                                class="fa fa-edit"></i>
                                                            <ia>
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

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head">
                                    <header>Add / Edit Guide Cost</header>
                                    <div class="tools">
                                        <a href="all-guide" class="btn btn-success" style="padding: 6px;"><i
                                                class="fa fa-file-text-o"></i>
                                            Guide List</a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>
                                <?php echo form_open_multipart(current_url() . '?' . $_SERVER['QUERY_STRING']); ?>
                                <div class="card-body row">

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'valid_from', 'type' => 'date', 'id' => 'valid_from', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => isset($guide_costs->valid_from) ? $guide_costs->valid_from : set_value('valid_from')]); ?>
                                            <label class="mdl-textfield__label">Valid From</label>
                                            <?php echo form_error('valid_from'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'valid_to', 'type' => 'date', 'id' => 'valid_to', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => isset($guide_costs->valid_to) ? $guide_costs->valid_to : set_value('valid_to')]); ?>
                                            <label class="mdl-textfield__label">Valid To</label>
                                            <?php echo form_error('valid_to'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'day_shift_cost', 'id' => 'day_shift_cost', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => isset($guide_costs->day_shift_cost) ? $guide_costs->day_shift_cost : set_value('day_shift_cost')]); ?>
                                            <label class="mdl-textfield__label">12 Hours Day Shift Cost</label>
                                            <?php echo form_error('basic_cost'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'night_shift_cost', 'id' => 'night_shift_cost', 'class' => 'mdl-textfield__input', 'value' => isset($guide_costs->night_shift_cost) ? $guide_costs->night_shift_cost : set_value('night_shift_cost')]); ?>
                                            <label class="mdl-textfield__label">12 Hours Night Shift Cost</label>
                                            <?php echo form_error('reason'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 p-t-20 text-center">
                                        <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value' => 'Submit']); ?>
                                    </div>


                                    <?php echo form_close(); ?>
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


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- jQuery UI -->
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

        <script>
        // Get references to the input fields
        var validFromInput = document.getElementById('valid_from');
        var validToInput = document.getElementById('valid_to');

        // Function to compare dates and display alert if necessary
        function compareDates() {
            // Parse the dates
            var validFromDate = new Date(validFromInput.value);
            var validToDate = new Date(validToInput.value);

            // Check if both inputs have been filled
            if (validFromDate && validToDate) {
                // Check if the "Valid To" date is less than the "Valid From" date
                if (validToDate < validFromDate) {
                    alert("Valid To date cannot be less than Valid From date. Adjusted accordingly.");
                    $('#valid_from,#valid_to').val('');

                }
            }
        }

        // Add event listener to both "Valid From" and "Valid To" inputs
        validFromInput.addEventListener('change', compareDates);
        validToInput.addEventListener('change', compareDates);
        </script>

</body>

</html>