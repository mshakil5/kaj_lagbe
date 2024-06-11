@extends('layouts.staff')

@section('content')
<style>
    
/*loader css*/
#loading {
  position: fixed;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  opacity: 0.7;
  background-color: #fff;
  z-index: 99;
}

#loading-image {
  z-index: 100;
}
</style>
    <!-- Image loader -->
<div id='loading' style='display:none ;'>
    <img src="{{ asset('loader.gif') }}" id="loading-image" alt="Loading..." />
</div>

<div class="row">
    <div class="col-2">
        <a href="{{ route('completed.tasks.staff') }}">
            <button type="button" class="btn btn-secondary my-3"><i class="fas fa-arrow-left"></i> Go back</button>
        </a>
    </div>
</div>

<div class="rightBar">
    <div class="ermsg"></div>

    <h4 class="d-flex justify-content-center font-weight-bold bg-success p-2 mb-4 col-lg-6">Upload Image/Video</h4>

    <div class="user-form">
        <div class="left">
            <div class="addProfile mt-5">
                <form id="uploadForm" enctype="multipart/form-data">
                   <input type="hidden" name="work_id" id="work_id" value="{{ $id }}">
                    @csrf
                    <div class="form-group">
                        <div class="form-item">
                            <label for="image">Choose Image (Max 10 MB)</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-item">
                            <label for="video">Choose Video (Max 100 MB)</label>
                            <input type="file" name="video" id="video" class="form-control" accept="video/*">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-item">
                            <button type="button" class="btn-form" id="uploadButton">Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered" id="uploadedFilesTable">
        <thead>
            <tr>
                <th>Sl</th>
                <th>Image</th>
                <th>Video</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($uploads as $upload)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="text-center">
                    @if($upload->image)
                    <img src="{{ asset($upload->image) }}" alt="Image" width="200">
                    @endif
                </td>
                <td class="text-center">
                    @if($upload->video)
                    <video width="320" height="240" controls>
                        <source src="{{ asset($upload->video) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    @endif
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm delete-upload" data-id="{{ $upload->id }}">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('script')

<script>
    $(document).ready(function () {
        $('#uploadButton').on('click', function(e) {
            e.preventDefault();
            $("#loading").show();    


            let formData = new FormData($('#uploadForm')[0]);
            formData.append('work_id', $('#work_id').val());

            $.ajax({
                type: 'POST',
                url: '{{ route('upload-file') }}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                $("#loading").hide();    

                    swal({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                        confirmButtonText: 'OK'
                    });
                    window.setTimeout(function(){
                        location.reload();
                    }, 2000);

                    $('#image').val('');
                    $('#video').val('');
                },
                error: function (xhr, status, error) {
                $("#loading").hide();  
                    console.log(xhr, status, error);
                    var errorMessage = xhr.responseJSON.errors.image[0] || xhr.responseJSON.errors.video[0];
                    swal({
                        icon: 'error',
                        title: 'Oops...',
                        text: errorMessage || 'Something went wrong Please try again.',
                        button: 'Try Again'
                    });
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $(document).on('click', '.delete-upload', function(e) {
            e.preventDefault();

            var uploadId = $(this).data('id');

            if (!confirm('Are you sure you want to delete this upload?')) {
                return;
            }

            $.ajax({
                type: 'DELETE',
                url: '{{ route("upload.delete", ":id") }}'.replace(':id', uploadId),
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    swal({
                        icon: 'success',
                        title: 'Deleted!',
                        text: response.success,
                        confirmButtonText: 'OK'
                    });

                    window.setTimeout(function(){
                        location.reload();
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON.error || 'An error occurred';
                    swal({
                        icon: 'error',
                        title: 'Oops...',
                        text: errorMessage,
                        confirmButtonText: 'Try Again'
                    });
                }
            });
        });
    });
</script>

<script>
    $(function () {
      $("#uploadedFilesTable").DataTable({
        order: [],
      });
    });
</script>

@endsection
