<tr>
    <td>
        @foreach( json_decode($deck->colors) as $color )
            <span class="ms ms-cost ms-{{ strtolower( $color ) }}"></span>
        @endforeach
    </td>
    <th>{{ $deck->title }}</th>
    <td>{{ $deck->format }}</td>
    <td>
    @if(isset( $deck->owner_id ))
        {{ $deck->owner_id }}
    @else
        Anonymous
    @endif
    </td>
    <td class="has-text-right"><a href="{{ $deck->link }}" class="button is-primary is-small">View <i class="fa fa-fw fa-chevron-right"></i></a></td>    
</tr>