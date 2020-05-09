<p align="center">
  GHASS
  <p align="center">
    GHASS is a PHP GitHub API client that makes it easy to manage files in a GitHub repository.
  </p>
</p>

#### Configure your .env file

```
GHASS_REPO=organization/project
GHASS_TOKEN=yourgithubaccesstoken
GHASS_BRANCH=master
```

#### Usage

```php
<?php

$ghass = new \Ghass\Ghass();
$data = $ghass->file('index.html');
$ghass->delete('index.html', $data['sha']);

```

#### Sha

Sha is a code that identifies files, folders, etc. on Github. It is extremely necessary in PUT, DELETE and GET operations.

If you want to use Ghass to manage files larger than 1 megabyte, you will need to store the sha key for each file in some type of database. If you are going to manage files up to 1 megabyte, you can use the Ghass `file` method to get the contents of the file and also the sha.

#### File

Gets the contents of a file in a repository. This method supports files up to 1 megabyte in size.

```
$gass->file($path);
```

#### GET

Get the contents of a file in a repository. The content in the response will always be Base64 encoded.

```
$gass->get($sha);
```

#### POST

Creates a new file in a repository. It requires a Base64 encoded data.

`$commitMessage` is optional.

```
$gass->post($path, $data, $commitMessage);
```

#### PUT

Updates an existing file in a repository. It requires a Base64 encoded data.

PUT CAN'T RENAME FILES. If you want to rename a file, you will need to delete the previous and create the newer.

`$commitMessage` is optional.

```
$gass->put($path, $data, $sha, $commitMessage = '');
```

#### DELETE

Deletes a file in a repository.

`$commitMessage` is optional.

```
$gass->delete($path, $sah, $commitMessage = '');
```
