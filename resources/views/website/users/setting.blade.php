@extends('website.base')

@section('style')
<link rel="stylesheet" href="{{ asset('web/mycss/editProfile.css') }}" />
@endsection

@section('main')
<!-- setting -->
<section class="setting">
    <div class="container-fluidd">
    </div>

    <div class="main">
        <h2>Edit Profile</h2>
        <form action="{{ route('profile.update', $user->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="img">
                <div class="image">
                    <img id="currentImage"
                        src="{{ $user->image ? asset('storage/' . $user->image) : 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}"
                        alt="User Image" class="rounded-circle" height="50px" width="50px">
                </div>

                <div class="image-upload">
                    <input type="file" name="image" id="imageUpload" accept=".png, .jpg, .jpeg"
                        onchange="previewNewImage(event)">
                </div>
            </div><br><br>

            <div class="form-group">
                <input type="hidden" id="name" name="email" value="{{ $user->email }}">
            </div>
            <div class="form-group">
                <label>Name</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}">
            </div>
            <div class="form-group">
                <label>Usn</label>
                <input type="text" id="usn" name="username" value="{{ $user->username }}">
            </div>
            <div class="form-group">
                <label>Bio</label>
                <input type="text" name="bio" id="bio" value="{{ $user->bio }}">
            </div>
            <div class="form-group">
                <label>Pw</label>
                <input type="password" name="password" id="password">
            </div>
            <br>
            <div class="button">
                <button type="submit" class="btn btn rounded-pill fw-semibold save"> Save Update</button>

                <button type="button" class="btn btn rounded-pill fw-semibold cancel"
                    onclick="window.location.reload()">Cancel</button>
            </div>
        </form>
    </div>
</section>
<!-- end setting -->
@endsection

@section('script')
<script>
    function previewNewImage(event) {
        const input = event.target;
        const currentImage = document.getElementById('currentImage');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                currentImage.src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
@endsection
