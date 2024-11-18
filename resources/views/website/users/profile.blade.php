@extends('website.base')

@section('style')
<link rel="stylesheet" href="{{ asset('web/mycss/profile.css') }}" />
@endsection

@section('main')

<div class="profile">
    <div class="container-fluidd">
        <div class="img">
            @if($user->image)
            <img src="{{ asset('storage/' . $user->image) }}" alt="User Image" width="35" height="35"
                class="rounded-circle">
            @else
            <img class="rounded-circle" width="35" height="35"
                src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}" alt="User Avatar">
            @endif
        </div>
    </div>

    <div class="main">
        <h2>{{ $user->username }}</h2>
        <p><strong>{{ $user->name }}</strong> <br> {{ $user->bio }}</p>
        <div class="text">
            <p data-bs-toggle="modal" data-bs-target="#follower" style="cursor: pointer;">0 Followers </p>
            <p data-bs-toggle="modal" data-bs-target="#following" style="cursor: pointer;">0 Following </p>
            <p>0 Post</p>
        </div>

        <div class="button">
            @if (Auth::id() === $user->id)
            <a href="{{ route('profile.edit', $user->id) }}" class="btn btn rounded-pill fw-semibold" type="submit">Edit
                Profile</a>
            @else
            <a href="#" class="btn btn rounded-pill fw-semibold" type="submit">Follow</a>
            @endif
        </div>
        <br>
        <hr style="color: #a1a3b6;">
    </div>
</div>

<!-- main body -->
<section class="main">
    <div class="container">
        <div class="left">
            <div class="klik">
                <ul>
                    @if (Auth::id() === $user->id)
                    <li><a href="#" id="all-posts-btn" class="active">All Post</a></li>
                    <li><a href="#" id="drafts-btn">Draft</a></li>
                    @else
                    <li><a href="#" id="all-posts-btn" class="active">All Post</a></li>
                    @endif
                </ul>
            </div>
            <hr style="color: #a1a3b6;">

            
            <!-- Foreach Post -->
            <div class="post">
                @foreach ($post as $row)
                <div class="blog">
                    <div class="kartu">
                        <div class="left-content">
                            <div class="user">
                                @if($row->user->image)
                                <img src="{{ asset('storage/' . $row->user->image) }}" alt="User Image" width="35"
                                    height="35" class="rounded-circle">
                                @else
                                <img class="rounded-circle" width="35"
                                    src="https://ui-avatars.com/api/?name={{ urlencode($row->user->name) }}"
                                    alt="User Avatar">
                                @endif
                                <p>by {{ $row->user->name }}</p>
                            </div>
                            <h1>{{ $row->title }}</h1>
                            <p>{{ strip_tags($row->content) }}</p>
                            <div class="userr">
                                <div class="tanggal d-flex gap-2">
                                    <i class="fa-regular fa-calendar"></i>
                                    <p>{{ $row->created_at->format('d F Y') }}</p>
                                </div>
                                <div class="like d-flex gap-2">
                                    {{-- <i class="fa-solid fa-heart islike" style="display: none; cursor: pointer;"></i> --}}
                                    <i class="fa-regular fa-heart nolike" style="cursor: pointer;"></i>
                                    <p>{{ $row->likes->count() }}</p>
                                    <i class="fa-solid fa-comment"></i>
                                    <p>{{ $row->comments->count() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="right-content">
                            <img src="{{ asset('storage/' . $row->thumbnail) }}" alt="Placeholder Image"
                                class="img-fluid">

                            @if (Auth::id() === $user->id)
                            <a href="{{ route('user.edit.post', $row->id) }}"><i class="fa-solid fa-pen edit-icon"></i></a>

                            <form action="{{ route('destroy.post', $row->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn"
                                    style="background: none; border: none; padding: 0;">
                                    <i class="fa-solid fa-trash hapus-icon"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                @endforeach
            </div>

            <!-- Foreach Draft -->
            <div class="draft" style="display: none;">
                @foreach ($draft as $row)
                <div class="blog">
                    <div class="kartu">
                        <div class="left-content">
                            <div class="user">
                                @if($row->user->image)
                                <img src="{{ asset('storage/' . $row->user->image) }}" alt="User Image" width="35"
                                    height="35" class="rounded-circle">
                                @else
                                <img class="rounded-circle" width="35"
                                    src="https://ui-avatars.com/api/?name={{ urlencode($row->user->name) }}"
                                    alt="User Avatar">
                                @endif
                                <p>by {{ $row->user->name }}</p>
                            </div>
                            <h1>{{ $row->title }}</h1>
                            <p>{{ strip_tags($row->content) }}</p>
                            <div class="userr">
                                <div class="tanggal d-flex gap-2">
                                    <i class="fa-regular fa-calendar"></i>
                                    <p>{{ $row->created_at->format('d F Y') }}</p>
                                </div>
                                <div class="like d-flex gap-2">
                                    {{-- <i class="fa-solid fa-heart islike" style="display: none; cursor: pointer;"></i> --}}
                                    <i class="fa-regular fa-heart nolike" style="cursor: pointer;"></i>
                                    <p>{{ $row->likes->count() }}</p>
                                    <i class="fa-solid fa-comment"></i>
                                    <p>{{ $row->comments->count() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="right-content">
                            <img src="{{ asset('storage/' . $row->thumbnail) }}" alt="Placeholder Image"
                                class="img-fluid">
                            @if (Auth::id() === $user->id)
                            <a href="{{ route('user.edit.post', $row->id) }}"><i class="fa-solid fa-pen edit-icon"></i></a>

                            <form action="{{ route('destroy.post', $row->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn"
                                    style="background: none; border: none; padding: 0;">
                                    <i class="fa-solid fa-trash hapus-icon"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                @endforeach
            </div>

        </div>
        <div class="right">
            <h5>Recomend for you</h5>
            @foreach ($randomPost as $row)
            <div class="kartu">
                <div class="left-content">
                    <div class="user">
                        @if($row->user->image)
                        <img src="{{ asset('storage/' . $row->user->image) }}" alt="User Image" width="35" height="35"
                            class="rounded-circle">
                        @else
                        <img class="rounded-circle" width="35"
                            src="https://ui-avatars.com/api/?name={{ urlencode($row->user->name) }}" alt="User Avatar">
                        @endif
                        <p>by {{ $row->user->name }}</p>
                    </div>
                    <h1>{{ $row->title }}</h1>
                    <p>{{ strip_tags($row->content) }}</p>
                </div>
            </div>
            @endforeach

            <h5 class="mt-5">Staff picks</h5>
            @foreach ($randomUser as $row)
            <div class="follow">
                <div class="user">
                    @if($row->image)
                    <img src="{{ asset('storage/' . $row->image) }}" alt="User Image" width="35" height="35"
                        class="rounded-circle">
                    @else
                    <img class="rounded-circle" width="35"
                        src="https://ui-avatars.com/api/?name={{ urlencode($row->name) }}" alt="User Avatar">
                    @endif
                    <p>{{ $row->username }}</p>
                </div>
                <a href="">Follow</a>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- end main body -->

<div class="modal fade" id="follower" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
        </div>
    </div>
</div>

<!-- modal following -->
<div class="modal fade" id="following" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function confirmDelete() {
        return confirm("Apakah Anda yakin ingin menghapus post ini? Gambar juga akan dihapus.");
    }

    document.addEventListener("DOMContentLoaded", function () {
        const allPostsBtn = document.getElementById("all-posts-btn");
        const draftsBtn = document.getElementById("drafts-btn");
        const postContainer = document.querySelector(".post");
        const draftContainer = document.querySelector(".draft");

        // Fungsi untuk menampilkan All Posts
        allPostsBtn.addEventListener("click", function (e) {
            e.preventDefault(); // Mencegah reload halaman
            postContainer.style.display = "block";
            draftContainer.style.display = "none";

            // Update class aktif
            allPostsBtn.classList.add("active");
            draftsBtn.classList.remove("active");
        });

        // Fungsi untuk menampilkan Drafts
        draftsBtn.addEventListener("click", function (e) {
            e.preventDefault(); // Mencegah reload halaman
            postContainer.style.display = "none";
            draftContainer.style.display = "block";

            // Update class aktif
            draftsBtn.classList.add("active");
            allPostsBtn.classList.remove("active");
        });
    });

</script>
@endsection
