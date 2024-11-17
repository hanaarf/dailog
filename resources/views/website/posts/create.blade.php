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
    <form action="{{ route('user.store.postt')}}" method="POST" enctype="multipart/form-data">

        @csrf
        <input type="file" id="thumbnail" name="thumbnail" accept="image/*">
        <label for="thumbnail" id="thumbnailLabel">Choose Image</label><br><br>

        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>

        <label for="" class="mt-3">blog</label>
        <textarea id="editor" name="content" class="mt-2"></textarea>

         <!-- Hidden field untuk menentukan nilai is_draft -->
         <input type="hidden" id="is_draft" name="is_draft" value="1">

         <!-- Tombol untuk menyimpan sebagai post -->
         <button type="submit" class="btn btn-primary mt-3 mb-5" onclick="document.getElementById('is_draft').value='2'">Post</button>
 
         <!-- Tombol untuk menyimpan sebagai draft -->
         <button type="submit" class="btn btn-secondary mt-3 mb-5">Save as Draft</button>

        {{-- <input type="submit" class="btn btn-primary mt-3 mb-5"> --}}
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
@endsection
