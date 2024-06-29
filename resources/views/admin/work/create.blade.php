@extends('admin.layouts.admin')

@section('content')

<!-- Main content -->
<section class="content" id="newBtnSection">
    <div class="container-fluid">
      <div class="row">
        <div class="col-2">
            <button type="button" class="btn btn-secondary my-3" id="newBtn">Add new</button>
        </div>
      </div>
    </div>
</section>
  <!-- /.content -->
<!-- Loader -->
<div id='loading' style='display:none ;'>
    <img src="{{ asset('loader.gif') }}" id="loading-image" alt="Loading..." />
</div>


    <!-- Main content -->
    <section class="content mt-3" id="addThisFormContainer">
      <div class="container-fluid">
        <div class="row justify-content-md-center">
          <!-- right column -->
          <div class="col-md-8">
            <!-- general form elements disabled -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Add new job</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="ermsg"></div>
                <form id="createThisForm">
                  @csrf
                  <input type="hidden" class="form-control" id="codeid" name="codeid">




                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="email"> Email</label>
                        <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="phone"> Phone</label>
                        <input type="number" name="phone" id="phone" class="form-control" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-4 col-12">
                        <label for="address_first_line"> Address First Line</label>
                        <input type="text" name="address_first_line" id="address_first_line" class="form-control" required>
                    </div>
                    <div class="col-lg-4 col-12">
                        <label for="address_second_line"> Address Second Line</label>
                        <input type="text" name="address_second_line" id="address_second_line" class="form-control" readonly>
                    </div>
                    <div class="col-lg-4 col-12">
                        <label for="address_third_line"> Address Third Line</label>
                        <input type="text" name="address_third_line" id="address_third_line" class="form-control" readonly>
                    </div>
                    <div class="col-lg-6 col-12">
                        <label for="town"> Town</label>
                        <input type="text" name="town" id="town" class="form-control">
                    </div>
                    <div class="col-lg-6 col-12">
                        <label for="post_code"> Post Code</label>
                        <input type="text" name="post_code" id="post_code" class="form-control">
                        <div class="perrmsg"></div>
                    </div>
                </div>

                <div class="col-lg-12 col-12">
                    <div id="imageContainer">
                        <div class="row image-row" style="margin-top: 10px;">
                            <div class="col-lg-6 col-12">
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control image-upload" name="images[]" accept="image/*,video/*" required>
                                </div>
                            </div>
                            <div class="col-lg-5 col-8">
                                <div class="input-group mb-3">
                                    <textarea class="form-control description resizable" placeholder="Description" rows="3" name="descriptions[]" required></textarea>
                                </div>
                            </div>
                            <div class="col-lg-1 col-2 text-end">
                                <button class="btn btn-success add-row" type="button">+</button>
                            </div>
                        </div>
                    </div>
                </div>






                  
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
              <h3 class="card-title">All Data</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl</th>
                  <th>Name</th>
                  <th>Company Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($data as $key => $data)
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->surname}}</td>
                    <td>{{$data->email}}</td>
                    <td>{{$data->phone}}</td>
                    
                    <td>
                      <a id="EditBtn" rid="{{$data->id}}"><i class="fa fa-edit" style="color: #2196f3;font-size:16px;"></i></a>
                      <a id="deleteBtn" rid="{{$data->id}}"><i class="fa fa-trash-o" style="color: red;font-size:16px;"></i></a>
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
<script src="https://cdn.jsdelivr.net/npm/@ideal-postcodes/address-finder-bundled@4"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        IdealPostcodes.AddressFinder.watch({
            apiKey: "ak_lt4ocv0eHLLo4meBRGHWK4HU0SBxa",
            outputFields: {
            line_1: "#address_first_line",
            line_2: "#address_second_line",
            line_3: "#address_third_line",
            post_town: "#town",
            postcode: "#post_code"
        }
    });
});
</script>
<!-- Loader start-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('.custom-form');
        const loadingDiv = document.getElementById('loading');

        form.addEventListener('submit', function() {
            loadingDiv.style.display = 'flex';
        });
    });
</script>
<!-- Loader end-->

<script>
    $(document).ready(function(){
        function addNewRow() {
            var newRow = `
                <div class="row image-row" style="margin-top: 10px;">
                    <div class="col-lg-6 col-12">
                        <div class="input-group mb-3">
                            <input type="file" class="form-control image-upload" name="images[]" accept="image/*,video/*" required>
                        </div>
                    </div>
                    <div class="col-lg-5 col-12">
                        <div class="input-group mb-3">
                            <textarea class="form-control description resizable" placeholder="Description" rows="3" name="descriptions[]" required></textarea>
                        </div>
                    </div>
                    <div class="col-lg-1 col-12 text-end">
                        <button class="btn btn-danger remove-row" type="button">-</button>
                    </div>
                </div>
            `;
            $('#imageContainer').append(newRow);
            $('#imageContainer').children('.row').last().find('.add-row').removeClass('btn-success add-row').addClass('btn-danger remove-row').html('-');
        }

        $(document).on('click', '.add-row', function(){
            addNewRow();
        });

        $(document).on('click', '.remove-row', function(){
            $(this).closest('.row').remove();
        });

        $('#submitBtn').click(function(){
            @guest
                toastr.error('Please login first to submit the form.', 'Error');
                return false;
            @endguest
        });
    });
</script>

<script>
  $(document).ready(function () {
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
      //header for csrf-token is must in laravel
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
      //
      var url = "{{URL::to('/admin/job')}}";
      var upurl = "{{URL::to('/admin/job-update')}}";
      // console.log(url);
      $("#addBtn").click(function(){
      //   alert("#addBtn");
          if($(this).val() == 'Create') {
              var form_data = new FormData();
              form_data.append("name", $("#name").val());
              form_data.append("email", $("#email").val());
              form_data.append("phone", $("#phone").val());
              form_data.append("surname", $("#surname").val());
              form_data.append("password", $("#password").val());
              form_data.append("confirm_password", $("#confirm_password").val());
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
          //create  end
          //Update
          if($(this).val() == 'Update'){
              var form_data = new FormData();
              form_data.append("name", $("#name").val());
              form_data.append("email", $("#email").val());
              form_data.append("phone", $("#phone").val());
              form_data.append("surname", $("#surname").val());
              form_data.append("password", $("#password").val());
              form_data.append("confirm_password", $("#confirm_password").val());
              form_data.append("codeid", $("#codeid").val());
              
              $.ajax({
                  url:upurl,
                  type: "POST",
                  dataType: 'json',
                  contentType: false,
                  processData: false,
                  data:form_data,
                  success: function(d){
                      console.log(d);
                      if (d.status == 303) {
                          $(".ermsg").html(d.message);
                          pagetop();
                      }else if(d.status == 300){
                        $(".ermsg").html(d.message);
                          window.setTimeout(function(){location.reload()},2000)
                      }
                  },
                  error: function(xhr, status, error){
                      console.error(xhr.responseText);
                  }
              });
          }
          //Update
      });
      //Edit
      $("#contentContainer").on('click','#EditBtn', function(){
          //alert("btn work");
          codeid = $(this).attr('rid');
          //console.log($codeid);
          info_url = url + '/'+codeid+'/edit';
          //console.log($info_url);
          $.get(info_url,{},function(d){
              populateForm(d);
              pagetop();
          });
      });
      //Edit  end
      //Delete
      $("#contentContainer").on('click','#deleteBtn', function(){
            if(!confirm('Sure?')) return;
            codeid = $(this).attr('rid');
            info_url = url + '/'+codeid;
            $.ajax({
                url:info_url,
                method: "GET",
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
      //Delete  
      function populateForm(data){
          $("#name").val(data.name);
          $("#surname").val(data.surname);
          $("#phone").val(data.phone);
          $("#email").val(data.email);
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
  });
</script>
@endsection