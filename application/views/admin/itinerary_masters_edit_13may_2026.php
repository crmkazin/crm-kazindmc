    <?php include('admin_head_css.php'); ?>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script type="text/javascript" src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>
    <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet" />
    <style>
        .custom-label-2 {
            font-weight: bold !important;
            margin: 5px !important;
            font-size: smaller;
        }

        .custom-popup-overlay {
            position: absolute; /* important */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10; /* just above modal content */
        }

        .custom-popup-container {
            background: #fff;
            border-radius: 8px;
            width: 90%;
            max-width: 800px;
            height:auto;
            overflow-y: auto;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            pointer-events: auto;
        }

        .custom-popup-header {
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .custom-popup-header h4 {
            margin: 0;
        }

        .close-popup1 {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #000;
            opacity: 0.5;
        }

        .popup-cross1:hover {
            opacity: 1;
        }

        .custom-popup-body {
            padding: 1rem;
        }

        #addentrance .modal-content {
            position: relative;
        }
        

        .custom-popup-overlay1 {
            position: absolute; /* important */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 110; /* just above modal content */
        }

        .custom-popup-container1 {
            background: #fff;
            border-radius: 8px;
            width: 90%;
            max-width: 800px;
            height:auto;
            overflow-y: auto;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            pointer-events: auto;
        }

        .custom-popup-header1 {
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .custom-popup-header1 h4 {
            margin: 0;
        }

        .popup-cross {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #000;
            opacity: 0.5;
        }

        .popup-cross:hover {
            opacity: 1;
        }

        .custom-popup-body1 {
            padding: 1rem;
        }

        #modalAdd .modal-content {
            position: relative;
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
<div class="page-wrapper">
        <div class="container-fluid">
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                            <h4 class="text-themecolor">Masters Creation Edit</h4>
                        </div>
                        <div class="col-lg-4 only-for-dashbord">
                        </div>
                        <div class="col-lg-5 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active"><a href="<?php echo base_url('all-masters'); ?>">Itinerary</a></li>
                                    <li class="breadcrumb-item active">Masters Creation Edit</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content">
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                
                                <?php echo form_open_multipart(current_url() . '?' . $_SERVER['QUERY_STRING']); ?>
                                <div class="card-body row">

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Select Country</label>
                                            <?php
                                            $readonly = [];
                                            if ($this->session->userdata('admin_type') != 'superadmin' && $this->session->userdata('locations') != 'all') {
                                                $readonly = ['readonly' => 'readonly'];
                                            }
                                            echo form_input(['name' => 'country', 'id' => 'country', 'required' => 'required', 'class' => 'mdl-textfield__input', 'value' => $result->country] + $readonly) ?>
                                            <?php echo form_error('country'); ?>
                                        </div>
                                    </div>
                                    <input type="hidden" name="country_id" id="country_id"
                                        value="<?php echo $country_id; ?>">
                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">City</label>
                                            <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'mdl-textfield__input', 'value' => $result->city]); ?>
                                            <?php echo form_error('city'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                          <label class="mdl-textfield__label">Name</label>

                                            <?php echo form_input(['name' => 'name', 'id' => 'name', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => $result->site_name]); ?>
                                            <?php echo form_error('name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Category</label>
                                            <select name="category" class="mdl-textfield__input category"
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
                                            <?php echo form_error('category'); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 p-t-20 miscellaneous_cost" style="display:none;">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <span>With Cost
                                            <input type="radio" name="miscellaneous_cost" value="withcost" <?= ($result->miscellaneous_cost == 'withcost') ? 'checked' : ''; ?>></span>
                                            <span>Without Cost
                                            <input type="radio" name="miscellaneous_cost" value="withoutcost" <?= ($result->miscellaneous_cost == 'withoutcost') ? 'checked' : ''; ?>></span>
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
                                            <label class="mdl-textfield__label">Entry Ticket</label>
                                            <select name="entry_ticket" id="entryTicketSelect" class="mdl-textfield__input" style="padding-top:13px;">
                                                <option value=""></option>      
                                                <option value="yes" <?= ($result->entry_ticket == 'yes') ? 'selected="selected"' : ''; ?>>Yes</option>
                                                <option value="no" <?= ($result->entry_ticket == 'no') ? 'selected="selected"' : ''; ?>>No</option>
                                            </select>
                                            <?php echo form_error(''); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-t-20" id="ticketInputField" style="display: <?= ($result->entry_ticket == 'yes') ? 'inline-flex' : 'none'; ?>;">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Entry Ticket For</label>
                                            <input type="text" name="ticket_for" value="<?=$result->entry_ticket_for;?>" class="mdl-textfield__input" id="ticketNumber">
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
                                            <label class="mdl-textfield__label">Number of Persons (Group)</label>
                                            <input type="text" name="number_of_persons" value="<?=$result->number_of_persons;?>" class="mdl-textfield__input" id="PersonsNumber">
                                            </div>
                                        </div>
                                        <div class="col-lg-2 p-t-20" id="price" style="display:<?= ( $result->entry_ticket == 'yes') ? 'inline-flex' : 'none'; ?>;;">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" >
                                                <label class="mdl-textfield__label">Group Entry Fee</label>
                                                <input type="text" id="priceinput" name="price" class="mdl-textfield__input" value="<?=$result->group_entry_ticket_fee;?>">
                                            </div>
                                        </div>

                                    <div id="entry-fee-adult" class="col-lg-2 p-t-20" style="display: <?= ( $result->entry_ticket == 'yes') ? 'inline-flex' : 'none'; ?>;">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" >
                                                <label class="mdl-textfield__label">Per Person Adult Entry Fee</label>
                                                <input type="text" id="entry_fee" name="entry_fee" class="mdl-textfield__input"
                                                    value="<?=$result->entry_ticket_fee ;?>">
                                            </div>
                                    </div>
                                        
                                    <div class="child_age_div col-lg-2 p-t-20 mt-4" style="display:none">
                                        <?php 
                                            // $childCost = $this->db
                                            //     ->where('status', 'active')
                                            //     ->where('itinerary_id', $result->id)
                                            //     ->get('itinerary_child_age_cost')
                                            //     ->result();
                                        ?>
                                    <label>
                                        <input type="checkbox" name="age_option" value="1" id="withAge"
                                            <?= !empty($result->itinerary_child_age_status) && $result->itinerary_child_age_status == 1 ? 'checked' : '' ?>> With Age
                                    </label>

                                    <label>
                                        <input type="checkbox" name="age_option" value="0" id="withoutAge"
                                            <?= empty($result->itinerary_child_age_status) || $result->itinerary_child_age_status == 0 ? 'checked' : '' ?>> Without Age
                                    </label>
                                    </div>
                                    <div class="entryModals col-lg-2 p-t-20" id="entryModals" style="display:none">
                                       <button type="button" class="btn btn-info" id="" data-bs-toggle="modal" data-bs-target="#childAgeModal">
                                            Add
                                        </button>
                                    </div>

                                    <div id="entry-fee-child" class="entry-fee-child col-lg-2 p-t-20" style="display: <?= ( $result->entry_ticket == 'yes') ? 'inline-flex' : 'none'; ?>;">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" >
                                            <label class="mdl-textfield__label" style="">Per Person Child Entry Fee</label>
                                            <input type="text" id="child_entry_fee" name="child_entry_fee" class="mdl-textfield__input"
                                                value="<?=$result->child_entry_ticket_fee;?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-1 p-t-20 mt-4">
                                        <a href="#" id="add-entrance" data-toggle="modal" data-target="#addentrance"><i title="Add Entrance" class="fa fa-plus edit-add"></i>&nbsp;Add Entrance
                                        </a>
                                    </div>
                                    <div class="col-lg-1 p-t-20 mt-4">
                                        <a href="#" id="add-activity" data-toggle="modal" data-target="#modalAdd"><i title="Add Activity" class="fa fa-plus edit-add"></i>&nbsp;Add Activity
                                        </a>
                                    </div>
                                    

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Departing Time From Hotel</label>
                                            <input type="time" id="departing_time" name="departing_time"
                                                class="mdl-textfield__input"
                                                value="<?php echo $result->departing_time_from_hotel; ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Duration</label>
                                            <input type="text" id="duration" name="duration"
                                                class="mdl-textfield__input" value="<?php echo $result->duration; ?>">
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
                                            <label class="mdl-textfield__label">Destination Type</label>
                                            <select id="destination_type" name="destination_type" class="mdl-textfield__input" style="padding-top:13px;">
                                                <option value="insidecity">Inside City</option>
                                                <option value="outsidecity" <?php echo (isset($location_ids[0]) && $location_ids[0]!=0)?'selected="selected"':''; ?>>Outside City</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Select Locations</label>
                                            <select name="location_ids[]" id="location_ids" class="mdl-textfield__input js-example-basic-multiple" multiple="" style="padding: 10px;">
                                                <?php foreach ($location_masters as $list) { ?>
                                                    <option data-country="<?= $list->country ?>" value="<?= $list->id ?>" <?php echo (in_array($list->id, $location_ids)) ? 'selected="selected"' : ''; ?>><?= $list->location ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php echo form_error('location_ids[]'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Create New Locations</label>
                                            <input type="text" id="new_location_ids" name="new_location_id"
                                                class="mdl-textfield__input"
                                                value="">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 p-t-20">
                                        <?php
                                            $season    = $result->season;
                                            $from_date = $result->closer_date_from;
                                            $to_date   = $result->closer_date_to;

                                            $from_date_value = !empty($from_date) ? date('Y-m-d', strtotime($from_date)) : '';
                                            $to_date_value   = !empty($to_date) ? date('Y-m-d', strtotime($to_date)) : '';
                                        ?>
                                        <!-- Checkboxes -->
                                        <label style="margin-right:15px;">
                                            <input type="radio" id="winterCheck" name="season" value="winter" <?php if ($season == 'winter') echo 'checked'; ?>> Winter
                                        </label>
                                        <label>
                                            <input type="radio" id="summerCheck" name="season" value="summer" <?php if ($season == 'summer') echo 'checked'; ?>> Summer
                                        </label>

                                            <!-- Winter Fields -->
                                            <div id="winterFields" style="display:<?= ($season == 'winter') ? 'block' : 'none' ?>; margin-top:10px;">
                                                <div class="row">
                                                    <div class="col-lg-6 p-t-5">
                                                        <label>Winter Closer From</label>
                                                        <div class="input-container">
                                                            <!-- Visible formatted field -->
                                                            <input type="text" 
                                                                class="input inputdate mdl-textfield__input dt-search-show" 
                                                                data-group="winter"
                                                                value="<?= ($season == 'winter' && $from_date_value) ? date('d-M-Y', strtotime($from_date_value)) : '' ?>" 
                                                                readonly>
                                                            <!-- Actual date input -->
                                                            <input type="date" 
                                                                name="winter_from" 
                                                                class="dt-search date_from" 
                                                                data-group="winter"
                                                                value="<?= ($season == 'winter') ? $from_date_value : '' ?>" 
                                                                style="width:17px;float:right;position: absolute;right: 10px;bottom: 5px;">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 p-t-5">
                                                        <label>Winter Closer To</label>
                                                        <div class="input-container">
                                                            <input type="text" 
                                                                class="input inputdate mdl-textfield__input dt-search-show" 
                                                                data-group="winter"
                                                                value="<?= ($season == 'winter' && $to_date_value) ? date('d-M-Y', strtotime($to_date_value)) : '' ?>" 
                                                                readonly>
                                                            <input type="date" 
                                                                name="winter_to" 
                                                                class="dt-search date_to" 
                                                                data-group="winter"
                                                                value="<?= ($season == 'winter') ? $to_date_value : '' ?>" 
                                                                style="width:17px;float:right;position: absolute;right: 10px;bottom: 5px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Summer Fields -->
                                            <div id="summerFields" style="display:<?= ($season == 'summer') ? 'block' : 'none' ?>; margin-top:10px;">
                                                <div class="row">
                                                    <div class="col-lg-6 p-t-5">
                                                        <label>Summer Closer From</label>
                                                        <div class="input-container">
                                                            <input type="text" 
                                                                class="input inputdate mdl-textfield__input dt-search-show" 
                                                                data-group="summer"
                                                                value="<?= ($season == 'summer' && $from_date_value) ? date('d-M-Y', strtotime($from_date_value)) : '' ?>" 
                                                                readonly>
                                                            <input type="date" 
                                                                name="summer_from" 
                                                                class="dt-search date_from" 
                                                                data-group="summer"
                                                                value="<?= ($season == 'summer') ? $from_date_value : '' ?>" 
                                                                style="width:17px;float:right;position: absolute;right: 10px;bottom: 5px;">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 p-t-5">
                                                        <label>Summer Closer To</label>
                                                        <div class="input-container">
                                                            <input type="text" 
                                                                class="input inputdate mdl-textfield__input dt-search-show" 
                                                                data-group="summer"
                                                                value="<?= ($season == 'summer' && $to_date_value) ? date('d-M-Y', strtotime($to_date_value)) : '' ?>" 
                                                                readonly>
                                                            <input type="date" 
                                                                name="summer_to" 
                                                                class="dt-search date_to" 
                                                                data-group="summer"
                                                                value="<?= ($season == 'summer') ? $to_date_value : '' ?>" 
                                                                style="width:17px;float:right;position: absolute;right: 10px;bottom: 5px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                    </div>
                                    <div class="col-lg-4 p-t-20">
                                        <label style="font-weight:600;">Outside City Cost</label><br>
                                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="out_city_yes">
                                            <input type="radio" id="out_city_yes" name="out_city_cost" value="yes"
                                                class="mdl-radio__button" <?php echo ($result->outcity_cost === 'yes') ? 'checked' : ''; ?>>
                                            <span class="mdl-radio__label">Yes</span>
                                        </label>

                                        &nbsp;&nbsp;

                                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="out_city_no">
                                            <input type="radio" id="out_city_no" name="out_city_cost" value="no"
                                                class="mdl-radio__button" <?php echo ($result->outcity_cost === 'no') ? 'checked' : ''; ?> >
                                            <span class="mdl-radio__label">No</span>
                                        </label>
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
                                                <label class="mdl-textfield__label">Remarks</label>
                                                <textarea class="form-control txt_remarks" name="edit_remarks[]"
                                                    class="remarks_editor"
                                                    id="remarks_<?php echo $list->id; ?>"><?php echo $list->remarks; ?></textarea>

                                                <input type="hidden" id="" name="edit_id_remarks[]"
                                                    value="<?php echo $list->id; ?>" class="mdl-textfield__input">
                                            </div>
                                            <script>
                                                CKEDITOR.replace('remarks');
                                            </script>
                                            <i title="Remove" class="fa fa-window-close edit-remove"
                                                style="color:red;cursor: pointer;float: right;margin-top: -15px;position:relative;"
                                                data-id="<?= $list->id ?>"></i>
                                        </div>
                                    <?php } ?>

                                    <div class="col-lg-4 p-t-20" id="">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Remarks</label>
                                            <textarea class="form-control txt_remarks" name="remarks[]"
                                                id="remarks"></textarea>
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
                                        <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-info', 'value' => 'Submit']); ?>
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
                                        <?php $countryToCurrency = ['Azerbaijan' => 'Manat', 'Belarus' => 'Ruble', 'Georgia' => 'Lari', 'India' => 'INR', 'Kazakhstan' => 'Tenge', 'Uzbekistan' => 'Uzbekistan Som', 'Armenia' => 'Armenian dram']; ?>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'sites_id', 'id' => 'sites_id', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => $result->id]) ?>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'currency', 'id' => 'currency', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => isset($result->country) && array_key_exists($result->country, $countryToCurrency) ? $countryToCurrency[$result->country] : 'Currency not found']) ?>
                                       
                                    <div id="add-rows">
                                        <div class="row input-fields m-1" id="input-fields" style="row-gap: 15px;background-color: #f0f0f0ba;padding: 20px;border: solid 1px #ccc;margin: 10px;">
                                            <div class="col-lg-3">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label"><b>Activity</b></label>
                                                    <?php echo form_input(['type' => 'text', 'name' => 'activity[]', 'id' => 'activity', 'class' => 'mdl-textfield__input', 'value' => '', 'required' => 'required']); ?>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 activity_number_of_persons_div"  >
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label"><b>No. of Persons (Group)</b></label>
                                                <input type="text" name="activity_number_of_persons[]" value="0" class="mdl-textfield__input" id="activity_number_of_persons">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 activity_price_div" >
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" >
                                                    <label class="mdl-textfield__label"><b>Group Price</b></label>
                                                    <input type="text" id="activity_price" name="activity_Perprice[]" value="0" class="mdl-textfield__input">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 activity_Perprice_div" style="display: inline-flex ;gap:15px; align-items: start; flex-wrap: nowrap;">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="flex: 1; min-width: 45%;">
                                                    <label class="mdl-textfield__label"><b>Per Person Adult Price</b></label>
                                                    <input type="text" id="activity_price" name="activity_price[]" value="0" class="mdl-textfield__input">
                                                </div>
                                            </div>

                                            <div class="col-lg-3 child-price-container">
                                                <div class="m-b-10">
                                                    <label>Child Ticket Type</label><br>
                                                    <label>
                                                        <input type="radio" name="child_age_type[1]" value="yes" class="child-age-radio-activity">
                                                        With Age
                                                    </label>
                                                    <label style="margin-left:15px;">
                                                        <input type="radio" name="child_age_type[1]" value="no" class="child-age-radio-activity" checked>
                                                        Without Age
                                                    </label>
                                                </div>
                                               
                                            </div>
                                             <div class="activity_Perprice_div1 col-lg-3">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label"><b>Per Person Child Price</b></label>
                                                    <input type="text" name="child_activity_price[]" class="mdl-textfield__input">
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label"><b>Type</b></label>
                                                    <select name="activity_type[]" id="activity_type" class="mdl-textfield__input mt-2" required>
                                                        <option value="">Select..</option>
                                                        <option value="all">All</option>
                                                        <option value="summer">Summer</option>
                                                        <option value="winter">Winter</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2" style="display:inline-flex;">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label"><b>Currency</b></label>
                                                    <label class="currency custom-label-2">
                                                        <?php echo isset($result->country) && array_key_exists($result->country, $countryToCurrency) ? $countryToCurrency[$result->country] : 'Currency not found'; ?>
                                                    </label>
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
                                        <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-info', 'value' => 'Submit']); ?>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal fade" id="addentrance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="min-width:1280px !important;">
                        <div class="modal-content">
    
                            <div class="modal-header">
                                <h4 class="modal-title" id="country">Add Entrance</h4>
                                <button type="button" class="close" data-dismiss="modal" id="close-modal">&times;</button>
                            </div>
                            <div id="response-msg-entrance" class="text-center"></div>
                            <div class="modal-body">
                                <form enctype="multipart/form-data" id="add-entrance-cost">
                                    <?php $countryToCurrency = ['Azerbaijan' => 'Manat', 'Belarus' => 'Ruble', 'Georgia' => 'Lari', 'India' => 'INR', 'Kazakhstan' => 'Tenge', 'Uzbekistan' => 'Uzbekistan Som', 'Armenia' => 'Armenian dram']; ?>
                                    <?php echo form_input(['type' => 'hidden', 'name' => 'sites_id', 'id' => 'entrance_sites_id', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => $result->id]) ?>
                                    <?php echo form_input(['type' => 'hidden', 'name' => 'currency', 'id' => 'entrance_currency', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => isset($result->country) && array_key_exists($result->country, $countryToCurrency) ? $countryToCurrency[$result->country] : 'not found']) ?>
    
                                    <div id="add-entrance-rows">
                                        <div class="row input-fields" id="entrance-input-fields" style="row-gap:15px;background-color: #f0f0f0ba;padding: 20px;border: solid 1px #ccc;margin: 10px;">
                                            <div class="col-lg-3">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label"><b>Entrance</b></label>
                                                    <?php echo form_input(['type' => 'text', 'name' => 'entrance_name[]', 'id' => 'entrance_name', 'class' => 'mdl-textfield__input entrance_name', 'value' => '', 'required' => 'required']); ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 entrance_number_of_persons_div">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label"><b>No. of Persons (Group)</b></label>
                                                    <input type="text" name="entrance_number_of_persons[]" value="0" class="mdl-textfield__input" id="entrance_number_of_persons">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 entrance_price_div">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label"><b>Group Price</b></label>
                                                    <input type="text" id="entrance_group_price" name="entrance_group_price[]" value="0" class="mdl-textfield__input">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 entrance_perprice_div" style="display: inline-flex ;gap:15px; align-items: start; flex-wrap: nowrap;">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="flex: 1; min-width: 45%;">
                                                    <label class="mdl-textfield__label"><b>Per Person Adult Price</b></label>
                                                    <input type="text" id="entrance_adult_price" name="entrance_adult_price[]" value="0" class="mdl-textfield__input">
                                                </div>
                                            </div>

                                            <!-- Child price section -->
                                            <div class="col-lg-3 child-price-container">
                                                <div class="m-b-10">
                                                    <label style="font-weight:700;">Child Ticket Type</label><br>
                                                    <label>
                                                        <input type="radio" name="child_age_type[1]" value="yes" class="child-age-radio">
                                                        With Age
                                                    </label>
                                                    <label style="margin-left:15px;">
                                                        <input type="radio" name="child_age_type[1]" value="no" class="child-age-radio" checked>
                                                        Without Age
                                                    </label>
                                                </div>

                                                
                                                <!-- <div class="child-age-btn" style="display:none;">
                                                    <button type="button" class="btn btn-primary add-age-btn" data-row-index="0">Add Age Price</button>
                                                </div> -->
                                            </div>
                                            <div class="col-lg-3 child-simple-price"style="display:block;">
                                                <div class="" >
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <label class="mdl-textfield__label"><b>Per Person Child Price</b></label>
                                                        <input type="text" name="entrance_child_price[]" value="0" class="mdl-textfield__input child-price-input">
                                                    </div>
                                                </div>
                                            </div>

                                           
                                            <!-- <div class="col-lg-2 entrance_perprice_div1" style="display: inline-flex ;gap:15px; align-items: center; flex-wrap: nowrap;">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="flex: 1; min-width: 45%;">
                                                    <label class="mdl-textfield__label"><b>Per Person Child Price</b></label>
                                                    <input type="text" id="entrance_child_price" value="0" name="entrance_child_price[]" class="mdl-textfield__input">
                                                </div>
                                            </div> -->
    
                                            <div class="col-lg-3">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label"><b>Type</b></label>
                                                    <select name="entrance_type[]" id="entrance_type" class="mdl-textfield__input mt-2" required>
                                                        <option value="">Select..</option>
                                                        <option value="all">All</option>
                                                        <option value="summer">Summer</option>
                                                        <option value="winter">Winter</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3" style="display:inline-flex;">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label"><b>Currency</b></label>
                                                    <label class="currency custom-label-2">
                                                        <?php echo isset($result->country) && array_key_exists($result->country, $countryToCurrency) ? $countryToCurrency[$result->country] : 'Currency not found'; ?>
                                                    </label>
                                                </div>
                                                <a href="javascript:void(0);" data-id="" class="remove-entrance mt-4"><i title="Remove" class="fa fa-window-close edit-add"></i></a>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="offset-10 col-lg-2 pt-3">
                                        <a href="#" id="add-more-entrance"><i title="Add Entrance" class="fa fa-plus edit-add"></i>&nbsp;Add More Entrance
                                        </a>
                                    </div>
    
                                    <div class="col-lg-12 p-t-20 text-center p-0">
                                        <?php echo form_submit(['name' => 'submit_entrance', 'id' => 'submit_entrance', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-info', 'value' => 'Submit']); ?>
                                    </div>
    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
     </div>
</div>
<!-- Modal -->
<div class="modal fade" id="childAgeModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="childAgeForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Child Age & Amount</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div id="formError" class="text-danger ms-3 mb-2" style="display: none;"></div>

          <input type="hidden" name="itinerary_id" value="<?= $this->input->get('id'); ?>">

          <div class="form-row">
            <div class="form-group col-md-3 ms-3">
              <label>Child Age From</label>
              <input type="number" name="agefrom" class="form-control" required>
            </div>
             <div class="form-group col-md-3 ms-3">
              <label>Child Age To</label>
              <input type="number" name="ageto" class="form-control" required>
            </div>
            <div class="form-group col-md-3 ms-3">
              <label>Entry Fee</label>
              <input type="text" name="amount" class="form-control" required>
            </div>
          </div>
        
          <button type="submit" class="btn btn-info mb-3 text-center ms-3">Submit</button>
          <hr>

          <!-- <h6>Submitted Entries</h6> -->
          <div class="table-responsive">
            <table class="table table-bordered" id="childAgeTable">
              <thead>
                <tr>
                  <th>S No.</th>
                  <th>Child Age From</th>
                  <th>Child Age To</th>
                  <th>Entry Fee</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- Fetched by JS -->
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </form>
  </div>
</div>

<!-- Custom Popup for Child Age entrance Pricing -->
<div id="customAgePricePopup" class="custom-popup-overlay" style="display: none;">
    <div class="custom-popup-container">
        <div class="custom-popup-header">
            <h4 id="modalTitle">Child Age Pricing</h4>
            <button type="button" class="close-popup popup-cross1">&times;</button>
        </div>
        <div class="custom-popup-body">
            <div id="ageMsg" class="alert alert-info" style="display: none;"></div>

            <input type="hidden" id="class_type">
            <input type="hidden" id="current_site_id"> 
            <input type="hidden" id="current_entrance_id"> 
            <input type="hidden" id="age_price_id"> 

            <div class="row mb-3">
                <div class="col-md-3">
                    <input type="text" id="from_age" class="form-control" placeholder="From Age">
                </div>
                <div class="col-md-3">
                    <input type="text" id="to_age" class="form-control" placeholder="To Age">
                </div>
                <div class="col-md-3">
                    <input type="text" id="age_price" class="form-control" placeholder="Price">
                </div>
                <div class="col-md-3">
                    <button class="btn btn-success w-100" id="saveAgePrice">Save</button>
                </div>
            </div>

            <hr>

            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>From</th>
                        <th>To</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="agePriceList"></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Custom Popup for Child Age entrance Pricing -->
<div id="customAgePricePopup1" class="custom-popup-overlay1" style="display: none;">
    <div class="custom-popup-container1">
        <div class="custom-popup-header1">
            <h4 id="modalTitle">Child Age Pricing</h4>
            <button type="button" class="close-popup popup-cross">&times;</button>
        </div>
        <div class="custom-popup-body1">
            <div id="ageMsgActivity" class="alert alert-info" style="display: none;"></div>

            <input type="hidden" id="class_type">
            <input type="hidden" id="current_site_id_activity"> 
            <input type="hidden" id="current_activity_id"> 
            <input type="hidden" id="age_price_id_activity"> 

            <div class="row mb-3">
                <div class="col-md-3">
                    <input type="text" id="from_age_activity" class="form-control" placeholder="From Age">
                </div>
                <div class="col-md-3">
                    <input type="text" id="to_age_activity" class="form-control" placeholder="To Age">
                </div>
                <div class="col-md-3">
                    <input type="text" id="age_price_activity" class="form-control" placeholder="Price">
                </div>
                <div class="col-md-3">
                    <button class="btn btn-success w-100" id="saveAgePriceActivity">Save</button>
                </div>
            </div>

            <hr>

            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>From</th>
                        <th>To</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="agePriceListActivity"></tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
       
        $('.category').on('change', function() {
            category_change();
        });

        category_change();

        function category_change()
        {
            if($(".category").val() == "miscellaneous"){
                $(".miscellaneous_cost").show();
            }
        }
        
        function formatDate(val) {
            if (!val) return "";
            let date = new Date(val);
            if (isNaN(date)) return "";
            return date.toLocaleDateString("en-GB", {
                day: "2-digit",
                month: "short",
                year: "numeric"
            }).replace(/ /g, "-"); // 25-Aug-2025
        }

        function updateDisplay($input, type) {
            const group = $input.data("group"); // e.g., winter, summer
            const $fromInput = $(`.date_from[data-group='${group}']`);
            const $toInput = $(`.date_to[data-group='${group}']`);
            const $fromShow = $(`.dt-search-show[data-group='${group}']`).eq(0);
            const $toShow = $(`.dt-search-show[data-group='${group}']`).eq(1);

            const fromVal = $fromInput.val();
            const toVal = $toInput.val();

            const fromDate = fromVal ? new Date(fromVal) : null;
            const toDate = toVal ? new Date(toVal) : null;

            const formattedDate = formatDate($input.val());

            if (type === "from") {
                $fromShow.val(formattedDate).parent().addClass("is-focused");
                if (!toVal) {
                    $toInput.attr("min", $input.val());
                } else if (fromDate && toDate && fromDate > toDate) {
                    $toInput.val("").attr("min", $input.val());
                    $toShow.val("");
                }
            } else {
                $toShow.val(formattedDate).parent().addClass("is-focused");
                if (!fromVal) {
                    $fromInput.attr("max", $input.val());
                } else if (fromDate && toDate && fromDate > toDate) {
                    $fromInput.val("").attr("max", $input.val());
                    $fromShow.val("");
                }
            }
        }

        // On change
        $(".dt-search").on("change", function () {
            const $this = $(this);
            const type = $this.hasClass("date_from") ? "from" : "to";
            updateDisplay($this, type);
        });

        // Run once on page load for pre-filled values
        $(".dt-search.date_from").each(function () {
            if ($(this).val()) updateDisplay($(this), "from");
        });
        $(".dt-search.date_to").each(function () {
            if ($(this).val()) updateDisplay($(this), "to");
        });
    });
</script>
<script>
    document.getElementById("winterCheck").addEventListener("change", function() {
        if(this.checked) {
            document.getElementById("winterFields").style.display = "block";
            document.getElementById("summerFields").style.display = "none";
            document.getElementById("summerCheck").checked = false;
        } else {
            document.getElementById("winterFields").style.display = "none";
        }
    });

    document.getElementById("summerCheck").addEventListener("change", function() {
        if(this.checked) {
            document.getElementById("summerFields").style.display = "block";
            document.getElementById("winterFields").style.display = "none";
            document.getElementById("winterCheck").checked = false;
        } else {
            document.getElementById("summerFields").style.display = "none";
        }
    });
</script>
<script>
    $(document).ready(function() {

        $('#withAge').on('change', function () {
            if ($(this).is(':checked')) {
                $('#withoutAge').prop('checked', false);
                $('#entryModals').show();
                $('.entry-fee-child').hide();
            } else {
                // Re-check Without Age when With Age is unchecked
                $('#withoutAge').prop('checked', true).trigger('change');
            }
        });

        // On Without Age checkbox
        $('#withoutAge').on('change', function () {
            if ($(this).is(':checked')) {
                $('#withAge').prop('checked', false);
                $('#entryModals').hide();
                $('.entry-fee-child').show();
            } else {
                // Re-check With Age when Without Age is unchecked
                $('#withAge').prop('checked', true).trigger('change');
            }
        });

        // Trigger once on load to apply default state
        $('#withoutAge').trigger('change');

        $('#childAgeForm').submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: "<?= base_url('admin/masters/add_child_age_cost?id=' . $this->input->get('id')) ?>",
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (res) {

                    if (res.status) {

                        $('#formError')
                            .removeClass('text-danger')
                            .addClass('text-success')
                            .text(res.message)
                            .show();

                        $('#childAgeForm')[0].reset();

                        fetchTableData();  // ✅ Immediately refresh table
                    } 
                    else {
                        $('#formError')
                            .removeClass('text-success')
                            .addClass('text-danger')
                            .text(res.message || "Something went wrong!")
                            .show();
                    }
                }
            });
        });


        function fetchTableData() {
            $.ajax({
                url: "<?= base_url('admin/masters/fetch_child_age_list?id=' . $this->input->get('id')) ?>",
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    let rows = '';
                    var id = 1;  
                    if (data.length > 0) {
                        data.forEach(function (row) {
                            rows += `<tr>
                                        <td>${id++}</td>
                                        <td>${row.agefrom}</td>
                                        <td>${row.ageto}</td>
                                        <td>${row.amount}</td>
                                        <td> 
                                            <button class="btn btn-danger btn-sm delete-entry" data-id="${row.id}">Delete</button>
                                        </td>
                                    </tr>`;
                        });
                    } else {
                        rows = '<tr><td colspan="3" class="text-center">No records found</td></tr>';
                    }
                    $('#childAgeTable tbody').html(rows);
                }
            });
        }

        $(document).on('click', '.delete-entry', function () {
            let entryId = $(this).data('id');

            if (confirm("Are you sure you want to delete this entry?")) {
                $.ajax({
                    url: '<?= base_url("admin/masters/delete_child_age_status") ?>',
                    method: 'POST',
                    data: { id: entryId },
                    dataType: 'json',
                    success: function (res) {
                        if (res.status) {
                            // alert("Entry marked as inactive.");
                            fetchTableData(); // Refresh table
                        } else {
                            alert("Failed to delete entry.");
                        }
                    }
                });
            }
        });


        // Call this function when modal opens
        $('#childAgeModal').on('shown.bs.modal', function () {
            fetchTableData();
        });



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

        // $(document).on('click', '.close', function(e) {
        //     location.reload();
        // });


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
                // let index1 = 1;
                $.each(cost, function(index, item) {
                    // index1++;
                    let isPerPerson = item.ticket_type === 'per_person';
                    let isGroup = item.ticket_type === 'group';

                    var row = `
                    <div class="row input-fields" id="input-fields" style="row-gap: 15px;background-color: #f0f0f0ba;padding: 20px;border: solid 1px #ccc;margin: 10px;">
                        <input type="hidden" name="id[]" value="${item.id || ''}" required>
                        
                        <div class="col-lg-3">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class="mdl-textfield__label"><b>Activity</b></label>
                                <input type="text" name="activity[]" class="mdl-textfield__input" value="${item.activity || ''}" required>
                                
                            </div>
                        </div>

                    <div class="col-lg-3 activity_number_of_persons_div" >
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <label class="mdl-textfield__label"><b>No. of Persons (Group)</b></label>
                                <input type="text" name="activity_number_of_persons[]" value="${item.number_of_persons || ''}" class="mdl-textfield__input">
                           
                            </div>
                        </div>

                        <div class="col-lg-3 activity_price_div" >
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class="mdl-textfield__label"><b>Group Price</b></label>
                                <input type="text" name="activity_Perprice[]" value="${item.group_price || ''}" class="mdl-textfield__input">
                                
                            </div>
                        </div>

                        <div class="col-lg-3 activity_Perprice_div" style="gap:15px; align-items: center; flex-wrap: nowrap;">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="flex: 1; min-width: 45%;">
                            <label class="mdl-textfield__label"><b>Per Person Adult Price</b></label>
                                <input type="text" name="activity_price[]" value="${item.price || ''}" class="mdl-textfield__input">
                                
                            </div>
                        </div>

                        <div class="col-lg-3 child-price-container">
                            <div class="m-b-10">
                                <label>Child Ticket Type</label><br>
                                <label>
                                    <input type="radio" name="child_age_type[${index + 1}]" value="yes" class="child-age-radio-activity" ${item.activity_child_age === 'yes' ? 'checked' : ''}>
                                    With Age
                                </label>
                                <label style="margin-left:15px;">
                                    <input type="radio" name="child_age_type[${index + 1}]" value="no" class="child-age-radio-activity" ${item.activity_child_age === 'no' ? 'checked' : ''}>
                                    Without Age
                                </label>
                            </div>
                           
                        </div>
                        <div class="col-lg-3">
                         <div class="activity_Perprice_div1" style="display: ${item.activity_child_age === 'yes' ? 'none' : 'block'};">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <label class="mdl-textfield__label"><b>Per Person Child Price</b></label>
                                    <input type="text" name="child_activity_price[]" class="mdl-textfield__input" value="${item.child_price || ''}">
                                </div>
                            </div>
                            <div class="child-age-btn-activity" style="display: ${item.activity_child_age === 'yes' ? 'block' : 'none'};">
                                <button type="button" class="btn btn-primary add-age-btn-activity" data-activity-id="${item.id}" data-site-id="${sites_id}" data-row-index="${index}">Add Age Price</button>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <label class="mdl-textfield__label"><b>Type</b></label>
                                <select name="activity_type[]" class="mdl-textfield__input mt-2" required>
                                    <option value="">Select..</option>
                                    <option value="all" ${item.activity_type === 'all' ? 'selected' : ''}>All</option>
                                    <option value="summer" ${item.activity_type === 'summer' ? 'selected' : ''}>Summer</option>
                                    <option value="winter" ${item.activity_type === 'winter' ? 'selected' : ''}>Winter</option>
                                </select>
                              
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width mt-2">
                            <label class="mdl-textfield__label"><b>Currency</b></label>
                                <label class="currency custom-label-2">${item.currency || 'Currency not found'}</label>
                            </div>
                            
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

        if ($('#entryTicketSelect').val() === 'yes') {
            $('.child_age_div').show();
        } else {
            $('.child_age_div').hide();
            $('.entryModals').hide();
            
        }
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
                // $('#entryModals').show();
                $('.child_age_div').show();
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
            $('.child_age_div').hide();
            $('#ticketInputField').hide();
            // $('#entryModals').hide();
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
            let rowCount = $('#add-rows .input-fields').length;
            let newIndex = rowCount + 1;
            newRow.find('input[type="radio"]').each(function() {
                let newName = $(this).attr('name').replace(/\[\d+\]/, '[' + newIndex + ']');
                $(this).attr('name', newName);
            });
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


    $(document).ready(function () {
        // For entrance modal - show/hide price fields based on ticket type
        $('#add-entrance-rows').on('change', '.entrance-ticket-type', function () {
            var selectedValue = $(this).val();
            var row = $(this).closest('.input-fields');

            if (selectedValue === 'per_person') {
                row.find('.entrance_perprice_div, .entrance_perprice_div1').show();
                row.find('.entrance_price_div, .entrance_number_of_persons_div').hide().find("input").val("");
            } else if (selectedValue === 'group') {
                row.find('.entrance_number_of_persons_div, .entrance_price_div').show();
                row.find('.entrance_perprice_div, .entrance_perprice_div1').hide();
            } else {
                row.find('.entrance_perprice_div, .entrance_perprice_div1, .entrance_price_div, .entrance_number_of_persons_div').hide().find("input").val("");
            }
        });

        $('#add-entrance').on('click', function(e) {
                e.preventDefault();
                var sites_id = $('#sites_id').val()
                fetchEntranceCost(sites_id);
            });
        // Add more entrance rows
        $('#add-more-entrance').on('click', function (e) {
            e.preventDefault();

            let newRow = $('#add-entrance-rows .input-fields').first().clone();
            let rowCount = $('#add-entrance-rows .input-fields').length;
            let newIndex = rowCount + 1;
            newRow.find('input[type="radio"]').each(function() {
                let newName = $(this).attr('name').replace(/\[\d+\]/, '[' + newIndex + ']');
                $(this).attr('name', newName);
            });
            newRow.find('input, select').val('');
            newRow.find('[id]').each(function() {
                $(this).removeAttr('id');
            });
            newRow.appendTo('#add-entrance-rows');
        });

        // Remove entrance row
        $('#add-entrance-rows').on('click', '.remove-entrance', function () {
            $(this).closest('.input-fields').remove();
        });

        // Form submission for entrance
        $('#add-entrance-cost').on('submit', function(e) {
            e.preventDefault();

            var sites_id = $('#entrance_sites_id').val()
            var formData = new FormData(this);

            // AJAX request
            $.ajax({
                url: "<?php echo site_url('add-entrance-cost'); ?>",
                type: 'POST',
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#response-msg-entrance').html(response.msg)
                    $('#add-entrance-cost')[0].reset();
                    fetchEntranceCost(sites_id);
                    // Optionally close modal after success
                    setTimeout(function() {
                        $('#addentrance').modal('hide');
                    }, 1500);
                },
                error: function(xhr, status, error) {
                    alert('Failed to add entrance cost.');
                }
            });
        });

        // Function to fetch entrance costs
        function fetchEntranceCost(sites_id) {
            $.ajax({
                url: 'admin/masters/entrance_costing', // Update with your entrance endpoint
                type: 'POST',
                data: {
                    id: sites_id
                },
                dataType: "json",
                success: function(response) {
                    if (response && response.cost.length > 0) {
                        let cost = response.cost;
                        var addRows = $('#add-entrance-rows');
                        addRows.empty();
                        $.each(cost, function(index, item) {
                            let isPerPerson = item.ticket_type === 'per_person';
                            let isGroup = item.ticket_type === 'group';

                            // Determine radio checked state and visibility
                            let hasAge = item.has_age_pricing;
                            let childPriceDisplay = hasAge ? 'none' : 'block';
                            let ageBtnDisplay = hasAge ? 'block' : 'none';
                            let radioYesChecked = hasAge ? 'checked' : '';
                            let radioNoChecked = !hasAge ? 'checked' : '';

                            var row = `
                            <div class="row input-fields " id="entrance-input-fields" data-row-index="${index}" data-entrance-id="${item.id || ''}" style="row-gap: 15px;background-color: #f0f0f0ba;padding: 20px;border: solid 1px #ccc;margin: 10px;">
                                <input type="hidden" name="id[]" value="${item.id || ''}" required>
                                
                                <div class="col-lg-3">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <label class="mdl-textfield__label"><b>Entrance</b></label>
                                        <input type="text" name="entrance_name[]" class="mdl-textfield__input entrance_name" value="${item.entrance_name || ''}" required>
                                        
                                    </div>
                                </div>

                                <div class="col-lg-3 entrance_number_of_persons_div">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <label class="mdl-textfield__label"><b>No. of Persons (Group)</b></label>
                                        <input type="text" name="entrance_number_of_persons[]" value="${item.number_of_persons || ''}" class="mdl-textfield__input">
                                        
                                    </div>
                                </div>

                                <div class="col-lg-3 entrance_price_div">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <label class="mdl-textfield__label"><b>Group Price</b></label>
                                        <input type="text" name="entrance_group_price[]" value="${item.group_price || ''}" class="mdl-textfield__input">
                                        
                                    </div>
                                </div>

                                <div class="col-lg-3 entrance_perprice_div" style="gap:15px; align-items: center; flex-wrap: nowrap;">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="flex: 1; min-width: 45%;">
                                    <label class="mdl-textfield__label"><b>Per Person Adult Price</b></label>
                                        <input type="text" name="entrance_adult_price[]" value="${item.adult_price || ''}" class="mdl-textfield__input">
                                        
                                    </div>
                                </div>
                                <div class="col-lg-3 child-price-container">
                                    <div class="m-b-10">
                                        <label>Child Ticket Type</label><br>
                                        <label>
                                            <input type="radio" name="child_age_type[${index + 1}]" value="yes" class="child-age-radio" ${item.entrance_child_age === 'yes' ? 'checked' : ''}>
                                            With Age
                                        </label>
                                        <label style="margin-left:15px;">
                                            <input type="radio" name="child_age_type[${index + 1}]" value="no" class="child-age-radio" ${item.entrance_child_age === 'no' ? 'checked' : ''}>
                                            Without Age
                                        </label>
                                    </div>
                                    
                                   
                                </div>
                                <div class="col-lg-3 child-simple-price" style="display: ${item.entrance_child_age === 'yes' ? 'none' : 'block'};">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label"><b>Per Person Child Price</b></label>
                                            <input type="text" name="entrance_child_price[]" class="mdl-textfield__input" value="${item.child_price || ''}">
                                        </div>
                                    </div>
                                <div class="col-lg-3 child-age-btn" style="display: ${item.entrance_child_age === 'yes' ? 'block' : 'none'};">
                                        <button type="button" class="btn btn-primary add-age-btn" data-entrance-id="${item.id}" data-site-id="${sites_id}" data-row-index="${index}">Add Age Price</button>
                                    </div>
                                
                                <div class="col-lg-3">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <label class="mdl-textfield__label"><b>Type</b></label>
                                        <select name="entrance_type[]" class="mdl-textfield__input mt-2" required>
                                            <option value="">Select..</option>
                                            <option value="all" ${item.entrance_type === 'all' ? 'selected' : ''}>All</option>
                                            <option value="summer" ${item.entrance_type === 'summer' ? 'selected' : ''}>Summer</option>
                                            <option value="winter" ${item.entrance_type === 'winter' ? 'selected' : ''}>Winter</option>
                                        </select>
                                    
                                    </div>
                                </div>

                                <div class="col-lg-2" style="display:inline-flex;">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width mt-2">
                                    <label class="mdl-textfield__label"><b>Currency</b></label>
                                        <label class="currency custom-label-2">${item.currency || 'Currency not found'}</label>
                                    </div>
                                    
                                    <a href="#" data-id="${item.id || ''}" class="remove-entrance mt-4">
                                        <i title="Remove" class="fa fa-window-close edit-add"></i>
                                    </a>
                                </div>
                            </div>`;

                            addRows.append(row);
                        });

                        // Attach event listener to entrance ticket type dropdowns
                        $('.entrance-ticket-type').on('change', function() {
                            var parentRow = $(this).closest('.row');
                            var selectedType = $(this).val();

                            if (selectedType === 'per_person') {
                                parentRow.find('.entrance_perprice_div, .entrance_perprice_div1').show();
                                parentRow.find('.entrance_number_of_persons_div, .entrance_price_div').hide();
                            } else if (selectedType === 'group') {
                                parentRow.find('.entrance_perprice_div, .entrance_perprice_div1').hide();
                                parentRow.find('.entrance_number_of_persons_div, .entrance_price_div').show();
                            }
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    alert('Failed to fetch entrance cost details.');
                }
            });
        }

        $(document).on('click', '.remove-entrance', function(e) {
            var id = $(this).data('id');
            e.preventDefault();
            deleteEntranceCosts(id)
            $(this).closest('.row').remove();
        });

        function deleteEntranceCosts(id) {
            $.ajax({
                url: "<?php echo site_url('admin/masters/delete_entrance_costs'); ?>",
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
    });
</script>

<!-- code start here for creating child age wise master -->
<script>
    $(document).ready(function() {

        // Show / hide custom popup
        function showCustomPopup() {
            const popup = $('#customAgePricePopup');

            // Move inside modal
            if (!popup.parent().is('#addentrance .modal-content')) {
                $('#addentrance .modal-content').append(popup);
            }

            popup.fadeIn(function() {
                $('#from_ages').focus();
            });
        }

        function hideCustomPopup() {
            $('#customAgePricePopup').fadeOut();

            $('#age_price_id').val('');
            $('#from_ages').val('');
            $('#to_ages').val('');
            $('#age_prices').val('');
            $('#saveAgePrice').text('Save');
        }

        // Close popup on button click or overlay click
        $(document).on('click', '.close-popup, .custom-popup-overlay', function(e) {
            // Prevent closing when clicking inside the popup container
            if ($(e.target).closest('.custom-popup-container').length === 0 || $(e.target).hasClass('close-popup')) {
                hideCustomPopup();
            }
        });

        // Child age radio change (unchanged)
        $(document).on('change', '.child-age-radio', function() {
            const row = $(this).closest('.input-fields');
            const isWithAge = $(this).val() === 'yes';

            if (isWithAge) {
                row.find('.child-simple-price').hide();
                row.find('.child-age-btn').show();
            } else {
                row.find('.child-simple-price').show();
                row.find('.child-age-btn').hide();
            }
        });

        let currentRowIndex = null;

        // Add age button click – now opens custom popup
        $(document).on('click', '.add-age-btn', function() {
            const row = $(this).closest('.input-fields');
            const entranceId = $(this).data('entrance-id');
            const siteId = $(this).data('site-id');
            currentRowIndex = $(this).data('row-index');

            if (!entranceId) {
                alert('Please save the entrance first before adding age pricing.');
                return;
            }

            $('#current_site_id').val(siteId);
            $('#current_entrance_id').val(entranceId);
            $('#modalTitle').text('Child Age Pricing for ' + row.find('.entrance_name').val());
            loadAgePriceList();

            // Show custom popup instead of Bootstrap modal
            showCustomPopup();
        });

        function loadAgePriceList() {
            $('#agePriceList').html('<tr><td colspan="4">Loading...</td></tr>');

            $.ajax({
                url: 'admin/masters/get_child_age_prices',
                type: 'POST',
                data: {
                    site_id: $('#current_site_id').val(),
                    entrance_id: $('#current_entrance_id').val()
                },
                success: function(res) {
                    $('#agePriceList').html(res);
                }
            });
        }

        $('#saveAgePrice').click(function() {
            const id = $('#age_price_id').val();
            const url = id ? 'admin/masters/update_child_age_price' : 'admin/masters/save_child_age_price';

            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: {
                    id: id,
                    site_id: $('#current_site_id').val(),
                    entrance_id: $('#current_entrance_id').val(),
                    from_age: $('#from_age').val(),
                    to_age: $('#to_age').val(),
                    price: $('#age_price').val()
                },
                success: function(response) {
                    if (!response.status) {
                        showMessage(response.msg, 'danger');
                        return;
                    }

                    showMessage(id ? 'Updated successfully' : 'Added successfully');

                    $('#age_price_id').val('');
                    $('#from_ages').val('');
                    $('#to_ages').val('');
                    $('#age_prices').val('');
                    $('#saveAgePrice').text('Save');

                    setTimeout(() => {
                        loadAgePriceList();
                    }, 200);
                }
            });
        });

        $(document).on('click', '.editAge', function() {
            const id = $(this).data('id');
            $.ajax({
                url: 'admin/masters/get_single_age_price',
                type: 'POST',
                data: { id: id },
                success: function(res) {
                    const data = JSON.parse(res);
                    $('#age_price_id').val(data.id);
                    $('#from_age').val(data.age_from);
                    $('#to_age').val(data.age_to);
                    $('#age_price').val(data.price);
                    $('#saveAgePrice').text('Update');
                }
            });
        });

        $(document).on('click', '.deleteAge', function() {
            const id = $(this).data('id');
            if (confirm('Are you sure you want to deactivate this price?')) {
                $.post('admin/masters/delete_child_age_price', { id: id }, function() {
                    showMessage('Price deactivated successfully', 'danger');
                    loadAgePriceList();
                });
            }
        });

        function showMessage(msg, type = 'success') {
            $('#ageMsg').removeClass().addClass('alert alert-' + type).html(msg).fadeIn();
            setTimeout(() => $('#ageMsg').fadeOut(), 3000);
        }

    });
</script>

<!-- code start here for creating child age wise Activity price master -->
<script>
    $(document).ready(function() {

        // Show / hide custom popup
        function showCustomPopup1() {
            const popup = $('#customAgePricePopup1');

            // Move inside modal
            if (!popup.parent().is('#modalAdd .modal-content')) {
                $('#modalAdd .modal-content').append(popup);
            }

            popup.fadeIn(function() {
                $('#from_age_activity').focus();
            });
        }

        function hideCustomPopup1() {
            $('#customAgePricePopup1').fadeOut();

            $('#age_price_id_activity').val('');
            $('#from_age_activity').val('');
            $('#to_age_activity').val('');
            $('#age_price_activity').val('');
            $('#saveAgePriceActivity').text('Save');
        }

        // Close popup on button click or overlay click
        $(document).on('click', '.close-popup, .custom-popup-overlay1', function(e) {
            // Prevent closing when clicking inside the popup container
            if ($(e.target).closest('.custom-popup-container1').length === 0 || $(e.target).hasClass('close-popup')) {
                hideCustomPopup1();
            }
        });

        // Child age radio change (unchanged)
        $(document).on('change', '.child-age-radio-activity', function() {
            const row = $(this).closest('.input-fields');
            const isWithAge = $(this).val() === 'yes';

            if (isWithAge) {
                row.find('.activity_Perprice_div1').hide();
                row.find('.child-age-btn-activity').show();
            } else {
                row.find('.activity_Perprice_div1').show();
                row.find('.child-age-btn-activity').hide();
            }
        });

        let currentRowIndex = null;

        // Add age button click – now opens custom popup
        $(document).on('click', '.add-age-btn-activity', function() {
            const row = $(this).closest('.input-fields');
            const activityId = $(this).data('activity-id');
            const siteId = $(this).data('site-id');
            currentRowIndex = $(this).data('row-index');

            if (!activityId) {
                alert('Please save the entrance first before adding age pricing.');
                return;
            }

            $('#current_site_id_activity').val(siteId);
            $('#current_activity_id').val(activityId);
            // $('#modalTitle').text('Child Age Pricing for ' + row.find('.entrance_name').val());
            loadAgePriceListActivity();

            // Show custom popup instead of Bootstrap modal
            showCustomPopup1();
        });

        function loadAgePriceListActivity() {
            $('#agePriceListActivity').html('<tr><td colspan="4">Loading...</td></tr>');

            $.ajax({
                url: 'admin/masters/get_child_age_prices_activity',
                type: 'POST',
                data: {
                    site_id: $('#current_site_id_activity').val(),
                    activity_id: $('#current_activity_id').val()
                },
                success: function(res) {
                    $('#agePriceListActivity').html(res);
                }
            });
        }

        $('#saveAgePriceActivity').click(function() {
            const id = $('#age_price_id_activity').val();
            const url = id 
                ? 'admin/masters/update_child_age_price_activity' 
                : 'admin/masters/save_child_age_price_activity';

            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: {
                    id: id,
                    site_id: $('#current_site_id_activity').val(),
                    activity_id: $('#current_activity_id').val(),
                    from_age: $('#from_age_activity').val(),
                    to_age: $('#to_age_activity').val(),
                    price: $('#age_price_activity').val()
                },
                success: function(response) {
                    if (!response.status) {
                        showMessageActivity(response.msg, 'danger');
                        return;
                    }

                    showMessageActivity(id ? 'Updated successfully' : 'Added successfully');

                    $('#age_price_id_activity').val('');
                    $('#from_age_activity').val('');
                    $('#to_age_activity').val('');
                    $('#age_price_activity').val('');
                    $('#saveAgePriceActivity').text('Save');

                    setTimeout(loadAgePriceListActivity, 200);
                }
            });
        });

        $(document).on('click', '.editAgeActivity', function() {
            const id = $(this).data('id');
            $.ajax({
                url: 'admin/masters/get_single_age_price_activity',
                type: 'POST',
                data: { id: id },
                success: function(res) {
                    const data = JSON.parse(res);
                    $('#age_price_id_activity').val(data.id);
                    $('#from_age_activity').val(data.age_from);
                    $('#to_age_activity').val(data.age_to);
                    $('#age_price_activity').val(data.price);
                    $('#saveAgePriceActivity').text('Update');
                }
            });
        });

        $(document).on('click', '.deleteAgeActivity', function() {
            const id = $(this).data('id');
            if (confirm('Are you sure you want to deactivate this price?')) {
                $.post('admin/masters/delete_child_age_price_activity ', { id: id }, function() {
                    showMessageActivity('Price deactivated successfully', 'danger');
                    loadAgePriceListActivity();
                });
            }
        });

        function showMessageActivity(msg, type = 'success') {
            $('#ageMsgActivity').removeClass().addClass('alert alert-' + type).html(msg).fadeIn();
            setTimeout(() => $('#ageMsgActivity').fadeOut(), 3000);
        }
    });
</script>