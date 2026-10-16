    <?php include ('admin_head_css.php'); ?>
 <div class="page-wrapper">
        <!-- start page container -->
        <div class="container-fluid">
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-5 col-sm-8 col-8 align-self-center">
                            <h4 class="text-themecolor">All Company</h4>
                        </div>
                        <div class="col-lg-1 only-for-dashbord">
                        </div>
                        <div class="col-lg-6 col-sm-4 col-4 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>merge-address">Merge Address</a></li>
                                    <li class="breadcrumb-item active">All Company</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                    
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>All Company</header>
                                </div>
                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-checkable order-column full-width"
                                            id="company_address">
                                            <!-- Table header -->
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">Agent</th>
                                                    <th class="center">Contact Number</th>
                                                    <th class="center">Email</th>
                                                    <th class="center">City</th>
                                                    <th class="center">State</th>
                                                    <th class="center">Country</th>
                                                    <th class="center">Date</th>
                                                    <th class="center">Designation</th>
                                                    <th class="center">Action</th>
                                                </tr>
                                            </thead>
                                            <!-- Table body -->
                                            <tbody>
                                                <?php
                                                $records_cnt = 0;
                                                if (!empty($company_details)) {
                                                    $i = 1;
                                                    foreach ($company_details as $companies) {
                                                        $records_cnt++;
                                                        ?>
                                                        <tr class="odd gradeX">
                                                            <td class="center"><?= $i++ ?></td>
                                                            <td class="center"><?= $companies->contact_person ?></td>
                                                            <td class="center">
                                                                <?= $companies->contact_person_isd_code . ' ' . $companies->contact_person_number ?>
                                                            </td>
                                                            <td class="center"><?= $companies->email ?></td>
                                                            <td class="center"><?= ucwords(strtolower($companies->city)); ?>
                                                            </td>
                                                            <td class="center"><?= ucwords(strtolower($companies->state)); ?>
                                                            </td>
                                                            <td class="center"><?= ucwords(strtolower($companies->country)); ?>
                                                            </td>
                                                            <td class="center">
                                                                <?php $d = strtotime($companies->creation_date);
                                                                echo date('d-M-Y', $d); ?>
                                                            </td>
                                                            <td class="center">
                                                                <?= ucwords(strtolower($companies->designation)); ?>
                                                            </td>
                                                            <td class="center" style="display:inline-flex;">
                                                                <?php if ($this->session->userdata('type') == 1) { ?>
                                                                    <!-- <a href="<?php echo base_url() . $companies->company_id . '?' . $companies->country .
                                                                        '?' . $companies->city . '?' . $companies->state ?>/merge-same-address"
                                            class="btn btn-tbl-edit btn-xs" title="Merge"><i class="fa fa-link"></i></a>
                                         -->
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#modalMerge" id="mergeAddress" class="btn-info merge-address"
                                                                        style="float:right;cursor:pointer;margin-right:5px;"
                                                                        data-id="<?=trim($companies->company); ?>"
                                                                        data-state="<?= ucwords(strtolower(trim($companies->state))); ?>"
                                                                        data-city="<?= ucwords(strtolower(trim($companies->city))); ?>"
                                                                        data-country="<?= ucwords(strtolower(trim($companies->country))); ?>"
                                                                        data-address="<?= ucwords(strtolower(trim($companies->address))); ?>"
                                                                        data-address-2="<?= ucwords(strtolower(trim($companies->address_2))); ?>"
                                                                        data-address-3="<?= ucwords(strtolower(trim($companies->address_3))); ?>"
                                                                        data-gst="<?=trim($companies->gstin); ?>">Merge
                                                                    </button>
                                                                <?php } ?>
                                                            </td>
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

                </div>
            </div>

            <div class="modal fade" id="modalMerge" role="dialog">
                <div class="modal-dialog modal-lg" style="max-width:1150px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Merge Address</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <?php echo form_open_multipart(base_url("merge-same-address"),['id'=>'frm-address']); ?>
                        <div class="card-body row">
                            <?php echo form_input(['name' => 'ids', 'type' => 'hidden', 'id' => 'ids', 'class' => 'mdl-textfield__input', 'value' => $company_details[0]->company]); ?>

                            <div class="col-lg-4 p-t-20">
                                <div
                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?php echo form_input(['name' => 'country', 'id' => 'country', 'class' => 'mdl-textfield__input']); ?>
                                    <label class="mdl-textfield__label">Country</label>
                                    <?php echo form_error('country'); ?>
                                </div>
                            </div>

                            <div class="col-lg-4 p-t-20">
                                <div
                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?php echo form_input(['name' => 'state', 'id' => 'state', 'class' => 'mdl-textfield__input']); ?>
                                    <label class="mdl-textfield__label">State</label>
                                    <?php echo form_error('state'); ?>
                                </div>
                            </div>

                            <div class="col-lg-4 p-t-20">
                                <div
                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'mdl-textfield__input']); ?>
                                    <label class="mdl-textfield__label">City</label>
                                    <?php echo form_error('city'); ?>
                                </div>
                            </div>

                            <div class="col-lg-4 p-t-20">
                                <div
                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?php echo form_input(['name' => 'address', 'id' => 'address', 'class' => 'mdl-textfield__input']); ?>
                                    <label class="mdl-textfield__label">Address Line 1</label>
                                    <?php echo form_error('address'); ?>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 p-t-20">
                                <div
                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?php echo form_input(['name' => 'address_2', 'id' => 'address_2', 'class' => 'mdl-textfield__input']); ?>
                                    <label class="mdl-textfield__label">Address Line 2</label>
                                    <?php echo form_error('address_2'); ?>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 p-t-20">
                                <div
                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <?php echo form_input(['name' => 'address_3', 'id' => 'address_3', 'class' => 'mdl-textfield__input']); ?>
                                    <label class="mdl-textfield__label">Address Line 3</label>
                                    <?php echo form_error('address_3'); ?>
                                </div>
                            </div>
                            
                            
                                <div class="col-lg-4 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php echo form_input(['name' => 'pincode', 'id' => 'pincode', 'class' => 'mdl-textfield__input', 'value' => '', 'pattern' => '\d*', 'title' => 'Pincode must be numeric']); ?>
                                        <label class="mdl-textfield__label" for="pincode">Pincode</label>
                                        <?php echo form_error('pincode'); ?>
                                    </div>
                                </div>

                                <div class="col-lg-4 p-t-20">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php echo form_input(['name' => 'gst', 'id' => 'gst', 'class' => 'mdl-textfield__input', 'value' => '', 'pattern' => '[a-zA-Z0-9]*', 'title' => 'GST must be alphanumeric']); ?>
                                        <label class="mdl-textfield__label" for="gst">GST</label>
                                        <?php echo form_error('gst'); ?>
                                    </div>
                                </div>

                            <div class="col-lg-12 p-t-20 text-center">
                                <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value' => 'Submit']); ?>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>

            <!-- end page content -->
        </div>
        <!-- end page container -->

    </div>

    <script>
        $(document).ready(function () {
            var table = $('#company_address').DataTable({
                "scrollX": true,
                //"scrollY": "200px",
                "pageLength": 10

            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Get the merge button
            //var mergeButton = document.getElementById('mergeAddress');
            //var mergeButton = document.getElementsByClassName('merge-address');
            $(".merge-address").on("click",function(){
                var idx = $(this).index(".merge-address");
                var ele = $(".merge-address");
                var ids = ele.eq(idx).attr('data-id');
                var state = ele.eq(idx).attr('data-state');
                var city = ele.eq(idx).attr('data-city');
                var country = ele.eq(idx).attr('data-country');
                var address = ele.eq(idx).attr('data-address');
                var address_2 = ele.eq(idx).attr('data-address-2');
                var address_3 = ele.eq(idx).attr('data-address-3');
                var gst = ele.eq(idx).attr('data-gst');
                document.getElementById('ids').value = ids;
                document.getElementById('state').value = state;
                document.getElementById('city').value = city;
                document.getElementById('country').value = country;
                document.getElementById('address').value = address;
                document.getElementById('address_2').value = address_2;
                document.getElementById('address_3').value = address_3;
                document.getElementById('gst').value = gst;
            });
            /*mergeButton.addEventListener('click', function (e) {
                // Get the data attributes from the button
                console.log(mergeButton[index]);
                var ids = mergeButton.getAttribute('data-id');
                var state = mergeButton.getAttribute('data-state');
                var city = mergeButton.getAttribute('data-city');
                var country = mergeButton.getAttribute('data-country');
                var address = mergeButton.getAttribute('data-address');
                var gst = mergeButton.getAttribute('data-gst');

                // Set the values in the modal input fields
                document.getElementById('ids').value = ids;
                document.getElementById('state').value = state;
                document.getElementById('city').value = city;
                document.getElementById('country').value = country;
                document.getElementById('address').value = address;
                document.getElementById('gst').value = gst;
            });*/
        });
    </script>