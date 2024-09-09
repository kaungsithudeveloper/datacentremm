<?php

namespace App\Http\Controllers;

use App\Services\TMDbService;
use Illuminate\Http\Request;

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

        return view('movies.show', compact('movie'));
    }
}
