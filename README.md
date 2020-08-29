# iBanFirst PHP client library

[![Build Status](https://travis-ci.org/mradhi/ibanfirst-sdk.svg?branch=master)](https://travis-ci.org/mradhi/ibanfirst-sdk)

A PHP client for interacting with the iBanFirst API.

- [Guide](https://api.ibanfirst.com/APIDocumentation/IbanfirstAPI/)
- [API Reference](https://api.ibanfirst.com/APIDocumentation/IbanfirstAPI/Endpoints/)

### Installation

The recommended way to install `ibanfirst-sdk` is using
[Composer](https://getcomposer.org/).

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

Next, run the Composer command to install the latest stable version of `ibanfirst-sdk`.
```bash
php composer.phar require mradhi/ibanfirst-sdk
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

### Initialising A Client

Create a `IBanFirst\IBanFirst` instance, providing your credentials, and the environment
you want to use. We strongly advise to store your credentials as an environment variable,
rather than directly in your code. you can easily load the environment variables from a
`.env` file by using something like [phpdotenv](https://github.com/vlucas/phpdotenv),
though keep it out of version control!

```php
$username = getenv('IBANFIRST_USERNAME');
$password = getenv('IBANFIRST_PASSWORD');

$client = new IBanFirst\IBanFirst(array(
    'username'    => $username,
    'password'    => $password,
    'environment' => IBanFirst\IBanFirstEnvironment::SANDBOX
));
```

The environment can either be `IBanFirst\IBanFirstEnvironment::SANDBOX` or
`IBanFirst\IBanFirstEnvironment::LIVE`, depending on whether you want to
use the sandbox or live API.

### GET requests

You can make a request to get a list of resources using the `getList` method.

```php
/**
 * @var IBanFirst\IBanFirst $client
 */
$client->wallets()->getList();
```

*Note: This README will use wallets throughout but each of the resources in the API is
available in this library.*

If you need to pass any options, the last argument in `getList()` method
is an array of options, check [HttpClient - Query String Parameters](https://symfony.com/doc/current/http_client.html#query-string-parameters)
for more information, so in our case if we want to add some parameters to the URL, we can do so
as below:

```php
/**
 * @var IBanFirst\IBanFirst $client
 */
$wallets = $client->wallets()->getList(['query' => ['page' => 3]]);
```

A call to `getList()` returns an instance of `IBanFirst\Response\ListResponse`. You can use its `getRecords()`
attribute to iterate through the results.

```php
/**
 * @var IBanFirst\Response\ListResponse $wallets
 */
echo count($wallets->getRecords());

/** @var IBanFirst\Resources\Wallet $wallet */
foreach ($wallets->getRecords() as $wallet) {
  echo $wallet->bookingAmount->value;
}
```

In the case where a URL parameter is required, the method signature will contain the
required arguments:

```php
/**
 * @var IBanFirst\IBanFirst $client
 */
$wallet = $client->wallets()->getDetails('some_id');
echo $wallet->accountNumber;
```

As with `getList()`, the last argument can be options array, with any URL parameters given:

```php
/**
 * @var IBanFirst\IBanFirst $client
 */
$client->wallets()->getDetails('some_id', ['query' => ['some_flag' => true]]);
```

### Handling Failures

When there is an error, the library will return a corresponding subclass of
`IBanFirst\Exception\SDKException`, one of:

- `IBanFirst\Exception\AuthenticatorException` - The authenticator config is invalid
- `IBanFirst\Exception\ResourceException` - The call to a given resource is invalid
- `IBanFirst\Exception\ResponseException` - The response returned by the API is an error

## Supporting PHP >= 7.4

This client library only supports the latest version PHP >= 7.4 , Check [Supported Versions](https://www.php.net/supported-versions.php)
for more information.


## Tests

1. Create a sandbox account on iBanFirst, check [iBanFirst API - Get started](https://api.ibanfirst.com/APIDocumentation/IbanfirstAPI/)
2. Create `tests/config.php` from `tests/config.php.dist` and edit it to add your credentials.
3. The tests can be executed by running this command from the root directory:

```bash
$ ./vendor/bin/phpunit
```

By default, the tests will send live HTTP requests to the iBanFirst API. If you are without an internet connection you can skip these tests by excluding the `client` group.

```bash
$ ./vendor/bin/phpunit --exclude-group client
```

### Perspective

* Behind the scene, this library uses the [HttpClient](https://github.com/symfony/http-client) 
component to communicate with the iBanFirst APIs, but you can use your own HttpClient which
should implement `Symfony\Contracts\HttpClient\HttpClientInterface`, and then you can use it
by configuring the `IBanFirst\IBanFirst` object as below:

 ```php
/**
 * @var Symfony\Contracts\HttpClient\HttpClientInterface $customClient
 */
$client = new IBanFirst\IBanFirst(array(
    // ... the required options here
    'http_client' => $customClient
));
 ```

Check [HttpClient - HttpPlug documentation](https://symfony.com/doc/current/http_client.html#httplug) 
for more information in this subject.

* Currently, the library supports only one authentication method `IBanFirst\Authenticator\UsernameTokenAuthenticator`, but it's built in a way
that we can easily add more authenticators by just implementing the interface `IBanFirst\Authenticator\AuthenticatorInterface`.

* Currently, the library supports only two APIs services:
    * `IBanFirst\Service\WalletsService` - Service for interacting with **/wallets/** endpoints.
    * `IBanFirst\Service\FinancialMovementsService` - Service for interacting with **/financialMovements/** endpoints.

We can easily add more services to this wrapper, each service should extend `IBanFirst\Service\AbstractService` class, 
and the return value for each public method call should be an instance of `IBanFirst\Response\ListResponse`
or `IBanFirst\Resources\AbstractResource`, this is so useful to ensure a great typehint.
