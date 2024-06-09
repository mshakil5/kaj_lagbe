@extends('admin.layouts.admin')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <a href="{{ route('admin.complete') }}">
                    <button type="button" class="btn btn-secondary my-3"> <i class="fas fa-arrow-left"></i> Go back</button>
                </a>
                <button type="button" class="btn btn-success my-3" id="newBtn">Create new transaction</button>
            </div>
        </div>
    </div>
</section>



<!-- /.content -->




    <!-- Main content -->
    <section class="content" id="addThisFormContainer">
      <div class="container-fluid">
        <div class="row justify-content-md-center">
          <!-- right column -->
          <div class="col-md-6">
            <!-- general form elements disabled -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Create new transaction</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="ermsg"></div>
                <form id="createThisForm">
                  @csrf
                  <input type="hidden" name="work_id" id="work_id" value="{{ $work->id }}">
                  <input type="hidden" class="form-control" id="codeid" name="codeid">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>date</label>
                        <input type="date" id="date" name="date" class="form-control" placeholder="Enter Date">
                      </div>
                    </div>
                  </div>
                  <!-- <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Net Amount</label>
                        <input type="number" class="form-control" id="net_amount" name="net_amount" placeholder="Enter Net Amount">
                      </div>
                    </div>
                  </div> -->
                </form>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" id="addBtn" class="btn btn-secondary" value="Create">Create</button>
                <button type="submit" id="FormCloseBtn" class="btn btn-default">Cancel</button>
              </div>
              <!-- /.card-footer -->
              <!-- /.card-body -->
            </div>
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


<!-- Main content -->
<section class="content" id="contentContainer">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Job Id : {{$work->orderid}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="text-align: center">Job Id</th>
                  <th style="text-align: center">Title</th>
                  <th style="text-align: center">Date</th>
                  <th style="text-align: center">Amount</th>
                  <th style="text-align: center">Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($data as $key => $data)
                  <tr>
                    <td style="text-align: center">{{$data->orderid}}</td>
                    <td style="text-align: center">{{$data->work->name}}</td>
                    <td>{{ \Carbon\Carbon::parse($data->date)->format('d/m/Y') }}</td>
                    <td style="text-align: center">{{$data->amount}}</td>
                    <td style="text-align: center">
                      <a id="EditBtn" rid="{{$data->id}}" class="btn btn-link">
                          <i class="fa fa-edit" style="color: #2196f3; font-size: 16px; cursor: pointer;"></i>
                      </a>
                      <a id="deleteBtn" rid="{{$data->id}}" class="btn btn-link">
                          <i class="fa fa-trash-o" style="color: red; font-size: 16px; cursor: pointer;"></i>
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
    });
</script>

<script>

 $(document).ready(function() {
     $("#addThisFormContainer").hide();
     $("#newBtn").click(function(){
        clearform();
        $("#newBtn").hide(100);
        $("#addThisFormContainer").show(300);
     });

     $("#FormCloseBtn").click(function(){
          $("#addThisFormContainer").hide(200);
          $("#newBtn").show(100);
          clearform();
      });

      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

      var url = "{{URL::to('/admin/transactions')}}";
      var upurl = "{{URL::to('/admin/transactions-update')}}";



      $("#addBtn").click(function(){
        //Create
        if($(this).val() == 'Create') {
          var form_data = new FormData();
          form_data.append("amount", $("#amount").val());
          form_data.append("date", $("#date").val());
          // form_data.append("net_amount", $("#net_amount").val());
          form_data.append("work_id", $("#work_id").val());
          $.ajax({
            url: url,
            method: "POST",
            contentType: false,
            processData: false,
            data:form_data,

            success: function (d) {
                    if (d.status == 303) {
                        $(".ermsg").html(d.message);
                    }else if(d.status == 300){
                        $(".ermsg").html(d.message);
                      window.setTimeout(function(){location.reload()},2000)
                    }
                },
                error: function (d) {
                    console.log(d);
                }
          });
        }
        //Create end
        //Update
         if($(this).val() == 'Update'){
          var form_data = new FormData();
          form_data.append("amount", $("#amount").val());
          form_data.append("date", $("#date").val());
          // form_data.append("net_amount", $("#net_amount").val());
          form_data.append("codeid", $("#codeid").val()); 

          $.ajax({
              url: upurl,
              type: "POST",
              dataType: 'json',
              contentType: false,
              processData: false,
              data: form_data,
              success: function(d){
                  console.log(d);
                  if (d.status == 303) {
                      $(".ermsg").html(d.message);
                      pagetop();
                  } else if(d.status == 300){    
                      $(".ermsg").html(d.message);
                      window.setTimeout(function(){location.reload()},2000)
                  }
              },
              error: function(d){
                  console.log(d);
              }
          });
    }
      });

      //Edit
      $("#contentContainer").on('click','#EditBtn', function(){
        codeid = $(this).attr('rid');
        info_url = url + '/'+codeid+'/edit';
        $.get(info_url,{},function(d){
            populateForm(d);
            pagetop();
        });
      });

      //Delete

      $("#contentContainer").on('click','#deleteBtn', function(){
            if(!confirm('Sure?')) return;
            codeid = $(this).attr('rid');
            info_url = url + '/'+codeid;
            $.ajax({
                url:info_url,
                method: "DELETE",
                type: "DELETE",
                data:{
                },
                success: function(d){
                    if(d.success) {
                        alert(d.message);
                        location.reload();
                    }
                },
                error:function(d){
                    console.log(d);
                }
            });
        });





      function populateForm(data){
          $("#amount").val(data.amount);
          $("#date").val(data.date);
          // $("#net_amount").val(data.net_amount);
          $("#codeid").val(data.id);
          $("#addBtn").val('Update');
          $("#addBtn").html('Update');
          $("#addThisFormContainer").show(300);
          $("#newBtn").hide(100);
      }
      function clearform(){
        $('#createThisForm')[0].reset();
        $("#addBtn").val('Create');
     }

 })
</script>


@endsection