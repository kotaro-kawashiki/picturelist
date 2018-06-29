@section
{{-- Image view start --}}
        @if (!empty($post->fig_name))
            <div style="padding:10px">
                <a href="http://localhost/my_bbs/public/media/{{ $post->fig_name}}" 
                    data-lightbox="image-1">
                <img src="http://localhost/my_bbs/public/media/mini/{{ $post->fig_name}}"
                    alt="test" height="400" width="400"/>
                </a>
            </div>
        @endif
{{-- Image view end --}}
@endsection