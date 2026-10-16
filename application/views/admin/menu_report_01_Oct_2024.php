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
    <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet" />
    <style>
    .dataTables_paginate .page-item>.page-link {
        padding: 0 12px !important;
    }

    .form-control {
        border: 1px solid #ede5e5 !important;
    }
    </style>
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
                    <?php include ('report_links.php'); ?>
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Menu Report</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Menu Report</li>
                            </ol>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Menu Report</header>
                                    <div class="float-right">                                        
                                        <a href="<?php echo base_url('admin/report/menu_report_excel?'.$this->input->SERVER('QUERY_STRING')); ?>"
                                            class="btn btn-sm btn-primary mr-3" style="padding:6px;" title="Download Excel"
                                            target="_blank">
                                            <i class="fa fa-download"></i> Excel Download</a>
                                    </div>
                                </div>
                                <form method="get">
                                    <div class="card-body row">

                                    <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <select name="country" id="country" class="mdl-textfield__input"
                                                    style="padding: 10px;">
                                                    <option value="">Select..</option>
                                                </select>
                                                <label class="mdl-textfield__label">Location</label>
                                            </div>
                                        </div>
                                        <input type="hidden" name="country_id" id="country_id"
                                            value="<?php echo $country['country_id']; ?>">
                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'mdl-textfield__input', 'value' => set_value('city')]); ?>
                                                <label class="mdl-textfield__label">City</label>
                                                <?php echo form_error('city'); ?>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width ">
                                                <select class="mdl-textfield__input" name="restaurant" id="restaurant"
                                                    >
                                                    <option value="">Select Restaurant
                                                    </option>
                                                </select>
                                                <label class="mdl-textfield__label">Restaurant
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
                                        <table class="table table-hover table-checkable order-column full-width"
                                            id="example4">
                                            <!-- Table header -->
                                            <thead>
                                                <tr>
                                                    <th class="center"><strong>Sr.No</strong></th>
                                                    <th class="center"><strong>Restaurant</strong></th>
                                                    <th class="center"><strong>Address</strong></th>
                                                    <th class="center"><strong>City</strong></th>
                                                    <th class="center"><strong>Location</strong></th>
                                                    <!-- <th class="center"><strong>Cuisine Type</strong></th> -->
                                                    <th class="center"><strong>Cuisines</strong></th>
                                                    <th class="center"><strong>Action</strong></th>
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
                                                        ?>
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?= $i++ ?></td>
                                                        <td class="center"><?= $results->name ?></td>
                                                        <td class="center"><?= $results->restaurant_address ?></td>
                                                        <td class="center"><?= $results->city ?></td>
                                                        <td class="center"><?= $results->country ?></td>
                                                        <!-- <td class="center"><?= ucwords(str_replace('_', ' ', strtolower($results->menu_type))) ?></td>
                                                        <td class="center"><?= ucwords(strtolower($results->cuisine)) ?></td> -->
                                                        <td class="left">
                                                            <?php foreach ($results->menu_cuisine_map as $menu_type => $cuisines): ?>
                                                                <strong><?= ucwords(str_replace('_', ' ', strtolower($menu_type))) ?>:</strong> <?= ucwords(strtolower($cuisines)) ?><br>
                                                            <?php endforeach; ?>
                                                        </td>
                                                        <td class="center"><a href="print-restaurant-menu-report?restaurant=<?php echo $results->restaurants_id; ?>" target="_blank"><i class="fa fa-file-pdf-o" style="color:#ff0000;" title="Pdf"></i></a></td>
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
        <!-- start footer -->
        <?php include ('admin_footer.php'); ?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
    <?php include ('admin_footer_js.php'); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <!-- end js include path -->
    <script>
    $(document).ready(function() {
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
       
         function countryFetch(){
          $.ajax({
                url: '<?php base_url()?>admin/report/get_country_name_ajax',
                type: "POST",
                dataType: 'json',
                success: function(response) {
                    responseData = response.details
                    console.log(responseData)
                    var select = $('#country');
                    //select.empty(); // Clear previous options
                    $.each(response.details, function (i, details) {
                    $('#country').append('<option value="' + details.name + '" data-id= ' + details.id +
                                '>' + details
                                    .name + '</option>');
                    });
                   // var select = $('#country');

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
                    url: '<?php echo base_url()?>admin/report/restaurants',
                    type: 'GET',
                    data: {
                        location: location
                    },
                    dataType: 'json',
                    success: function(response) {
                        $.each(response.details, function(index, item) {
                            $("#restaurant").append(
                                    '<option value="' + item
                                    .id + '">' + item.names +
                                    '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });

    });
    </script>
</body>

</html>