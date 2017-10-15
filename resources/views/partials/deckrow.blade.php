<tr>
    <td>
        @foreach( json_decode($deck->colors) as $color )
            <span class="ms ms-cost ms-{{ strtolower( $color ) }}"></span>
        @endforeach
    </td>
    <th><a href="{{ $deck->link }}">{{ $deck->title }}</a></th>
    <td>{{ $deck->format }}</td>
    <td>
        @if(isset( $deck->user ))
            {{ $deck->user->name }}
        @else
            Anonymous
        @endif
    </td>
    <td>{{ $deck->created_at->diffForHumans() }}</td>
</tr>