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
                                <div class="page-title">Add / Edit Site Cost</div>
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
                                    <header>All Site Costs</header>
                                    <header>(<?= $site_name[0]->site_name?>)</header>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-checkable order-column full-width"
                                            id="example4">
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <!-- <th class="center">Date</th> -->
                                                    <th class="center">Title</th>
                                                    <th class="center">Cost Type</th>
                                                    <th class="center">Cost</th>
                                                    <!-- <th class="center">Per Child Cost</th> -->
                                                    <!-- <th class="center">Status</th> -->
                                                    <th class="center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                        $i = 1;
                        if (!empty($site_cost)) {
                          foreach ($site_cost as $list) {
                            ?>
                                                <tr class="odd gradeX">
                                                    <td class="center"><?= $i++ ?></td>
                                                    <!-- <td class="center">
                                                        <?= date('Y-m-d', strtotime($list->created_at)) ?></td> -->
                                                    <td class="center"><?= $list->title ?></td>
                                                    <td class="center">
                                                        <?= ucfirst(str_replace('-', ' ', $list->cost_type)) ?>
                                                    </td>
                                                    <td class="center">
                                                        <?= $list->cost ?></td>
                                                    <!-- <td class="center"><?= ucfirst($list->status) ?></td> -->
                                                    <td class="center"><a title="Edit" class="btn btn-tbl-edit btn-xs"
                                                            href="<?php echo current_url() . '?site_id=' . $this->input->get('site_id') . '&id=' . base64_encode($list->id);?>"><i
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
                                    <header>Add / Edit Site Cost</header>
                                    <div class="tools">
                                        <a href="all-masters" class="btn btn-success" style="padding: 6px;"><i
                                                class="fa fa-file-text-o"></i>
                                            Site List</a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>
                                <?php echo form_open_multipart(current_url() . '?' . $_SERVER['QUERY_STRING']); ?>
                                <div class="card-body row">
                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'title', 'id' => 'title', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => isset($site_costs->title) ? $site_costs->title : set_value('title')]); ?>
                                            <label class="mdl-textfield__label">Title</label>
                                            <?php echo form_error('basic_cost'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                                            <select name="cost_type" class="mdl-textfield__input" required
                                                style="padding-top:13px;">
                                                <option value="">Select..</option>
                                                <option value="fixed"
                                                    <?php echo (isset($site_costs->cost_type) && $site_costs->cost_type == 'fixed') ? 'selected="Fixed"' : ''; ?>>
                                                    Fixed</option>
                                                <option value="per-person"
                                                    <?php echo (isset($site_costs->cost_type) && $site_costs->cost_type == 'per-person') ? 'selected="Per Person"' : ''; ?>>
                                                    Per Person</option>
                                                <option value="per-adult"
                                                    <?php echo (isset($site_costs->cost_type) && $site_costs->cost_type == 'per-adult') ? 'selected="Adult"' : ''; ?>>
                                                    Adult</option>
                                                <option value="per-child"
                                                    <?php echo (isset($site_costs->cost_type) && $site_costs->cost_type == 'per-child') ? 'selected="Children"' : ''; ?>>
                                                    Children</option>
                                            </select>
                                            <label class="mdl-textfield__label">Cost Type</label>
                                            <?php echo form_error('status'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'cost', 'id' => 'cost', 'class' => 'mdl-textfield__input', 'value' => isset($site_costs->cost) ? $site_costs->cost : set_value('cost')]); ?>
                                            <label class="mdl-textfield__label">Cost</label>
                                            <?php echo form_error('reason'); ?>
                                        </div>
                                    </div>

                                    <!-- <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                                            <select name="status" class="mdl-textfield__input" required
                                                style="padding-top:13px;">
                                                <option value="">Select..</option>
                                                <option value="active"
                                                    <?php echo (isset($site_costs->status) && $site_costs->status == 'active') ? 'selected="active"' : ''; ?>>
                                                    Active</option>
                                                <option value="in-active"
                                                    <?php echo (isset($site_costs->status) && $site_costs->status !== 'active') ? 'selected="in-active"' : ''; ?>>
                                                    In-Active</option>
                                            </select>
                                            <label class="mdl-textfield__label">Status</label>
                                            <?php echo form_error('status'); ?>
                                        </div>
                                    </div> -->

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
        $(document).ready(function() {
            $("#type").on("change", function() {
                $("#rights").css("display", "none");
                if ($(this).val() === "2") {
                    $("#rights").css("display", "block");
                }
            });
        });

        $(document).ready(function() {

            $("#country").autocomplete({
                source: function(request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/get_country_ajax",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term
                        },
                        success: function(data) {

                            response(data);
                        }
                    });
                },
                select: function(event, ui) {
                    // Set selection
                    $('#country').val(ui.item.label); // display the selected text
                    $('#country_id').val(ui.item.country_id); // save selected id to input

                    return false;
                }
            });

            $("#state").autocomplete({
                source: function(request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/get_state_ajax",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term,
                            country_id: $('#country_id').val()
                        },
                        success: function(data) {

                            response(data);
                        }
                    });
                },
                select: function(event, ui) {
                    // Set selection
                    $('#state').val(ui.item.label); // display the selected text
                    $('#state_id').val(ui.item.state_id); // save selected id to input

                    return false;
                }
            });

            $("#city").autocomplete({
                source: function(request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/get_city_ajax",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term,
                            state_id: $('#state_id').val()
                        },
                        success: function(data) {

                            response(data);
                        }
                    });
                },
                select: function(event, ui) {
                    // Set selection
                    $('#city').val(ui.item.label); // display the selected text
                    //   $('#company_id').val(ui.item.company_id); // save selected id to input

                    return false;
                }
            });


        });
        </script>
</body>

</html>