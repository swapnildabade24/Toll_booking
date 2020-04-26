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
              {{-- {!! QrCode::generate('Welcome to kerneldev.com!'); !!} --}}
              <!-- form start -->
              {{-- <form role="form" id="toll_booking_form" autocomplete="off" > --}}
              <form role="form" id="toll_booking_form" method="post" action="{{ url('user/tollbooking-ajax') }}" autocomplete="off" target="_blank">
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
                          <input type="text" class="form-control" name="vehicle_number" id="search_input_1" value = "" placeholder="Vehicle Number">
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
                          <input type="text" id="datepicker" name="journey_date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
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
  
@endsection
@section('script_content')

    <!-- Google Maps JavaScript library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyCdGv5cjpA0dMUCSolCf89tl_vgccGvsu0"></script>

    <script>
        var source = 'search_input_1';
        var destination = 'search_input_2';

        var toll_name = [];
        var road_name = [];
        var toll_price = [];

        $(document).ready(function () {
          // alert('hello');
          // $("select.vehicle_type").change(function(){
          //   var vehicle_type = $(this).children("option:selected").val();
          //   alert("You have selected the country - " + vehicle_type);
          // });
            var autocomplete_1;
            var autocomplete_2;
            autocomplete_1 = new google.maps.places.Autocomplete((document.getElementById(source)), {
                types: ['geocode'],
            });
            autocomplete_2 = new google.maps.places.Autocomplete((document.getElementById(destination)), {
                types: ['geocode'],
            });
        });

        // $("#get_toll_info").click(function(event){
        function get_toll_info(event) {
          
          // event.preventDefault();
          var from = document.getElementById(source).value;
          var to = document.getElementById(destination).value;
          var vehicle_type = $('#vehicle_type :selected').val();
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
            "vehicleType": vehicle_type,
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
                document.getElementById("toll_count").innerHTML = '<input  name="toll_count" value="'+response.routes[0].tolls.length+'" type="hidden">Totol Toll Count: '+response.routes[0].tolls.length;
                document.getElementById("total_toll_cost").innerHTML = '<input  name="total_toll_cost" value="'+response.routes[0].costs.cash+'" type="hidden">Totol Toll Cost: Rs '+response.routes[0].costs.cash;
                let html = ``;
                if(response.routes[0].tolls.length > 0) {
                    for(let i in response.routes[0].tolls) {
                        let tmp = response.routes[0].tolls[i];
                                    if (!tmp.name) {
                                      toll_name[i] = tmp.start.name;
                                    }else{
                                      toll_name[i] = tmp.name;
                                    }
                                    if (!tmp.road) {
                                      road_name[i] = tmp.start.road;
                                    }else{
                                      road_name[i] = tmp.road;
                                    }
                                    toll_price[i] = tmp.oneWay;
                                    
                                    // @if(`+!tmp.name+`)
                                    //   <td>`+tmp.start.name+`</td>
                                    // @else
                                    //   <td>`+tmp.name+`</td>
                                    // @endif
                                    // @if(`+!tmp.road+`)
                                    //   <td>`+tmp.start.road+`</td>
                                    // @else
                                    //   <td>`+tmp.road+`</td>
                                    // @endif
                                    // <td>`+tmp.oneWay+`</td>
                        html +=`<tr>
                                @if(`+!tmp.name+`)
                                      <td>`+tmp.start.name+` <input  name="toll_name[]" value="`+tmp.start.name+`" type="hidden"> </td>
                                    @else
                                      <td>`+tmp.name+` <input  name="toll_name[]" value="`+tmp.name+`" type="hidden">  </td>
                                    @endif
                                    @if(`+!tmp.road+`)
                                      <td>`+tmp.start.road+` <input  name="road_name[]" value="`+tmp.start.road+`" type="hidden"> </td>
                                    @else
                                      <td>`+tmp.road+` <input  name="road_name[]" value="`+tmp.road+`" type="hidden"> </td>
                                    @endif
                                    <td>`+tmp.oneWay+` <input  name="toll_price[]" value="`+tmp.oneWay+`" type="hidden"> </td>
                                </tr>`;
                    }
                }
                $("#toll_list tbody").html(html);
                // alert(toll_name);
                // alert(road_name);
                // alert(toll_price);
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


        $("#toll_booing_form").submit(function (event) {  
          
          event.preventDefault();
          // var form = $('#toll_booking_form')[0];
          var formData = $('#toll_booking_form').serializeArray();
          var indexed_array = {};

          $.map(formData, function(n, i){
              indexed_array[n['name']] = n['value'];
          });                   
          // var formData = new FormData(this);
          console.log(indexed_array);
          var source = $('#search_input_1').val(); 
          // var destination = $('#search_input_2').val(); 
          // var vehicle_number = $('#vehicle_number').val(); 
          // var vehicle_type_value = $('#vehicle_type :selected').val(); 
          // var vehicle_type_text = $('#vehicle_type :selected').text(); 
          // var journey_date = $('#journey_date').val(); 
          // // alert(formData);

          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          }); 

          // jQuery.ajax({
          //     type: "POST",
          //     url: "{{ route('tollbooking-ajax') }}",
          //     dataType: "json",
          //     async: 'true',
          //     cache: false,
          //     contentType: false,
          //     processData: false,
          //     data: formData,
          //     {
          //     //   formData,
          //       // source : source,
          //     //   destination  : destination,
          //     //   vehicle_number : vehicle_number,
          //     //   vehicle_type_value : vehicle_type_value,
          //     //   vehicle_type_text :vehicle_type_text,
          //     //   vehicle_type_text : journey_date,
          //     //   toll_name,  
          //     //   road_name,
          //     //   toll_price,

          //     },
          //     beforeSend: function() {
          //       $(".loading").show();
          //     },
          //     success: function (response) {
          //       console.log(response);
          //     },
          //     error: function (error) {
          //       console.log(error);
          //     },
          //     complete: function() {
          //         $(".loading").hide();
          //     }
          // });

          $.ajax({
                method: "POST",
                url: "{{ route('tollbooking-ajax') }}",
                dataType: "json",
                async: 'true',
                cache: false,
                contentType: false,
                processData: false,
                data: indexed_array,
                // data: {source : source},
                beforeSend: function() {
                    $(".loading").show();
                },
                success: function (response) {
                    if(response.success)
                    {
                        console.log(response);
                    }
                    else
                    {
                        console.log(response);
                        // toastr.error(response.error);
                    }
                    $(".loading").hide();
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
  <!-- bootstrap datepicker -->
<script src="{{ asset('bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>

  //Date picker
  $('#datepicker').datepicker({
    autoclose: true
  })

</script>

    

    
@endsection