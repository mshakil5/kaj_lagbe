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
                  <th class="text-center">Sl</th>
                  <th class="text-center">Date</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Email</th>
                  <th class="text-center">Phone</th>
                  <th class="text-center">Address</th>
                  <th class="text-center">Transaction</th>
                  <th class="text-center">Invoice</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Details</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($data as $key => $data)
                  <tr>
                    <td style="text-align: center">{{ $key + 1 }}</td>
                    <td style="text-align: center">{{ \Carbon\Carbon::parse($data->date)->format('d/m/Y') }}</td>
                    <td style="text-align: center">{{$data->name}}</td>
                    <td style="text-align: center">{{$data->email}}</td>
                    <td style="text-align: center">{{$data->phone}}</td>
                    <td style="text-align: center">
                        <p>House No. {{$data->house_number}}</p>
                        <p>Street Name. {{$data->street}}</p>
                        <p>Town. {{$data->town}}</p>
                        <p>Post Code. {{$data->post_code}}</p>
                    </td>
                    <td style="text-align: center">
                        <a href="{{ route('work.transactions', $data->id) }}" class="btn btn-secondary">
                            Transaction 
                        </a>
                    </td>
                    <td style="text-align: center">
                        <a href="{{ route('work.invoice', $data->id) }}" class="btn btn-secondary">
                            Invoice
                        </a>
                    </td>

                    <td style="text-align: center">
                      <div class="btn-group">
                        <button type="button" class="btn btn-secondary">
                          <span id="stsval{{$data->id}}"> 
                            @if ($data->status == 0) Processing
                            @elseif($data->status == 1) Complete 
                            @else Cancel 
                            @endif
                          </span>
                        </button>
                        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item stsBtn" style="cursor: pointer;" data-id="{{$data->id}}" value="0" >Processing</a>
                          <a class="dropdown-item stsBtn" style="cursor: pointer;" data-id="{{$data->id}}" value="1">Complete</a>
                          <a class="dropdown-item stsBtn" style="cursor: pointer;" data-id="{{$data->id}}" value="2">Cancel</a>
                        </div>
                      </div>
                    </td>
                   
                    <td style="text-align: center">
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
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
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