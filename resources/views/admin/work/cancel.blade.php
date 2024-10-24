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
              <h3 class="card-title"><b>Work List</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Job ID</th>
                  <th>Date</th>
                  <th>Category</th>
                  <th>Client Details</th>
                  <th>Address</th>
                  <!-- <th>Status</th> -->
                  <th>Details</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($data as $key => $data)
                  <tr>
                    <td>{{ $data->orderid }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->date)->format('d/m/Y') }}</td>
                    <td>{{ $data->category->name }}</td>
                    <td style="text-align: left">
                          {{$data->name}} </br> <br>
                          {{$data->email}} </br> <br>
                          {{$data->phone}}
                    </td>
                    <td style="text-align: left">
                        {{$data->address_first_line}} </br>
                        {{$data->address_second_line}}</br>
                        {{$data->address_third_line}}</br>
                        {{$data->town}}</br>
                        {{$data->post_code}}
                    </td>
                    <!-- <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-secondary">
                          <span id="stsval{{$data->id}}"> @if ($data->status == 1) New
                          @elseif($data->status == 2) In progress
                          @elseif($data->status == 3) Completed
                          @else Cancelled @endif
                        </span>
                      </button>
                        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item stsBtn" style="cursor: pointer;" data-id="{{$data->id}}" value="1" >New</a>
                          <a class="dropdown-item stsBtn" style="cursor: pointer;" data-id="{{$data->id}}" value="2">In Progress</a>
                          <a class="dropdown-item stsBtn" style="cursor: pointer;" data-id="{{$data->id}}" value="3">Completed</a>
                          <a class="dropdown-item stsBtn" style="cursor: pointer;" data-id="{{$data->id}}" value="4">Cancelled</a>
                        </div>
                      </div>
                    </td> -->
                   
                    <td>
                        <a href="{{ route('admin.work.details', $data->id) }}" class="btn btn-secondary">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>

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
      order: [],
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('.stsBtn').click(function() {
      var url = "{{URL::to('/admin/change-work-status')}}";
      var id = $(this).data('id');
      var status = $(this).attr('value');
      $.ajax({
        type: "GET",
        dataType: "json",
        url: url,
        data: {'status': status, 'id': id},
        success: function(d){
          if (d.status == 303) {
            alert(d.message);
          } else if(d.status == 300) {
            $("#stsval"+d.id).html(d.stsval);
            alert('Status Changed Successfully');
              setTimeout(function() {
                window.location.reload();
            }, 100);
          }
        },
        error: function (d) {
          console.log(d);
        }
      });
    });
  });

  $(document).ready(function () {
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });  
  });
</script>

@endsection