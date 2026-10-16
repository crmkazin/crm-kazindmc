<?php include('admin_head_css.php'); ?>
<?php
$tier1_selected = isset($existing->tier1) && $existing->tier1 != '' ? explode(',', $existing->tier1) : [];
$tier2_selected = isset($existing->tier2) && $existing->tier2 != '' ? explode(',', $existing->tier2) : [];
$tier3_selected = isset($existing->tier3) && $existing->tier3 != '' ? explode(',', $existing->tier3) : [];
?>

<link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet" />
<style>
    .select2-selection__choice {
        background-color: #e0e0e0;
        border-radius: 1rem;
        font-size: 8px !important;
        color: #000 !important;
        height: 1.5rem !important;
        padding: 0 10px !important;
    }
    .select2-selection_choice_remove{
        transform:scale(0.8) !important;
    }
    .select2-selection{
        border: solid 1px #ccc !important;
        border-radius: 4px !important;
        padding: 0px 8px !important;

    }
    .selected{
        font-size: 12px !important;
    }
    button, input, optgroup, textarea{
            font-size: 12px !important;
    }

    .select2-search__field{
        margin-left: 2px !important;

    }
    select, input{
        height: 38px !important;
    }
</style>
 <div class="page-wrapper">
        <div class="container-fluid">
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-2 col-sm-6  col-6 align-self-center">
                        <h4 class="text-themecolor">Add State-Tier</h4>
                        </div>
                        <div class="col-lg-6 only-for-dashbord">
                        </div>
                        <div class="col-lg-4 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('tier-filter'); ?>">Users</a></li>
                                    <li class="breadcrumb-item active">Add State Tier</li>
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
                             
                                    <form method="post">
                                    <div class="card-body row">							
                                        
                                        <div class="col-lg-4 col-sm-6 p-t-10"> 
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                <label class="mdl-textfield__label">Tier 1</label> 
                                                <select name="tier1[]" id="tier1" class="mdl-textfield__input tier-select" multiple style="padding: 10px;"> 
                                                    <option value=""></option>
                                                <?php foreach($states as $state){ ?>
                                                    <option value="<?= strtolower($state->id); ?>" 
                                                    <?= in_array(strtolower($state->id), $tier1_selected) ? 'selected' : ''; ?>>
                                                    <?= $state->name; ?>
                                                    </option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-lg-4 col-sm-6 p-t-10"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                             <label class = "mdl-textfield__label">Tier 2</label> 
                                                <select name="tier2[]" id="tier2" class="mdl-textfield__input tier-select" multiple style="padding: 10px;"> 
                                                            <option value=""></option>
                                                    <?php foreach($states as $state){ ?>
                                                            <option value="<?php echo strtolower($state->id); ?>" <?= in_array(strtolower($state->id),$tier2_selected) ? 'selected' : '';?>><?php echo $state->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                           
											</div>
                                        </div>


                                        <div class="col-lg-4 col-sm-6 p-t-10"> 
                                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                             <label class = "mdl-textfield__label">Tier 3</label> 
                                                <select name="tier3[]" id="tier3" class="mdl-textfield__input tier-select" multiple style="padding: 10px;"> 
                                                    <option value=""></option>
                                                    <?php foreach($states as $state){ ?>
                                                            <option value="<?php echo strtolower($state->id); ?>" <?= in_array(strtolower($state->id),$tier3_selected) ? 'selected' : '';?>><?php echo $state->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                           
											</div>
                                        </div>
                                        
                                             <div class="col-lg-12 p-t-10 text-center"> 
                                                <?php if($existing){ ?>
                                                    <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-info', 'value'=>'Update']);?>	
                                                <?php }else{ ?>
                                                    <?php echo form_submit(['name'=>'submit','id'=>'submit', 'class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-info', 'value'=>'Submit']);?>	
                                               <?php }
                                                ?>
                                        </div>
                                            </div>
                                    </form>
                                        </div>
                                </div>
                        </div>
		
                </div>
            </div>
            <!-- end page content -->
        </div>

    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- jQuery UI -->
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> 
<script>
$(document).ready(function() {

    function updateOptions() {
        // Get selected values from all tiers
        var tier1Selected = $('#tier1').val() || [];
        var tier2Selected = $('#tier2').val() || [];
        var tier3Selected = $('#tier3').val() || [];

        // Enable all options first
        $('#tier1 option, #tier2 option, #tier3 option').prop('disabled', false);

        // Tier 1: disable Tier 2 & 3 selections
        tier1Selected.forEach(function(val){
            $('#tier2 option[value="'+val+'"]').prop('disabled', true);
            $('#tier3 option[value="'+val+'"]').prop('disabled', true);
        });

        // Tier 2: disable Tier 1 & 3 selections
        tier2Selected.forEach(function(val){
            $('#tier1 option[value="'+val+'"]').prop('disabled', true);
            $('#tier3 option[value="'+val+'"]').prop('disabled', true);
        });

        // Tier 3: disable Tier 1 & 2 selections
        tier3Selected.forEach(function(val){
            $('#tier1 option[value="'+val+'"]').prop('disabled', true);
            $('#tier2 option[value="'+val+'"]').prop('disabled', true);
        });

        // Refresh Select2
        $('#tier1, #tier2, #tier3').select2();
    }

    // Initialize Select2
    $('.tier-select').select2({
        placeholder: 'Select State',
        width: '100%'
    });

    // Bind change event to all tiers
    $('.tier-select').on('change', function() {
        updateOptions();
    });

    updateOptions();

});
</script>

