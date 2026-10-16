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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>KazinDMC CRM</title>
    <?php include ('admin_head_css.php'); ?>
    <style>
        .dataTables_scrollHeadInner {
            width: 100% !important;
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
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Restaurant Menu Master</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                        href="<?= base_url(); ?>dashboard">Home</a>&nbsp;<i
                                        class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Restaurant Menu Master</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>All Restaurant Menu Master</header>
                                    <div class="tools">
                                        <button type="button" style="width: 100%;" id="add_company" data-toggle="modal"
                                            data-target="#myModalcompany"
                                            class="mdl-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-success">Add</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-checkable order-column full-width"
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
                                                            <?= ucwords(str_replace('_', ' ', $menu->meals_type)) ?>
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
                                                <select class="mdl-textfield__input" name="meal_type" id="meal_type"
                                                    required>
                                                    <option value="" disabled selected>Select Meal Type</option>
                                                    <option value="indian">Indian</option>
                                                    <option value="asian">Asian</option>
                                                    <option value="pan-asian">Pan Asian</option>
                                                    <option value="chinese">Chinese</option>
                                                    <option value="italian">Italian</option>
                                                    <option value="georgian">Vegan</option>
                                                    <option value="kazakh">Georgian</option>
                                                    <option value="uzbek">Uzbek</option>
                                                    <option value="japanese">Japanese</option>
                                                    <option value="fast-food">Fast Food</option>
                                                    <option value="european">European</option>
                                                    <option value="korean">Korean</option>
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
                                                    id="cuisine">
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
                            <table class="table table-hover table-checkable order-column full-width" id="example4">
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


        <!-- end page container -->
        <!-- start footer -->
        <?php include ('admin_footer.php'); ?>
        <!-- end footer -->
    </div>
    <!-- start js include path -->
    <?php include ('admin_footer_js.php'); ?>
    <!-- end js include path -->


    <!-- jQuery UI -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script>
        $(document).ready(function () {
            var table = $('#example4').DataTable({
                "scrollX": true,
                // "scrollY": "200px",
                "pageLength": 10

            });
        });
    </script>
    <script>
        $(document).ready(function () {

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
                                var mealsType = item.meals_type.replace(/_/g, ' ')
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
                            alert('Failed to delete item.');
                        }
                    },
                    error: function () {
                        alert('Failed to delete item.');
                    }
                });
            });

        });
    </script>
</body>

</html>