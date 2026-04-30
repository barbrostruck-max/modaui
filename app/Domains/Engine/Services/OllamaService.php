<?php

declare(strict_types=1);

namespace App\Domains\Engine\Services;

use App\Helpers\Classes\ApiHelper;
use App\Helpers\Classes\Helper;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class OllamaService
{
    public ?string $key = null;

    public bool $stream = false;

    public array $messages = [];

    public ?string $system = null;

    public array $tools = [];

    public const ENDPOINT = 'http://localhost:11434/api/chat';

    public function stream(): PromiseInterface|Response
    {
        $client = $this->client();

        $body = [
            'model'    => setting('ollama_default_model', config('ollama.default_model', 'llama2')),
            'messages' => $this->buildMessages(),
            'stream'   => $this->isStream(),
        ];

        if ($this->isStream()) {
            $body['stream'] = true;
        }

        $apiUrl = setting('ollama_api_url', config('ollama.api_url', 'http://localhost:11434'));

        return $client->post(rtrim($apiUrl, '/') . '/api/chat', $body);
    }

    public function client(): PendingRequest
    {
        return Http::timeout(setting('ollama_request_timeout', config('ollama.request_timeout', 300)))
            ->withHeaders([
                'Content-Type' => 'application/json',
            ]);
    }

    public function isStream(): bool
    {
        return $this->stream;
    }

    public function withStream(): self
    {
        $this->stream = true;

        return $this;
    }

    public function withMessages(array $messages): self
    {
        $this->messages = $messages;

        return $this;
    }

    public function withSystem(string $system): self
    {
        $this->system = $system;

        return $this;
    }

    public function withTools(array $tools): self
    {
        $this->tools = $tools;

        return $this;
    }

    private function buildMessages(): array
    {
        $messages = [];

        if ($this->system) {
            $messages[] = [
                'role'    => 'system',
                'content' => $this->system,
            ];
        }

        foreach ($this->messages as $message) {
            $messages[] = $message;
        }

        return $messages;
    }
}