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

namespace IBanFirst\Authenticator;

use IBanFirst\Exception\AuthenticatorException;
use IBanFirst\Request\RequestInterface;

class UsernameTokenAuthenticator implements AuthenticatorInterface
{
    private string $username;

    private string $password;

    public function __construct(array $config)
    {
        $this->validateConfig($config);

        $this->username = $config['username'];
        $this->password = $config['password'];
    }

    /**
     * This method should throws an exception
     * if there are some missing configs for this authenticator.
     *
     * @param array $config
     *
     * @throws AuthenticatorException
     */
    private function validateConfig(array $config): void
    {
        $requiredKeys = ['username', 'password'];

        foreach ($requiredKeys as $requiredKey) {
            if (!isset($config[$requiredKey])) {
                throw new AuthenticatorException(
                    sprintf('Missing required option "%s".', $requiredKey)
                );
            }

            if (!is_string($config[$requiredKey])) {
                throw new AuthenticatorException(
                    sprintf('Option "%s" can only be a string, "%s" given.', $requiredKey, gettype($config[$requiredKey]))
                );
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function authenticate(RequestInterface $request): RequestInterface
    {
        // Making the nonce and the encoded nonce
        $nonce = '';
        $chars = '0123456789abcdef';
        for ($i = 0; $i < 32; $i++) {
            $nonce .= $chars[rand(0, 15)];
        }
        $nonce64 = base64_encode($nonce);

        // Getting the date at the right format (e.g. YYYY-MM-DDTHH:MM:SSZ)
        $date = gmdate('c');
        $date = substr($date, 0, 19) . 'Z';

        // Getting the password digest
        $digest = base64_encode(sha1($nonce . $date . $this->password, true));

        // Getting the X-WSSE header value
        $wsse = sprintf('UsernameToken Username="%s", PasswordDigest="%s", Nonce="%s", Created="%s"', $this->username, $digest, $nonce64, $date);

        // Authenticate the request by adding the WSSE header
        $request->replaceHeaders(['X-WSSE' => $wsse]);

        return $request;
    }
}