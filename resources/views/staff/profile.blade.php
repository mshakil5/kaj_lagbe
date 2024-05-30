@extends('layouts.staff')
@section('content')

<div class="rightBar">
    <div class="ermsg"></div>

    <h4 class=" font-weight-bold text-uppercase mt-3 mb-4">Edit Profile</h4>

    <div class="user-form">
        <div class="left">

            <form action="">
                <div class="form-group">
                    <div class="form-item">
                        <label for="">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $staff->name }}" placeholder="Enter name">
                    </div>
                    <div class="form-item">
                        <label for=""> Company Name </label>
                        <input type="text" id="surname" name="surname" value="{{ $staff->surname }}"class="form-control" placeholder="Enter company name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-item">
                        <label for=""> Email </label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $staff->email }}" placeholder="Enter email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-item">
                        <label for="">Phone Number </label>
                        <input type="number" id="phone" name="phone" value="{{ $staff->phone }}" class="form-control" placeholder="Enter phone">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-item">
                        <label for=""> Address 1</label>
                        <input type="text" id="address_first_line" name="address_first_line" value="{{ $staff->address_first_line }}" class="form-control" placeholder="Enter address first line">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-item">
                        <label for=""> Address 2</label>
                        <input type="text" id="address_second_line" name="address_second_line" value="{{ $staff->address_second_line }}" class="form-control" placeholder="Enter address second line">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-item">
                        <label for="">Town </label>
                        <input type="text" id="town" name="town" value="{{ $staff->town }}" class="form-control" placeholder="Enter town">
                    </div>
                    <div class="form-item">
                        <label for=""> Post Code </label>
                        <input type="text" id="postcode" name="postcode" value="{{ $staff->postcode }}" class="form-control" placeholder="Enter town">
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="form-item">
                        <label for=""> Password </label>
                         <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-item">
                        <label for="">Confirm Password </label>
                         <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Enter confirm password">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-item">
                        <button class="btn-form">Update</button>
                    </div>
                </div>
            </form>

        </div>
        <div class="right">
            <div class="addProfile mt-5">
                <img src="{{ asset('images/staff/'. auth()->user()->photo) }}" alt="" id="photoPreview" class="profile-photo">

                <input type="file" id="photo" class="profile-upload" onchange="previewImage(event)">
            </div>
        </div>
    </div>

</div>

@endsection

@section('script')

<script>
    $('.btn-form').click(function (event) {
        event.preventDefault();

        let name = $("#name").val();
        let surname = $("#surname").val();
        let email = $("#email").val();
        let phone = $("#phone").val();
        let password = $("#password").val();
        let confirm_password = $("#confirm_password").val();
        let addressFirstLine = $("#address_first_line").val();
        let addressSecondLine = $("#address_second_line").val();
        let town = $("#town").val();
        let postcode = $("#postcode").val();
        let photo = $("#photo")[0].files[0]; 

        var formData = new FormData();

        formData.append("name", name);
        formData.append("surname", surname);
        formData.append("email", email);
        formData.append("phone", phone);
        formData.append("password", password);
        formData.append("confirm_password", confirm_password);
        formData.append("address_first_line", addressFirstLine);
        formData.append("address_second_line", addressSecondLine);
        formData.append("town", town);
        formData.append("postcode", postcode);
        if (photo) {
            formData.append("photo", photo);
        }

        $.ajax({
            url: "/staff/update-profile",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            data: formData,
            contentType: false, 
            processData: false,
            dataType: "json",
            success: function (response) {
                if (response.status === 300) {
                    $(".ermsg").html(response.message).removeClass('alert-warning').addClass('alert-success');
                } else {
                    $(".ermsg").html(response.message).removeClass('alert-success').addClass('alert-warning');
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
        });
    });
</script>

<script>
    function previewImage(event) {
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('photoPreview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
</script>


@endsection
