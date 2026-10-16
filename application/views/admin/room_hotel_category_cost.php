<?php include ('admin_head_css.php'); ?>
<div class="page-wrapper">
        <div class="container-fluid">>
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                    <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                        <h4 class="text-themecolor">Add / Edit Hotel Room Category Cost</h4>
                    </div>
                    <div class="col-lg-2 only-for-dashbord">
                    </div>
                    <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>  
                            <li class="breadcrumb-item active">Add Cost</li>
                        </ol>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="page-content">
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>All Room Category Costs</header>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-checkable order-column full-width"
                                            id="example4">
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">Valid From</th>
                                                    <th class="center">Valid To</th>
                                                    <th class="center">Basic Cost</th>
                                                    <th class="center">Reason for Extra Cost</th>
                                                    <th class="center">Extra Cost</th>
                                                    <!-- <th class="center">Status</th> -->
                                                    <th class="center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                if (!empty($category_cost)) {
                                                    foreach ($category_cost as $list) {
                                                        ?>
                                                <tr class="odd gradeX">
                                                    <td class="center"><?= $i++ ?></td>
                                                    <td class="center">
                                                        <?= date('d-m-Y', strtotime($list->valid_from)); ?>
                                                    </td>
                                                    <td class="center">
                                                        <?= date('d-m-Y', strtotime($list->valid_to)); ?>
                                                    </td>
                                                    <td class="center"><?= $list->basic_cost ?></td>
                                                    <td class="center"><?= $list->reason ? $list->reason : '-' ?></td>
                                                    <td class="center">
                                                        <?= $list->extra_cost ? $list->extra_cost : '-' ?>
                                                    </td>
                                                    <td class="center"><a title="Edit" class="btn btn-tbl-edit btn-xs"
                                                            href="<?php echo current_url() . '?hotel_id=' . $this->input->get('hotel_id') . '&category_id=' . base64_encode($list->category_id) . '&id=' . base64_encode($list->id); ?>"><i
                                                                class="fa fa-edit"></i></a></td>
                                                </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head">
                                    <header>Add / Edit Room Category Cost</header>
                                    <div class="tools">
                                        <a href="all-hotel" class="btn btn-success" style="padding: 6px;"><i
                                                class="fa fa-file-text-o"></i>
                                            Hotels List</a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div>
                                <?php echo form_open_multipart(current_url() . '?' . $_SERVER['QUERY_STRING']); ?>
                                <div class="card-body row">

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'valid_from', 'type' => 'date', 'id' => 'valid_from', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => isset($category->valid_from) ? $category->valid_from : set_value('valid_from')]); ?>
                                            <label class="mdl-textfield__label">Valid From</label>
                                            <?php echo form_error('valid_from'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'valid_to', 'type' => 'date', 'id' => 'valid_to', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => isset($category->valid_to) ? $category->valid_to : set_value('valid_to')]); ?>
                                            <label class="mdl-textfield__label">Valid To</label>
                                            <?php echo form_error('valid_to'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'basic_cost', 'id' => 'basic_cost', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => isset($category->basic_cost) ? $category->basic_cost : set_value('basic_cost')]); ?>
                                            <label class="mdl-textfield__label">Basic Cost</label>
                                            <?php echo form_error('basic_cost'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'reason', 'id' => 'reason', 'class' => 'mdl-textfield__input', 'value' => isset($category->reason) ? $category->reason : set_value('reason')]); ?>
                                            <label class="mdl-textfield__label">Reason for Extra Cost</label>
                                            <?php echo form_error('reason'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php echo form_input(['name' => 'extra_cost', 'id' => 'extra_cost', 'class' => 'mdl-textfield__input', 'value' => isset($category->extra_cost) ? $category->extra_cost : set_value('extra_cost')]) ?>
                                            <label class="mdl-textfield__label">Extra Cost</label>
                                            <?php echo form_error('extra_cost'); ?>
                                        </div>
                                    </div>

                                    <!-- <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                                            <select name="status" class="mdl-textfield__input" style="padding-top:13px;"
                                                required>
                                                <option value="">Select..</option>
                                                <option value="active"
                                                    <?php echo (isset($category->status) && $category->status == 'active') ? 'selected="active"' : ''; ?>>
                                                    Active</option>
                                                <option value="in-active"
                                                    <?php echo (isset($category->status) && $category->status !== 'active') ? 'selected="in-active"' : ''; ?>>
                                                    In-Active</option>
                                            </select>
                                            <label class="mdl-textfield__label">Status</label>
                                            <?php echo form_error('status'); ?>
                                        </div>
                                    </div> -->

                                    <div class="col-lg-12 p-t-20 text-center">
                                        <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value' => 'Submit']); ?>
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
        </div>

        <script>
        // Get references to the input fields
        var validFromInput = document.getElementById('valid_from');
        var validToInput = document.getElementById('valid_to');

        // Function to compare dates and display alert if necessary
        function compareDates() {
            // Parse the dates
            var validFromDate = new Date(validFromInput.value);
            var validToDate = new Date(validToInput.value);

            // Check if both inputs have been filled
            if (validFromDate && validToDate) {
                // Check if the "Valid To" date is less than the "Valid From" date
                if (validToDate < validFromDate) {
                    alert("Valid To date cannot be less than Valid From date. Adjusted accordingly.");
                    $('#valid_from,#valid_to').val('');

                }
            }
        }

        // Add event listener to both "Valid From" and "Valid To" inputs
        validFromInput.addEventListener('change', compareDates);
        validToInput.addEventListener('change', compareDates);
        </script>
