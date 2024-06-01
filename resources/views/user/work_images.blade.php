@extends('layouts.user')

@section('content')
<div class="row" id="basic-table">
    <div class="col-12">
        
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title"><b>Uploaded Image</b></h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <a href="{{ route('user.works') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
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




@endsection
