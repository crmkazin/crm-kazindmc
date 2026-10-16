<?php include ('admin_head_css.php'); ?>
 <div class="modal fade" id="myModalpricing" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:1140px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Prices</h4>
                <button type="button" class="close close-modal" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ui-front">
                <div class="row">
                    <div class="col-md-12">
                        <div id="msg"></div>                        
                        <form method="post" id="add-form-guide" enctype="multipart/form-data">
                            <input type="hidden" name="guide_id" id="guide_id" value="">
                            <div class="card-body row">
                                <div class="col-lg-12 text-center" style="margin-top:-20px;">
                                    <h4 id="guide-name" class="bold"></h4>
                                </div>
                                <div class="col-lg-6">
                                    <h5 class="bold center" style="background-color: #eff3f6;padding: 7px 7px;">Day Shift Prices</h5>
                                </div>
                                <div class="col-lg-6">                                      
                                    <h5 class="bold center" style="background-color: #eff3f6;padding: 7px 7px;">Night Shift Prices</h5>
                                </div>
                                <div class="row col-lg-12 text-center guide-prices-heading hide">
                                        <div class="col-lg-2 p-t-20">
                                              <label class="bold">Fixed Prices</label>
                                        </div>
                                          <div class="col-lg-2 p-t-20">
                                            <label class="bold">Hourly Prices</label> 
                                          </div>
                                        <div class="col-lg-2 p-t-20">
                                                <label class="bold">Dated</label> 
                                      </div>
                                        <div class="col-lg-2 p-t-20">
                                              <label class="bold">Fixed Prices</label>                                          
                                      </div>
                                      <div class="col-lg-2 p-t-20">                                          
                                               <label class="bold">Hourly Prices</label>                                          
                                      </div>
                                        <div class="col-lg-2 p-t-20">
                                                <label class="bold">Dated</label>                                          
                                      </div>
                                </div>
                                <div class="row col-lg-12 guide-prices">
                                    <div class="col-lg-6 text-center">
                                        <div class="row guide-prices-day"></div>
                                    </div>
                                    <div class="col-lg-6 text-center">
                                        <div class="row guide-prices-night"></div>
                                    </div>
                                </div>
                                <br>
                                <div class="col-lg-6 p-t-20">
                                    <div class="row">
                                      <div class="col-lg-6 p-t-20">
                                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:flex;">
                                              <?php echo form_input(['type'=>'number','name' => 'day_fixed_prices', 'id' => 'day_fixed_prices', 'placeholder' => 'Prices', 'class' => 'mdl-textfield__input', 'value' => '','min'=>'0']) ?>
                                              <label class="mdl-textfield__label">Fixed Prices</label>
                                          </div>
                                      </div>
                                      <div class="col-lg-6 p-t-20">
                                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:flex;">
                                                <?php echo form_input(['type'=>'number','name' => 'day_hourly_prices', 'id' => 'day_hourly_prices', 'placeholder' => 'Prices', 'class' => 'mdl-textfield__input', 'value' => '','min'=>'0']) ?>
                                                <label class="mdl-textfield__label">Hourly Prices</label>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-6 p-t-20">                                      
                                  
                                      <div class="row">
                                        <div class="col-lg-6 p-t-20">
                                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:flex;">
                                              <?php echo form_input(['type'=>'number','name' => 'night_fixed_prices', 'id' => 'night_fixed_prices', 'placeholder' => 'Prices', 'class' => 'mdl-textfield__input', 'value' => '','min'=>'0']) ?>
                                              <label class="mdl-textfield__label">Fixed Prices</label>
                                          </div>
                                        </div>
                                        <div class="col-lg-6 p-t-20">
                                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="display:flex;">
                                                <?php echo form_input(['type'=>'number','name' => 'night_hourly_prices', 'id' => 'night_hourly_prices', 'placeholder' => 'Prices', 'class' => 'mdl-textfield__input', 'value' => '','min'=>'0']) ?>
                                                <label class="mdl-textfield__label">Hourly Prices</label>
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                                  
                                
                                <div class="col-lg-12 p-t-20">
                                    <button type="submit" id="btn_prices" class="btn btn-primary float-right">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>
<div class="modal fade" id="ratingModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Guide Rating</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="number" id="guideRatingInput" class="form-control" placeholder="Enter rating (1-5)" min="1" max="5">
        <input type="hidden" id="selectedGuideId">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="saveRatingBtn">Save Rating</button>
      </div>
    </div>
  </div>
</div>

    
    <div class="page-wrapper">
        <!-- start page container -->
        <div class="container-fluid">
            <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-bar">
                    <div class="row page-titles">
                        <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                            <h4 class="text-themecolor">All Guides</h4>
                        </div>
                        <div class="col-lg-2 only-for-dashbord">
                        </div>
                        <div class="col-lg-7 col-sm-6 col-6 align-self-center text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb justify-content-end">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li> 
                                    <li class="breadcrumb-item active">All Guides</li>
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
                                                <?php echo form_input(['name' => 'state', 'id' => 'state', 'placeholder' => 'State', 'class' => 'bg-white mdl-textfield__input', 'value' => urldecode($this->input->get('state'))]) ?>
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
                                            <a href="add-guide" class="btn btn-info mt-2 ms-2" style="padding: 8px;"><i
                                                class="fa fa-plus"></i>New</a>
                                        </div>
                                    </div>
                                </form>
                                <!-- <div class="card-head"> -->
                                    <!-- <header>All Guides</header> -->
                                    <!-- <div class="tools">
                                        
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    </div>
                                </div> -->
                                <div class="card-body">
                                    <div class="table-scrollable">
                                        <table class="table table-hover table-striped border table-checkable order-column full-width"
                                            id="guidelist">
                                            <thead>
                                                <tr>
                                                    <th class="center">Sr.No</th>
                                                    <th class="center">Country</th>
                                                    <th class="center">State</th>
                                                    <th class="center">City</th>
                                                    <th class="center">First Name</th>
                                                    <th class="center">Last Name</th>
                                                    <th class="center">Gender</th>
                                                    <th class="center">ISD Code</th>
                                                    <th class="center">Contact Number</th>
                                                    <th class="center">Remark</th>
                                                    <th class="center">Languages</th>
                                                    <th class="center">Location</th>
                                                    <th class="center">Photo</th>
                                                    <th class="center">Action</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                $base_url = base_url();
                                                $super_admins = ['rohit@kazindmc.com', 'pankaj@thavertech.com'];
                                                if (!empty($guides)) {
                                                    foreach ($guides as $guide) {

                                                        ?>
                                                <form method="post">
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?= $i++ ?></td>
                                                        <td class="center"><?= $guide->country ?></td>
                                                        <td class="center"><?= $guide->state ?></td>
                                                        <td class="center"><?= $guide->city ?></td>
                                                        <td class="center"><?= $guide->name ?></td>
                                                        <td class="center"><?= $guide->last_name ?></td>
                                                        <td class="center"><?= strtoupper($guide->gender) ?></td>
                                                        <td class="center"><?= $guide->isd_codes ?></td>
                                                        <td class="center"><?= $guide->contact_number ?></td>
                                                        <td class="center"><?= $guide->remarks ?></td>

                                                        <td class="center">
                                                            <?= str_replace(',', ' | ', $guide->languages) ?>
                                                        </td>
                                                        <td class="center"><?= $guide->location ?></td>
                                                        <td class="center">
                                                            <?php if ($guide->photo <> '') { ?>
                                                            <img class="rounded"
                                                                src="<?= $base_url . 'assets/guide/' . $guide->photo ?>"
                                                                width="60" height="60">
                                                            <?php } ?>
                                                        </td>
                                                        <td class="center" style="display:flex;">
                                                            <button class="btn btn-primary btn-xs pricing" data-guide-name="<?php echo $guide->name.' '.$guide->last_name; ?>" data-guide-id="<?php echo base64_encode($guide->id); ?>" title="Pricing" style="padding:4px 4px;">Prices</button>
                                                            <a href="<?php echo base_url('edit-guide?id=' . base64_encode($guide->id)); ?>"
                                                                class="btn btn-tbl-edit btn-xs" title="Edit"><i
                                                                    class="fa fa-edit"></i></a>
                                                            <?php
                                                                $blockedEmails = ['Tsovinar.am@kazindmc.com'];
                                                                if (!in_array($this->session->userdata('email'), $blockedEmails)) {
                                                            ?>
                                                                <a href="<?php echo base_url('delete-guide?id=' . base64_encode($guide->id)); ?>"
                                                                    onclick="return confirm('Are you sure you want to delete this Guide?');"
                                                                    class="btn btn-tbl-delete btn-xs" title="Delete"><i
                                                                        class="fas fa-trash"></i></a>
                                                            <?php } ?>
                                                            <a href="print-guide-details?id=<?php echo base64_encode($guide->id); ?>" target="_blank">
                                                                <i class="fas fa-file" style="color:#ff0000;" title="Pdf"></i>
                                                            </a>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </form>
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
    </div>

<script>
$(document).ready(function() {
    var table = $('#guidelist').DataTable({
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
    
    $("#example4_wrapper").on("click",".pricing",function(e){
        e.preventDefault();
        $("#myModalpricing").modal("toggle");
        $("#guide-name").html("").html($(this).attr("data-guide-name"));
        $("#guide_id").val("").val($(this).attr("data-guide-id"));
        $(".guide-prices-heading").addClass("hide")
        $("#msg, .guide-prices-day, .guide-prices-night").html('');
        let myForm = document.getElementById("add-form-guide");
        var formData = new FormData(myForm);
        var html_day = '';
        var html_night = '';
        $.ajax({
            url: 'admin/guide/get_prices',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
                if(response.details.length > 0){
                    $(".guide-prices-heading").removeClass("hide");
                    $.each(response.details, function(index, item) {                        
                        if(item.shift_type=='day'){
                            html_day += '<input type="hidden" name="hdn_guide_costing_id[]" value="'+item.id+'">';
                            html_day += '<div class="col-lg-4"><label class="">'+item.fixed_prices+'</label></div>';
                            html_day += '<div class="col-lg-4"><label class="">'+item.hourly_prices+'</label></div>';
                            html_day += '<div class="col-lg-4"><label class="">'+item.created+'</label></div>';
                        }else if(item.shift_type=='night'){
                            html_night += '<input type="hidden" name="hdn_guide_costing_id[]" value="'+item.id+'">';
                            html_night += '<div class="col-lg-4"><label class="">'+item.fixed_prices+'</label></div>';
                            html_night += '<div class="col-lg-4"><label class="">'+item.hourly_prices+'</label></div>';
                            html_night += '<div class="col-lg-4"><label class="">'+item.created+'</label></div>';
                        }
                    });
                    $(".guide-prices-day").html('').html(html_day);
                    $(".guide-prices-night").html('').html(html_night);
                }
            },
            error: function() {}
        });
          
    });
    
    $("#btn_prices").on("click", function() {
        let myForm = document.getElementById("add-form-guide");
        var dataForm = new FormData(myForm);
        $("#btn_prices").html('Adding..').attr('disabled', 'disabled');
        $.ajax({
            url: "<?php echo base_url('admin/guide/add_prices'); ?>",
            type: "post",
            data: dataForm,
            dataType: 'JSON',
            contentType: false,
            processData: false,
            beforeSend: function() {},
            success: function(data) {
                $("#msg").html('').html(data.msg);
                $("#btn_prices").html('Submit').removeAttr('disabled', 'disabled');
                if (data.response === "e") {} else if (data.response === "s") {
                    $("#add-form-guide")[0].reset();
                    $("#myModalpricing").fadeOut(2800,function() {
                        $(this).modal('hide');
                    });                    
                }
            }
        });
    });

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
            $('#state').val(ui.item.label); // display the selected text
            $('#state_id').val(ui.item.state_id); // save selected id to input
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
    
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    let selectedGuideId = null;

    // Handle star click
    document.querySelectorAll('.rating-star').forEach(star => {
        star.addEventListener('click', function () {
            const guideId = this.getAttribute('data-guide-id');
            const rating = parseInt(this.getAttribute('data-rating')) || 0;

            document.getElementById('selectedGuideId').value = guideId;
            document.getElementById('guideRatingInput').value = rating > 0 ? rating : '';

            new bootstrap.Modal(document.getElementById('ratingModal')).show();
        });
    });

    // Handle save button
    document.getElementById('saveRatingBtn').addEventListener('click', function () {
        const rating = parseInt(document.getElementById('guideRatingInput').value);
        const guideId = document.getElementById('selectedGuideId').value;

        if (rating >= 1 && rating <= 5) {
            fetch("<?= base_url('admin/guide/update_rating') ?>", {
                method: "POST",
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ guide_id: guideId, rating: rating })
            })
            .then(response => response.json())
            .then(res => {
                if (res.status === 'success') {
                    // Update star icons
                    document.querySelectorAll(`.rating-star[data-guide-id="${guideId}"]`).forEach(star => {
                        const index = parseInt(star.getAttribute('data-index'));
                        star.src = index <= rating
                            ? "<?= base_url('assets/images/yellow.png') ?>"
                            : "<?= base_url('assets/images/blank.png') ?>";
                    });

                    bootstrap.Modal.getInstance(document.getElementById('ratingModal')).hide();
                } else {
                    alert("Failed to update rating.");
                }
            });
        } else {
            alert("Please enter a valid rating (1-5).");
        }
    });
});
</script>
