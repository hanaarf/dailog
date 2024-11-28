@extends('template.index')

@section('title', 'posts')

@section('style')
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
        <div class="project-nav">
            <div class="card-action card-tabs  mr-auto">
                <ul class="nav nav-tabs style-2">
                    <li class="nav-item">
                        <a href="#navpills-1" class="nav-link active" data-toggle="tab" aria-expanded="false">All Blog
                            <span class="badge badge-pill shadow-primary badge-primary">{{ $post->count() }}</span></a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="#navpills-4" class="nav-link" data-toggle="tab" aria-expanded="true">Reported blog
                            <span class="badge badge-pill badge-danger shadow-danger">1</span></a>
                    </li> --}}
                </ul>
            </div>
        </div>
      
        <div class="tab-content project-list-group" id="myTabContent">
            <div class="tab-pane fade active show" id="navpills-1">
                @foreach ($post as $row)
                <div class="card">
                    <div class="project-info">
                        <div class="col-xl-2 my-2 col-lg-4 col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="project-media">
                                    <img class="rounded-circle" width="35"
                                        src="{{ asset('storage/' . $row->thumbnail) }}"
                                        alt="User Avatar">
                                </div>
                                <div class="ml-2">
                                    <span>User</span>
                                    <h5 class="mb-0 pt-1 font-w50 text-black">{{ $row->user->username}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 my-2 col-lg-4 col-sm-6 mr-2">
                            <h5 class="title font-w600 mb-2"><a href="post-details.html" class="text-black">{{ $row->title}}</a></h5>
                            <div class="text-dark"
                                style="text-overflow: ellipsis; display: -webkit-box; overflow: hidden; white-space: nowrap;text-overflow: ellipsis">
                                {{ strip_tags($row->content) }}
                            </div>

                        </div>
                        <div class="col-xl-3 my-2 col-lg-6 col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="ml-2">
                                    <span class="text-black">Created on</span>
                                    <h5 class="mb-0 pt-1 font-w500 text-black">{{ $row->created_at->format('d F Y') }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-1 my-2 col-lg-6 col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="ml-2">
                                    <a href="{{ route('a.show.post', $row->id)}}" class="btn btn-primary">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
