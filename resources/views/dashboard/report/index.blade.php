@extends('template.index')

@section('title', 'data user')

@section('style')
<link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
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
                    <span>{{ Auth::user()->name }}</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Datatable</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Report</h4>
                    </div>
                    <div class="card-body">

                        @if (Session::get('Sukses'))

                        <div class="alert alert-success alert-dismissible fade show">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                                fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg>
                            <strong>Success!</strong> {{ Session::get('Sukses') }}
                            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                                        class="mdi mdi-close"></i></span>
                            </button>
                        </div>
                        @endif
                        @if (Session::get('Delete'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('Delete') }}
                            <button class="close" type="button" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="table-responsive">
                            <table id="example3" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="8%">thumbnail</th>
                                        <th>title</th>
                                        <th>count report</th>
                                        <th>created by</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($report as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img class="rounded-circle" width="35" height="35"
                                                src="{{ asset('storage/' . $row->post->thumbnail) }}" alt="">
                                        </td>
                                        <td>{{ $row->post->title }}</td>
                                        <td>{{ $row->total_report }}</td>
                                        <td>{{ $row->post->user->name }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <button type="button" class="btn btn-primary shadow sharp mr-1"
                                                    data-toggle="modal" data-target="#detailreport-{{ $row->post_id }}">
                                                    <i class="fa fa-eye"></i>
                                                </button>

                                                <!-- Modal show -->
                                                <div class="modal fade" id="detailreport-{{ $row->post_id }}"
                                                    tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Detail Report for
                                                                    "{{ $row->post->title }}"</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h6>Reported by:</h6>
                                                                <ul>
                                                                    @php
                                                                    $details = App\Models\Report::where('post_id',
                                                                    $row->post_id)->with('user')->get();
                                                                    @endphp
                                                                    @foreach ($details as $detail)
                                                                    <li>
                                                                        <strong>{{ $detail->user->name }}</strong>:
                                                                        {{ $detail->reason }}
                                                                    </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                               
                                                <form action="{{ route('r.delete.post', $row->post_id) }}" method="POST" class="d-inline"
                                                    onsubmit="return confirmDeleteBlog()">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-warning shadow sharp mr-1">
                                                        Delete blog
                                                    </button>
                                                </form>

                                                <a href="#" onclick="confirmDelete({{ $row->post_id }})"
                                                    class="btn btn-danger shadow sharp">
                                                   delete report
                                                </a>

                                                <form id="delete-form-{{ $row->post_id }}"
                                                    action="{{ route('report.destroy', $row->post_id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(post_id) {
        Swal.fire({
            title: 'Yakin hapus?',
            text: "Data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${post_id}`).submit();
            }
        });
    }

</script>

@endsection

@section('script')
<script>
    function confirmDeleteBlog() {
       return confirm("Apakah Anda yakin ingin menghapus post ini? Gambar juga akan dihapus.");
   }
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
@endsection
