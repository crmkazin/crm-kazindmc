<?php include ('admin_head_css.php'); ?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="page-content-wrapper">
            <div class="page-bar">
                <div class="row page-titles">
                    <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                        <h4 class="text-themecolor">Add driver</h4>
                    </div>
                    <div class="col-lg-2 only-for-dashbord">
                    </div>
                    <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo base_url('drivers-list'); ?>">Driver List</a></li>
                                <li class="breadcrumb-item active">Add driver</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">
            <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); echo validation_errors();?>
            <div class="row">
                <div class="col-sm-12">
                <div class="card-box">
                   
                    <?php echo form_open_multipart(); ?>
                    <div class="card-body row">
                        
                        <div class="col-lg-4 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class="mdl-textfield__label">Country</label>
                        <?php 
                            $readonly=[];
                            $country = '';
                            if($this->session->userdata('admin_type') != 'superadmin' && $this->session->userdata('locations')!='all'){
                                $readonly = ['readonly'=>'readonly'];
                                $country = ucfirst($this->session->userdata('locations'));
                            }
                        echo form_input(['name' => 'country', 'id' => 'country', 'class' => 'mdl-textfield__input', 'required' => 'required', 'value' => $country]+$readonly); ?>
                        <?php echo form_error('country'); ?>
                        <input type="hidden" name="country_id" id="country_id" value="">

                        </div>
                    </div>
                        
                        <div class="col-lg-4 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label class="mdl-textfield__label">State</label>
                                <?php echo form_input(['name' => 'state', 'id' => 'state', 'class' => 'mdl-textfield__input',  'value' => set_value('state')]); ?>
                                <?php echo form_error('state'); ?>
                                <input type="hidden" name="state_id" id="state_id" value="">

                            </div>
                        </div>
                        
                        <div class="col-lg-4 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class="mdl-textfield__label">City</label>
                        <?php echo form_input(['name' => 'city', 'id' => 'city', 'class' => 'mdl-textfield__input',  'value' => set_value('city')]); ?>
                        <?php echo form_error('city'); ?>
                        </div>
                        </div>
                        
                        <div class="col-lg-4 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class="mdl-textfield__label">Name</label>
                            <?php echo form_input(['name'=>'name','id'=>'name','class'=>'mdl-textfield__input','required'=>'required','value'=>set_value('name')])?>
                            <?php echo form_error('name');?>
                        </div>
                        </div>
                        
                        <div class="col-lg-2 p-t-20">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class="mdl-textfield__label">ISD</label>
                            <select name="isd_codes" class="mdl-textfield__input" style="padding-top:13px;">
                            <?php 
                                $selected = '+91';
                                $allowed_countries = ['AZ','BY','IN','KZ','GE','AE','AM','UZ'];
                                foreach($country_isd_codes AS $list){  
                                    if(in_array($list->country_code,$allowed_countries)){
                                    ?>
                            <option value="<?=$list->isd_codes?>"
                                <?php echo ($list->isd_codes==$selected)?'selected':''; ?>>
                                <?=$list->isd_codes.' ('.$list->country.')'; ?></option>
                            <?php } } ?>
                            </select>
                            <?php echo form_error('isd_codes');?>
                        </div>
                        </div>

                        <div class="col-lg-2 p-t-20">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label class="mdl-textfield__label">Mobile</label>
                            <?php echo form_input(['name'=>'phone_number','id'=>'phone_number','class'=>'mdl-textfield__input','type'=>'number','required'=>'required','value'=>set_value('mobile')])?>
                            <?php echo form_error('phone_number'); ?>
                        </div>
                        </div>
                            
                        <input type="hidden" name="state_id" id="state_id" value="">

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

        function split(val) {
            return val.split(/,\s*/);
        }

        function extractLast(term) {
            return split(term).pop();
        }
        $("#state").autocomplete({
            source: function (request, response) {
                var country_id = $('#country_id').val();
                // if (!country_id) {
                // alert("Please select country");
                // $('#state').val('');
                // $('#state_id').val('');
                // return; 
                // }
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/company/get_state_ajax",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: extractLast(request.term),
                        country_id: $('#country_id').val()
                    },
                    success: function (data) {

                        response(data);
                    }
                });
            },
            select: function (event, ui) {
                // Set selection

                var terms = split(this.value);
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push(ui.item.label);
                // add placeholder to get the comma-and-space at the end
                terms.push("");
                this.value = terms.join(", ");
                if (terms.length > 2) {
                    $("#city").val("").attr('disabled', 'disabled');
                } else {
                    $("#city").removeAttr('disabled');
                    $('#state_id').val(ui.item.state_id);
                }
                return false;

                //$('#state').val(ui.item.label); // display the selected text
                //$('#state_id').val(ui.item.state_id); // save selected id to input
                //return false;
            }
        });

        $("#city").autocomplete({
            source: function (request, response) {
                var state_id = $('#state').val();
                // if (!state_id) {
                //     alert("Please select state");
                //     $('#city').val('');
                //     return; 
                // }
                // Fetch data
                $.ajax({
                    url: "<?= base_url() ?>admin/company/get_city_ajax",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: extractLast(request.term),
                        state_id: $('#state_id').val()
                    },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            select: function (event, ui) {
                // Set selection

                var terms = split(this.value);
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push(ui.item.label);
                // add placeholder to get the comma-and-space at the end
                terms.push("");
                this.value = terms.join(", ");
                return false;

                //$('#city').val(ui.item.label); // display the selected text
                //$('#company_id').val(ui.item.company_id); // save selected id to input
                //return false;
            }
        });
    });
</script>