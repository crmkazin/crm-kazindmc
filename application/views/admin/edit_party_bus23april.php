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
<!-- END HEAD -->a

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
                                <div class="page-title">Edit Party Bus</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
								<li class="active"><a class="parent-item"
                                        href="<?= base_url(); ?>party-bus">Party Bus</a>&nbsp;<i
                                        class="fa fa-angle-right"></i> </li>
                                <li class="active">Edit Party Bus</li>
                            </ol>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head">
                                    <header>Edit Party Bus</header>
                                    <div class="tools">
                                        <a href="party-bus" class="btn btn-success" style="padding: 6px;"><i
                                                class="fa fa-file-text-o"></i> List</a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>
                                <form method="post" action="<?php echo base_url('edit-party-data-bus')?>"
                                    enctype="multipart/form-data">
                                    <input name="bus_id" value="<?= $party_bus[0]->id ?>" type="hidden">
                                    <div class="card-body row">
                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name' => 'file_number', 'id' => 'name', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => $party_bus[0]->file_number, 'readonly' => 'readonly'])
                                                    ?>
                                                <label class="mdl-textfield__label">File Number</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="enquiry_form" id="enquiry_form"
                                                    class="mdl-textfield__input" required>
                                                    <option value="kazin"
                                                        <?php echo ($party_bus[0]->enquiry_form == 'kazin') ? 'selected' : ''; ?>>
                                                        Kazin Query</option>
                                                    <option value="local"
                                                        <?php echo ($party_bus[0]->enquiry_form == 'local') ? 'selected' : ''; ?>>
                                                        Local</option>
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
                                                    'title' => 'Please enter a combination of letters and numbers.',
                                                    'value' => $party_bus[0]->kazin_query
                                                ]) ?>
                                                <label class="mdl-textfield__label">Kazin Query Number</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <input type="text" name="start_time" id="start_time_slot_text"
                                                    class="mdl-textfield__input" required>
                                                <select name="start_time_slot_select" id="start_time_slot_select"
                                                    class="mdl-textfield__input" style="display: none;">
                                                    <option value="">Select..</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="18:00">18:00</option>
                                                    <option value="20:00">20:00</option>
                                                    <option value="22:00">22:00</option>
                                                </select>
                                                <label class="mdl-textfield__label">Start Time</label>
                                            </div>
                                        </div>


                                        <div class="col-lg-2 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <input type="text" name="end_time" id="end_time_slot_text"
                                                    class="mdl-textfield__input" required>
                                                <select name="end_time_slot_select" id="end_time_slot_select"
                                                    class="mdl-textfield__input" style="display: none;">
                                                    <option value="">Select..</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="18:00">18:00</option>
                                                    <option value="20:00">20:00</option>
                                                    <option value="22:00">22:00</option>
                                                    <option value="24:00">24:00</option>
                                                </select>
                                                <label class="mdl-textfield__label">End Time</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20">
                                            <!--div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php //echo form_input(['name' => 'date_of_booking', 'type' => 'date', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => $party_bus[0]->date_of_booking]) ?>
                                                <label class="mdl-textfield__label">Date of Booking</label>
                                            </div-->
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
												style="display:inline-flex;">
												<input type="text" name=""
													class="mdl-textfield__input dt-search-show" style="width:90%;"
													value="<?php echo ($party_bus[0]->date_of_booking <> '') ? date('d M Y', strtotime($party_bus[0]->date_of_booking)) : ''; ?>"
													readonly>
												<?php echo form_input(['type' => 'date', 'name' => 'date_of_booking', 'placeholder' => '', 'id' => 'date_of_booking', 'class' => 'dts mdl-textfield__input dt-search', 'value' => $party_bus[0]->date_of_booking,'style' => 'width:20px;float:right;']) ?>
												<label class="mdl-textfield__label">Date of Booking</label>
											</div>
											
                                        </div>

                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name' => 'reporting_location', 'id' => 'reporting_location', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => $party_bus[0]->reporting_location]) ?>
                                                <label class="mdl-textfield__label">Reporting Location</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name' => 'end_location', 'id' => 'end_location', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => $party_bus[0]->end_location]) ?>
                                                <label class="mdl-textfield__label">End Location
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name' => 'passengers', 'id' => 'passengers', 'class' => 'mdl-textfield__input', 'required' => 'required', 'pattern' => '[0-9]*', 'value' => $party_bus[0]->number_of_passengers]) ?>
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
                                                            $selected = ($party_bus[0]->package == $package->id) ? 'selected' : '';
                                                            echo '<option value="' . $package->id . '" data-price="' . $package->price . '" ' . $selected . '>' . $package->package . '</option>';
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
                                                    <option value="1.00">USD
                                                    </option>
                                                    <?php
foreach ($currency as $list) {
    $selected = ($party_bus[0]->currency == $list->currency_abbr) ? 'selected' : ''; ?>
                                                    <option value="<?php echo $list->country_currency_value; ?>"
                                                        <?php echo $selected; ?>>
                                                        <?php echo $list->currency_abbr; ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                                <label class="mdl-textfield__label">Currency</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name' => 'package_price', 'id' => 'package_price', 'class' => 'mdl-textfield__input', 'pattern' => '[0-9]*', 'required' => 'required', 'value' => $party_bus[0]->package_price]) ?>
                                                <label class="mdl-textfield__label">Package Price
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name' => 'payment_recieved', 'id' => 'payment_recieved', 'class' => 'mdl-textfield__input', 'pattern' => '[0-9]*', 'required' => 'required', 'value' => $party_bus[0]->payment_recieved]) ?>
                                                <label class="mdl-textfield__label">Payment Recieved</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name' => 'balance', 'id' => 'balance', 'class' => 'mdl-textfield__input', 'pattern' => '[0-9]*', 'required' => 'required', 'readonly' => 'readonly', 'value' => $party_bus[0]->balance]) ?>
                                                <label class="mdl-textfield__label">Balance</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name' => 'purchase_cost', 'id' => 'purchase_cost', 'class' => 'mdl-textfield__input', 'pattern' => '[0-9]*','value' => $party_bus[0]->purchase_cost]) ?>
                                                <label class="mdl-textfield__label">Purchase Cost</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name' => 'net_margin', 'id' => 'net_margin', 'class' => 'mdl-textfield__input', 'pattern' => '[0-9]*', 'readonly' => 'readonly','value' => $party_bus[0]->net_margin]) ?>
                                                <label class="mdl-textfield__label">Net Margin</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name' => 'remarks', 'id' => 'remarks', 'class' => 'mdl-textfield__input','value' => $party_bus[0]->remarks]) ?>
                                                <label class="mdl-textfield__label">Remarks</label>
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
    $(document).ready(function() {

        $("#purchase_cost").on("blur", function() {
            $("#net_margin").val('');
            if ($("#package_price").val() != '' && $("#purchase_cost").val() != '') {
                $("#net_margin").val(parseInt($("#package_price").val()) - parseInt($("#purchase_cost")
                    .val()));
            }
        });
        
        $('#kazin_query').on("blur",function(){	
		   var n = $(this).val();
           $('#kazin_query').val(n.trim());
		});
        
        var initialStartTimeSlot = "<?= $party_bus[0]->start_time ?>";
        $('#start_time_slot_text').val(initialStartTimeSlot);
        $('#start_time_slot_select').val(initialStartTimeSlot);

        var initialEndTimeSlot = "<?= $party_bus[0]->end_time ?>";
        $('#end_time_slot_text').val(initialEndTimeSlot);
        $('#end_time_slot_select').val(initialEndTimeSlot);

        function initializeEnquiryForm(selectedValue) {
            if (selectedValue === 'kazin') {
                $('#kazin_query_field').show();
                $('#kazin_query').prop('required', true);
                $('#package_field').show();

                $('#currency').change(function() {
                    $('#package').change(); // Update package price when currency changes
                });

                $('#package').change(function() {
                    var packageId = $(this).val();
                    var packagePrice = $(this).find('option:selected').data('price');
                    var currency = $('#currency').val();

                    currency *= packagePrice;

                    $('#package_price').prop('readonly', true);
                    $('#package_price').val(Math.round(currency));
                });

            } else {
                $('#kazin_query_field').hide();
                $('#package_field').hide();
                $('#package_price').prop('readonly', false);
            }
        }

        // Get the initial value of enquiry form
        var selectedValue = $('#enquiry_form').val();

        // Initialize the form fields based on the initial value
        initializeEnquiryForm(selectedValue);

        $('#enquiry_form').on('change', function() {
            var selectedValue = $(this).val();

            if (selectedValue === 'kazin') {
                $('#kazin_query_field').show();
                $('#kazin_query').prop('required', true);
                $('#package_field').show();

                $('#currency').change(function() {
                    $('#package').change(); // Update package price when currency changes
                });

                $('#package').change(function() {
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
                $('#kazin_query').val('');
                $('#package').val('');
                $('#package_field').hide();
                $('#kazin_query').prop('required', false);
                $('#package_price').prop('readonly', false);
            }
        });

        $('#payment_recieved').on('input', function() {
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

        $('#start_time_slot_text, #end_time_slot_text').on('focus', function() {
            $(this).next('select').show(); // Show the corresponding select element
        });

        $('#start_time_slot_select, #end_time_slot_select').on('change', function() {
            var selectedValue = $(this).val();
            $(this).prev('input').val(selectedValue); // Update the input value with the selected value
            $(this).hide(); // Hide the select element
        });

        $('#start_time_slot_text, #end_time_slot_text').on('input', function() {
            $(this).next('select').hide(); // Hide the corresponding select element
        });

        $('#start_time_slot_text, #end_time_slot_text').on('input', function() {
            var inputValue = $(this).val();
            var sanitizedValue = inputValue.replace(/[^0-9:-]/g,
                ''); // Remove any characters that are not numbers, colons, or hyphens
            sanitizedValue = sanitizedValue.substring(0,
                5); // Limit the input to a maximum of 5 characters
            $(this).val(sanitizedValue); // Update the input value to remove invalid characters

            if (inputValue !== sanitizedValue) {
                alert(
                    'Please enter only numbers, colons (:) and hyphens (-) with a maximum of 5 characters.'
                );
            }
        });
		
		$(".dt-search").on("change", function () {
			var idx = $(this).index(".dt-search");
			const selectedDate = new Date($(".dt-search").eq(idx).val());
			if(selectedDate == "Invalid Date"){ selectedDate = new Date(); }
			//const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
			const options = {
				year: 'numeric',
				month: 'short',
				day: '2-digit'
			};
			const formattedDate = selectedDate.toLocaleDateString('en-IN', options);
			$(".dt-search-show").eq(idx).val(formattedDate).parent().addClass('is-focused');
		});

    });
    </script>


</body>

</html>