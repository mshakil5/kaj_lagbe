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
                
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Assign</th>
                    <th>Status</th>
                    <th>Details</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $key => $data)
                    <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>{{ \Carbon\Carbon::parse($data->date)->format('d/m/Y') }}</td>
                      <td>{{$data->name}}</td>
                      <td>{{$data->email}}</td>
                      <td>{{$data->phone}}</td>
                      <td>
                          {{$data->address_first_line}} </br>
                          {{$data->address_second_line}}</br>
                          {{$data->address_third_line}}</br>
                          {{$data->town}}</br>
                          {{$data->post_code}}
                      </td>
                      <td>
                              <div class="dropdown">
                                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $data->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Select Staff
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $data->id }}">
                                      @foreach ($staffs as $staff)
                                          <a class="dropdown-item assign-staff" href="#" data-staff-id="{{ $staff->id }}" data-work-id="{{ $data->id }}">{{ $staff->name }} {{ $staff->surname }}</a>
                                      @endforeach
                                  </div>
                              </div>
                          </td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-secondary">
                            <span id="stsval{{$data->id}}">
                            @if ($data->status == 1) New
                            @elseif($data->status == 2) In progress
                            @elseif($data->status == 3) Completed
                            @elseif($data->status == 4) Cancelled
                            @endif
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
                      </td>
                     
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
  $(document).ready(function () {
          $('#example1').DataTable();
      });


  $(function () {
    

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

<script>
    $(document).ready(function() {
        $('.assign-staff').on('click', function(e) {
            e.preventDefault();

            var staffId = $(this).data('staff-id');
            var workId = $(this).data('work-id');

            $.ajax({
                url: '/admin/assign-staff',
                type: 'POST',
                data: {
                    staff_id: staffId,
                    work_id: workId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert('Assigned Successfully');
                      setTimeout(function() {
                        window.location.reload();
                    }, 100);
                    
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>


@endsection