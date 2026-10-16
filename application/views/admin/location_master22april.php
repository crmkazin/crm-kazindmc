<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <?php include('admin_head_css.php'); ?>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet">
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
            <?php include('side_bar.php'); ?>
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
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="<?= base_url(); ?>masters">Masters</a></li> &nbsp;<i class="fa fa-angle-right"></i>&nbsp;
                                <li class="active"><a class="parent-item" href="<?= base_url(); ?>location-master">Location Master</a></li>
                            </ol>
                        </div>

                    </div>
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>List Location Master</header>
                                    <div class="tools">
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-checkable order-column full-width" id="example4">
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">Country</th>
                                                    <th class="center">Location</th>
                                                    <th class="center">Destination Type</th>
                                                    <th class="center">Status</th>
                                                    <th class="center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                //echo '<pre>';print_r($company); print_r($this->session->userdata); die;
                                                $i = 1;
                                                if (!empty($result)) {
                                                    foreach ($result as $list) {
                                                ?>
                                                        <tr class="odd gradeX">
                                                            <td class="center"><?= $i++ ?></td>
                                                            <td class="center"><?php echo ucwords($list->country); ?></td>
                                                            <td class="center"><?php echo ucwords($list->location); ?></td>
                                                            <td class="center"><?= ucwords($list->destination_type); ?></td>
                                                            <td class="center"><a class="btn <?= $list->status == 'active' ? 'btn-success' : 'btn-danger' ?> btn-xs"><?= ucwords($list->status); ?></a>
                                                            </td>
                                                            <td class="center">
                                                                <a href="<?php echo base_url('location-master?id=' . base64_encode($list->id)); ?>" class="btn btn-tbl-edit btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                                                                <!-- <?php if ($this->session->userdata('type') == 1) { ?>
                                                                    <a href="<?= base_url('delete-location-master?id=' . base64_encode($list->id)) ?>" onclick="return confirm('Are you sure you want to delete this ?');" class="btn btn-tbl-delete btn-xs" title="Delete">
                                                                        <i class="fa fa-trash-o "></i> </a>
                                                                <?php } ?> -->
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
                                    <header>Add / Edit Location Master</header>
                                    <div class="tools">

                                    </div>
                                </div>
                                <?php echo form_open_multipart(current_url() . '?' . $_SERVER['QUERY_STRING'], ['id' => 'frm-blackout-dates']); ?>
                                <div class="card-body row">
                                    <div class="col-lg-3 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <select name="country" id="country" class="mdl-textfield__input"
                                                style="padding: 10px;">
                                                <option value="">Select..</option>
                                                <?php
                                                asort($locations);
                                                foreach ($locations as $key => $val) {
                                                    if ($key != 'all') {  ?>
                                                        <option value="<?= $key ?>" <?php echo (isset($result_data->country) && $result_data->country == $key) ? 'selected="selected"' : ''; ?>>
                                                            <?= ucfirst($key) ?>
                                                        </option>
                                                <?php }
                                                } ?>
                                            </select>
                                            <label class="mdl-textfield__label">Country</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'location', 'id' => 'location', 'required' => 'required', 'class' => 'mdl-textfield__input', 'value' => isset($result_data->location) ? $result_data->location : set_value('location')]) ?>
                                            <label class="mdl-textfield__label"></label>
                                            <?php echo form_error('event_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                                            <select name="destination_type" class="mdl-textfield__input" style="padding-top:13px;">
                                                <option value="intercity" <?php echo (isset($result_data->destination_type) && $result_data->destination_type == 'intercity') ? 'selected="selected"' : ''; ?>>
                                                    Intercity</option>
                                                <option value="outsidecity" <?php echo (isset($result_data->destination_type) && $result_data->destination_type == 'outsidecity') ? 'selected="selected"' : ''; ?>>
                                                    Outside City</option>
                                            </select>
                                            <label class="mdl-textfield__label">Destination Type</label>
                                            <?php echo form_error('destination_type'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                                            <select name="status" class="mdl-textfield__input" style="padding-top:13px;">
                                                <option value="active" <?php echo (isset($result_data->status) && $result_data->status == 'active') ? 'selected="selected"' : ''; ?>>
                                                    Active</option>
                                                <option value="inactive" <?php echo (isset($result_data->status) && $result_data->status == 'inactive') ? 'selected="selected"' : ''; ?>>
                                                    In-active</option>
                                            </select>
                                            <label class="mdl-textfield__label">Status</label>
                                            <?php echo form_error('status'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-1 p-t-20 text-center">
                                        <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value' => 'Submit']); ?>
                                    </div>

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
        <?php include('admin_footer.php'); ?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
    <?php include('admin_footer_js.php'); ?>
    <!-- end js include path -->
    <!-- Script -->
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