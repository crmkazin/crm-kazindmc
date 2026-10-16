<?php include('admin_head_css.php'); ?>
<link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet" />
<style>
    .dataTable thead th[class*=sorting]:after{display: none !important;}

    .dataTables_paginate .page-item>.page-link {
        padding: 0 12px !important;
    }

    .form-control {
        border: 1px solid #ede5e5 !important;
    }
</style>

 <div class="page-wrapper">
        <!-- start page container -->
        <div class="container-fluid">
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                            <h4 class="text-themecolor">Restaurant Report</h4>
                        </div>
                        <div class="col-lg-2 only-for-dashbord">
                        </div>
                        <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Restaurant Report</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content">
                    <?php //include('report_links.php'); ?>
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                
                                <form method="get" class="content">
                                    <div class="card-body row">

                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Location</label>
                                                <select name="country" id="country" class="mdl-textfield__input bg-white"
                                                    style="padding: 10px;">
                                                    <option value="">Select..</option>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" name="country_id" id="country_id" value="<?php echo $country['country_id']; ?>">
                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">City</label>
                                                <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'bg-white mdl-textfield__input', 'value' => $this->input->get('city')]); ?>
                                                <?php echo form_error('city'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Restaurants</label>
                                                <select name="restaurants[]" id="restaurants" class="bg-white mdl-textfield__input js-example-basic-multiple" multiple=""
                                                    style="padding: 10px;">
                                                    <option value="">Select..</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Speciality</label>
                                                <select name="specility" class="bg-white mdl-textfield__input">
                                                    <option value="">All</option>
                                                    <option value="indian">Indian</option>
                                                    <option value="asian">Asian</option>
                                                    <option value="pan asian">Pan Asian</option>
                                                    <option value="chinese">Chinese</option>
                                                    <option value="italian">Italian</option>
                                                    <option value="georgian">Georgian</option>
                                                    <option value="kazakh">Kazakh</option>
                                                    <option value="uzbek">Uzbek</option>
                                                    <option value="japanese">Japanese</option>
                                                    <option value="fast food">Fast Food</option>
                                                    <option value="european">European</option>
                                                    <option value="korean">Korean</option>
                                                    <option value="azerbaijani">Azerbaijani</option>
                                                </select>
                                            </div>
                                        </div> -->

                                        <div class="col-lg-3 p-t-20">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Speciality</label>
                                                <select name="specility" class="bg-white mdl-textfield__input">
                                                    <option value="">All</option>
                                                    <option value="indian" <?php echo ($this->input->get('specility') == 'indian') ? 'selected' : ''; ?>>Indian</option>
                                                    <option value="international" <?php echo ($this->input->get('specility') == 'international') ? 'selected' : ''; ?>>International</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2 p-t-20">
                                            <label for="date_from">From</label>
                                            <div class="input-container">
                                                <input type="text" name=""
                                                class="input inputdate mdl-textfield__input dt-search-show" style="width:100%;  background:#fff;"
                                                value="<?php echo ($this->input->get('date_from') <> '') ? date('d-M-Y', strtotime($this->input->get('date_from'))) : ''; ?>"
                                                readonly>
                                                <?php echo form_input([
                                                    'type' => 'date', 
                                                    'name' => 'date_from', 
                                                    'placeholder' => '', 
                                                    'id' => 'date_from', 
                                                    'class' => 'dts mdl-textfield__input dt-search date_from', 
                                                    'value' => ($this->input->get('date_from') <> '') ? $this->input->get('date_from') : '', 
                                                    'style'=> 'width: 36px;float:right;position: absolute;right: 0%;border: none !important;border: none;background-color: transparent;top: 50%;transform: translateY(-50%);'
                                                ]) ?>
                                            </div>
                                        </div>

                                        <div class="col-md-2 p-t-20">
                                            <label for="date_to">To</label>
                                            <div class="input-container">
                                                <input type="text" name=""
                                                    class="input inputdate mdl-textfield__input dt-search-show" style="width:100%; background:#fff;"
                                                    value="<?php echo ($this->input->get('date_to') <> '') ? date('d-M-Y', strtotime($this->input->get('date_to'))) : ''; ?>"
                                                    readonly>
                                                <?php echo form_input([
                                                    'type' => 'date', 
                                                    'name' => 'date_to', 
                                                    'id' => 'date_to', 
                                                    'placeholder' => '', 
                                                    'class' => 'date_to dts mdl-textfield__input dt-search', 
                                                    'value' => ($this->input->get('date_to') <> '') ? $this->input->get('date_to') : '', 
                                                    'style'=> 'width: 36px;float:right;position: absolute;right: 0%;border: none !important;border: none;background-color: transparent;top: 50%;transform: translateY(-50%);'
                                                ]) ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 p-t-20">
                                            <label class="mdl-textfield__label">Tour Type</label>
                                            <div class="input-container">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <select name="tour_type" class="bg-white mdl-textfield__input">
                                                        <option value="">All</option>
                                                        <option value="fit" <?php echo ($this->input->get('tour_type') == 'fit') ? 'selected' : ''; ?>>FIT</option>
                                                        <option value="git" <?php echo ($this->input->get('tour_type') == 'git') ? 'selected' : ''; ?>>GIT</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6 p-t-20 text-center">
                                            <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-md btn-primary', 'style' => 'float:left;', 'value' => 'Search']); ?>
                                             <a href="<?php echo base_url('admin/report/excel_download?' . $this->input->SERVER('QUERY_STRING')); ?>"
                                            class="btn btn-sm btn-primary " style="padding:6px; float:left; margin-left:30px;" title="Download Excel"
                                            target="_blank">
                                            <i class="fa fa-download"></i></a>
                                        </div>
                                    </div>
                                </form>
                                <!-- Print Selected Restaurants Button -->
                                <div class="col-md-2 offset-md-10 dataTables_paginate paging_simple_numbers">
                                    <button id="printSelected" class="btn btn-success btn-md" style="background-color:green;float: right;" title="Print Selected Restaurant Report">
                                        <i class="fa fa-print"></i> Print Selected
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-striped border table-hover table-checkable order-column full-width" id="restaurant_report">
                                            <thead>
                                                <tr>
                                                    <th class="center"><strong>Sr.No</strong></th>
                                                    <th class="center"><strong>Restaurant</strong></th>
                                                    <th class="center"><strong>Speciality</strong></th>
                                                    <th class="center"><strong>Price Range</strong></th>
                                                    <th class="center"><strong>Timing</strong></th>
                                                    <th class="center"><strong>Capacity</strong></th>
                                                    <th class="center"><strong>Total Pax</strong></th>
                                                    <th class="center"><strong>File Count</strong></th>
                                                    <th class="center"><strong>Lunch<br><small>Count / Pax</small></strong></th>
                                                    <th class="center"><strong>High Tea<br><small>Count / Pax</small></strong></th>                                                    
                                                    <th class="center"><strong>Dinner<br><small>Count / Pax</small></strong></th>                                                    
                                                    <th class="center"><strong>Gala Dinner<br><small>Count / Pax</small></strong></th>
                                                    <th class="center"><strong>Cocktail Dinner<br><small>Count / Pax</small></strong></th>
                                                    <th class="center"><strong>Others</strong></th>
                                                    <!-- <th class="center"><strong>Location</strong></th> -->
                                                    <th class="center"><strong>Image</strong></th>
                                                    <th class="center"><strong>Action</strong></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $records_cnt = 0;
                                                if (!empty($result)) {
                                                    $i = $offset + 1;
                                                    foreach ($result as $results) {
                                                        $records_cnt++;
                                                        // Calculate meal type counts
                                                        $lunch_count = isset($results['lunch_count']) ? $results['lunch_count'] : 0;
                                                        $high_tea_count = isset($results['high_tea_count']) ? $results['high_tea_count'] : 0;
                                                        $dinner_count = isset($results['dinner_count']) ? $results['dinner_count'] : 0;
                                                        $gala_dinner_count = isset($results['gala_dinner_count']) ? $results['gala_dinner_count'] : 0;
                                                        $cocktail_dinner_count = isset($results['cocktail_dinner_count']) ? $results['cocktail_dinner_count'] : 0;
                                                        $others_count = isset($results['others_count']) ? $results['others_count'] : 0;
                                                        
                                                        // Meal type pax
                                                        $lunch_pax = isset($results['lunch_pax']) ? $results['lunch_pax'] : 0;
                                                        $high_tea_pax = isset($results['high_tea_pax']) ? $results['high_tea_pax'] : 0;
                                                        $dinner_pax = isset($results['dinner_pax']) ? $results['dinner_pax'] : 0;
                                                        $gala_dinner_pax = isset($results['gala_dinner_pax']) ? $results['gala_dinner_pax'] : 0;
                                                        $cocktail_dinner_pax = isset($results['cocktail_dinner_pax']) ? $results['cocktail_dinner_pax'] : 0;
                                                        $others_pax = isset($results['others_pax']) ? $results['others_pax'] : 0;
                                                        
                                                        $file_count = isset($results['file_count']) ? $results['file_count'] : 0;
                                                        ?>
                                                        <tr class="odd gradeX">
                                                            <td class="center"><?php echo $i++ ?></td>
                                                            <td class="center"><?= $results['name'] ?></td>
                                                            <td class="center"><?= strtoupper($results['cuisine']) ?></td>
                                                            <td class="center"><?= $results['price_range'] ?></td>
                                                            <td class="center">
                                                                <?php
                                                                if (!empty($results['opening_time']) && !empty($results['closing_time'])) {
                                                                    echo $results['opening_time'] . ' to ' . $results['closing_time'];
                                                                } else {
                                                                    echo '-';
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="center"><?= $results['seating_capacity'] ?></td>
                                                            <td class="center"><?= $results['total_no_of_person'] ?></td>
                                                            <td class="center"><?= $file_count ?></td>
                                                            <td class="center"><?= $lunch_count ?> / <?= $lunch_pax ?></td>
                                                            <td class="center"><?= $high_tea_count ?> / <?= $high_tea_pax ?></td>
                                                            <td class="center"><?= $dinner_count ?> / <?= $dinner_pax ?></td>
                                                            <td class="center"><?= $gala_dinner_count ?> / <?= $gala_dinner_pax ?></td>
                                                            <td class="center"><?= $cocktail_dinner_count ?> / <?= $cocktail_dinner_pax ?></td>
                                                            <td class="center"><?= $others_count ?> / <?= $others_pax ?></td>
                                                            <td class="center"><?php //echo $results['city'] . ', ' . $results['country'] ?></td>
                                                            <td class="center">
                                                                <img src="<?php echo ($results['image'] != '') ? base_url() . 'uploads/restaurants/' . $results['image'] : 'assets/admin/images/no-image-icon.png'; ?>" width="90" height="90">
                                                            </td>
                                                            <td class="center d-flex">
                                                                <a href="javascript:void(0);" 
                                                                    class="btn btn-tbl-edit btn-xs show-arrivals"
                                                                    title="Show All Arrivals"
                                                                    data-restaurant-id="<?= $results['id'] ?>"
                                                                    data-toggle="modal" 
                                                                    data-target="#arrivalsModal"
                                                                    style="background-color:#17a2b8; margin-right:5px;">
                                                                        <i class="fa fa-list"></i>
                                                                    </a>
                                                                <a href="<?= base_url('print-restaurant-details?id=' . base64_encode($results['id'])) ?>"
                                                                class="btn btn-tbl-edit btn-xs"
                                                                title="Print Restaurant Report"
                                                                style="background-color:green;" target="_blank"><i
                                                                    class="fa fa-print"></i></a>
                                                                <input type="checkbox" name="restaurant_ids[]" value="<?= $results['id'] ?>" class="select-checkbox">
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-12 dataTables_paginate paging_simple_numbers" id="">
                                    <?php echo 'Showing ' . $records_cnt . ' of ' . $total . ' Records';
                                    echo $links; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page container -->
    </div>

<!-- Arrivals Modal -->
<div class="modal fade" id="arrivalsModal" tabindex="-1" role="dialog" aria-labelledby="arrivalsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="arrivalsModalLabel">Arrivals for Restaurant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="arrivalsTable">
                        <thead>
                            <tr>
                                <th>Enquiry No</th>
                                <th>Arrival ID</th>
                                <th>Restaurant Date</th>
                                <th>Buffet</th>
                                <th>No of Persons</th>
                                <th>Check-in Date</th>
                                <th>Check-out Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Arrivals data will be loaded here via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        function countryFetch() {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/report/get_country_name_ajax',
                type: "POST",
                dataType: 'json',
                success: function(response) {
                    responseData = response.details
                    //console.log(responseData)
                    var select = $('#country');
                    //select.empty(); // Clear previous options
                    $.each(response.details, function(i, details) {
                        $('#country').append('<option value="' + details.name + '" data-id= ' + details.id +
                            '>' + details
                            .name + '</option>');
                    });
                    // var select = $('#country');

                },
                complete:function(){ 
                    $('#country').val(url.searchParams.get('country'));
                    if (url.searchParams.has('country_id')) {
                        $("#country").trigger("change");
                    }
                    if (url.searchParams.has('city')) {
                        get_restaurants();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error); // Debugging log
                }
            });
        }

        countryFetch();

        // Handle change event of #country select
        $('#country').change(function() {
            var selectedOption = $(this).find(':selected');
            var selectedCountryId = selectedOption.data('id'); // Get data-id attribute
            $('#country_id').val(selectedCountryId); // Set selected ID to #country_id input
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
                get_restaurants();
                return false;
            }
        });
        
        $('.js-example-basic-multiple').select2({
            //theme: 'filled',
            placeholder: 'All',
        });
    });
</script>
<script>
    var url = new URL(window.location.href);
    $(document).ready(function() {
        $('#restaurant_report').DataTable({
            paging: false,
            info: false,
            responsive: {
                details: {
                    type: 'column',
                    target: -1
                }
            },
            columnDefs: [
                {
                    className: 'control',
                    orderable: false,
                    targets: -1
                }
            ],
            order: [[0, 'asc']]
        });
        
    });

    function get_restaurants() {
        var location = $("#country").find(':selected').text();
        var city = $("#city").val();
        $.ajax({
            url: '<?php echo base_url() ?>admin/report/restaurants',
            type: 'GET',
            data: {
                "location": location.toLowerCase(),
                "city": city.toLowerCase()
            },
            dataType: 'json',
            success: function(response) {
                $.each(response.details, function(index, item) {
                    $("#restaurants").append('<option value="' + item.id + '">' + item.names +'</option>');
                });
            },
            complete:function(){ 
                $("#restaurants").val(url.searchParams.getAll('restaurants[]')).select2();
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }
    
    if (url.searchParams.has('specility')) {
        $("select[name='specility']").val(url.searchParams.get('specility'));
    }
    
</script>

<script>
    document.getElementById('printSelected').addEventListener('click', function() {
        // Get all selected checkboxes
        let selected = [];
        document.querySelectorAll('.select-checkbox:checked').forEach(function(checkbox) {
            selected.push(checkbox.value);
        });

        // Check if any checkboxes were selected
        if (selected.length > 0) {
            // Convert selected array to a comma-separated string
            let ids = selected.join(',');
            // Redirect to the print page with the selected IDs
            window.open("<?= base_url('selected-print-restaurant-details?ids=') ?>" + btoa(ids), '_blank');
        } else {
            alert('Please select at least one restaurant.');
        }
    });
</script>

<script>
    // $(document).ready(function() {
    //     $('.show-arrivals').on('click', function() {
    //         var restaurantId = $(this).data('restaurant-id');
    //         var restaurantName = $(this).closest('tr').find('td:eq(1)').text();
    //         var mainTotal = $(this).closest('tr').find('td:eq(8)').text(); // Get main total from 9th column
    //         var dateFrom = '<?php echo $this->input->get('date_from') ? $this->input->get('date_from') : ''; ?>';
    //         var dateTo = '<?php echo $this->input->get('date_to') ? $this->input->get('date_to') : ''; ?>';
            
    //         // Update modal title with main total for comparison
    //         $('#arrivalsModalLabel').html('Arrivals for: ' + restaurantName + ' <small>(Main Total: ' + mainTotal + ' persons)</small>');
            
    //         // Show loading
    //         $('#arrivalsTable tbody').html('<tr><td colspan="7" class="text-center">Loading...</td></tr>');
            
    //             // AJAX call to get arrivals data
    //             $.ajax({
    //                 url: '<?php // echo base_url('admin/report/get_restaurant_arrivals') ?>',
    //                 type: 'POST',
    //                 dataType: 'json',
    //                 data: {
    //                     restaurant_id: restaurantId,
    //                     date_from: dateFrom,
    //                     date_to: dateTo,
    //                     <?php //echo $this->security->get_csrf_token_name(); ?>: '<?php // echo $this->security->get_csrf_hash(); ?>'
    //                 },
    //                 success: function(response) {
    //                     if (response.success) {
    //                         var html = '';
    //                         if (response.data.length > 0) {
    //                             var modalTotal = 0;
    //                             $.each(response.data, function(index, arrival) {
    //                                 var persons = parseInt(arrival.no_of_person) || 0;
    //                                 modalTotal += persons;
                                    
    //                                 html += '<tr>' +
    //                                     '<td>' + (arrival.enquiry_no || '-') + '</td>' +
    //                                     '<td>' + arrival.arrival_id + '</td>' +
    //                                     '<td>' + arrival.restaurant_date + '</td>' +
    //                                     '<td>' + arrival.buffet + '</td>' +
    //                                     '<td>' + persons + '</td>' +
    //                                     '<td>' + arrival.check_in_date + '</td>' +
    //                                     '<td>' + arrival.check_out_date + '</td>' +
    //                                     '</tr>';
    //                             });
    //                             // Add total row
    //                             html += '<tr style="background-color: #f8f9fa; font-weight: bold;">' +
    //                                 '<td colspan="4" class="text-right">Modal Total:</td>' +
    //                                 '<td>' + modalTotal + '</td>' +
    //                                 '<td colspan="2">Main Total: ' + mainTotal + '</td>' +
    //                                 '</tr>';
    //                         } else {
    //                             html = '<tr><td colspan="7" class="text-center">No arrivals found for the selected date range</td></tr>';
    //                         }
    //                         $('#arrivalsTable tbody').html(html);
    //                     } else {
    //                         $('#arrivalsTable tbody').html('<tr><td colspan="7" class="text-center">Error loading data</td></tr>');
    //                     }
    //                 },
    //                 error: function() {
    //                     $('#arrivalsTable tbody').html('<tr><td colspan="7" class="text-center">Error loading data</td></tr>');
    //                 }
    //             });
    //     });
    // });
</script>

<script>
    $(document).ready(function() {
        // Get the date inputs
        var dateFrom = $('#date_from');
        var dateTo = $('#date_to');
        
        // When from date changes
        dateFrom.on('change', function() {
            var fromDate = $(this).val();
            
            if (fromDate) {
                // Set the min attribute for to_date
                dateTo.attr('min', fromDate);
                
                // If to_date has a value that is before from_date, clear it
                if (dateTo.val() && dateTo.val() < fromDate) {
                    dateTo.val('');
                    // Also clear the display field
                    $('.date_to').closest('.input-container').find('.dt-search-show').val('');
                }
            } else {
                // If from_date is cleared, remove min restriction
                dateTo.removeAttr('min');
            }
            
            // Update the display field for from_date
            updateDisplayDate($(this), fromDate);
        });
        
        // When to date changes
        dateTo.on('change', function() {
            var toDate = $(this).val();
            updateDisplayDate($(this), toDate);
        });
        
        // Function to update the display field
        function updateDisplayDate(inputElement, dateValue) {
            if (dateValue) {
                var formattedDate = formatDisplayDate(dateValue);
                inputElement.closest('.input-container').find('.dt-search-show').val(formattedDate);
            } else {
                inputElement.closest('.input-container').find('.dt-search-show').val('');
            }
        }
        
        // Function to format date as d-M-Y (e.g., 01-Oct-2024)
        function formatDisplayDate(dateString) {
            var date = new Date(dateString);
            var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            var day = date.getDate().toString().padStart(2, '0');
            var month = months[date.getMonth()];
            var year = date.getFullYear();
            return day + '-' + month + '-' + year;
        }
        
        // Initialize on page load if from_date has value
        if (dateFrom.val()) {
            dateTo.attr('min', dateFrom.val());
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('.show-arrivals').on('click', function() {
            var restaurantId = $(this).data('restaurant-id');
            var restaurantName = $(this).closest('tr').find('td:eq(1)').text();
            var mainTotal = $(this).closest('tr').find('td:eq(8)').text();
            var dateFrom = $('#date_from').val();
            var dateTo = $('#date_to').val();
            var tourType = $('select[name="tour_type"]').val();
            
            console.log('Tour Type:', tourType); // Debug log
            
            // Update modal title with main total for comparison
            $('#arrivalsModalLabel').html('Arrivals for: ' + restaurantName + ' <small>(Main Total: ' + mainTotal + ' persons)</small>');
            
            // Show loading
            $('#arrivalsTable tbody').html('<tr><td colspan="7" class="text-center">Loading...</td></tr>');
            
            // AJAX call to get arrivals data
            $.ajax({
                url: '<?= base_url('admin/report/get_restaurant_arrivals') ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    restaurant_id: restaurantId,
                    date_from: dateFrom,
                    date_to: dateTo,
                    tour_type: tourType,
                    <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                success: function(response) {
                    console.log('AJAX Response:', response); // Debug log
                    if (response.success) {
                        var html = '';
                        if (response.data.length > 0) {
                            var modalTotal = 0;
                            $.each(response.data, function(index, arrival) {
                                var persons = parseInt(arrival.no_of_person) || 0;
                                modalTotal += persons;
                                
                                html += '<tr>' +
                                    '<td>' + (arrival.enquiry_no || '-') + '</td>' +
                                    '<td>' + arrival.arrival_id + '</td>' +
                                    '<td>' + arrival.restaurant_date + '</td>' +
                                    '<td>' + arrival.buffet + '</td>' +
                                    '<td>' + persons + '</td>' +
                                    '<td>' + arrival.check_in_date + '</td>' +
                                    '<td>' + arrival.check_out_date + '</td>' +
                                    '</tr>';
                            });
                            // Add total row
                            html += '<tr style="background-color: #f8f9fa; font-weight: bold;">' +
                                '<td colspan="4" class="text-right">Modal Total:</td>' +
                                '<td>' + modalTotal + '</td>' +
                                // '<td colspan="2">Main Total: ' + mainTotal + '</td>' +
                                '</tr>';
                        } else {
                            html = '<tr><td colspan="7" class="text-center">No arrivals found for the selected filters</td></tr>';
                        }
                        $('#arrivalsTable tbody').html(html);
                    } else {
                        $('#arrivalsTable tbody').html('<tr><td colspan="7" class="text-center">Error loading data</td></tr>');
                    }
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error:', error); // Debug log
                    $('#arrivalsTable tbody').html('<tr><td colspan="7" class="text-center">Error loading data</td></tr>');
                }
            });
        });
    });
</script>