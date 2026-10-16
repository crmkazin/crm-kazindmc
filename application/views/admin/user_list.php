<?php include('admin_head_css.php'); ?>
<link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet"/>  

<!-- HOD Modal -->
<div class="modal fade" id="hod_details" tabindex="-1" aria-labelledby="hodModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form id="hod_detail">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="hodModalLabel">Create HOD</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body">
            <div class="row">
                <!-- Name Dropdown -->
                <div class="col-3 mb-3">
                    <label for="nameSelect" class="form-label">Name</label>
                    <select class="form-select" id="nameSelect" name="name" required>
                    <option value="">Select user</option>
                    <?php usort($all_user, function($a, $b) {
                        return strcmp(strtolower($a->name), strtolower($b->name));
                    });
                    ?>
                    <?php foreach($all_user as $user){ ?>
                        <option value="<?= $user->id; ?>"><?= $user->name;?></option>
                    <?php } ?>
                    </select>
                </div>

                <!-- Email -->
                <div class="col-3 mb-3">
                    <label for="emailInput" class="form-label">Email</label>
                    <input type="email" class="form-control" id="emailInput" name="email" readonly required>
                </div>

                <!-- Location Dropdown -->
                <div class="col-3 mb-3">
                    <label for="locationSelect" class="form-label">Location</label>
                    <input type="text" class="form-control" id="locationInput" name="location" readonly required>
                </div>

                <div class="col-3 mb-3"> 
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <label class="form-label">Booking Type</label>
                        <select id="bookingType" name="booking_type[]" class="mdl-textfield__input js-example-basic-multiple" multiple style="padding: 10px;">
                         
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          <hr>
            <h5 class="mt-3">HOD List</h5>
            <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>S No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Location</th>
                    <th>Booking Type</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="hodTableBody">
                <tr><td colspan="6" class="text-center">Loading...</td></tr>
                </tbody>
            </table>
            </div>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="page-content-wrapper">
            <div class="page-bar">
                <div class="row page-titles">
                    <div class="col-lg-2 col-sm-6  col-6 align-self-center">
                        <h4 class="text-themecolor">All User</h4>
                    </div>
                    <div class="col-lg-8 only-for-dashbord">
                    </div>
                    <div class="col-lg-2 col-sm-6 col-6 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                <li class="breadcrumb-item active">All User</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-content">			
                <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>						
                    <div class="row">
                    <div class="col-md-12">
                        <div class="card card-box">
                            <form method="get" autocomplete="off" class="content">

                                <div class="card-body" style=" padding:8px 24px 8px 24px;">
                                   <div class="row align-items-end">
                                     <!-- Country Field -->
                                    <div class="col-lg-3">
                                        <div
                                            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width p-0">
                                            <label class="mdl-textfield__label">Assigned Location</label>
                                            <?php echo form_input([
                                                'name' => 'country',
                                                'id' => 'countrys',
                                                'placeholder' => 'Country',
                                                'class' => 'mdl-textfield__input bg-white',
                                                'value' => $this->input->get('country'),
                                                'style'=> "border: 1px solid #9a9a9a;border-radius: 5px;padding: 3px 8px;font-size: 12px;",
                                            ]); ?>

                                        </div>
                                    </div>
                                    <input type="hidden" name="country_id" id="country_id">

                                      <div class="col-lg-3">
                                        <label for="">Status</label>
                                        <div class="myselect">
                                            <select name="status" id="user_status"
                                                class="bg-white user_status select mdl-textfield__input">
                                                <option value="">Select Status</option>
                                                <option value="active" <?= ($this->input->get('status') == 'active') ? 'selected' : '' ?>>Active</option>
                                                <option value="inactive" <?= ($this->input->get('status') == 'inactive') ? 'selected' : '' ?>>Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-lg-6">
                                        <?php echo form_submit([
                                            'name' => 'submit',
                                            'id' => 'submit',
                                            'class' => 'btn btn-md btn-info',
                                            'style' => 'float:left;',
                                            'value' => 'Search'
                                        ]); ?>
                                        <?php //if($this->session->userdata('type') !== '7'){ ?>      
                                        <a href="user" class="btn btn-info add-new-user ms-3" style="padding: 8px;"><i
                                                class="fa fa-plus"></i>New</a>
                                                     <button class="btn btn-info assinged_user ms-3" type="button" data-bs-toggle="modal" data-bs-target="#hod_details" style="padding: 8px;"><i
                                                class="fa fa-plus"></i>Hod</button>
                                                
                                                <?php //} ?>  
                                    </div>
                                   </div>
                                </div>
                            </form>
                           
                            <div class="card-body">
                                <div class="table-responsive m-t-20">
                                    <table id="example4" class="table display table-striped border no-wrap"
                                                style="position:relative; width:100%">
                                                <thead>
                                                    <tr>
                                                        <th class="center">Sr.No</th>
                                                        <th class="center">Name</th>
                                                        <th class="center">Email</th>
                                                        <th class="center">Assigned Location</th>
                                                        <th class="center">Base Location</th>
                                                        <th class="center">Status</th>
                                                        <th class="center">Type</th>
                                                        <?php if($this->session->userdata('type') !== '7'){ ?>      
                                                        <th class="center">Action</th>
                                                        <?php } ?>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                            <?php
                                            $i=1;
                                            $super_admins = ['rohit@kazindmc.com','pankaj@thavertech.com'];
                                            if(!empty($users)) {
                                            foreach($users as $user) {

                                            ?>
                                            <form method="post">
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?=$i++?></td>
                                                            <td class="center" style="color:<?=($user->status == 1) ? '' : '#f81515'?>"><?=$user->name?></td>
                                                            <td class="center"><?=$user->email?></td>
                                                            <td class="center"><?= ucfirst($user->location)?></td>
                                                            <td class="center"><?= ucfirst($user->city).', '.ucfirst($user->state).', '.ucfirst($user->country) ?></td>
                                                            <td class="center">
                                                            <?php if($user->status == 1){ 
                                                                echo '<span class="badge bg-success" style="text-transform:capitalize;">Active</span>';
                                                            }else{ 
                                                                echo '<span class="badge bg-danger" style="text-transform:capitalize;">Inactive</span>';
                                                            }
                                                            ?>
                                                            </td>
                                                            <td class="center">
                                                            <?php 
                                                            $type = ['1'=>'Admin','2'=>'User','3'=>'Accounts','4'=>'International','5'=>'Sales','6'=>'Sales International'];
                                                            //if(in_array($user->email,$super_admins)){ echo "Super Admin"; } elseif($user->type == 1){echo "Admin";}else {echo "User";}
                                                                // echo $type[$user->type].(($user->admin_type=='superadmin')?'<br>(Super Admin)':'');
                                                                echo $type[$user->type];
                                                                if ($user->hod == 'yes') {
                                                                    echo ' <br>(HOD)';
                                                                }

                                                                if ($user->admin_type == 'superadmin') {
                                                                    echo ' <br>(Super Admin)';
                                                                }
                                                            ?>
                                                            </td>
                                                            <?php //if($this->session->userdata('type') !== '7'){ ?>                                                          <td class="center">
                                                                <a href="<?=base_url().$user->id.'/edit-user';?>" class="btn btn-tbl-edit btn-xs" title="Edit"><i class="fa fa-edit"></i></a> 
                                                                <a href="<?=base_url().$user->id.'/delete-user';?>" onclick="return confirm('Are you sure you want to delete this User?');" class="btn btn-tbl-delete btn-xs" title="Delete"><i class="fas fa-trash"></i></a>
                                                            </td>
                                                            <?php //} ?>   
                                                            <td></td>
                                                    </tr>
                                            </form>	
                                            <?php } }?>	
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>				
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function(){
        var country_flag = false;
        $("#countrys").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?= base_url('admin/masters/get_country_ajax') ?>",
                    type: 'post',
                    dataType: "json",
                    data: { search: request.term },
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

<script>
   document.getElementById('nameSelect').addEventListener('change', function () {
    const name = this.value;
    if (!name) return;

    fetch("<?= base_url('admin/user/getUserDetailsByName') ?>", {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `name=${encodeURIComponent(name)}`
    })
    .then(res => res.json())
    .then(data => {
        if (data.status) {
            document.getElementById('emailInput').value = data.email;
            document.getElementById('locationInput').value = data.locations;

            const bookingTypeSelect = document.getElementById('bookingType');
            bookingTypeSelect.innerHTML = '';

            data.booking_types.forEach(type => {
                const option = document.createElement('option');
                option.value = type;
                option.textContent = type;
                bookingTypeSelect.appendChild(option);
            });
        } else {
            alert(data.message || "Failed to fetch user info.");
        }
    })
    .catch(err => {
        console.error("Error:", err);
        alert("Something went wrong.");
    });
});

$('#hod_detail').on('submit', function (e) {
    e.preventDefault();

    const bookingTypes = $('#bookingType').val();

    if (!bookingTypes || bookingTypes.length === 0) {
        alert("Please select at least one booking type.");
        return;
    }

    // Check if any selected booking type already assigned
    $.ajax({
        url: "<?= base_url('admin/user/check_booking_type_availability') ?>",
        method: "POST",
        data: { booking_types: bookingTypes },
        dataType: "json",
        success: function (response) {
            if (!response.status) {
                alert(response.message);
                return;
            }

            // If validation passed, submit form
            $.ajax({
                url: "<?= base_url('admin/user/save_hod_details') ?>",
                method: "POST",
                data: $('#hod_detail').serialize(),
                dataType: "json",
                success: function (response) {
                    if (response.status === 'success') {
                        alert("HOD details saved successfully!");
                        // $('#hod_details').modal('hide');
                        $('#hod_detail')[0].reset();
                        loadHodTable(); // reload the table after saving
                    } else {
                        alert("Error: " + response.message);
                    }
                },
                error: function () {
                    alert("Something went wrong.");
                }
            });
        },
        error: function () {
            alert("Validation request failed.");
        }
    });
});

function loadHodTable() {
    $.ajax({
        url: "<?= base_url('admin/user/get_all_hod_details') ?>",
        method: "GET",
        dataType: "json",
        success: function (data) {
            let html = '';
            if (data.length > 0) {
                data.forEach((item, index) => {
                    html += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.name}</td>
                            <td>${item.email}</td>
                            <td>${item.location}</td>
                            <td>${item.booking_type}</td>
                            <td><button class="btn btn-danger btn-sm delete-hod" data-id="${item.id}">Delete</button></td>
                        </tr>`;
                });
            } else {
                html = `<tr><td colspan="6" class="text-center">No HOD found</td></tr>`;
            }
            $('#hodTableBody').html(html);
        }
    });
}

// $(document).on('click', '.delete-btn', function () {
//     var id = $(this).data('id');
//     var baseUrl = '<?php //echo base_url('admin/user/delete_hod/') ?>'; // PHP part ends here

//     if (confirm("Are you sure you want to delete this HOD?")) {
//         $.ajax({
//             url: baseUrl + id, // JS appends the ID
//             type: 'POST',
//             dataType: 'json',
//             success: function (response) {
//                 if (response.status === 'success') {
//                     alert(response.message);
//                     location.reload(); // Or you can remove the row without reload
//                 } else {
//                     alert(response.message);
//                 }
//             },
//             error: function () {
//                 alert("Request failed. Please try again.");
//             }
//         });
//     }
// });

   $(document).on('click', '.delete-hod', function () {
        let entryId = $(this).data('id');

        if (confirm("Are you sure you want to delete this entry?")) {
            $.ajax({
                url: '<?= base_url("admin/user/delete_hod") ?>',
                method: 'POST',
                data: { id: entryId },
                dataType: 'json',
                success: function (res) {
                    if (res.status) {
                        alert('Hod Deleted');
                        loadHodTable();
                    } else {
                        alert("Failed to delete entry.");
                    }
                }
            });
        }
    });



$('#hod_details').on('shown.bs.modal', function () {
    loadHodTable();
});

</script>