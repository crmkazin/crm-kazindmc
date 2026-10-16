<?php include('admin_head_css.php'); ?>
<link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet" />
<style>
    .dataTables_paginate .page-item>.page-link {
        padding: 0 12px !important;
    }

    .dataTable thead th[class*=sorting]:after{display: none !important;}

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
                            <h4 class="text-themecolor">Restaurant Menu Report</h4>
                        </div>
                        <div class="col-lg-2 only-for-dashbord">
                        </div>
                        <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Restaurant Menu Report</li>
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

                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Location</label>
                                                <select name="country" id="country" class="bg-white mdl-textfield__input"
                                                    style="padding: 10px;">
                                                    <option value="">Select..</option>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" name="country_id" id="country_id" value="<?php echo $country['country_id']; ?>">
                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">City</label>
                                                <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'bg-white mdl-textfield__input', 'value' => $this->input->get('city')]); ?>
                                                <?php echo form_error('city'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width ">
                                                <label class="mdl-textfield__label">Restaurant
                                                <select class="bg-white mdl-textfield__input" name="restaurant" id="restaurant">
                                                    <option value="">Select Restaurant
                                                    </option>
                                                </select>
                                                </label>
                                            </div>
                                        </div>

                                        <!-- <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="specility" class="mdl-textfield__input">
                                                    <option value="">Select..</option>
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
                                                <label class="mdl-textfield__label">Specility</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select class="mdl-textfield__input" name="meal_type" id="meal_type"
                                                    required>
                                                    <option value="" disabled selected>Select Meal Type</option>
                                                    <?php foreach ($meals as $meal): ?>
                                                        <option value="<?= $meal->id ?>">
                                                            <?= ucwords(str_replace('-', ' ', $meal->meals)) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <label class="mdl-textfield__label" for="cuisine_type">Meal
                                                    Type</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select class="mdl-textfield__input" name="menu_type" id="menu_type"
                                                    required>
                                                    <option value="">Select Menu Type</option>
                                                    <?php foreach ($menus as $restaurant): ?>
                                                        <option value="<?= $restaurant->id ?>">
                                                            <?= ucwords(str_replace('_', ' ', $restaurant->menu_type)) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <label class="mdl-textfield__label" for="menu_type">Menu Type</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select class="mdl-textfield__input" name="cuisine_type"
                                                    id="cuisine_type" required>
                                                    <option value="" disabled selected>Select Cuisine Type</option>
                                                    <option value="veg">Veg</option>
                                                    <option value="non_veg">Non-Veg</option>
                                                    <option value="vegan">Vegan</option>
                                                </select>
                                                <label class="mdl-textfield__label" for="cuisine_type">Cuisine
                                                    Type</label>
                                            </div>
                                        </div> -->

                                        <div class="col-lg-3 p-t-20 text-center">
                                            <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-md btn-primary', 'style' => 'float:left;', 'value' => 'Search']); ?>
                                        </div>
                                    </div>
                                </form>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-striped border table-hover table-checkable no-wrap order-column full-width" id="menu-report">
                                            <!-- Table header -->
                                            <thead>
                                                <tr>
                                                    <th class="center"><strong>Sr.No</strong></th>
                                                    <th class="center"><strong>Restaurant</strong></th>
                                                    <th class="center"><strong>Address</strong></th>
                                                    <th class="center"><strong>City</strong></th>
                                                    <th class="center"><strong>Location</strong></th>
                                                    <th class="center"><strong>Files</strong></th>
                                                    <th class="center"><strong>Action</strong></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <!-- Table body -->
                                            <tbody>
                                                <?php
                                                $records_cnt = 0;
                                                if (!empty($result)) {
                                                    $i = $offset + 1;
                                                    foreach ($result as $results) {
                                                        $records_cnt++;
                                                        // Initialize an array to collect arr_ids
                                                        $arr_ids = [];
                                                ?>
                                                        <tr class="odd gradeX">
                                                            <td class="center"><?= $i++ ?></td>
                                                            <td class="center"><?= htmlspecialchars($results->name) ?></td>
                                                            <td class="center"><?= htmlspecialchars($results->restaurant_address) ?></td>
                                                            <td class="center"><?= htmlspecialchars($results->city) ?></td>
                                                            <td class="center"><?= htmlspecialchars($results->country) ?></td>
                                                            <td class="center">
                                                                <?php if (!empty($results->last_arr_ids)) {
                                                                    $arr_ids = [];
                                                                    foreach ($results->last_arr_ids as $arr_data) {
                                                                        $arr_ids[] = htmlspecialchars($arr_data->arr_id);
                                                                    }
                                                                    $arr = implode(',', $arr_ids);
                                                                ?>

                                                                    <?php foreach ($results->last_arr_ids as $arr_data) { ?>
                                                                        <strong>Enquiry No:</strong> <?= htmlspecialchars($arr_data->enquiry_no) . ' ( ' . htmlspecialchars($arr_data->meals) . ' )' ?>&nbsp;
                                                                        <a href="print-restaurant-menu-report?restaurant=<?= base64_encode($results->restaurants_id) ?>&arrival_id=<?= base64_encode($arr_data->arr_id) ?>" target="_blank">
                                                                            <i class="fas fa-file-pdf" style="color:#ff0000;" title="Pdf"></i>
                                                                        </a>
                                                                        <br>
                                                                    <?php } ?>
                                                                <?php } else { ?>
                                                                    No Arrivals
                                                                <?php } ?>

                                                            </td>
                                                            <td class="center">
                                                                <a href="print-restaurant-menu-report?restaurant=<?= base64_encode($results->restaurants_id) ?>&arrival_id=<?= base64_encode($arr) ?>" target="_blank">
                                                                    <i class="fas fa-file-pdf" style="color:#ff0000;" title="Pdf"></i>
                                                                </a>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                <?php }
                                                } ?>
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

    <!-- end js include path -->
    <script>
        var url = new URL(window.location.href);
        $(document).ready(function() {
            $('#menu-report').DataTable({
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
            // $("#country").autocomplete({
            //     source: function(request, response) {
            //         // Fetch data
            //         $.ajax({
            //             url: "<?= base_url() ?>admin/company/get_country_ajax_new",
            //             type: 'post',
            //             dataType: "json",
            //             data: {
            //                 search: request.term
            //             },
            //             success: function(data) {
            //                 response(data);
            //             }
            //         });
            //     },
            //     select: function(event, ui) {
            //         // Set selection
            //         $('#country').val(ui.item.label); // display the selected text
            //         $('#country_id').val(ui.item.country_id); // save selected id to input

            //         return false;
            //     }
            // });

            // $('#country').click(function() {

            function countryFetch() {
                $.ajax({
                    url: '<?php base_url() ?>admin/report/get_country_name_ajax',
                    type: "POST",
                    dataType: 'json',
                    success: function(response) {
                        responseData = response.details
                        console.log(responseData)
                        var select = $('#country');
                        //select.empty(); // Clear previous options
                        $.each(response.details, function(i, details) {
                            $('#country').append('<option value="' + details.name + '" data-id= ' + details.id +'>' + details
                                .name + '</option>');
                        });
                        // var select = $('#country');

                    },
                    complete:function(){ 
                        $('#country').val(url.searchParams.get('country'));
                        if (url.searchParams.has('country_id')) {
                            $("#country").trigger("click");
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
                    //   $('#company_id').val(ui.item.company_id); // save selected id to input

                    return false;
                }
            });

            $('#country').on('click', function() {
                var location = $('#country').val();
                // Make a GET request using AJAX
                $.ajax({
                    url: '<?php echo base_url() ?>admin/report/restaurants',
                    type: 'GET',
                    data: {
                        location: location
                    },
                    dataType: 'json',
                    success: function(response) {
                        $.each(response.details, function(index, item) {
                            $("#restaurant").append(
                                '<option value="' + item.id + '">' + item.names +'</option>');
                        });
                    },
                    complete:function(){ 
                        if (url.searchParams.has('restaurant')) {
                            $("#restaurant").val(url.searchParams.get('restaurant'));
                        }                        
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });

        });
    </script>
