<style>
    .card{
        background-color: transparent  !important;
    }
    .page-content  {
        background-image: url('assets/admin/images/map.png'); 
        background-repeat: round;
    }
    
    .page-container-bg-solid .page-bar, .page-content-white .page-bar{
        background-color: transparent !important; 
    }

    #count-details .card {
        width: 22% !important;
        background-color:#fff !important;
        min-width: 150px !important;
    }

    #count-details .card p {
        margin: 20px !important;
        text-align: center;
    }

    #count-details .custom-link {
        margin-left: 0 !important;
    }

    .dtp {
        display: none !important;
    }

    #count-details {
        padding-bottom: 170px;
    }


    .live-tracking-date {
        width: 100%;
        /* background-color: #fff; */
        padding: 10px;
        border-radius: 4px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .live-tracking-date input {
        border: solid 1px #ccc;
        padding: 10px;
        min-width: 200px;
    }

    @media screen and (max-width:1399px) {
        #count-details span {
            font-size: 20px !important;
        }

        #count-details .card {
            width: 20% !important;
        }

        .custom-link {
            font-size: 22px;
        }
    }
    #count-details .card{
        background-color:#fff;
    }
</style>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="page-content" id="page-content" >
            <div class="page-bar">
                <div class="row page-titles">
                    <div class="col-lg-2 col-sm-6  col-6 align-self-center">
                        <h4 class="text-themecolor">Live Trackings</h4>
                    </div>
                    <div class="col-lg-8 only-for-dashbord">
                    </div>
                    <div class="col-lg-2 col-sm-6 col-6 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                <li class="breadcrumb-item active">Live Tracking</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-box">
                        <div class="card-body">
                            <form method="get" autocomplete="off">
                                <div class="card-body row">
                                    <div class="col-lg-4 p-t-20"></div>
                                    <div class="col-lg-3 p-t-20">
                                        <!-- <div
                                            class="live-tracking-date mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width"> -->
                                                <?php
                                                // $today = date('Y-m-d');
                                                // echo form_input(['name' => 'date', 'type' => 'date', 'id' => 'date', 'class' => 'mdl-textfield__input', 'value' => $today]);
                                                ?>
                                                <!-- <input type="text" name=""
													class="mdl-textfield__input dt-search-show" style="width:90%;" -->
													<!-- value="<?php //echo ($this->input->get('date') <> '') ? date('d-M-Y', strtotime($this->input->get('date'))) : ''; ?>" -->
													<!-- readonly> -->
												<?php //echo form_input(['type' => 'date', 'name' => 'date', 'placeholder' => '', 'id' => 'date_from', 'class' => 'mdl-textfield__input', 'value' => ($this->input->get('date') <> '') ? $this->input->get('date') : '', 'style' => 'width:20px;float:right;']) ?>
                                            <!-- <label class="mdl-textfield__label" for="date" style="color:black !important; margin-left:15px;"></label> -->
                                        <!-- </div> -->
                                        <div class="live-tracking-date mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="position: relative; width: 250px;">
                                            <input type="text" 
                                                id="display_date" 
                                                class="mdl-textfield__input dt-search-show" 
                                                style="width: 100%; pointer-events: none; background-color: #fff;"
                                                readonly>

                                            <i class="fa fa-calendar" style="position: absolute; top: 50%; right: 18px; transform: translateY(-50%); pointer-events: none; color: gray;"></i>

                                            <input type="date" 
                                                name="date" 
                                                id="date" 
                                                class="mdl-textfield__input" 
                                                style="position: absolute; top: 0; left: 0; opacity: 0; width: 100%; height: 100%; cursor: pointer;">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body row" id="count-details" style="justify-content: center; margin-top:50px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
   $(document).ready(function() {
        // Set today's date as default
        var today = new Date();
        var yyyy = today.getFullYear();
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var dd = String(today.getDate()).padStart(2, '0');

        var todayDate = yyyy + '-' + mm + '-' + dd; 
        $('#date').val(todayDate);

        // Show formatted date in text field (d-M-Y format)
        var formattedDate = dd + '-' + today.toLocaleString('default', { month: 'short' }) + '-' + yyyy;
        $('#display_date').val(formattedDate);

        // When user picks a different date
        $('#date').change(function() {
            var selectedDate = $(this).val();
            if (selectedDate) {
                var dateObj = new Date(selectedDate);
                var newFormatted = ('0' + dateObj.getDate()).slice(-2) + '-' +
                                   dateObj.toLocaleString('default', { month: 'short' }) + '-' +
                                   dateObj.getFullYear();
                $('#display_date').val(newFormatted);
            }
        });
    });
</script>