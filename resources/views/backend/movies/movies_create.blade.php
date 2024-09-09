@extends('backend.layout.layout')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
                <div class="row">
                    <div class="col-xl-12">
                        <form id="myForm" method="post" action="{{ route('movies.store') }}" enctype="multipart/form-data">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $err)
                                        {{ $err }}
                                    @endforeach
                                </div>
                            @endif

                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="title" class="form-label">Movie Title :<span class="text-red">*</span></label>
                                                <input type="text" id="movieTitle" class="form-control" placeholder="Type movie title" name="title" autocomplete="off">
                                                <input type="hidden" id="movieId" name="movie_id">
                                                <ul id="suggestions" class="list-group position-absolute" style="z-index: 1000;"></ul>
                                            </div>
                                        </div>
                                        <div class="col-md-8 mt-3">
                                            <div class="form-group">
                                                <label for="description" class="form-label">Movie Description:</label>
                                                <textarea id="description" name="description" class="form-control" rows="4" readonly></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Feature Photo</div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-4">
                                        <label for="photo" class="form-label">Photo:</label>
                                        <input type="file" name="photo" class="form-control" id="photo" required>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-9 text-secondary">
                                            <img id="showImage" src="{{ url('upload/blog_images.png') }}" style="width: 100px; height: 150px;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary">Create Movie</button>
                                    <a href="{{ route('movies') }}" class="btn btn-danger float-end">Discard</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- CONTAINER END -->
        </div>
    </div>
    <!-- app-content close -->

    <script type="text/javascript">
        $(document).ready(function() {
            var apiKey = '7b5ce55c5d5abf15de97db97fc26c6df';
            var $movieTitle = $('#movieTitle');
            var $suggestions = $('#suggestions');

            $movieTitle.on('input', function() {
                var query = $(this).val();
                if (query.length > 2) {
                    $.ajax({
                        url: 'https://api.themoviedb.org/3/search/movie',
                        data: {
                            api_key: apiKey,
                            query: query
                        },
                        success: function(response) {
                            var suggestions = response.results;
                            $suggestions.empty();
                            if (suggestions.length > 0) {
                                suggestions.forEach(function(movie) {
                                    var movieItem = $('<li></li>')
                                        .addClass('list-group-item list-group-item-action')
                                        .text(movie.title)
                                        .data('movie', movie)
                                        .on('click', function() {
                                            var selectedMovie = $(this).data('movie');
                                            $movieTitle.val(selectedMovie.title);
                                            $('#movieId').val(selectedMovie.id);
                                            $('#description').val(selectedMovie.overview);

                                            var posterPath = selectedMovie.poster_path;
                                            var posterUrl = posterPath ? 'https://image.tmdb.org/t/p/w500' + posterPath : '{{ url('upload/blog_images.png') }}';
                                            $('#showImage').attr('src', posterUrl);

                                            $suggestions.empty(); // Clear suggestions
                                        });
                                    $suggestions.append(movieItem);
                                });
                                $suggestions.show();
                            } else {
                                $suggestions.hide();
                            }
                        }
                    });
                } else {
                    $suggestions.hide();
                }
            });

            $(document).click(function(e) {
                if (!$(e.target).closest('#movieTitle').length) {
                    $suggestions.hide();
                }
            });

            $('#photo').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
@endsection
