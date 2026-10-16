    <?php include ('admin_head_css.php'); ?>
    <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet">
   <div class="page-wrapper">
        <!-- start page container -->
        <div class="container-fluid">
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                            <h4 class="text-themecolor">Edit Party Bus</h4>
                        </div>
                        <div class="col-lg-2 only-for-dashbord">
                        </div>
                        <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('party-bus'); ?>">Party Bus List</a></li>
                                    <li class="breadcrumb-item active">Edit Party Bus</li>
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
                              
                                <form method="post" action="<?php echo base_url('edit-party-data-bus')?>"
                                    enctype="multipart/form-data">
                                    <input name="bus_id" value="<?= $party_bus[0]->id ?>" type="hidden">
                                    <div class="card-body row">
                                        <div class="col-lg-4 p-t-20">
                                            <label class="mdl-textfield__label">File Number</label>
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name' => 'file_number', 'id' => 'name', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => $party_bus[0]->file_number, 'readonly' => 'readonly'])
                                                    ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Enquiry From</label>
                                                <select name="enquiry_form" id="enquiry_form"
                                                    class="mdl-textfield__input" required>
                                                    <option value="kazin"
                                                        <?php echo ($party_bus[0]->enquiry_form == 'kazin') ? 'selected' : ''; ?>>
                                                        Kazin Query</option>
                                                    <option value="local"
                                                        <?php echo ($party_bus[0]->enquiry_form == 'local') ? 'selected' : ''; ?>>
                                                        Local</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20" id="kazin_query_field" style="display: none;">
                                            <label class="mdl-textfield__label">Kazin Query Number</label>
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
                                            </div>
                                        </div>

                                        <div class="col-lg-2 p-t-20">
                                            <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Start Time</label>
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
                                            </div>
                                        </div>


                                        <div class="col-lg-2 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">End Time</label>
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
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20">
                                            <!--div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php //echo form_input(['name' => 'date_of_booking', 'type' => 'date', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => $party_bus[0]->date_of_booking]) ?>
                                                <label class="mdl-textfield__label">Date of Booking</label>
                                            </div-->
                                            <label class="mdl-textfield__label">Date of Booking</label>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
												style="display:inline-flex;">
												<input type="text" name=""
													class="mdl-textfield__input dt-search-show" style="width:100%;"
													value="<?php echo ($party_bus[0]->date_of_booking <> '') ? date('d M Y', strtotime($party_bus[0]->date_of_booking)) : ''; ?>"
													readonly>
												<?php echo form_input(['type' => 'date', 'name' => 'date_of_booking', 'placeholder' => '', 'id' => 'date_of_booking', 'class' => 'dts dt-search', 'value' => $party_bus[0]->date_of_booking,'style' => 'width:17px;float:right;position: absolute; right: 3%; border: none;background-color: transparent;top: 50%; transform: translateY(-50%);']) ?>
											</div>											
                                        </div>

                                        <div class="col-lg-4 p-t-20">
                                            <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Reporting Location</label>
                                                <?php echo form_input(['name' => 'reporting_location', 'id' => 'reporting_location', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => $party_bus[0]->reporting_location]) ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">End Location</label>
                                                <?php echo form_input(['name' => 'end_location', 'id' => 'end_location', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => $party_bus[0]->end_location]) ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">No. of Passengers</label>
                                                <?php echo form_input(['name' => 'passengers', 'id' => 'passengers', 'class' => 'mdl-textfield__input', 'required' => 'required', 'pattern' => '[0-9]*', 'value' => $party_bus[0]->number_of_passengers]) ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20" id="package_field" style="display:none;">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Package</label>
                                                <select name="package" id="package" class="mdl-textfield__input">
                                                    <option value="">Select..</option>
                                                    <?php
                                                        foreach ($packages as $package) {
                                                            $selected = ($party_bus[0]->package == $package->id) ? 'selected' : '';
                                                            echo '<option value="' . $package->id . '" data-price="' . $package->price . '" ' . $selected . '>' . $package->package . '</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Currency</label>
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
                                            </div>
                                        </div>
                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Package Price</label>
                                                <?php echo form_input(['name' => 'package_price', 'id' => 'package_price', 'class' => 'mdl-textfield__input', 'pattern' => '[0-9]*', 'required' => 'required', 'value' => $party_bus[0]->package_price]) ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Payment Recieved</label>
                                                <?php echo form_input(['name' => 'payment_recieved', 'id' => 'payment_recieved', 'class' => 'mdl-textfield__input', 'pattern' => '[0-9]*', 'required' => 'required', 'value' => $party_bus[0]->payment_recieved]) ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Balance</label>
                                                <?php echo form_input(['name' => 'balance', 'id' => 'balance', 'class' => 'mdl-textfield__input', 'pattern' => '[0-9]*', 'required' => 'required', 'readonly' => 'readonly', 'value' => $party_bus[0]->balance]) ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Purchase Cost</label>
                                                <?php echo form_input(['name' => 'purchase_cost', 'id' => 'purchase_cost', 'class' => 'mdl-textfield__input', 'pattern' => '[0-9]*','value' => $party_bus[0]->purchase_cost]) ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-2 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Net Margin</label>
                                                <?php echo form_input(['name' => 'net_margin', 'id' => 'net_margin', 'class' => 'mdl-textfield__input', 'pattern' => '[0-9]*', 'readonly' => 'readonly','value' => $party_bus[0]->net_margin]) ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Remarks</label>
                                                <?php echo form_input(['name' => 'remarks', 'id' => 'remarks', 'class' => 'mdl-textfield__input','value' => $party_bus[0]->remarks]) ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 p-t-20 text-center">
                                            <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-info', 'value' => 'Submit']); ?>
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
    </div>
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