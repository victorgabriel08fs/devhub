<div class="col">
    <div class="card mt-4">
        @isset($describe->title)
            <div class="card-header">
                <h3>{{ $describe->title }}</h3>
            </div>
        @endisset
        <div class="card-body">
            <div class="row image-block image-gradient-{{ $describe->color }}">
                @isset($describe->content)
                    <div class="col p-4 {{ isset($describe->image) ? 'me-5' : '' }}">
                        {{ $describe->content }}
                    </div>
                @endisset
                @isset($describe->image)
                    <div class="col">
                        <img data-bs-toggle="modal" class=""
                            data-bs-target="#imageModal{{ $describe->id }}" width="3000"
                            src="{{ asset($describe->image) }}" alt="">
                    </div>
                    @include('project._partials.image_modal')
                @endisset
            </div>
        </div>
    </div>
</div>