<!-- END HEAD -->
<?php include('admin_head_css.php'); ?>
 
<div class="page-wrapper">
        <div class="container-fluid">
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                            <h4 class="text-themecolor">Edit Company</h4>
                        </div>
                        <div class="col-lg-3 only-for-dashbord">
                        </div>
                        <div class="col-lg-6 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('clients'); ?>">Agents</a></li>
                                    <li class="breadcrumb-item active">Edit Company</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content">
                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']);
                    //echo validation_errors(); ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <!-- <div class="card-head">
                                <button type="button" class="btn btn-dark" title="Previous Page" onclick="history.back();">
                                    <i class="fas fa-arrow-left"></i>
                                </button>
                                    <header>Edit Company</header>
                                </div> -->
                                <?php echo form_open_multipart(); ?>
                                <?php echo form_input(['name' => 'id', 'type' => 'hidden', 'id' => 'id', 'class' => 'mdl-textfield__input', 'value' => $company[0]->id]); ?>
                                <div class="card-body row">
                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Name</label>
                                            <?php echo form_input(['name' => 'name', 'id' => 'name', 'class' => 'mdl-textfield__input', 'value' => $company[0]->name]); ?>
                                            <?php echo form_error('name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
                            <label class = "mdl-textfield__label">Select Country</label> 		 	 
							<?php echo form_input(['name'=>'country','id'=>'country','placeholder'=>'Country', 'required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>trim($company[0]->country)])?>    
					                  </div>
						            </div>
							<input type="hidden" name="country_id" id="country_id" value="">
							
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
                            <label class = "mdl-textfield__label">State</label>		 	 
							<?php echo form_input(['name'=>'state','id'=>'state','placeholder'=>'State','required'=>'required',  'class'=>'mdl-textfield__input', 'value'=>trim($company[0]->state)])?>    
					                  </div>
						            </div>
							<input type="hidden" name="state_id" id="state_id" value="">
							
						            <div class="col-lg-4 p-t-20"> 
						              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">			 
					                
                            <label class = "mdl-textfield__label">City</label>		 	 
							<?php echo form_input(['name'=>'city','id'=>'city','placeholder'=>'City','required'=>'required', 'class'=>'mdl-textfield__input', 'value'=>trim($company[0]->city)])?>    
					                  </div>
						            </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Pincode</label>
                                            <?php echo form_input(['name' => 'pincode', 'id' => 'pincode', 'class' => 'mdl-textfield__input', 'value' => trim($company[0]->pincode)]); ?>
                                            <?php echo form_error('pincode'); ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Address Line 1</label>
                                            <?php echo form_input(['name' => 'address', 'id' => 'address', 'class' => 'mdl-textfield__input', 'value' => trim($company[0]->address)]); ?>
                                            <?php echo form_error('address'); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Address Line 2</label>
                                            <?php echo form_input(['name' => 'address_2', 'id' => 'address_2', 'class' => 'mdl-textfield__input', 'value' => trim($company[0]->address_2)]); ?>
                                        </div>
                                    </div>
                                    <!--div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <?php //echo form_input(['name' => 'address_3', 'id' => 'address_3', 'class' => 'mdl-textfield__input', 'value' => trim($company[0]->address_3)]); ?>
                                            <label class="mdl-textfield__label">Address Line 3</label>
                                        </div>
                                    </div-->

                                    <div class="col-lg-4 p-t-20">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">GST</label>
                                            <?php echo form_input(['name' => 'gst', 'id' => 'gst', 'class' => 'mdl-textfield__input', 'value' => $company[0]->gstin]); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <label class="mdl-textfield__label">Status</label>
                                            <select name="status" id="status" class="mdl-textfield__input">
                                                <option value="active" <?= ($company[0]->status === 'active') ? 'selected' : '' ?>>Active</option>
                                                <option value="inactive" <?= ($company[0]->status === 'inactive') ? 'selected' : '' ?>>In-active</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 p-t-20 text-center">
                                        <?php echo form_submit(['name' => 'submit', 'id' => 'submit', 'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-info', 'value' => 'Submit']); ?>
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

    </div>

    <script>
           $(document).ready(function () {

            $("#country").autocomplete({
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/get_country_ajax",
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
                    // Set selection
                    $('#country').val(ui.item.label); // display the selected text
                    $('#country_id').val(ui.item.country_id); // save selected id to input

                    return false;
                }
            });

            $("#state").autocomplete({
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/get_state_ajax",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term,
                            country_id: $('#country_id').val()
                        },
                        success: function (data) {

                            response(data);
                        }
                    });
                },
                select: function (event, ui) {
                    // Set selection
                    $('#state').val(ui.item.label); // display the selected text
                    $('#state_id').val(ui.item.state_id); // save selected id to input

                    return false;
                }
            });

            $("#city").autocomplete({
                source: function (request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url() ?>admin/company/get_city_ajax",
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
                },
                select: function (event, ui) {
                    // Set selection
                    $('#city').val(ui.item.label); // display the selected text
                    //   $('#company_id').val(ui.item.company_id); // save selected id to input

                    return false;
                }
            });

        });

        </script>
