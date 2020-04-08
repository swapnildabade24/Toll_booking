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
                <h3 class="card-title">Add Toll</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">toll name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Toll Name">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Select Road</label>
                            <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Select Road">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Position of toll(in km)</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="How it is form start">
                        </div>
                    </div>
                    <div class="col-lg-6">
                      
                    </div>
                  </div>
                  <h5>Toll cost</h5>
                  <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Two wheeler cost</label>
                            <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Two wheeler cost">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Four wheeler cost</label>
                            <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Four wheeler cost">
                        </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="form-group">
                            <label for="exampleInputPassword1">Heavy vehicle cost</label>
                            <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Heavy vehicle cost">
                        </div>
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
@endsection