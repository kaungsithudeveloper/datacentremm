@extends('backend.layout.layout')

@section('content')

    <!-- app-content open -->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Create Movie Post</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create Movie</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->

                <div class="container my-5">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <h1 class="text-center mb-4">Search for Movies</h1>

                            <form action="{{ url('/movies/create') }}" method="GET" class="mb-4">
                                <div class="input-group">
                                    <input type="text" name="query" class="form-control" placeholder="Enter movie name" value="{{ request('query') }}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>

                            <h2 class="text-center mb-3">Movies</h2>

                            @if($movies && isset($movies['results']))
                                <div class="list-group">
                                    @foreach($movies['results'] as $movie)
                                        <a href="{{ url('/movies/' . $movie['id']) }}" class="list-group-item list-group-item-action">
                                            <strong>{{ $movie['title'] }}</strong>
                                            <span class="text-muted">({{ $movie['release_date'] }})</span>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-center text-muted">No movies found.</p>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
            <!-- CONTAINER END -->
        </div>
    </div>
    <!-- app-content close -->



@endsection

@push('scripts')
    <!-- tagsinput -->
    <script src="{{ url('backend/plugins/input-tags/js/tagsinput.js') }}"></script>


    <!-- typeahead -->
    <script src="{{ asset('backend/plugins/typeahead/typeahead.bundle.js') }}"></script>

    <!-- INPUT MASK JS -->
    <script src="{{ asset('backend/plugins/input-mask/jquery.mask.min.js') }}"></script>

    <!-- INTERNAL WYSIWYG Editor JS -->
    <script src="{{ asset('backend/plugins/wysiwyag/jquery.richtext.js') }}"></script>
    <script src="{{ asset('backend/plugins/wysiwyag/wysiwyag.js') }}"></script>
@endpush
