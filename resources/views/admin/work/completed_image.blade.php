@extends('admin.layouts.admin')

@section('content')

<section class="content mt-3" id="contentContainer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Uploaded Image</b></h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{ route('admin.complete') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Go back</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="uploadedFilesTable">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Image</th>
                                        <th>Video</th>
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
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')

<script>
    $(function () {
      $("#uploadedFilesTable").DataTable();
    });
</script>

@endsection