@extends('backend.layout.layout')

@section('content')

    <!-- Taginput CSS -->
    <link href="{{ url('backend/plugins/typeahead/typeaheadjs.min.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ url('backend/plugins/tagify/tagify.min.css') }}"  type="text/css" />
    <script src="{{ url('backend/plugins/tagify/tagify.min.js') }}"></script>

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
                                        <div class="col-md-2">
                                            <div class="form-group col-md-12">
                                                <div class="file-input-container" id="fileInputContainer">
                                                    <input class="file-input" name="photo" type="file" id="photoInput" accept="image/*" style="display: none;"/>
                                                    <img id="photoPreview" class="file-input-preview" alt="Profile Photo Preview"
                                                        src="{{ url('upload/profile.jpg') }}" style="display: block; height: 300px; object-fit: cover;">
                                                    <button class="remove-button" id="removeButton" style="display: none;">&times;</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name" class="form-label">Movie Code :<span
                                                                class="text-red">*</span></label>
                                                        <input type="text" class="form-control" placeholder="Name" name="code"
                                                            autocomplete="name">
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <label for="title" class="form-label">Movie Title :<span class="text-red">*</span></label>
                                                        <input type="text" id="movieTitle" class="form-control" placeholder="Type movie title" name="title" autocomplete="off">
                                                        <input type="hidden" id="movieId" name="movie_id">
                                                        <ul id="suggestions" class="list-group position-absolute" style="z-index: 1000; width:100%; max-height: 350px; overflow-y: auto; display: none;">
                                                            </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="short_descp" class="form-label">Short Description :</label>
                                                <textarea class="form-control mb-4" rows="4" name="short_descp" id="short_description"></textarea>
                                            </div>

                                            <div class="row">

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="release_date" class="form-label">Release Date :</label>
                                                        <input type="text" id="release_date" class="form-control" placeholder="Release Date" name="release_date" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="runtime" class="form-label">Runtime :</label>
                                                        <input type="text" id="runtime" class="form-control" placeholder="Runtime" name="runtime" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="rating" class="form-label">Rating :</label>
                                                        <input type="text" id="rating" class="form-control" placeholder="Rating" name="rating" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="video_format" class="form-label">Quality :</label>
                                                        <input type="text" id="video_format" class="form-control" placeholder="Quality" name="video_format" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="trailer" class="form-label">Trailer :</label>
                                                        <input type="text" id="trailer" class="form-control" placeholder="Trailer" name="trailer" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mb-4">
                                                        <label for="genre_id" class="form-label">Genres:</label>
                                                        <input type="text" name="genre_id" class="form-control" id="genres" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mb-4">
                                                        <label for="cast_id" class="form-label">Casts:</label>
                                                        <input type="text" name="cast_id" class="form-control" id="casts" required>
                                                    </div>
                                                </div>
                                            </div>

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

    <style>
        /* Preview custom image */
        .file-input-container {
            border: 2px dashed #ddd;
            padding: 5px;
            position: relative;
            text-align: center;
            cursor: pointer;
        }

        .file-input-container.dragover {
            border-color: #007bff;
        }

        .file-input-label {
            color: #666;
        }

        .file-input-preview {
            display: none;
        }

        .remove-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #ff0000;
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
            width: 30px;
            height: 30px;
            display: none;
        }

        .file-input-preview {
            display: block;
            border-radius: 5px;
            object-fit: cover;
        }

    </style>

    <!-- photo -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const fileInputContainer = document.getElementById('fileInputContainer');
            const photoInput = document.getElementById('photoInput');
            const photoPreview = document.getElementById('photoPreview');
            const fileInputLabel = document.querySelector('.file-input-label');
            const removeButton = document.getElementById('removeButton');

            // Check if there's an existing photo on load
            if (photoPreview.src && !photoPreview.src.includes('profile.jpg')) {
                fileInputLabel.style.display = 'none';
                removeButton.style.display = 'block';
            }

            function previewPhoto(file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    photoPreview.src = e.target.result;
                    photoPreview.style.display = 'block';
                    fileInputLabel.style.display = 'none';
                    removeButton.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }

            // Handle drag and drop events
            fileInputContainer.addEventListener('dragover', (e) => {
                e.preventDefault();
                fileInputContainer.classList.add('dragover');
            });

            fileInputContainer.addEventListener('dragleave', () => {
                fileInputContainer.classList.remove('dragover');
            });

            fileInputContainer.addEventListener('drop', (e) => {
                e.preventDefault();
                fileInputContainer.classList.remove('dragover');
                const file = e.dataTransfer.files[0];
                if (file && file.type.startsWith('image/')) {
                    previewPhoto(file);
                    photoInput.files = e.dataTransfer.files; // Set the dropped file to the input
                }
            });

            // Handle click event to trigger file input
            fileInputContainer.addEventListener('click', () => {
                photoInput.click();
            });

            // Handle file input change event
            photoInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file && file.type.startsWith('image/')) {
                    previewPhoto(file);
                }
            });

            // Remove photo functionality
            removeButton.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                photoPreview.src = '{{ url('upload/profile.jpg') }}';
                photoPreview.style.display = 'block';
                fileInputLabel.style.display = 'block';
                removeButton.style.display = 'none';
                photoInput.value = ''; // Clear the input
            });
        });

    </script>

<script type="text/javascript">
    $(document).ready(function() {
        var apiKey = '7b5ce55c5d5abf15de97db97fc26c6df';
        var $movieTitle = $('#movieTitle');
        var $suggestions = $('#suggestions');
        var castInput = document.querySelector('#casts'); // The input for cast data
        var tagifyCasts = new Tagify(castInput, {
            delimiters: ",",
            dropdown: {
                enabled: 0
            }
        });

        // Initialize Tagify for genres (already done in your script)
        var genreInput = document.querySelector('#genres');
        var tagify = new Tagify(genreInput, {
            delimiters: ",",
            dropdown: {
                enabled: 0
            }
        });

        // Fetch cast data for the selected movie
        function fetchMovieCasts(movieId) {
            $.ajax({
                url: 'https://api.themoviedb.org/3/movie/' + movieId + '/credits',
                data: {
                    api_key: apiKey
                },
                success: function(response) {
                    var casts = response.cast.map(function(castMember) {
                        return castMember.name;
                    });
                    // Clear existing cast tags
                    tagifyCasts.removeAllTags();
                    // Add new cast tags
                    tagifyCasts.addTags(casts);
                },
                error: function() {
                    alert('Failed to fetch cast data.');
                }
            });
        }

        // Your existing code for fetching movie details
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
                                    .addClass('list-group-item list-group-item-action d-flex align-items-center')
                                    .css('cursor', 'pointer')
                                    .data('movie', movie)
                                    .on('click', function() {
                                        var selectedMovie = $(this).data('movie');

                                        // Fetch full movie details
                                        $.ajax({
                                            url: 'https://api.themoviedb.org/3/movie/' + selectedMovie.id,
                                            data: {
                                                api_key: apiKey
                                            },
                                            success: function(movieDetails) {
                                                $movieTitle.val(movieDetails.title);
                                                $('#movieId').val(movieDetails.id);
                                                $('#description').val(movieDetails.overview);
                                                var posterPath = movieDetails.poster_path;
                                                var posterUrl = posterPath ? 'https://image.tmdb.org/t/p/w500' + posterPath : '{{ url('upload/blog_images.png') }}';
                                                $('#photoPreview').attr('src', posterUrl);

                                                var releaseYear = movieDetails.release_date ? new Date(movieDetails.release_date).getFullYear() : 'N/A';
                                                $('#release_date').val(releaseYear);

                                                var runtime = movieDetails.runtime ? movieDetails.runtime + ' minutes' : 'N/A';
                                                $('#runtime').val(runtime);

                                                var rating = movieDetails.vote_average ? movieDetails.vote_average.toFixed(1) : 'N/A';
                                                $('#rating').val(rating);

                                                // Fetch genres (already handled in your script)
                                                var genres = movieDetails.genres.map(function(genre) {
                                                    return genre.name + ' Movies';
                                                });

                                                    function fetchGenres(query) {
                                                        $.ajax({
                                                            url: "/movies-genre", // Your API endpoint for fetching genres
                                                            data: { query: query }, // Send the typed query as parameter
                                                            method: "GET",
                                                            success: function(response) {
                                                                // Update Tagify whitelist with the response data
                                                                tagify.settings.whitelist = response;
                                                                tagify.dropdown.show(query); // Show the updated suggestions
                                                            },
                                                            error: function() {
                                                                console.error("Failed to fetch genres from the server.");
                                                            }
                                                        });
                                                    }

                                                    // Listen for the input event to trigger the genre fetch
                                                    tagify.on('input', function(e) {
                                                        var value = e.detail.value;
                                                        if (value.length > 1) {
                                                            // Fetch genres only if input is longer than 1 character
                                                            fetchGenres(value);
                                                        }
                                                    });

                                                tagify.removeAllTags();
                                                tagify.addTags(genres);

                                                // Fetch and display cast data
                                                fetchMovieCasts(selectedMovie.id);
                                            },
                                            error: function() {
                                                alert('Failed to fetch full movie details.');
                                            }
                                        });

                                        $suggestions.empty();
                                    });

                                var releaseYear = movie.release_date ? new Date(movie.release_date).getFullYear() : 'N/A';
                                var posterPath = movie.poster_path ? 'https://image.tmdb.org/t/p/w92' + movie.poster_path : '{{ url('upload/blog_images.png') }}';

                                var posterImage = $('<img>')
                                    .attr('src', posterPath)
                                    .css('width', '50px')
                                    .css('height', '75px')
                                    .addClass('me-3');

                                var movieInfo = $('<div></div>')
                                    .html(`<strong>${movie.title}</strong><br><small>${releaseYear}</small>`);

                                movieItem.append(posterImage).append(movieInfo);

                                $suggestions.append(movieItem);
                            });

                            $suggestions.css('display', 'block').css('max-height', '300px').css('overflow-y', 'auto');
                        } else {
                            $suggestions.hide();
                        }
                    }
                });
            } else {
                $suggestions.hide();
            }
        });

        // Close suggestions if clicked outside the input
        $(document).click(function(e) {
            if (!$(e.target).closest('#movieTitle').length) {
                $suggestions.hide();
            }
        });
    });
</script>


@endsection

@push('scripts')


    <!-- typeahead -->
    <script src="{{ asset('backend/plugins/typeahead/typeahead.bundle.js') }}"></script>

    <!-- INPUT MASK JS -->
    <script src="{{ asset('backend/plugins/input-mask/jquery.mask.min.js') }}"></script>

    <!-- INTERNAL WYSIWYG Editor JS -->
    <script src="{{ asset('backend/plugins/wysiwyag/jquery.richtext.js') }}"></script>
    <script src="{{ asset('backend/plugins/wysiwyag/wysiwyag.js') }}"></script>
@endpush
