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
                    <h1 class="page-title">Create Serie</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create Serie</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->

                <div class="row">
                    <div class="col-xl-12">
                        <form id="myForm" method="post" action="{{ route('series.store') }}"
                            enctype="multipart/form-data">
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
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name" class="form-label">Serie Code :<span class="text-red">*</span></label>
                                                        <input type="text" class="form-control" placeholder="Name" name="code" autocomplete="name">
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <label for="title" class="form-label">Serie Title :<span class="text-red">*</span></label>
                                                        <input type="text" id="seriesTitle" class="form-control" placeholder="Type Series title" name="title" autocomplete="off">
                                                        <input type="hidden" id="serieId" name="serie_id">
                                                        <ul id="suggestions" class="list-group position-absolute" style="z-index: 1000; overflow-y: auto; display: none;"></ul>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="short_descp" class="form-label">Short Description :</label>
                                                    <textarea class="form-control mb-4" rows="4" name="short_descp" id="short_description"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="description" class="form-label">Serie Description :</label>
                                                    <textarea name="description" id="myTextarea" class="content"></textarea>
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

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="file-input-container" id="fileInputContainer">
                                                    <input class="file-input" name="photo" type="file" id="photoInput" accept="image/*" style="display: none;" />
                                                    <img id="photoPreview" class="file-input-preview" alt="Profile Photo Preview" src="{{ url('upload/profile.jpg') }}" style="display: block; max-width: 50%; object-fit: cover; margin: 0 auto;" />
                                                    <button class="remove-button" id="removeButton" style="display: none;">&times;</button>
                                                </div>
                                            </div>

                                            <div class="form-group mb-4">
                                                <label for="category_id" class="form-label">Categories:</label>
                                                <input type="text" name="category_id" class="form-control" id="categories" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="form-label">Selling Price :</label>
                                                <input type="text" class="form-control" placeholder="Name"
                                                    name="selling_price" autocomplete="name">
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="form-label">Discount Price :</label>
                                                <input type="text" class="form-control" placeholder="Name"
                                                    name="discount_price" autocomplete="name">
                                            </div>

                                            <div class="form-group">
                                                <label for="release_date" class="form-label">Release Date :</label>
                                                <input type="text" id="release_date" class="form-control" placeholder="Release Date" name="release_date" autocomplete="off">
                                            </div>

                                            <div class="form-group">
                                                <label for="trailer" class="form-label">Trailer :</label>
                                                <input type="text" id="trailer" class="form-control" placeholder="Trailer" name="trailer" autocomplete="off">
                                            </div>


                                            <div class="form-group">
                                                <label for="runtime" class="form-label">Runtime :</label>
                                                <input type="text" id="runtime" class="form-control" placeholder="Runtime" name="runtime" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label for="rating" class="form-label">Rating :</label>
                                                <input type="text" id="rating" class="form-control" placeholder="Rating" name="rating" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label for="video_format" class="form-label">Quality :</label>
                                                <input type="text" id="video_format" class="form-control" placeholder="Quality" name="video_format" autocomplete="off">
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary">Create Serie</button>
                                    <a href="{{ route('series') }}" class="btn btn-danger float-end">Discard</a>
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
            $('#myForm').validate({
                rules: {
                    code: {
                        required: true,
                    },

                    title: {
                        required: true,
                    },

                    release_date: {
                        required: true,
                    },

                    video_format: {
                        required: true,
                    },
                    rating: {
                        required: true,
                    },
                    trailer: {
                        required: true,
                    },
                    selling_price: {
                        required: true,
                    },
                    discount_price: {
                        required: true,
                    },


                },
                messages: {
                    code: {
                        required: 'Please Enter Code',
                    },
                    title: {
                        required: 'Please Enter Movie Title',
                    },
                    release_date: {
                        required: 'Please Enter Release Date',
                    },
                    video_format: {
                        required: 'Please Enter Video Format',
                    },
                    rating: {
                        required: 'Please Enter Rating',
                    },
                    trailer: {
                        required: 'Please Enter Trailer',
                    },
                    selling_price: {
                        required: 'Please Enter Selling Price',
                    },
                    discount_price: {
                        required: 'Please Enter Discount Price',
                    },


                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>

    <!-- photo -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const fileInputContainer = document.getElementById('fileInputContainer');
            const photoInput = document.getElementById('photoInput');
            const photoPreview = document.getElementById('photoPreview');
            const removeButton = document.getElementById('removeButton');

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
                photoPreview.src = '{{ url('upload/profile.jpg') }}'; // Default image
                photoPreview.style.display = 'block';
                removeButton.style.display = 'none';
                photoInput.value = ''; // Clear the input
            });

            function previewPhoto(file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    photoPreview.src = e.target.result;
                    photoPreview.style.display = 'block';
                    removeButton.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

    </script>

<script type="text/javascript">
    $(document).ready(function() {
        var apiKey = '7b5ce55c5d5abf15de97db97fc26c6df';
        var $seriesTitle = $('#seriesTitle');
        var $suggestions = $('#suggestions');

        // Initialize Tagify for Casts
        var castInput = document.querySelector('#casts');
        var tagifyCasts = new Tagify(castInput, {
            delimiters: ",",
            dropdown: {
                enabled: 1, // Enable dropdown suggestions
                position: "text", // Set the dropdown to appear relative to the input text
            }
        });

        // Initialize Tagify for Genres
        var genreInput = document.querySelector('#genres');
        var tagifyGenres = new Tagify(genreInput, {
            delimiters: ",",
            dropdown: {
                enabled: 1 // Enable suggestions
            }
        });

        // Initialize Tagify for Categories
        var categoryInput = document.querySelector('#categories');
        var tagifyCategories = new Tagify(categoryInput, {
            delimiters: ",",
            dropdown: {
                enabled: 1 // Enable suggestions
            }
        });

        function fetchCategories(query) {
            $.ajax({
                url: "/series-category", // API endpoint for categories
                data: { query: query },
                method: "GET",
                success: function(response) {
                    tagifyCategories.settings.whitelist = response;
                    tagifyCategories.dropdown.show(query);
                },
                error: function() {
                    console.error("Failed to fetch categories from the server.");
                }
            });
        }

        // Fetch genres from the database
        function fetchGenres(query) {
            $.ajax({
                url: "/series-genre", // API endpoint for genres
                data: { query: query }, // Send the typed query
                method: "GET",
                success: function(response) {
                    tagifyGenres.settings.whitelist = response;
                    tagifyGenres.dropdown.show(query);
                },
                error: function() {
                    console.error("Failed to fetch genres from the server.");
                }
            });
        }

        // Fetch casts from the database
        function fetchCasts(query) {
            $.ajax({
                url: "/cast", // API endpoint for casts
                data: { query: query }, // Send the typed query
                method: "GET",
                success: function(response) {
                    tagifyCasts.settings.whitelist = response;
                    tagifyCasts.dropdown.show(query);
                },
                error: function() {
                    console.error("Failed to fetch cast data from the server.");
                }
            });
        }

        // Event listener for genres input
        tagifyGenres.on('input', function(e) {
            var value = e.detail.value;
            if (value.length > 1) {
                fetchGenres(value); // Fetch genres only if input is longer than 1 character
            }
        });

        // Event listener for casts input
        tagifyCasts.on('input', function(e) {
            var value = e.detail.value;
            if (value.length > 1) {
                fetchCasts(value); // Fetch casts only if input is longer than 1 character
            }
        });

        // Event listener for categories input
        tagifyCategories.on('input', function(e) {
            var value = e.detail.value;
            if (value.length > 1) {
                fetchCategories(value); // Fetch categories only if input is longer than 1 character
            }
        });

        // Fetch series details when typing
        $seriesTitle.on('input', function() {
            var query = $(this).val();
            if (query.length > 2) {
                $.ajax({
                    url: 'https://api.themoviedb.org/3/search/tv',
                    data: {
                        api_key: apiKey,
                        query: query
                    },
                    success: function(response) {
                        var suggestions = response.results;
                        $suggestions.empty();
                        if (suggestions.length > 0) {
                            suggestions.forEach(function(series) {
                                var seriesItem = $('<li></li>')
                                    .addClass('list-group-item list-group-item-action d-flex align-items-center')
                                    .css('cursor', 'pointer')
                                    .data('series', series)
                                    .on('click', function() {
                                        var selectedSeries = $(this).data('series');
                                        fetchSeriesDetails(selectedSeries.id);
                                        $suggestions.empty();
                                    });

                                var releaseYear = series.first_air_date ? new Date(series.first_air_date).getFullYear() : 'N/A';
                                var posterPath = series.poster_path ? 'https://image.tmdb.org/t/p/w92' + series.poster_path : '{{ url('upload/profile.jpg') }}';

                                var posterImage = $('<img>')
                                    .attr('src', posterPath)
                                    .css('width', '50px')
                                    .css('height', '75px')
                                    .addClass('me-3');

                                var seriesInfo = $('<div></div>')
                                    .html(`<strong>${series.name}</strong><br><small>${releaseYear}</small>`);

                                seriesItem.append(posterImage).append(seriesInfo);
                                $suggestions.append(seriesItem);
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
            if (!$(e.target).closest('#seriesTitle').length) {
                $suggestions.hide();
            }
        });

        // Fetch full series details, genres, and casts
        function fetchSeriesDetails(seriesId) {
            $.ajax({
                url: 'https://api.themoviedb.org/3/tv/' + seriesId,
                data: {
                    api_key: apiKey
                },
                success: function(seriesDetails) {
                    // Set series data in form
                    $seriesTitle.val(seriesDetails.name);
                    $('#serieId').val(seriesDetails.id);
                    $('#short_description').val(seriesDetails.overview);

                    var posterUrl = seriesDetails.poster_path ? 'https://image.tmdb.org/t/p/w92' + seriesDetails.poster_path : '{{ url('upload/blog_images.png') }}';

                    $('#photoPreview').attr('src', posterUrl);

                    $('#release_date').val(new Date(seriesDetails.first_air_date).getFullYear());
                    $('#runtime').val(seriesDetails.episode_run_time[0] + ' minutes'); // Assuming first runtime
                    $('#rating').val(seriesDetails.vote_average.toFixed(1));

                    // Set genres and casts in Tagify inputs
                    var genres = seriesDetails.genres.map(function(genre) {
                        return genre.name + ' Series';
                    });

                    tagifyGenres.removeAllTags();
                    tagifyGenres.addTags(genres);

                    // Custom fields
                    $('#video_format').val('HD');
                    $('#trailer').val('N/A');

                    fetchSeriesCasts(seriesDetails.id);
                },
                error: function() {
                    alert('Failed to fetch series details.');
                }
            });
        }

        // Fetch and set series cast details
        function fetchSeriesCasts(seriesId) {
            $.ajax({

                url: 'https://api.themoviedb.org/3/tv/' + seriesId + '/aggregate_credits',

                data: {
                    api_key: apiKey
                },
                success: function(response) {
                    var casts = response.cast.map(function(castMember) {
                        return castMember.name;
                    });
                    tagifyCasts.removeAllTags();
                    tagifyCasts.addTags(casts);
                },
                error: function() {
                    alert('Failed to fetch cast data.');
                }
            });
        }

        // Close suggestions if clicked outside the input
        $(document).click(function(e) {
            if (!$(e.target).closest('#seriesTitle').length) {
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
