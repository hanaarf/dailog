<div class="right">
    <h5>Recomend for you</h5>
    @foreach ($randomPost as $row)
    <a href="{{ route('show.post', $row->id) }}" class="kartu" style="text-decoration: none">
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
    </a>
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
        <a href="{{ route('profile.show', $row->id) }}">See More</a>
    </div>
    @endforeach
</div>