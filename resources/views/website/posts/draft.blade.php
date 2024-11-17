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
                    <li><a href="">Following</a></li>
                    <li><a href="">Liked</a></li>
                    <li><a href="">Mark</a></li>
                    <li><a href="{{ route('index.draft')}}" class="active">Draft</a></li>
                </ul>
            </div>
            <hr>
            @foreach ($post as $row)
            <a href="{{ route('show.post', $row->id) }}" class="blog">
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
                                <p>0</p>
                            </div>
                        </div>
                    </div>
                    <div class="right-content">
                        <img src="{{ asset('storage/' . $row->thumbnail) }}" alt="Placeholder Image" class="img-fluid">
                    </div>
                </div>
                <hr>
            </a>
            @endforeach

        </div>
        <div class="right">
            <h5>Recomend for you</h5>
            @foreach ($randomPost as $row)
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
                </div>
            </div>
            @endforeach
           
            <h5 class="mt-5">Staff picks</h5>
            @foreach ($randomUser as $row)
            <div class="follow">
                <div class="user">
                    @if($row->image)
                        <img src="{{ asset('storage/' . $row->image) }}" alt="User Image" width="35"
                            height="35" class="rounded-circle">
                        @else
                        <img class="rounded-circle" width="35"
                            src="https://ui-avatars.com/api/?name={{ urlencode($row->name) }}"
                            alt="User Avatar">
                        @endif
                    <p>{{ $row->username }}</p>
                </div>
                <a href="">Follow</a>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@section('script')

@endsection
