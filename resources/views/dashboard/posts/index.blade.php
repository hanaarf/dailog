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
                            <span class="badge badge-pill shadow-primary badge-primary">154</span></a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="#navpills-4" class="nav-link" data-toggle="tab" aria-expanded="true">Reported blog
                            <span class="badge badge-pill badge-danger shadow-danger">1</span></a>
                    </li> --}}
                </ul>
            </div>
            <a href="{{ route('create.post')}}" class="btn btn-primary">+New Blog</a>
        </div>
        <div class="tab-content project-list-group" id="myTabContent">
            <div class="tab-pane fade active show" id="navpills-1">
                <div class="card">
                    <div class="project-info">
                        <div class="col-xl-2 my-2 col-lg-4 col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="project-media">
                                    <img src="{{ asset('images/users/pic1.jpg') }}" alt="">
                                </div>
                                <div class="ml-2">
                                    <span>User</span>
                                    <h5 class="mb-0 pt-1 font-w50 text-black">Alex Noer</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 my-2 col-lg-4 col-sm-6 mr-2">
                            <h5 class="title font-w600 mb-2"><a href="post-details.html" class="text-black">8 tips to
                                    develop motion</a></h5>
                            <div class="text-dark"
                                style="text-overflow: ellipsis; display: -webkit-box; overflow: hidden; white-space: nowrap;text-overflow: ellipsis">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit cum laboriosam adipisci!
                                Voluptates quas in, architecto modi distinctio molestias cupiditate accusamus cumque
                                voluptatem dolor numquam mollitia! Eligendi placeat soluta asperiores consequuntur
                                impedit corporis quo ipsum molestias quidem qui aperiam earum aut voluptates quasi
                                provident commodi delectus fuga, quae excepturi mollitia accusantium iure. Aliquam
                                doloribus commodi animi dolorem, temporibus ea similique assumenda, voluptatem maiores
                                quibusdam, cupiditate aspernatur porro provident dolor officiis reprehenderit cum ad
                                adipisci ullam repudiandae laudantium quia autem quod labore? Adipisci optio dolorem
                                eum, aspernatur in sunt, quaerat, quos deleniti qui officia doloremque ut reprehenderit
                                enim laborum quas minima?
                            </div>

                        </div>
                        <div class="col-xl-3 my-2 col-lg-6 col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="ml-2">
                                    <span class="text-black">Created on</span>
                                    <h5 class="mb-0 pt-1 font-w500 text-black">Tuesday,Sep 29th 2020</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="project-info">
                        <div class="col-xl-2 my-2 col-lg-4 col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="project-media">
                                    <img src="{{ asset('images/users/pic1.jpg') }}" alt="">
                                </div>
                                <div class="ml-2">
                                    <span>User</span>
                                    <h5 class="mb-0 pt-1 font-w50 text-black">Alex Noer</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 my-2 col-lg-4 col-sm-6 mr-2">
                            <h5 class="title font-w600 mb-2"><a href="post-details.html" class="text-black">8 tips to
                                    develop motion</a></h5>
                            <div class="text-dark"
                                style="text-overflow: ellipsis; display: -webkit-box; overflow: hidden; white-space: nowrap;text-overflow: ellipsis">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit cum laboriosam adipisci!
                                Voluptates quas in, architecto modi distinctio molestias cupiditate accusamus cumque
                                voluptatem dolor numquam mollitia! Eligendi placeat soluta asperiores consequuntur
                                impedit corporis quo ipsum molestias quidem qui aperiam earum aut voluptates quasi
                                provident commodi delectus fuga, quae excepturi mollitia accusantium iure. Aliquam
                                doloribus commodi animi dolorem, temporibus ea similique assumenda, voluptatem maiores
                                quibusdam, cupiditate aspernatur porro provident dolor officiis reprehenderit cum ad
                                adipisci ullam repudiandae laudantium quia autem quod labore? Adipisci optio dolorem
                                eum, aspernatur in sunt, quaerat, quos deleniti qui officia doloremque ut reprehenderit
                                enim laborum quas minima?
                            </div>

                        </div>
                        <div class="col-xl-3 my-2 col-lg-6 col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="ml-2">
                                    <span class="text-black">Created on</span>
                                    <h5 class="mb-0 pt-1 font-w500 text-black">Tuesday,Sep 29th 2020</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <nav class="mt-5">
                    <ul class="pagination pagination-gutter pagination-primary no-bg">
                        <li class="page-item page-indicator">
                            <a class="page-link" href="javascript:void(0)">
                                <i class="la la-angle-left"></i></a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="javascript:void(0)">1</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)">4</a></li>
                        <li class="page-item page-indicator">
                            <a class="page-link" href="javascript:void(0)">
                                <i class="la la-angle-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
