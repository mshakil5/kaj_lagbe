@extends('admin.layouts.admin')

@section('content')
<!-- <div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <a href="{{ route('admin.new') }}" class="btn btn-secondary">Back</a>
                    <a href="{{ route('invoice.create', ['work_id' => $work->id]) }}" class="btn btn-success">Create New</a>         
                </div>
            </div>
        </div>
        {{-- <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @isset($invoice)

            @foreach ($invoice as $invoice)

                <form action="{{ route('invoices.update', $invoice->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="work_id" value="{{ $invoice->work_id }}">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Date:</td>
                                <td><input type="date" class="form-control" id="date" name="date" value="{{ $invoice->date }}"></td>
                            </tr>
                            <tr>
                                <td>Amount:</td>
                                <td><input type="text" class="form-control" id="amount" name="amount" value="{{ $invoice->amount }}"></td>
                            </tr>
                            <tr>
                                <td>Existing Invoice File:</td>
                                <td>
                                    @if ($invoice->img)
                                        <p><a href="{{ asset($invoice->img) }}" target="_blank">View Invoice</a></p>
                                    @else
                                        <p>No file found</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Upload New Invoice File</td>
                                <td><input type="file" class="form-control-file" id="img" name="img"></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Update Invoice</button>
                </form>
                <form action="{{ route('invoices.destroy', $invoice->work_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this invoice?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn mt-3 btn-danger">Delete Invoice</button>
                </form>

                @endforeach
            @else
            @endisset
            
        </div> --}}
    </div>
</div> -->

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <a href="{{ route('admin.complete') }}">
                    <button type="button" class="btn btn-secondary my-3"> <i class="fas fa-arrow-left"></i> Go back</button>
                </a>
                <a href="{{ route('invoice.create', ['work_id' => $work->id]) }}" class="btn btn-success">Create new invoice</a>
            </div>
        </div>
    </div>
</section>

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
                  <th style="text-align: center">Job ID</th>
                  <th style="text-align: center">Image</th>
                  <th style="text-align: center">Date</th>
                  <th style="text-align: center">Amount</th>
                  <th style="text-align: center">Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($work->invoice as $key => $data)
                  <tr>
                    <td style="text-align: center">{{$work->orderid}}</td>
                    <td style="text-align: center">
                        @if ($data->img)
                            <p><a href="{{ asset($data->img) }}" target="_blank">View Invoice</a></p>
                        @else
                            <p>No file found</p>
                        @endif    
                    </td>
                    <td>{{ \Carbon\Carbon::parse($data->date)->format('d/m/Y') }}</td>
                    <td style="text-align: center">{{$data->amount}}</td>
                    <td style="text-align: center">
                      <form action="{{ route('invoices.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this invoice?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn mt-3 btn-danger">Delete Invoice</button>
                    </form>


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
@endsection
