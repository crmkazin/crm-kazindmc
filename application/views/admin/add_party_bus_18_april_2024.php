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
    <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet">
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
                                <div class="page-title">Add Party Bus</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Add Party Bus</li>
                            </ol>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head">
                                    <header>Add Party Bus</header>
                                    <div class="tools">
                                        <a href="party-bus" class="btn btn-success" style="padding: 6px;"><i
                                                class="fa fa-file-text-o"></i> List</a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>
                                <form method="post" action="add-party-bus-data" enctype="multipart/form-data">
                                    <div class="card-body row">
                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name' => 'file_number', 'id' => 'name', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => 'PB2024' . $insert_on, 'readonly' => 'readonly'])
                                                    ?>
                                                <label class="mdl-textfield__label">File Number</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="enquiry_form" id="enquiry_form"
                                                    class="mdl-textfield__input" required>
                                                    <option value="">Select..</option>
                                                    <option value="kazin">Kazin Query </option>
                                                    <option value="local">Local</option>
                                                </select>
                                                <label class="mdl-textfield__label">Enquiry From</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20" id="kazin_query_field" style="display: none;">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input([
                                                    'name' => 'kazin_query',
                                                    'id' => 'kazin_query',
                                                    'class' => 'mdl-textfield__input',
                                                    'value' => set_value('kazin_query'),
                                                    'pattern' => '^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]*$',
                                                    'title' => 'Please enter a combination of letters and numbers.'
                                                ]) ?>
                                                <label class="mdl-textfield__label">Kazin Query Number</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name' => 'date_of_booking', 'type' => 'date', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => set_value('date_of_booking'), 'min' => date('Y-m-d')]) ?>
                                                <label class="mdl-textfield__label">Date of Booking</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <input type="text" name="time_slot" id="time_slot_text"
                                                    class="mdl-textfield__input" required>
                                                <select name="time_slot_select" id="time_slot_select"
                                                    class="mdl-textfield__input" style="display: none;">
                                                    <option value="">Select..</option>
                                                    <option value="12:00-14:00">12:00-14:00</option>
                                                    <option value="14:00-16:00">14:00-16:00</option>
                                                    <option value="16:00-18:00">16:00-18:00</option>
                                                    <option value="18:00-20:00">18:00-20:00</option>
                                                    <option value="20:00-22:00">20:00-22:00</option>
                                                    <option value="22:00-24:00">22:00-24:00</option>
                                                </select>
                                                <label class="mdl-textfield__label">Time Slot</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name' => 'reporting_location', 'id' => 'reporting_location', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => set_value('reporting_location')]) ?>
                                                <label class="mdl-textfield__label">Reporting Location</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name' => 'end_location', 'id' => 'end_location', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => set_value('end_location')]) ?>
                                                <label class="mdl-textfield__label">End Location
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name' => 'passengers', 'id' => 'passengers', 'class' => 'mdl-textfield__input', 'required' => 'required', 'pattern' => '[0-9]*', 'value' => set_value('passengers')]) ?>
                                                <label class="mdl-textfield__label">No. of Passengers</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20" id="package_field" style="display:none;">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="package" id="package" class="mdl-textfield__input">
                                                    <option value="">Select..</option>
                                                    <?php
                                                    foreach ($packages as $package) {
                                                        echo '<option value="' . $package->id . '" data-price="' . $package->price . '" >' . $package->package . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <label class="mdl-textfield__label">Package</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="currency" id="currency" class="mdl-textfield__input"
                                                    required>
                                                    <option value="usd">USD
                                                    </option>
                                                    <option value="kzt">KZT
                                                    </option>
                                                </select>
                                                <label class="mdl-textfield__label">Currency</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name' => 'package_price', 'id' => 'package_price', 'class' => 'mdl-textfield__input', 'pattern' => '[0-9]*', 'required' => 'required']) ?>
                                                <label class="mdl-textfield__label">Package Price
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name' => 'payment_recieved', 'id' => 'payment_recieved', 'class' => 'mdl-textfield__input', 'pattern' => '[0-9]*', 'required' => 'required']) ?>
                                                <label class="mdl-textfield__label">Payment Recieved</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name' => 'balance', 'id' => 'balance', 'class' => 'mdl-textfield__input', 'pattern' => '[0-9]*', 'required' => 'required', 'readonly' => 'readonly']) ?>
                                                <label class="mdl-textfield__label">Balance</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 p-t-20 text-center">
                                            <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value' => 'Submit']); ?>
                                        </div>
                                    </div>
                                </form>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(function () {
            $('.js-example-basic-multiple').select2({
                //theme: 'filled',
                placeholder: 'Region',
                width: '400px'
            });
        });

        $(document).ready(function () {
            $("#type").on("change", function () {
                $("#region").removeAttr("required").parent().parent().addClass("hide");
                if ($(this).val() === "5") {
                    $("#region").attr("required", "required").parent().parent().removeClass("hide");
                }
            });
        });

        $(document).ready(function () {

            $("#country").autocomplete({
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/get_country_ajax",
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
                    // Set selection
                    $('#country').val(ui.item.label); // display the selected text
                    $('#country_id').val(ui.item.country_id); // save selected id to input

                    return false;
                }
            });

            $("#state").autocomplete({
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/get_state_ajax",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term,
                            country_id: $('#country_id').val()
                        },
                        success: function (data) {

                            response(data);
                        }
                    });
                },
                select: function (event, ui) {
                    // Set selection
                    $('#state').val(ui.item.label); // display the selected text
                    $('#state_id').val(ui.item.state_id); // save selected id to input

                    return false;
                }
            });

            $("#city").autocomplete({
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/get_city_ajax",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term,
                            state_id: $('#state_id').val()
                        },
                        success: function (data) {

                            response(data);
                        }
                    });
                },
                select: function (event, ui) {
                    // Set selection
                    $('#city').val(ui.item.label); // display the selected text
                    //   $('#company_id').val(ui.item.company_id); // save selected id to input

                    return false;
                }
            });


        });
    </script>

    <script>
        $(document).ready(function () {

            $('#enquiry_form').on('change', function () {
                var selectedValue = $(this).val();

                if (selectedValue === 'kazin') {
                    $('#kazin_query_field').show();
                    $('#kazin_query').prop('required', true);
                    $('#package_field').show();

                    $('#currency').change(function () {
                        $('#package').change(); // Update package price when currency changes
                    });

                    $('#package').change(function () {
                        var packageId = $(this).val();
                        var packagePrice = $(this).find('option:selected').data('price');
                        var currency = $('#currency').val();

                        if (currency === 'kzt') {
                            packagePrice *=
                                446; // Example conversion rate, replace with your actual conversion rate
                        }
                        $('#package_price').prop('readonly', true);
                        $('#package_price').val(Math.round(packagePrice));
                    });

                } else {
                    $('#kazin_query_field').hide();
                    $('#package_field').hide();
                    $('#package_price').prop('readonly', false);
                }
            });

            $('#payment_recieved').on('input', function () {
                var packagePrice = parseInt($('#package_price').val()) || 0;
                var paymentRecieved = parseInt($(this).val()) || 0;
                var balance = packagePrice - paymentRecieved;

                if (balance < 0) {
                    $('#payment_recieved').val('');
                    $('#balance').val('')
                } else {
                    // If balance is positive or zero, remove the red color and show the value normally
                    $('#balance').removeClass('text-danger').val(balance);
                }
            });

            $('#time_slot_text').on('focus', function () {
                $('#time_slot_select').show();
            });

            $('#time_slot_select').on('change', function () {
                var selectedValue = $(this).val();
                $('#time_slot_text').val(selectedValue);
                $(this).hide();
            });

            $('#time_slot_text').on('input', function () {
                $('#time_slot_select').hide();
            });

            $('#time_slot_text').on('input', function () {
                var inputValue = $(this).val();
                var sanitizedValue = inputValue.replace(/[^0-9:-]/g,
                    ''); // Remove any characters that are not numbers, colons, or hyphens
                sanitizedValue = sanitizedValue.substring(0,
                    11); // Limit the input to a maximum of 11 characters
                $(this).val(sanitizedValue); // Update the input value to remove invalid characters

                if (inputValue !== sanitizedValue) {
                    alert(
                        'Please enter only numbers, colons (:) and hyphens (-) with a maximum of 11 characters.'
                    );
                }
            });

        });
    </script>


</body>

</html>