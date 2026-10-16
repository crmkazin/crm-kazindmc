<?php include('admin_head_css.php'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<style>
    .custom-label {
        font-weight: bolder !important;
        margin: 20px 0px 0px 5px !important;
        font-size: medium;
    }

    .custom-label-2 {
        font-weight: bold !important;
        margin: 5px !important;
        font-size: smaller;
    }

    .ui-front {
        z-index: 99 !important;
    }

    .dataTables_scrollHeadInner {
        width: 100% !important;
    }

    .disabled {
        pointer-events: none;
        opacity: 0.5;
    }

    .active {
        pointer-events: auto;
        opacity: 1;
    }
</style>
<style>
    #select2-from_city-container{
        border: solid 1px #ccc;
        padding: 7px;
        background-color: #fff;
        border-radius: 5px;
        position: static;
    }

    #select2-to_city-container{
        border: solid 1px #ccc;
        padding: 7px;
        background-color: #fff;
        border-radius: 5px;
        position: static;
    }

    #select2-train_from_city-container{
        border: solid 1px #ccc;
        padding: 7px;
        background-color: #fff;
        border-radius: 5px;
        position: static;
    }

    #select2-train_to_city-container{
        border: solid 1px #ccc;
        padding: 7px;
        background-color: #fff;
        border-radius: 5px;
        position: static;
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
                            <h4 class="text-themecolor">All Transportations</h4>
                        </div>
                        <div class="col-lg-2 only-for-dashbord">
                        </div>
                        <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">All Transportations</li>
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

                                        <!-- Submit -->
                                        <div class="col-lg-3 p-t-20">
                                            <?php echo form_submit([
                                                'name' => 'submit', 
                                                'id' => 'submit', 
                                                'class' => 'btn btn-md btn-info mt-2', 
                                                'style' => 'float:left;', 
                                                'value' => 'Search'
                                            ]); ?>
                                            <a href="add-transport" class="btn btn-info mt-2 ms-2" style="padding: 8px;"><i class="fa fa-plus"></i>New</a>

                                        </div>
                                    </div>
                                </form>
                                <!-- <div class="card-head">
                                    <header>All Transportations</header>
                                    <div class="tools">
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:void(0);"></a>
                                    </div>
                                </div> -->
                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-striped border no-wrap table-checkable order-column full-width"
                                            id="transportation_lists">
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">Country</th>
                                                    <th class="center">State</th>
                                                    <th class="center">City</th>
                                                    <th class="center">Vehicle Name</th>
                                                    <th class="center">Vehicle Type</th>
                                                    <th class="center">Capacity</th>
                                                    <th class="center">Year</th>
                                                    <th class="center">Make</th>
                                                    <th class="center">Luggage Vehicle</th>
                                                    <th class="center">Luggage Capacity</th>
                                                    <th class="center">Remarks</th>
                                                    <th class="center">Images</th>
                                                    <th class="center">Action</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $base_url = base_url();
                                                $i = 1;
                                                $super_admins = ['rohit@kazindmc.com', 'pankaj@thavertech.com'];
                                                if (!empty($transportations)) {
                                                    foreach ($transportations as $transportation) {
                                                        $images = explode(',', $transportation->images);

                                                ?>
                                                        <tr class="odd gradeX">
                                                            <td class="center"><?= $i++ ?></td>
                                                            <td class="center"><?= $transportation->country ?></td>
                                                            <td class="center"><?= $transportation->state ?></td>
                                                            <td class="center"><?= $transportation->city ?></td>
                                                            <td class="center"><?= $transportation->vehicle_name ?></td>
                                                            <td class="center"><?= $transportation->vehicle_type ?></td>
                                                            <td class="center"><?= $transportation->capacity ?></td>
                                                            <td class="center"><?= $transportation->year ?></td>
                                                            <td class="center"><?= $transportation->make ?></td>
                                                            <td class="center"><?= ucfirst($transportation->luggage_transport) ?></td>
                                                            <td class="center"><?= $transportation->luggage ?></td>
                                                            <td class="center"><?= $transportation->remarks ?></td>
                                                            <td class="center">
                                                                <?php
                                                                if (!empty($images) && $images[0] <> '') {
                                                                    foreach ($images as $list) { ?>
                                                                        <!--<img src="<?php //echo $base_url ?>uploads/transportation/<?php //echo trim($list) ?>" width="50" height="50" style="margin-left:1px;border: 1px solid #d2d8dd;" />-->
                                                                        
                                                                    <div style="display: inline-block; position: relative; margin: 2px;">
                                                                        <img src="<?= $base_url ?>uploads/transportation/<?= trim($list) ?>" width="50" height="50" style="border: 1px solid #d2d8dd;" />
                                                                        <a href="<?= base_url('delete-transport-image?transport_id='.base64_encode($transportation->id).'&image='.base64_encode(trim($list))) ?>" 
                                                                        onclick="return confirm('Are you sure you want to delete this image?');" 
                                                                        style="position: absolute; top: -5px; right: -5px; background: red; color: white; border-radius: 50%; width: 18px; height: 18px; text-align: center; line-height: 16px; font-size: 12px; text-decoration: none;">&times;</a>
                                                                    </div>
                                                                <?php }
                                                                } ?>
                                                            </td>
                                                            <td class="center" style="text-align:center;display:flex;">
                                                                <a href="#" data-toggle="modal" data-target="#modalAdd" id="add-transport-cost" class="btn btn-tbl-money btn-xs" data-transport_id="<?php echo base64_encode($transportation->id); ?>" data-country="<?= $transportation->country ?>" title="Cost List" style="background-color: #62af1c;border-radius: 17px;padding: 5px;color: #FFF;"><i class="fas fa-money-bill" aria-hidden="true"></i></a>
                                                                <a href="<?php echo base_url('edit-transport?id=' . base64_encode($transportation->id)); ?>" class="btn btn-tbl-edit btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                                                                <a href="<?php echo base_url('delete-transport?id=' . base64_encode($transportation->id)); ?>" onclick="return confirm('Are you sure you want to delete this Transport?');" class="btn btn-tbl-delete btn-xs" title="Delete"><i class="fas fa-trash"></i></a>
                                                            </td>
                                                            <td></td>
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
            <!-- end page content -->
        </div>

        <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog" style="max-width:1280px;">
                <div class="modal-content" style="padding: 15px;">

                    <div class="modal-header" style="padding:0 !important;">
                        <h4 class="modal-title" id="country"></h4>
                        <button type="button" class="close .modal-close" data-dismiss="modal" id="close-modal" style="padding:-1rem -1rem 0rem auto !important;">&times;</button>
                    </div>
                    
                    <div class="modal-body border-bottom">
                        <div class="row">
						
                            <div class="col-lg-3" style="background-color:#f5f5f5;">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <label class="mdl-textfield__label">Vehicle</label>
                                    <?php echo form_input(['type' => 'text', 'name' => 'vehicle', 'id' => 'vehicle', 'class' => 'mdl-textfield__input', 'required' => 'required', 'readonly' => 'readonly']) ?>
                                    
                                </div>
                            </div>

                            <div class="col-lg-3" style="background-color:#f5f5f5;">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <label class="mdl-textfield__label">Vehicle Type</label>
                                    <?php echo form_input(['type' => 'text', 'name' => 'vehicle_type', 'id' => 'vehicle_type', 'class' => 'mdl-textfield__input', 'required' => 'required', 'readonly' => 'readonly']) ?>
                                    
                                </div>
                            </div>

                            <div class="col-lg-3" style="background-color:#f5f5f5;">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <label class="mdl-textfield__label">Capacity</label>
                                    <?php echo form_input(['type' => 'text', 'name' => 'capacity', 'id' => 'capacity', 'class' => 'mdl-textfield__input', 'required' => 'required', 'readonly' => 'readonly']) ?>
                                    
                                </div>
                            </div>

                            <div class="col-lg-3" style="background-color:#f5f5f5;">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <label class="mdl-textfield__label">Luggage Capacity</label>
                                    <?php echo form_input(['type' => 'text', 'name' => 'luggage_capacity', 'id' => 'luggage_capacity', 'class' => 'mdl-textfield__input', 'required' => 'required', 'readonly' => 'readonly']) ?>
                                    
                                </div>
                            </div>
							
                        </div>
                        <form enctype="multipart/form-data" method="POST" onsubmit="return check_dates()" action="add-transportation-cost" id="add-cost">
                            <?php echo form_input(['type' => 'hidden', 'name' => 'transport_id', 'id' => 'transport_id', 'class' => 'mdl-textfield__input', 'required' => 'required']) ?>
                            <?php echo form_input(['type' => 'hidden', 'name' => 'currency', 'id' => 'currency_type', 'class' => 'mdl-textfield__input', 'required' => 'required']) ?>
							
							<div class="row mt-2">
								<div class="col-lg-3">
                                    <div class="">
                                        <label class="custom-label">Select Dates</label>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Select Dates</label>
                                        <select class="mdl-textfield__input" style="padding-top:7px;" id="add-transport-cost-dates">
										</select>
                                        
                                    </div>
                                </div>
							</div>
							
                            <div class="row">
							
                                <div class="col-lg-3">
                                    <div class="">
                                        <label class="custom-label">Airport Transfer</label>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">In Charges</label>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'id[]', 'id' => 'id', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'type[]', 'id' => 'type', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => 'airport-transfer-in']) ?>
                                        <?php echo form_input(['type' => 'text', 'name' => 'price[]', 'id' => 'price', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']) ?>
                                        
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Out Charges</label>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'id[]', 'id' => 'id', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'type[]', 'id' => 'type', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => 'airport-transfer-out']) ?>
                                        <?php echo form_input(['type' => 'text', 'name' => 'price[]', 'id' => 'price', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']) ?>
                                        
                                    </div>
                                </div>

                                <div class="col-lg-2" id="luggage-vehicle-charges">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Luggage Vehicle Charges</label>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'id[]', 'id' => 'id', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'type[]', 'id' => 'type', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => 'luggage-vehicle-charges']) ?>
                                        <?php echo form_input(['type' => 'text', 'name' => 'price[]', 'id' => 'price', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']) ?>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'start_time[]', 'id' => 'start_time', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'end_time[]', 'id' => 'end_time', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'hours[]', 'id' => '', 'class' => 'mdl-textfield__input', 'value' => '',]) ?>
                                        
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="currency custom-label-2 pt-4"></label>
                                    </div>
                                </div>

                                <?php echo form_input(['type' => 'hidden', 'name' => 'start_time[]', 'id' => 'start_time', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                <?php echo form_input(['type' => 'hidden', 'name' => 'end_time[]', 'id' => 'end_time', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                <?php echo form_input(['type' => 'hidden', 'name' => 'start_time[]', 'id' => 'start_time', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                <?php echo form_input(['type' => 'hidden', 'name' => 'end_time[]', 'id' => 'end_time', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                <?php echo form_input(['type' => 'hidden', 'name' => 'hours[]', 'id' => '', 'class' => 'mdl-textfield__input', 'value' => '',]) ?>
                                <?php echo form_input(['type' => 'hidden', 'name' => 'hours[]', 'id' => '', 'class' => 'mdl-textfield__input', 'value' => '',]) ?>
                            </div>

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="">
                                        <label class="custom-label">Half Day</label>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'id[]', 'id' => 'id', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'type[]', 'id' => 'type', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => 'halfday']) ?>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Start Time</label>
                                        <?php echo form_input(['type' => 'time', 'name' => 'start_time[]', 'id' => 'start_time', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']) ?>
                                        
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">End Time</label>
                                        <?php echo form_input(['type' => 'time', 'name' => 'end_time[]', 'id' => 'end_time', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']) ?>
                                        
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Hours</label>
                                        <?php echo form_input(['type' => 'text', 'name' => 'hours[]', 'id' => 'hours', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '', 'readonly' => 'readonly']) ?>
                                        
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Charges</label>
                                        <?php echo form_input(['type' => 'text', 'name' => 'price[]', 'id' => 'price', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']) ?>
                                        
                                    </div>
                                </div>

                                <div class="col-lg-1">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="currency custom-label-2 pt-4"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="">
                                        <label class="custom-label">Full Day</label>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'id[]', 'id' => 'id', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'type[]', 'id' => 'type', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => 'full-day']) ?>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Start Time</label>
                                        <?php echo form_input(['type' => 'time', 'name' => 'start_time[]', 'id' => 'start_time', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']) ?>
                                        
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">End Time</label>
                                        <?php echo form_input(['type' => 'time', 'name' => 'end_time[]', 'id' => 'end_time', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']) ?>
                                        
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Hours</label>
                                        <?php echo form_input(['type' => 'text', 'name' => 'hours[]', 'id' => 'hours', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '', 'readonly' => 'readonly']) ?>
                                        
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Charges</label>
                                        <?php echo form_input(['type' => 'text', 'name' => 'price[]', 'id' => 'price', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']) ?>
                                        
                                    </div>
                                </div>

                                <div class="col-lg-1">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="currency custom-label-2 pt-4"></label>
                                    </div>
                                </div>
                            </div>
							
							<div class="row">
                                <div class="col-lg-3">
                                    <div class="">
                                        <label class="custom-label">Extended Day</label>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'id[]', 'id' => 'id', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'type[]', 'id' => 'type', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => 'extended-day']) ?>
                                    </div>
                                </div>

								<div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Charges (Hourly)</label>
                                        <?php echo form_input(['type' => 'text', 'name' => 'price[]', 'id' => 'price', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']) ?>
                                        
                                    </div>
                                </div>

                                <div class="col-lg-2" style="visibility:hidden;">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Start Time</label>
                                        <?php echo form_input(['type' => 'time', 'name' => 'start_time[]', 'id' => 'start_time', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                        
                                    </div>
                                </div>

                                <div class="col-lg-2" style="visibility:hidden;">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">End Time</label>
                                        <?php echo form_input(['type' => 'time', 'name' => 'end_time[]', 'id' => 'end_time', 'class' => 'mdl-textfield__input',  'value' => '']) ?>
                                        
                                    </div>
                                </div>

                                <div class="col-lg-2" style="visibility:hidden;">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Hours</label>
                                        <?php echo form_input(['type' => 'text', 'name' => 'hours[]', 'id' => 'hours', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '', 'readonly' => 'readonly']) ?>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="currency custom-label-2 pt-4"></label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="">
                                        <label class="custom-label">Dinner Transfer</label>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'id[]', 'id' => 'id', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'type[]', 'id' => 'type', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => 'dinner-transfer']) ?>
                                    </div>
                                </div>

								<div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Fixed Charges</label>
                                        <?php echo form_input(['type' => 'text', 'name' => 'price[]', 'id' => 'price', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']) ?>
                                        
                                    </div>
                                </div>

                                <div class="col-lg-2" style="visibility:hidden;">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Start Time</label>
                                        <?php echo form_input(['type' => 'time', 'name' => 'start_time[]', 'id' => 'start_time', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                        
                                    </div>
                                </div>

                                <div class="col-lg-2" style="visibility:hidden;">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">End Time</label>
                                        <?php echo form_input(['type' => 'time', 'name' => 'end_time[]', 'id' => 'end_time', 'class' => 'mdl-textfield__input',  'value' => '']) ?>
                                        
                                    </div>
                                </div>

                                <div class="col-lg-2" style="visibility:hidden;">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Hours</label>
                                        <?php echo form_input(['type' => 'text', 'name' => 'hours[]', 'id' => 'hours', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '', 'readonly' => 'readonly']) ?>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="currency custom-label-2 pt-4"></label>
                                    </div>
                                </div>
                            </div>
							
							<div class="row" id="div_driver_cum_guide" style="display:none;">
                                <div class="col-lg-3">
                                    <div class="">
                                        <label class="custom-label">Driver Cum Guide</label>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'id[]', 'id' => 'id', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                        <?php echo form_input(['type' => 'hidden', 'name' => 'type[]', 'id' => 'type', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => 'driver-cum-guide-fullday']) ?>
                                    </div>
                                </div>

								 <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Full Day Charges </label>
                                        <?php echo form_input(['type' => 'text', 'name' => 'price[]', 'id' => 'price', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']) ?>
                                        
                                    </div>
                                </div>
                               
								<div class="" style="visibility:hidden;width:0;">
                                    <label class="mdl-textfield__label">Start Time</label>
									<?php echo form_input(['type' => 'time', 'name' => 'start_time[]', 'id' => 'start_time', 'class' => '', 'value' => '']) ?>
									
								</div>
								<div class="" style="visibility:hidden;width:0;">
                                    <label class="mdl-textfield__label">End Time</label>
									<?php echo form_input(['type' => 'time', 'name' => 'end_time[]', 'id' => 'end_time', 'class' => '',  'value' => '']) ?>
									
								</div>
                                
								<div class="" style="visibility:hidden;width:0;">
                                    <label class="mdl-textfield__label">Hours</label>
									<?php echo form_input(['type' => 'text', 'name' => 'hours[]', 'id' => 'hours', 'class' => '', 'required' => 'required', 'value' => '', 'readonly' => 'readonly']) ?>
									
								</div>

								<?php echo form_input(['type' => 'hidden', 'name' => 'id[]', 'id' => 'id', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                <?php echo form_input(['type' => 'hidden', 'name' => 'type[]', 'id' => 'type', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => 'driver-cum-guide-halfday']) ?>

								 <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Half Day Charges </label>
                                        <?php echo form_input(['type' => 'text', 'name' => 'price[]', 'id' => 'price', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']) ?>
                                        
                                    </div>
                                </div>
								<div class="" style="visibility:hidden;width:0;">
                                    <label class="mdl-textfield__label">Start Time</label>
									<?php echo form_input(['type' => 'time', 'name' => 'start_time[]', 'id' => 'start_time', 'class' => '', 'value' => '']) ?>
									
								</div>
								<div class="" style="visibility:hidden;width:0;">
                                    <label class="mdl-textfield__label">End Time</label>
									<?php echo form_input(['type' => 'time', 'name' => 'end_time[]', 'id' => 'end_time', 'class' => '',  'value' => '']) ?>
									
								</div>
								<div class="" style="visibility:hidden;width:0;">
                                    <label class="mdl-textfield__label">Hours</label>
									<?php echo form_input(['type' => 'text', 'name' => 'hours[]', 'id' => 'hours', 'class' => '', 'required' => 'required', 'value' => '', 'readonly' => 'readonly']) ?>
									
								</div>
                                

								<?php echo form_input(['type' => 'hidden', 'name' => 'id[]', 'id' => 'id', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                <?php echo form_input(['type' => 'hidden', 'name' => 'type[]', 'id' => 'type', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => 'driver-cum-guide-extended-day']) ?>

								 <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Extended Day Charges </label>
                                        <?php echo form_input(['type' => 'text', 'name' => 'price[]', 'id' => 'price', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']) ?>
                                        
                                    </div>
                                </div>
                                
								<div class="" style="visibility:hidden;width:0;">
                                    <label class="mdl-textfield__label">Start Time</label>
									<?php echo form_input(['type' => 'time', 'name' => 'start_time[]', 'id' => 'start_time', 'class' => '', 'value' => '']) ?>
									
								</div>
                                
								<div class="" style="visibility:hidden;width:0;">
                                    <label class="mdl-textfield__label">End Time</label>
									<?php echo form_input(['type' => 'time', 'name' => 'end_time[]', 'id' => 'end_time', 'class' => '',  'value' => '']) ?>
									
								</div>
								<div class="" style="visibility:hidden;width:0;">
                                    <label class="mdl-textfield__label">Hours</label>
									<?php echo form_input(['type' => 'text', 'name' => 'hours[]', 'id' => 'hours', 'class' => '', 'required' => 'required', 'value' => '', 'readonly' => 'readonly']) ?>
									
								</div>
                                

                                <div class="col-lg-1">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="currency custom-label-2 pt-4"></label>
                                    </div>
                                </div>
                            </div>
                            
                             <div class="row">
                                <div class="col-lg-3">
                                    <div class="">
                                        <label class="custom-label">Overnight / Drop Off Cost</label>
                                    </div>
                                </div>
                                
                                <!--<div class="col-lg-4">-->
                                <!--    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">-->
                                <!--        <div class="form-check form-check-inline">-->
                                <!--            <input class="form-check-input" type="radio" name="transfer_cost_option" id="transfer_cost_yes" value="yes">-->
                                <!--            <label class="form-check-label" for="transfer_cost_yes">Yes</label>-->
                                <!--        </div>-->
                                <!--        <div class="form-check form-check-inline">-->
                                <!--            <input class="form-check-input" type="radio" name="transfer_cost_option" id="transfer_cost_no" value="no" checked>-->
                                <!--            <label class="form-check-label" for="transfer_cost_no">No</label>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
                                
                                <div class="col-lg-9">
                                <div class="row mt-2">
                                    <div class="col-lg-3 mt-2">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="transfer_cost_option" id="transfer_cost_yes" value="yes">
                                            <label class="form-check-label" for="transfer_cost_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="transfer_cost_option" id="transfer_cost_no" value="no" checked>
                                            <label class="form-check-label" for="transfer_cost_no">No</label>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4" id="transfer_routes_div" style="display: none;">
                                        <div class="col-lg-4">
                                            <button type="button" id="add_transfer_route" class="btn btn-primary">
                                                <i class="fa fa-plus"></i> Add Overnight / Drop Off Cost
                                            </button>
                                        </div>
                                    </div>
                                </div>
                           </div>
                            </div>
                            
                            <!-- Transfer Cost Fixed Price Field (Hidden by default) -->
                        <div class="row" id="transfer_cost_fixed_div" style="display: none;">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-2">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <label class="mdl-textfield__label">Fixed Charges</label>
                                    <?php echo form_input(['type' => 'text', 'name' => 'transfer_cost_fixed', 'id' => 'transfer_cost_fixed', 'class' => 'mdl-textfield__input', 'placeholder' => 'Fixed price']) ?>
                                    <?php echo form_input(['type' => 'hidden', 'name' => 'transfer_cost_id', 'id' => 'transfer_cost_id', 'value' => '']) ?>
                                    <?php echo form_input(['type' => 'hidden', 'name' => 'transfer_cost_type', 'value' => 'transfer-cost']) ?>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <label class="mdl-textfield__label">Fixed Toll</label>
                                    <?php echo form_input(['type' => 'text', 'name' => 'transfer_cost_fixed_toll', 'id' => 'transfer_cost_fixed_toll', 'class' => 'mdl-textfield__input', 'placeholder' => 'Fixed toll price']) ?>
                                    <?php echo form_input(['type' => 'hidden', 'name' => 'transfer_cost_type', 'value' => 'transfer-cost-toll']) ?>
                                </div>
                            </div>
                            <!-- Fixed Parking (new) -->
                            <div class="col-lg-2">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <label class="mdl-textfield__label">Fixed Parking</label>
                                    <?php echo form_input(['type' => 'text', 'name' => 'transfer_cost_fixed_parking', 'id' => 'transfer_cost_fixed_parking', 'class' => 'mdl-textfield__input', 'placeholder' => 'Fixed parking price']) ?>
                                    <?php echo form_input(['type' => 'hidden', 'name' => 'transfer_cost_parking_type', 'value' => 'transfer-cost-parking']) ?>
                                </div>
                            </div>
                            <!-- Fixed Addon (new) -->
                            <div class="col-lg-2">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <label class="mdl-textfield__label">Fixed Addon</label>
                                    <?php echo form_input(['type' => 'text', 'name' => 'transfer_cost_fixed_addon', 'id' => 'transfer_cost_fixed_addon', 'class' => 'mdl-textfield__input', 'placeholder' => 'Fixed addon price']) ?>
                                    <?php echo form_input(['type' => 'hidden', 'name' => 'transfer_cost_addon_type', 'value' => 'transfer-cost-addon']) ?>
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <label class="currency custom-label-2 pt-4"></label>
                                </div>
                            </div>
                        </div>
                            
                            <!-- Transfer Routes Button and Modal (For No option) -->
                            <!--<div class="row" id="transfer_routes_div" style="display: none;">-->
                            <!--    <div class="col-lg-3"></div>-->
                            <!--    <div class="col-lg-4">-->
                            <!--        <button type="button" id="add_transfer_route" class="btn btn-primary">-->
                            <!--            <i class="fa fa-plus"></i> Add OverNight Cost-->
                            <!--        </button>-->
                            <!--    </div>-->
                            <!--</div>-->
                            
                            <!-- Add this AFTER the Transfer Cost section in your main modal -->
                            <!--<div class="row">-->
                            <!--    <div class="col-lg-3">-->
                            <!--        <div class="">-->
                            <!--            <label class="custom-label">Train Transfer Cost</label>-->
                            <!--        </div>-->
                            <!--    </div>-->
                                
                            <!--    <div class="col-lg-4">-->
                            <!--        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">-->
                            <!--            <div class="form-check form-check-inline">-->
                            <!--                <input class="form-check-input" type="radio" name="train_transfer_cost_option" id="train_transfer_cost_yes" value="yes">-->
                            <!--                <label class="form-check-label" for="train_transfer_cost_yes">Yes</label>-->
                            <!--            </div>-->
                            <!--            <div class="form-check form-check-inline">-->
                            <!--                <input class="form-check-input" type="radio" name="train_transfer_cost_option" id="train_transfer_cost_no" value="no" checked>-->
                            <!--                <label class="form-check-label" for="train_transfer_cost_no">No</label>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            
                            <!-- Train Transfer Cost Fixed Price Field (Hidden by default) -->
                            <!--<div class="row" id="train_transfer_cost_fixed_div" style="display: none;">-->
                            <!--    <div class="col-lg-3"></div>-->
                            <!--    <div class="col-lg-2">-->
                            <!--        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">-->
                            <!--            <label class="mdl-textfield__label">Fixed Charges</label>-->
                            <!--            <?php //echo form_input(['type' => 'text', 'name' => 'train_transfer_cost_fixed', 'id' => 'train_transfer_cost_fixed', 'class' => 'mdl-textfield__input', 'placeholder' => 'Fixed price']) ?>-->
                            <!--            <?php //echo form_input(['type' => 'hidden', 'name' => 'train_transfer_cost_id', 'id' => 'train_transfer_cost_id', 'value' => '']) ?>-->
                            <!--            <?php //echo form_input(['type' => 'hidden', 'name' => 'train_transfer_cost_type', 'value' => 'train-transfer-cost']) ?>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--    <div class="col-lg-1">-->
                            <!--        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">-->
                            <!--            <label class="currency custom-label-2 pt-4"></label>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            
                            <!-- Train Transfer Routes Button (For No option) -->
                            <!--<div class="row" id="train_transfer_routes_div" style="display: none;">-->
                            <!--    <div class="col-lg-3"></div>-->
                            <!--    <div class="col-lg-4">-->
                            <!--        <button type="button" id="add_train_transfer_route" class="btn btn-primary">-->
                            <!--            <i class="fa fa-plus"></i> Add Train Transfer Route-->
                            <!--        </button>-->
                            <!--    </div>-->
                            <!--</div>-->
                            
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="">
                                        <label class="custom-label">Train Transfer Cost</label>
                                    </div>
                                </div>
                                
                                <div class="col-lg-9 mt-3">
                                    <div class="row">
                                        <div class="col-lg-3 mt-4">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="train_transfer_cost_option" id="train_transfer_cost_yes" value="yes">
                                                    <label class="form-check-label" for="train_transfer_cost_yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="train_transfer_cost_option" id="train_transfer_cost_no" value="no" checked>
                                                    <label class="form-check-label" for="train_transfer_cost_no">No</label>
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-lg-4 mt-3" id="train_transfer_routes_div" style="display: none;">
                                            <button type="button" id="add_train_transfer_route" class="btn btn-primary">
                                                <i class="fa fa-plus"></i> Add Train Transfer Route
                                            </button>
                                        </div>
    
                                        <div class="col-lg-6" id="train_transfer_cost_fixed_div" style="display: none;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <label class="mdl-textfield__label">Fixed Charges</label>
                                                        <?php echo form_input(['type' => 'text', 'name' => 'train_transfer_cost_fixed', 'id' => 'train_transfer_cost_fixed', 'class' => 'mdl-textfield__input', 'placeholder' => 'Fixed price']) ?>
                                                        <?php echo form_input(['type' => 'hidden', 'name' => 'train_transfer_cost_id', 'id' => 'train_transfer_cost_id', 'value' => '']) ?>
                                                        <?php echo form_input(['type' => 'hidden', 'name' => 'train_transfer_cost_type', 'value' => 'train-transfer-cost']) ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <label class="currency custom-label-2 pt-4"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							<div class="row">
								<div class="col-lg-3">
                                    <div class="">
                                        <label class="custom-label">Validity</label>
                                    </div>
                                </div>
								
								<div class="col-lg-2">
									<!--div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
										<?php //echo form_input(['type' => 'date', 'name' => 'valid_from', 'id' => 'valid_from', 'class' => 'mdl-textfield__input', 'required' => 'required']) ?>
										<label class="mdl-textfield__label">Valid From</label>
									</div-->

									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Valid From</label>
										<input type="text" name=""
											class="mdl-textfield__input dt-search-show" style="width:100%;"
											value=""
											readonly>
										<?php echo form_input(['type' => 'date', 'name' => 'valid_from', 'placeholder' => '', 'id' => 'valid_from', 'class' => 'dts mdl-textfield__input dt-search', 'value' => '', 'style' => 'width:20px;float:right;position: absolute;top: 50%;transform: translateY(-15%);right: 5%;width: 36px;box-shadow: none;border: none !important;','required'=>'required']) ?>
										
									</div>

								</div>
								<div class="col-lg-2">
									<!--div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
										<?php //echo form_input(['type' => 'date', 'name' => 'valid_to', 'id' => 'valid_to', 'class' => 'mdl-textfield__input', 'required' => 'required']) ?>
										<label class="mdl-textfield__label">Valid Till</label>
									</div-->
									
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Valid Till</label>
										<input type="text" name=""
											class="mdl-textfield__input dt-search-show" style="width:100%;"
											value=""
											readonly>
										<?php echo form_input(['type' => 'date', 'name' => 'valid_to', 'placeholder' => '', 'id' => 'valid_to', 'class' => 'dts mdl-textfield__input dt-search', 'value' => '', 'style' => 'width:20px;float:right;position: absolute;top: 50%;transform: translateY(-15%);right: 5%;width: 36px;box-shadow: none;border: none !important;', 'required'=>'required']) ?>
										
									</div>

								</div>
								
								<div class="col-lg-5 p-t-20 text-right">
									<?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value' => 'Submit']); ?>
								</div>
								<div id="msg-div" class="offset-3 col-md-8"></div>
							</div>
                            <!--div class="row mt-2">
                                <div class="col-lg-3">
                                    <div class="">
                                        <label class="custom-label">Parking Charges</label>
                                        <?php //echo form_input(['type' => 'hidden', 'name' => 'id[]', 'id' => 'id', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                        <?php //echo form_input(['type' => 'hidden', 'name' => 'type[]', 'id' => 'type', 'class' => 'mdl-textfield__input', 'value' => 'parking']) ?>
                                    </div>
                                </div>

                                <?php //echo form_input(['type' => 'hidden', 'name' => 'start_time[]', 'id' => 'start_time', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                <?php //echo form_input(['type' => 'hidden', 'name' => 'end_time[]', 'id' => 'end_time', 'class' => 'mdl-textfield__input', 'value' => '']) ?>
                                <?php //echo form_input(['type' => 'hidden', 'name' => 'hours[]', 'id' => '', 'class' => 'mdl-textfield__input', 'value' => '',]) ?>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <?php //echo form_input(['type' => 'text', 'name' => 'price[]', 'id' => 'price', 'class' => 'mdl-textfield__input']) ?>
                                        <label class="mdl-textfield__label">Charges</label>
                                    </div>
                                </div>

                                <div class="col-lg-1">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="currency custom-label-2"></label>
                                    </div>
                                </div>
                            </div-->
                        </form>
                    </div>
                    
                    <!-- Train Transfer Routes Modal - Use City Selection Instead of Station -->
                    <div style="z-index:9999;" class="modal fade" id="trainTransferRoutesModal" tabindex="-1" role="dialog" aria-labelledby="trainTransferRoutesModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" style="max-width:1200px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="trainTransferRoutesModalLabel">Train Transfer Routes</h5>
                                    <button type="button" class="close-trainTransfer" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form Section -->
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h6 class="mb-0"><?= isset($edit_train_route) ? 'Edit' : 'Add' ?> Train Transfer Route</h6>
                                        </div>
                                        <div class="card-body">
                                            <form id="trainTransferRouteForm">
                                                <?php echo form_input(['type' => 'hidden', 'name' => 'transport_id', 'id' => 'train_transfer_route_transport_id', 'value' => '']) ?>
                                                <?php echo form_input(['type' => 'hidden', 'name' => 'train_transfer_route_id', 'id' => 'train_transfer_route_id', 'value' => '']) ?>
                                                <?php echo form_input(['type' => 'hidden', 'name' => 'currency', 'id' => 'train_transfer_route_currency', 'value' => '']) ?>
                                                
                                                <div class="row">
                                                    <div class="col-lg-6" style="margin-bottom:35px !important;">
                                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                            <label class="mdl-textfield__label">From City</label>
                                                            <select class="mdl-textfield__input select2-city-train" name="from_city" id="train_from_city" style="width: 100%; padding-top: 7px;" required>
                                                                <option value="">Select City</option>
                                                            </select>
                                                            <?php echo form_input(['type' => 'hidden', 'name' => 'from_city_id', 'id' => 'train_from_city_id', 'value' => '']) ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-6" style="margin-bottom:35px !important;">
                                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                            <label class="mdl-textfield__label">To City</label>
                                                            <select class="mdl-textfield__input select2-city-train" name="to_city" id="train_to_city" style="width: 100%; padding-top: 7px;" required>
                                                                <option value="">Select City</option>
                                                            </select>
                                                            <?php echo form_input(['type' => 'hidden', 'name' => 'to_city_id', 'id' => 'train_to_city_id', 'value' => '']) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                            <label class="mdl-textfield__label">Cost</label>
                                                            <?php echo form_input(['type' => 'text', 'name' => 'cost', 'id' => 'train_route_cost', 'class' => 'mdl-textfield__input', 'required' => 'required']) ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-3">
                                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                            <label class="mdl-textfield__label">Valid From</label>
                                                            <?php echo form_input(['type' => 'date', 'name' => 'train_route_valid_from', 'id' => 'train_route_valid_from', 'class' => 'mdl-textfield__input', 'required' => 'required']) ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-3">
                                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                            <label class="mdl-textfield__label">Valid To</label>
                                                            <?php echo form_input(['type' => 'date', 'name' => 'train_route_valid_to', 'id' => 'train_route_valid_to', 'class' => 'mdl-textfield__input', 'required' => 'required']) ?>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-3">
                                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                            <label class="mdl-textfield__label">Status</label>
                                                            <select name="status" id="train_route_status" class="mdl-textfield__input" style="padding-top:7px;">
                                                                <option value="active">Active</option>
                                                                <option value="inactive">Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row mt-2">
                                                    <div class="col-lg-12 text-right">
                                                        <button type="button" class="btn btn-secondary" id="resetTrainTransferForm">
                                                            Reset
                                                        </button>
                                                        <button type="button" class="btn btn-primary" id="saveTrainTransferRoute">
                                                            Save Train Transfer Route
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <!-- Table Section -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="mb-0">Train Transfer Routes List</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover" id="trainTransferRoutesTable">
                                                    <thead>
                                                        <tr>
                                                            <th width="5%">Sr. No</th>
                                                            <th width="20%">From City</th>
                                                            <th width="20%">To City</th>
                                                            <th width="15%">Cost</th>
                                                            <th width="12%">Valid From</th>
                                                            <th width="12%">Valid To</th>
                                                            <th width="8%">Status</th>
                                                            <th width="8%">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="trainTransferRoutesTbody">
                                                        <!-- Train transfer routes will be loaded here -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Update the Transfer Routes Modal form -->
                    <div style="z-index:9999;" class="modal fade" id="transferRoutesModal" tabindex="-1" role="dialog" aria-labelledby="transferRoutesModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="max-width:1200px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="transferRoutesModalLabel">Overnight Transfer Routes</h5>
                                    <button type="button" class="close-Transfer" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>                            
                                </div>
                            <div class="modal-body">
                                <!-- Form Section -->
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h6 class="mb-0"><?= isset($edit_route) ? 'Edit' : 'Add' ?> Overnight / Drop Off Cost</h6>
                                    </div>
                                    <div class="card-body">
                                        <form id="transferRouteForm">
                                            <?php echo form_input(['type' => 'hidden', 'name' => 'transport_id', 'id' => 'transfer_route_transport_id', 'value' => '']) ?>
                                            <?php echo form_input(['type' => 'hidden', 'name' => 'transfer_route_id', 'id' => 'transfer_route_id', 'value' => '']) ?>
                                            <?php echo form_input(['type' => 'hidden', 'name' => 'currency', 'id' => 'transfer_route_currency', 'value' => '']) ?>
                                            
                                            <div class="row">
                                                <div class="col-lg-3" style="margin-bottom:35px !important;">
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <label class="mdl-textfield__label">From City</label>
                                                        <select class="mdl-textfield__input select2-city" name="from_city" id="from_city" style="width: 100%; padding-top: 7px;" required>
                                                            <option value="">Select City</option>
                                                        </select>
                                                        <?php echo form_input(['type' => 'hidden', 'name' => 'from_city_id', 'id' => 'from_city_id', 'value' => '']) ?>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-lg-3" style="margin-bottom:35px !important;">
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <label class="mdl-textfield__label">To City</label>
                                                        <select class="mdl-textfield__input select2-city" name="to_city" id="to_city" style="width: 100%; padding-top: 7px;" required>
                                                            <option value="">Select City</option>
                                                        </select>
                                                        <?php echo form_input(['type' => 'hidden', 'name' => 'to_city_id', 'id' => 'to_city_id', 'value' => '']) ?>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2">
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <label class="mdl-textfield__label">Cost</label>
                                                        <?php echo form_input(['type' => 'text', 'name' => 'cost', 'id' => 'route_cost', 'class' => 'mdl-textfield__input', 'required' => 'required']) ?>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2">
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <label class="mdl-textfield__label">TOll Price</label>
                                                        <?php echo form_input(['type' => 'text', 'name' => 'toll', 'id' => 'toll_cost', 'class' => 'mdl-textfield__input']) ?>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2">
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <label class="mdl-textfield__label">Parking Price</label>
                                                        <?php echo form_input(['type' => 'text', 'name' => 'parking', 'id' => 'parking_cost', 'class' => 'mdl-textfield__input']) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <label class="mdl-textfield__label">AddOn Price</label>
                                                        <?php echo form_input(['type' => 'text', 'name' => 'addon', 'id' => 'addon_cost', 'class' => 'mdl-textfield__input']) ?>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-lg-3">
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <label class="mdl-textfield__label">Valid From</label>
                                                        <?php echo form_input(['type' => 'date', 'name' => 'route_valid_from', 'id' => 'route_valid_from', 'class' => 'mdl-textfield__input', 'required' => 'required']) ?>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-lg-3">
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <label class="mdl-textfield__label">Valid To</label>
                                                        <?php echo form_input(['type' => 'date', 'name' => 'route_valid_to', 'id' => 'route_valid_to', 'class' => 'mdl-textfield__input', 'required' => 'required']) ?>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-lg-3">
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <label class="mdl-textfield__label">Status</label>
                                                        <select name="status" id="route_status" class="mdl-textfield__input" style="padding-top:7px;">
                                                            <option value="active">Active</option>
                                                            <option value="inactive">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row mt-2">
                                                <div class="col-lg-12 text-right">
                                                    <button type="button" class="btn btn-secondary" id="resetTransferForm">
                                                        Reset
                                                    </button>
                                                    <button type="button" class="btn btn-primary" id="saveTransferRoute">
                                                        Save
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                
                                <!-- Table Section -->
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Overnight / Drop Off Cost List</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" id="transferRoutesTable">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">Sr. No</th>
                                                        <th width="20%">From City</th>
                                                        <th width="20%">To City</th>
                                                        <th width="15%">Cost</th>
                                                        <th width="15%">Toll</th>
                                                        <th width="15%">Parking</th>
                                                        <th width="15%">Addon</th>
                                                        <th width="12%">Valid From</th>
                                                        <th width="12%">Valid To</th>
                                                        <th width="8%">Status</th>
                                                        <th width="8%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="transferRoutesTbody">
                                                    <!-- Transfer routes will be loaded here -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                            </div>
                        </div>
                    </div>
                </div>

                    <div id="response-msg" class="text-center mt-1"></div>

                    <div class="modal-header d-flex justify-content-space-between" idstyle="background:#869aad;">
                        <h4 class="modal-title" id="title-id">Outside City Charges</h4>
                        <div class="d-flex disabled" id="disable-btn">
                            <form id="file-input-form" method="POST" enctype="multipart/form-data">
                                <label for="file-input" class="btn btn-primary mt-1">
                                    Choose CSV File
                                </label>
                                <input type="file" name="csv_file" id="file-input" class="d-none" accept=".csv">
                            </form>
                            &nbsp; &nbsp;
                            <a href="#" id="outside-locations-excel" class="btn btn-light mt-1">Download Excel</a>
                        </div>
                    </div>
                    <div class="modal-body ui-front">
                        <form id="outside-city-form" enctype="multipart/form-data">
                            <?php echo form_input(['type' => 'hidden', 'name' => 'transport_id', 'id' => 'transportid', 'class' => 'mdl-textfield__input', 'required' => 'required']) ?>
                            <input type="hidden" name="sites_id" id="sites_id" value="">
                            <input type="hidden" name="location_id" id="location_id" value="">
                            <input type="hidden" name="hotel_outside_source" id="hotel" value="">
                            <?php echo form_input(['type' => 'hidden', 'name' => 'currency', 'id' => 'currencytype', 'class' => 'mdl-textfield__input', 'required' => 'required']) ?>
                            <?php echo form_input(['type' => 'hidden', 'name' => 'country', 'id' => 'countryname', 'class' => 'mdl-textfield__input', 'required' => 'required']) ?>
                            <div class="row mt-4">
                                <?php echo form_input(['type' => 'hidden', 'name' => 'edit_id', 'id' => 'edit_id', 'class' => 'mdl-textfield__input', 'required' => 'required']) ?>

                                <div class="col-lg-2">
                                    <div
                                        class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Location</label>
                                        <?php
                                        echo form_input(['name' => 'location', 'id' => 'location', 'placeholder' => '', 'class' => 'mdl-textfield__input', 'value' => '']);
                                        ?>
                                        
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Supplement Charges</label>
                                        <?php echo form_input(['name' => 'price', 'id' => 'charges', 'class' => 'mdl-textfield__input', 'required' => 'required']); ?>
                                        
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Toll Charges</label>
                                        <?php echo form_input(['name' => 'toll_price', 'id' => 'toll_charges', 'class' => 'mdl-textfield__input', 'required' => 'required']); ?>
                                        
                                    </div>
                                </div>
								
								<div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Toll Charges(Per Person)</label>
                                        <?php echo form_input(['name' => 'toll_prices_per_person', 'id' => 'toll_prices_per_person', 'class' => 'mdl-textfield__input', 'required' => 'required']); ?>
                                        
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Parking Charges</label>
                                        <?php echo form_input(['name' => 'parking_price', 'id' => 'parking_charges', 'class' => 'mdl-textfield__input', 'required' => 'required']); ?>
                                        
                                    </div>
                                </div>
								
								<div class="col-lg-1">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Add On Prices</label>
                                        <?php echo form_input(['name' => 'add_on_prices', 'id' => 'add_on_prices', 'class' => 'mdl-textfield__input', 'value'=>'0']); ?>
                                        
                                    </div>
                                </div>
								
                                <div class="col-lg-1">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width ">
                                        <label class="currency custom-label-2 pt-4"></label>
                                    </div>
                                </div>
								<div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Estimated HRS (Up+Down)</label>
                                        <?php echo form_input([ 'type'=>'number', 'name' => 'est_hour', 'id' => 'est_hour', 'class' => 'mdl-textfield__input', 'value'=>'']); ?>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Estimated MINUTES (Up+Down)</label>
                                        <?php echo form_input([ 'type'=>'number', 'name' => 'est_minutes', 'id' => 'est_minutes', 'class' => 'mdl-textfield__input', 'value'=>'']); ?>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Estimated KMS (Up+Down)</label>
                                        <?php echo form_input([ 'type'=>'number', 'name' => 'est_km', 'id' => 'est_km', 'class' => 'mdl-textfield__input', 'value'=>'']); ?>
                                        
                                    </div>
                                </div>
								<div class="col-lg-2">
									<!--div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
										<?php //echo form_input(['type' => 'date', 'name' => 'outside_city_valid_from', 'id' => 'outside_city_valid_from', 'class' => 'mdl-textfield__input', 'required' => 'required']) ?>
										<label class="mdl-textfield__label">Valid From</label>
									</div-->
									
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Valid From</label>
										<input type="text" name=""
											class="mdl-textfield__input dt-search-show-outside-city" style="width:100%;"
											value=""
											readonly>
										<?php echo form_input(['type' => 'date', 'name' => 'outside_city_valid_from', 'placeholder' => '', 'id' => 'outside_city_valid_from', 'class' => 'dts mdl-textfield__input dt-search-outside-city', 'value' => '', 'style' => 'width:20px;float:right;position: absolute;top: 50%;transform: translateY(-15%);right: 5%;width: 36px;box-shadow: none;border: none !important;','required'=>'required']) ?>
										
									</div>

								</div>
								<div class="col-lg-2">
									<!--div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
										<?php //echo form_input(['type' => 'date', 'name' => 'outside_city_valid_to', 'id' => 'outside_city_valid_to', 'class' => 'mdl-textfield__input', 'required' => 'required']) ?>
										<label class="mdl-textfield__label">Valid Till</label>
									</div-->

									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Valid Till</label>
										<input type="text" name=""class="mdl-textfield__input dt-search-show-outside-city" style="width:100%;"
											value="" readonly>
										<?php echo form_input(['type' => 'date', 'name' => 'outside_city_valid_to', 'placeholder' => '', 'id' => 'outside_city_valid_to', 'class' => 'dts mdl-textfield__input dt-search-outside-city', 'value' => '', 'style' => 'width:20px;float:right;position: absolute;top: 50%;transform: translateY(-15%);right: 5%;width: 36px;box-shadow: none;border: none !important;', 'required'=>'required']) ?>
										
									</div>

								</div>
								
                                <div class="col-lg-2 ">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                                        <label class="mdl-textfield__label">Status</label>
                                        <select name="status" class="mdl-textfield__input" style="padding-top:7px;" id="status">
                                            <option value="active">
                                                Active</option>
                                            <option value="inactive">
                                                In-active</option>
                                        </select>
                                        
                                    </div>
                                </div>

                                <div class="col-lg-12 p-t-15 text-center">
                                    <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value' => 'Submit']); ?>
                                </div>

                            </div>
                        </form>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-scrollable">
                                    <table class="table table-hover table-checkable order-column full-width" id="transport_charge">
                                        <thead>
                                            <tr>
                                                <th class="center">Sr.No</th>
                                                <th class="center">Location</th>
                                                <th class="center">Supplement Charges</th>
                                                <th class="center">Toll Charges</th>
												<th class="center">Toll Charges (Per Person)</th>
                                                <th class="center">Parking Charges</th>
												<th class="center">Add On Prices</th>
												<th class="center">Estimated HRS (Up+Down)</th>
												<th class="center">Estimated MINUTES (Up+Down)</th>
												<th class="center">Estimated KMS (Up+Down)</th>
												<th class="center">Valid From</th>
												<th class="center">Valid Till</th>
                                                <th class="center">Status</th>
                                                <th class="center">Action</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="outside-transport">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page container -->
    </div>
<script>
       $(document).ready(function() {
        var table = $('#transport_charge').DataTable({
            // responsive: true
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

        var table = $('#transportation_lists').DataTable({
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

        // To this:
        $('.close-trainTransfer').on('click', function() {
            $('#trainTransferRoutesModal').modal('hide');  // CORRECT
        });

        $('.close-Transfer').on('click', function() {
            $('#transferRoutesModal').modal('hide');  // CORRECT
        });

        // Transfer Cost Radio Button Change Handler
        $('input[name="transfer_cost_option"]').on('change', function() {
            const selectedValue = $(this).val();
            
            if (selectedValue === 'yes') {
                $('#transfer_cost_fixed_div').show();
                $('#transfer_routes_div').hide();
                $('#transfer_cost_fixed').attr('required', 'required');
            } else {
                $('#transfer_cost_fixed_div').hide();
                $('#transfer_routes_div').show();
                $('#transfer_cost_fixed').removeAttr('required');
            }
        });

        // Format city result in dropdown
        function formatCityResult(city) {
            if (city.loading) return city.text;
            
            var $container = $(
                '<div class="select2-result-city clearfix">' +
                    '<div class="select2-result-city__name">' + city.text + '</div>' +
                    '<div class="select2-result-city__details text-muted small">' +
                        (city.state_name ? city.state_name + ', ' : '') +
                        (city.country_name ? city.country_name : '') +
                    '</div>' +
                '</div>'
            );
            
            return $container;
        }

        // Format city selection
        function formatCitySelection(city) {
            if (!city.id) return city.text;
            
            return city.text || city.name;
        }

        // Add Transfer Route Button Click
        $('#add_transfer_route').on('click', function() {
            const transportId = $('#transport_id').val();
            const countryName = $('#countryname').val();
            
            // Reset form
            $('#transferRouteForm')[0].reset();
            $('#transfer_route_id').val('');
            $('#from_city_id').val('');
            $('#to_city_id').val('');
            $('#route_status').val('active');
            
            // Clear Select2
            if ($('#from_city').hasClass('select2-hidden-accessible')) {
                $('#from_city').val(null).trigger('change');
                $('#to_city').val(null).trigger('change');
            }
            
            // Set transport ID
            $('#transfer_route_transport_id').val(transportId);
            $('#transferRoutesModalLabel').text('Overnight / Drop Off - Add New');
            
            // Show modal first
            $('#transferRoutesModal').modal('show');
            
            // Load transfer routes
            loadTransferRoutes(transportId);
        });

        // Initialize Select2 when modal is shown
        $('#transferRoutesModal').on('shown.bs.modal', function() {
            const countryName = $('#countryname').val();
            
            // Get country ID
            $.ajax({
                url: '<?php echo base_url("admin/transport/get_country_id"); ?>',
                type: 'POST',
                data: { country_name: countryName },
                dataType: 'json',
                success: function(response) {
                    if (response.success && response.country_id) {
                        // Destroy existing Select2 instances
                        if ($('#from_city').hasClass('select2-hidden-accessible')) {
                            $('#from_city').select2('destroy');
                            $('#to_city').select2('destroy');
                        }
                        
                        // Initialize Select2 with proper event handlers
                        initCitySelect2(response.country_id);
                    }
                }
            });
        });

        // Initialize Select2 function
        function initCitySelect2(countryId) {
            // Function to handle city selection
            function handleCitySelection(event, isFromCity = true) {
                const selectedData = $(event.currentTarget).select2('data');
                if (selectedData && selectedData[0]) {
                    const cityId = selectedData[0].id;
                    const cityName = selectedData[0].text;
                    
                    if (isFromCity) {
                        $('#from_city_id').val(cityId);
                        console.log('From City Selected:', cityId, cityName);
                    } else {
                        $('#to_city_id').val(cityId);
                        console.log('To City Selected:', cityId, cityName);
                    }
                }
            }
            
            // Initialize From City
            $('#from_city').select2({
                dropdownParent: $('#transferRoutesModal .modal-content'),
                placeholder: 'Search from city...',
                allowClear: true,
                ajax: {
                    url: '<?php echo base_url("admin/transport/get_cities_by_country"); ?>',
                    type: 'POST',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            country_id: countryId,
                            page: params.page || 1
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results || [],
                            pagination: {
                                more: (data.pagination && data.pagination.more) || false
                            }
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1
            }).on('select2:select', function(e) {
                handleCitySelection(e, true);
            }).on('select2:clear', function() {
                $('#from_city_id').val('');
            });
            
            // Initialize To City
            $('#to_city').select2({
                dropdownParent: $('#transferRoutesModal .modal-content'),
                placeholder: 'Search to city...',
                allowClear: true,
                ajax: {
                    url: '<?php echo base_url("admin/transport/get_cities_by_country"); ?>',
                    type: 'POST',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            country_id: countryId,
                            page: params.page || 1
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results || [],
                            pagination: {
                                more: (data.pagination && data.pagination.more) || false
                            }
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1
            }).on('select2:select', function(e) {
                handleCitySelection(e, false);
            }).on('select2:clear', function() {
                $('#to_city_id').val('');
            });
        }

        // Save Transfer Route - UPDATED
        $('#saveTransferRoute').on('click', function() {
            // Get values correctly
            const fromCityId = $('#from_city_id').val();
            const toCityId = $('#to_city_id').val();
            const fromCityName = $('#from_city').select2('data')[0]?.text || $('#from_city').find('option:selected').text() || '';
            const toCityName = $('#to_city').select2('data')[0]?.text || $('#to_city').find('option:selected').text() || '';
            const transportId = $('#transfer_route_transport_id').val();
            const routeId = $('#transfer_route_id').val();
            const tollCost = $('#toll_cost').val();
            const addonCost = $('#addon_cost').val();
            const parkingCost = $('#parking_cost').val();
            
            console.log('From City ID:', fromCityId, 'Name:', fromCityName);
            console.log('To City ID:', toCityId, 'Name:', toCityName);
            
            // Validate
            if (!fromCityId || !toCityId) {
                showAlert('warning', 'Please select both From City and To City');
                return;
            }
            
            // Validate dates
            const validFrom = $('#route_valid_from').val();
            const validTo = $('#route_valid_to').val();
            
            if (!validFrom || !validTo) {
                showAlert('warning', 'Please select both Valid From and Valid To dates');
                return;
            }
            
            if (new Date(validFrom) > new Date(validTo)) {
                showAlert('warning', 'Valid From date cannot be after Valid To date.');
                return;
            }
            
            // Prepare form data
            const formData = {
                transport_id: transportId,
                transfer_route_id: routeId,
                from_city_id: fromCityId,
                from_city: fromCityName,
                to_city_id: toCityId,
                to_city: toCityName,
                cost: $('#route_cost').val(),
                toll: tollCost ? parseFloat(tollCost) : 0,
                parking: parkingCost ? parseFloat(parkingCost) : 0,
                addon: addonCost ? parseFloat(addonCost) : 0, 
                route_valid_from: validFrom,
                route_valid_to: validTo,
                status: $('#route_status').val()
            };
            
            console.log('Sending data:', formData);
            
            $.ajax({
                url: '<?php echo base_url("admin/transport/save_transfer_route"); ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                beforeSend: function() {
                    $('#saveTransferRoute').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');
                },
                success: function(response) {
                    if (response.success) {
                        showAlert('success', response.message);
                        
                        // Reset form if it was an add operation
                        if (!routeId) {
                            $('#transferRouteForm')[0].reset();
                            $('#transfer_route_id').val('');
                            $('#from_city_id').val('');
                            $('#to_city_id').val('');
                            $('#route_status').val('active');
                            $('#from_city').val(null).trigger('change');
                            $('#to_city').val(null).trigger('change');
                            $('#transferRoutesModalLabel').text('Overnight / Drop Off - Add New');
                        }
                        
                        // Reload transfer routes
                        loadTransferRoutes(transportId);
                        
                    } else {
                        showAlert('danger', 'Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    showAlert('danger', 'Failed to save transfer route: ' + error);
                    console.error('Error details:', xhr.responseText);
                },
                complete: function() {
                    $('#saveTransferRoute').prop('disabled', false).html('Save');
                }
            });
        });

        // Clean up when modal closes
        $('#transferRoutesModal').on('hidden.bs.modal', function() {
            // Reset all edit button styles
            $('.edit-transfer-route').removeClass('btn-warning').addClass('btn-info');
        });

        // Reset form button
        $('#resetTransferForm').on('click', function() {
            // Reset the form
            $('#transferRouteForm')[0].reset();
            
            // Clear the route ID
            $('#transfer_route_id').val('');
            
            // Reset status
            $('#route_status').val('active');
            
            // Clear city ID hidden fields
            $('#from_city_id').val('');
            $('#to_city_id').val('');
            
            // Reset Select2 dropdowns
            if ($('#from_city').hasClass('select2-hidden-accessible')) {
                $('#from_city').val(null).trigger('change');
            }
            
            if ($('#to_city').hasClass('select2-hidden-accessible')) {
                $('#to_city').val(null).trigger('change');
            }
            
            // Update modal title
            $('#transferRoutesModalLabel').text('Overnight / Drop Off - Add New');
            
            console.log('Form reset complete - cleared all fields including Select2');
        });

        // Load transfer routes function
        function loadTransferRoutes(transportId) {
            $.ajax({
                url: '<?php echo base_url("admin/transport/get_transfer_routes"); ?>',
                type: 'POST',
                data: { transport_id: transportId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        updateTransferRoutesTable(response.routes);
                    } else {
                        $('#transferRoutesTbody').html('<tr><td colspan="8" class="text-center text-muted">No transfer routes found</td></tr>');
                    }
                },
                error: function() {
                    $('#transferRoutesTbody').html('<tr><td colspan="8" class="text-center text-danger">Error loading transfer routes</td></tr>');
                }
            });
        }

        // Update transfer routes table with improved formatting
        function updateTransferRoutesTable(routes) {
            const tbody = $('#transferRoutesTbody');
            
            tbody.empty();
            
            if (!routes || routes.length === 0) {
                tbody.html('<tr><td colspan="8" class="text-center text-muted">No transfer routes found. Click "Add Overnight Transfer Route Cost" to create one.</td></tr>');
                return;
            }
            
            routes.forEach((route, index) => {
                const fromCityFull = route.from_city_name + 
                    (route.from_state_name ? ', ' + route.from_state_name : '') + 
                    (route.from_country_name ? ', ' + route.from_country_name : '');
                    
                const toCityFull = route.to_city_name + 
                    (route.to_state_name ? ', ' + route.to_state_name : '') + 
                    (route.to_country_name ? ', ' + route.to_country_name : '');
                
                const row = `
                    <tr id="transfer_route_row_${route.id}">
                        <td class="text-center">${index + 1}</td>
                        <td>
                            <div>${route.from_city_name || ''}</div>
                            <small class="text-muted">${route.from_state_name || ''}</small>
                        </td>
                        <td>
                            <div>${route.to_city_name || ''}</div>
                            <small class="text-muted">${route.to_state_name || ''}</small>
                        </td>
                        <td>
                            ${route.cost || '0'}
                        </td>
                        <td>
                            ${route.toll || '0'}
                        </td>
                        <td>
                            ${route.parking || '0'}
                        </td>
                        <td>
                            ${route.addon || '0'}
                        </td>
                        <td>${formatDate(route.valid_from)}</td>
                        <td>${formatDate(route.valid_to)}</td>
                        <td class="text-center">
                            <span class="badge badge-${route.status === 'active' ? 'success' : 'danger'}">
                                ${route.status || 'inactive'}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-info edit-transfer-route" 
                                        data-id="${route.id}"
                                        data-from-city-id="${route.from_city_id}"
                                        data-from="${route.from_city_name}"
                                        data-to-city-id="${route.to_city_id}"
                                        data-to="${route.to_city_name}"
                                        data-cost="${route.cost}"
                                        data-toll="${route.toll}"
                                        data-parking="${route.parking}"
                                        data-addon="${route.addon}"
                                        data-valid-from="${route.valid_from}"
                                        data-valid-to="${route.valid_to}"
                                        data-status="${route.status}"
                                        title="Edit">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger delete-transfer-route" 
                                        data-id="${route.id}"
                                        title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
                tbody.append(row);
            });
        }

        // Format date function
        function formatDate(dateString) {
            if (!dateString || dateString === '0000-00-00') return '-';
            try {
                const date = new Date(dateString);
                if (isNaN(date.getTime())) return '-';
                return date.toLocaleDateString('en-IN', {
                    year: 'numeric',
                    month: 'short',
                    day: '2-digit'
                });
            } catch (e) {
                return '-';
            }
        }

        // Edit transfer route button click
        $(document).on('click', '.edit-transfer-route', function() {
            const routeId = $(this).data('id');
            const fromCityId = $(this).data('from-city-id') || '';
            const fromCityName = $(this).data('from') || '';
            const toCityId = $(this).data('to-city-id') || '';
            const toCityName = $(this).data('to') || '';
            const cost = $(this).data('cost') || '';
            const toll = $(this).data('toll') || '';
            const parking = $(this).data('parking') || '';
            const addon = $(this).data('addon') || '';
            const validFrom = $(this).data('valid-from') || '';
            const validTo = $(this).data('valid-to') || '';
            const status = $(this).data('status') || 'active';
            const transportId = $('#transport_id').val();
            const countryName = $('#countryname').val();

            // Get country ID from country name
            $.ajax({
                url: '<?php echo base_url("admin/transport/get_country_id"); ?>',
                type: 'POST',
                data: { country_name: countryName },
                dataType: 'json',
                success: function(response) {
                    if (response.success && response.country_id) {
                        
                        // Initialize Select2 with country ID
                        initCitySelect2(response.country_id);
                        
                        // After Select2 is initialized, set the values
                        setTimeout(function() {
                            if (fromCityId && fromCityName) {
                                var fromOption = new Option(fromCityName, fromCityId, true, true);
                                $('#from_city').append(fromOption).trigger('change');
                                $('#from_city_id').val(fromCityId);
                            }
                            
                            if (toCityId && toCityName) {
                                var toOption = new Option(toCityName, toCityId, true, true);
                                $('#to_city').append(toOption).trigger('change');
                                $('#to_city_id').val(toCityId);
                            }
                        }, 500);
                    }
                }
            });
            
            // Populate the modal form
            $('#transfer_route_transport_id').val(transportId);
            $('#transfer_route_id').val(routeId);
            $('#route_cost').val(cost);
            $('#toll_cost').val(toll);
            $('#parking_cost').val(parking);
            $('#addon_cost').val(addon);
            $('#route_valid_from').val(validFrom);
            $('#route_valid_to').val(validTo);
            $('#route_status').val(status);
            
            // Update modal title
            $('#transferRoutesModalLabel').text('Overnight / Drop Off - Edit');
            
            // Highlight the row being edited
            $('.edit-transfer-route').removeClass('btn-warning').addClass('btn-info');
            $(this).removeClass('btn-info').addClass('btn-warning');
            
            // Scroll to form
            $('.modal-body').animate({
                scrollTop: 0
            }, 500);
        });

        // Delete transfer route
        $(document).on('click', '.delete-transfer-route', function() {
            if (!confirm('Are you sure you want to delete this transfer route?\nThis action cannot be undone.')) {
                return;
            }
            
            const routeId = $(this).data('id');
            const transportId = $('#transport_id').val();
            const rowElement = $(this).closest('tr');
            
            $.ajax({
                url: '<?php echo base_url("admin/transport/delete_transfer_route"); ?>',
                type: 'POST',
                data: { id: routeId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Show success message
                        showAlert('success', 'Transfer route deleted successfully!');
                        
                        // Remove row with fade effect
                        rowElement.fadeOut(300, function() {
                            $(this).remove();
                            
                            // Reload routes if no rows left
                            if ($('#transferRoutesTbody tr').length === 0) {
                                loadTransferRoutes(transportId);
                            } else {
                                // Re-number the rows
                                $('#transferRoutesTbody tr').each(function(index) {
                                    $(this).find('td:first').text(index + 1);
                                });
                            }
                        });
                    } else {
                        showAlert('danger', 'Error: ' + response.message);
                    }
                },
                error: function() {
                    showAlert('danger', 'Failed to delete transfer route. Please try again.');
                }
            });
        });

        // Helper function to show alerts
        function showAlert(type, message) {
            // Remove existing alerts
            $('.alert-dismissible').remove();
            
            const alertHtml = `
                <div class="alert alert-${type} alert-dismissible fade show text-dark" role="alert">
                    ${message}
                </div>
            `;
            
            // Insert alert at the top of modal body
            $('.modal-body').prepend(alertHtml);
            
            // Auto remove after 5 seconds
            setTimeout(function() {
                $('.alert-dismissible').alert('close');
            }, 5000);
        }

        // Train Transfer Cost Radio Button Change Handler
        $('input[name="train_transfer_cost_option"]').on('change', function() {
            const selectedValue = $(this).val();
            
            if (selectedValue === 'yes') {
                $('#train_transfer_cost_fixed_div').show();
                $('#train_transfer_routes_div').hide();
                $('#train_transfer_cost_fixed').attr('required', 'required');
            } else {
                $('#train_transfer_cost_fixed_div').hide();
                $('#train_transfer_routes_div').show();
                $('#train_transfer_cost_fixed').removeAttr('required');
            }
        });

        // Initialize Select2 for train cities
        function initTrainCitySelect2(countryId) {
            // Function to handle city selection for train
            function handleTrainCitySelection(event, isFromCity = true) {
                const selectedData = $(event.currentTarget).select2('data');
                if (selectedData && selectedData[0]) {
                    const cityId = selectedData[0].id;
                    const cityName = selectedData[0].text;
                    
                    if (isFromCity) {
                        $('#train_from_city_id').val(cityId);
                        console.log('Train From City Selected:', cityId, cityName);
                    } else {
                        $('#train_to_city_id').val(cityId);
                        console.log('Train To City Selected:', cityId, cityName);
                    }
                }
            }
            
            // Initialize From City for train
            $('#train_from_city').select2({
                dropdownParent: $('#trainTransferRoutesModal .modal-content'),
                placeholder: 'Search from city...',
                allowClear: true,
                ajax: {
                    url: '<?php echo base_url("admin/transport/get_cities_by_country"); ?>',
                    type: 'POST',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            country_id: countryId,
                            page: params.page || 1
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results || [],
                            pagination: {
                                more: (data.pagination && data.pagination.more) || false
                            }
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1
            }).on('select2:select', function(e) {
                handleTrainCitySelection(e, true);
            }).on('select2:clear', function() {
                $('#train_from_city_id').val('');
            });
            
            // Initialize To City for train
            $('#train_to_city').select2({
                dropdownParent: $('#trainTransferRoutesModal .modal-content'),
                placeholder: 'Search to city...',
                allowClear: true,
                ajax: {
                    url: '<?php echo base_url("admin/transport/get_cities_by_country"); ?>',
                    type: 'POST',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            country_id: countryId,
                            page: params.page || 1
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results || [],
                            pagination: {
                                more: (data.pagination && data.pagination.more) || false
                            }
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1
            }).on('select2:select', function(e) {
                handleTrainCitySelection(e, false);
            }).on('select2:clear', function() {
                $('#train_to_city_id').val('');
            });
        }

        // Add Train Transfer Route Button Click
        $('#add_train_transfer_route').on('click', function() {
            const transportId = $('#transport_id').val();
            const countryName = $('#countryname').val();
            
            // Reset form
            $('#trainTransferRouteForm')[0].reset();
            $('#train_transfer_route_id').val('');
            $('#train_from_city_id').val('');
            $('#train_to_city_id').val('');
            $('#train_route_status').val('active');
            
            // Clear Select2
            if ($('#train_from_city').hasClass('select2-hidden-accessible')) {
                $('#train_from_city').val(null).trigger('change');
                $('#train_to_city').val(null).trigger('change');
            }
            
            // Set transport ID
            $('#train_transfer_route_transport_id').val(transportId);
            $('#trainTransferRoutesModalLabel').text('Train Transfer Routes - Add New');
            
            // Show modal first
            $('#trainTransferRoutesModal').modal('show');
            
            // Load train transfer routes
            loadTrainTransferRoutes(transportId);
        });

        // Initialize Select2 when train modal is shown
        $('#trainTransferRoutesModal').on('shown.bs.modal', function() {
            const countryName = $('#countryname').val();
            
            // Get country ID
            $.ajax({
                url: '<?php echo base_url("admin/transport/get_country_id"); ?>',
                type: 'POST',
                data: { country_name: countryName },
                dataType: 'json',
                success: function(response) {
                    if (response.success && response.country_id) {
                        // Destroy existing Select2 instances
                        if ($('#train_from_city').hasClass('select2-hidden-accessible')) {
                            $('#train_from_city').select2('destroy');
                            $('#train_to_city').select2('destroy');
                        }
                        
                        // Initialize Select2 with proper event handlers
                        initTrainCitySelect2(response.country_id);
                    }
                }
            });
        });

        // Save Train Transfer Route
        $('#saveTrainTransferRoute').on('click', function() {
            const fromCityId = $('#train_from_city_id').val();
            const toCityId = $('#train_to_city_id').val();
            const fromCityName = $('#train_from_city').select2('data')[0]?.text || $('#train_from_city').find('option:selected').text() || '';
            const toCityName = $('#train_to_city').select2('data')[0]?.text || $('#train_to_city').find('option:selected').text() || '';
            const transportId = $('#train_transfer_route_transport_id').val();
            const routeId = $('#train_transfer_route_id').val();
            
            console.log('Train From City ID:', fromCityId, 'Name:', fromCityName);
            console.log('Train To City ID:', toCityId, 'Name:', toCityName);
            
            // Validate
            if (!fromCityId || !toCityId) {
                showAlert('warning', 'Please select both From City and To City for train transfer');
                return;
            }
            
            // Validate dates
            const validFrom = $('#train_route_valid_from').val();
            const validTo = $('#train_route_valid_to').val();
            
            if (!validFrom || !validTo) {
                showAlert('warning', 'Please select both Valid From and Valid To dates');
                return;
            }
            
            if (new Date(validFrom) > new Date(validTo)) {
                showAlert('warning', 'Valid From date cannot be after Valid To date.');
                return;
            }
            
            // Prepare form data
            const formData = {
                transport_id: transportId,
                train_transfer_route_id: routeId,
                from_city_id: fromCityId,
                from_city: fromCityName,
                to_city_id: toCityId,
                to_city: toCityName,
                cost: $('#train_route_cost').val(),
                route_valid_from: validFrom,
                route_valid_to: validTo,
                status: $('#train_route_status').val()
            };
            
            console.log('Sending train route data:', formData);
            
            $.ajax({
                url: '<?php echo base_url("admin/transport/save_train_transfer_route"); ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                beforeSend: function() {
                    $('#saveTrainTransferRoute').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');
                },
                success: function(response) {
                    if (response.success) {
                        showAlert('success', response.message);
                        
                        // Reset form if it was an add operation
                        if (!routeId) {
                            $('#trainTransferRouteForm')[0].reset();
                            $('#train_transfer_route_id').val('');
                            $('#train_from_city_id').val('');
                            $('#train_to_city_id').val('');
                            $('#train_route_status').val('active');
                            $('#train_from_city').val(null).trigger('change');
                            $('#train_to_city').val(null).trigger('change');
                            $('#trainTransferRoutesModalLabel').text('Train Transfer Routes - Add New');
                        }
                        
                        // Reload train transfer routes
                        loadTrainTransferRoutes(transportId);
                        
                    } else {
                        showAlert('danger', 'Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    showAlert('danger', 'Failed to save train transfer route: ' + error);
                    console.error('Error details:', xhr.responseText);
                },
                complete: function() {
                    $('#saveTrainTransferRoute').prop('disabled', false).html('Save Train Transfer Route');
                }
            });
        });

        // Load train transfer routes function
        function loadTrainTransferRoutes(transportId) {
            $.ajax({
                url: '<?php echo base_url("admin/transport/get_train_transfer_routes"); ?>',
                type: 'POST',
                data: { transport_id: transportId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        updateTrainTransferRoutesTable(response.routes);
                    } else {
                        $('#trainTransferRoutesTbody').html('<tr><td colspan="8" class="text-center text-muted">No train transfer routes found</td></tr>');
                    }
                },
                error: function() {
                    $('#trainTransferRoutesTbody').html('<tr><td colspan="8" class="text-center text-danger">Error loading train transfer routes</td></tr>');
                }
            });
        }

        // Update train transfer routes table
        function updateTrainTransferRoutesTable(routes) {
            const tbody = $('#trainTransferRoutesTbody');
            
            tbody.empty();
            
            if (!routes || routes.length === 0) {
                tbody.html('<tr><td colspan="8" class="text-center text-muted">No train transfer routes found. Click "Add Train Transfer Route" to create one.</td></tr>');
                return;
            }
            
            routes.forEach((route, index) => {
                const row = `
                    <tr id="train_transfer_route_row_${route.id}">
                        <td class="text-center">${index + 1}</td>
                        <td>
                            <div>${route.from_city_name || route.from_city || ''}</div>
                        </td>
                        <td>
                            <div>${route.to_city_name || route.to_city || ''}</div>
                        </td>
                        <td>
                            ${route.cost || '0'}
                        </td>
                        <td>${formatDate(route.valid_from)}</td>
                        <td>${formatDate(route.valid_to)}</td>
                        <td class="text-center">
                            <span class="badge badge-${route.status === 'active' ? 'success' : 'danger'}">
                                ${route.status || 'inactive'}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-info edit-train-transfer-route" 
                                        data-id="${route.id}"
                                        data-from-city-id="${route.from_city_id}"
                                        data-from="${route.from_city_name || route.from_city}"
                                        data-to-city-id="${route.to_city_id}"
                                        data-to="${route.to_city_name || route.to_city}"
                                        data-cost="${route.cost}"
                                        data-valid-from="${route.valid_from}"
                                        data-valid-to="${route.valid_to}"
                                        data-status="${route.status}"
                                        title="Edit">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger delete-train-transfer-route" 
                                        data-id="${route.id}"
                                        title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
                tbody.append(row);
            });
        }

        // Edit train transfer route button click
        $(document).on('click', '.edit-train-transfer-route', function() {
            const routeId = $(this).data('id');
            const fromCityId = $(this).data('from-city-id') || '';
            const fromCityName = $(this).data('from') || '';
            const toCityId = $(this).data('to-city-id') || '';
            const toCityName = $(this).data('to') || '';
            const cost = $(this).data('cost') || '';
            const validFrom = $(this).data('valid-from') || '';
            const validTo = $(this).data('valid-to') || '';
            const status = $(this).data('status') || 'active';
            const transportId = $('#transport_id').val();
            const countryName = $('#countryname').val();

            // Get country ID from country name
            $.ajax({
                url: '<?php echo base_url("admin/transport/get_country_id"); ?>',
                type: 'POST',
                data: { country_name: countryName },
                dataType: 'json',
                success: function(response) {
                    if (response.success && response.country_id) {
                        
                        // Initialize Select2 with country ID
                        initTrainCitySelect2(response.country_id);
                        
                        // After Select2 is initialized, set the values
                        setTimeout(function() {
                            if (fromCityId && fromCityName) {
                                var fromOption = new Option(fromCityName, fromCityId, true, true);
                                $('#train_from_city').append(fromOption).trigger('change');
                                $('#train_from_city_id').val(fromCityId);
                            }
                            
                            if (toCityId && toCityName) {
                                var toOption = new Option(toCityName, toCityId, true, true);
                                $('#train_to_city').append(toOption).trigger('change');
                                $('#train_to_city_id').val(toCityId);
                            }
                        }, 500);
                    }
                }
            });
            
            // Populate the modal form
            $('#train_transfer_route_transport_id').val(transportId);
            $('#train_transfer_route_id').val(routeId);
            $('#train_route_cost').val(cost);
            $('#train_route_valid_from').val(validFrom);
            $('#train_route_valid_to').val(validTo);
            $('#train_route_status').val(status);
            
            // Update modal title
            $('#trainTransferRoutesModalLabel').text('Train Transfer Routes - Edit Route');
            
            // Show modal
            $('#trainTransferRoutesModal').modal('show');
        });

        // Delete train transfer route
        $(document).on('click', '.delete-train-transfer-route', function() {
            if (!confirm('Are you sure you want to delete this train transfer route?\nThis action cannot be undone.')) {
                return;
            }
            
            const routeId = $(this).data('id');
            const transportId = $('#transport_id').val();
            const rowElement = $(this).closest('tr');
            
            $.ajax({
                url: '<?php echo base_url("admin/transport/delete_train_transfer_route"); ?>',
                type: 'POST',
                data: { id: routeId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        showAlert('success', 'Train transfer route deleted successfully!');
                        
                        // Remove row with fade effect
                        rowElement.fadeOut(300, function() {
                            $(this).remove();
                            
                            // Reload routes if no rows left
                            if ($('#trainTransferRoutesTbody tr').length === 0) {
                                loadTrainTransferRoutes(transportId);
                            } else {
                                // Re-number the rows
                                $('#trainTransferRoutesTbody tr').each(function(index) {
                                    $(this).find('td:first').text(index + 1);
                                });
                            }
                        });
                    } else {
                        showAlert('danger', 'Error: ' + response.message);
                    }
                },
                error: function() {
                    showAlert('danger', 'Failed to delete train transfer route. Please try again.');
                }
            });
        });

        // Reset train transfer form button
        $('#resetTrainTransferForm').on('click', function() {
            $('#trainTransferRouteForm')[0].reset();
            $('#train_transfer_route_id').val('');
            $('#train_route_status').val('active');
            $('#train_from_city_id').val('');
            $('#train_to_city_id').val('');
            
            // Reset Select2 dropdowns
            if ($('#train_from_city').hasClass('select2-hidden-accessible')) {
                $('#train_from_city').val(null).trigger('change');
            }
            
            if ($('#train_to_city').hasClass('select2-hidden-accessible')) {
                $('#train_to_city').val(null).trigger('change');
            }
            
            $('#trainTransferRoutesModalLabel').text('Train Transfer Routes - Add New');
        });

        // Clean up when train modal closes
        $('#trainTransferRoutesModal').on('hidden.bs.modal', function() {
            // Reset all edit button styles
            $('.edit-train-transfer-route').removeClass('btn-warning').addClass('btn-info');
        });
        
    });

    $(document).on('click', '#outside-locations-excel', function(e) {
        e.preventDefault();

        var country = $('#countryname').val();
        var transportId = $('#transport_id').val();
        var encodedTransportId = btoa(transportId);
        var currency = $('#currencytype').val();

        // Redirect to the download URL with the transport ID as a parameter
        if (country) {
            window.location.href = '<?= base_url() ?>admin/transport/outside_locations_excel?country=' + country + '&transport_id=' + encodedTransportId + '&currency=' + currency;
        } else {
            alert('Please provide a valid Country.');
        }
    });

    $(document).on('change', '#file-input', function(e) {
        // Trigger form submission when a file is selected
        var formData = new FormData($('#file-input-form')[0]);
        var transportId = $('#transport_id').val();
        var encodedTransportId = btoa(transportId);

        const confirmUpload = confirm("Are you sure you want to upload the selected file?");

        if (confirmUpload) {
            $.ajax({
                url: 'admin/transport/import_outside_locations',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    $('#response-msg').html(response.msg);
                    $('#file-input-form')[0].reset();
                    fetchTransportCost(encodedTransportId);
                },
                error: function(xhr, status, error) {
                    $('#response-msg').html('<div class="alert alert-danger">File upload canceled.</div>');
                    $(this).val(''); // Clear the file input field
                }
            });
        } else {
            alert('Failed to upload the file!');
            $(this).val('');
        }

    });
    
    $(document).on('click', '#add-transport-cost', function(e) {
        e.preventDefault();
        // If no transfer-cost found, set default to no
        const hasTransferCost = $('input[name="transfer_cost_option"][value="no"]').prop('checked', true);
        if (hasTransferCost) {
            $('#transfer_cost_fixed_div').hide();
            $('#transfer_routes_div').show();
            $('#transfer_cost_fixed').removeAttr('required');
        }

        // If no transfer-cost found, set default to no
        const hasTrainTransferCost = $('input[name="train_transfer_cost_option"][value="no"]').prop('checked', true);
        if (hasTrainTransferCost) {
            $('#train_transfer_cost_fixed_div').hide();
            $('#train_transfer_routes_div').show();
            $('#train_transfer_cost_fixed').removeAttr('required');
        }
        
        var transportId = $(this).data('transport_id');
        var country = $(this).data('country');
        var driver_cum_guide_vehicles = ['6','8'];
        const options = {
            year: 'numeric',
            month: 'short',
            day: '2-digit'
        };
        $.ajax({
            url: '<?php echo base_url('admin/transport/get_transportation_details'); ?>',
            type: 'POST',
            data: {
                id: transportId
            },
            dataType: "json",
            success: function(response) {
                let transport = response.transport;

                $('#transport_id').val(transport.id);
                $('#vehicle').val(transport.vehicle_name);
                $('#vehicle_type').val(transport.vehicle_type);
                $('#capacity').val(transport.capacity);
                $('#luggage_capacity').val(transport.luggage);
                //$('#luggage_vehicle_required').prop('checked', (transport.luggage_transport === 'yes' || transport.luggage_transport === true || transport.luggage_transport === '1'));
                if (transport.luggage_transport === 'yes') {
                    $('#luggage-vehicle-charges').show();
                } else {
                    $('#luggage-vehicle-charges').remove();
                }
                if(driver_cum_guide_vehicles.indexOf(transport.id) !== -1){
                    $("#div_driver_cum_guide :input").removeAttr("disabled");
                    $("#div_driver_cum_guide").css("display","");
                }else { 
                    $("#div_driver_cum_guide :input").attr("disabled","disabled");
                    $("#div_driver_cum_guide").css("display","none"); 
                }
                $('#country').html(`Transportation Cost (${transport.country})`);
                $('#countryname').val(transport.country)
                $('.currency').html({
                    'Azerbaijan': 'Manat',
                    'Belarus': 'Ruble',
                    'Georgia': 'Lari',
                    'India': 'INR',
                    'Kazakhstan': 'Tenge'
                } [transport.country] || '');
                $('#currency_type').val({
                    'Azerbaijan': 'manat',
                    'Belarus': 'ruble',
                    'Georgia': 'lari',
                    'India': 'inr',
                    'Kazakhstan': 'tenge'
                } [transport.country] || '');
                $('#transportid').val(transport.id);
                $('#currencytype').val({
                    'Azerbaijan': 'manat',
                    'Belarus': 'ruble',
                    'Georgia': 'lari',
                    'India': 'inr',
                    'Kazakhstan': 'tenge'
                } [transport.country] || '');
                $("#add-transport-cost-dates").append('<option value="" data-transport_id="">New</option>');
                $.each(response.transportation_details, function(index, item) {
                    var d = item.d.split("_");
                    const selectedDate1 = new Date(d[0]);
                    const selectedDate2 = new Date(d[1]);
                    $("#add-transport-cost-dates").append('<option value="' + item.d + '" data-transport_id="'+btoa(item.transport_id)+'">From: ' + selectedDate1.toLocaleDateString("en-IN",options) +' To: '+selectedDate2.toLocaleDateString("en-IN",options) +'</option>');
                });
            },
            error: function() {
                alert('Failed to fetch transport cost details.');
            }
        });
        fetchTransportCost(transportId);
        enableBtn(country);
    });
    
    $('#add-transport-cost-dates').on('change', function(e) {
        e.preventDefault();
        var transportId = $("#add-transport-cost-dates").find(":selected").data('transport_id');
        var valid_dates = $("#add-transport-cost-dates").find(":selected").val();
        //var country = $(this).data('country');
        if(transportId == "" || transportId == "undefined" || valid_dates == "" || valid_dates == "undefined"){
            $('#add-cost').find('input[type=text],input[type=date],input[type=time], textarea').val('');
            $('[name="id[]"]').val('');
            return false;
        }
        $.ajax({
            url: 'transport-costing',
            type: 'POST',
            data: {id: transportId,valid_dates:valid_dates},
            dataType: "json",
            success: function(response) {
                let transport = response.transport;

                $('#transport_id').val(transport.id);
                $('#vehicle').val(transport.vehicle_name);
                $('#vehicle_type').val(transport.vehicle_type);
                $('#capacity').val(transport.capacity);
                $('#luggage_capacity').val(transport.luggage);
                //$('#luggage_vehicle_required').prop('checked', (transport.luggage_transport === 'yes' || transport.luggage_transport === true || transport.luggage_transport === '1'));
                if (transport.luggage_transport === 'yes') {
                    $('#luggage-vehicle-charges').show();
                } else {
                    $('#luggage-vehicle-charges').remove();
                }
                $('#country').html(`Transportation Cost (${transport.country})`);
                $('#countryname').val(transport.country)
                $('.currency').html({
                    'Azerbaijan': 'Manat',
                    'Belarus': 'Ruble',
                    'Georgia': 'Lari',
                    'India': 'INR',
                    'Kazakhstan': 'Tenge'
                } [transport.country] || '');
                $('#currency_type').val({
                    'Azerbaijan': 'manat',
                    'Belarus': 'ruble',
                    'Georgia': 'lari',
                    'India': 'inr',
                    'Kazakhstan': 'tenge'
                } [transport.country] || '');
                $('#transportid').val(transport.id);
                $('#currencytype').val({
                    'Azerbaijan': 'manat',
                    'Belarus': 'ruble',
                    'Georgia': 'lari',
                    'India': 'inr',
                    'Kazakhstan': 'tenge'
                } [transport.country] || '');


                // let transportCost = response.transport_cost;
                // let index = 0;
                // $('[name="valid_from"]').val(transportCost[0].valid_from).attr("min","").trigger("change");
                // $('[name="valid_to"]').val(transportCost[0].valid_to).attr("min","").trigger("change");
                // transportCost.forEach((cost, index) => {

                //     switch (cost.type) {
                //         case 'airport-transfer-in':
                //             $('[name="id[]"]').eq(index).val(cost.id);
                //             $('[name="price[]"]').eq(index).val(cost.price);
                //             index++;
                //             break;

                //         case 'airport-transfer-out':
                //             $('[name="id[]"]').eq(index).val(cost.id);
                //             $('[name="price[]"]').eq(index).val(cost.price);
                //             index++;
                //             break;

                //         case 'luggage-vehicle-charges':
                //             $('[name="id[]"]').eq(index).val(cost.id);
                //             $('[name="price[]"]').eq(index).val(cost.price);
                //             index++;
                //             break;

                //         case 'halfday':
                //             $('[name="id[]"]').eq(index).val(cost.id);
                //             $('[name="start_time[]"]').eq(index).val(cost.start_time);
                //             $('[name="end_time[]"]').eq(index).val(cost.end_time);
                //             $('[name="hours[]"]').eq(index).val(cost.hours);
                //             $('[name="price[]"]').eq(index).val(cost.price);
                //             index++;
                //             break;

                //         case 'full-day':
                //             $('[name="id[]"]').eq(index).val(cost.id);
                //             $('[name="start_time[]"]').eq(index).val(cost.start_time);
                //             $('[name="end_time[]"]').eq(index).val(cost.end_time);
                //             $('[name="hours[]"]').eq(index).val(cost.hours);
                //             $('[name="price[]"]').eq(index).val(cost.price);
                //             index++;
                //             break;

                //         case 'extended-day':
                //             $('[name="id[]"]').eq(index).val(cost.id);
                //             $('[name="start_time[]"]').eq(index).val(cost.start_time);
                //             $('[name="end_time[]"]').eq(index).val(cost.end_time);
                //             $('[name="hours[]"]').eq(index).val(cost.hours);
                //             $('[name="price[]"]').eq(index).val(cost.price);
                //             index++;
                //             break;
                        
                //         case 'dinner-transfer':
                //             $('[name="id[]"]').eq(index).val(cost.id);
                //             $('[name="start_time[]"]').eq(index).val(cost.start_time);
                //             $('[name="end_time[]"]').eq(index).val(cost.end_time);
                //             $('[name="hours[]"]').eq(index).val(cost.hours);
                //             $('[name="price[]"]').eq(index).val(cost.price);
                //             index++;
                //             break;    

                //         case 'parking':
                //             $('[name="id[]"]').eq(index).val(cost.id);
                //             $('[name="price[]"]').eq(index).val(cost.price);
                //             index++;
                //             break;
                //         case 'driver-cum-guide-fullday':
                //             $('[name="id[]"]').eq(index).val(cost.id);
                //             $('[name="price[]"]').eq(index).val("").val(cost.price);
                //             index++;
                //             break;
                //         case 'driver-cum-guide-halfday':
                //             $('[name="id[]"]').eq(index).val(cost.id);
                //             $('[name="price[]"]').eq(index).val("").val(cost.price);
                //             index++;
                //             break;
                //         case 'driver-cum-guide-extended-day':
                //             $('[name="id[]"]').eq(index).val(cost.id);
                //             $('[name="price[]"]').eq(index).val("").val(cost.price);
                //             index++;
                //             break;
                //         case 'transfer-cost':
                //             // Set radio button to yes
                //             $('input[name="transfer_cost_option"][value="yes"]').prop('checked', true);
                //             $('#transfer_cost_fixed_div').show();
                //             $('#transfer_routes_div').hide();
                //             $('#transfer_cost_fixed').val(cost.price).attr('required', 'required');
                //             $('#transfer_cost_id').val(cost.id);
                //             break;
                //         case 'train-transfer-cost':
                //             // Set train transfer radio button to yes
                //             $('input[name="train_transfer_cost_option"][value="yes"]').prop('checked', true);
                //             $('#train_transfer_cost_fixed_div').show();
                //             $('#train_transfer_routes_div').hide();
                //             $('#train_transfer_cost_fixed').val(cost.price).attr('required', 'required');
                //             $('#train_transfer_cost_id').val(cost.id);
                //             console.log('Train transfer cost found:', cost.price);
                //             break;
                //         case 'transfer-cost-toll':
                //             $('input[name="transfer_cost_option"][value="yes"]').prop('checked', true);
                //             $('#transfer_cost_fixed_div').show();
                //             $('#transfer_routes_div').hide();
                //             $('#transfer_cost_fixed_toll')
                //                 .val(cost.price)
                //                 .attr('required', 'required');
                //             break;
                //         case 'transfer-cost-addon':
                //             $('input[name="transfer_cost_option"][value="yes"]').prop('checked', true);
                //             $('#transfer_cost_fixed_div').show();
                //             $('#transfer_routes_div').hide();
                //             $('#transfer_cost_fixed_addon')
                //                 .val(cost.price)
                //                 .attr('required', 'required');
                //             $('#transfer_cost_addon_id').val(cost.id);
                //             break;
                //         case 'transfer-cost-parking':
                //             $('input[name="transfer_cost_option"][value="yes"]').prop('checked', true);
                //             $('#transfer_cost_fixed_div').show();
                //             $('#transfer_routes_div').hide();
                //             $('#transfer_cost_fixed_parking')
                //                 .val(cost.price)
                //                 .attr('required', 'required');
                //             break;
                //     }
                // });

                let transportCost = response.transport_cost || [];
                
                $('#add-cost [name="id[]"]').val('');
                $('#add-cost [name="price[]"]').val('');
                $('#add-cost [name="start_time[]"]').val('');
                $('#add-cost [name="end_time[]"]').val('');
                $('#add-cost [name="hours[]"]').val('');
                
                if (transportCost.length > 0) {
                    $('[name="valid_from"]')
                        .val(transportCost[0].valid_from)
                        .attr('min', '')
                        .trigger('change');
                
                    $('[name="valid_to"]')
                        .val(transportCost[0].valid_to)
                        .attr('min', '')
                        .trigger('change');
                }
                
                transportCost.forEach(function (cost) {
                    let $typeField = $('#add-cost [name="type[]"]').filter(function () {
                        return $(this).val() === cost.type;
                    }).first();
                
                    if ($typeField.length) {
                        let typeIndex = $('#add-cost [name="type[]"]').index($typeField);
                
                        $('#add-cost [name="id[]"]')
                            .eq(typeIndex)
                            .val(cost.id || '');
                
                        $('#add-cost [name="price[]"]')
                            .eq(typeIndex)
                            .val(cost.price || '');
                
                        /*
                         * Time-based fields ko index se set nahi karenge,
                         * kyunki airport/luggage ke hidden time fields ka DOM order alag hai.
                         */
                        if (
                            cost.type === 'halfday' ||
                            cost.type === 'full-day' ||
                            cost.type === 'extended-day' ||
                            cost.type === 'dinner-transfer'
                        ) {
                            let $row = $typeField.closest('.row');
                
                            $row.find('[name="start_time[]"]')
                                .val(cost.start_time || '');
                
                            $row.find('[name="end_time[]"]')
                                .val(cost.end_time || '');
                
                            $row.find('[name="hours[]"]')
                                .val(cost.hours || '');
                        }
                    }
                
                    switch (cost.type) {
                        case 'transfer-cost':
                            $('input[name="transfer_cost_option"][value="yes"]')
                                .prop('checked', true);
                
                            $('#transfer_cost_fixed_div').show();
                            $('#transfer_routes_div').hide();
                
                            $('#transfer_cost_fixed')
                                .val(cost.price)
                                .attr('required', 'required');
                
                            $('#transfer_cost_id').val(cost.id);
                            break;
                
                        case 'train-transfer-cost':
                            $('input[name="train_transfer_cost_option"][value="yes"]')
                                .prop('checked', true);
                
                            $('#train_transfer_cost_fixed_div').show();
                            $('#train_transfer_routes_div').hide();
                
                            $('#train_transfer_cost_fixed')
                                .val(cost.price)
                                .attr('required', 'required');
                
                            $('#train_transfer_cost_id').val(cost.id);
                            break;
                
                        case 'transfer-cost-toll':
                            $('input[name="transfer_cost_option"][value="yes"]')
                                .prop('checked', true);
                
                            $('#transfer_cost_fixed_div').show();
                            $('#transfer_routes_div').hide();
                
                            $('#transfer_cost_fixed_toll')
                                .val(cost.price)
                                .attr('required', 'required');
                
                            $('#transfer_cost_toll_id').val(cost.id);
                            break;
                
                        case 'transfer-cost-addon':
                            $('input[name="transfer_cost_option"][value="yes"]')
                                .prop('checked', true);
                
                            $('#transfer_cost_fixed_div').show();
                            $('#transfer_routes_div').hide();
                
                            $('#transfer_cost_fixed_addon')
                                .val(cost.price)
                                .attr('required', 'required');
                
                            $('#transfer_cost_addon_id').val(cost.id);
                            break;
                
                        case 'transfer-cost-parking':
                            $('input[name="transfer_cost_option"][value="yes"]')
                                .prop('checked', true);
                
                            $('#transfer_cost_fixed_div').show();
                            $('#transfer_routes_div').hide();
                
                            $('#transfer_cost_fixed_parking')
                                .val(cost.price)
                                .attr('required', 'required');
                
                            $('#transfer_cost_parking_id').val(cost.id);
                            break;
                    }
                });

                //fetchTransportCost(transportId);
                //enableBtn(country);
                
                // After the loop, populate dinner-transfer specifically
                var dinnerRow = $('[name="type[]"][value="dinner-transfer"]').closest('.row');
                if (dinnerRow.length && response.transport_cost.some(cost => cost.type === 'dinner-transfer')) {
                    var cost = response.transport_cost.find(c => c.type === 'dinner-transfer');
                    dinnerRow.find('[name="id[]"]').val(cost.id);
                    dinnerRow.find('[name="price[]"]').val(cost.price);
                }
                
                // If no transfer-cost found, set default to no
                const hasTransferCost = transportCost.some(cost => cost.type === 'transfer-cost');
                if (!hasTransferCost) {
                    $('input[name="transfer_cost_option"][value="no"]').prop('checked', true);
                    $('#transfer_cost_fixed_divzzz').hide();
                    $('#transfer_routes_div').show();
                    $('#transfer_cost_fixed').removeAttr('required');
                }

                // If no train-transfer-cost found, set default to no for TRAIN transfer
                const hasTrainTransferCost = transportCost.some(cost => cost.type === 'train-transfer-cost');
                if (!hasTrainTransferCost) {
                    $('input[name="train_transfer_cost_option"][value="no"]').prop('checked', true);
                    $('#train_transfer_cost_fixed_div').hide();
                    $('#train_transfer_routes_div').show();
                    $('#train_transfer_cost_fixed').removeAttr('required');
                }

                $('#modalAdd').modal('show');
                $("#location").val('');
            },
            error: function() {
                alert('Failed to fetch transport cost details.');
            }
        });

    });

    $(document).on('click', '#edit-btn', function(e) {
        e.preventDefault();

        var editId = $(this).data('edit-id');

        $.ajax({
            url: 'admin/transport/edit_outsidecity_tranport_price',
            type: 'POST',
            data: {
                id: editId
            },
            dataType: "json",
            success: function(response) {
                let outsideTransport_cost = response.details;
                $('#edit_id').val(outsideTransport_cost.id);
                $('#location').val(outsideTransport_cost.loc);
                $('#charges').val(outsideTransport_cost.price);
                $('#toll_charges').val(outsideTransport_cost.toll_price);
                $('#toll_prices_per_person').val(outsideTransport_cost.toll_prices_per_person);
                $('#parking_charges').val(outsideTransport_cost.parking_price);
                $('#add_on_prices').val(outsideTransport_cost.add_on_prices);
                $('#est_hour').val(outsideTransport_cost.est_hour);
                $('#est_km').val(outsideTransport_cost.est_km);
                $('#est_minutes').val(outsideTransport_cost.est_minutes);
                $('#outside_city_valid_from').val(outsideTransport_cost.valid_from).trigger("change");
                $('#outside_city_valid_to').val(outsideTransport_cost.valid_to).trigger("change");
                $('#status').val(outsideTransport_cost.status);
                
                $('#sites_id').val(outsideTransport_cost.sites_id);
                $('#location_id').val(outsideTransport_cost.location_ids);
            },
            error: function() {
                alert('Failed to edit transport cost.');
            }
        });
    });

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
    }

    function fetchTransportCost(transportId) {
        const options = {
            year: 'numeric',
            month: 'short',
            day: '2-digit'
        };
                    
        $.ajax({
            url: 'transport-costing',
            type: 'POST',
            data: {
                id: transportId
            },
            dataType: "json",
            success: function(response) {
                let outsideTransport_cost = response.outside_transport_cost;

                var tableBody = $('.outside-transport');
                tableBody.empty();

                $.each(outsideTransport_cost, function(index, item) {
                    const selectedDate_from = new Date(item.valid_from);
                    const selectedDate_to = new Date(item.valid_to);
                    var row = '<tr>' +
                        '<td class="center">' + (index + 1) + '</td>' +
                        '<td class="center">' + item.loc + '</td>' +
                        '<td class="center">' + item.price + '</td>' +
                        '<td class="center">' + item.toll_price + '</td>' +
                        '<td class="center">' + item.toll_prices_per_person + '</td>' +
                        '<td class="center">' + item.parking_price + '</td>' +
                        '<td class="center">' + item.add_on_prices + '</td>' +
                        '<td class="center">' + item.est_hour + '</td>' +
                        '<td class="center">' + item.est_minutes + '</td>' +
                        '<td class="center">' + item.est_km + '</td>' +
                        '<td class="center">' + selectedDate_from.toLocaleDateString('en-IN', options) + '</td>' +
                        '<td class="center">' + selectedDate_to.toLocaleDateString('en-IN', options) + '</td>' +
                        '<td class="center" style="color:' + (item.status.toLowerCase() === 'active' ? 'green' : 'red') + ';">' +
                        capitalizeFirstLetter(item.status) +
                        '</td>' +
                        '<td class="center"><a href="#" class="btn btn-success btn-xs" id="edit-btn" data-edit-id="' +
                        item.id + '">Edit</a></td>' +
                        '</tr>';
                    tableBody.append(row);
                });
            },
            error: function() {
                alert('Failed to fetch transport cost details.');
            }
        });
    }

    function enableBtn(country) {
        $.ajax({
            url: 'admin/transport/btn_enable',
            type: 'POST',
            data: {
                country: country
            },
            dataType: "json",
            success: function(response) {
                const disableBtnDiv = document.getElementById('disable-btn');

                if (response && Object.keys(response).length > 0) {
                    disableBtnDiv.classList.add('active');
                    disableBtnDiv.classList.remove('disabled');
                } else {
                    disableBtnDiv.classList.add('disabled');
                    disableBtnDiv.classList.remove('active');
                }
            },
            error: function() {}
        });
    }

    $(document).ready(function() {

        var allowedCountryIds = [15, 20, 81, 112, 11, 234];
        var country_flag = false;

        $("#countrys").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?= base_url('admin/masters/get_specific_country_ajax') ?>",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term,
                        allowed_ids: allowedCountryIds.join(',')
                    },
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

        var state_flag = false;
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
                var state_flag = false;
            },
            select: function(event, ui) {
                // Set selection
                $('#state').val(ui.item.label);
                $('#state_id').val(ui.item.state_id);
                var state_flag = true;
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

        // Function to calculate the time difference in hours
        function calculateHours(startTime, endTime) {
            const start = new Date('1970-01-01T' + startTime + 'Z');
            const end = new Date('1970-01-01T' + endTime + 'Z');
            const diffInMs = end - start;
            const diffInHours = diffInMs / (1000 * 60 * 60);
            return diffInHours.toFixed(2);
        }

        $('.mdl-textfield input[name="start_time[]"], .mdl-textfield input[name="end_time[]"]').each(function() {
            const startTime = $(this).closest('.row').find('input[name="start_time[]"]').val();
            const endTime = $(this).closest('.row').find('input[name="end_time[]"]').val();

            if (startTime && endTime) {
                const hours = calculateHours(startTime, endTime);
                if (hours > 0) {
                    $(this).closest('.row').find('input[name="hours[]"]').val(hours);
                } else {
                    alert('End time must be later than start time.');
                    $(this).closest('.row').find('input[name="hours[]"]').val('');
                    $(this).closest('.row').find('input[name="end_time[]"]').val('');
                }
            }
        });

        // On time change, calculate and update the hours field
        $('input[name="start_time[]"], input[name="end_time[]"]').on('change', function() {
            const startTime = $(this).closest('.row').find('input[name="start_time[]"]').val();
            const endTime = $(this).closest('.row').find('input[name="end_time[]"]').val();

            if (startTime && endTime) {
                const hours = calculateHours(startTime, endTime);
                if (hours > 0) {
                    $(this).closest('.row').find('input[name="hours[]"]').val(hours);
                } else {
                    alert('End time must be later than start time.');
                    $(this).closest('.row').find('input[name="hours[]"]').val('');
                    $(this).closest('.row').find('input[name="end_time[]"]').val('');
                }
            }
        });
    });

    $("#location").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "<?= base_url() ?>admin/transport/outside_locations",
                type: "POST",
                dataType: "json",
                data: {
                    search: request.term,
                    country: $('#countryname').val(),
                    'transport_id': $('#transport_id').val()
                },
                success: function(data) {
                    response(data);
                },
                error: function(xhr, status, error) {
                    console.error("AJAX error:", status, error);
                }
            });
        },
        select: function(event, ui) {
            $('#location').val(ui.item.label);
            $('#location_id').val(ui.item.location_ids);
            $("#toll_charges").val('').attr("readonly",false);
            if(ui.item.type == 'hotel'){
                $('#hotel').val(ui.item.type);
                // $('#sites_id').val(0);
            }else{
                $('#hotel').val(ui.item.type);
                $('#sites_id').val(ui.item.id);
            }
            if(ui.item.location_ids == '0'){
                $("#toll_charges").val("0").attr("readonly",true);
            }
            return false;
        }
    });
    
    
    $('#outside-city-form').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission
        var transportId = $('#transport_id').val();
        var encodedTransportId = btoa(transportId);

        var formData = new FormData(this);

        // AJAX request
        $.ajax({
            url: 'add-outsidecity-transportation-cost', // Get form action URL
            type: 'POST',
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(response) {
                $('#response-msg').html(response.msg)
                $('#outside-city-form')[0].reset();
                $('#edit_id').val('');
                fetchTransportCost(encodedTransportId);
            },
            error: function(xhr, status, error) {
                // Handle error
                alert('An error occurred: ' + xhr.responseText);
            }
        });
    });
    
    $(document).on('click', '.close', function(e) {
        location.reload();
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

        if ($(this).attr("id") === "valid_from" && $("#valid_to").val() === "") {
            $("#valid_to").attr("min", $(this).val());
        } else if ($(this).attr("id") === "valid_from" && $("#valid_to").val() !== "") {
            const selectedToDate = new Date($("#valid_to").val());
            if (parseInt(selectedToDate.getTime()) < parseInt(selectedDate.getTime())) {
                $("#valid_to").val('').attr("min", $(this).val());
                $(".dt-search-show").eq($("#valid_to").index(".dt-search")).val('');
            }
        }
        if ($(this).attr("id") === "valid_to" && $("#valid_from").val() === "") {
            $("#valid_from").attr("max", $(this).val());
        } else if ($(this).attr("id") === "valid_to" && $("#valid_from").val() !== "") {
            const selectedFromDate = new Date($("#valid_from").val());
            if (parseInt(selectedFromDate.getTime()) > parseInt(selectedDate.getTime())) {
                $("#valid_from").val('').attr("max", $(this).val());
                $(".dt-search-show").eq($("#valid_from").index(".dt-search")).val('');
            }
        }
        
    });
    
    $(".dt-search-outside-city").on("change", function () {
        var idx = $(this).index(".dt-search-outside-city");
        const selectedDate = new Date($(".dt-search-outside-city").eq(idx).val());
        if(selectedDate == "Invalid Date"){ selectedDate = new Date(); }
        //const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
        const options = {
            year: 'numeric',
            month: 'short',
            day: '2-digit'
        };
        const formattedDate = selectedDate.toLocaleDateString('en-IN', options);
        $(".dt-search-show-outside-city").eq(idx).val(formattedDate).parent().addClass('is-focused');

        if ($(this).attr("id") === "outside_city_valid_from" && $("#outside_city_valid_to").val() === "") {
            $("#outside_city_valid_to").attr("min", $(this).val());
        } else if ($(this).attr("id") === "outside_city_valid_from" && $("#outside_city_valid_to").val() !== "") {
            const selectedToDate = new Date($("#outside_city_valid_to").val());
            if (parseInt(selectedToDate.getTime()) < parseInt(selectedDate.getTime())) {
                $("#outside_city_valid_to").val('').attr("min", $(this).val());
                $(".dt-search-show-outside-city").eq($("#outside_city_valid_to").index(".dt-search-outside-city")).val('');
            }
        }
        if ($(this).attr("id") === "outside_city_valid_to" && $("#outside_city_valid_from").val() === "") {
            $("#outside_city_valid_from").attr("max", $(this).val());
        } else if ($(this).attr("id") === "outside_city_valid_to" && $("#outside_city_valid_from").val() !== "") {
            const selectedFromDate = new Date($("#outside_city_valid_from").val());
            if (parseInt(selectedFromDate.getTime()) > parseInt(selectedDate.getTime())) {
                $("#outside_city_valid_from").val('').attr("max", $(this).val());
                $(".dt-search-show-outside-city").eq($("#outside_city_valid_from").index(".dt-search-outside-city")).val('');
            }
        }

    });

    function check_dates(){
        if($("#valid_from").val() != "" && $("#valid_to").val() != ""){
            var flag = true;
            $("#add-transport-cost-dates option").each(function(){
                var selected = $(this)[0].value;
                var d = $("#valid_from").val()+"_"+$("#valid_to").val();
                if(selected != "" && selected == d){
                    flag=false;
                }
            });
        
            if(!flag && $('[name="id[]"]').val() == ""){
                $("#msg-div").fadeIn();
                $("#msg-div").html("").html("<div class='alert alert-danger'>Selected Validity Dates Already Exists!</div>");
                $("#msg-div").fadeOut(7000);
                return false;
            }	
        }
    }
// document.getElementById('est_km').addEventListener('input', function () {
//     if (this.value.length > 3) {
//         this.value = this.value.slice(0, 3);
//     }
// });

</script>