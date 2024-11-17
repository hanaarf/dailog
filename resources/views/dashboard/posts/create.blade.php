@extends('template.index')

@section('title', 'tambah blog')

@section('style')
@endsection

@section('main')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Tambah Blog</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('simpan.post') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        
                            <div class="form-group">
                                <label for="thumbnail">Thumbnail</label>
                                <div class="image-upload">
                                    <input type="file" id="thumbnail" name="thumbnail" accept="image/*">
                                    <label for="thumbnail" id="thumbnailLabel">Choose Image</label>
                                </div>
                            </div>
                        
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                        
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea class="form-control" id="editor" name="content" rows="10" cols="80" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- CKEditor CDN Script -->
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: "{{ route('upload.image') }}?_token={{ csrf_token() }}"
            },
            image: {
                resizeOptions: [{
                        name: 'resizeImage:original',
                        value: null,
                        icon: 'original'
                    },
                    {
                        name: 'resizeImage:50',
                        value: '50',
                        icon: 'small'
                    },
                    {
                        name: 'resizeImage:100',
                        value: '100',
                        icon: 'medium'
                    }
                ]
            }
        })
        .catch(error => {
            console.error(error);
        });

</script>

@endsection
