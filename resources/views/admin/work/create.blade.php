@extends('admin.layouts.admin')

@section('content')



<!-- Loader -->
<div id='loading' style='display:none ;'>
    <img src="{{ asset('loader.gif') }}" id="loading-image" alt="Loading..." />
</div>


    <!-- Main content -->
    <section class="content pt-3" id="addThisFormContainer">
      <div class="container-fluid">
        <div class="row justify-content-md-center">
          <!-- right column -->
          <div class="col-md-10">
            <!-- general form elements disabled -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Add new job</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                @if ($success = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ $success }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <form id="createThisForm"  action="{{route('job.store')}}" method="post" role="form" enctype="multipart/form-data">
                  @csrf

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
                            <label for="phone">Phone</label>
                            <input type="number" name="phone" id="phone" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
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



                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-secondary">Create</button>
                </div>
                <!-- /.card-footer -->


                  
                </form>
              </div>

              
              
              <!-- /.card-body -->
            </div>
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
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


@endsection