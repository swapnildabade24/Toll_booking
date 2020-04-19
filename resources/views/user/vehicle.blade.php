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
                <h3 class="card-title">User Vehicle List</h3>
                <button type="button" class="btn btn-default btn-sm float-right" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i>
                    Vehicle
                </button>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="toll_booking_form" autocomplete="off">
                <div class="card-body">
                  <div class="row">
                    {{-- <div class="col-lg-6">
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
                    </div> --}}
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                </div>
              </form>
            </div>
            <!-- /.card -->  
          </div>
          <!--/.col (left) -->
        </div>
    </div><!-- /.container-fluid -->

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Vehicle</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Source">Vehicle Number</label>
                            <input type="text" class="form-control" id="search_input_1" value = "" placeholder="Vehicle Number">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <!-- select -->
                      <div class="form-group">
                        <label>Vehicle Type</label>
                        <select class="form-control">
                          <option value="2AxlesAuto">Car/ Jeep/ Van</option>
                          <option value="2AxlesMoto">Bike</option>
                          <option value="2AxlesLCV">Pickup truck/ Light commercial vehicles</option>
                        </select>
                      </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  </section>

    <!-- Google Maps JavaScript library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyCdGv5cjpA0dMUCSolCf89tl_vgccGvsu0"></script>

    <script>

        $("#toll_booking_form").submit(function (event) {   

          jQuery.ajax({
              type: "POST",
              url: "#",
              dataType: "json",
              data: JSON.stringify(jsonData),
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
@endsection