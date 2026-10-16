<?php include('admin_head_css.php');?>
<style>
    .p{margin:0px;padding:0px;}
</style>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-5 align-self-center">
                <h4 class="text-themecolor">Edit Meal Master</h4>
            </div>
            <div class="col-md-7 col-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('meal-master-list');?>">Meal Master List</a></li>
                        <li class="breadcrumb-item active">Edit Meal Master</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- Start Page Content -->
        <div class="page-content-wrapper">
            <?php echo $this->session->flashdata('message'); unset($_SESSION['message']); ?>						
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="card-body row">
                                <form method="post" action="<?= base_url('meal-master-update'); ?>">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Country</label>
                                            <select name="location" class="form-control" required>
                                                <?php foreach ($locations as $loc): ?>
                                                <option value="<?= $loc['id']; ?>"
                                                    <?= ($meals[0]['country'] == $loc['id']) ? 'selected' : '' ?>>
                                                    <?= $loc['name']; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Cuisine Type</label>
                                            <select name="cuisine_type" class="form-control" required>
                                                <option value="local" <?= ($meals[0]['ctype']=='local')?'selected':'' ?>>Local</option>
                                                <option value="indian" <?= ($meals[0]['ctype']=='indian')?'selected':'' ?>>Indian</option>
                                                <option value="international" <?= ($meals[0]['ctype']=='international')?'selected':'' ?>>International</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div id="buffet-wrapper">
                                        <?php $i = 0; ?>
                                        <?php foreach ($meals as $meal): 
                                            $i++;
                                            ?>
                                        <div class="buffet-block mt-3">
                                            <div class="row buffet-row" id="row-<?= $meal['id']; ?>">
                                                <input type="hidden" name="meal_id[]" value="<?= $meal['id']; ?>">
                                                <div class="col-md-2">
                                                    <label>Buffet Name</label>
                                                    <input type="text" name="buffet[]" 
                                                        value="<?= $meal['Buffet']; ?>" 
                                                        class="form-control buffet-input">
                                                </div>

                                                <div class="col-md-2">
                                                    <label>Adult Price</label>
                                                    <input type="number" name="price[]" 
                                                        value="<?= $meal['price']; ?>" 
                                                        class="form-control">
                                                </div>

                                                <!--  CHILD AGE TYPE -->
                                                <div class="col-md-2">
                                                    <label>Child Ticket Type</label><br>

                                                    <label>
                                                        <input type="radio" name="child_age_type[<?= $i ?>]" value="yes" class="child-age-radio"  <?= ($meal['child_with_age'] == 'yes') ? 'checked' : '' ?>>
                                                        With Age
                                                    </label>

                                                    <label style="margin-left:10px;">
                                                        <input type="radio" name="child_age_type[<?= $i ?>]" value="no" class="child-age-radio"  <?= ($meal['child_with_age'] == 'no') ? 'checked' : '' ?>>
                                                        Without Age
                                                    </label>
                                                </div>

                                                <!-- ADD AGE BUTTON -->
                                                <div class="col-md-2 second-age-btn mt-4" style="display:<?= ($meal['child_with_age'] == 'yes') ? 'block' : 'none' ?>;">
                                                    <button type="button" class="btn btn-primary add-age-btn">
                                                        Add Age Price
                                                    </button>
                                                </div>

                                                <!-- CHILD PRICE -->
                                                <div class="col-md-2 child-price-input" style="display:<?= ($meal['child_with_age'] == 'yes') ? 'none' : 'block' ?>;">
                                                    <label>Child Price</label>
                                                    <input type="number" name="childprice[]" class="form-control" value="<?= $meal['child_price']; ?>">
                                                </div>                                             

                                                <div class="col-md-3">
                                                    <label>Remarks</label>
                                                    <input type="text" name="remarks[]" 
                                                        value="<?= $meal['remarks']; ?>" 
                                                        class="form-control">
                                                </div>

                                                <div class="col-md-1 text-end mt-4">
                                                    <button type="button"
                                                        class="btn btn-danger remove-existing"
                                                        data-id="<?= $meal['id']; ?>">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- ENTERTAINMENT AREA -->
                                            <div class="entertainment-area">
                                                <?php
                                                $normalized = strtolower(trim($meal['Buffet']));
                                                if($normalized === 'gala dinner'):
                                                    $existingTypes = [];
                                                    if(!empty($meal['entertainment'])):
                                                        foreach($meal['entertainment'] as $ent):
                                                            $existingTypes[] = strtolower(trim($ent['entertainment_name']));
                                                    ?>
                                                    <div class="row mt-2 entertainment-row">

                                                        <input type="hidden" name="ent_id[<?= $meal['id'] ?>][]" value="<?= $ent['id']; ?>">

                                                        <div class="col-md-4">
                                                            <input type="text"
                                                                name="ent_name[<?= $meal['id'] ?>][]"
                                                                value="<?= $ent['entertainment_name']; ?>"
                                                                class="form-control"
                                                                readonly>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input type="text"
                                                                name="ent_price[<?= $meal['id'] ?>][]"
                                                                value="<?= $ent['price']; ?>"
                                                                class="form-control">
                                                        </div>

                                                        <div class="col-md-2">
                                                            <button type="button"
                                                                class="btn btn-danger remove-entertainment">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </div>

                                                    </div>
                                                    <?php
                                                        endforeach;
                                                    endif;
                                                    ?>

                                                    <!-- BUTTON AREA -->
                                                    <div class="text-end mt-2 entertainment-buttons">

                                                        <?php if(!in_array('belly dance', $existingTypes)): ?>

                                                            <button type="button"
                                                                class="btn btn-success add-entertainment"
                                                                data-type="Belly Dance">

                                                                <i class="fa fa-plus"></i> Belly Dance
                                                            </button>

                                                        <?php endif; ?>

                                                        <?php if(!in_array('dj', $existingTypes)): ?>

                                                            <button type="button"
                                                                class="btn btn-primary add-entertainment"
                                                                data-type="DJ">

                                                                <i class="fa fa-plus"></i> DJ
                                                            </button>

                                                        <?php endif; ?>

                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                        </div>

                                    <div class="text-end mt-3">
                                        <button type="button" class="btn btn-success add-row">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-lg-12 p-t-20 text-center">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page content -->
    </div>
</div>

<!-- child age price modal -->
<div class="modal fade" id="agePriceModal">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 id="modalTitle">Child Age Pricing</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div id="ageMsg" style="display:none;"></div>
            <input type="hidden" id="current_meal_id">
            <input type="hidden" id="age_price_id">
            <div class="row">
               <div class="col-md-3">
                  <input type="number" id="from_age" class="form-control" placeholder="From Age">
               </div>
               <div class="col-md-3">
                  <input type="number" id="to_age" class="form-control" placeholder="To Age">
               </div>
               <div class="col-md-3">
                  <input type="number" id="age_price" class="form-control" placeholder="Price">
               </div>
               <div class="col-md-3">
                   <button class="btn btn-success" id="saveAgePrice">Save</button>
               </div>
            </div>
            <hr>
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th>From</th>
                     <th>To</th>
                     <th>Price</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody id="agePriceList"></tbody>
            </table>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<script>
    $('#agePriceModal .close, #agePriceModal .btn-danger').on('click', function() {
        $('#agePriceModal').modal('hide');
    });
    document.addEventListener('click', function(e){

        if(e.target.closest('.add-row')){
            let index = Date.now();
            let index_new = document.querySelectorAll('.buffet-block').length;

            document.getElementById('buffet-wrapper').insertAdjacentHTML('beforeend',`
            <div class="buffet-block mt-3" data-id="${index_new + 1}">

                <div class="row buffet-row">

                    <input type="hidden" name="meal_id[]" value="">

                    <div class="col-md-2">
                        <label>Buffet Name</label>
                        <input type="text" name="buffet[]" class="form-control buffet-input" placeholder="Buffet Name">
                    </div>

                    <div class="col-md-2">
                        <label>Adult Price</label>
                        <input type="number" name="price[]" class="form-control" placeholder="Adult Price">
                    </div>

                    <!-- ✅ CHILD AGE TYPE -->
                    <div class="col-md-2">
                        <label>Child Ticket Type</label><br>

                        <label>
                            <input type="radio" name="child_age_type[${index_new + 1}]" value="yes" class="child-age-radio">
                            With Age
                        </label>

                        <label style="margin-left:10px;">
                            <input type="radio" name="child_age_type[${index_new + 1}]" value="no" class="child-age-radio" checked>
                            Without Age
                        </label>
                    </div>

                    <!-- ✅ CHILD PRICE -->
                    <div class="col-md-2 child-price-input">
                        <label>Child Price</label>
                        <input type="number" name="childprice[]" class="form-control" placeholder="Child Price">
                    </div>

                    <div class="col-md-3">
                        <label>Remarks</label>
                        <input type="text" name="remarks[]" class="form-control">
                    </div>

                    <div class="col-md-1 text-end mt-4">
                        <button type="button" class="btn btn-danger remove-row">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>

                </div>

                <div class="entertainment-area"></div>

            </div>`);
        }

        // REMOVE NEW ROW (not saved yet)
        if(e.target.closest('.remove-row')){
            e.target.closest('.buffet-row').remove();
        }

        // SOFT DELETE EXISTING ROW
        if(e.target.closest('.remove-existing')){
            let id = e.target.closest('.remove-existing').dataset.id;

            if(confirm('Are you sure to Delete this buffet?')){
                fetch("<?= base_url('meal-master-delete-row'); ?>",{
                    method:'POST',
                    headers:{'Content-Type':'application/x-www-form-urlencoded'},
                    body:'id='+id
                })
                .then(res=>res.json())
                .then(resp=>{
                    if(resp.status==='success'){
                        document.getElementById('row-'+id).remove();
                    }
                });
            }
        }
    });
</script>

<script>
    document.addEventListener('input', function(e){

        if(!e.target.classList.contains('buffet-input')) return;

        let value = e.target.value.trim().toLowerCase();
        let block = e.target.closest('.buffet-block');
        let area  = block.querySelector('.entertainment-area');

        // If Gala Dinner
        if(value === 'gala dinner'){

            // If already has belly row → do nothing
            if(block.querySelector('.belly-row')) return;

            // If plus already exists → do nothing
            if(block.querySelector('.add-belly-wrapper')) return;

            // Add plus button
            area.innerHTML = `
            <div class="text-end mt-2 add-belly-wrapper">
                <button type="button" class="btn btn-success add-belly">
                    <i class="fa fa-plus"></i> Add Belly Dance
                </button>
            </div>`;
        } 
        else {
            // If not Gala → remove everything
            area.innerHTML = '';
        }

    });
</script>

<script>
    // BUFFET INPUT
    document.addEventListener('input', function(e){

        if(!e.target.classList.contains('buffet-input')) return;

        let value = e.target.value.trim().toLowerCase();

        let block = e.target.closest('.buffet-block');

        let area = block.querySelector('.entertainment-area');

        if(value === 'gala dinner'){

            if(area.innerHTML.trim() === ''){

                area.innerHTML = `
                    <div class="text-end mt-2 entertainment-buttons">

                        <button type="button"
                            class="btn btn-success add-entertainment"
                            data-type="Belly Dance">

                            <i class="fa fa-plus"></i> Belly Dance
                        </button>

                        <button type="button"
                            class="btn btn-primary add-entertainment"
                            data-type="DJ">

                            <i class="fa fa-plus"></i> DJ
                        </button>

                    </div>
                `;
            }

        } else {

            area.innerHTML = '';
        }

    });


    // ADD ENTERTAINMENT
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.add-entertainment')) return;

        let btn = e.target.closest('.add-entertainment');
        let type = btn.dataset.type;
        let area = btn.closest('.entertainment-area');
        let block = area.closest('.buffet-block');
        
        // Get meal ID – from hidden input or empty string for new rows
        let mealIdInput = block.querySelector('input[name="meal_id[]"]');
        let mealId = mealIdInput ? mealIdInput.value : '';
        
        let html = `
            <div class="row mt-2 entertainment-row">
                <input type="hidden" name="ent_id[${mealId}][]" value="">
                <div class="col-md-4">
                    <input type="text" name="ent_name[${mealId}][]" value="${type}" class="form-control" readonly>
                </div>
                <div class="col-md-4">
                    <input type="text" name="ent_price[${mealId}][]" class="form-control" placeholder="Enter ${type} Price">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger remove-entertainment">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
        `;
        area.insertAdjacentHTML('beforeend', html);
        btn.remove();
    });


    // REMOVE ENTERTAINMENT
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.remove-entertainment')) return;

        let row = e.target.closest('.entertainment-row');
        let area = row.closest('.entertainment-area');
        let type = row.querySelector('input[name*="ent_name"]').value;  // matches dynamic name

        row.remove();

        let btnClass = type === 'DJ' ? 'btn-primary' : 'btn-success';
        let html = `
            <button type="button"
                class="btn ${btnClass} add-entertainment"
                data-type="${type}">
                <i class="fa fa-plus"></i> ${type}
            </button>
        `;
        area.querySelector('.entertainment-buttons').insertAdjacentHTML('beforeend', html);
    });
</script>

<!-- popup with age without age code start from here -->
<script>
    $(document).ready(function () {
        $(document).on('change', '.child-age-radio', function () {
            let row = $(this).closest('.buffet-row');
            let val = $(this).val();

            if (val === 'yes') {
                row.find('.second-age-btn').show();
                row.find('.child-price-input').hide();
            } else {
                row.find('.second-age-btn').hide();
                row.find('.child-price-input').show();
            }
        });

        function showMessage(msg, type="success"){
            $("#ageMsg")
                .removeClass()
                .addClass("alert alert-" + type)
                .html(msg)
                .fadeIn();

            setTimeout(function(){
                $("#ageMsg").fadeOut();
            }, 3000);
        }

        $(document).on("click",".add-age-btn",function(){
            // get meal id dynamically from row
            let mealId = $(this).closest('.buffet-row').find('input[name="meal_id[]"]').val();

            // store globally
            $("#current_meal_id").val(mealId);

            // load data
            loadAgePriceList(mealId);

            // open modal
            $('#agePriceModal').modal('show');
        });

        $("#saveAgePrice").click(function(){
            var id = $("#age_price_id").val();
            var url = "<?= base_url('admin/enquiry/save_child_age_price')?>";
            if(id != ""){
                url = "<?= base_url('admin/enquiry/update_child_age_price')?>";
            }
            $.ajax({
                url:url,
                type:"POST",
                data:{
                       id: id,
                        meal_id: $("#current_meal_id").val(),
                        from_age: $("#from_age").val(),
                        to_age: $("#to_age").val(),
                        price: $("#age_price").val()
                },
                success:function(res){
                    let response = JSON.parse(res);

                    if(response.status == false){
                        showMessage(response.msg, "danger");
                        return;
                    }
                    let message = ($("#age_price_id").val() != "") 
                    ? "Data updated successfully" 
                    : "Data added successfully";
                    showMessage(message);
                    $("#saveAgePrice").text("Save");
                    $("#age_price_id").val("");
                    $("#from_age").val("");
                    $("#to_age").val("");
                    $("#age_price").val("");
                    loadAgePriceList();
                }
            });
        });

        function loadAgePriceList(mealId) {
            $.ajax({
                url: "<?= base_url('admin/enquiry/get_child_age_price')?>",
                type: "POST",
                data: {
                    meal_id: $("#current_meal_id").val(),
                },
                success: function(res) {
                    $("#agePriceList").html(res);
                }
            });
        }

        $(document).on("click", ".deleteAge", function() {
            var id = $(this).data("id");
            $.post("admin/enquiry/delete_child_age_price", {
                id: id
            }, function() {
                showMessage("Data deleted successfully", "danger");
                loadAgePriceList();
            });
        });

        $(document).on("click",".editAge",function(){
            var id = $(this).data("id");
            $.ajax({
                url: "<?= base_url('admin/enquiry/get_single_age_price')?>",
                type: "POST",
                data: {id:id},
                success: function(res){

                    var data = JSON.parse(res);

                    $("#age_price_id").val(data.id);
                    $("#from_age").val(data.age_from);
                    $("#to_age").val(data.age_to);
                    $("#age_price").val(data.price);

                    $("#saveAgePrice").text("Update");

                }
            });
        });
    });
</script>