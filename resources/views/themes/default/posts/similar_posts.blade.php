<div class="container">
    <div class="row">
        <h2>Похожие новости</h2>
    </div>
    <div class="row">
        @if($similar)
            @foreach($similar as $s)
                @php
                    /** @var  $s */
                    $result = [];
                    preg_match_all('/<img[^>]*?src=\"(.*)\"/iU', $s->excerpt, $result);
                    (!empty($result[1][0])) ? $image = $result[1][0] : null;
                    $s->excerpt = preg_replace( '/<img[^>]*>/', '', $s->excerpt);
                @endphp
                <div class="col-md-4 mb-3">
                    <div class="card" style="height: 250px;">
                        <img src="{{ $image }}" class="card-img-top" alt="{{ $s->title }}">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('posts.show', $s->slug) }}">{{ $s->title }}</a>
                            </h5>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
