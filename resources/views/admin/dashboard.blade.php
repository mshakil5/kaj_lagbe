@extends('admin.layouts.admin')

@section('content')


  <!-- content area -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row pt-3">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <a href="{{ route('admin.new') }}">
              <div class="small-box bg-success">
                  <div class="inner">
                      <h5>New Job</h5>
                      <p>Newly created Jobs</p>
                  </div>
                  <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                  </div>
              </div>
          </a>
        </div>
        <div class="col-lg-3 col-6">
            <a href="{{ route('admin.processing') }}">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h5>Job In Progress</h5>
                        <p>Jobs are in progress</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-6">
            <a href="{{ route('admin.complete') }}">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h5>Completed</h5>
                        <p>Completed Jobs</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </a>
        </div>
      </div>

      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>

@endsection

@section('script')


<script>
    
</script>

@endsection
