<?php include('admin_head_css.php'); ?>
<div class="page-wrapper">
        <!-- start page container -->
        <div class="container-fluid">
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                            <h4 class="text-themecolor">Masters</h4>
                        </div>
                        <div class="col-lg-4 only-for-dashbord">
                        </div>
                        <div class="col-lg-5 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('masters'); ?>">Masters</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('location-master'); ?>">location-master</a></li>
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

                                    <!-- Submit -->
                                    <div class="col-lg-3 mt-2">
                                        <?php echo form_submit([
                                            'name' => 'submit', 
                                            'id' => 'submit', 
                                            'class' => 'btn btn-md btn-primary m-t-20', 
                                            'style' => 'float:left;', 
                                            'value' => 'Search'
                                        ]); ?>
                                    </div>
                                </div>
                            </form>
                                
                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-striped border table-checkable order-column full-width" id="location-master">
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">Country</th>
                                                    <th class="center">Location</th>
                                                    <th class="center">Destination Type</th>
                                                    <th class="center">Status</th>
                                                    <th class="center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                //echo '<pre>';print_r($company); print_r($this->session->userdata); die;
                                                $i = 1;
                                                if (!empty($result)) {
                                                    foreach ($result as $list) {
                                                ?>
                                                        <tr class="odd gradeX">
                                                            <td class="center"><?= $i++ ?></td>
                                                            <td class="center"><?php echo ucwords($list->country); ?></td>
                                                            <td class="center"><?php echo ucwords($list->location); ?></td>
                                                            <td class="center"><?= ucwords($list->destination_type); ?></td>
                                                            <td class="center"><a class="btn <?= $list->status == 'active' ? 'btn-success' : 'btn-danger' ?> btn-xs"><?= ucwords($list->status); ?></a>
                                                            </td>
                                                            <td class="center">
                                                                <a href="<?php echo base_url('location-master?id=' . base64_encode($list->id)); ?>" class="btn btn-tbl-edit btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                                                                   <?php if ($this->session->userdata('type') == 1) { ?>
                                                                    <a href="<?= base_url('location/delete/' . base64_encode($list->id)) ?>" onclick="return confirm('Are you sure you want to delete this ?');" class="btn btn-tbl-delete btn-xs" title="Delete">
                                                                        <i class="fas fa-trash"></i> </a>
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

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <div class="card-head">
                                    <header>Add / Edit Location Master</header>
                                    <div class="tools">

                                    </div>
                                </div>
                                <?php echo form_open_multipart(current_url() . '?' . $_SERVER['QUERY_STRING'], ['id' => 'frm-blackout-dates']); ?>
                                <div class="card-body row">
                                    <div class="col-lg-3 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Country</label>
                                            <select name="country" id="country" class="mdl-textfield__input"
                                                style="padding: 10px;">
                                                <option value="">Select..</option>
                                                    <?php if($this->session->userdata('admin_type') == 'user') {
                                                        $user_locations = explode(',', $this->session->userdata('locations')); 
                                                        asort($locations);

                                                        foreach ($locations as $key => $val) {
                                                            if (in_array($key, $user_locations)) {
                                                                $selected = ($this->input->get('location') != '' && $this->input->get('location') == $key) ? 'selected="selected"' : '';
                                                                ?>
                                                                <option value="<?= $key ?>" data-abbr="<?= implode(',', $val) ?>" <?= $selected ?>>
                                                                    <?= ucfirst($key) ?>
                                                                </option>
                                                            <?php 
                                                            }
                                                        } 
                                                    } else { ?>
                                                        <?php 
                                                        asort($locations);
                                                        foreach($locations AS $key=>$val){ $val[]='All'; ?>
                                                        <option value="<?=$key?>" data-abbr="<?=implode(',',$val)?>" <?=($this->input->get('location')<>'' && $this->input->get('location')==$key)?'selected="selected"':''; ?>>
                                                            <?= ucfirst($key)?></option>
                                                       <?php } ?>
                                                   <?php  } ?>
                                            </select>
                                            
                                        </div>
                                    </div>

                                    <div class="col-lg-3 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Location</label>
                                            <?php echo form_input(['name' => 'location', 'id' => 'location', 'required' => 'required', 'class' => 'mdl-textfield__input', 'value' => isset($result_data->location) ? $result_data->location : set_value('location')]) ?>
                                            
                                            <?php echo form_error('event_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                                            <label class="mdl-textfield__label">Destination Type</label>
                                            <select name="destination_type" class="mdl-textfield__input" style="padding-top:13px;">
                                                <option value="intercity" <?php echo (isset($result_data->destination_type) && $result_data->destination_type == 'intercity') ? 'selected="selected"' : ''; ?>>
                                                    Intercity</option>
                                                <option value="outsidecity" <?php echo (isset($result_data->destination_type) && $result_data->destination_type == 'outsidecity') ? 'selected="selected"' : ''; ?>>
                                                    Outside City</option>
                                            </select>
                                            
                                            <?php echo form_error('destination_type'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                                            <label class="mdl-textfield__label">Status</label>
                                            <select name="status" class="mdl-textfield__input" style="padding-top:13px;">
                                                <option value="active" <?php echo (isset($result_data->status) && $result_data->status == 'active') ? 'selected="selected"' : ''; ?>>
                                                    Active</option>
                                                <option value="inactive" <?php echo (isset($result_data->status) && $result_data->status == 'inactive') ? 'selected="selected"' : ''; ?>>
                                                    In-active</option>
                                            </select>
                                            
                                            <?php echo form_error('status'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-1 p-t-20 text-center">
                                        <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value' => 'Submit']); ?>
                                    </div>

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
    $(document).ready(function() {
        var table = $('#location-master').DataTable({
            responsive: true
            //"scrollY": "200px",
            //"paging": false
        });

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
    });
</script>