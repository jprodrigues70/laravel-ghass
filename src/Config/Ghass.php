<?php

return [
    'repo' => env('GHASS_REPO', null),
    'path' => "/repos/" . env('GHASS_REPO', null),
    'token' => env('GHASS_TOKEN', null),
    'branch' => env('GHASS_BRANCH', 'master'),
    'committerName' => env('GHASS_COMMITER_NAME', 'ghass'),
    'committerEmail' => env('GHASS_COMMITER_EMAIL', 'ghass@guest.ghass'),
];
