@extends('website.base')

@section('style')
<link rel="stylesheet" href="{{ asset('web/mycss/dailog.css') }}" />
@endsection
@section('main')
<section>
    <div style="display: flex;justify-content: center;align-items: center;margin-top: 50px;margin-bottom: 50px;">
        <img src="{{ asset('web/img/home-l/image.svg') }}" alt="" width="85%">
    </div>
</section>

<section class="main">
    <div class="container">
        <div class="left">
            <div class="klik">
                <ul>
                    <li><a href="{{ route('index.home')}}">For you</a></li>
                    <li><a href="{{ route('index.follow') }}" class="active">Following</a></li>
                    <li><a href="{{ route('index.like') }}">Liked</a></li>
                    <li><a href="{{ route('index.mark') }}">Mark</a></li>
                    <li><a href="{{ route('index.draft')}}">Draft</a></li>
                </ul>
            </div>
            <hr>
            @if($post->isEmpty())
            <p>You haven't followed any posts yet.</p>
            @else
            @foreach ($post as $row)
            <div class="blog">
                <div class="kartu">
                    <div class="left-content">
                        <div class="user">
                            <div class="img">
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
                            <div class="dropdown">
                                <i class="bi bi-three-dots" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false"></i>

                                <ul class="dropdown-menu">
                                    <li> <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#report">
                                            Report Postingan
                                        </button></li>
                                </ul>
                            </div>
                        </div>
                        <h1>{{ $row->title }}</h1>
                        <p>{{ strip_tags($row->content) }}</p>
                        <div class="userr">
                            <div class="tanggal d-flex gap-2">
                                <i class="fa-regular fa-calendar"></i>
                                <p>{{ $row->created_at->format('d F Y') }}</p>
                            </div>
                            <div class="like d-flex gap-2">
                                @php
                                $isLiked = $row->likes->contains('user_id', Auth::id());
                                @endphp
                                <div class="like-btn btn-like" data-post-id="{{ $row->id }}">
                                    <i class="{{ $isLiked ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}"></i>
                                </div>
                                <p>{{ $row->likes->count() }}</p>
                                <i class="fa-solid fa-comment"></i>
                                <p>{{ $row->comments->count() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="right-content">
                        <a href="{{ route('show.post', $row->id) }}">
                            <img src="{{ asset('storage/' . $row->thumbnail) }}" alt="Placeholder Image"
                                class="img-fluid">
                        </a>
                    </div>
                </div>
                <hr>
            </div>
            

            <!-- report Modal -->
            <div class="modal fade" id="report" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Report</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('report.blog') }}" id="reportForm" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $row->id }}">
                            <div class="modal-body">
                                <p>Why are you reporting this post?</p>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="reason" id="reason1"
                                        value="I just don't like it">
                                    <label class="form-check-label" for="reason1">I just don't like it</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="reason" id="reason2"
                                        value="Suicide, self-harm, or eating disorders">
                                    <label class="form-check-label" for="reason2">Suicide, self-harm, or eating
                                        disorders</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="reason" id="reason3"
                                        value="Bullying or unwanted contact">
                                    <label class="form-check-label" for="reason3">Bullying or unwanted contact</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="reason" id="reason4"
                                        value="Violence, hatred or exploitation">
                                    <label class="form-check-label" for="reason4">Violence, hatred or
                                        exploitation</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="reason" id="reason5"
                                        value="Selling or promoting prohibited goods">
                                    <label class="form-check-label" for="reason5">Selling or promoting prohibited
                                        goods</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="reason" id="reason6"
                                        value="Nudity or sexual activity">
                                    <label class="form-check-label" for="reason6">Nudity or sexual activity</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="reason" id="reason7"
                                        value="Fraud, embezzlement, or spam">
                                    <label class="form-check-label" for="reason7">Fraud, embezzlement, or spam</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="reason" id="reason8"
                                        value="False information">
                                    <label class="form-check-label" for="reason8">False information</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-bs-dismiss="modal"
                                    style="background-color: var(--cream); color: var(--secondary);">Cancel</button>
                                <button type="submit" class="btn" form="reportForm"
                                    style="background-color: var(--secondary); color: #fff;">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
            @endif

        </div>
        @include('website.posts.recomend')
    </div>
</section>

@endsection

@section('script')
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
@endsection
