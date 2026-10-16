
<style>
  #flightModal{

  }

    #flightModal .modal-header{
      background-color:#dc3545;
    }

    #flightModal .table thead th{
      color:#fff;
    }
    #flightModal .table{
      border-color:#000;
    }

</style>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="page-content-wrapper">
            <div class="page-content" id="page-content" style="margin-top:-50px; ">
                <div class="page-bar">
                <div class="row page-titles">
                    <div class="col-lg-3 col-sm-6  col-6 align-self-center">
                        <h4 class="text-themecolor">Live Tracking Files</h4>
                    </div>
                    <div class="col-lg-4 only-for-dashbord">
                    </div>
                    <div class="col-lg-5 col-sm-6 col-6 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo base_url('live-tracking'); ?>">Live Tracking</a></li>
                                <li class="breadcrumb-item active">Live Tracking Files</li>
                            </ol>
                        </div>
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-box">
                            <div class="card-body">
                                <div class="table-scrollable">
                                    <table
                                        class="table table-hover table-checkable order-column full-width"
                                        id="example4">
                                        <!-- Table header -->
                                        <thead>
                                            <tr>
                                                <th class="center">Sr.No</th>
                                                <th class="center">File No.</th>
                                                <th class="center">Company Name</th>
                                                <th class="center">Check In Date</th>
                                                <th class="center">Check Out Date</th>
                                                <!-- <th class="center">Company Name</th> -->
                                                <!-- <th class="center">Check In / Check Out</th> -->
                                                <!-- <th class="center">Physical Arrival</th> -->
                                                <th class="center">No. Of Passengers</th>
                                                <!-- <th class="center">Hotel</th> -->
                                                <!-- <th class="center">Guide/Driver</th> -->
                                                <th class="center remove">Action</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

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

<!-- Modal -->
<div class="modal fade" id="flightModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#dc3545;">
        <h5 class="modal-title" style="color:#fff;" id="flightModalLabel">Activity Details:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- <h5>Activity Details:</h5> -->
        <div class="text-start my-2 justify-content-between d-flex">
          <button id="itinerary-prev" class="btdn btn-info btn-xs p-3">Previous</button>
          <!-- <span id="current-itinerary-date" class="mx-2 font-weight-bold"></span> -->
          <button id="itinerary-next" class="btn btn-info btn-xs p-3">Next</button>
        </div>
        <!-- <div class="text-end my-2">
        </div> -->

        <table class="table table-bordered">
          <thead style="background-color:darkblue;">
              <tr>
                  <th>#</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Title</th>
                  <th>Remark</th>
                  <th>Restaurant Name</th>
              </tr>
          </thead>
          <tbody id="itinerary-details-body">
          </tbody>
      </table>

        <div class="p-2 mb-2" style="background-color:#dc3545;">
          <h5 style="color:#fff;">Driver Details:</h5>
        </div>

        <table class="table table-bordered">
          <thead style="background-color:darkblue;">
            <tr>
              <th>#</th>
              <th>Driver Name</th>
              <th>Driver Contact Number</th>
            </tr>
          </thead>
          <tbody id="driver-details-body">
            <!-- Dynamic rows go here -->
          </tbody>
        </table>

        <div class="p-2 mb-2" style="background-color:#dc3545;">
          <h5 style="color:#fff;">Guide Details:</h5>
        </div>

        <table class="table table-bordered">
          <thead style="background-color:darkblue;">
            <tr>
              <th>#</th>
              <th>Guide Name</th>
              <th>Guide Contact Number</th>
            </tr>
          </thead>
          <tbody id="guide-details-body">
            <!-- Dynamic rows go here -->
          </tbody>
        </table>
        <div class="p-2 mb-2" style="background-color:#dc3545;">
          <h5 style="color:#fff;">Transportation Details:</h5>
        </div>
        <table class="table table-bordered">
          <thead style="background-color:darkblue">
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Vehicle Type</th>
              <th>Capacity</th>
              <th>Luggage</th>
              <th>Remarks</th>
            </tr>
          </thead>
          <tbody id="transport-details-body">
            <!-- Dynamic rows go here -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

   