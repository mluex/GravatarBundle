<?php

namespace Mluex\GravatarBundle;

/**
 * Simple wrapper to the gravatar API
 * http://en.gravatar.com/site/implement/url.
 *
 * Usage:
 *      \Mluex\GravatarBundle\GravatarApi::getUrl('henrik@bearwoods.dk', 80, 'g', 'mm');
 *
 * @author     Thibault Duplessis <thibault.duplessis@gmail.com>
 * @author     Henrik Bjørnskov <henrik@bearwoods.dk>
 * @author     Marius Luexmann <m.luexmann@gmail.com>
 */
class GravatarApi
{
    /**
     * @var array Array of default options that can be overridden with getters and in the construct
     */
    protected $defaults = [
        'size'    => 80,
        'rating'  => 'g',
        'default' => null,
        'secure'  => true,
    ];

    /**
     * Constructor.
     *
     * @param array $options the array is merged with the defaults
     */
    public function __construct(array $options = [])
    {
        $this->defaults = array_merge($this->defaults, $options);
    }

    /**
     * Returns a url for a gravatar.
     *
     * @param string      $email
     * @param int|null    $size
     * @param string|null $rating
     * @param string|null $default
     * @param bool        $secure
     *
     * @return string
     */
    public function getUrl(
        string $email,
        ?int $size = null,
        ?string $rating = null,
        ?string $default = null,
        bool $secure = true
    ): string {
        $hash = md5(strtolower(trim($email)));

        return $this->getUrlForHash($hash, $size, $rating, $default, $secure);
    }

    /**
     * Returns a url for a gravatar for the given hash.
     *
     * @param string      $hash
     * @param int|null    $size
     * @param string|null $rating
     * @param string|null $default
     * @param bool        $secure
     *
     * @return string
     */
    public function getUrlForHash(
        $hash,
        ?int $size = null,
        ?string $rating = null,
        ?string $default = null,
        bool $secure = true
    ): string {
        $map = [
            's' => $size ?: $this->defaults['size'],
            'r' => $rating ?: $this->defaults['rating'],
            'd' => $default ?: $this->defaults['default'],
        ];

        $secure = isset($secure) ? $secure : $this->defaults['secure'];

        return ($secure ? 'https://secure' : 'http://www') . '.gravatar.com/avatar/' . $hash . '?' . http_build_query(array_filter($map));
    }

    /**
     * Returns a url for a gravatar profile.
     *
     * @param string $email
     * @param bool   $secure
     *
     * @return string
     */
    public function getProfileUrl(string $email, bool $secure = true): string
    {
        $hash = md5(strtolower(trim($email)));

        return $this->getProfileUrlForHash($hash, $secure);
    }

    /**
     * Returns a url for a gravatar profile for the given hash.
     *
     * @param string $hash
     * @param bool   $secure
     *
     * @return string
     */
    public function getProfileUrlForHash(string $hash, bool $secure = true): string
    {
        $secure = $secure ?: $this->defaults['secure'];

        return ($secure ? 'https://secure' : 'http://www') . '.gravatar.com/' . $hash;
    }

    /**
     * Checks if a gravatar exists for the email. It does this by checking for the presence of 404 in the header
     * returned. Will return null if fsockopen fails, for example when the hostname cannot be resolved.
     *
     * @param string $email
     *
     * @return bool|null Boolean if we could connect, null if no connection to gravatar.com
     */
    public function exists(string $email): ?bool
    {
        $path = $this->getUrl($email, null, null, '404');

        if (!$sock = @fsockopen('gravatar.com', 80, $errorNo, $error)) {
            return null;
        }

        fwrite($sock, 'HEAD ' . $path . " HTTP/1.0\r\n\r\n");
        $header = fgets($sock, 128);
        fclose($sock);

        return strpos($header, '404') ? false : true;
    }
}
