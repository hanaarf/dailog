@extends('template.index')

@section('title', 'tambah data post')

@section('style')
<style type="text/css">
    .ck-editor__editable_inline{
        height: 450px;
    }
</style>
@endsection

@section('main')
<div class="content-body">
    <div class="container-fluid">
        <!-- Add Project -->
        <div class="modal fade" id="addProjectSidebar">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Project</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label class="text-black font-w500">Project Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="text-black font-w500">Deadline</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="text-black font-w500">Client Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-primary">CREATE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, welcome back!</h4>
                    <span>Element</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Form</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Element</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form tambah post</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('simpan.post') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="image-placeholder">
                                    <div class="avatar-edit">
                                        <input type="file" name="thumbnail" id="imageUpload" accept=".png, .jpg, .jpeg">
                                        <label for="imageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview" style="background-image: url('{{ asset('images/contacts/user.jpg') }}');">
                                        </div>
                                    </div>
                                </div> 
                                <div class="form-row mt-5">
                                    <div class="form-group col-md-12">
                                        <label>title</label>
                                        <input type="text" class="form-control" name="title" placeholder="title">
                                    </div>
                                </div>
                                <div class="form-row mt-2">
                                    <div class="form-group col-md-12">
                                        <label>content</label>
                                        <textarea class="form-control" id="editor" name="content" rows="10" cols="80" required></textarea>
                                    </div>
                                </div>
                    
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/dashboard/contact.js') }}"></script>

<!-- CKEditor CDN Script -->
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>

{{-- <script>
    let editorInstance;
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: "{{ route('upload.image') }}?_token={{ csrf_token() }}"
            },
            image: {
                resizeOptions: [
                    { name: 'resizeImage:original', value: null, icon: 'original' },
                    { name: 'resizeImage:50', value: '50', icon: 'small' },
                    { name: 'resizeImage:100', value: '100', icon: 'medium' }
                ]
            }
        })
        .then(editor => {
            editorInstance = editor;
        })
        .catch(error => {
            console.error(error);
        });

    // Update textarea content before form submission
    document.querySelector('form').addEventListener('submit', (event) => {
        if (editorInstance) {
            document.querySelector('#editor').value = editorInstance.getData();
        }
    });
</script> --}}

<script>
    ClassicEditor
    .create( document.querySelector( '#editor'),
    {
        ckfinder:
        {
            uploadUrl:"{{route('ckeditor.upload',['_token'=>csrf_token()])}}",
        }
    } )
    .catch( error => {
        console.error( error );
    } );
</script>


@endsection