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
                    'api_key' => '7f26f2b74732aa679f5115d2fe2afca2',
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

    // public function fetchNetflixOriginals()
    // {
    //     $client = new Client();
    //     try {
    //         $response = $client->get('https://api.themoviedb.org/3/discover/tv', [
    //             'query' => [
    //                 'api_key' => '7f26f2b74732aa679f5115d2fe2afca2',
    //                 'with_networks' => '213', // Netflix network ID
    //             ],
    //         ]);

    //         $data = json_decode($response->getBody(), true);
    //         return response()->json($data);

    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Unable to fetch netflix originals movies.'], 500);
    //     }
    // }

    public function fetchNetflixOriginals()
    {
        try {
            $response = Http::get('https://api.themoviedb.org/3/discover/tv', [
                'api_key' => '7f26f2b74732aa679f5115d2fe2afca2',
                'with_networks' => '213', // Netflix network ID
            ]);

            // Check if the request was successful
            if ($response->successful()) {
                $data = $response->json();
                return response()->json($data);
            } else {
                // Handle the case when the request was not successful
                return response()->json(['error' => 'Unable to fetch Netflix originals movies.'], $response->status());
            }

        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json(['error' => 'Unable to fetch Netflix originals movies.'], 500);
        }
    }

    public function fetchTrending()
    {
        $client = new Client();
        try {
            $response = Http::get('https://api.themoviedb.org/3/trending/all/week', [
                'api_key' => '7f26f2b74732aa679f5115d2fe2afca2',
            ]);

            return $response->json();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch netflix trending movies.'], 500);
        }
    }

    public function fetchTopRated()
    {
        $client = new Client();
        try {
            $response = Http::get('https://api.themoviedb.org/3/movie/top_rated', [
                'api_key' => '7f26f2b74732aa679f5115d2fe2afca2',
            ]);

            return $response->json();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch top rated movies.'], 500);
        }
    }

    public function fetchActionMovies()
    {
        $client = new Client();
        try {
            $response = Http::get('https://api.themoviedb.org/3/discover/tv', [
                'api_key' => '7f26f2b74732aa679f5115d2fe2afca2',
            ]);

            return $response->json();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch horror movies.'], 500);
        }
    }

    public function fetchComedyMovies()
    {
        $client = new Client();
        try {
            $response = Http::get('https://api.themoviedb.org/3/trending/all/week', [
                'api_key' => '7f26f2b74732aa679f5115d2fe2afca2',
            ]);

            return $response->json();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch comedy movies.'], 500);
        }
    }

    public function fetchHorrorMovies()
    {
        $client = new Client();
        try {
            $response = Http::get('https://api.themoviedb.org/3/discover/tv', [
                'api_key' => '7f26f2b74732aa679f5115d2fe2afca2',
            ]);

            return $response->json();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch horror movies.'], 500);
        }
    }

    public function fetchRomanceMovies()
    {
        $client = new Client();
        try {
            $response = Http::get('https://api.themoviedb.org/3/discover/tv', [
                'api_key' => '7f26f2b74732aa679f5115d2fe2afca2',
            ]);

            return $response->json();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch romance movies.'], 500);
        }
    }

    public function fetchDocumentaries()
    {
        $client = new Client();
        try {
            $response = Http::get('https://api.themoviedb.org/3/discover/tv', [
                'api_key' => '7f26f2b74732aa679f5115d2fe2afca2',
            ]);

            return $response->json();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch doumentaries.'], 500);
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
            $client = new Client();
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

