<div class="column is-3">
    <div class="card" style="border-radius: 8px;">
        <header class="card-header">
            <p class="card-header-title">
                <a href="{{ $deck->link }}">{{ $deck->title }}</a>
            </p>
            <span class="card-header-icon">
                {{ $deck->likes }}
                <span class="icon is-small" style="margin-left: 5px;">
                    <i class="fa fa-fw fa-heart" style="color: red;"></i>
                </span>
            </span>
        </header>
        <div class="card-content">
            <div class="content">
                by 
                @if(isset( $deck->user ))
                    {{ $deck->user->name }}
                @else
                    Anonymous
                @endif
                <br/>
                <small>last sleeved {{ $deck->updated_at->diffForHumans() }}</small>
                <br/><br/>
                <div class="field">
                    @foreach( json_decode( $deck->tags ) as $tag )
                        <span class="tag is-light single-tag">
                            {{ $tag }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
        <footer class="card-footer">
            <div class="card-footer-item">
                <span class="has-text-centered">
                    @foreach( json_decode($deck->colors) as $color )
                        <span class="ms ms-cost ms-{{ strtolower( $color ) }}"></span>
                    @endforeach
                </span>
            </div>
            <a class="card-footer-item" href="{{ $deck->link }}">View <i class="fa fa-fw fa-chevron-right"></i></a>
        </footer>
    </div>
</div>