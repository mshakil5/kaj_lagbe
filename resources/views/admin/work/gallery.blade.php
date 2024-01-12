@extends('admin.layouts.admin')

@section('content')



<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">

      <div class="col-12">
        <div class="card card-secondary">
          <div class="card-header">
            <h4 class="card-title"><b>Gallery</b></h4>
          </div>
          <div class="card-body">
            <div class="row">

              @foreach ($data as $item)
                  
              <div class="col-sm-4">
                <a href="https://via.placeholder.com/1200/FFFFFF.png?text=1" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                  <img src="https://via.placeholder.com/300/FFFFFF?text=1" class="img-fluid mb-2" alt="white sample"/>
                </a>
              </div>
              
              @endforeach


            </div>
          </div>
        </div>
      </div>



    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


@endsection
@section('script')



<script>
  $(document).ready(function () {

    
      //header for csrf-token is must in laravel
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
      //

      
  });
</script>
@endsection