<?php include('admin_head_css.php');?>
<link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet" />

 <div class="page-wrapper">
        <!-- start page container -->
        <div class="container-fluid">
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                            <h4 class="text-themecolor">Add Train Schedule</h4>
                        </div>
                        <div class="col-lg-2 only-for-dashbord">
                        </div>
                        <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Add Train Schedule</li>
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
                             
                                <?php echo form_open(); ?>
                                <div class="card-body row">
                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Country</label>
                                        <?php echo form_input(['name' => 'country', 'id' => 'country', 'class' => 'mdl-textfield__input', 'value' => set_value('country')]); ?>
                                        <?php echo form_error('country'); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Train</label>
                                            <select name="train_id" id="train_id" class="mdl-textfield__input" style="padding-top:13px;">
                                                <option value="">Select Train</option>
                                            </select>
                                            <?php echo form_error('train_id'); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Train No.</label>
                                            <div style="display: flex; align-items: center;">
                                                <?php echo form_input(['name' => 'train_number', 'id' => 'flight_suffix', 'class' => 'mdl-textfield__input', 'style'=>'width:100%;','placeholder' => '', 'value' => set_value('train_number')]); ?>
                                            </div>
                                            <?php echo form_error('train_number'); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Departing Station</label>
                                            <?php echo form_input(['name' => 'departing_station', 'id' => 'departing_station', 'class' => 'mdl-textfield__input', 'placeholder' => '', 'value' => set_value('departing_station')]); ?>
                                            <?php echo form_error('departing_station'); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Arrival Station</label>
                                            <?php echo form_input(['name' => 'arrival_station', 'id' => 'arrival_station', 'class' => 'mdl-textfield__input', 'placeholder' => '', 'value' => set_value('arrival_station')]); ?>
                                            <?php echo form_error('arrival_station'); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Type</label>
                                            
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
                                            $selected = set_value('type[]', isset($edit_data->type) ? json_decode($edit_data->type) : []);
                                            
                                            $attributes = [
                                                'id' => 'type',
                                                'class' => 'mdl-textfield__input js-example-basic-multiple type',
                                                'multiple' => 'multiple',
                                                'style' => 'padding: 10px;'
                                            ];
                                            
                                            echo form_multiselect('type[]', $options, $selected, $attributes);
                                            ?>
                                            
                                            <?php echo form_error('type[]'); ?>
                                        </div>
                                    </div>
                                     <div class="col-lg-4 p-t-20 bussiness price-box" data-type="business_class" style="display:none;">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Business Class Adult Ticket Price</label>
                                            <?php echo form_input([
                                                'name' => 'ticket_price',
                                                'class' => 'mdl-textfield__input',
                                                'value' => set_value('ticket_price')
                                            ]); ?>
                                        </div>
                                        
                                        <!-- Child Age Option -->
                                        <div class="m-b-10">
                                            <label>Child Ticket Type</label><br>

                                            <label>
                                                <input type="radio" name="bussines_child_age" value="yes">
                                                With Age
                                            </label>

                                            <label style="margin-left:15px;">
                                                <input type="radio" name="bussines_child_age" value="no" checked checked>
                                                Without Age
                                            </label>
                                        </div>

                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width business-child-price">
                                            <label class="mdl-textfield__label">Business Class Child Ticket Price</label>
                                            <?php echo form_input([
                                                'name' => 'business_child_ticket_price',
                                                'class' => 'mdl-textfield__input',
                                                'value' => set_value('business_child_ticket_price')
                                            ]); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-t-20 eco price-box" data-type="economy_class" style="display:none;">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Economy Class Adult Ticket Price</label>
                                            <?php echo form_input([
                                                'name' => 'economy_ticket_price',
                                                'class' => 'mdl-textfield__input',
                                                'value' => set_value('economy_ticket_price')
                                            ]); ?>
                                        </div>

                                        
                                        <!-- Child Age Option -->
                                        <div class="m-b-10">
                                            <label>Child Ticket Type</label><br>

                                            <label>
                                                <input type="radio" name="economy_child_age" value="yes">
                                                With Age
                                            </label>

                                            <label style="margin-left:15px;">
                                                <input type="radio" name="economy_child_age" value="no" checked checked>
                                                Without Age
                                            </label>
                                        </div>

                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width economy-child-price">
                                            <label class="mdl-textfield__label">Economy Class Child Ticket Price</label>
                                            <?php echo form_input([
                                                'name' => 'economy_child_ticket_price',
                                                'class' => 'mdl-textfield__input',
                                                'value' => set_value('economy_child_ticket_price')
                                            ]); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-t-20 first price-box" data-type="first_class" style="display:none;">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">First Class Adult Ticket Price</label>
                                            <?php echo form_input([
                                                'name' => 'first_class_ticket_price',
                                                'class' => 'mdl-textfield__input',
                                                'value' => set_value('first_class_ticket_price')
                                            ]); ?>
                                        </div>

                                        <!-- Child Age Option -->
                                        <div class="m-b-10">
                                            <label>Child Ticket Type</label><br>

                                            <label>
                                                <input type="radio" name="first_child_age" value="yes">
                                                With Age
                                            </label>

                                            <label style="margin-left:15px;">
                                                <input type="radio" name="first_child_age" value="no" checked checked>
                                                Without Age
                                            </label>
                                        </div>

                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width first-child-price">
                                            <label class="mdl-textfield__label">First Class Child Ticket Price</label>
                                            <?php echo form_input([
                                                'name' => 'first_class_child_ticket_price',
                                                'class' => 'mdl-textfield__input',
                                                'value' => set_value('first_class_child_ticket_price')
                                            ]); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-t-20 second price-box" data-type="second_class" style="display:none;">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Second Class Adult Ticket Price </label>
                                            <?php echo form_input([
                                                'name' => 'second_class_ticket_price',
                                                'class' => 'mdl-textfield__input',
                                                'value' => set_value('second_class_ticket_price')
                                            ]); ?>
                                        </div>

                                        <!-- Child Age Option -->
                                        <div class="m-b-10">
                                            <label>Child Ticket Type</label><br>

                                            <label>
                                                <input type="radio" name="second_child_age" value="yes">
                                                With Age
                                            </label>

                                            <label style="margin-left:15px;">
                                                <input type="radio" name="second_child_age" value="no" checked checked>
                                                Without Age
                                            </label>
                                        </div>

                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width second-child-price">
                                            <label class="mdl-textfield__label">Second Class Child Ticket Price </label>
                                            <?php echo form_input([
                                                'name' => 'second_class_child_ticket_price',
                                                'class' => 'mdl-textfield__input',
                                                'value' => set_value('second_class_child_ticket_price')
                                            ]); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-t-20 sitting" style="display:none;">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Sitting Ticket Price</label>
                                            <?php echo form_input([
                                                'name'  => 'sitting_ticket_price',
                                                'class' => 'mdl-textfield__input',
                                                'value' => set_value('sitting_ticket_price')
                                            ]); ?>
                                            <?php echo form_error('sitting_ticket_price'); ?>
                                        </div>

                                        <!-- Child Age Option -->
                                        <div class="m-b-10">
                                            <label>Child Ticket Type</label><br>

                                            <label>
                                                <input type="radio" name="sitting_child_age" value="yes">
                                                With Age
                                            </label>

                                            <label style="margin-left:15px;">
                                                <input type="radio" name="sitting_child_age" value="no" checked checked>
                                                Without Age
                                            </label>
                                        </div>

                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width sitting-child-price">
                                            <label class="mdl-textfield__label">Sitting Child Ticket Price</label>
                                            <?php echo form_input([
                                                'name'  => 'sitting_child_ticket_price',
                                                'type'  => 'number',
                                                'class' => 'mdl-textfield__input',
                                                'value' => set_value('sitting_child_ticket_price')
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
                                                'value' => set_value('vip_ticket_price')
                                            ]); ?>
                                            <?php echo form_error('vip_ticket_price'); ?>
                                        </div>

                                        <!-- Child Age Option -->
                                        <div class="m-b-10">
                                            <label>Child Ticket Type</label><br>

                                            <label>
                                                <input type="radio" name="vip_child_age" value="yes">
                                                With Age
                                            </label>

                                            <label style="margin-left:15px;">
                                                <input type="radio" name="vip_child_age" value="no" checked checked>
                                                Without Age
                                            </label>
                                        </div>

                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width vip-child-price">
                                            <label class="mdl-textfield__label">Vip Child Ticket Price</label>
                                            <?php echo form_input([
                                                'name'  => 'vip_child_ticket_price',
                                                'type'  => 'number',
                                                'class' => 'mdl-textfield__input',
                                                'value' => set_value('vip_child_ticket_price')
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
                                                'value' => set_value('sleeper_class_ticket_price')
                                            ]); ?>
                                            <?php echo form_error('sleeper_class_ticket_price'); ?>
                                        </div>

                                        <!-- Child Age Option -->
                                        <div class="m-b-10">
                                            <label>Child Ticket Type</label><br>

                                            <label>
                                                <input type="radio" name="sleeper_child_age" value="yes">
                                                With Age
                                            </label>

                                            <label style="margin-left:15px;">
                                                <input type="radio" name="sleeper_child_age" value="no" checked checked>
                                                Without Age
                                            </label>
                                        </div>

                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width sleeper-child-price">
                                            <label class="mdl-textfield__label">Sleeper Class Child Ticket Price</label>
                                            <?php echo form_input([
                                                'name'  => 'sleeper_class_child_ticket_price',
                                                'type'  => 'number',
                                                'class' => 'mdl-textfield__input',
                                                'value' => set_value('sleeper_class_child_ticket_price')
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
                                                'value' => set_value('coupe_class_ticket_price')
                                            ]); ?>
                                            <?php echo form_error('coupe_class_ticket_price'); ?>
                                        </div>

                                        <!-- Child Age Option -->
                                        <div class="m-b-10">
                                            <label>Child Ticket Type</label><br>

                                            <label>
                                                <input type="radio" name="coupe_child_age" value="yes">
                                                With Age
                                            </label>

                                            <label style="margin-left:15px;">
                                                <input type="radio" name="coupe_child_age" value="no" checked checked>
                                                Without Age
                                            </label>
                                        </div>

                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width couple-child-price">
                                            <label class="mdl-textfield__label">Coupe Class Child Ticket Price</label>
                                            <?php echo form_input([
                                                'name'  => 'coupe_class_child_ticket_price',
                                                'type'  => 'number',
                                                'class' => 'mdl-textfield__input',
                                                'value' => set_value('coupe_class_child_ticket_price')
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
                                                'value' => set_value('sv_class_ticket_price')
                                            ]); ?>
                                            <?php echo form_error('sv_class_ticket_price'); ?>
                                        </div>

                                        <!-- Child Age Option -->
                                        <div class="m-b-10">
                                            <label>Child Ticket Type</label><br>

                                            <label>
                                                <input type="radio" name="sv_child_age" value="yes">
                                                With Age
                                            </label>

                                            <label style="margin-left:15px;">
                                                <input type="radio" name="sv_child_age" value="no" checked>
                                                Without Age
                                            </label>
                                        </div>

                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width sv-child-price">
                                            <label class="mdl-textfield__label">Sv Class Child Ticket Price</label>
                                            <?php echo form_input([
                                                'name'  => 'sv_class_child_ticket_price',
                                                'type'  => 'number',
                                                'class' => 'mdl-textfield__input',
                                                'value' => set_value('sv_class_child_ticket_price')
                                            ]); ?>
                                            <?php echo form_error('sv_class_child_ticket_price'); ?>
                                        </div>
                                    </div>
                                     <div class="col-lg-4 p-t-20 luxe price-box" data-type="luxe_class" style="display:none;">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Luxe Class Adult Ticket Price</label>
                                            <?php echo form_input([
                                                'name' => 'luxe_ticket_price',
                                                'class' => 'mdl-textfield__input',
                                                'value' => set_value('luxe_ticket_price')
                                            ]); ?>
                                        </div>                                        
                                        <!-- Child Age Option -->
                                        <div class="m-b-10">
                                            <label>Child Ticket Type</label><br>

                                            <label>
                                                <input type="radio" name="luxe_child_age" value="yes">
                                                With Age
                                            </label>

                                            <label style="margin-left:15px;">
                                                <input type="radio" name="luxe_child_age" value="no" checked checked>
                                                Without Age
                                            </label>
                                        </div>

                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width luxe-child-price">
                                            <label class="mdl-textfield__label">Luxe Class Child Ticket Price</label>
                                            <?php echo form_input([
                                                'name' => 'luxe_child_ticket_price',
                                                'class' => 'mdl-textfield__input',
                                                'value' => set_value('luxe_child_ticket_price')
                                            ]); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-t-20 open_plan price-box" data-type="open_plan_class" style="display:none;">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Open Plan Class Adult Ticket Price</label>
                                            <?php echo form_input([
                                                'name' => 'open_plan_ticket_price',
                                                'class' => 'mdl-textfield__input',
                                                'value' => set_value('open_plan_ticket_price')
                                            ]); ?>
                                        </div>

                                        
                                        <!-- Child Age Option -->
                                        <div class="m-b-10">
                                            <label>Child Ticket Type</label><br>

                                            <label>
                                                <input type="radio" name="open_plan_child_age" value="yes">
                                                With Age
                                            </label>

                                            <label style="margin-left:15px;">
                                                <input type="radio" name="open_plan_child_age" value="no" checked checked>
                                                Without Age
                                            </label>
                                        </div>

                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width open_plan-child-price">
                                            <label class="mdl-textfield__label">Open plan Class Child Ticket Price</label>
                                            <?php echo form_input([
                                                'name' => 'open_plan_child_ticket_price',
                                                'class' => 'mdl-textfield__input',
                                                'value' => set_value('open_plan_child_ticket_price')
                                            ]); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-t-20 couple price-box" data-type="couple_class" style="display:none;">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Couple Plan Class Adult Ticket Price</label>
                                            <?php echo form_input([
                                                'name' => 'couple_ticket_price',
                                                'class' => 'mdl-textfield__input',
                                                'value' => set_value('couple_ticket_price')
                                            ]); ?>
                                        </div>

                                        
                                        <!-- Child Age Option -->
                                        <div class="m-b-10">
                                            <label>Child Ticket Type</label><br>

                                            <label>
                                                <input type="radio" name="couple_child_age" value="yes">
                                                With Age
                                            </label>

                                            <label style="margin-left:15px;">
                                                <input type="radio" name="couple_child_age" value="no" checked checked>
                                                Without Age
                                            </label>
                                        </div>

                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width couple-child-price">
                                            <label class="mdl-textfield__label">Couple Class Child Ticket Price</label>
                                            <?php echo form_input([
                                                'name' => 'couple_child_ticket_price',
                                                'class' => 'mdl-textfield__input',
                                                'value' => set_value('couple_child_ticket_price')
                                            ]); ?>
                                        </div>
                                    </div>
                                </div>
                                    <div class="card-body row">
                                        <div class="col-lg-4">
                                            <input type="checkbox" id="same_time_checkbox" name="same_time_checkbox" value="1"> 
                                            <label for="same_time_checkbox" style="font-weight: 600;">Apply Same Time for All Days</label>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="" style="font-weight: 600;">Departing Time</label>
                                        </div><div class="col-lg-4">
                                            <label for="" style="font-weight: 600;">Arrival Time</label>
                                        </div>
                                    </div>

                                    <?php 
                                    $days = ['monday','tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                                    foreach ($days as $day) { 
                                    ?>
                                    <div class="card-body row">
                                        <div class="col-lg-4">
                                            <input type="checkbox" name="operational_days[]" value="<?php echo $day; ?>" class="day-checkbox"> <?php echo ucfirst($day); ?>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="time" name="departure_time[]" id="departure_<?php echo $day; ?>" class="mdl-textfield__input" >
                                        </div>
                                        <div class="col-lg-4 ">
                                            <input type="time" name="arrival_time[]" id="arrival_<?php echo $day; ?>" class="mdl-textfield__input" >
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="col-lg-12 p-t-20 text-center">
                                        <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>
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
    </div>
<script>
    document.getElementById('same_time_checkbox').addEventListener('change', function() {
        const isChecked = this.checked;
        const depMonday = document.getElementById('departure_monday').value;
        const arrMonday = document.getElementById('arrival_monday').value;
        const days = ['tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        
        const dayCheckboxes = document.querySelectorAll('.day-checkbox');

        if (isChecked) {
            if (depMonday === '' || arrMonday === '') {
                alert('Please enter Monday Departure and Arrival times first.');
                this.checked = false;
                return;
            }

            dayCheckboxes.forEach(chk => {
                chk.checked = true;
                const day = chk.value;
                document.getElementById('departure_' + day).value = depMonday;
                document.getElementById('arrival_' + day).value = arrMonday;
            });
        } else {
            dayCheckboxes.forEach(chk => {
                chk.checked = false;
                const day = chk.value;
                document.getElementById('departure_' + day).value = '';
                document.getElementById('arrival_' + day).value = '';
            });
        }
    });

    document.querySelectorAll('.day-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const day = this.value;
            const depInput = document.getElementById('departure_' + day);
            const arrInput = document.getElementById('arrival_' + day);
            const depMonday = document.getElementById('departure_monday').value;
            const arrMonday = document.getElementById('arrival_monday').value;

            if (this.checked) {
                depInput.value = depMonday;
                arrInput.value = arrMonday;
            } else {
                depInput.value = '';
                arrInput.value = '';
            }
        });
    });

</script>
<script>
    $(document).ready(function() {
        $('#airline_id').change(function() {
            let airlineId = $(this).val();
            if (airlineId !== "") {
                $.ajax({
                    url: "<?= base_url('get-airline-code') ?>",
                    type: "POST",
                    data: { airline_id: airlineId },
                    dataType: "json",
                    success: function(response) {
                        if (response.status === "success") {
                            $('#flight_prefix').val(response.code); 
                        } else {
                            $('#flight_prefix').val('');
                        }
                    }
                });
            } else {
                $('#flight_prefix').val('');
            }
        });
    });

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
                                options += '<option value="' + train.id + '">' + train.train_name;
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
            } else {
                $('#train_id').html('<option value="">Select Country First</option>');
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
        
        $('#country').on('blur', function() {
            var countryName = $(this).val();
            if(countryName && countryName.trim() !== '') {
                loadTrainsByCountry(countryName);
                initCityAutocomplete(countryName);
            }
        });
        
        // Clear train dropdown when country is cleared
        $('#country').on('input', function() {
            if($(this).val() === '') {
                $('#train_id').html('<option value="">Select Country First</option>');
                $("#departing_station").autocomplete("destroy");
                $("#arrival_station").autocomplete("destroy");
            }
        });
        
        // For edit mode - load trains if country is already set
        <?php if(!empty($edit_data->country)): ?>
            loadTrainsByCountry('<?php echo $edit_data->country; ?>');
            initCityAutocomplete('<?php echo $edit_data->country; ?>');
        <?php endif; ?>
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
              // Open Plan
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
        });
    });
</script>