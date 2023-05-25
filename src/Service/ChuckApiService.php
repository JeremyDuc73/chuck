<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ChuckApiService
{
    public function __construct(private HttpClientInterface $httpClient ){}

    public function getJokes(){
        $response = $this->httpClient->request(
            'GET',
            'https://api.chucknorris.io/jokes/random'
        );

        $content = $response->toArray();

        return $content;
    }
}