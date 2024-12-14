@extends('website.base')

@section('style')
<link rel="stylesheet" href="{{ asset('web/mycss/dailog.css') }}" />
<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
<style type="text/css">
    .ck-editor__editable_inline {
        height: 500px;
    }

</style>
@endsection

@section('main')
<div class="container mt-5">
    <form action="{{ route('user.update.post', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if($post->thumbnail)
        <label for="thumbnail" class="mt-3">Current Thumbnail</label><br>
        <img id="currentImage" src="{{ asset('storage/' . $post->thumbnail) }}" alt="Current Thumbnail"
            style="max-width: 150px; margin-bottom: 10px;">
        @endif

        <label for="thumbnail" class="mt-3">Change Thumbnail</label>
        <input type="file" id="thumbnail" name="thumbnail" accept="image/*" onchange="previewNewImage(event)">
        <br>

        <label for="title" class="mt-3">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>

        <label for="" class="mt-3">Content</label>
        <textarea id="editor" name="content" class="mt-2">{{ $post->content }}</textarea>

        <!-- Hidden field untuk menentukan nilai is_draft -->
        <input type="hidden" id="is_draft" name="is_draft" value="1">

        <!-- Tombol untuk menyimpan sebagai post -->
        <button type="submit" class="btn mt-3 mb-5"
            onclick="document.getElementById('is_draft').value='2'" style="background-color: var(--cream); color: var(--secondary);">Post</button>

        <!-- Tombol untuk menyimpan sebagai draft -->
        <button type="submit" class="btn mt-3 mb-5" style="background-color: var(--secondary); color: #fff;">Save as Draft</button>
    </form>
</div>
@endsection

@section('script')
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: "{{ route('user.ckeditor.upload', ['_token' => csrf_token()]) }}",
            }
        })
        .catch(error => {
            console.error(error);
        });

</script>

<script>
    function previewNewImage(event) {
        const input = event.target; // Input file element
        const currentImage = document.getElementById('currentImage'); // Current image element

        // Jika ada file yang dipilih
        if (input.files && input.files[0]) {
            const reader = new FileReader(); // Membuat FileReader

            // Saat file selesai dibaca
            reader.onload = function (e) {
                currentImage.src = e.target.result; // Ubah sumber gambar ke file yang diunggah
            };

            reader.readAsDataURL(input.files[0]); // Membaca file sebagai URL data
        }
    }

</script>
@endsection
