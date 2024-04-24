@extends('admin.layouts.admin')

@section('content')

<!-- Main content -->
<section class="content" id="newBtnSection">
    <div class="container-fluid">
      <div class="row">
        <div class="col-2">
          
        </div>
      </div>
    </div>
</section>
  <!-- /.content -->


<!-- Main content -->
<section class="content mt-3" id="contentContainer">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->

          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title"><b>Transaction List</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl</th>
                  <th>Date</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Transaction ID</th>
                  <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($data as $key => $data)
                  <tr>
                    <td>{{ $key + 1 }}</td>
                     <td>{{ \Carbon\Carbon::parse($data->date)->format('d/m/Y') }}</td>
                    <td>{{ isset($data->work) ? $data->work->name : 'N/A' }}</td>
                    <td>{{ isset($data->work) ? $data->work->email : 'N/A' }}</td>
                    <td>{{$data->tranid}}</td>
                    <td>{{$data->amount}}</td>
                  </tr>
                  @endforeach
                
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection

@section('script')

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": [
        {
          extend: 'copy',
          filename: 'Trasactions'
        },
        {
          extend: 'csv',
          filename: 'Trasactions'
        },
        {
          extend: 'excel',
          filename: 'Trasactions'
        },
        {
          extend: 'pdf',
          filename: 'Trasactions'
        },
        {
          extend: 'print',
          filename: 'Trasactions'
        }
      ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  }); 
</script>


@endsection