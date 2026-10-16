 <?php include('admin_head_css.php');?>
  <div class="page-wrapper">
        <!-- start page container -->
        <div class="container-fluid">
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                            <h4 class="text-themecolor">Add New Train</h4>
                        </div>
                        <div class="col-lg-2 only-for-dashbord">
                        </div>
                        <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item active">Add New Train</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content">
                    <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                          
                                <?php echo form_open(); ?>
                                <div class="card-body row">
                                    
                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <label class="mdl-textfield__label">Country</label>
                                        <?php echo form_input(['name' => 'country', 'id' => 'country', 'class' => 'mdl-textfield__input mb-2', 'value' => set_value('country')]); ?>
                                        <?php echo form_error('country'); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Train Name</label>
                                            <?php echo form_input(['name' => 'train_name', 'id' => 'train_name', 'class' => 'mdl-textfield__input mb-2',  'placeholder'=> '', 'value' => set_value('train_name')]); ?>
                                            <?php echo form_error('train_name'); ?>
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
            <!-- end page content -->
        </div>
        <!-- end page container -->
    </div>
<script>
$(document).ready(function () {
    $("#country").autocomplete({
        source: function (request, response) {
            $.ajax({
            url: "<?= base_url() ?>admin/company/get_country_ajax_new",
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
            $('#country').val(ui.item.label);
            $('#country_id').val(ui.item.country_id);

            return false;
        }
    });
});
</script>