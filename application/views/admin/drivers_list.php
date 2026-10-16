<?php
function capitalizeAfterComma($str)
{
    // Capitalize the first letter of the string
    $str = ucwords($str);

    // Capitalize the first letter after each comma
    return preg_replace_callback('/,\s*([a-zA-Z])/m', function ($match) {
        return ', ' . ucfirst($match[1]);
    }, $str);
}
?>
<?php include ('admin_head_css.php'); ?>
<style>
    .dataTables_scrollHeadInner {
        width: 100% !important;
    }
</style>

 <div class="page-wrapper">
        <div class="container-fluid">
            <div class="page-content-wrapper">
            <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                            <h4 class="text-themecolor">Drivers List</h4>
                        </div>
                        <div class="col-lg-2 only-for-dashbord">
                        </div>
                        <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Drivers List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-box">
                               <form method="get" autocomplete="off" class="content">
                                    <div class="card-body row">
                                        <!-- Country Field -->
                                        <div class="col-lg-3">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Select Country</label>
                                                <?php echo form_input([
                                                    'name' => 'country', 
                                                    'id' => 'countrys', 
                                                    'placeholder' => 'Country', 
                                                    'class' => 'mdl-textfield__input bg-white',
                                                    'value' => $this->input->get('country')
                                                ]); ?>
                                            </div>
                                        </div>
                                        <input type="hidden" name="country_id" id="country_id">

                                        <div class="col-lg-3">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">State</label>
                                                <?php echo form_input(['name' => 'state', 'id' => 'state', 'placeholder' => 'State', 'class' => 'mdl-textfield__input bg-white', 'value' => urldecode($this->input->get('state'))]) ?>
                                            </div>
                                        </div>
                                    <input type="hidden" name="state_id" id="state_id" value="<?= $this->input->get('state_id') ?>">

                                        <!-- City Field -->
                                        <div class="col-lg-3">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">City</label>
                                                <?php echo form_input([
                                                    'name' => 'city', 
                                                    'id' => 'citys', 
                                                    'placeholder' => 'City', 
                                                    'class' => 'mdl-textfield__input bg-white',
                                                    'value' => $this->input->get('city')
                                                ]); ?>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-2">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Driver</label>
                                                <?php echo form_input([
                                                    'name' => 'driver', 
                                                    'id' => 'driver', 
                                                    'placeholder' => 'Driver', 
                                                    'class' => 'mdl-textfield__input bg-white',
                                                    'value' => $this->input->get('driver')
                                                ]); ?>
                                            </div>
                                        </div>
                                        <input type="hidden" name="driver_id" id="driver_id" value="">

                                        <!-- Submit -->
                                        <div class="col-lg-3 p-t-20">
                                            <?php echo form_submit([
                                                'name' => 'submit', 
                                                'id' => 'submit', 
                                                'class' => 'btn btn-md btn-info mt-2', 
                                                'style' => 'float:left;', 
                                                'value' => 'Search'
                                            ]); ?>
                                            <a href="add-driver" class="btn btn-info mt-2 ms-2" style="padding: 8px;"><i class="fa fa-plus"></i>New</a>

                                        </div>
                                    </div>
                                </form>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-striped border table-checkable order-column full-width"
                                            id="example3">
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">Name</th>
                                                    <th class="center">Phone Number</th>
                                                    <th class="center">Country</th>
                                                    <th class="center">State</th>
                                                    <th class="center">City</th>
                                                    <th class="center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php foreach ($result as $list): ?>
                                                    <tr>
                                                        <td class="center"><?= $i++ ?></td>
                                                        <td class="center"><?= $list->driver_name ?></td>
                                                        <td class="center"><?= $list->driver_phone_number ?></td>
                                                        <td class="center"><?= $list->country ?></td>
                                                        <td class="center"><?= $list->state ?></td>
                                                        <td class="center"><?= $list->city ?></td>
                                                        <td class="center">                                                            
                                                            <a href="<?php echo base_url('edit-driver?id=' . base64_encode($list->id)); ?>"
                                                                class="btn btn-tbl-edit btn-xs" title="Edit"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <?php
                                                                $blockedEmails = ['Tsovinar.am@kazindmc.com'];
                                                                if (!in_array($this->session->userdata('email'), $blockedEmails)) {
                                                            ?>
                                                                <a href="<?php echo base_url('delete-driver?id=' . base64_encode($list->id)); ?>"
                                                                    onclick="return confirm('Are you sure you want to delete this Guide?');"
                                                                    class="btn btn-tbl-delete btn-xs" title="Delete"><i
                                                                        class="fas fa-trash"></i></a>              
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end page content -->
        </div>
        <div class="modal fade" id="myModalcompany" role="dialog">
            <div class="modal-dialog modal-lg" style="max-width: 1080px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Restaurant Menu Master</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="msgDiv"></div>
                                <div id="response-message"></div>

                                <form method="post" id="menu-type-form" enctype="multipart/form-data">
                                    <div class="card-body row">

                                        <div class="col-lg-6 p-t-20">
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

                                        <div class="col-lg-6 p-t-20">
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

                                        <div class="col-lg-6 p-t-20">
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
                                        </div>

                                        <div class="col-lg-6 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <input type="text" name="cuisine" class="mdl-textfield__input"
                                                    id="cuisine" required>
                                                <label class="mdl-textfield__label" for="cuisine">Cuisine</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-11"></div>

                                        <div class="col-lg-1 p-t-20">
                                            <button type="submit" class="btn btn-success" id="btn_company">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-scrollable">
                            <table class="table table-hover table-checkable order-column full-width" id="driver_lsit">
                                <thead>
                                    <tr>
                                        <th class="center">Sr.No</th>
                                        <th class="center">Meal Type</th>
                                        <th class="center">Menu Type</th>
                                        <th class="center">Cuisine Type</th>
                                        <th class="center">Cuisine</th>
                                        <th class="center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Table body content -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            var table = $('#driver_lsit').DataTable({
                // "scrollX": true,
                // "scrollY": "200px",
                // "pageLength": 10
                resposive: true,

            });
        });
    </script>
    <script>
        $(document).ready(function () {

        $('#menu_type').on('change', function() {
            var selectedValue = $(this).val();
            if (selectedValue === '5') {
                var cuisineType = $('#cuisine_type');
                cuisineType.empty();
                cuisineType.append($('<option>', {
                    value: ''
                }).text('Select Type'));
                cuisineType.append($('<option>', {
                    value: 'mocktail'
                }).text('Mocktail'));
                cuisineType.append($('<option>', {
                    value: 'cocktail'
                }).text('Cocktail'));
            } else {
                var cuisineType = $('#cuisine_type');
                // console.log(cuisineType)
                cuisineType.empty();
                cuisineType.append($('<option>', {
                    value: ''
                }).text('Select Type'));
                cuisineType.append($('<option>', {
                    value: 'veg'
                }).text('Veg'));
                cuisineType.append($('<option>', {
                    value: 'non_veg'
                }).text('Non Veg'));
                cuisineType.append($('<option>', {
                    value: 'vegan'
                }).text('Vegan'));
            }
        });
            // Assuming your form has the id 'menu-type-form'
            $('#menu-type-form').submit(function (e) {
                e.preventDefault(); // Prevent the form from submitting

                // Serialize the form data
                var formData = $(this).serialize();

                // Send an AJAX request
                $.ajax({
                    url: 'add-restaurant-menu-master',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        // Display a success message
                        $('#response-message').html(
                            '<div class="alert alert-success text-center" role="alert">Form submitted successfully!</div>'
                        );

                        // Add the submitted data to the table
                        var tableBody = $('#example4 tbody');
                        var mealType = $('#meal_type option:selected').text();
                        var menuType = $('#menu_type option:selected')
                            .text(); // Get the selected menu type text
                        var cuisineType = $('#cuisine_type option:selected')
                            .text(); // Get the selected cuisine type text
                        var cuisine = $('#cuisine').val(); // Get the cuisine input value
                        $('#cuisine').val('');
                        var row = '<tr>' +
                            '<td class="center">' + (tableBody.children().length + 1) +
                            '</td>' + // Calculate the row number
                            '<td class="center">' + mealType + '</td>' +
                            '<td class="center">' + menuType + '</td>' +
                            '<td class="center">' + cuisineType + '</td>' +
                            '<td class="center">' + cuisine + '</td>' +
                            '<td class="center"><a href="#" class="btn btn-danger" id="the-btn-delete" data-id="' +
                            response.id + '">Delete</a></td>' +
                            '</tr>';

                        tableBody.append(row); // Append the new row to the table
                    },
                    error: function () {
                        // Display an error message
                        $('#response-message').html(
                            '<div class="alert alert-danger text-center" role="alert">Failed to submit form. Please try again.</div>'
                        );
                    }
                });
            });


            $('#meal_type , #menu_type, #cuisine_type').change(function () {

                var mealTypeId = $('#menu_type').val();
                var cuisineType = $('#cuisine_type').val();
                var mealType = $('#meal_type').val();

                if (mealTypeId && cuisineType && mealType) {
                    $.ajax({
                        url: 'restaurantmenumaster_show/' + mealTypeId + '/' + cuisineType + '/' +
                            mealType,
                        type: 'GET',
                        dataType: 'JSON',
                        success: function (response) {
                            responseData = response; // Store the response data
                            var tableBody = $('#example4 tbody');
                            tableBody.empty(); // Clear existing table rows
                            // Loop through the response data and append rows to the table
                            $.each(response.details, function (index, item) {

                                var menuType = item.menus_type.replace(/_/g, ' ')
                                    .replace(/\b\w/g, function (char) {
                                        return char.toUpperCase();
                                    });
                                var cuisineType = item.cuisine_type.replace(/_/g, ' ')
                                    .replace(/\b\w/g, function (char) {
                                        return char.toUpperCase();
                                    });
                                var mealsType = item.meals.replace(/_/g, ' ')
                                    .replace(/\b\w/g, function (char) {
                                        return char.toUpperCase();
                                    });
                                var row = '<tr>' +
                                    '<td class="center">' + (index + 1) + '</td>' +
                                    '<td class="center">' + mealsType + '</td>' +
                                    '<td class="center">' + menuType + '</td>' +
                                    '<td class="center">' + cuisineType + '</td>' +
                                    '<td class="center">' + item.cuisine + '</td>' +
                                    '<td class="center"><a href="#" class="btn btn-danger" id="the-btn-delete" data-id="' +
                                    item.id + '">Delete</a></td>' +
                                    '</tr>';
                                tableBody.append(row);
                            });

                        }
                    });
                }
            });

            $(document).on('click', '#the-btn-delete', function (e) {
                e.preventDefault();

                var itemId = $(this).data('id');

                // Send an AJAX request to delete the item
                $.ajax({
                    url: 'restaurantmenumaster_delete/' + itemId,
                    type: 'POST',
                    dataType: 'json',
                    success: function (response) {
                        // Check if the deletion was successful
                        if (response.success) {
                            // Remove the table row
                            $(e.target).closest('tr').remove();
                            alert('Item deleted successfully.');
                        } else {
                            alert('Failed to delete item. Permission Denied!');
                        }
                    },
                    error: function () {
                        alert('Failed to delete item.');
                    }
                });
            });

        });
    </script>

<script>
    $(document).ready(function() {

        var allowedCountryIds = [15, 20, 81, 112, 11, 234];
        var country_flag = false;
        $("#countrys").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?= base_url('admin/masters/get_specific_country_ajax') ?>",
                    type: 'post',
                    dataType: "json",
                    data: { search: request.term, allowed_ids: allowedCountryIds.join(',') },
                    success: function (data) {
                        response(data);
                    }
                });
                country_flag = false;
            },
            select: function (event, ui) {
                $('#countrys').val(ui.item.label);
                $('#country_id').val(ui.item.country_id);
                country_flag = true;
                return false;
            }
        }).blur(function () {
            if (!country_flag) $("#countrys").val("");
        });

        var country_flag = false;
        $("#state").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/masters/get_state_ajax",
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
                $('#state').val(ui.item.label); // display the selected text
                $('#state_id').val(ui.item.state_id); // save selected id to input

                return false;
            }
        });

        var city_flag = false;
        $("#citys").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?= base_url('admin/masters/get_city_ajax') ?>",
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
                city_flag = false;
            },
            select: function (event, ui) {
                $('#citys').val(ui.item.label);
                city_flag = true;
                return false;
            }
        }).blur(function () {
            if (!city_flag) $("#citys").val("");
        });
        
        $("#driver").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?= base_url('admin/masters/get_driver_ajax') ?>",
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
                $('#driver').val(ui.item.label);       // visible input
                $('#driver_id').val(ui.item.driver_id); // hidden input
                return false;
            },
            minLength: 2
        });
    });
</script>
