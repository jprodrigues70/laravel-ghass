<?php

namespace Ghass\Abstracts;

use Ghass\Helpers\Options;
use GuzzleHttp\Client as Http;

abstract class GhassAbstract
{
    protected $options;

    public function __construct(array $options = [])
    {
        $this->options = new Options($options);
        $this->http = new Http([
            'base_uri' => 'https://api.github.com/',
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => 'token ' . $this->options->token
            ]
        ]);
    }

    final protected function parse($result)
    {
        return json_decode($result, true);
    }

    final protected function realPut(string $path, string $data, string $sha = '', string $message = '')
    {
        return $this->parse($this->http->put("{$this->options->filePath}/$path", [
            "json" => [

                "message" => (empty($message)) ? "Commit $path" : $message,
                "content" => $data,
                "branch" => $this->options->branch,
                "sha" => $sha,
                "committer" => [
                    "name" => $this->options->committerName,
                    "email" => $this->options->committerEmail
                ],
                "author" => [
                    "name" => $this->options->committerName,
                    "email" => $this->options->committerEmail
                ]
            ]
        ])->getBody());
    }

    abstract public function file(string $path);
    abstract public function get(string $sha);
    abstract public function post(string $path, string $data, string $message = '');
    abstract public function put(string $path, string $data, string $sha, string $message = '');
    abstract public function delete(string $path, string $sha, string $message = '');
}
