@extends('layouts.main')

@section('main_content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Booking List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="booking_history" class="table table-bordered table-hover table-sm">
                    <thead align="center">
                    <tr>
                      <th>Sr. No.</th>
                      <th>Expand</th>
                      <th>Source</th>
                      <th>Destination</th>
                      <th>Vehicle Number</th>
                      <th>Journey Date</th>
                      <th>Total Toll Count</th>
                      <th>Total toll Cost</th>
                      <th>Created At</th>
                    </tr>
                    </thead>
                    <tbody>
                
                    </tbody>
                    <tfoot align="center">
                    <tr>
                      <th>Sr. No.</th>
                      <th>Expand</th>
                      <th>Source</th>
                      <th>Destination</th>
                      <th>Vehicle Number</th>
                      <th>Journey Date</th>
                      <th>Total Toll Count</th>
                      <th>Total toll Cost</th>
                      <th>Created At</th>
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
  @section('script_content')

  <!-- Google Maps JavaScript library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"> --}}
  {{-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> --}}
  <script src="{{ asset('') }}assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
  <script>
    var item_table;
    // $(document).ready(function () {
    var table = $("#booking_history").ready(function(){ 
      $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        
        item_table = $('#booking_history').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                responsive:true,
                url: "{{ route('booking-history-ajax') }}",
                type: "POST",
                error: function(xhr){
                    console.log(xhr.responseText);
                }
            },
            columns: [
                {data: 'sr_no', name: 'sr_no'},
                {data: 'action', name: 'action'},
                {data: 'source', name: 'source'},
                {data: 'destination', name: 'destination'},
                {data: 'vehicle_number', name: 'vehicle_number'},
                {data: 'journey_date', name: 'journey_date'},
                {data: 'toll_count', name: 'toll_count'},
                {data: 'total_toll_cost', name: 'total_toll_cost'},
                {data: 'created_at', name: 'created_at'},                
            ],
            columnDefs: [{
                targets: 1,
                orderable: false,
                render: function(data, type, row, meta) {
                    let html = `
                            <input type="hidden" class="user_id" value="`+row.id+`">
                            <button onclick="planning('`+row.id+`')" class="btn btn-outline-info btn-sm" type="button"><i class="fas fa-edit"></i> Expand </button>`;
                    return html;
                }
            }]
        });
    })
  </script>
@endsection