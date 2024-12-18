@extends('website.base')

@section('style')
<link rel="stylesheet" href="{{ asset('web/mycss/show.css') }}" />
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('main')
<!-- main  -->
<section class="main">
    <div class="thumbnail">
        <div class="img">
            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="" class="img-fluid">
            <div class="act">
                @php
                $isLiked = $post->likes->contains('user_id', Auth::id());
                @endphp
                <button class="like-btn" data-post-id="{{ $post->id }}"
                    style="border: none; background-color: transparent">
                    <i class="{{ $isLiked ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}"></i>
                </button>
                <p>{{ $post->likes->count() }}</p>
                <i class="fa-solid fa-comment" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></i>
                <p>{{ $commentsCount }}</p>
                <button class="bookmark-btn" data-post-id="{{ $post->id }}"
                    style="border: none; background-color: transparent">
                    <i
                        class="fa {{ auth()->user()->bookmarks->contains('post_id', $post->id) ? 'fa-solid fa-bookmark' : 'fa-regular fa-bookmark' }}"></i>
                </button>
            </div>
        </div>
        <div class="judul">
            <h1>{{ $post->title }}</h1>
            <p>by {{ $post->user->username }}</p>
            <p>{{ $post->created_at->format('d F Y') }}</p>
            <button class="btn-copy">
                <i class="fa-solid fa-link" id="copy-link"></i> <span id="copy-text">Copy Link</span>
            </button>
        </div>
    </div>
    <div class="content">
        <div class="isi">
            {!! $post->content !!}
        </div>
    </div>
</section>
<!-- end main -->

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($comments->isEmpty())
                <div class="belum d-flex flex-column justify-content-center align-items-center pt-5 pb-5">
                    <p>Belum ada komentar di blog ini</p>
                    <img src="{{ asset('web/img/home-l/sad-face-82.svg') }}" alt="" height="200px">
                </div>
                @else
                @foreach($comments as $comment)
                <div class="d-flex align-items-center">
                    @if($comment->user->image)
                    <img src="{{ asset('storage/' . $comment->user->image) }}" alt="User Image" width="35" height="35"
                        class="rounded-circle">
                    @else
                    <img class="rounded-circle" width="35" height="35"
                        src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}" alt="User Avatar">
                    @endif

                    <div class="ms-3">
                        <p class="mt-3"><strong
                                class="me-3">{{ $comment->user->username }}</strong>{{ $comment->comment }}
                        </p>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            <div class="modal-footer d-flex justify-content-start">
                <form action="{{ route('comments.store', $post->id) }}" method="POST"
                    class="d-flex align-items-center w-100">
                    @csrf
                    <div class="input-container d-flex w-100">
                        <input type="text" name="comment" class="form-control rounded-pill me-2"
                            placeholder="comment..">
                        <button type="submit" class="btn rounded-circle">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = function () {
        @if(session('openModal'))
        var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
        myModal.show();
        @endif
    }

</script>

@endsection

@section('script')
{{-- like --}}
<script>
    document.querySelectorAll('.like-btn').forEach(button => {
        button.addEventListener('click', function () {
            const postId = this.getAttribute('data-post-id');
            const isLiked = this.querySelector('i').classList.contains('fa-solid');

            fetch(isLiked ? '/U/unlike' : '/U/like', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        post_id: postId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                        this.querySelector('i').classList.toggle('fa-solid');
                        this.querySelector('i').classList.toggle('fa-regular');
                    }
                });
        });
    });

</script>

{{-- copy url tautan --}}
<script>
    document.getElementById("copy-link").addEventListener("click", copyToClipboard);
    document.getElementById("copy-text").addEventListener("click", copyToClipboard);

    function copyToClipboard() {
        const url = window.location.href; // Ambil URL halaman
        navigator.clipboard.writeText(url).then(() => {
            // Menampilkan dialog custom di tengah atas
            showCustomDialog("Link berhasil disalin ke clipboard!");
        }).catch(err => {
            console.error("Gagal menyalin link: ", err);
        });
    }

    // Fungsi untuk menampilkan dialog custom
    function showCustomDialog(message) {
        // Membuat elemen dialog
        const dialog = document.createElement("div");
        dialog.textContent = message;
        dialog.style.position = "fixed";
        dialog.style.top = "20px"; // Posisikan di tengah atas
        dialog.style.left = "50%"; // Gunakan 50% dari lebar layar
        dialog.style.transform = "translateX(-50%)"; // Pastikan dialog terpusat secara horizontal
        dialog.style.padding = "10px 20px";
        dialog.style.backgroundColor = "#4CAF50";
        dialog.style.color = "#fff";
        dialog.style.borderRadius = "5px";
        dialog.style.boxShadow = "0 4px 6px rgba(0,0,0,0.1)";
        dialog.style.zIndex = "1000";
        dialog.style.fontSize = "14px";
        dialog.style.transition = "opacity 0.3s ease";

        document.body.appendChild(dialog);

        // Menghapus dialog setelah 3 detik
        setTimeout(() => {
            dialog.style.opacity = "0";
            setTimeout(() => {
                dialog.remove();
            }, 300);
        }, 3000);
    }

</script>

{{-- bookmark --}}
<script>
    document.querySelectorAll('.bookmark-btn').forEach(button => {
        button.addEventListener('click', function () {
            // Ambil ID post dari data attribute
            const postId = this.dataset.postId;

            // Ambil elemen ikon di dalam tombol
            const icon = this.querySelector('i');

            // Kirim permintaan POST untuk toggle bookmark
            fetch('/U/bookmark', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        post_id: postId
                    })
                })
                .then(response => {
                    // Cek apakah respons berhasil
                    if (!response.ok) {
                        throw new Error('Gagal mengupdate bookmark.');
                    }
                    return response.json();
                })
                .then(data => {
                    // Update ikon berdasarkan status bookmark
                    if (data.status === 'bookmarked') {
                        icon.classList.remove('fa-regular');
                        icon.classList.add('fa-solid');
                    } else if (data.status === 'unbookmarked') {
                        icon.classList.remove('fa-solid');
                        icon.classList.add('fa-regular');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi masalah saat mengupdate bookmark.');
                });
        });
    });

</script>

@endsection
