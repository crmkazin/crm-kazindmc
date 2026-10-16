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

<!-- END HEAD -->
 <div class="page-wrapper">
        <!-- start page container -->
        <div class="container-fluid">
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                            <h4 class="text-themecolor">Restaurant Menu Master</h4>
                        </div>
                        <div class="col-lg-4 only-for-dashbord">
                        </div>
                        <div class="col-lg-5 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Restaurant Menu Master</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <div class="tools">
                                        <button type="button" style="width: 100%;" id="add_company" data-toggle="modal"
                                            data-target="#myModalcompany"
                                            class="mdl-button mdl-button--raised mdl-js-ripple-effect btn-info"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-striped border table-checkable order-column full-width"
                                            id="example3">
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">Meal Types</th>
                                                    <th class="center">Menu Types</th>
                                                    <th class="center">Cuisine Type</th>
                                                    <!-- <th class="center">Cuisine Items</th> -->
                                                    <!-- <th class="center">Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php foreach ($menusData as $menu): ?>
                                                    <tr>
                                                        <td class="center"><?= $i++ ?></td>
                                                        <td class="center">
                                                            <?= ucwords(str_replace('_', ' ', $menu->meals)) ?>
                                                        </td>
                                                        <td class="center">
                                                            <?= ucwords(str_replace('_', ' ', $menu->menu_type)) ?>
                                                        </td>
                                                        <td class="center">
                                                            <?= ucwords(str_replace('_', ' ', $menu->cuisine_type)) ?>
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
                                                <label class="mdl-textfield__label" for="cuisine_type">Meal
                                                    Type</label>
                                                <select class="mdl-textfield__input" name="meal_type" id="meal_type"
                                                    required>
                                                    <option value="" disabled selected>Select Meal Type</option>
                                                    <?php foreach ($meals as $meal): ?>
                                                        <option value="<?= $meal->id ?>">
                                                            <?= ucwords(str_replace('-', ' ', $meal->meals)) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label" for="menu_type">Menu Type</label>
                                                <select class="mdl-textfield__input" name="menu_type" id="menu_type"
                                                    required>
                                                    <option value="">Select Menu Type</option>
                                                    <?php foreach ($menus as $restaurant): ?>
                                                        <option value="<?= $restaurant->id ?>">
                                                            <?= ucwords(str_replace('_', ' ', $restaurant->menu_type)) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 p-t-20">
                                            <div
                                                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label" for="cuisine_type">Cuisine
                                                    Type</label>
                                                <select class="mdl-textfield__input" name="cuisine_type"
                                                    id="cuisine_type" required>
                                                    <option value="" disabled selected>Select Cuisine Type</option>
                                                    <option value="veg">Veg</option>
                                                    <option value="non_veg">Non-Veg</option>
                                                    <option value="vegan">Vegan</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 p-t-20">
                                            <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label" for="cuisine">Cuisine</label>
                                                <input type="text" name="cuisine" class="mdl-textfield__input"
                                                    id="cuisine" required>
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
                            <table class="table table-hover table-striped border table-checkable order-column full-width" id="restaurant-menu">
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
        var table = $('#restaurant-menu').DataTable({
            responsive: true
        });
        var table = $('#example3').DataTable({
            responsive: true
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
                    var tableBody = $('#restaurant-menu tbody');
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
                        var tableBody = $('#restaurant-menu tbody');
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
