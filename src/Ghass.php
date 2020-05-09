<?php

namespace Ghass;

use Ghass\Abstracts\GhassAbstract;

class Ghass extends GhassAbstract
{
    /**
     * Gets the contents of a file in a repository
     * This method supports files up to 1 megabyte in size
     * 
     * see https://developer.github.com/v3/repos/contents/#get-contents
     * 
     * @param string $path
     * @return void
     */
    public function file(string $path)
    {
        return $this->parse($this->http->get("{$this->options->filePath}/$path")->getBody());
    }

    /**
     * Get the contents of a file in a repository
     * The content in the response will always be Base64 encoded
     * 
     * see https://developer.github.com/v3/git/blobs/#get-a-blob
     *
     * @param string $path
     * @param boolean $isSha
     * @return void
     */
    public function get(string $sha)
    {
        return $this->parse($this->http->get("{$this->options->blobPath}/$sha")->getBody());
    }

    /**
     * Creates a new file in a repository
     * 
     * see https://developer.github.com/v3/repos/contents/#create-or-update-a-file
     * 
     * @param string $path
     * @param string $data
     * @param string $message
     * @return void
     */
    public function post(string $path, string $data, string $message = '')
    {
        return $this->realPut($path, $data, '', $message);
    }

    /**
     * Updates an existing file in a repository
     * 
     * see https://developer.github.com/v3/repos/contents/#create-or-update-a-file
     * 
     * @param string $path
     * @param string $data
     * @param string $sha
     * @param string $message
     * @return void
     */
    public function put(string $path, string $data, string $sha, string $message = '')
    {
        return $this->realPut($path, $data, $sha, $message);
    }

    /**
     * Deletes a file in a repository
     *
     * see https://developer.github.com/v3/repos/contents/#delete-a-file
     * 
     * @param string $path
     * @param string $sha
     * @param string $message
     * @return void
     */
    public function delete(string $path, string $sha, string $message = '')
    {
        return $this->parse($this->http->delete("{$this->options->filePath}/$path", [
            'json' => [
                "message" => (empty($message)) ? "Delete $path" : $message,
                "branch" => $this->options->branch,
                "sha" => $sha,
                "committer" => [
                    "name" => $this->options->committerName,
                    "email" => $this->options->committerEmail
                ]
            ]
        ])->getBody());
    }
}
