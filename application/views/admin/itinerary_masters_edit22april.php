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
    <script type="text/javascript" src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>
    <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet" />
    <style>
        .custom-label-2 {
            font-weight: bold !important;
            margin: 5px !important;
            font-size: smaller;
        }
        .mdl-textfield { position:relative !important; }
    </style>
    <script>
        CKEDITOR.config.toolbar = [{
                name: 'basicstyles',
                groups: ['basicstyles', 'cleanup'],
                items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
            },
            {
                name: 'styles',
                items: ['Styles', 'Format', 'Font', 'FontSize']
            },
            {
                name: 'colors',
                items: ['TextColor', 'BGColor']
            },
            {
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-',
                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl',
                    'Language'
                ]
            },
            '/',
            {
                name: 'clipboard',
                groups: ['clipboard', 'undo'],
                items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
            },
            {
                name: 'insert',
                items: ['Table']
            }
        ];
    </script>
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
                                <div class="page-title">Masters Creation Edit</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Masters Creation Edit</li>
                            </ol>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head">
                                    <header>Masters Creation Edit</header>
                                    <div class="tools">
                                        <a href="all-masters" class="btn btn-success" style="padding: 6px;"><i
                                                class="fa fa-file-text-o"></i>
                                            List</a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>
                                <?php echo form_open_multipart(current_url() . '?' . $_SERVER['QUERY_STRING']); ?>
                                <div class="card-body row">

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php
                                            $readonly = [];
                                            if ($this->session->userdata('admin_type') != 'superadmin' && $this->session->userdata('locations') != 'all') {
                                                $readonly = ['readonly' => 'readonly'];
                                            }
                                            echo form_input(['name' => 'country', 'id' => 'country', 'required' => 'required', 'class' => 'mdl-textfield__input', 'value' => $result->country] + $readonly) ?>
                                            <label class="mdl-textfield__label">Select Country</label>
                                            <?php echo form_error('country'); ?>
                                        </div>
                                    </div>
                                    <input type="hidden" name="country_id" id="country_id"
                                        value="<?php echo $country_id; ?>">
                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'mdl-textfield__input', 'value' => $result->city]); ?>
                                            <label class="mdl-textfield__label">City</label>
                                            <?php echo form_error('city'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'name', 'id' => 'name', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => $result->site_name]); ?>
                                            <label class="mdl-textfield__label">Name</label>
                                            <?php echo form_error('name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <select name="category" class="mdl-textfield__input"
                                                style="padding-top:13px;" required="">
                                                <option value=""></option>
                                                <option value="sitescene"
                                                    <?= ($result->category == 'sitescene') ? 'selected="selected"' : ''; ?>>
                                                    Sightseeing</option>
                                                <option value="activity"
                                                    <?= ($result->category == 'activity') ? 'selected="selected"' : ''; ?>>
                                                    Activity</option>
                                                <option value="night-life"
                                                    <?= ($result->category == 'night-life') ? 'selected="selected"' : ''; ?>>
                                                    Night Life</option>
                                                <option value="transfers"
                                                    <?= ($result->category == 'transfers') ? 'selected="selected"' : ''; ?>>
                                                    Transfers</option>
                                                <option value="miscellaneous"
                                                    <?= ($result->category == 'miscellaneous') ? 'selected="selected"' : ''; ?>>
                                                    Miscellaneous</option>
                                            </select>
                                            <label class="mdl-textfield__label">Category</label>
                                            <?php echo form_error('category'); ?>
                                        </div>
                                    </div>

                                    <!-- <div class="col-lg-4 p-t-20" id="add-ticket-price">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <select name="entry_ticket" id="entry_ticket" class="mdl-textfield__input" style="padding-top:13px;">
                                                <option value="yes" <?= ($result->entry_ticket == 'yes') ? 'selected="selected"' : ''; ?>>Yes</option>
                                                <option value="no" <?= ($result->entry_ticket == 'no') ? 'selected="selected"' : ''; ?>>No</option>
                                            </select>
                                            <label class="mdl-textfield__label">Entry Ticket</label>
                                        </div>
                                    </div> -->
                                    <div class="col-lg-2 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <select name="entry_ticket" id="entryTicketSelect" class="mdl-textfield__input" style="padding-top:13px;">
                                                <option value=""></option>      
                                                <option value="yes" <?= ($result->entry_ticket == 'yes') ? 'selected="selected"' : ''; ?>>Yes</option>
                                                <option value="no" <?= ($result->entry_ticket == 'no') ? 'selected="selected"' : ''; ?>>No</option>
                                            </select>
                                            <label class="mdl-textfield__label">Entry Ticket</label>
                                            <?php echo form_error(''); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-t-20" id="ticketInputField" style="display: <?= ($result->entry_ticket == 'yes') ? 'inline-flex' : 'none'; ?>;">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input type="text" name="ticket_for" value="<?=$result->entry_ticket_for;?>" class="mdl-textfield__input" id="ticketNumber">
                                            <label class="mdl-textfield__label">Entry Ticket For</label>
                                            </div>
                                        </div>
                                        <!-- <div class="col-lg-2 p-t-20" id="PersonsTypeContainer" style="display: <?= ($result->entry_ticket == 'yes') ? 'inline-flex' : 'none'; ?>;">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <select name="ticket_type" id="personsTypeDropdown" class="mdl-textfield__input" style="padding-top:13px;">
                                                <option value=""></option>      
                                                <option value="per_person" <?= ($result->ticket_type == 'per_person') ? 'selected="selected"' : ''; ?>>Per Person</option>
                                                <option value="group" <?= ($result->ticket_type == 'group') ? 'selected="selected"' : ''; ?>>Group</option>
                                            </select>
                                            <label class="mdl-textfield__label">Ticket Type</label>
                                            </div>
                                        </div> -->
                                        <div class="col-lg-2 p-t-20" id="Numberofpersons" style="display:<?= ( $result->entry_ticket == 'yes') ? 'inline-flex' : 'none'; ?>;">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input type="text" name="number_of_persons" value="<?=$result->number_of_persons;?>" class="mdl-textfield__input" id="PersonsNumber">
                                            <label class="mdl-textfield__label">Number of Persons (Group)</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-t-20" id="price" style="display:<?= ( $result->entry_ticket == 'yes') ? 'inline-flex' : 'none'; ?>;;">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" >
                                                <input type="text" id="priceinput" name="price" class="mdl-textfield__input" value="<?=$result->group_entry_ticket_fee;?>">
                                                <label class="mdl-textfield__label">Group Entry Fee</label>
                                            </div>
                                        </div>

                                    <div id="entry-fee-adult" class="col-lg-4 p-t-20" style="display: <?= ( $result->entry_ticket == 'yes') ? 'inline-flex' : 'none'; ?>;">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" >
                                                <input type="text" id="entry_fee" name="entry_fee" class="mdl-textfield__input"
                                                    value="<?=$result->entry_ticket_fee ;?>">
                                                <label class="mdl-textfield__label">Per Person Adult Entry Fee</label>
                                            </div>
                                    </div>
                                    <div id="entry-fee-child" class="col-lg-3 p-t-20" style="display: <?= ( $result->entry_ticket == 'yes') ? 'inline-flex' : 'none'; ?>;">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" >
                                                <input type="text" id="child_entry_fee" name="child_entry_fee" class="mdl-textfield__input"
                                                    value="<?=$result->child_entry_ticket_fee;?>">
                                                <label class="mdl-textfield__label" style="">Per Person Child Entry Fee</label>
                                            </div>
                                        </div>


                                    <div class="col-lg-1 p-t-20 mt-4">
                                        <a href="#" id="add-activity" data-toggle="modal" data-target="#modalAdd"><i title="Add Activity" class="fa fa-plus edit-add"></i>&nbsp;Add Activity
                                        </a>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input type="time" id="departing_time" name="departing_time"
                                                class="mdl-textfield__input"
                                                value="<?php echo $result->departing_time_from_hotel; ?>">
                                            <label class="mdl-textfield__label">Departing Time From Hotel</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input type="text" id="duration" name="duration"
                                                class="mdl-textfield__input" value="<?php echo $result->duration; ?>">
                                            <label class="mdl-textfield__label">Duration</label>
                                        </div>
                                    </div>
                                    <?php $operational_days = explode(',', $result->days_of_operation);
                                    $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                                    ?>
                                    <div class="col-lg-4 p-t-20">
                                        <div class="" style="font-weight:500;font-size:14px;">
                                            <label class="">Days Of Operation</label>&nbsp;&nbsp;<input type="checkbox" name="" value="" id="all-days"> All days<br>
                                            <?php foreach ($days as $list) {
                                                if ($list == 'saturday') {
                                                    echo '<br>';
                                                }  ?>
                                                <input type="checkbox" class="week-days" name="operational_days[]" value="<?= $list ?>" <?php echo (in_array($list, $operational_days) ? 'checked="checked"' : ''); ?>> <?= ucfirst($list) ?>
                                            <?php } ?>
                                        </div>
                                        <?php echo form_error('operational_days[]'); ?>
                                    </div>
                                    <?php $location_ids = explode(',', $result->location_ids); ?>
                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                                            <select id="destination_type" name="destination_type" class="mdl-textfield__input" style="padding-top:13px;">
                                                <option value="insidecity">Inside City</option>
                                                <option value="outsidecity" <?php echo (isset($location_ids[0]) && $location_ids[0]!=0)?'selected="selected"':''; ?>>Outside City</option>
                                            </select>
                                            <label class="mdl-textfield__label">Destination Type</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <select name="location_ids[]" id="location_ids" class="mdl-textfield__input js-example-basic-multiple" multiple="" style="padding: 10px;">
                                                <?php foreach ($location_masters as $list) { ?>
                                                    <option data-country="<?= $list->country ?>" value="<?= $list->id ?>" <?php echo (in_array($list->id, $location_ids)) ? 'selected="selected"' : ''; ?>><?= $list->location ?></option>
                                                <?php } ?>
                                            </select>
                                            <label class="mdl-textfield__label">Select Locations</label>
                                            <?php echo form_error('location_ids[]'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input type="text" id="new_location_ids" name="new_location_id"
                                                class="mdl-textfield__input"
                                                value="">
                                            <label class="mdl-textfield__label">Create New Locations</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <textarea class="form-control txt_description" name="description"
                                                id="description"><?php echo $result->description; ?></textarea>
                                            <script>
                                                CKEDITOR.replace('description');
                                            </script>
                                        </div>
                                    </div>
                                    <input type="hidden" name="" id="sites_id" value="<?php echo $result->id; ?>">
                                    <?php foreach ($result_remarks as $list) { ?>
                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                                <textarea class="form-control txt_remarks" name="edit_remarks[]"
                                                    class="remarks_editor"
                                                    id="remarks_<?php echo $list->id; ?>"><?php echo $list->remarks; ?></textarea>

                                                <input type="hidden" id="" name="edit_id_remarks[]"
                                                    value="<?php echo $list->id; ?>" class="mdl-textfield__input">
                                                <label class="mdl-textfield__label">Remarks</label>
                                            </div>
                                            <script>
                                                CKEDITOR.replace('remarks');
                                            </script>
                                            <i title="Remove" class="fa fa-window-close edit-remove"
                                                style="color:red;cursor: pointer;float: right;margin-top: -15px;position:relative;"
                                                data-id="<?= $list->id ?>"></i>
                                        </div>
                                    <?php } ?>

                                    <!-- <div class="col-lg-4 p-t-20" id="div_remarks">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input type="text" id="rem" name="remarks[]" value=""
                                                class="mdl-textfield__input">
                                            <label class="mdl-textfield__label">Remarks</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20" id="addnew">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <button type="button" class="btn btn-success add_new"><i
                                                    class="fa fa-plus"></i></button>
                                        </div>
                                    </div> -->


                                    <div class="col-lg-4 p-t-20" id="">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <textarea class="form-control txt_remarks" name="remarks[]"
                                                id="remarks"></textarea>
                                            <label class="mdl-textfield__label">Remarks</label>
                                        </div>
                                    </div>

                                    <script>
                                        CKEDITOR.replace('remarks');
                                    </script>
                                    <div class="col-lg-4 p-t-20" id="addnew">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <button type="button" class="btn btn-success add_new"><i
                                                    class="fa fa-plus"></i></button>
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
                    <!-- end page content -->
                </div>
                <!-- end page container -->
                <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="min-width:1280px !important;">
                        <div class="modal-content" >

                            <div class="modal-header">
                                <h4 class="modal-title" id="country">Add Activity</h4>
                                <button type="button" class="close" data-dismiss="modal" id="close-modal">&times;</button>
                            </div>
                            <div id="response-msg" class="text-center"></div>
                            <div class="modal-body">
                                <form enctype="multipart/form-data" id="add-cost">
                                    <!-- <div class="row mt-2"> -->
                                        <?php $countryToCurrency = ['Azerbaijan' => 'Manat', 'Belarus' => 'Ruble', 'Georgia' => 'Lari', 'India' => 'INR', 'Kazakhstan' => 'Tenge']; ?>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'sites_id', 'id' => 'sites_id', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => $result->id]) ?>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'currency', 'id' => 'currency', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => isset($result->country) && array_key_exists($result->country, $countryToCurrency) ? $countryToCurrency[$result->country] : 'Currency not found']) ?>
                                       
                                    <div id="add-rows">
                                        <div class="row input-fields m-1" id="input-fields">
                                            <div class="col-lg-2">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php echo form_input(['type' => 'text', 'name' => 'activity[]', 'id' => 'activity', 'class' => 'mdl-textfield__input', 'value' => '', 'required' => 'required']); ?>
                                                    <label class="mdl-textfield__label"><b>Activity</b></label>
                                                </div>
                                            </div>
                                        <div class="col-lg-2 activity_number_of_persons_div"  >
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input type="text" name="activity_number_of_persons[]" value="0" class="mdl-textfield__input" id="activity_number_of_persons">
                                            <label class="mdl-textfield__label"><b>No. of Persons (Group)</b></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 activity_price_div" >
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" >
                                                <input type="text" id="activity_price" name="activity_Perprice[]" value="0" class="mdl-textfield__input">
                                                <label class="mdl-textfield__label"><b>Group Price</b></label>
                                            </div>
                                        </div>
                                        <div  class="col-lg-2 activity_Perprice_div" style="display: inline-flex ;gap:15px; align-items: center; flex-wrap: nowrap; width: 100%;">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="flex: 1; min-width: 45%;">
                                                <input type="text" id="activity_price" name="activity_price[]" value="0" class="mdl-textfield__input">
                                                <label class="mdl-textfield__label"><b>Per Person Adult Price</b></label>
                                            </div>
                                        </div>
                                        <div  class="col-lg-2 activity_Perprice_div1" style="display: inline-flex ;gap:15px; align-items: center; flex-wrap: nowrap; width: 100%;">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="flex: 1; min-width: 45%;">
                                                <input type="text" id="child_activity_price" value="0" name="child_activity_price[]" class="mdl-textfield__input">
                                                <label class="mdl-textfield__label" ><b>Per Person Child Price</b></label>
                                            </div>
                                        </div>
                                        
                                            <div class="col-lg-1">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="activity_type[]" id="activity_type" class="mdl-textfield__input mt-2" required>
                                                        <option value="">Select..</option>
                                                        <option value="all">All</option>
                                                        <option value="summer">Summer</option>
                                                        <option value="winter">Winter</option>
                                                    </select>
                                                    <label class="mdl-textfield__label"><b>Type</b></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-1" style="display:inline-flex;">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="currency custom-label-2">
                                                        <?php echo isset($result->country) && array_key_exists($result->country, $countryToCurrency) ? $countryToCurrency[$result->country] : 'Currency not found'; ?>
                                                    </label>
                                                    <label class="mdl-textfield__label"><b>Currency</b></label>
                                                </div>
                                                <a href="javascript:void(0);" data-id="" class="remove-activity mt-4"><i title="Remove" class="fa fa-window-close edit-add"></i></a>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="offset-10 col-lg-2 pt-3">
                                        <a href="#" id="add-more-activity"><i title="Add Activity" class="fa fa-plus edit-add"></i>&nbsp;Add More Activity
                                        </a>
                                    </div>

                                    <div class="col-lg-12 p-t-20 text-center p-0">
                                        <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value' => 'Submit']); ?>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- start footer -->
                <?php include('admin_footer.php'); ?>
                <!-- end footer -->
            </div>
            <!-- start js include path -->
            <?php include('admin_footer_js.php'); ?>
            <!-- end js include path -->


            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
            <script>
                $(document).ready(function() {
                    $("#type").on("change", function() {
                        $("#rights").css("display", "none");
                        if ($(this).val() === "2") {
                            $("#rights").css("display", "block");
                        }
                    });

                    function initializeCKEditor(id) {
                        // Check if CKEditor is already attached to the element
                        if (!CKEDITOR.instances[id]) {
                            CKEDITOR.replace(id);
                        }
                    }

                    // Initialize CKEditor for existing textareas
                    $('.txt_remarks').each(function() {
                        initializeCKEditor($(this).attr('id'));
                    });

                    $(".add_new").on("click", function() {
                        event.preventDefault();
                        var html = '<div class="col-lg-4 p-t-20" id="">';
                        html +=
                            '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">';
                        html +=
                            '<textarea class="form-control txt_remarks" name="remarks[]" id=""></textarea>';
                        html += '<label class="mdl-textfield__label">Remarks</label></div></div>';
                        var $h = $(html);
                        var x = Math.floor((Math.random() * 1000) + 1);
                        $h.find(".txt_remarks").attr("id", "remarks_" + x);
                        $h.insertBefore("#addnew");
                        initializeCKEditor('remarks_' + x);
                    });
                });


                $(document).ready(function() {
                    $("#type").on("change", function() {
                        $("#rights").css("display", "none");
                        if ($(this).val() === "2") {
                            $("#rights").css("display", "block");
                        }
                    });

                    $(".add_new").on("click", function() {
                        event.preventDefault();
                        $($("#div_remarks").clone()).insertBefore("#addnew");
                    });


                    $(".edit-remove").on("click", function(e) {
                        if (!confirm('Are You Sure?')) {
                            return false;
                        }
                        e.preventDefault();
                        var ele = $(this);
                        $.ajax({
                            url: "<?php echo site_url('edit_remove_masters_remarks'); ?>",
                            type: "post",
                            data: {
                                'id': ele.attr("data-id"),
                                'sites_id': $("#sites_id").val()
                            },
                            dataType: 'JSON',
                            //contentType : false,
                            //processData: false,
                            beforeSend: function() {},
                            success: function(res) {
                                if (res.response === "s") {
                                    ele.parent().remove();
                                }
                            }
                        });
                    });

                });

                $(document).ready(function() {

                    $("#country").autocomplete({
                        source: function(request, response) {
                            // Fetch data
                            $.ajax({
                                url: "<?= base_url() ?>admin/company/get_country_ajax_new",
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
                            get_locations(ui.item.label);
                            return false;
                        }
                    });

                    $("#city").autocomplete({
                        source: function(request, response) {
                            // Fetch data
                            $.ajax({
                                url: "<?= base_url() ?>admin/itinerary/get_city",
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
                            $('#city').val(ui.item.label); // display the selected text
                            //   $('#company_id').val(ui.item.company_id); // save selected id to input

                            return false;
                        }
                    });

                    $("#all-days").on("click", function() {
                        $(".week-days").prop("checked", false);
                        if ($("#all-days").prop('checked') == true) {
                            $(".week-days").each(function() {
                                $(this).prop("checked", true);
                            });
                        }
                    });
                    $(".week-days").on("click", function() {
                        $("#all-days").prop("checked", false);
                    });
                    $('.js-example-basic-multiple').select2({
                        //theme: 'filled',
                        placeholder: 'Select..',

                    });

                });

                function get_locations(country) {
                    $.ajax({
                        url: "<?php echo site_url('admin/masters/get_locations'); ?>",
                        type: "post",
                        data: {
                            'country': country
                        },
                        dataType: 'JSON',
                        //contentType : false,
                        //processData: false,
                        beforeSend: function() {},
                        success: function(res) {
                            if (res.response === "s") {
                                $("#location_ids").empty();
                                $.each(res.details, function(index, item) {
                                    $("#location_ids").append('<option value="' + item
                                        .id + '">' + item.location +
                                        '</option>');
                                });
                            }
                        }
                    });
                }
            </script>
            <script>
                $(document).ready(function() {

                    // Initially check if there are selected locations
                    toggleNewLocationField();

                    // When a location is selected or deselected, toggle the "Create New Location" input
                    $('#destination_type').on('change', function() {
                        toggleNewLocationField();
                    });

                    // When user types something in the "Create New Location" input, disable the dropdown
                    $('#new_location_ids').on('input', function() {
                        toggleLocationSelectField();
                    });

                    function toggleNewLocationField() {
                        // If any location is selected, disable the "Create New Location" input
                        
                        if($("#destination_type").val() == "outsidecity"){
                            $('#new_location_ids').prop('disabled', false).parent().css("background-color","");
                            $('#location_ids').prop('disabled', false).parent().css("background-color","");                            
                        }else{
                            $('#new_location_ids').val('').prop('disabled', true).parent().css("background-color","#f7f7f7");
                            $('#location_ids').val('').trigger('change').prop('disabled', true).parent().css("background-color","#f7f7f7");
                        }                        
                        /*if ($('#location_ids').val().length > 0) {                            
                            $('#destination_type').val('').prop('disabled', true).parent().css("background-color","#f7f7f7");
                        } else {
                            $('#new_location_ids').prop('disabled', false).parent().css("background-color","");
                            $('#destination_type').val('').prop('disabled', false).parent().css("background-color","");
                        }*/
                    }

                    function toggleLocationSelectField() {
                        // If something is typed in the "Create New Location" input, disable the location select dropdown
                        if ($('#new_location_ids').val() !== '') {
                            $('#location_ids').val('').trigger('change').prop('disabled', true);
                        } else {
                            $('#location_ids').prop('disabled', false);
                        }
                    }

                    // $('#add-more-activity').on('click', function(e) {
                    //     e.preventDefault();

                    //     let newRow = $('.input-fields').first().clone(); 
                    //     newRow.find('input, select').val(''); 
                    //     newRow.find('[id]').removeAttr('id'); 
                    //     newRow.appendTo('#add-rows'); 
                    // });


                    $('#add-activity').on('click', function(e) {
                        e.preventDefault();
                        var sites_id = $('#sites_id').val()
                        fetchActivityCost(sites_id);
                    });

                    $(document).on('click', '.close', function(e) {
                        location.reload();
                    });


                    $(document).on('click', '.remove-activity', function(e) {
                        var id = $(this).data('id');
                        e.preventDefault();
                        deleteActivitiesCosts(id)
                        $(this).closest('.row').remove();
                    });

                    function deleteActivitiesCosts(id) {
                        $.ajax({
                            url: "<?php echo site_url('admin/masters/delete_activities_costs'); ?>",
                            type: "POST",
                            data: {
                                'id': id
                            },
                            dataType: 'JSON',
                            //contentType : false,
                            //processData: false,
                            beforeSend: function() {},
                            success: function(response) {
                                $('#response-msg').html(response.msg)
                            },
                            error: function() {
                                alert('Failed to delete activity cost.');
                            }
                        });
                    }

                    $('#add-cost').on('submit', function(e) {
                        e.preventDefault();

                        var sites_id = $('#sites_id').val()
                        var formData = new FormData(this);

                        // AJAX request
                        $.ajax({
                            url: "<?php echo site_url('add-activities-cost'); ?>",
                            type: 'POST',
                            data: formData,
                            dataType: "json",
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                $('#response-msg').html(response.msg)
                                $('#add-cost')[0].reset();
                                fetchActivityCost(sites_id);
                            },
                            error: function(xhr, status, error) {
                                alert('Failed to add activity cost.');
                            }
                        });
                    });

                    function fetchActivityCost(sites_id) {
    $.ajax({
        url: 'admin/masters/activity_costing',
        type: 'POST',
        data: {
            id: sites_id
        },
        dataType: "json",
        success: function(response) {
            if (response && response.cost.length > 0) {
                let cost = response.cost;
                var addRows = $('#add-rows');
                addRows.empty();

                $.each(cost, function(index, item) {
                    let isPerPerson = item.ticket_type === 'per_person';
                    let isGroup = item.ticket_type === 'group';

                    var row = `
                    <div class="row input-fields m-1" id="input-fields">
                        <input type="hidden" name="id[]" value="${item.id || ''}" required>
                        
                        <div class="col-lg-2">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <input type="text" name="activity[]" class="mdl-textfield__input" value="${item.activity || ''}" required>
                                <label class="mdl-textfield__label"><b>Activity</b></label>
                            </div>
                        </div>

                    <div class="col-lg-2 activity_number_of_persons_div" >
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <input type="text" name="activity_number_of_persons[]" value="${item.number_of_persons || ''}" class="mdl-textfield__input">
                                <label class="mdl-textfield__label"><b>No. of Persons (Group)</b></label>
                            </div>
                        </div>

                        <div class="col-lg-2 activity_price_div" >
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <input type="text" name="activity_Perprice[]" value="${item.group_price || ''}" class="mdl-textfield__input">
                                <label class="mdl-textfield__label"><b>Group Price</b></label>
                            </div>
                        </div>

                        <div class="col-lg-2 activity_Perprice_div" style="gap:15px; align-items: center; flex-wrap: nowrap; width: 100%;">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="flex: 1; min-width: 45%;">
                                <input type="text" name="activity_price[]" value="${item.price || ''}" class="mdl-textfield__input">
                                <label class="mdl-textfield__label"><b>Per Person Adult Price</b></label>
                            </div>
                        </div>
                        <div class="col-lg-2 activity_Perprice_div1" style="gap:15px; align-items: center; flex-wrap: nowrap; width: 100%;">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="flex: 1; min-width: 45%;">
                                <input type="text" name="child_activity_price[]" class="mdl-textfield__input" value="${item.child_price || ''}">
                                <label class="mdl-textfield__label" ><b>Per Person Child Price</b></label>
                            </div>
                        </div>

                        

                        <div class="col-lg-1">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <select name="activity_type[]" class="mdl-textfield__input mt-2" required>
                                    <option value="">Select..</option>
                                    <option value="all" ${item.activity_type === 'all' ? 'selected' : ''}>All</option>
                                    <option value="summer" ${item.activity_type === 'summer' ? 'selected' : ''}>Summer</option>
                                    <option value="winter" ${item.activity_type === 'winter' ? 'selected' : ''}>Winter</option>
                                </select>
                                <label class="mdl-textfield__label"><b>Type</b></label>
                            </div>
                        </div>

                        <div class="col-lg-1" style="display:inline-flex;">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width mt-2">
                                <label class="currency custom-label-2">${item.currency || 'Currency not found'}</label>
                            </div>
                            <label class="mdl-textfield__label"><b>Currency</b></label>
                            <a href="#" data-id="${item.id || ''}" class="remove-activity mt-4">
                                <i title="Remove" class="fa fa-window-close edit-add"></i>
                            </a>
                        </div>
                    </div>`;

                    addRows.append(row);
                });

                // Attach event listener to ticket type dropdowns
                $('.ticket-type').on('change', function() {
                    var parentRow = $(this).closest('.row');
                    var selectedType = $(this).val();

                    if (selectedType === 'per_person') {
                        parentRow.find('.activity_Perprice_div, .activity_Perprice_div1').show();
                        parentRow.find('.activity_number_of_persons_div, .activity_price_div').hide();
                    } else if (selectedType === 'group') {
                        parentRow.find('.activity_Perprice_div, .activity_Perprice_div1').hide();
                        parentRow.find('.activity_number_of_persons_div, .activity_price_div').show();
                    }
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            alert('Failed to fetch activity cost details.');
        }
    });
}


                });

                document.addEventListener('DOMContentLoaded', function() {
                        const entryTicketSelect = document.getElementById('entry_ticket');
                        const entryFeeContainer = document.getElementById('entry-fee-container');
                        const entryFeeInput = document.getElementById('entry_fee');
                        var entryFee = $('#entry_fee').val()

                        entryTicketSelect.addEventListener('change', function() {
                            if (entryTicketSelect.value === 'yes') {
                                entryFeeContainer.style.display = 'block';
                                entryFeeInput.value = entryFee; 
                            } else {
                                entryFeeContainer.style.display = 'none';
                                entryFeeInput.value = '0';
                            }
                        });
                    });
                    $(document).ready(function() {
                        $('form').submit(function() 
                        {
                        // Clear values of hidden fields before form submission
                        if ($('#PersonsTypeContainer').css('display') === 'none') {
                            $('#personsTypeDropdown').val('');
                        }
                        if ($('#entry-fee-container').css('display') === 'none') {
                            $('#entry_fee, #child_entry_fee').val('');
                        }
                        if ($('#Numberofpersons').css('display') === 'none') {
                            $('#number_of_persons').val('');
                        }
                        if ($('#price').css('display') === 'none') {
                            $('#price').val('');
                        }
                    });
                    // When the entry ticket dropdown changes
                    $('#entryTicketSelect').change(function() {
                        var selectedValue = $(this).val();

                        if (selectedValue === 'yes') 
                        {
                            $('#ticketInputField').show();
                              $('#price').show();
                              $('#entry-fee-adult').show();
                              $('#entry-fee-child').show();
                              $('#Numberofpersons').show();
                              $('#entry_fee').attr("required","required");
                              $('#child_entry_fee').attr("required","required");
                              $('#priceinput').attr("required","required");
                              $('#PersonsNumber').attr("required","required");
                              $('#ticketNumber').attr("required","required");
                        } 
                        else 
                        {
                            $('#ticketInputField').hide();
                            $('#Numberofpersons').hide();
                            $('#entry-fee-adult').hide();
                            $('#entry-fee-child').hide();
                            $('#price').hide();
                            $('#entry_fee').removeAttr("required").val(0);
                            $('#child_entry_fee').removeAttr("required").val(0);
                            $('#priceinput').removeAttr("required").val(0);
                            $('#PersonsNumber').removeAttr("required").val(0);
                            $('#ticketNumber').removeAttr("required").val('');
                        }
                        
                    });
                    
                    // $('#personsTypeDropdown').change(function() {
                    //     var selectedValue = $(this).val();

                    //     if (selectedValue === 'group') {
                    //         $('#Numberofpersons').show();
                    //         $('#PersonsNumber').attr("required","required");
                    //         $('#price').show();
                    //         $('#priceinput').attr("required","required");
                    //         $('#entry-fee-container').hide().find("input").val("");
                    //         $('#entry_fee').removeAttr("required");
                    //         $('#child_entry_fee').removeAttr("required");
                    //     } else {
                    //         $('#Numberofpersons').hide().find("input").val("");
                    //         $('#price').hide().find("input").val("");
                    //         $('#entry-fee-container').css("display", "flex");
                    //         $('#entry_fee').attr("required","required");
                    //         $('#child_entry_fee').attr("required","required");
                    //         $('#PersonsNumber').removeAttr("required");
                    //         $('#priceinput').removeAttr("required");
                    //     }
                        
                    // });
                });

                $(document).ready(function () 
                {
                    $('#add-rows').on('change', '.ticket-type', function () {
                        var selectedValue = $(this).val();
                        var row = $(this).closest('.input-fields'); 

                        if (selectedValue === 'per_person') {
                            row.find('.activity_Perprice_div, .activity_Perprice_div1').show();
                            row.find('.activity_price_div, .activity_number_of_persons_div').hide().find("input").val("");
                        } else if (selectedValue === 'group') {
                            row.find('.activity_number_of_persons_div, .activity_price_div').show();
                            row.find('.activity_Perprice_div, .activity_Perprice_div1').hide();
                        } else {
                            row.find('.activity_Perprice_div, .activity_Perprice_div1, .activity_price_div, .activity_number_of_persons_div').hide().find("input").val("");
                        }
                    });

                    $('#add-more-activity').on('click', function (e) 
                    {
                        e.preventDefault();

                        let newRow = $('.input-fields').first().clone(); 
                        newRow.find('input, select').val(''); 
                        newRow.find('[id]').each(function() {
                            $(this).removeAttr('id');
                        });
                        newRow.appendTo('#add-rows'); 
                    });
                    
                    $('#add-rows').on('click', '.remove-activity', function () {
                        $(this).closest('.input-fields').remove();
                    });
                });

    </script>
</body>

</html>