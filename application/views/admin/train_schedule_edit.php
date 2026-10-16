<?php include('admin_head_css.php');?>
<link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet" />

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="page-content-wrapper">
            <div class="page-bar">
                <div class="row page-titles">
                    <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                        <h4 class="text-themecolor">Edit Train Schedule</h4>
                    </div>
                    <div class="col-lg-2 only-for-dashbord"></div>
                    <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                <li class="breadcrumb-item active">Edit Train Schedule</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-content">
                <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                           <?php echo form_open('train-schedule-edit?id='.$this->input->get('id'));  ?>
                            <div class="card-body row">
                                <div class="col-lg-4 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Country</label>
                                        <?php echo form_input(['name' => 'country', 'id' => 'country', 'class' => 'mdl-textfield__input', 'value' => set_value('country', $train_schedule->country)]); ?>
                                        <?php echo form_error('country'); ?>
                                    </div>
                                </div>

                                <div class="col-lg-4 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Train</label>
                                        <select name="train_id" id="train_id" class="mdl-textfield__input" style="padding-top:13px;">
                                            <option value="">Select Train</option>
                                            <?php 
                                            if(!empty($trains)) {
                                                foreach($trains as $train) {
                                                    $selected = ($train->id == $train_schedule->train_id) ? 'selected' : '';
                                                    echo '<option value="'.$train->id.'" '.$selected.'>'.$train->train_name.'</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_error('train_id'); ?>
                                    </div>
                                </div>

                                <div class="col-lg-4 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Train No.</label>
                                        <?php echo form_input(['name' => 'train_number', 'id' => 'train_number', 'class' => 'mdl-textfield__input', 'value' => set_value('train_number', $train_schedule->train_number)]); ?>
                                        <?php echo form_error('train_number'); ?>
                                    </div>
                                </div>

                                <div class="col-lg-4 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Departing Station</label>
                                        <?php echo form_input(['name' => 'departing_station', 'id' => 'departing_station', 'class' => 'mdl-textfield__input', 'value' => set_value('departing_station', $train_schedule->departing_station)]); ?>
                                        <?php echo form_error('departing_station'); ?>
                                    </div>
                                </div>

                                <div class="col-lg-4 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Arrival Station</label>
                                        <?php echo form_input(['name' => 'arrival_station', 'id' => 'arrival_station', 'class' => 'mdl-textfield__input', 'value' => set_value('arrival_station', $train_schedule->arrival_station)]); ?>
                                        <?php echo form_error('arrival_station'); ?>
                                    </div>
                                </div>

                                <div class="col-lg-4 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Type</label>
                                        <select name="type[]" id="type" class="mdl-textfield__input js-example-basic-multiple type" multiple="multiple" style="padding: 10px; width: 100%;">
                                            <?php
                                            $options = [
                                                'business_class' => 'Business Class',
                                                'economy_class' => 'Economy Class',
                                                'first_class' => 'First Class', 
                                                'second_class' => 'Second Class',
                                                'sitting' => 'Sitting',
                                                'vip' => 'VIP', 
                                                'sleeper' => 'Sleeper',
                                                'coupe' => 'Coupe',
                                                'sv' => 'SV',
                                                'luxe' => 'Luxe',
                                                'open_plan' => 'Open-plan',
                                                'couple' => 'Couple',
                                            ];
                                            
                                            // Get selected values
                                            $selected = [];
                                            if(isset($train_schedule->type) && !empty($train_schedule->type)) {
                                                $selected = json_decode($train_schedule->type, true);
                                                if(!is_array($selected)) $selected = [];
                                            } else {
                                                $selected = (array)set_value('type[]', []);
                                            }
                                            
                                            foreach($options as $value => $label):
                                                $is_selected = in_array($value, $selected) ? 'selected' : '';
                                            ?>
                                                <option value="<?php echo $value; ?>" <?php echo $is_selected; ?>>
                                                    <?php echo $label; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('type[]'); ?>
                                    </div>
                                </div>

                                <div class="col-lg-4 p-t-20 bussiness" style="display:none;">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Business Class Adult Ticket Price</label>
                                        <?php echo form_input([
                                            'name'  => 'ticket_price',
                                            'class' => 'mdl-textfield__input',
                                            'value' => set_value('ticket_price', $train_schedule->ticket_price)
                                        ]); ?>
                                        <?php echo form_error('ticket_price'); ?>
                                    </div>

                                    <!-- Child Age Option -->
                                    <div class="m-b-10">
                                        <label>Child Ticket Type</label><br>

                                        <label>
                                            <input type="radio" name="bussines_child_age" value="yes"
                                            <?= ($train_schedule->bussines_child_age == 'yes') ? 'checked' : '' ?>>
                                            With Age
                                        </label>

                                        <label style="margin-left:15px;">
                                            <input type="radio" name="bussines_child_age" value="no"
                                            <?= ($train_schedule->bussines_child_age == 'no') ? 'checked' : '' ?>>
                                            Without Age
                                        </label>
                                    </div>
                                    <div class="bussines-age-btn" style="display:<?= ($train_schedule->bussines_child_age == 'yes') ? 'block' : 'none' ?>;margin-top:10px;">
                                        <button type="button"
                                            class="btn btn-primary add-age-btn"
                                            data-class="business"
                                            data-toggle="modal"
                                            data-target="#agePriceModal">
                                    Add Age Price
                                    </button>
                                    </div>

                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width business-child-price">
                                        <label class="mdl-textfield__label">Business Class Child Ticket Price</label>
                                        <?php echo form_input([
                                            'name'  => 'business_child_ticket_price',
                                            'type'  => 'number',
                                            'class' => 'mdl-textfield__input',
                                            'value' => set_value('business_child_ticket_price', $train_schedule->business_child_ticket_price)
                                        ]); ?>
                                        <?php echo form_error('business_child_ticket_price'); ?>
                                    </div>
                                </div>

                                <div class="col-lg-4 p-t-20 eco" style="display:none;">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Economy Class Adult Ticket Price</label>
                                        <?php echo form_input([
                                            'name'  => 'economy_ticket_price',
                                            'class' => 'mdl-textfield__input',
                                            'value' => set_value('economy_ticket_price', $train_schedule->economy_ticket_price)
                                        ]); ?>
                                        <?php echo form_error('economy_ticket_price'); ?>
                                    </div>

                                    <!-- Child Age Option -->
                                    <div class="m-b-10">
                                        <label>Child Ticket Type</label><br>

                                        <label>
                                            <input type="radio" name="economy_child_age" value="yes"
                                            <?= ($train_schedule->economy_child_age  == 'yes') ? 'checked' : '' ?>>
                                            With Age
                                        </label>

                                        <label style="margin-left:15px;">
                                            <input type="radio" name="economy_child_age" value="no"
                                            <?= ($train_schedule->economy_child_age  == 'no') ? 'checked' : '' ?>>
                                            Without Age
                                        </label>
                                    </div>
                                    <div class="economy-age-btn" style="display:<?= ($train_schedule->economy_child_age == 'yes') ? 'block' : 'none' ?>;margin-top:10px;">
                                        <button type="button"
                                                class="btn btn-primary add-age-btn"
                                                data-class="economy"
                                                data-toggle="modal"
                                                data-target="#agePriceModal">
                                        Add Age Price
                                        </button>
                                    </div>

                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width economy-child-price">
                                        <label class="mdl-textfield__label">Economy Class Child Ticket Price</label>
                                        <?php echo form_input([
                                            'name'  => 'economy_child_ticket_price',
                                            'type'  => 'number',
                                            'class' => 'mdl-textfield__input',
                                            'value' => set_value('economy_child_ticket_price', $train_schedule->economy_child_ticket_price)
                                        ]); ?>
                                        <?php echo form_error('economy_child_ticket_price'); ?>
                                    </div>
                                </div>

                                <div class="col-lg-4 p-t-20 first" style="display:none;">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">First Class Adult Ticket Price</label>
                                        <?php echo form_input([
                                            'name'  => 'first_class_ticket_price',
                                            'class' => 'mdl-textfield__input',
                                            'value' => set_value('first_class_ticket_price', $train_schedule->first_class_ticket_price)
                                        ]); ?>
                                        <?php echo form_error('first_class_ticket_price'); ?>
                                    </div>

                                    <!-- Child Age Option -->
                                    <div class="m-b-10">
                                        <label>Child Ticket Type</label><br>

                                        <label>
                                            <input type="radio" name="first_child_age" value="yes"
                                            <?= ($train_schedule->first_child_age == 'yes') ? 'checked' : '' ?>>
                                            With Age
                                        </label>

                                        <label style="margin-left:15px;">
                                            <input type="radio" name="first_child_age" value="no"
                                            <?= ($train_schedule->first_child_age == 'no') ? 'checked' : '' ?>>
                                            Without Age
                                        </label>
                                    </div>
                                    <div class="first-age-btn" style="display:<?= ($train_schedule->first_child_age == 'yes') ? 'block' : 'none' ?>;margin-top:10px;">
                                        <button type="button"
                                                class="btn btn-primary add-age-btn"
                                                data-class="first"
                                                data-toggle="modal"
                                                data-target="#agePriceModal">
                                        Add Age Price
                                        </button>
                                    </div>

                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width first-child-price">
                                        <label class="mdl-textfield__label">First Class Child Ticket Price</label>
                                        <?php echo form_input([
                                            'name'  => 'first_class_child_ticket_price',
                                            'type'  => 'number',
                                            'class' => 'mdl-textfield__input',
                                            'value' => set_value('first_class_child_ticket_price', $train_schedule->first_class_child_ticket_price)
                                        ]); ?>
                                        <?php echo form_error('first_class_child_ticket_price'); ?>
                                    </div>
                                </div>

                                <div class="col-lg-4 p-t-20 second" style="display:none;">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Second Class Adult Ticket Price</label>
                                        <?php echo form_input([
                                            'name'  => 'second_class_ticket_price',
                                            'class' => 'mdl-textfield__input',
                                            'value' => set_value('second_class_ticket_price', $train_schedule->second_class_ticket_price)
                                        ]); ?>
                                        <?php echo form_error('second_class_ticket_price'); ?>
                                    </div>

                                    <!-- Child Age Option -->
                                    <div class="m-b-10">
                                        <label>Child Ticket Type</label><br>

                                        <label>
                                            <input type="radio" name="second_child_age" value="yes"
                                            <?= ($train_schedule->second_child_age == 'yes') ? 'checked' : '' ?>>
                                            With Age
                                        </label>

                                        <label style="margin-left:15px;">
                                            <input type="radio" name="second_child_age" value="no"
                                            <?= ($train_schedule->second_child_age == 'no') ? 'checked' : '' ?>>
                                            Without Age
                                        </label>
                                    </div>
                                    <div class="second-age-btn" style="display:<?= ($train_schedule->second_child_age == 'yes') ? 'block' : 'none' ?>;margin-top:10px;">
                                        <button type="button"
                                                class="btn btn-primary add-age-btn"
                                                data-class="second"
                                                data-toggle="modal"
                                                data-target="#agePriceModal">
                                        Add Age Price
                                        </button>
                                    </div>

                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width second-child-price">
                                        <label class="mdl-textfield__label">Second Class Child Ticket Price</label>
                                        <?php echo form_input([
                                            'name'  => 'second_class_child_ticket_price',
                                            'type'  => 'number',
                                            'class' => 'mdl-textfield__input',
                                            'value' => set_value('second_class_child_ticket_price', $train_schedule->second_class_child_ticket_price)
                                        ]); ?>
                                        <?php echo form_error('second_class_child_ticket_price'); ?>
                                    </div>
                                </div>

                                <div class="col-lg-4 p-t-20 sitting" style="display:none;">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Sitting Ticket Price</label>
                                        <?php echo form_input([
                                            'name'  => 'sitting_ticket_price',
                                            'class' => 'mdl-textfield__input',
                                            'value' => set_value('sitting_ticket_price', $train_schedule->sitting_ticket_price)
                                        ]); ?>
                                        <?php echo form_error('sitting_ticket_price'); ?>
                                    </div>

                                    <!-- Child Age Option -->
                                    <div class="m-b-10">
                                        <label>Child Ticket Type</label><br>

                                        <label>
                                            <input type="radio" name="sitting_child_age" value="yes"
                                            <?= ($train_schedule->sitting_child_age == 'yes') ? 'checked' : '' ?>>
                                            With Age
                                        </label>

                                        <label style="margin-left:15px;">
                                            <input type="radio" name="sitting_child_age" value="no"
                                            <?= ($train_schedule->sitting_child_age == 'no') ? 'checked' : '' ?>>
                                            Without Age
                                        </label>
                                    </div>
                                    <div class="sitting-age-btn" style="display:<?= ($train_schedule->sitting_child_age == 'yes') ? 'block' : 'none' ?>;margin-top:10px;">
                                        <button type="button"
                                                class="btn btn-primary add-age-btn"
                                                data-class="sitting"
                                                data-toggle="modal"
                                                data-target="#agePriceModal">
                                        Add Age Price
                                        </button>
                                    </div>

                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width sitting-child-price">
                                        <label class="mdl-textfield__label">Sitting Child Ticket Price</label>
                                        <?php echo form_input([
                                            'name'  => 'sitting_child_ticket_price',
                                            'type'  => 'number',
                                            'class' => 'mdl-textfield__input',
                                            'value' => set_value('sitting_child_ticket_price', $train_schedule->sitting_child_ticket_price)
                                        ]); ?>
                                        <?php echo form_error('sitting_child_ticket_price'); ?>
                                    </div>
                                </div>

                                <div class="col-lg-4 p-t-20 vip" style="display:none;">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Vip Adult Ticket Price</label>
                                        <?php echo form_input([
                                            'name'  => 'vip_ticket_price',
                                            'class' => 'mdl-textfield__input',
                                            'value' => set_value('vip_ticket_price', $train_schedule->vip_ticket_price)
                                        ]); ?>
                                        <?php echo form_error('vip_ticket_price'); ?>
                                    </div>

                                    <!-- Child Age Option -->
                                    <div class="m-b-10">
                                        <label>Child Ticket Type</label><br>

                                        <label>
                                            <input type="radio" name="vip_child_age" value="yes"
                                            <?= ($train_schedule->vip_child_age == 'yes') ? 'checked' : '' ?>>
                                            With Age
                                        </label>

                                        <label style="margin-left:15px;">
                                            <input type="radio" name="vip_child_age" value="no"
                                            <?= ($train_schedule->vip_child_age == 'no') ? 'checked' : '' ?>>
                                            Without Age
                                        </label>
                                    </div>
                                    <div class="vip-age-btn" style="display:<?= ($train_schedule->vip_child_age == 'yes') ? 'block' : 'none' ?>;margin-top:10px;">
                                        <button type="button"
                                                class="btn btn-primary add-age-btn"
                                                data-class="vip"
                                                data-toggle="modal"
                                                data-target="#agePriceModal">
                                        Add Age Price
                                        </button>
                                    </div>

                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width vip-child-price">
                                        <label class="mdl-textfield__label">Vip Child Ticket Price</label>
                                        <?php echo form_input([
                                            'name'  => 'vip_child_ticket_price',
                                            'type'  => 'number',
                                            'class' => 'mdl-textfield__input',
                                            'value' => set_value('vip_child_ticket_price', $train_schedule->vip_child_ticket_price)
                                        ]); ?>
                                        <?php echo form_error('vip_child_ticket_price'); ?>
                                    </div>
                                </div>

                                <div class="col-lg-4 p-t-20 sleeper" style="display:none;">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Sleeper Class Adult Ticket Price</label>
                                        <?php echo form_input([
                                            'name'  => 'sleeper_class_ticket_price',
                                            'class' => 'mdl-textfield__input',
                                            'value' => set_value('sleeper_class_ticket_price', $train_schedule->sleeper_class_ticket_price)
                                        ]); ?>
                                        <?php echo form_error('sleeper_class_ticket_price'); ?>
                                    </div>

                                    <!-- Child Age Option -->
                                    <div class="m-b-10">
                                        <label>Child Ticket Type</label><br>

                                        <label>
                                            <input type="radio" name="sleeper_child_age" value="yes"
                                            <?= ($train_schedule->sleeper_child_age == 'yes') ? 'checked' : '' ?>>
                                            With Age
                                        </label>

                                        <label style="margin-left:15px;">
                                            <input type="radio" name="sleeper_child_age" value="no"
                                            <?= ($train_schedule->sleeper_child_age == 'no') ? 'checked' : '' ?>>
                                            Without Age
                                        </label>
                                    </div>
                                    <div class="sleeper-age-btn" style="display:<?= ($train_schedule->sleeper_child_age == 'yes') ? 'block' : 'none' ?>;margin-top:10px;">
                                       <button type="button"
                                                class="btn btn-primary add-age-btn"
                                                data-class="sleeper"
                                                data-toggle="modal"
                                                data-target="#agePriceModal">
                                        Add Age Price
                                        </button>
                                    </div>

                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width sleeper-child-price">
                                        <label class="mdl-textfield__label">Sleeper Class Child Ticket Price</label>
                                        <?php echo form_input([
                                            'name'  => 'sleeper_class_child_ticket_price',
                                            'type'  => 'number',
                                            'class' => 'mdl-textfield__input',
                                            'value' => set_value('sleeper_class_child_ticket_price', $train_schedule->sleeper_class_child_ticket_price)
                                        ]); ?>
                                        <?php echo form_error('sleeper_class_child_ticket_price'); ?>
                                    </div>
                                </div>

                                <div class="col-lg-4 p-t-20 coupe" style="display:none;">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Coupe Class Adult Ticket Price</label>
                                        <?php echo form_input([
                                            'name'  => 'coupe_class_ticket_price',
                                            'class' => 'mdl-textfield__input',
                                            'value' => set_value('coupe_class_ticket_price', $train_schedule->coupe_class_ticket_price)
                                        ]); ?>
                                        <?php echo form_error('coupe_class_ticket_price'); ?>
                                    </div>

                                    <!-- Child Age Option -->
                                    <div class="m-b-10">
                                        <label>Child Ticket Type</label><br>

                                        <label>
                                            <input type="radio" name="coupe_child_age" value="yes"
                                            <?= ($train_schedule->coupe_child_age == 'yes') ? 'checked' : '' ?>>
                                            With Age
                                        </label>

                                        <label style="margin-left:15px;">
                                            <input type="radio" name="coupe_child_age" value="no"
                                            <?= ($train_schedule->coupe_child_age == 'no') ? 'checked' : '' ?>>
                                            Without Age
                                        </label>
                                    </div>
                                    <div class="coupe-age-btn" style="display:<?= ($train_schedule->coupe_child_age == 'yes') ? 'block' : 'none' ?>;margin-top:10px;">
                                        <button type="button"
                                                class="btn btn-primary add-age-btn"
                                                data-class="coupe"
                                                data-toggle="modal"
                                                data-target="#agePriceModal">
                                        Add Age Price
                                        </button>
                                    </div>

                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width couple-child-price">
                                        <label class="mdl-textfield__label">Coupe Class Child Ticket Price</label>
                                        <?php echo form_input([
                                            'name'  => 'coupe_class_child_ticket_price',
                                            'type'  => 'number',
                                            'class' => 'mdl-textfield__input',
                                            'value' => set_value('coupe_class_child_ticket_price', $train_schedule->coupe_class_child_ticket_price)
                                        ]); ?>
                                        <?php echo form_error('coupe_class_child_ticket_price'); ?>
                                    </div>
                                </div>

                                <div class="col-lg-4 p-t-20 sv" style="display:none;">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Sv Class Adult Ticket Price</label>
                                        <?php echo form_input([
                                            'name'  => 'sv_class_ticket_price',
                                            'class' => 'mdl-textfield__input',
                                            'value' => set_value('sv_class_ticket_price', $train_schedule->sv_class_ticket_price)
                                        ]); ?>
                                        <?php echo form_error('sv_class_ticket_price'); ?>
                                    </div>

                                    <!-- Child Age Option -->
                                    <div class="m-b-10">
                                        <label>Child Ticket Type</label><br>

                                        <label>
                                            <input type="radio" name="sv_child_age" value="yes"
                                            <?= ($train_schedule->sv_child_age == 'yes') ? 'checked' : '' ?>>
                                            With Age
                                        </label>

                                        <label style="margin-left:15px;">
                                            <input type="radio" name="sv_child_age" value="no"
                                            <?= ($train_schedule->sv_child_age == 'no') ? 'checked' : '' ?>>
                                            Without Age
                                        </label>
                                    </div>
                                    <div class="sv-age-btn" style="display:<?= ($train_schedule->sv_child_age == 'yes') ? 'block' : 'none' ?>;margin-top:10px;">
                                        <button type="button"
                                                class="btn btn-primary add-age-btn"
                                                data-class="sv"
                                                data-toggle="modal"
                                                data-target="#agePriceModal">
                                        Add Age Price
                                        </button>
                                    </div>

                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width sv-child-price">
                                        <label class="mdl-textfield__label">Sv Class Child Ticket Price</label>
                                        <?php echo form_input([
                                            'name'  => 'sv_class_child_ticket_price',
                                            'type'  => 'number',
                                            'class' => 'mdl-textfield__input',
                                            'value' => set_value('sv_class_child_ticket_price', $train_schedule->sv_class_child_ticket_price)
                                        ]); ?>
                                        <?php echo form_error('sv_class_child_ticket_price'); ?>
                                    </div>
                                </div>
                                
                                  <div class="col-lg-4 p-t-20 luxe" style="display:none;">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Luxe Class Adult Ticket Price</label>
                                        <?php echo form_input([
                                            'name'  => 'luxe_class_ticket_price',
                                            'class' => 'mdl-textfield__input',
                                            'value' => set_value('luxe_class_ticket_price', $train_schedule->luxe_ticket_price)
                                        ]); ?>
                                        <?php echo form_error('luxe_class_ticket_price'); ?>
                                    </div>

                                    <!-- Child Age Option -->
                                    <div class="m-b-10">
                                        <label>Child Ticket Type</label><br>

                                        <label>
                                            <input type="radio" name="luxe_child_age" value="yes"
                                            <?= ($train_schedule->luxe_child_age == 'yes') ? 'checked' : '' ?>>
                                            With Age
                                        </label>

                                        <label style="margin-left:15px;">
                                            <input type="radio" name="luxe_child_age" value="no"
                                            <?= ($train_schedule->luxe_child_age == 'no') ? 'checked' : '' ?>>
                                            Without Age
                                        </label>
                                    </div>
                                    <div class="luxe-age-btn" style="display:<?= ($train_schedule->luxe_child_age == 'yes') ? 'block' : 'none' ?>;margin-top:10px;">
                                        <button type="button"
                                                class="btn btn-primary add-age-btn"
                                                data-class="luxe"
                                                data-toggle="modal"
                                                data-target="#agePriceModal">
                                        Add Age Price
                                        </button>
                                    </div>

                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width luxe-child-price">
                                        <label class="mdl-textfield__label">Luxe Class Child Ticket Price</label>
                                        <?php echo form_input([
                                            'name'  => 'luxe_class_child_ticket_price',
                                            'type'  => 'number',
                                            'class' => 'mdl-textfield__input',
                                            'value' => set_value('luxe_class_child_ticket_price', $train_schedule->luxe_child_ticket_price)
                                        ]); ?>
                                        <?php echo form_error('luxe_class_child_ticket_price'); ?>
                                    </div>
                                </div>
                                    <div class="col-lg-4 p-t-20 open_plan price-box" data-type="open_plan_class" style="display:none;">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Open Plan Class Adult Ticket Price</label>
                                            <?php echo form_input([
                                                'name' => 'open_plan_ticket_price',
                                                'class' => 'mdl-textfield__input',
                                                'value' => set_value('open_plan_ticket_price',$train_schedule->open_plan_ticket_price)
                                            ]); ?>
                                        </div>

                                        
                                        <!-- Child Age Option -->
                                        <div class="m-b-10">
                                            <label>Child Ticket Type</label><br>

                                          <label>
                                            <input type="radio" name="open_plan_child_age" value="yes"
                                            <?= ($train_schedule->open_plan_child_age == 'yes') ? 'checked' : '' ?>>
                                            With Age
                                        </label>

                                        <label style="margin-left:15px;">
                                            <input type="radio" name="open_plan_child_age" value="no"
                                            <?= ($train_schedule->open_plan_child_age == 'no') ? 'checked' : '' ?>>
                                            Without Age
                                        </label>
                                        </div>

                                         <div class="open_plan-age-btn" style="display:<?= ($train_schedule->open_plan_child_age == 'yes') ? 'block' : 'none' ?>;margin-top:10px;">
                                                <button type="button"
                                                        class="btn btn-primary add-age-btn"
                                                        data-class="open_plan"
                                                        data-toggle="modal"
                                                        data-target="#agePriceModal">
                                                Add Age Price
                                                </button>
                                         </div>
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width open_plan-child-price">
                                            <label class="mdl-textfield__label">Open plan Class Child Ticket Price</label>
                                            <?php echo form_input([
                                                'name' => 'open_plan_child_ticket_price',
                                                'class' => 'mdl-textfield__input',
                                                'value' => set_value('open_plan_child_ticket_price',$train_schedule->open_plan_child_ticket_price)
                                            ]); ?>
                                        </div>
                                    </div>

                                <div class="col-lg-4 p-t-20 couple price-box" data-type="couple_class" style="display:none;">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Couple Plan Class Adult Ticket Price</label>
                                            <?php echo form_input([
                                                'name' => 'couple_ticket_price',
                                                'class' => 'mdl-textfield__input',
                                                'value' => set_value('couple_ticket_price', $train_schedule->couple_ticket_price)
                                            ]); ?>
                                        </div>

                                        
                                        <!-- Child Age Option -->
                                        <div class="m-b-10">
                                            <label>Child Ticket Type</label><br>

                                           <label>
                                            <input type="radio" name="couple_child_age" value="yes"
                                            <?= ($train_schedule->couple_child_age == 'yes') ? 'checked' : '' ?>>
                                            With Age
                                        </label>

                                        <label style="margin-left:15px;">
                                            <input type="radio" name="couple_child_age" value="no"
                                            <?= ($train_schedule->couple_child_age == 'no') ? 'checked' : '' ?>>
                                            Without Age
                                        </label>
                                        </div>
                                         <div class="couple-age-btn" style="display:<?= ($train_schedule->couple_child_age == 'yes') ? 'block' : 'none' ?>;margin-top:10px;">
                                                <button type="button"
                                                        class="btn btn-primary add-age-btn"
                                                        data-class="couple"
                                                        data-toggle="modal"
                                                        data-target="#agePriceModal">
                                                Add Age Price
                                                </button>
                                         </div>
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width couple-child-price">
                                            <label class="mdl-textfield__label">Couple Class Child Ticket Price</label>
                                            <?php echo form_input([
                                                'name' => 'couple_child_ticket_price',
                                                'class' => 'mdl-textfield__input',
                                                'value' => set_value('couple_child_ticket_price',$train_schedule->couple_child_ticket_price)
                                            ]); ?>
                                        </div>
                                </div>

                                <input type="hidden" id="age_price_id" value="">

                            </div>
                            <div class="card-body row">
                                <div class="col-lg-4">
                                    <input type="checkbox" id="same_time_checkbox" name="same_time_checkbox" value="1" <?php echo ($train_schedule->same_time_checkbox == 1) ? 'checked' : ''; ?>> 
                                    <label for="same_time_checkbox" style="font-weight: 600;">Apply Same Time for All Days</label>
                                </div>
                                <div class="col-lg-4">
                                    <label style="font-weight: 600;">Departing Time</label>
                                </div>
                                <div class="col-lg-4">
                                    <label style="font-weight: 600;">Arrival Time</label>
                                </div>
                            </div>

                            <?php 
                            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                            $days_of_operations = !empty($train_schedule->days_of_operations) ? explode(',', $train_schedule->days_of_operations) : [];
                            
                            // Map column names to day names
                            $departure_columns = [
                                'monday' => 'mon_dep_time',
                                'tuesday' => 'tue_dep_time',
                                'wednesday' => 'wed_dep_time',
                                'thursday' => 'thu_dep_time', // Note: column name mismatch
                                'friday' => 'fri_dep_time',
                                'saturday' => 'sat_dep_time',
                                'sunday' => 'sun_dep_time'
                            ];
                            
                            $arrival_columns = [
                                'monday' => 'mon_arr_time',
                                'tuesday' => 'tue_arr_time',
                                'wednesday' => 'wed_arr_time',
                                'thursday' => 'thu_arr_time',
                                'friday' => 'fri_arr_time',
                                'saturday' => 'sat_arr_time',
                                'sunday' => 'sun_arr_time'
                            ];
                            
                            foreach ($days as $index => $day) { 
                                $is_checked = in_array($day, $days_of_operations) ? 'checked' : '';
                                $dep_time = $train_schedule->{$departure_columns[$day]};
                                $arr_time = $train_schedule->{$arrival_columns[$day]};
                            ?>
                            <div class="card-body row">
                                <div class="col-lg-4">
                                    <input type="checkbox" name="operational_days[]" value="<?php echo $day; ?>" 
                                           class="day-checkbox" <?php echo $is_checked; ?>>
                                    <?php echo ucfirst($day); ?>
                                </div>
                                <div class="col-lg-4">
                                    <input type="time" name="departure_time[]" id="departure_<?php echo $day; ?>" class="mdl-textfield__input train-departing" value="<?php echo $dep_time; ?>">
                                </div>
                                <div class="col-lg-4">
                                    <input type="time" name="arrival_time[]" id="arrival_<?php echo $day; ?>" class="mdl-textfield__input train-arrival" value="<?php echo $arr_time; ?>">
                                </div>
                            </div>
                            <?php } ?>
                            <div class="col-lg-12 p-t-20 text-center">
                                <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Update']);?>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="agePriceModal">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 id="modalTitle">Child Age Pricing</h4>
         </div>
         <div class="modal-body">
            <div id="ageMsg" style="display:none;"></div>
            <input type="hidden" id="class_type">
            <div class="row">
               <div class="col-md-3">
                  <input type="number" id="from_age" class="form-control" placeholder="From Age">
               </div>
               <div class="col-md-3">
                  <input type="number" id="to_age" class="form-control" placeholder="To Age">
               </div>
               <div class="col-md-3">
                  <input type="number" id="age_price" class="form-control" placeholder="Price">
               </div>
               <div class="col-md-3">
                   <button class="btn btn-success" id="saveAgePrice">Save</button>
               </div>
            </div>
            <hr>
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th>From</th>
                     <th>To</th>
                     <th>Type</th>
                     <th>Price</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody id="agePriceList"></tbody>
            </table>
         </div>
      </div>
   </div>
</div>

<script>
    $(document).ready(function () {
        // Country autocomplete
        $("#country").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?= base_url() ?>admin/company/get_country_ajax_new",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            select: function (event, ui) {
                $('#country').val(ui.item.label);
                loadTrainsByCountry(ui.item.label);
                initCityAutocomplete(ui.item.label);
                return false;
            }
        });
        
        // Function to load trains by country NAME
        function loadTrainsByCountry(countryName) {
            if(countryName && countryName.trim() !== '') {
                $.ajax({
                    url: "<?= base_url() ?>admin/train_schedule/get_trains_by_country",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        country: countryName
                    },
                    beforeSend: function() {
                        $('#train_id').html('<option value="">Loading trains...</option>');
                    },
                    success: function(data) {
                        if(data.status == 'success' && data.trains.length > 0) {
                            var options = '<option value="">Select Train</option>';
                            $.each(data.trains, function(key, train) {
                                var selected = (train.id == <?php echo $train_schedule->train_id; ?>) ? 'selected' : '';
                                options += '<option value="' + train.id + '" ' + selected + '>' + train.train_name;
                                if(train.train_number) {
                                    options += ' (' + train.train_number + ')';
                                }
                                options += '</option>';
                            });
                            $('#train_id').html(options);
                        } else {
                            $('#train_id').html('<option value="">No trains found for ' + countryName + '</option>');
                        }
                    },
                    error: function() {
                        $('#train_id').html('<option value="">Error loading trains</option>');
                    }
                });
            }
        }

        function initCityAutocomplete(countryName) {
            // Departing Station autocomplete
            $("#departing_station").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "<?= base_url() ?>admin/train/get_cities_autocomplete",
                        type: 'get',
                        dataType: "json",
                        data: {
                            term: request.term,
                            country: countryName
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                minLength: 1, 
                select: function(event, ui) {
                    $('#departing_station').val(ui.item.value);
                    return false;
                },
                focus: function(event, ui) {
                    $('#departing_station').val(ui.item.label);
                    return false;
                }
            }).autocomplete("instance")._renderItem = function(ul, item) {
                return $("<li>")
                    .append("<div>" + item.label + "</div>")
                    .appendTo(ul);
            };
            
            $("#arrival_station").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "<?= base_url() ?>admin/train/get_cities_autocomplete",
                        type: 'get',
                        dataType: "json",
                        data: {
                            term: request.term,
                            country: countryName
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                minLength: 1,
                select: function(event, ui) {
                    $('#arrival_station').val(ui.item.value);
                    return false;
                }
            });
            
        }
        
        // Load trains on page load if country is set
        var countryName = $('#country').val();
        if(countryName && countryName.trim() !== '') {
            loadTrainsByCountry(countryName);
        }
         <?php if(!empty($train_schedule->country)): ?>
        loadTrainsByCountry('<?php echo $train_schedule->country; ?>');
        initCityAutocomplete('<?php echo $train_schedule->country; ?>');
    <?php endif; ?>
    });

    // Same time checkbox functionality
    document.getElementById('same_time_checkbox').addEventListener('change', function() {
        const isChecked = this.checked;
        const depMonday = document.getElementById('departure_monday').value;
        const arrMonday = document.getElementById('arrival_monday').value;
        
        if (isChecked) {
            if (depMonday === '' || arrMonday === '') {
                alert('Please enter Monday Departure and Arrival times first.');
                this.checked = false;
                return;
            }

            // Check all day checkboxes and set times
            document.querySelectorAll('.day-checkbox').forEach(chk => {
                chk.checked = true;
                const day = chk.value;
                document.getElementById('departure_' + day).value = depMonday;
                document.getElementById('arrival_' + day).value = arrMonday;
            });
        }
    });

    // Individual checkbox change
    document.querySelectorAll('.day-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const day = this.value;
            const depInput = document.getElementById('departure_' + day);
            const arrInput = document.getElementById('arrival_' + day);
            const depMonday = document.getElementById('departure_monday').value;
            const arrMonday = document.getElementById('arrival_monday').value;
            const sameTimeCheckbox = document.getElementById('same_time_checkbox');

            if (this.checked && sameTimeCheckbox.checked) {
                depInput.value = depMonday;
                arrInput.value = arrMonday;
            } else if (!this.checked) {
                depInput.value = '';
                arrInput.value = '';
            }
        });
    });
    $(function() {
            $('.js-example-basic-multiple').select2({
                //theme: 'filled',
                placeholder: 'Type',
                width: '450px'
            });
        });
</script>

<script>
    $(document).ready(function() {
        function handleTypeChange() {
            var selectedValues = $('#type').val() || [];
            
            // Hide all price fields first
            $('.eco, .bussiness, .first, .second, .sitting, .sleeper, .vip, .sv, .coupe').hide();
            
            // Show corresponding price fields based on selection
            if (selectedValues.includes('business_class')) {
                $('.bussiness').show();
            }
            if (selectedValues.includes('economy_class')) {
                $('.eco').show();
            }
            if (selectedValues.includes('first_class')) {
                $('.first').show();
            }
            if (selectedValues.includes('second_class')) {
                $('.second').show();
            }
            if (selectedValues.includes('sitting')) {
                $('.sitting').show();
            }
            if (selectedValues.includes('vip')) {
                $('.vip').show();
            }
            if (selectedValues.includes('sleeper')) {
                $('.sleeper').show();
            }
            if (selectedValues.includes('coupe')) {
                $('.coupe').show();
            }
            if (selectedValues.includes('sv')) {
                $('.sv').show();
            }
              if (selectedValues.includes('luxe')) {
                $('.luxe').show();
            }
              if (selectedValues.includes('open_plan')) {
                $('.open_plan').show();
            }
               if (selectedValues.includes('couple')) {
                $('.couple').show();
            }
        }
        
        // Initial check
        handleTypeChange();
        toggleChildPrice();
        
        // On change event
        $('#type').on('change', function() {
            handleTypeChange();
            toggleChildPrice();
        });

        function toggleChildPrice() {
    
            // Business
            if ($("input[name='bussines_child_age']:checked").val() == 'yes') {
                $('.business-child-price').hide();
            } else {
                $('.business-child-price').show();
            }
    
            // Economy
            if ($("input[name='economy_child_age']:checked").val() == 'yes') {
                $('.economy-child-price').hide();
            } else {
                $('.economy-child-price').show();
            }
    
            // First
            if ($("input[name='first_child_age']:checked").val() == 'yes') {
                $('.first-child-price').hide();
            } else {
                $('.first-child-price').show();
            }
    
            // Business
            if ($("input[name='second_child_age']:checked").val() == 'yes') {
                $('.second-child-price').hide();
            } else {
                $('.second-child-price').show();
            }
    
            // Sitting
            if ($("input[name='sitting_child_age']:checked").val() == 'yes') {
                $('.sitting-child-price').hide();
            } else {
                $('.sitting-child-price').show();
            }
    
            // Vip
            if ($("input[name='vip_child_age']:checked").val() == 'yes') {
                $('.vip-child-price').hide();
            } else {
                $('.vip-child-price').show();
            }
    
            // Sleeper
            if ($("input[name='sleeper_child_age']:checked").val() == 'yes') {
                $('.sleeper-child-price').hide();
            } else {
                $('.sleeper-child-price').show();
            }
    
            // Coupe
            if ($("input[name='coupe_child_age']:checked").val() == 'yes') {
                $('.coupe-child-price').hide();
            } else {
                $('.coupe-child-price').show();
            }
    
            // Sv
            if ($("input[name='sv_child_age']:checked").val() == 'yes') {
                $('.sv-child-price').hide();
            } else {
                $('.sv-child-price').show();
            } 
               // Luxe
            if ($("input[name='luxe_child_age']:checked").val() == 'yes') {
                $('.luxe-child-price').hide();
            } else {
                $('.luxe-child-price').show();
            }  
               // open plan
            if ($("input[name='open_plan_child_age']:checked").val() == 'yes') {
                $('.open_plan-child-price').hide();
            } else {
                $('.open_plan-child-price').show();
            }  
               // Couple
            if ($("input[name='couple_child_age']:checked").val() == 'yes') {
                $('.couple-child-price').hide();
            } else {
                $('.couple-child-price').show();
            } 
    
        }
    
        $(document).on('change', "input[name$='_child_age']", function () {
            toggleChildPrice();

            var name=$(this).attr("name");
            var val=$(this).val();
            var className=name.replace('_child_age','');
            console.log(val,'val');
            console.log(className,'className');
            if(val=="yes")
            {
                $("."+className+"-child-price").hide();
                $("."+className+"-age-btn").show();
            }
            else
            {
                $("."+className+"-child-price").show();
                $("."+className+"-age-btn").hide();
            }
        });

        function showMessage(msg, type="success"){
            $("#ageMsg")
                .removeClass()
                .addClass("alert alert-" + type)
                .html(msg)
                .fadeIn();

            setTimeout(function(){
                $("#ageMsg").fadeOut();
            }, 3000);
        }

        $(document).on("click",".add-age-btn",function(){
            var classType = $(this).data("class");
            $("#class_type").val(classType);
            var formattedClass = classType.charAt(0).toUpperCase() + classType.slice(1);
            $("#modalTitle").text(formattedClass + " Child Age Pricing");
            loadAgePriceList();
        });

        $("#saveAgePrice").click(function(){
            var id = $("#age_price_id").val();
            var url = "admin/train/save_child_age_price";
            if(id != ""){
                url = "admin/train/update_child_age_price";
            }
            $.ajax({
                url:url,
                type:"POST",
                data:{
                    id:id,
                    train_schedule_id: <?= $train_schedule->id; ?>,
                    class_type: $("#class_type").val(),
                    from_age: $("#from_age").val(),
                    to_age: $("#to_age").val(),
                    price: $("#age_price").val()
                },
                success:function(res){
                    let response = JSON.parse(res);

                    if(response.status == false){
                        showMessage(response.msg, "danger");
                        return;
                    }
                    let message = ($("#age_price_id").val() != "") 
                    ? "Data updated successfully" 
                    : "Data added successfully";
                    showMessage(message);
                    $("#saveAgePrice").text("Save");
                    $("#age_price_id").val("");
                    $("#from_age").val("");
                    $("#to_age").val("");
                    $("#age_price").val("");
                    loadAgePriceList();
                }
            });
        });

        function loadAgePriceList() {
            $.ajax({
                url: "admin/train/get_child_age_price",
                type: "POST",
                data: {
                    train_schedule_id: <?= $train_schedule->id; ?>,
                    class_type: $("#class_type").val()
                },
                success: function(res) {
                    $("#agePriceList").html(res);
                }
            });
        }

        $(document).on("click", ".deleteAge", function() {
            var id = $(this).data("id");
            $.post("admin/train/delete_child_age_price", {
                id: id
            }, function() {
                showMessage("Data deleted successfully", "danger");
                loadAgePriceList();
            });
        });

        $(document).on("click",".editAge",function(){
            var id = $(this).data("id");
            $.ajax({
                url: "admin/train/get_single_age_price",
                type: "POST",
                data: {id:id},
                success: function(res){

                    var data = JSON.parse(res);

                    $("#age_price_id").val(data.id);
                    $("#from_age").val(data.age_from);
                    $("#to_age").val(data.age_to);
                    $("#class_type").val(data.class_type);
                    $("#age_price").val(data.price);

                    $("#saveAgePrice").text("Update");

                }
            });
        });
    });
</script>