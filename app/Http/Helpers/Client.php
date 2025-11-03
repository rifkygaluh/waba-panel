<?php

namespace App\Http\Helpers;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Traits\ForwardsCalls;

class Client
{
    use ForwardsCalls;

    protected PendingRequest $client;

    public function __construct()
    {
        $this->boot();
    }

    protected function boot(): void
    {
        $this->client = Http::baseUrl(env('API_URL'))
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])
            ->withToken($this->getToken())
            ->retry(3, 100)
            ->timeout(30);
    }

    protected function getToken(): ?string
    {
        return session('token');
    }

    public function refresh(): self
    {
        $this->boot();
        return $this;
    }

    public function __call($method, $parameters): Response
    {
        return static::forwardCallTo($this->client, $method, $parameters);
    }

    public function client(): PendingRequest
    {
        return $this->client;
    }

    public function withHeader(string $key, string $value): self
    {
        $this->client = $this->client->withHeaders([$key => $value]);
        return $this;
    }

    public function withToken(string $token): self
    {
        $this->client = $this->client->withToken($token);
        return $this;
    }

    public function get(string $url, array $query = []): Response
    {
        return $this->client->get($url, $query);
    }

    public function post(string $url, array $data = []): Response
    {
        return $this->client->post($url, $data);
    }

    public function put(string $url, array $data = []): Response
    {
        return $this->client->put($url, $data);
    }

    public function patch(string $url, array $data = []): Response
    {
        return $this->client->patch($url, $data);
    }

    public function delete(string $url, array $data = []): Response
    {
        return $this->client->delete($url, $data);
    }
}