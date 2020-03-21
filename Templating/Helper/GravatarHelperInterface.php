<?php

namespace Mluex\GravatarBundle\Templating\Helper;

/**
 * Interface GravatarHelperInterface
 * @package Mluex\GravatarBundle\Templating\Helper
 */
interface GravatarHelperInterface
{
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
    ): string;

    /**
     * Returns a url for a gravatar for a given hash.
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
        string $hash,
        ?int $size = null,
        ?string $rating = null,
        ?string $default = null,
        bool $secure = true
    ): string;

    /**
     * Returns a url for a gravatar profile.
     *
     * @param string $email
     * @param bool   $secure
     *
     * @return string
     */
    public function getProfileUrl(string $email, bool $secure = true): string;

    /**
     * Returns a url for a gravatar profile, for the given hash.
     *
     * @param string $hash
     * @param bool   $secure
     *
     * @return string
     */
    public function getProfileUrlForHash(string $hash, bool $secure = true): string;

    /**
     * Returns true if a avatar could be found for the email.
     *
     * @param string $email
     *
     * @return bool
     */
    public function exists(string $email): bool;
}
