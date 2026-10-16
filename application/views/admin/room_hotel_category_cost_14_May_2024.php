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
                                <div class="page-title">Add / Edit Hotel Room Category Cost</div>
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
                                    <header>All Room Category Costs</header>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-checkable order-column full-width"
                                            id="example4">
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">Date</th>
                                                    <th class="center">Basic Cost</th>
                                                    <th class="center">Reason for Extra Cost</th>
                                                    <th class="center">Extra Cost</th>
                                                    <th class="center">Status</th>
                                                    <th class="center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                        $i = 1;
                        if (!empty($category_cost)) {
                          foreach ($category_cost as $list) {
                            ?>
                                                <tr class="odd gradeX">
                                                    <td class="center"><?= $i++ ?></td>
                                                    <td class="center">
                                                        <?= date('Y-m-d',strtotime($list->created_at)); ?>
                                                    </td>
                                                    <td class="center"><?= $list->basic_cost ?></td>
                                                    <td class="center"><?= $list->reason ?></td>
                                                    <td class="center"><?= $list->extra_cost ?></td>
                                                    <td class="center"><?= $list->status ?></td>
                                                    <td class="center"><a title="Edit" class="btn btn-tbl-edit btn-xs"
                                                            href="<?php echo current_url() . '?hotel_id=' . $this->input->get('hotel_id') . '&category_id=' . base64_encode($list->category_id) . '&id=' . base64_encode($list->id); ?>"><i
                                                                class="fa fa-edit"></i></a></td>
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
                                    <header>Add / Edit Room Category Cost</header>
                                    <div class="tools">
                                        <a href="all-hotel" class="btn btn-success" style="padding: 6px;"><i
                                                class="fa fa-file-text-o"></i>
                                            Hotels List</a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>
                                <?php echo form_open_multipart(current_url() . '?' . $_SERVER['QUERY_STRING']); ?>
                                <div class="card-body row">
                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'basic_cost', 'id' => 'basic_cost', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => isset($category->basic_cost) ? $category->basic_cost : set_value('basic_cost')]); ?>
                                            <label class="mdl-textfield__label">Basic Cost</label>
                                            <?php echo form_error('basic_cost'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'reason', 'id' => 'reason', 'class' => 'mdl-textfield__input', 'value' => isset($category->reason) ? $category->reason : set_value('reason')]); ?>
                                            <label class="mdl-textfield__label">Reason for Extra Cost</label>
                                            <?php echo form_error('reason'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'extra_cost', 'id' => 'extra_cost', 'required' => 'required', 'class' => 'mdl-textfield__input', 'value' => isset($category->extra_cost) ? $category->extra_cost : set_value('extra_cost')]) ?>
                                            <label class="mdl-textfield__label">Extra Cost</label>
                                            <?php echo form_error('extra_cost'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                                            <select name="status" class="mdl-textfield__input" style="padding-top:13px;"
                                                required>
                                                <option value="">Select..</option>
                                                <option value="active"
                                                    <?php echo (isset($category->status) && $category->status == 'active') ? 'selected="active"' : ''; ?>>
                                                    Active</option>
                                                <option value="in-active"
                                                    <?php echo (isset($category->status) && $category->status !== 'active') ? 'selected="in-active"' : ''; ?>>
                                                    In-Active</option>
                                            </select>
                                            <label class="mdl-textfield__label">Status</label>
                                            <?php echo form_error('status'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 p-t-20 text-center">
                                        <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value' => 'Submit']); ?>
                                    </div>


                                    <div <?php echo form_close(); ?> </div>
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