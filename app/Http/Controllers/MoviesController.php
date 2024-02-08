<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class MoviesController extends Controller
{
    public function getMovies()
    {
        $client = new Client();

        // logic for the GET endpoint
        try {
            $response = $client->get('https://api.themoviedb.org/3/movie/550?', [
                'query' => [
                    'api_key' => 'a0d0698b8bc9981d71535148e8cbdc4f',
                    'language' => 'en-US',
                    'sort_by' => 'popularity.desc',
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            return response()->json($data);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch movies.'], 500);
        }
    }

    public function tvSeries()
    {
        $client = new Client();

        // Logic for the GET endpoint
        try {
            $response = $client->request('GET', 'https://netflix-original-series-top-100-ranked.p.rapidapi.com/uMEJkR/series', [
                'body' => '{
                "key1": "value",
                "key2": "value"
            }',
                'headers' => [
                    'X-RapidAPI-Host' => 'netflix-original-series-top-100-ranked.p.rapidapi.com',
                    'X-RapidAPI-Key' => 'ad8e130fc5msh3a89a0bb6b2964bp1562bfjsna1d71d60e928',
                    'content-type' => 'application/json',
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            return response()->json($data);
        } catch (\Exception $e) {
            // Log the exception
            \Log::error('Error fetching TV series: ' . $e->getMessage());

            return response()->json(['error' => 'Unable to fetch TV series.'], 500);
        }
    }

    public function tvSeriess()
    {
        try {

            $response = $client->request('POST', 'https://netflix-original-series-top-100-ranked.p.rapidapi.com/uMEJkR/series', [
                'body' => '{
                "key1": "value",
                "key2": "value"
            }',
                'headers' => [
                    'X-RapidAPI-Host' => 'netflix-original-series-top-100-ranked.p.rapidapi.com',
                    'X-RapidAPI-Key' => 'ad8e130fc5msh3a89a0bb6b2964bp1562bfjsna1d71d60e928',
                    'content-type' => 'application/json',
                ],
            ]);

            $data = $response->json();

        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch tv series.'], 500);
        }
    }

    public function searchMovies()
    {
        $client = new Client();

        // Logic for the GET endpoint
        try {
            $response = $client->request('GET', 'https://netflix54.p.rapidapi.com/search/?query=stranger&offset=0&limit_titles=50&limit_suggestions=20&lang=en', [
                'headers' => [
                    'X-RapidAPI-Host' => 'netflix54.p.rapidapi.com',
                    'X-RapidAPI-Key' => 'ad8e130fc5msh3a89a0bb6b2964bp1562bfjsna1d71d60e928',
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            return response()->json($data);
        } catch (\Exception $e) {
            // Log the exception
            \Log::error('Error fetching TV series: ' . $e->getMessage());

            return response()->json(['error' => 'Unable to fetch TV series.'], 500);
        }
    }
}

