<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TMDbService;

class MoviesController extends Controller
{
    protected $tmdbService;

    public function __construct(TMDbService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }

    // Fetch popular or searched movies
    public function create(Request $request)
    {
        $query = $request->input('query');
        $movies = $this->tmdbService->getMovies($query);

        return view('backend.movies.TMDBmovies_create', compact('movies'));
    }

    // Fetch movie details by ID
    public function show($id)
    {
        $movie = $this->tmdbService->getMovieDetails($id);
        $credits = $this->tmdbService->getMovieCredits($id);

        return view('backend.movies.TMDBmovies_show', compact('movie', 'credits'));
    }

    public function MoviesCreate()
    {
        return view('backend.movies.movies_create');
    }// End Method



}
