@extends('layouts.main')

@section('main_content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Users List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>User</th>
                      <th>Booking Date</th>
                      <th>From</th>
                      <th>To</th>
                      <th>Total Cost</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>Omkar</td>
                      <td>04-04-2020</td>
                      <td>Mumbai</td>
                      <td>Pune</td>
                      <td>435</td>
                    </tr>
                
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>User</th>
                      <th>Booking Date</th>
                      <th>From</th>
                      <th>To</th>
                      <th>Total Cost</th>
                    </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->  
          </div>
          <!--/.col (left) -->
        </div>
    </div><!-- /.container-fluid -->
  </section>
@endsection