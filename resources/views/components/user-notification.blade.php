
<li class="dropdown dropdown-slide">
    <button class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
       data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">
        Notifications @if($unreadCount)<span class="badge badge-info">{{ $unreadCount }}</span>@endif
    </button>
    <ul class="dropdown-menu">
        @foreach($notifications as $notification)
            <li>
                <a href="{{ $notification->data['url'] . '?nid='. $notification->id }}">
                    @if($notification->unread()) <b>*</b>@endif
                    {{ $notification->data['body'] }}
                    <br>
                    <small class="text-muted">{{ $notification->created_at->diffForHumans(null,true,true) }}</small>
                </a>
            </li>
        @endforeach
    </ul>
</li>
