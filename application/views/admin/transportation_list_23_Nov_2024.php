<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <?php include('admin_head_css.php'); ?>
    <style>
        .custom-label {
            font-weight: bolder !important;
            margin: 20px 0px 0px 5px !important;
            font-size: large;
        }

        .custom-label-2 {
            font-weight: bold !important;
            margin: 5px !important;
            font-size: smaller;
        }

        .ui-front {
            z-index: 9999999 !important;
        }

        .dataTables_scrollHeadInner {
            width: 100% !important;
        }

        .disabled {
            pointer-events: none;
            opacity: 0.5;
        }

        .active {
            pointer-events: auto;
            opacity: 1;
        }
    </style>

</head>
<!-- END HEAD -->

<body
    class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
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
                                <div class="page-title">All Transportations</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">All Transportations</li>
                            </ol>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>
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
                                            id="">
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
                                                $i = 1;
                                                $super_admins = ['rohit@kazindmc.com', 'pankaj@thavertech.com'];
                                                if (!empty($transportations)) {
                                                    foreach ($transportations as $transportation) {
                                                        $images = explode(',', $transportation->images);

                                                ?>
                                                        <tr class="odd gradeX">
                                                            <td class="center"><?= $i++ ?></td>
                                                            <td class="center"><?= $transportation->country ?></td>
                                                            <td class="center"><?= $transportation->state ?></td>
                                                            <td class="center"><?= $transportation->city ?></td>
                                                            <td class="center"><?= $transportation->vehicle_name ?></td>
                                                            <td class="center"><?= $transportation->vehicle_type ?></td>
                                                            <td class="center"><?= $transportation->capacity ?></td>
                                                            <td class="center"><?= $transportation->year ?></td>
                                                            <td class="center"><?= $transportation->make ?></td>
                                                            <td class="center"><?= ucfirst($transportation->luggage_transport) ?></td>
                                                            <td class="center"><?= $transportation->luggage ?></td>
                                                            <td class="center"><?= $transportation->remarks ?></td>
                                                            <td class="center">
                                                                <?php
                                                                if (!empty($images) && $images[0] <> '') {
                                                                    foreach ($images as $list) { ?>
                                                                        <img src="<?= $base_url ?>uploads/transportation/<?= trim($list) ?>" width="50" height="50" style="margin-left:1px;border: 1px solid #d2d8dd;" />
                                                                <?php }
                                                                } ?>
                                                            </td>
                                                            <td class="center" style="text-align:center;display:flex;">
                                                                <a href="#" data-toggle="modal" data-target="#modalAdd" id="add-transport-cost" class="btn btn-tbl-money btn-xs" data-transport_id="<?php echo base64_encode($transportation->id); ?>" data-country="<?= $transportation->country ?>" title="Cost List"><i class="fa fa-money" aria-hidden="true"></i></a>
                                                                <a href="<?php echo base_url('edit-transport?id=' . base64_encode($transportation->id)); ?>" class="btn btn-tbl-edit btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                                                                <a href="<?php echo base_url('delete-transport?id=' . base64_encode($transportation->id)); ?>" onclick="return confirm('Are you sure you want to delete this Transport?');" class="btn btn-tbl-delete btn-xs" title="Delete"><i class="fa fa-trash-o "></i></a>
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

        <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width:1100px;">
                <div class="modal-content" style="padding: 15px;">

                    <div class="modal-header">
                        <h4 class="modal-title" id="country"></h4>
                        <button type="button" class="close" data-dismiss="modal" id="close-modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?php echo form_input(['type' => 'text', 'name' => 'vehicle', 'id' => 'vehicle', 'class' => 'mdl-textfield__input', 'required' => 'required', 'readonly' => 'readonly']) ?>
                                    <label class="mdl-textfield__label">Vehicle</label>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?php echo form_input(['type' => 'text', 'name' => 'vehicle_type', 'id' => 'vehicle_type', 'class' => 'mdl-textfield__input', 'required' => 'required', 'readonly' => 'readonly']) ?>
                                    <label class="mdl-textfield__label">Vehicle Type</label>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?php echo form_input(['type' => 'text', 'name' => 'capacity', 'id' => 'capacity', 'class' => 'mdl-textfield__input', 'required' => 'required', 'readonly' => 'readonly']) ?>
                                    <label class="mdl-textfield__label">Capacity</label>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?php echo form_input(['type' => 'text', 'name' => 'luggage_capacity', 'id' => 'luggage_capacity', 'class' => 'mdl-textfield__input', 'required' => 'required', 'readonly' => 'readonly']) ?>
                                    <label class="mdl-textfield__label">Luggage Capacity</label>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="d-flex" data-upgraded=",MaterialTextfield">
                                    <label class="m-1">Luggage Vehicle Required</label>
                                    <?php echo form_input(['type' => 'checkbox', 'name' => 'luggage_vehicle_required', 'id' => 'luggage_vehicle_required', 'class' => '', 'required' => 'required', 'onclick' => 'return false;']) ?>
                                </div>
                            </div>
                        </div>
                        <form enctype="multipart/form-data" method="POST" action="add-transportation-cost" id="add-cost">
                            <?php echo form_input(['type' => 'hidden', 'name' => 'transport_id', 'id' => 'transport_id', 'class' => 'mdl-textfield__input', 'required' => 'required']) ?>
                            <?php echo form_input(['type' => 'hidden', 'name' => 'currency', 'id' => 'currency_type', 'class' => 'mdl-textfield__input', 'required' => 'required']) ?>

                            <div class="row mt-2">
                                <div class="col-lg-3">
                                    <div class="">
                                        <label class="custom-label">Airport Transfer</label>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'id[]', 'id' => 'id', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'type[]', 'id' => 'type', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => 'airport-transfer-in']) ?>
                                        <?php echo form_input(['type' => 'text', 'name' => 'price[]', 'id' => 'price', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']) ?>
                                        <label class="mdl-textfield__label">In Charges</label>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="currency custom-label-2"></label>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'id[]', 'id' => 'id', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'type[]', 'id' => 'type', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => 'airport-transfer-out']) ?>
                                        <?php echo form_input(['type' => 'text', 'name' => 'price[]', 'id' => 'price', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']) ?>
                                        <label class="mdl-textfield__label">Out Charges</label>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="currency custom-label-2"></label>
                                    </div>
                                </div>

                                <?php echo form_input(['type' => 'hidden', 'name' => 'start_time[]', 'id' => 'start_time', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                <?php echo form_input(['type' => 'hidden', 'name' => 'end_time[]', 'id' => 'end_time', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                <?php echo form_input(['type' => 'hidden', 'name' => 'start_time[]', 'id' => 'start_time', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                <?php echo form_input(['type' => 'hidden', 'name' => 'end_time[]', 'id' => 'end_time', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                <?php echo form_input(['type' => 'hidden', 'name' => 'hours[]', 'id' => '', 'class' => 'mdl-textfield__input', 'value' => '',]) ?>
                                <?php echo form_input(['type' => 'hidden', 'name' => 'hours[]', 'id' => '', 'class' => 'mdl-textfield__input', 'value' => '',]) ?>
                            </div>

                            <div class="row mt-2">
                                <div class="col-lg-3">
                                    <div class="">
                                        <label class="custom-label">Half Day</label>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'id[]', 'id' => 'id', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'type[]', 'id' => 'type', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => 'halfday']) ?>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php echo form_input(['type' => 'time', 'name' => 'start_time[]', 'id' => 'start_time', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']) ?>
                                        <label class="mdl-textfield__label">Start Time</label>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php echo form_input(['type' => 'time', 'name' => 'end_time[]', 'id' => 'end_time', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']) ?>
                                        <label class="mdl-textfield__label">End Time</label>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php echo form_input(['type' => 'text', 'name' => 'hours[]', 'id' => 'hours', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '', 'readonly' => 'readonly']) ?>
                                        <label class="mdl-textfield__label">Hours</label>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php echo form_input(['type' => 'text', 'name' => 'price[]', 'id' => 'price', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']) ?>
                                        <label class="mdl-textfield__label">Charges</label>
                                    </div>
                                </div>

                                <div class="col-lg-1">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="currency custom-label-2"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-lg-3">
                                    <div class="">
                                        <label class="custom-label">Full Day</label>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'id[]', 'id' => 'id', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'type[]', 'id' => 'type', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => 'full-day']) ?>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php echo form_input(['type' => 'time', 'name' => 'start_time[]', 'id' => 'start_time', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']) ?>
                                        <label class="mdl-textfield__label">Start Time</label>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php echo form_input(['type' => 'time', 'name' => 'end_time[]', 'id' => 'end_time', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']) ?>
                                        <label class="mdl-textfield__label">End Time</label>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php echo form_input(['type' => 'text', 'name' => 'hours[]', 'id' => 'hours', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '', 'readonly' => 'readonly']) ?>
                                        <label class="mdl-textfield__label">Hours</label>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php echo form_input(['type' => 'text', 'name' => 'price[]', 'id' => 'price', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']) ?>
                                        <label class="mdl-textfield__label">Charges</label>
                                    </div>
                                </div>

                                <div class="col-lg-1">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="currency custom-label-2"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-lg-3">
                                    <div class="">
                                        <label class="custom-label">Extended Day</label>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'id[]', 'id' => 'id', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'type[]', 'id' => 'type', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => 'extended-day']) ?>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php echo form_input(['type' => 'time', 'name' => 'start_time[]', 'id' => 'start_time', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']) ?>
                                        <label class="mdl-textfield__label">Start Time</label>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php echo form_input(['type' => 'time', 'name' => 'end_time[]', 'id' => 'end_time', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']) ?>
                                        <label class="mdl-textfield__label">End Time</label>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php echo form_input(['type' => 'text', 'name' => 'hours[]', 'id' => 'hours', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '', 'readonly' => 'readonly']) ?>
                                        <label class="mdl-textfield__label">Hours</label>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php echo form_input(['type' => 'text', 'name' => 'price[]', 'id' => 'price', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']) ?>
                                        <label class="mdl-textfield__label">Charges</label>
                                    </div>
                                </div>

                                <div class="col-lg-1">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="currency custom-label-2"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-lg-3">
                                    <div class="">
                                        <label class="custom-label">Parking Charges</label>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'id[]', 'id' => 'id', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'type[]', 'id' => 'type', 'class' => 'mdl-textfield__input', 'value' => 'parking']) ?>
                                    </div>
                                </div>

                                <?php echo form_input(['type' => 'hidden', 'name' => 'start_time[]', 'id' => 'start_time', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                <?php echo form_input(['type' => 'hidden', 'name' => 'end_time[]', 'id' => 'end_time', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                <?php echo form_input(['type' => 'hidden', 'name' => 'hours[]', 'id' => '', 'class' => 'mdl-textfield__input', 'value' => '',]) ?>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php echo form_input(['type' => 'text', 'name' => 'price[]', 'id' => 'price', 'class' => 'mdl-textfield__input']) ?>
                                        <label class="mdl-textfield__label">Charges</label>
                                    </div>
                                </div>

                                <div class="col-lg-1">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="currency custom-label-2"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="offset-1 col-lg-11 p-t-20 text-center">
                                <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value' => 'Submit']); ?>
                            </div>

                        </form>
                    </div>

                    <div id="response-msg" class="text-center mt-1"></div>

                    <div class="modal-header d-flex justify-content-space-between" idstyle="background:#869aad;">
                        <h4 class="modal-title" id="title-id">Outside City Charges</h4>
                        <div class="d-flex disabled" id="disable-btn">
                            <form id="file-input-form" method="POST" enctype="multipart/form-data">
                                <label for="file-input" class="btn btn-primary mt-1">
                                    Choose CSV File
                                </label>
                                <input type="file" name="csv_file" id="file-input" class="d-none" accept=".csv">
                            </form>
                            &nbsp; &nbsp;
                            <a href="#" id="outside-locations-excel" class="btn btn-light mt-1">Download Excel</a>
                        </div>
                    </div>
                    <div class="modal-body ui-front">
                        <form id="outside-city-form" enctype="multipart/form-data">
                            <?php echo form_input(['type' => 'hidden', 'name' => 'transport_id', 'id' => 'transportid', 'class' => 'mdl-textfield__input', 'required' => 'required']) ?>
                            <input type="hidden" name="sites_id" id="sites_id" value="">
                            <input type="hidden" name="location_id" id="location_id" value="">
                            <?php echo form_input(['type' => 'hidden', 'name' => 'currency', 'id' => 'currencytype', 'class' => 'mdl-textfield__input', 'required' => 'required']) ?>
                            <?php echo form_input(['type' => 'hidden', 'name' => 'country', 'id' => 'countryname', 'class' => 'mdl-textfield__input', 'required' => 'required']) ?>
                            <div class="row mt-4">
                                <?php echo form_input(['type' => 'hidden', 'name' => 'edit_id', 'id' => 'edit_id', 'class' => 'mdl-textfield__input', 'required' => 'required']) ?>

                                <div class="col-lg-3">
                                    <div
                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php
                                        echo form_input(['name' => 'location', 'id' => 'location', 'placeholder' => '', 'class' => 'mdl-textfield__input', 'value' => '']);
                                        ?>
                                        <label class="mdl-textfield__label">Location</label>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php echo form_input(['name' => 'price', 'id' => 'charges', 'class' => 'mdl-textfield__input', 'required' => 'required']); ?>
                                        <label class="mdl-textfield__label">Supplement Charges</label>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php echo form_input(['name' => 'toll_price', 'id' => 'toll_charges', 'class' => 'mdl-textfield__input', 'required' => 'required']); ?>
                                        <label class="mdl-textfield__label">Toll Charges</label>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php echo form_input(['name' => 'parking_price', 'id' => 'parking_charges', 'class' => 'mdl-textfield__input', 'required' => 'required']); ?>
                                        <label class="mdl-textfield__label">Parking Charges</label>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="currency custom-label-2"></label>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                                        <select name="status" class="mdl-textfield__input" style="padding-top:7px;" id="status">
                                            <option value="active">
                                                Active</option>
                                            <option value="inactive">
                                                In-active</option>
                                        </select>
                                        <label class="mdl-textfield__label">Status</label>
                                    </div>
                                </div>

                                <div class="col-lg-2 p-t-20 text-center">
                                    <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value' => 'Submit']); ?>
                                </div>

                            </div>
                        </form>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-scrollable">
                                    <table class="table table-hover table-checkable order-column full-width" id="example4">
                                        <thead>
                                            <tr>
                                                <th class="center">Sr.No</th>
                                                <th class="center">Location</th>
                                                <th class="center">Supplement Charges</th>
                                                <th class="center">Toll Charges</th>
                                                <th class="center">Parking Charges</th>
                                                <th class="center">Total Charges</th>
                                                <th class="center">Status</th>
                                                <th class="center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="outside-transport">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- end page container -->
        <!-- start footer -->
        <?php include('admin_footer.php'); ?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
    <?php include('admin_footer_js.php'); ?>
    <!-- end js include path -->

    <!-- Include jQuery and jQuery UI for autocomplete -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    <script>
        $(document).ready(function() {
            var table = $('#example4').DataTable({
                "scrollX": true,
                //"scrollY": "200px",
                "pageLength": 10
            });
        });

        $(document).on('click', '#outside-locations-excel', function(e) {
            e.preventDefault();

            var country = $('#countryname').val();
            var transportId = $('#transport_id').val();
            var encodedTransportId = btoa(transportId);
            var currency = $('#currencytype').val();

            // Redirect to the download URL with the transport ID as a parameter
            if (country) {
                window.location.href = '<?= base_url() ?>admin/transport/outside_locations_excel?country=' + country + '&transport_id=' + encodedTransportId + '&currency=' + currency;
            } else {
                alert('Please provide a valid Country.');
            }
        });

        $(document).on('change', '#file-input', function(e) {
            // Trigger form submission when a file is selected
            var formData = new FormData($('#file-input-form')[0]);
            var transportId = $('#transport_id').val();
            var encodedTransportId = btoa(transportId);

            const confirmUpload = confirm("Are you sure you want to upload the selected file?");

            if (confirmUpload) {
                $.ajax({
                    url: 'admin/transport/import_outside_locations',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(response) {
                        $('#response-msg').html(response.msg);
                        $('#file-input-form')[0].reset();
                        fetchTransportCost(encodedTransportId);
                    },
                    error: function(xhr, status, error) {
                        $('#response-msg').html('<div class="alert alert-danger">File upload canceled.</div>');
                        $(this).val(''); // Clear the file input field
                    }
                });
            } else {
                alert('Failed to upload the file!');
                $(this).val('');
            }

        });

        $(document).on('click', '#add-transport-cost', function(e) {
            e.preventDefault();

            var transportId = $(this).data('transport_id');
            var country = $(this).data('country');

            $.ajax({
                url: 'transport-costing',
                type: 'POST',
                data: {
                    id: transportId
                },
                dataType: "json",
                success: function(response) {
                    let transport = response.transport;

                    $('#transport_id').val(transport.id);
                    $('#vehicle').val(transport.vehicle_name);
                    $('#vehicle_type').val(transport.vehicle_type);
                    $('#capacity').val(transport.capacity);
                    $('#luggage_capacity').val(transport.luggage);
                    $('#luggage_vehicle_required').prop('checked', (transport.luggage_transport === 'yes' || transport.luggage_transport === true || transport.luggage_transport === '1'));
                    $('#country').html(`Transportation Cost (${transport.country})`);
                    $('#countryname').val(transport.country)
                    $('.currency').html({
                        'Azerbaijan': 'Manat',
                        'Belarus': 'Ruble',
                        'Georgia': 'Lari',
                        'India': 'INR',
                        'Kazakhstan': 'Tenge'
                    } [transport.country] || '');
                    $('#currency_type').val({
                        'Azerbaijan': 'manat',
                        'Belarus': 'ruble',
                        'Georgia': 'lari',
                        'India': 'inr',
                        'Kazakhstan': 'tenge'
                    } [transport.country] || '');
                    $('#transportid').val(transport.id);
                    $('#currencytype').val({
                        'Azerbaijan': 'manat',
                        'Belarus': 'ruble',
                        'Georgia': 'lari',
                        'India': 'inr',
                        'Kazakhstan': 'tenge'
                    } [transport.country] || '');


                    let transportCost = response.transport_cost;
                    transportCost.forEach((cost, index) => {
                        // Set values based on `type` and position in the form
                        switch (cost.type) {
                            case 'airport-transfer-in':
                                $('[name="id[]"]').eq(0).val(cost.id);
                                $('[name="price[]"]').eq(0).val(cost.price);
                                break;

                            case 'airport-transfer-out':
                                $('[name="id[]"]').eq(1).val(cost.id);
                                $('[name="price[]"]').eq(1).val(cost.price);
                                break;

                            case 'halfday':
                                $('[name="id[]"]').eq(2).val(cost.id);
                                $('[name="start_time[]"]').eq(2).val(cost.start_time);
                                $('[name="end_time[]"]').eq(2).val(cost.end_time);
                                $('[name="hours[]"]').eq(2).val(cost.hours);
                                $('[name="price[]"]').eq(2).val(cost.price);
                                break;

                            case 'full-day':
                                $('[name="id[]"]').eq(3).val(cost.id);
                                $('[name="start_time[]"]').eq(3).val(cost.start_time);
                                $('[name="end_time[]"]').eq(3).val(cost.end_time);
                                $('[name="hours[]"]').eq(3).val(cost.hours);
                                $('[name="price[]"]').eq(3).val(cost.price);
                                break;

                            case 'extended-day':
                                $('[name="id[]"]').eq(4).val(cost.id);
                                $('[name="start_time[]"]').eq(4).val(cost.start_time);
                                $('[name="end_time[]"]').eq(4).val(cost.end_time);
                                $('[name="hours[]"]').eq(4).val(cost.hours);
                                $('[name="price[]"]').eq(4).val(cost.price);
                                break;

                            case 'parking':
                            $('[name="id[]"]').eq(5).val(cost.id);
                            $('[name="price[]"]').eq(5).val(cost.price);
                            break;                                
                        }
                    });

                    fetchTransportCost(transportId);
                    enableBtn(country);

                    $('#modalAdd').modal('show');
                },
                error: function() {
                    alert('Failed to fetch transport cost details.');
                }
            });

        });

        $(document).on('click', '#edit-btn', function(e) {
            e.preventDefault();

            var editId = $(this).data('edit-id');

            $.ajax({
                url: 'admin/transport/edit_outsidecity_tranport_price',
                type: 'POST',
                data: {
                    id: editId
                },
                dataType: "json",
                success: function(response) {
                    let outsideTransport_cost = response.details;
                    $('#edit_id').val(outsideTransport_cost.id);
                    $('#location').val(outsideTransport_cost.loc);
                    $('#sites_id').val(outsideTransport_cost.sites_id);
                    $('#location_id').val(outsideTransport_cost.location_ids);
                    $('#charges').val(outsideTransport_cost.price);
                    $('#toll_charges').val(outsideTransport_cost.toll_price);
                    $('#parking_charges').val(outsideTransport_cost.parking_price);
                    $('#status').val(outsideTransport_cost.status);
                },
                error: function() {
                    alert('Failed to edit transport cost.');
                }
            });
        });

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
        }

        function fetchTransportCost(transportId) {
            $.ajax({
                url: 'transport-costing',
                type: 'POST',
                data: {
                    id: transportId
                },
                dataType: "json",
                success: function(response) {
                    let outsideTransport_cost = response.outside_transport_cost;

                    var tableBody = $('.outside-transport');
                    tableBody.empty();

                    $.each(outsideTransport_cost, function(index, item) {
                        var total = (parseFloat(item.price) || 0) + (parseFloat(item.toll_price) || 0) + (parseFloat(item.parking_price) || 0);
                        item.total = total;
                    
                        // Append row
                        var row = '<tr>' +
                            '<td class="center">' + (index + 1) + '</td>' +
                            '<td class="center">' + item.loc + '</td>' +
                            '<td class="center">' + item.price + '</td>' +
                            '<td class="center">' + item.toll_price + '</td>' +
                            '<td class="center">' + item.parking_price + '</td>' +
                            '<td class="center">' + total + '</td>' + 
                            '<td class="center" style="color:' + (item.status.toLowerCase() === 'active' ? 'green' : 'red') + ';">' +
                            capitalizeFirstLetter(item.status) + 
                            '</td>' +
                            '<td class="center"><a href="#" class="btn btn-success btn-xs" id="edit-btn" data-edit-id="' + 
                            item.id + '">Edit</a></td>' +
                            '</tr>';
                        
                        tableBody.append(row);
                    });

                },
                error: function() {
                    alert('Failed to fetch transport cost details.');
                }
            });
        }

        function enableBtn(country) {
            $.ajax({
                url: 'admin/transport/btn_enable',
                type: 'POST',
                data: {
                    country: country
                },
                dataType: "json",
                success: function(response) {
                    const disableBtnDiv = document.getElementById('disable-btn');

                    if (response && Object.keys(response).length > 0) {
                        disableBtnDiv.classList.add('active');
                        disableBtnDiv.classList.remove('disabled');
                    } else {
                        disableBtnDiv.classList.add('disabled');
                        disableBtnDiv.classList.remove('active');
                    }
                },
                error: function() {
                }
            });
        }

        $(document).ready(function() {
            // Function to calculate the time difference in hours
            function calculateHours(startTime, endTime) {
                const start = new Date('1970-01-01T' + startTime + 'Z');
                const end = new Date('1970-01-01T' + endTime + 'Z');
                const diffInMs = end - start;
                const diffInHours = diffInMs / (1000 * 60 * 60);
                return diffInHours.toFixed(2);
            }

            $('.mdl-textfield input[name="start_time[]"], .mdl-textfield input[name="end_time[]"]').each(function() {
                const startTime = $(this).closest('.row').find('input[name="start_time[]"]').val();
                const endTime = $(this).closest('.row').find('input[name="end_time[]"]').val();

                if (startTime && endTime) {
                    const hours = calculateHours(startTime, endTime);
                    if (hours > 0) {
                        $(this).closest('.row').find('input[name="hours[]"]').val(hours);
                    } else {
                        alert('End time must be later than start time.');
                        $(this).closest('.row').find('input[name="hours[]"]').val('');
                        $(this).closest('.row').find('input[name="end_time[]"]').val('');
                    }
                }
            });

            // On time change, calculate and update the hours field
            $('input[name="start_time[]"], input[name="end_time[]"]').on('change', function() {
                const startTime = $(this).closest('.row').find('input[name="start_time[]"]').val();
                const endTime = $(this).closest('.row').find('input[name="end_time[]"]').val();

                if (startTime && endTime) {
                    const hours = calculateHours(startTime, endTime);
                    if (hours > 0) {
                        $(this).closest('.row').find('input[name="hours[]"]').val(hours);
                    } else {
                        alert('End time must be later than start time.');
                        $(this).closest('.row').find('input[name="hours[]"]').val('');
                        $(this).closest('.row').find('input[name="end_time[]"]').val('');
                    }
                }
            });
        });

        $("#location").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?= base_url() ?>admin/transport/outside_locations",
                    type: "POST",
                    dataType: "json",
                    data: {
                        search: request.term,
                        country: $('#countryname').val(),
                    },
                    success: function(data) {
                        response(data);
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX error:", status, error);
                    }
                });
            },
            select: function(event, ui) {
                $('#location').val(ui.item.label);
                $('#sites_id').val(ui.item.id);
                $('#location_id').val(ui.item.location_ids);
                return false;
            }
        });

        $('#outside-city-form').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission
            var transportId = $('#transport_id').val();
            var encodedTransportId = btoa(transportId);

            var formData = new FormData(this);

            // AJAX request
            $.ajax({
                url: 'add-outsidecity-transportation-cost', // Get form action URL
                type: 'POST',
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#response-msg').html(response.msg)
                    $('#outside-city-form')[0].reset();
                    $('#edit_id').val('');
                    fetchTransportCost(encodedTransportId);
                },
                error: function(xhr, status, error) {
                    // Handle error
                    alert('An error occurred: ' + xhr.responseText);
                }
            });
        });

        $(document).on('click', '.close', function(e) {
            location.reload();
        });
    </script>
</body>

</html>