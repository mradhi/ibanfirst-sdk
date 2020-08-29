<?php
/*
 * This file is part of the iBanFirst HTTP Client package.
 *
 * (c) Radhi GUENNICHI <guennichiradhi@gmail.com> <+216 50 711 816>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace IBanFirst;

use IBanFirst\Authenticator\AuthenticatorInterface;
use IBanFirst\Authenticator\UsernameTokenAuthenticator;
use IBanFirst\Exception\SDKException;
use IBanFirst\Service\FinancialMovementsService;
use IBanFirst\Service\WalletsService;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class IBanFirst
{
    private const ENVIRONMENTS = [
        IBanFirstEnvironment::SANDBOX => 'https://sandbox2.ibanfirst.com/api',
        // TODO: Add another environment endpoints here... ("live" for example)
        IBanFirstEnvironment::LIVE => 'https://unknown'
    ];

    private const AUTHENTICATORS = [
        'username_token' => UsernameTokenAuthenticator::class
        // We may add more authenticators later like (Bearer, oAuth, etc...)
    ];

    protected array $config;

    private IBanFirstHttpClient $httpClient;

    public function __construct(array $config = [])
    {
        $config = array_merge([
            'authenticator' => 'username_token',
            'http_client' => HttpClient::create()
            // We may add more default options in the future...
        ], $config);

        $this->validateConfig($config);

        // Build the HTTP client with the authenticator
        $this->httpClient = new IBanFirstHttpClient(
            $this->getBaseURL($config['environment']),
            $config['http_client'],
            $this->getAuthenticator($config)
        );

        $this->config = $config;
    }

    /**
     * Ensures a config is valid and sets defaults where required.
     *
     * @param array $config
     *
     * @throws SDKException
     */
    private function validateConfig(array $config): void
    {
        $requiredKeys = ['environment', 'authenticator', 'http_client'];

        foreach ($requiredKeys as $requiredKey) {
            if (!isset($config[$requiredKey])) {
                throw new SDKException(
                    sprintf('Missing required option "%s".', $requiredKey)
                );
            }
        }

        if (!$config['http_client'] instanceof HttpClientInterface) {
            throw new SDKException(
                sprintf('The provided "http_client" should be an instance of "%s", "%s" given.',
                    HttpClientInterface::class,
                    gettype($config['http_client'])
                )
            );
        }

        // Check if the authenticator is valid and already existed in the AUTHENTICATORS list.
        if (!array_key_exists($config['authenticator'], self::AUTHENTICATORS)) {
            throw new SDKException(
                sprintf('The provided authenticator "%s" is not supported.', $config['authenticator'])
            );
        }

        if (!array_key_exists($config['environment'], self::ENVIRONMENTS)) {
            throw new SDKException(
                sprintf('The provided environment "%s" is not supported.', $config['environment'])
            );
        }
    }

    /**
     * Get base URL for a given environment.
     *
     * @param string $environment
     *
     * @return string
     */
    private function getBaseURL(string $environment): string
    {
        return self::ENVIRONMENTS[$environment];
    }

    /**
     * Build authenticator instance based on configuration.
     *
     * @param array $config
     *
     * @return AuthenticatorInterface
     */
    private function getAuthenticator(array $config): AuthenticatorInterface
    {
        if (!isset($this->authenticator)) {
            $authenticatorClass = self::AUTHENTICATORS[$config['authenticator']];
            $this->authenticator = new $authenticatorClass($config);
        }

        return $this->authenticator;
    }

    /**
     * Service for interacting with /wallets/ endpoints.
     *
     * @return WalletsService
     */
    public function wallets(): WalletsService
    {
        if (!isset($this->wallets)) {
            $this->wallets = new WalletsService($this->httpClient);
        }

        return $this->wallets;
    }

    /**
     * Service for interacting with /financialMovements/ endpoints.
     *
     * @return FinancialMovementsService
     */
    public function financialMovements(): FinancialMovementsService
    {
        if (!isset($this->financialMovements)) {
            $this->financialMovements = new FinancialMovementsService($this->httpClient);
        }

        return $this->financialMovements;
    }
}
