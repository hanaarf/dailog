@extends('website.base')

@section('style')
<link rel="stylesheet" href="{{ asset('web/mycss/search.css') }}" />
<style>
    .btn-active {
        font-weight: bold;
        color: #fff;
        background-color: #007bff;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    .mt-1 {
        cursor: pointer;
        padding: 5px 10px;
    }

    .hidden {
        display: none;
    }

</style>
@endsection

@section('main')
<!-- home -->
<section>
    <div style="display: flex;justify-content: center;align-items: center;margin-top: 50px;margin-bottom: 50px;">
        <img src="{{ asset('web/img/home-l/image.svg') }}" alt="" width="85%">
    </div>
</section>
<!-- end home -->

<!-- main body -->
<section class="main">
    <div class="title">
        <p><a href="{{ route('index.home') }}">Home</a> > {{ $keyword }}</p>
        <h5>Search for {{ $keyword }}</h5>
        <div class="button">
            <div class="btn-active">Blog</div>
            <div class="mt-1">User</div>
        </div>
        <hr>
    </div>

    <div class="container blog">
        <div class="left">
            @forelse ($blogs as $blog)
            <a href="{{ route('show.post', $blog->id) }}" class="blog" id="blogLink">
                <div class="kartu">
                    <div class="left-content">
                        <div class="user">
                            @if($blog->user->image)
                            <img src="{{ asset('storage/' . $blog->user->image) }}" alt="User Image" width="35"
                                height="35" class="rounded-circle">
                            @else
                            <img class="rounded-circle" width="35"
                                src="https://ui-avatars.com/api/?name={{ urlencode($blog->user->name) }}"
                                alt="User Avatar">
                            @endif
                            <p>by {{ $blog->user->username }}</p>
                        </div>
                        <h1>{{ $blog->title }}</h1>
                        <p>{{ strip_tags($blog->content) }}</p>
                        <div class="userr">
                            <div class="tanggal d-flex gap-2">
                                <i class="fa-regular fa-calendar"></i>
                                <p>{{ $blog->created_at->format('d F Y') }}</p>
                            </div>
                            <div class="like d-flex gap-2">
                                <i class="fa-regular fa-heart nolike"></i>
                                <p>0</p>
                                <i class="fa-solid fa-comment" id="commentIcon" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop"></i>
                                <p>{{ $blog->comments->count() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="right-content">
                        <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="Placeholder Image">
                    </div>
                </div>
                <hr>
            </a>
            @empty
            <p>No blogs found.</p>
            @endforelse
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

    <div class="people hidden">
        @forelse ($users as $user)
        <div class="user">
            <div class="div-user">
                <div class="konten"></div>
                <div class="img-prof">
                    @if($user->image)
                    <img src="{{ asset('storage/' . $user->image) }}" alt="User Image" class="rounded-circle"
                        style="width: 70px;height: 70px;border-radius: 50%;">
                    @else
                    <img class="rounded-circle" style="width: 70px;height: 70px;border-radius: 50%;"
                        src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}" alt="User Avatar">
                    @endif
                </div>
                <div class="info">
                    <div class="kiri">
                        <h6>{{ $user->name }}</h6>
                    </div>
                    <div class="kanan">
                        <a href="profile/{{ $user->id }}">See More</a>
                        <i class="fa-solid fa-arrow-right arrow"></i>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <p class="ps-5">No users found.</p>
        @endforelse
    </div>
</section>
<!-- end main body -->
@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const btnBlog = document.querySelector(".btn-active"); // Tombol Blog (default)
        const btnUser = document.querySelector(".mt-1"); // Tombol User
        const containerBlog = document.querySelector(".left"); // Kontainer Blog
        const containerRight = document.querySelector(".right"); // Kontainer Blog
        const containerPeople = document.querySelector(".people"); // Kontainer People

        // Pastikan tampilan awal
        containerBlog.style.display = "block"; // Tampilkan blog
        containerPeople.style.display = "none"; // Sembunyikan people

        // Fungsi untuk menampilkan blog
        btnBlog.addEventListener("click", function () {
            containerBlog.style.display = "block"; // Tampilkan blog
            containerPeople.style.display = "none"; // Sembunyikan people

            btnBlog.classList.add("btn-active"); // Tambah class active ke blog
            btnUser.classList.remove("btn-active"); // Hilangkan class active dari user
        });

        // Fungsi untuk menampilkan user
        btnUser.addEventListener("click", function () {
            containerBlog.style.display = "none"; // Sembunyikan blog
            containerRight.style.display = "none"; // Sembunyikan blog
            containerPeople.style.display = "block"; // Tampilkan people

            btnUser.classList.add("btn-active"); // Tambah class active ke user
            btnBlog.classList.remove("btn-active"); // Hilangkan class active dari blog
        });
    });

</script>
@endsection
