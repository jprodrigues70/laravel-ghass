<?php

namespace Ghass\Helpers;

class Options
{
    public function __construct(array $options = [])
    {
        if (empty($options)) {
            $options = config('ghass');
        }

        foreach ($options as $key => $value) {
            $this->{$key} = $value;
        }
        $this->blobPath = "{$this->path}/git/blobs";
        $this->filePath = "repos/{$this->repo}/contents";
    }
}
