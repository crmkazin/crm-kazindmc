<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <?php include('admin_head_css.php');?>

</head>
<!-- END HEAD -->

<body
    class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
    <div class="page-wrapper">
        <!-- start header -->
        <?php include('header.php');?>
        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">
            <!-- start sidebar menu -->
            <?php include('side_bar.php');?>
            <!-- end sidebar menu -->
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Add Airline Schedule</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i clflight_modelass="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?=base_url();?>dashboard">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Add Airline Schedule</li>
                            </ol>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head">
                                    <header>Add New Airline</header>
                                    <div class="tools">
                                        <a href="all-flight-schedule" class="btn btn-success" style="padding: 6px;"><i
                                                class="fa fa-file-text-o"></i> List</a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>


                                <?php echo form_open(current_url().'?'.$_SERVER['QUERY_STRING']); ?>
                                <div class="card-body row">
                                    
                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <select name="airline_id" id="airline_id" class="mdl-textfield__input" style="padding-top:13px;">
                                                <option value="">Select.. </option>
                                                <?php foreach($airlines AS $list){ 
                                                ?>
                                                    <option value="<?=$list->id ?>" <?php echo ($flight_schedule->airline_id == $list->id)?'selected="selected"':''; ?> ><?=$list->name; ?></option>
                                                <?php } ?>
                                            </select>
                                            <label class="mdl-textfield__label">Airline</label>
                                            <?php echo form_error('airline_name'); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <div style="display: flex; align-items: center;">
                                                <input type="text" id="flight_prefix" class="mdl-textfield__input" 
                                                    style="width: 7%; background-color: rgb(246, 247, 248);;" readonly placeholder="">
                                                    <?php echo form_input(['name' => 'flight_number', 'id' => 'flight_suffix', 'class' => 'mdl-textfield__input', 'required' => 'required', 'style'=>'width: 93%;','placeholder' => '', 'value' => $flight_schedule->flight_number]); ?>
                                            </div>
                                            <label class="mdl-textfield__label">Flight No.</label>
                                            <?php echo form_error('code'); ?>
                                        </div>
                                    </div>
                                   
                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'departure_airport', 'id' => 'departure_airport', 'class' => 'mdl-textfield__input', 'required' => 'required','placeholder' => '', 'value' => $flight_schedule->departure_airport]); ?>
                                            <label class="mdl-textfield__label">Departing Airport</label>
                                            <?php echo form_error('departing_airport'); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'departure_city', 'id' => 'departure_city', 'class' => 'mdl-textfield__input', 'required' => 'required','placeholder' => '', 'value' => $flight_schedule->departure_city]); ?>
                                            <label class="mdl-textfield__label">Departing City</label>
                                            <?php echo form_error('departing_city'); ?>
                                        </div>
                                    </div>
                                    
                                    <!-- <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"> -->
                                            <?php //echo form_input(['type'=>'time','name' => 'departure_time', 'id' => 'departure_time', 'class' => 'mdl-textfield__input', 'required' => 'required','placeholder' => '', 'value' => $flight_schedule->departure_time]); ?>
                                            <!-- <label class="mdl-textfield__label">Departing Time</label> -->
                                            <?php //echo form_error('departing_time'); ?>
                                        <!-- </div>
                                    </div> -->
                                    
                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'arrival_airport', 'id' => 'arrival_airport', 'class' => 'mdl-textfield__input', 'required' => 'required','placeholder' => '', 'value' =>$flight_schedule->arrival_airport]); ?>
                                            <label class="mdl-textfield__label">Arrival Airport</label>
                                            <?php echo form_error('arrival_airport'); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'arrival_city', 'id' => 'arrival_city', 'class' => 'mdl-textfield__input', 'required' => 'required','placeholder' => '', 'value' => $flight_schedule->arrival_city]); ?>
                                            <label class="mdl-textfield__label">Arrival City</label>
                                            <?php echo form_error('arrival_city'); ?>
                                        </div>
                                    </div>
                                    
                                    <!-- <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"> -->
                                            <?php //echo form_input(['type'=>'time','name' => 'arrival_time', 'id' => 'arrival_time', 'class' => 'mdl-textfield__input', 'required' => 'required','placeholder' => '', 'value' => $flight_schedule->arrival_time]); ?>
                                            <!-- <label class="mdl-textfield__label">Arrival Time</label> -->
                                            <?php //echo form_error('arrival_time'); ?>
                                        <!-- </div>
                                    </div> -->
                                </div>
                                    <!-- <div class="col-lg-12 p-t-20">
                                        <div class="" style="font-weight:500;">
                                            <label class="">Days Of Operation</label><br>
                                            <?php $weekdays = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday','daily']; 
                                            $arr = explode(',', $flight_schedule->days_of_operations);
                                                foreach($weekdays AS $list){
                                            ?>
                                            <input type="checkbox" name="operational_days[]" value="<?=$list ?>" <?php echo (in_array($list,$arr))?'checked="checked"':''; ?>> <?=ucfirst($list) ?>
                                            <?php } ?>
                                            
                                        </div>
                                    </div> -->
                                    <div class="card-body row">
                                        <div class="col-lg-12">
                                            <input type="checkbox" id="same_time_checkbox"> 
                                            <label for="same_time_checkbox" style="font-weight: 600;">Apply Same Time for All Days & Select All</label>
                                        </div>
                                    </div>

                                    <div class="card-body row">
                                        <div class="col-lg-4">
                                            <label class="mdl-textfield__label">Days Of Operation</label><br><br>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="mdl-textfield__label">Departing Time</label>
                                        </div>
                                        <div class="col-lg-4 p-t-10">
                                            <label class="mdl-textfield__label">Arrival Time</label>
                                        </div>
                                    </div>

                                    <?php 
                                    $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

                                    $arr = explode(',', $flight_schedule->days_of_operations);

                                    foreach ($days as $day) { 
                                        if ($day == 'monday') {
                                            $departure_field = "departure_time";
                                            $arrival_field = "arrival_time";
                                        } else {
                                            $departure_field = $day . "_departure_time";
                                            $arrival_field = $day . "_arrival_time";
                                        }                                    
                                        $departure_time = isset($flight_schedule->$departure_field) ? $flight_schedule->$departure_field : '';
                                        $arrival_time = isset($flight_schedule->$arrival_field) ? $flight_schedule->$arrival_field : '';
                                    ?>
                                        <div class="card-body row ">
                                            <div class="col-lg-4">
                                                <input type="checkbox" name="operational_days[]" value="<?=$day ?>" 
                                                    <?php echo (in_array($day, $arr)) ? 'checked="checked"' : ''; ?> 
                                                    class="day-checkbox"> 
                                                <?php echo ucfirst($day); ?>
                                            </div>
                                            <div class="col-lg-4">
                                                <input type="time" name="departure_time[]" id="departure_<?php echo $day; ?>" 
                                                    value="<?= $departure_time ?>" class="mdl-textfield__input">
                                            </div>
                                            <div class="col-lg-4">
                                                <input type="time" name="arrival_time[]" id="arrival_<?php echo $day; ?>" 
                                                    value="<?= $arrival_time ?>" class="mdl-textfield__input">
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
        <!-- start footer -->
        <?php include('admin_footer.php');?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
    <?php include('admin_footer_js.php');?>
    <!-- end js include path -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sameTimeCheckbox = document.getElementById('same_time_checkbox');
    const days = ['tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

    sameTimeCheckbox.addEventListener('change', function() {
        const isChecked = this.checked;
        const depMonday = document.getElementById('departure_monday').value;
        const arrMonday = document.getElementById('arrival_monday').value;

        const dayCheckboxes = document.querySelectorAll('.day-checkbox');

        if (isChecked) {
            if (depMonday === '' || arrMonday === '') {
                alert('Please enter Monday Departure and Arrival times first.');
                this.checked = false;
                return;
            }

            dayCheckboxes.forEach(chk => chk.checked = true);
            days.forEach(day => {
                document.getElementById('departure_' + day).value = depMonday;
                document.getElementById('arrival_' + day).value = arrMonday;
            });

        } else {
            dayCheckboxes.forEach(chk => {
                if (!chk.checked) {  
                    const day = chk.value;
                    document.getElementById('departure_' + day).value = '';
                    document.getElementById('arrival_' + day).value = '';
                }
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
});

</script>
<script>
   $(document).ready(function() {
    let selectedAirlineId = $('#airline_id').val();
    if (selectedAirlineId !== "") {
        fetchAirlineCode(selectedAirlineId);
    }
    $('#airline_id').change(function() {
        let airlineId = $(this).val();
        if (airlineId !== "") {
            fetchAirlineCode(airlineId);
        } else {
            $('#flight_prefix').val(''); 
        }
    });

    function fetchAirlineCode(airlineId) {
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
    }
});

</script>

</body>

</html>