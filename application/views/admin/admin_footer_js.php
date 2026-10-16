<!-- <script src="<?=base_url();?>assets/admin/plugins/popper/popper.min.js" ></script>
<script src="<?=base_url();?>assets/admin/plugins/jquery-blockui/jquery.blockui.min.js" ></script>
<script src="<?=base_url();?>assets/admin/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script> -->

<script src="<?=base_url();?>assets/admin/plugins/bootstrap/js/bootstrap.min.js" ></script>

<script src="<?=base_url();?>assets/admin/js/app.js" ></script>
<script src="<?=base_url();?>assets/admin/js/layout.js" ></script>
<script src="<?=base_url();?>assets/admin/js/theme-color.js" ></script>
<!-- <script src="<?=base_url();?>assets/admin/js/pages/table/table_data.js" ></script> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script src="<?=base_url();?>assets/admin/plugins/material/material.min.js"></script>
<script src="<?=base_url();?>assets/admin/js/pages/ui/animations.js" ></script>
<script src="<?=base_url();?>assets/admin/plugins/material-datetimepicker/datetimepicker.js" ></script>
<script src="<?=base_url();?>assets/admin/plugins/material-datetimepicker/moment-with-locales.min.js" ></script>
<!-- <script src="<?=base_url();?>assets/admin/plugins/material-datetimepicker/bootstrap-material-datetimepicker.js" ></script> -->
<script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>

<!-- <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script> -->
 
<!-- <script src="<?=base_url();?>assets/node_modules/jquery/dist/jquery.min.js"></script> -->

<script src="<?=base_url();?>assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url();?>assets/dist/js/perfect-scrollbar.jquery.min.js"></script>
<script src="<?=base_url();?>assets/dist/js/waves.js"></script>
<script src="<?=base_url();?>assets/dist/js/sidebarmenu.js"></script>
<script src="<?=base_url();?>assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
<script src="<?=base_url();?>assets/dist/js/custom.min.js"></script>
<script src="<?=base_url();?>assets/node_modules/raphael/raphael-min.js"></script>
<!-- <script src="<?=base_url();?>assets/node_modules/morrisjs/morris.min.js"></script> -->
<script src="<?=base_url();?>assets/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="<?=base_url();?>assets/node_modules/toast-master/js/jquery.toast.js"></script>
<script src="<?=base_url();?>assets/node_modules/peity/jquery.peity.min.js"></script>
<script src="<?=base_url();?>assets/node_modules/peity/jquery.peity.init.js"></script>
<script src="<?=base_url();?>assets/dist/js/dashboard1.js"></script>

<script src="<?=base_url();?>assets/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
<!-- <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script> -->
<!-- <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script> -->
<!-- <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script> -->
<!-- <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<!-- end js include path -->


<script type="text/javascript">
    $('#to-recover').on("click", function () {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
</script>
<script>
    $(document).ready(function () {
        // Toggle filter dropdown
        $('#toggleBtn').on('click', function (e) {
            e.stopPropagation();
            $('.filter-dropdown').toggleClass('active');
        });

     $('.filter-dropdown').on('click', function (e) {
            e.stopPropagation();
        });

        $('body').on('click', function (e) {
            if (!$(e.target).closest('.filter-dropdown, .ui-menu-item').length) {
                $('.filter-dropdown').removeClass('active');
            }
        });

        // Accordion toggle
        $('#accordion li .link').on('click', function () {
            $(this).toggleClass('active');
            $(this).next('.content').slideToggle(200);

            // Toggle chevron direction
            $(this).find('i.fa').toggleClass('fa-chevron-down fa-chevron-up');

            // Close other accordions (optional)
            $('#accordion li .link').not(this).removeClass('active')
                .next('.content').slideUp(200)
                .find('i.fa').removeClass('fa-chevron-up').addClass('fa-chevron-down');
        });
        
    });
    
</script>
<script>
    $(document).ready(function() {
        function fetchFiles(selectedDate) {
            // var selectedDate = '2025-04-01';
            $.ajax({
                url: '<?= base_url() ?>files/' + selectedDate,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                console.log(response,'responseresponse');
                var countDetailsDiv = $('#count-details');
                countDetailsDiv.empty();

                var locations_arr = {
                    'Azerbaijan': ['AZ'],
                    'Belarus': ['BZ'],
                    'Georgia': ['GE'],
                    'Kazakhstan': ['KZ'],
                    'Armenia': ['AR'],
                    'Uzbekistan': ['UZ']
                };

                var locations = {};
                <?php if($this->session->userdata('locations') === 'all') { ?>
                    locations = locations_arr;
                <?php } else { ?>
                    var userLocations = '<?= $this->session->userdata('locations') ?>'.split(',');
                    userLocations.forEach(function(loc) {
                        var locKey = loc.trim().charAt(0).toUpperCase() + loc.trim().slice(1).toLowerCase();
                        if (locations_arr[locKey]) {
                            locations[locKey] = locations_arr[locKey];
                        }
                    });
                <?php } ?>

                var locationCounts = {
                    'Azerbaijan': 0,
                    'Belarus': 0,
                    'Georgia': 0,
                    'Kazakhstan': 0,
                    'Armenia': 0,
                    'Uzbekistan': 0,
                    'Other': 0
                };

                $.each(response.details, function(enquiryAbbr, count) {
                    console.log(response.details,'details')
                    let matched = false;
                    $.each(locations, function(locationKey, abbrList) {
                        if (abbrList.includes(enquiryAbbr.toUpperCase())) {
                            locationCounts[locationKey] += count;
                            matched = true;
                            return false;
                        }
                    });
                    if (!matched) {
                        locationCounts['Other'] += count;
                    }
                });

                $.each(locations, function(locationKey, abbrList) {
                    let count = locationCounts[locationKey];
                    let abbr = abbrList[0];
                        let url = `<?= base_url() ?>live-tracking-files?date=${selectedDate}&enq_abbr=${abbr}`;

                        let card = $(`
                            <div class="card m-3" style="min-width:300px;">
                                <a href="${url}">
                                    <div class="card-body p-0">
                                        <p>
                                            <span style="color: crimson; font-size: x-large;"><strong>${locationKey}</strong></span><br><br>
                                            <a class="custom-link" href="${url}">${count}</a>
                                            <div class="fit-git-counts text-center" style="font-size: small; margin-top: 5px; font-weight:;">Loading...</div>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        `);

                        countDetailsDiv.append(card);

                        // Inline AJAX to get FIT/GIT data
                        $.ajax({
                            url: '<?= base_url() ?>live-tracking-all-files/' + selectedDate + '/' + abbr,
                            type: 'GET',
                            dataType: 'json',
                            success: function(res) {
                                var countFit = 0, countGit = 0;
                                var countTotal_no_person_Fit = 0, countTotal_no_child_Fit = 0;
                                var countTotal_no_person_Git = 0, countTotal_no_child_Git = 0;
                                console.log(res,'res');
                                $.each(res.details.arrivals, function(index, item) {
                                    var enquiry_no = item.enquiry_no || '';
                                    var enquiry_abbr = item.enquiry_abbr_final;
                                    var number_persons = parseInt(item.num_adults) || 0;
                                    var number_child = parseInt(item.num_child) || 0;

                                    if (!enquiry_abbr.toUpperCase().startsWith('G')) {
                                        countFit++;
                                        countTotal_no_person_Fit += number_persons;
                                        countTotal_no_child_Fit += number_child;
                                    } else if (enquiry_abbr.toUpperCase().startsWith('G')) {
                                        countGit++;
                                        countTotal_no_person_Git += number_persons;
                                        countTotal_no_child_Git += number_child;
                                    }
                                });

                                // Update the corresponding card
                            card.find('.fit-git-counts').html(`
                                    <div><strong style="font-weight:600;">FIT: ${countFit}</strong> (${countTotal_no_person_Fit} persons, ${countTotal_no_child_Fit} children)</div>
                                    <div><strong style="font-weight:600;">GIT: ${countGit}</strong> (${countTotal_no_person_Git} persons, ${countTotal_no_child_Git} children)</div>
                                `);

                            },
                            error: function() {
                                card.find('.fit-git-counts').html('<span style="color:red;">Error loading</span>');
                            }
                        });
                    });
                },
                error: function() {
                    console.log('Error fetching base location data');
                }
            });
        }

        $('#date').on('change', function() {
            var selectedDate = $(this).val();
            fetchFiles(selectedDate);
        });

        $('#date').trigger('change');

        function formatDate(dateStr) {
            const date = new Date(dateStr);
            const day = ("0" + date.getDate()).slice(-2); // Add leading zero if needed
            const monthNames = [
                "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul",
                "Aug", "Sept", "Oct", "Nov", "Dec"
            ];
            const month = monthNames[date.getMonth()]; // Get the month name
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }

        function getQueryParam(param) {
            var urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        // Get selectedId from URL query parameters
        var date = getQueryParam('date');
        var enq_abbr = getQueryParam('enq_abbr');

        function loadFiles() {
            $.ajax({
                url: '<?= base_url() ?>live-tracking-all-files/' + date + '/' + enq_abbr,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response,'responseresponseresponse');
                    var responseData = response;

                    var tableBody = $('#example4 tbody');
                    // tableBody.empty(); // Clear existing table rows
                    // Initialize counters
                    var countFit = 0;
                    var countGit = 0;
                    var countTotal_no_person_Fit = 0;
                    var countTotal_no_child_Fit = 0;
                    var countTotal_no_person_Git = 0;
                    var countTotal_no_child_Git = 0;

                    // Loop through the response data and append rows to the table
                    $.each(response.details.arrivals, function(index, item) {

                        var enquiry_no = item.enquiry_no;
                        var enquiry_abbr = item.enquiry_abbr_final;
                        var number_persons = parseInt(item.num_adults) || 0;
                        var number_child = parseInt(item.number_child) || 0;
                        
                        // Count enquiry_no starting with 'F' or 'G'
                        if (!enquiry_abbr.toUpperCase().startsWith('G')) {
                            countFit++;
                            countTotal_no_person_Fit += number_persons;
                            countTotal_no_child_Fit += number_child;
                
                        } else if (enquiry_abbr.toUpperCase().startsWith('G')) {
                            countGit++;
                            countTotal_no_person_Git += number_persons;
                            countTotal_no_child_Git += number_child;
        
                        }
                        
                        var guideNames = '';

                        // Check if item.n is null or 0
                        if (item.n === null || item.n === 0) {
                            // Fetch guide names based on enquiry_id from response.details.guide_names
                            if (response.details.guide_names.hasOwnProperty(item.enquiry_id)) {
                                guideNames = response.details.guide_names[item.enquiry_id].join(', ');
                            }
                        } else {
                            // Use item.n directly if it's not null or 0
                            guideNames = item.n;
                        }

                        // Fetch flight details for the current item
                        var flightDetails = '';
                        // console.log(response.details.itinerary_details,'response');
                        if (response.details.flight_details.hasOwnProperty(item.enquiry_id)) {
                            var flightDetailsArray = response.details.flight_details[item.enquiry_id];
                            if (flightDetailsArray.length > 0) {
                                var firstFlight = flightDetailsArray[0];
                                flightDetails = '<div class="flight-detail"><strong>Dep- </strong>' + formatDate(firstFlight.departure_date) +'<br><strong>From- </strong>' + firstFlight.departure_city +'('+firstFlight.departure_time+')' +'<br>(' + firstFlight.airline_name + '- ' + firstFlight.flight_mode + ')' + 
                                                '<br><strong>Arr- </strong>' + formatDate(firstFlight.flight_arrival_date) +'<br><strong>To- </strong>' + firstFlight.arrival_city +'('+firstFlight.arrival_time+')'+'<br>(' + firstFlight.airline_name + '- ' + firstFlight.flight_mode + ')</div>';
                                
                                if (flightDetailsArray.length > 1) {
                                    flightDetails += '<a href="#" class="see-more" data-enquiry-id="' + item.enquiry_id + '">See More</a>';
                                    var hiddenFlights = '';
                                    for (var i = 1; i < flightDetailsArray.length; i++) {
                                        var flight = flightDetailsArray[i];
                                        hiddenFlights = '<div class="hidden-flight-detail" style="display: none;"><strong>Dep- </strong>' + formatDate(flight.departure_date) +'<br><strong>From- </strong>' + flight.departure_city +'('+flight.departure_time+')' +'<br>(' + flight.airline_name + '- ' + flight.flight_mode + ')' + 
                                        '<br><strong>Arr- </strong>' + formatDate(flight.flight_arrival_date) +'<br><strong>To- </strong>' + firstFlight.arrival_city +'('+ flight.arrival_time+')'+'<br>(' + flight.airline_name + '- ' + flight.flight_mode + ')</div>';    
                                    }
                                    flightDetails += hiddenFlights;
                                }
                            }
                        }

                        // Construct the table row
                    // console.log(item , 'item');
                    var enquiryDisplay = '-';
                    if (item.enquiry_no !== null) {
                        enquiryDisplay = item.split_number == 0
                            ? item.enquiry_no
                            : `${item.enquiry_no} (Split ${item.split_number})`;
                    }
                    var row = '<tr>' +
                            '<td class="center">' + (index + 1) + '</td>' + // Row number
                                '<td class="center">' + enquiryDisplay + '</td>' +

                            '<td class="center">' + (item.filename ? item.filename : '-') + '</td>' +
                             '<td class="center">' + (formatDate(item.check_in_date) !== null ? formatDate(item.check_in_date) : '-') + '</td>' + 
                            '<td class="center">' + (formatDate(item.n) !== null ? formatDate(item.n) : '-') + '</td>' + 
                            '<td class="center">' + ((item.num_adults !== null ? item.num_adults : '-') + '+' + (item.num_child !== null ? item.num_child : '-')) + '</td>' + // Number of persons and children
                            // '<td class="center">' + (item.hotel_name !== null ? item.hotel_name : '-') + '</td>' + // Hotel name
                            // '<td class="center">' + guideNames + ' / ' + (item.Driver ? item.Driver : '-') + '</td>' + // Guide names
                            // '<td class="center"><a href="' + item.id + '/activity-log" class="btn btn-success btn-xs" target="_blank" data-id="' + item.id + '">Track</a></td>' +
                            '<td class="center"><a href="javascript:void(0)" class="btn btn-success btn-xs track-btn" data-id="' + item.id + '" data-enquiry-id="' + item.enquiry_id + '">Track</a></td>' +
                            '</tr>';

                        // Append the row to the table body
                        tableBody.append(row);

                    });

                    let currentDateIndex = 0;
                    let futureDates = [];
                    let currentItineraryArray = [];

                    $(document).on('click', '.track-btn', function () {
                        var arrivalId = $(this).data('id');
                        var enquiryId = $(this).data('enquiry-id');
                    
                        var driverdetail = '';
                        var transportdetail = '';
                        var guideDetail = '';
                    
                        var matchingArrival = response.details.arrivals.find(arrival => String(arrival.id) === String(arrivalId));
                        var itineraryMap = response.details.itinerary_details;
                    
                        if (matchingArrival) {
                            console.log(matchingArrival.enquiry_guide_names,'matchingArrival');
                            // === DRIVER DETAILS ===
                            driverdetail += matchingArrival.driver_phone_number
                                ? '<tr><td>1</td><td>' + (matchingArrival.Driver || '-') + '</td><td>' + (matchingArrival.driver_phone_number || '-') + '</td></tr>'
                                : '<tr><td colspan="12" class="text-center">Driver detail not found</td></tr>';
                    
                            // === TRANSPORT DETAILS ===
                            if (matchingArrival.transport_vehicle_types) {
                                const names = (matchingArrival.transport_vehicle_names || '').split(', ');
                                const quantities = (matchingArrival.transport_quantities || '').split(', ');
                                const types = (matchingArrival.transport_vehicle_types || '').split(', ');
                                const capacities = (matchingArrival.transport_capacities || '').split(', ');
                                const luggages = (matchingArrival.transport_luggage || '').split(', ');
                                const remarks = (matchingArrival.transport_remarks || '').split(', ');
                            
                                transportdetail += names.map((name, index) => {
                                    const quantity = quantities[index] || '-';
                                    const type = types[index] || '-';
                                    const capacity = capacities[index] || '-';
                                    const luggage = luggages[index] || '-';
                                    const remark = remarks[index] || '-';
                            
                                    return '<tr>' +
                                        '<td>' + (index + 1) + '</td>' +
                                        '<td>' + name + ' X ' + quantity + '</td>' +
                                        '<td>' + type + '</td>' +
                                        '<td>' + capacity + '</td>' +
                                        '<td>' + luggage + '</td>' +
                                        '<td>' + remark + '</td>' +
                                    '</tr>';
                                }).join('');
                            } else {
                                transportdetail += '<tr><td colspan="12" class="text-center">Transport detail not found</td></tr>';
                            }
                    
                            // === GUIDE DETAILS ===
                            if (matchingArrival.enquiry_guide_names) {
                        const names = (matchingArrival.enquiry_guide_names || '').split(', ');
                        const contacts = (matchingArrival.enquiry_guide_contacts || '').split(', ');
                        const isdcodes = (matchingArrival.enquiry_guide_isdcodes || '').split(', ');
                    
                        guideDetail += names.map((name, index) => {
                            const contact = contacts[index] || '-';
                            const isdcode = isdcodes[index] || '';
                            return '<tr><td>' + (index + 1) + '</td><td>' + name + '</td><td>' + isdcode + contact + '</td></tr>';
                        }).join('');
                    } else {
                        guideDetail += '<tr><td colspan="12" class="text-center">Guide detail not found</td></tr>';
                    }
                    
                    
                            // === ITINERARY DETAILS ===
                            const arrivalIdStr = String(matchingArrival.id);
                            currentItineraryArray = itineraryMap[arrivalIdStr] || [];
                    
                            futureDates = [...new Set(currentItineraryArray.map(i => i.date).filter(Boolean))].sort();
                    
                            const today = new Date().toISOString().split('T')[0];
                            const todayIndex = futureDates.indexOf(today);
                            currentDateIndex = todayIndex !== -1 ? todayIndex : 0;
                    
                            renderItineraryTable(futureDates[currentDateIndex]);
                        } else {
                            driverdetail = '<tr><td colspan="12" class="text-center">Driver detail not found</td></tr>';
                            guideDetail = '<tr><td colspan="12" class="text-center">Guide detail not found</td></tr>';
                            transportdetail = '<tr><td colspan="12" class="text-center">Transport detail not found</td></tr>';
                            $('#itinerary-details-body').html('<tr><td colspan="4" class="text-center">Itinerary details not found.</td></tr>');
                        }
                    
                        $('#driver-details-body').html(driverdetail);
                        $('#guide-details-body').html(guideDetail);
                        $('#transport-details-body').html(transportdetail);
                        $('#flightModal').modal('show');
                    });  
                    
                    function decodeHtmlParam(str) {
                        if (!str) return '-';
                        return decodeURIComponent(str.replace(/\+/g, ' '));
                    }

                    function renderItineraryTable(targetDate) {
                        let itineraryDetailsRows = '';
                    
                        const filtered = currentItineraryArray.filter(item => item.date === targetDate && (item.title?.trim() !== '' || item.content?.trim() !== ''));
                        console.log(filtered,'filtered');
                    
                        filtered.forEach(function (item, index) {
                            let titleOrContent = item.title?.trim() !== '' 
                                ? decodeHtmlParam(item.title) 
                                : (item.content ? decodeHtmlParam(item.content) : '-');
                    
                            itineraryDetailsRows += '<tr>' +
                                '<td>' + (index + 1) + '</td>' +
                                '<td>' + formatDate(item.date || '-') + '</td>' +
                                '<td>' + (item.time || '-') + '</td>' +
                                '<td>' + titleOrContent + '</td>' +
                                '<td>' + decodeURIComponent(item.remarks || '-') + '</td>' +
                                '<td>' + decodeURIComponent(item.restaurant_name || '-') + '</td>' +
                                '</tr>';
                        });
                    
                        $('#itinerary-details-body').html(itineraryDetailsRows || '<tr><td colspan="6" class="text-center">No itinerary available for this date.</td></tr>');
                        $('#current-itinerary-date').text(formatDate(targetDate));
                        updatePaginationButtons();
                    }



                    function updatePaginationButtons() {
                        if(currentDateIndex === 0){
                            $('#itinerary-prev').hide();
                        } else {
                            $('#itinerary-prev').show();
                        }
                        if (currentDateIndex === futureDates.length - 1) {
                            $('#itinerary-next').hide();
                        } else {
                            $('#itinerary-next').show();
                        }
                    }


                    $('#itinerary-prev').on('click', function () {
                        if (currentDateIndex > 0) {
                            currentDateIndex--;
                            renderItineraryTable(futureDates[currentDateIndex]);
                        }
                        });


                    $('#itinerary-next').on('click', function () {
                        if (currentDateIndex < futureDates.length - 1) {
                            currentDateIndex++;
                            renderItineraryTable(futureDates[currentDateIndex]);
                        }
                    });

                    function formatDate(dateStr) {
                        if (!dateStr) return '-';

                        const date = new Date(dateStr);
                        const day = String(date.getDate()).padStart(2, '0');
                        
                        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                                            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                        
                        const month = monthNames[date.getMonth()];
                        const year = date.getFullYear();

                        return `${day}-${month}-${year}`;
                    }

                    // Add click event listener for "See More" links
                    $('.see-more').on('click', function(e) {
                        e.preventDefault();
                        var enquiryId = $(this).data('enquiry-id');
                        $(this).siblings('.hidden-flight-detail').slideDown();
                        $(this).remove();
                    });

                    $('#example4').DataTable({
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
                },
                error: function() {
                    console.log('Error fetching data');
                }
            });
        };

        loadFiles();
    });
</script>

<!-- validate from and to date input field -->
<script>
    $(document).ready(function() {
        $(".dt-search").on("change", function () {
            var idx = $(this).index(".dt-search");
            const selectedDate = new Date($(".dt-search").eq(idx).val());
            //const lastDayDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 0);
            const options = {
                year: 'numeric',
                month: 'short',
                day: '2-digit'
            };
            const formattedDate = selectedDate.toLocaleDateString('en-IN', options);
            $(".dt-search-show").eq(idx).val(formattedDate).parent().addClass('is-focused');

            if ($(this).attr("id") === "from" && $("#to").val() === "") {
                $("#to").attr("min", $(this).val());
            } else if ($(this).attr("id") === "from" && $("#to").val() !== "") {
                const selectedToDate = new Date($("#to").val());
                if (parseInt(selectedToDate.getTime()) < parseInt(selectedDate.getTime())) {
                    $("#to").val('').attr("min", $(this).val());
                    $(".dt-search-show").eq($("#to").index(".dt-search")).val('');
                }
            }
            if ($(this).attr("id") === "to" && $("#from").val() === "") {
                $("#from").attr("max", $(this).val());
            } else if ($(this).attr("id") === "to" && $("#from").val() !== "") {
                const selectedFromDate = new Date($("#from").val());
                if (parseInt(selectedFromDate.getTime()) > parseInt(selectedDate.getTime())) {
                    $("#from").val('').attr("max", $(this).val());
                    $(".dt-search-show").eq($("#from").index(".dt-search")).val('');
                }
            }

        });
    });
</script>
<!-- validate from and to date input field -->
