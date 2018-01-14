<tr>
    <td>
        @foreach( json_decode($deck->colors) as $color )
            <span class="ms ms-cost ms-{{ strtolower( $color ) }}"></span>
        @endforeach
    </td>
    <th><a href="{{ $deck->link }}">{{ $deck->title }}</a></th>
    <td>
        <div class="tag is-success is-small">{{ $deck->format }}</div>
    </td>
    <td>
        @if(isset( $deck->user ))
            <a href="{{ route( 'user', $deck->user->name) }}">
                {{ $deck->user->name }}
            </a>
        @else
            Anonymous
        @endif
    </td>
    <td>{{ $deck->created_at->diffForHumans() }}</td>
    <td>{{ $deck->views }}</td>
</tr>