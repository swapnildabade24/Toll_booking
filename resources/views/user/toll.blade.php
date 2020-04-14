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
                        <label for="Source">Source</label>
                        <input type="text" class="form-control" id="search_input_1" value = "Mumbai, Maharashtra, India" placeholder="Search Source">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Destination</label>
                        <input type="text" class="form-control" id="search_input_2" value = "Pune, Maharashtra, India" placeholder="Search Destination">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <p id="toll_count"></p>
                    </div>
                    <div class="col-lg-6">
                      <p id="total_toll_cost"></p>
                    </div>
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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

        $("#toll_booking_form").submit(function (event) {   
          event.preventDefault();

          var from = document.getElementById(searchInput_1).value;
          var to = document.getElementById(searchInput_2).value;

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
@endsection