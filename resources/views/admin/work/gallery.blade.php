@extends('admin.layouts.admin')

@section('content')

<!-- Main content -->
<section class="content p-3" id="newBtnSection">
  <div class="container-fluid">
    <div class="row">
      <div class="col-2">
        <a href="{{route('admin.work')}}" class="btn btn-secondary">Go back</a>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->

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
                <a href="{{asset('images/'.$item->name)}}" data-toggle="lightbox" data-title="Image" data-gallery="gallery">
                  <img src="{{asset('images/'.$item->name)}}" class="img-fluid mb-2" alt="Image"/>
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
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })
</script>


<script>
  $(document).ready(function () {

    
      //header for csrf-token is must in laravel
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
      //

      
  });
</script>
@endsection