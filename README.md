# Plugin Http Client for oauth2 passport laravel
Composer plugin for Project Survey. Contains httpclient libraries to do request to server api survey

## Installation

Add this composer.json file

```json
{
    "require": {
        "harryosmar/plugin-http-client-passport-laravel": "^1.0"
    },
    "scripts": {
        "post-install-cmd": [
            "Incenteev\\ParameterHandler\\ScriptHandler::buildParameters"
        ],
        "post-update-cmd": [
            "Incenteev\\ParameterHandler\\ScriptHandler::buildParameters"
        ]
    },
    "extra": {
        "incenteev-parameters": {
            "file": "config/apiClient.yml",
            "dist-file": "vendor/harryosmar/plugin-http-client-passport-laravel/config/apiClient.yml.dist",
            "parameter-key": "parameters"
        }
    },
    "repositories": [
        {
            "type": "vcs",
            "url": "git@gitlab.com:harryosmar/plugin-http-client-passport-laravel.git"
        }
    ]
}
```

Then running
```bash
$ composer install
```

#### Install in Laravel 5
Add this following service provider to your `config/app.php` file.
```php
PluginHttpClientPassportLaravel\Laravel\HttpClientPassportServiceProvider
```

#### Using Service Container
```php
/** @var \PluginHttpClientPassportLaravel\Client $httpClientPassportLaravel */
$httpClientPassportLaravel =  ServiceContainer::getInstance()
    ->getContainer()
    ->get('HttpClientPassportLaravel');

# example for request post
$httpClientPassportLaravel
    ->action('oauth/token')
    ->body([
        'grant_type'  => 'password',
        'client_id'  => 1,
        'client_secret'  => 'xxxx',
        'redirect_uri'  => 'http//localhost/auth/callback',
        'username'  => 'username',
        'password'  => 'secret',
        'scope'  => 'scope1 scope2',
    ])
    ->post();
```

## About


### Submitting bugs and feature requests
Harry Osmar Sitohang - <harryosmarsitohang@gmail.com> - <https://github.com/harryosmar><br />
See also the list of [contributors](https://github.com/harryosmar/plugin-http-client-passport-laravel/contributors) which participated in this project.
