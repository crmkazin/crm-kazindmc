<?php include ('admin_head_css.php'); ?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="page-content-wrapper">
            <div class="page-bar">
                <div class="row page-titles">
                    <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                        <h4 class="text-themecolor">Add Region</h4>
                    </div>
                    <div class="col-lg-2 only-for-dashbord">
                    </div>
                    <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo base_url('state-master-list'); ?>">Region List</a></li>
                                <li class="breadcrumb-item active">Add Region</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); echo validation_errors();?>
                        <?php echo form_open_multipart(); ?>
                        <div class="card-body row">
                            <div class="col-lg-4 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <label class="mdl-textfield__label">Country</label>
                                    <?php 
                                    echo form_input(['name' => 'country', 'id' => 'country', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => '']); ?>
                                    <?php echo form_error('country'); ?>
                                    <input type="hidden" name="country_id" id="country_id" value="">
                                </div>
                            </div>
                            
                            <div class="col-lg-4 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <label class="mdl-textfield__label">State</label>
                                    <?php echo form_input(['name' => 'state', 'id' => 'state', 'class' => 'mdl-textfield__input',  'value' => set_value('state')]); ?>
                                    <?php echo form_error('state'); ?>
                                </div>
                            </div>

                            <div class="col-lg-12 p-t-20 text-center">
                            <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 'value'=>'Submit']);?>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        
        var allowedCountryIds = [15, 20, 81, 112, 11, 234];
        var country_flag = false;
        $("#country").autocomplete({
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
                $('#country').val(ui.item.label);
                $('#country_id').val(ui.item.country_id);
                country_flag = true;
                return false;
            }
        }).blur(function () {
            if (!country_flag) $("#country").val("");
        });

       
    });
</script>