@extends('layouts.main')

@section('main_content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Book Toll</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="toll_booking_form" autocomplete="off">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        @csrf()
                        <label for="Source">Source</label>
                        <input type="text" class="form-control" name="source" id="search_input_1" value = "Mumbai, Maharashtra, India" placeholder="Search Source">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Destination</label>
                        <input type="text" class="form-control" name="destination" id="search_input_2" value = "Pune, Maharashtra, India" placeholder="Search Destination">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                          <label for="Source">Vehicle Number</label>
                          <input type="text" class="form-control" name="vehicle_numnber" id="search_input_1" value = "" placeholder="Vehicle Number">
                      </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <!-- select -->
                            <div class="form-group">
                                <label>Vehicle Type</label>
                                <select id="vehicle_type" name="vehicle_type" class="form-control">
                                    <option value="2AxlesAuto">Car/ Jeep/ Van</option>
                                    <option value="2AxlesMoto">Bike</option>
                                    <option value="2AxlesLCV">Pickup truck/ Light commercial vehicles</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                      <!-- Date dd/mm/yyyy -->
                      <div class="form-group">
                        <label>Date of journey:</label>
  
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                          </div>
                          <input type="text" id="journey_date" name="journey_date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                        </div>
                        <!-- /.input group -->
                      </div>
                      <!-- /.form group -->
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <p id="toll_count"></p>
                    </div>
                    <div class="col-lg-6">
                      <p id="total_toll_cost"></p>
                    </div>
                    <div class="col-lg-12">
                      <table class="table table-condensed" id="toll_list">
                        <thead>
                          <tr>                                        
                            <th style="border: 0">Toll Name</th>
                            <th style="border: 0">Road Name</th>
                            <th style="border: 0">Price</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                    </div>
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" onclick="get_toll_info();" class="btn btn-primary">Get Toll information</button>
                  <button type="submit" class="btn btn-primary float-right">Conform and Proceed</button>
                </div>
              </form>
            </div>
            <!-- /.card -->  
          </div>
          <!--/.col (left) -->
        </div>
    </div><!-- /.container-fluid -->
  </section>

    <!-- Google Maps JavaScript library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyCdGv5cjpA0dMUCSolCf89tl_vgccGvsu0"></script>

    <script>
        var searchInput_1 = 'search_input_1';
        var searchInput_2 = 'search_input_2';

        $(document).ready(function () {
          // alert('hello');

            var autocomplete_1;
            var autocomplete_2;
            autocomplete_1 = new google.maps.places.Autocomplete((document.getElementById(searchInput_1)), {
                types: ['geocode'],
            });
            autocomplete_2 = new google.maps.places.Autocomplete((document.getElementById(searchInput_2)), {
                types: ['geocode'],
            });
        });

        function get_toll_info(event) {
          
          // event.preventDefault();

          var from = document.getElementById(searchInput_1).value;
          var to = document.getElementById(searchInput_2).value;
          // var vehicle_type = document.getElementById(vehicle_type).value;

          var jsonData = {
            "from": {
              	"address": from
            },
            "to": {
              	"address": to
            },
            "waypoints": [
              	{ "address": from },
              	{ "address": to}
            ],
            "vehicleType": "2AxlesAuto",
            "fuelPrice": "2.79",
            "fuelPriceCurrency": "USD",
            "fuelEfficiency": {
              	"city": 24,
              	"hwy": 30,
              	"units": "mpg"
            },
            "departure_time": 1551541566,
            "driver": {
              	"wage": 30,
              	"rounding": 15,
              	"valueOfTime": 0
            }
          };

          $.ajaxSetup({
            headers: {
              "x-api-key": "hDH42mTrBgpFLPj69LQTTHNT9n9P4QTB",
              "Accept": "application/json",
              "Content-Type": "application/json"
            }
          });

          jQuery.ajax({
              type: "POST",
              url: "https://dev.tollguru.com/v1/calc/gmaps",
              dataType: "json",
              data: JSON.stringify(jsonData),
              beforeSend: function() {
                $(".loading").show();
              },
              success: function (response) {
                console.log(response.routes[0].costs.cash);
                document.getElementById("toll_count").innerHTML = 'Totol Toll Count: '+response.routes[0].tolls.length;
                document.getElementById("total_toll_cost").innerHTML = 'Totol Toll Cost: Rs '+response.routes[0].costs.cash;
                let html = ``;
                if(response.routes[0].tolls.length > 0) {
                    for(let i in response.routes[0].tolls) {
                        let tmp = response.routes[0].tolls[i];
                        html +=`<tr>
                                    @if(`+!tmp.name+`)
                                      <td>`+tmp.start.name+` <abbr title="#"><i class="fas fa-info-circle"></i></abbr></td>
                                    @else
                                      <td>`+tmp.name+` <abbr title="#"><i class="fas fa-info-circle"></i></abbr></td>
                                    @endif
                                    @if(`+!tmp.road+`)
                                      <td>`+tmp.start.road+` <abbr title="#"><i class="fas fa-info-circle"></i></abbr></td>
                                    @else
                                      <td>`+tmp.road+` <abbr title="#"><i class="fas fa-info-circle"></i></abbr></td>
                                    @endif
                                    <td>`+tmp.oneWay+` <abbr title="#"><i class="fas fa-info-circle"></i></abbr></td>
                                </tr>`;
                    }
                }
                $("#toll_list tbody").html(html);
                // $('.pending-schedules-count').html(results.collections.length);
              },
              error: function (error) {
                console.log(error);
              },
              complete: function() {
                  $(".loading").hide();
              }
          });
              return false;
        }
        // $("#toll_booking_form").submit(function (event) {   
        // });


        $("#toll_booking_form").submit(function (event) {  
          
          event.preventDefault();
          var formData = new FormData(this);

          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          }); 

          jQuery.ajax({
              type: "POST",
              url: "tollbooking-ajax",
              dataType: "json",
              async: 'true',
              cache: false,
              contentType: false,
              processData: false,
              data: formData,
              beforeSend: function() {
                $(".loading").show();
              },
              success: function (response) {

              },
              error: function (error) {
                console.log(error);
              },
              complete: function() {
                  $(".loading").hide();
              }
          });
          return false;
        });


    </script>
    <!-- InputMask -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>

    <!-- jQuery -->
    <script src="{{('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ ('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ ('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{('plugins/moment/moment.min.js') }}"></script>
    <script src="{{('plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{('dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{('dist/js/demo.js')}}"></script>
    <!-- Page script -->

    <script>
      $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    
        //Initialize Select2 Elements
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        })
    
        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
        //Money Euro
        $('[data-mask]').inputmask()
    
        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
          timePicker: true,
          timePickerIncrement: 30,
          locale: {
            format: 'MM/DD/YYYY hh:mm A'
          }
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker(
          {
            ranges   : {
              'Today'       : [moment(), moment()],
              'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
              'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
              'Last 30 Days': [moment().subtract(29, 'days'), moment()],
              'This Month'  : [moment().startOf('month'), moment().endOf('month')],
              'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate  : moment()
          },
          function (start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
          }
        )
    
        //Timepicker
        $('#timepicker').datetimepicker({
          format: 'LT'
        })
        
        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox()
    
        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()
    
        $('.my-colorpicker2').on('colorpickerChange', function(event) {
          $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        });
    
        $("input[data-bootstrap-switch]").each(function(){
          $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    
      })
    </script>
@endsection