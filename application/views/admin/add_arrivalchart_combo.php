<?php include('admin_head_css.php'); ?>
<style>
    .div_color {
        background-color: #f8f8f9;
    }

    .div_color_new {
        background-color: #FFFFF7;
    }

    .ui-front {
        z-index: 9999999 !important;
    }
   
    #frm_hoteldetails br {
        display: none;
    }
    
    .booking-type-section {
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 15px;
    }
    
    .booking-type-header {
        background-color: #f5f5f5;
        padding: 8px 12px;
        margin: -15px -15px 15px -15px;
        border-bottom: 1px solid #ddd;
        border-radius: 5px 5px 0 0;
    }
</style>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="page-content-wrapper">
            <div class="page-bar">
                <div class="row page-titles">
                    <div class="col-md-5 col-5 align-self-center">
                        <h4 class="text-themecolor">Add Arrival</h4>
                    </div>
                    <div class="col-md-7 col-7 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">Home</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo base_url('arrivals');?>">Arrival Chart</a></li>
                                <li class="breadcrumb-item active"><a href="">Add Arrival</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                <?php echo $this->session->flashdata('message');
                unset($_SESSION['message']); ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <form method="post" id="frm_arrival" enctype="multipart/form-data">
                                <div class="card-body">
                                    <!-- Booking Types Section -->
                                    <?php
                                    // print_r($enquiry->enquiry_abbr);
                                    
                                    // Process enquiry abbreviations
                                    $enquiry_abbrs = [];
                                    if (!empty($enquiry->enquiry_abbr)) {
                                        if (is_array($enquiry->enquiry_abbr)) {
                                            $enquiry_abbrs = $enquiry->enquiry_abbr;
                                        } else {
                                            $enquiry_abbrs = explode(',', $enquiry->enquiry_abbr);
                                        }
                                    }
                                    
                                    foreach ($enquiry_abbrs as $index => $abbr):
                                        $abbr = trim($abbr);
                                        $this->db->select('*');
                                        $this->db->from('combo_enquiry');       
                                        $this->db->where('enquiry_abbr', $abbr);
                                        $data = $this->db->get()->result_array();
                                        
                                    ?>

                                    <div class="booking-type-section">
                                        <div class="booking-type-header">
                                            <h5 class="mb-0">Booking Type: <?php echo $abbr; ?></h5>
                                        </div>
                                        
                                        <input type="hidden" name="combo_id[]" value="<?php echo $data[0]['id']; ?>">
                                        <div class="row">
                                            <div class="col-lg-3 p-t-20">
                                                <label class="mdl-textfield__label">Physical Arrival
                                                    Date</label><?php echo form_error('arrival_date'); ?>
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"
                                                style="display:inline-flex;">
                                                    <input type="text" name=""
                                                        class="mdl-textfield__input dt-dateformat-show"
                                                        value="<?php echo ($enquiry->check_in_date <> '') ? date('d-M-Y', strtotime($enquiry->check_in_date)) : ''; ?>"
                                                        style="width:100%;" readonly>
                                                    <?php echo form_input(['type' => 'date', 'name' => 'arrival_date[]', 'placeholder' => '', 'id' => 'arrival_date', 'required' => 'required', 'class' => 'check-dts dt-dateformat', 'value' => $enquiry->check_in_date, 'style' => 'width:17px;float:right;position: absolute; right: 5%; border: none; background-color: transparent; top: 50%; transform: translateY(-50%);']) ?>

                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="row">
                                            <div class="col-lg-2 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">Booking Type</label>
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused mdl-textfield__input">
                                                        <?php echo $abbr; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-2 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">File No</label><?php echo form_error('enquiry_no'); ?>
                                                    <?php echo form_input([
                                                        'name' => 'enquiry_no[]', 
                                                        'id' => 'enquiry_no_' . $index, 
                                                        'class' => 'mdl-textfield__input', 
                                                        'value' => $enquiry->enquiry_no, 
                                                        'readonly' => True
                                                    ]) ?>
                                                    <input type="hidden" name="file_seq[]" id="file_seq_<?php echo $index; ?>" value="" />
                                                </div>
                                            </div>
                                            
                                            <?php if($this->input->get('split')<>''){ ?>
                                                <div class="col-lg-1 p-t-20 div_color">
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                        <label class="mdl-textfield__label">Split No</label>
                                                        <?php echo form_input([
                                                            'name' => 'split_count[]', 
                                                            'id' => 'split_count_' . $index, 
                                                            'class' => 'mdl-textfield__input', 
                                                            'value' => $enquiry->split_count+1, 
                                                            'readonly' => True
                                                        ]) ?>
                                                    </div>
                                                </div>
                                            <?php } ?>

                                            <div class="col-lg-3 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">Agent Name</label>
                                                    <?php echo form_input([
                                                        'type' => 'text', 
                                                        'name' => 'agent_name[]', 
                                                        'placeholder' => '', 
                                                        'id' => 'agent_name_' . $index, 
                                                        'class' => 'mdl-textfield__input', 
                                                        'value' => $enquiry->name, 
                                                        'readonly' => True
                                                    ]) ?>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-3 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">Agent Reference Number</label>
                                                    <?php
                                                    echo form_input([
                                                        'name' => 'agent_reference_num[]', 
                                                        'id' => 'agent_reference_num_' . $index, 
                                                        'placeholder' => 'Agent Reference Number', 
                                                        'class' => 'mdl-textfield__input', 
                                                        'value' => ''
                                                    ]);
                                                    ?>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-2 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">Lead Name</label>
                                                    <?php
                                                    echo form_input([
                                                        'name' => 'lead_name[]', 
                                                        'id' => 'lead_name_' . $index, 
                                                        'placeholder' => 'Lead Name', 
                                                        'class' => 'mdl-textfield__input', 
                                                        'value' => '', 
                                                        'required' => 'required'
                                                    ]);
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="col-lg-1 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">ISD</label>
                                                    <?php echo form_input([
                                                        'name' => 'lead_isd_code[]', 
                                                        'id' => 'lead_isd_code_' . $index, 
                                                        'placeholder' => 'ISD Code', 
                                                        'class' => 'mdl-textfield__input', 
                                                        'value' => '', 
                                                        'required' => 'required', 
                                                        'value' => isset($enquiry->lead_isd_code) ? $enquiry->lead_isd_code : ''
                                                    ]); ?>
                                                </div>
                                            </div>

                                            <div class="col-lg-2 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">Lead Contact</label>
                                                    <?php
                                                    echo form_input([
                                                        'name' => 'lead_contact[]', 
                                                        'id' => 'lead_contact_' . $index, 
                                                        'placeholder' => 'Lead Contact', 
                                                        'class' => 'mdl-textfield__input', 
                                                        'value' => '', 
                                                        'required' => 'required'
                                                    ]);
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="col-lg-1 p-t-20 hide">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="padding:0;">
                                                    <label for="lead_photo_<?php echo $index; ?>" class="btn btn-xs btn-info">Lead Photo</label>
                                                    <input type="file" class="btn btn-xs btn-info mdl-textfield__input" style="white-space: normal;display:none;" name="lead_photo[]" id="lead_photo_<?php echo $index; ?>" />
                                                </div>
                                            </div>

                                            <div class="col-lg-2 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">Number Of Rooms</label>
                                                    <?php
                                                    echo form_input([
                                                        'name' => 'number_rooms[]', 
                                                        'id' => 'number_rooms_' . $index, 
                                                        'placeholder' => 'Number Of Rooms', 
                                                        'class' => 'mdl-textfield__input', 
                                                        'value' => '', 
                                                        'required' => 'required'
                                                    ]);
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="col-lg-2 p-t-20" style="">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">No. Of Adults</label>
                                                    <?php echo form_input([
                                                        'name' => 'number_persons[]', 
                                                        'id' => 'number_persons_' . $index, 
                                                        'class' => 'mdl-textfield__input', 
                                                        'value' => $enquiry->number_persons
                                                    ]) ?>
                                                </div>
                                            </div>

                                            <div class="col-lg-2 p-t-20" style="">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">No. Of Child</label><?php echo form_error('number_child'); ?>
                                                    <?php echo form_input([
                                                        'name' => 'number_child[]', 
                                                        'id' => 'number_child_' . $index, 
                                                        'class' => 'mdl-textfield__input', 
                                                        'value' => $enquiry->number_child
                                                    ]) ?>
                                                </div>
                                            </div>

                                            <input type="hidden" name="hdn_arrival_date[]" id="hdn_arrival_date_<?php echo $index; ?>" value="<?php echo $enquiry->check_in_date; ?>">
                                            <div class="col-lg-3 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">Handling Staff</label>
                                                    <select name="handling_staff[]" id="handling_staff_<?php echo $index; ?>" class="mdl-textfield__input">
                                                        <option value=""></option>
                                                        <?php
                                                        foreach ($users as $user) {
                                                            ?>
                                                        <option value="<?= $user->id ?>" <?php echo ($enquiry->file_handle_by == $user->id) ? 'selected="selected"' : ''; ?>>
                                                            <?= $user->name ?>
                                                        </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- <div class="col-lg-3 p-t-20">
                                                <button type="button" style="width: 100%;" data-toggle="modal"
                                                    data-target="#myModalAddTransportation"
                                                    data-id="<?php //echo $enquiry->id ?>"
                                                    class="mdl-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-info myModal_AddTransportation" >Add
                                                    Transportation</button>
                                            </div>

                                            <div class="col-lg-2 p-t-20">
                                                <button type="button" style="width: 100%;" data-toggle="modal"
                                                    data-target="#myModalguide" id="add-guide-button"
                                                    data-id="<?php //echo $enquiry->id ?>"
                                                    class="mdl-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-info myModal_AddGuide" >Add
                                                    Guide</button>
                                            </div>
                 
                                            <div class="col-lg-2" style="padding-top:35px !important;">
                                                <input type="checkbox" name="chk_guide[]" id="guide_checkbox_<?php //echo $index; ?>"> No Guide
                                            </div> -->

                                            <div class="col-lg-3 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php $group_type = ['Family', 'Men', 'Friends', 'Mice', 'Ladies', 'Couple','Senior Citizen','Senior Citizen Couple','Men & Women','Men & Women Or child']; ?>
                                                    <label class="mdl-textfield__label">Group Type</label>
                                                    <select id="group_type_<?php echo $index; ?>" name="group_type[]" class="mdl-textfield__input">
                                                        <?php foreach ($group_type as $list) { ?>
                                                        <option value="<?= $list ?>"><?= $list ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-2 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">Handover To Client</label>
                                                    <select name="handover_to_client[]" id="handover_to_client_<?php echo $index; ?>" class="mdl-textfield__input">
                                                        <option value="no">No</option>
                                                        <option value="yes">Yes</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-2 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">Handover To Kazin</label>
                                                    <select name="handover_to_kazin[]" id="handover_to_kazin_<?php echo $index; ?>" class="mdl-textfield__input">
                                                        <option value="no">No</option>
                                                        <option value="yes">Yes</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <?php if (in_array($this->session->userdata('type'), ['1', '3'])) { ?>
                                            <div class="col-lg-2 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <label class="mdl-textfield__label">Client Billing (Amount)</label>
                                                    <input type="number" min="0" class="mdl-textfield__input" name="client_billing[]" id="client_billing_<?php echo $index; ?>" value="" required>
                                                    <div id="err_billing_<?php echo $index; ?>"></div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-2 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width is-focused">
                                                    <label class="mdl-textfield__label">Balance Amount</label>
                                                    <input type="number" min="0" class="mdl-textfield__input" name="balance_amount[]" id="balance_amount_<?php echo $index; ?>" placeholder="" value="" readonly>
                                                </div>
                                            </div>
                                            <?php } ?>

                                            <input type="hidden" name="enq_id[]" id="enq_id_<?php echo $index; ?>" value="<?php echo base64_decode($this->input->get('enq_id')); ?>" />
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                    
                                    <!-- Single Submit Button -->
                                    <div class="row">
                                        <div class="col-lg-12 p-t-20 text-center">
                                            <?php echo form_submit([
                                                'name' => 'add_arrival', 
                                                'id' => 'add_arrival', 
                                                'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink', 
                                                'value' => 'Add All Arrivals'
                                            ]); ?>
                                            <input type="button" value="Cancel" name="" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-danger" onclick="history.back();">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // when any .check-dts (date input) changes
        $("#frm_arrival").on("change", ".check-dts", function () {
            const selectedDate = $(this).val();
            if (!selectedDate) return;
            // convert to readable format
            const dateObj = new Date(selectedDate);
            const formattedDate = dateObj.toLocaleDateString('en-IN', { day: '2-digit', month: 'short', year: 'numeric' });
            // update the readonly visible field next to this input
            $(this).closest('.mdl-textfield').find('.dt-dateformat-show').val(formattedDate);
            // update the hidden input field
            $(this).closest('.booking-type-section').find('input[type="hidden"][name^=hdn_arrival_date]').val(selectedDate);
        });

    });
</script>
