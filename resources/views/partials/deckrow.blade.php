<tr>
    <td>
        <span class="ms ms-cost ms-r"></span>
        <span class="ms ms-cost ms-w"></span>
        <span class="ms ms-cost ms-g"></span>
        <span class="ms ms-cost ms-u"></span>
        <span class="ms ms-cost ms-b"></span>
    </td>
    <th>{{ $deck->title }}</th>
    <td>{{ $deck->format }}</td>
    <td>
    @if(isset( $deck->owner_id ))
        {{ $deck->owner_id }}
    @else
        Anonymous {{ $deck->link }}
    @endif
    </td>
    <td class="has-text-right"><a href="{{ $deck->link }}" class="button is-primary is-small">View <i class="fa fa-fw fa-chevron-right"></i></a></td>    
</tr>