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
                  <table id="user_list" class="table table-bordered table-hover table-sm">
                    <thead align="center">
                      <tr>
                        <th>Sr. No.</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Mobiel Number</th>
                        <th>Role Name</th>
                        <th>Address</th>
                        <th>Created Date</th>
                      </tr>
                    </thead>
                    <tbody>
                
                    </tbody>
                    <tfoot align="center">
                    <tr>
                      <th>Sr. No.</th>
                      <th>User Name</th>
                      <th>Email</th>
                      <th>Mobiel Number</th>
                      <th>Role Name</th>
                      <th>Address</th>
                      <th>Created Date</th>
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
    var table = $("#user_list").ready(function(){ 
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
        
      item_table = $('#user_list').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            responsive:true,
            url: "{{ route('userlist-ajax') }}",
            type: "POST",
            error: function(xhr){
                console.log(xhr.responseText);
            }
        },
        columns: [
            {data: 'sr_no', name: 'sr_no'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'mobile', name: 'mobile'},
            {data: 'role', name: 'role'},
            {data: 'address', name: 'address'},
            {data: 'created_at', name: 'created_at'},                
        ],
        // columnDefs: [{
        //     targets: 1,
        //     orderable: false,
        //     render: function(data, type, row, meta) {
        //         let html = `
        //                 <input type="hidden" class="user_id" value="`+row.id+`">
        //                 <button onclick="planning('`+row.id+`')" class="btn btn-outline-info btn-sm" type="button"><i class="fas fa-edit"></i> Expand </button>`;
        //         return html;
        //     }
        // }]
      });
    })
  </script>
@endsection