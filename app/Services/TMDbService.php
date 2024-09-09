<?php

namespace App\Services;

use GuzzleHttp\Client;

class TMDbService
{
    protected $client;
    protected $apiKey;
    protected $apiToken;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.themoviedb.org/3/',
        ]);
        $this->apiKey = env('TMDB_API_KEY');
        $this->apiToken = env('TMDB_API_TOKEN');
    }

    // Get popular movies or a specific search
    public function getMovies($query = null)
    {
        $endpoint = $query ? 'search/movie' : 'movie/popular';
        $response = $this->client->get($endpoint, [
            'query' => [
                'api_key' => $this->apiKey,
                'query'   => $query,
            ],
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiToken,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    // Get movie details by ID
    public function getMovieDetails($movieId)
    {
        $response = $this->client->get("movie/{$movieId}", [
            'query' => [
                'api_key' => $this->apiKey,
            ],
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiToken,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    public function getMovieCredits($movieId)
    {
        $response = $this->client->get("movie/{$movieId}/credits", [
            'query' => [
                'api_key' => $this->apiKey,
            ],
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiToken,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
