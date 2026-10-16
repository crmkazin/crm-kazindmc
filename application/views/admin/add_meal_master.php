<?php include('admin_head_css.php');?>
<style>
    .p{margin:0px;padding:0px;}
</style>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-5 align-self-center">
                <h4 class="text-themecolor">Add Meal Master</h4>
            </div>
            <div class="col-md-7 col-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('meal-master-list');?>">Meal Master List</a></li>
                        <li class="breadcrumb-item active">Add Meal Master</li>
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
                                <form method="post" action="<?= base_url('admin/enquiry/save_meal_master'); ?>">
                                    <!-- Row 1 -->
                                    <div class="row">
                                        <!-- Location Dropdown -->
                                        <div class="col-md-6">
                                            <label>Country</label>
                                            <select name="location" class="form-control" required>
                                                <option value="">Select Location</option>
                                                <?php foreach ($locations as $location): ?>
                                                    <option value="<?= $location['id']; ?>">
                                                        <?= $location['name']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- Cuisine Type -->
                                        <div class="col-md-6">
                                            <label>Cuisine Type</label>
                                            <select name="cuisine_type" class="form-control" required>
                                                <option value="">Select Cuisine</option>
                                                <option value="local">Local</option>
                                                <option value="indian">Indian</option>
                                                <option value="international">International</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Buffet Section -->
                                    <div id="buffet-wrapper">
                                        <div class="row buffet-block mb-4 p-3">
                                            <!-- Hidden meal_id (empty for new) -->
                                            <input type="hidden" name="meal_id[]" value="">

                                            <div class="row buffet-row">
                                                <div class="col-md-2">
                                                    <label>Buffet Name</label>
                                                    <input type="text" name="buffet[]" class="form-control buffet-input" placeholder="Buffet Name" required>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Adult Price</label>
                                                    <input type="number" name="price[]" class="form-control" placeholder="Adult Price" required>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Child Ticket Type</label><br>
                                                    <label><input type="radio" name="child_age_type[1]" value="yes" class="child-age-radio"> With Age</label>
                                                    <label><input type="radio" name="child_age_type[1]" value="no" class="child-age-radio" checked> Without Age</label>
                                                </div>
                                                <div class="col-md-2 child-price-input">
                                                    <label>Child Price</label>
                                                    <input type="number" name="childprice[]" class="form-control" placeholder="Child Price">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Remarks</label>
                                                    <input type="text" name="remarks[]" class="form-control" placeholder="Remarks" required>
                                                </div>
                                                <div class="col-md-1 text-end mt-4">
                                                    <button type="button" class="btn btn-success add-row"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>

                                            <!-- Entertainment area (initially empty) -->
                                            <div class="entertainment-area mt-3"></div>
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <div class="row mt-4">
                                        <div class="col-lg-12 p-t-20 text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
<script>
    document.addEventListener('click', function (e) {
        // ADD ROW
        if (e.target.closest('.add-row')) {
            let wrapper = document.getElementById('buffet-wrapper');
            let index_new = document.querySelectorAll('.buffet-row').length;

            let html = `
            <div class="row buffet-row mt-3">
                <div class="col-md-2">
                    <label>Buffet Name</label>
                    <input type="text" name="buffet[]" class="form-control" placeholder="Buffet Name" required>
                </div>

                <div class="col-md-2">
                    <label>Adult Price</label>
                    <input type="number" name="price[]" class="form-control" placeholder="Adult Price" required>
                </div>

                <!-- CHILD AGE TYPE -->
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

                <!-- CHILD PRICE -->
                <div class="col-md-2 child-price-input">
                    <label>Child Price</label>
                    <input type="number" name="childprice[]" class="form-control" placeholder="Child Price">
                </div>

                <div class="col-md-3">
                    <label>Remarks</label>
                    <input type="text" name="remarks[]" class="form-control" placeholder="Remarks" required>
                </div>

                <div class="col-md-1 text-end mt-4">
                    <button type="button" class="btn btn-danger remove-row">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            `;

            wrapper.insertAdjacentHTML('beforeend', html);
        }

        // REMOVE ROW
        if (e.target.closest('.remove-row')) {
            e.target.closest('.buffet-row').remove();
        }
    });

    $(document).ready(function () {
        $(document).on('change', '.child-age-radio', function () {
            let row = $(this).closest('.buffet-row');
            let val = $(this).val();

            if (val === 'yes') {
                row.find('.second-age-btn').show();   // show button
                row.find('.child-price-input').hide(); // hide price input
            } else {
                row.find('.second-age-btn').hide();   // hide button
                row.find('.child-price-input').show(); // show price input
            }
        });
    });
</script>

<script>
    // document.addEventListener('input', function (e) {

    //     if (e.target.name === 'buffet[]') {

    //         let value = e.target.value.toLowerCase().replace(/_/g, ' ').trim();

    //         if (value === 'gala dinner') {

    //             let currentRow = e.target.closest('.buffet-row');

    //             // Prevent duplicate append
    //             if (!currentRow.querySelector('.belly-dance-section')) {

    //                 let bellyHtml = `
    //                 <div class="col-md-12 mt-3 belly-dance-section">
    //                     <div class="row align-items-end">
    //                         <div class="col-md-4">
    //                             <label>Entertainment</label>
    //                             <input type="text" name="buffet[]" 
    //                                 class="form-control" 
    //                                 value="Belly Dance" readonly>
    //                         </div>

    //                         <div class="col-md-4">
    //                             <label>Price</label>
    //                             <input type="number" name="price[]" 
    //                                 class="form-control" 
    //                                 placeholder="Price" required>
    //                         </div>
    //                     </div>
    //                 </div>
    //                 `;

    //                 currentRow.insertAdjacentHTML('beforeend', bellyHtml);
    //             }
    //         }
    //     }
    // });

    // Helper: get the index of the buffet block (for temporary naming)
    function getBlockIndex(block) {
        let blocks = document.querySelectorAll('.buffet-block');
        for (let i = 0; i < blocks.length; i++) {
            if (blocks[i] === block) return i;
        }
        return 0;
    }

    // Show entertainment buttons when buffet input = "gala dinner"
    document.addEventListener('input', function(e) {
        if (!e.target.classList.contains('buffet-input')) return;
        let value = e.target.value.trim().toLowerCase();
        let block = e.target.closest('.buffet-block');
        let area = block.querySelector('.entertainment-area');

        if (value === 'gala dinner') {
            if (area.innerHTML.trim() === '') {
                area.innerHTML = `
                    <div class="text-end mt-2 entertainment-buttons">
                        <button type="button" class="btn btn-success add-entertainment" data-type="Belly Dance">
                            <i class="fa fa-plus"></i> Belly Dance
                        </button>
                        <button type="button" class="btn btn-primary add-entertainment" data-type="DJ">
                            <i class="fa fa-plus"></i> DJ
                        </button>
                    </div>
                `;
            }
        } else {
            area.innerHTML = '';
        }
    });

    // Add entertainment row (using temporary index)
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.add-entertainment')) return;
        let btn = e.target.closest('.add-entertainment');
        let type = btn.dataset.type;
        let area = btn.closest('.entertainment-area');
        let block = area.closest('.buffet-block');
        let blockIdx = getBlockIndex(block);

        let html = `
            <div class="row mt-2 entertainment-row">
                <input type="hidden" name="ent_id[${blockIdx}][]" value="">
                <div class="col-md-4">
                    <input type="text" name="ent_name[${blockIdx}][]" value="${type}" class="form-control" readonly>
                </div>
                <div class="col-md-4">
                    <input type="number" name="ent_price[${blockIdx}][]" class="form-control" placeholder="Enter ${type} Price">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger remove-entertainment"><i class="fa fa-times"></i></button>
                </div>
            </div>
        `;
        area.insertAdjacentHTML('beforeend', html);
        btn.remove();
    });

    // Remove entertainment row and restore button
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.remove-entertainment')) return;
        let row = e.target.closest('.entertainment-row');
        let area = row.closest('.entertainment-area');
        let type = row.querySelector('input[name*="ent_name"]').value;
        row.remove();

        let btnClass = type === 'DJ' ? 'btn-primary' : 'btn-success';
        let html = `<button type="button" class="btn ${btnClass} add-entertainment" data-type="${type}">
                        <i class="fa fa-plus"></i> ${type}
                    </button>`;
        area.querySelector('.entertainment-buttons').insertAdjacentHTML('beforeend', html);
    });
</script>