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
                            <h1 class="mb-3">{{ $movie['title'] }}</h1>
                            <img src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="img-fluid mb-4">

                            <p><strong>Release Date:</strong> {{ $movie['release_date'] }}</p>
                            <p><strong>Genres:</strong>
                                @foreach($movie['genres'] as $genre)
                                    {{ $genre['name'] }}@if(!$loop->last),@endif
                                @endforeach
                            </p>
                            <p><strong>Overview:</strong> {{ $movie['overview'] }}</p>
                            <p><strong>Language:</strong> {{ $movie['original_language'] }}</p>
                            <p><strong>Popularity:</strong> {{ $movie['popularity'] }}</p>
                            <p><strong>Vote Average:</strong> {{ $movie['vote_average'] }} / 10</p>

                            <p><strong>Genres:</strong>
                                @foreach($movie['genres'] as $genre)
                                    {{ $genre['name'] }}@if(!$loop->last),@endif
                                @endforeach
                            </p>
                            <p><strong>Production Companies:</strong>
                                @foreach($movie['production_companies'] as $company)
                                    {{ $company['name'] }}@if(!$loop->last),@endif
                                @endforeach
                            </p>
                            <p><strong>Production Countries:</strong>
                                @foreach($movie['production_countries'] as $country)
                                    {{ $country['name'] }}@if(!$loop->last),@endif
                                @endforeach
                            </p>
                            <p><strong>Overview:</strong> {{ $movie['overview'] }}</p>
                            <p><strong>Language:</strong> {{ $movie['original_language'] }}</p>
                            <p><strong>Spoken Languages:</strong>
                                @foreach($movie['spoken_languages'] as $language)
                                    {{ $language['name'] }}@if(!$loop->last),@endif
                                @endforeach
                            </p>
                            <p><strong>Popularity:</strong> {{ $movie['popularity'] }}</p>
                            <p><strong>Vote Average:</strong> {{ $movie['vote_average'] }} / 10</p>
                            <p><strong>IMDb ID:</strong> <a href="https://www.imdb.com/title/{{ $movie['imdb_id'] }}" target="_blank">{{ $movie['imdb_id'] }}</a></p>
                            <p><strong>Homepage:</strong> <a href="{{ $movie['homepage'] }}" target="_blank">{{ $movie['homepage'] }}</a></p>


                            <!-- Cast Section -->
                            <h3 class="mt-5">Cast</h3>
                            <div class="row">
                                @foreach($credits['cast'] as $cast)
                                    <div class="col-md-3 mb-3">
                                        <div class="card">
                                            @if($cast['profile_path'])
                                                <img src="https://image.tmdb.org/t/p/w200/{{ $cast['profile_path'] }}" alt="{{ $cast['name'] }}" class="card-img-top">
                                            @else
                                                <img src="https://via.placeholder.com/200x300" alt="{{ $cast['name'] }}" class="card-img-top">
                                            @endif
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $cast['name'] }}</h5>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
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
