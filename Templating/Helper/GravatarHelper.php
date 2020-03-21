<?php

namespace Mluex\GravatarBundle\Templating\Helper;

use Mluex\GravatarBundle\GravatarApi;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Templating\Helper\Helper;

/**
 * Symfony 4 & 5 Helper for Gravatar. Uses Mluex\GravatarBundle\GravatarApi.
 *
 * @author     Thibault Duplessis
 * @author     Henrik Bjornskov <henrik@bearwoods.dk>
 * @author     Marius Luexmann <m.luexmann@gmail.com>
 */
class GravatarHelper extends Helper implements GravatarHelperInterface
{
    /**
     * @var GravatarApi
     */
    protected $api;

    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * Constructor.
     *
     * @param GravatarApi          $api
     * @param RouterInterface|null $router
     */
    public function __construct(GravatarApi $api, RouterInterface $router = null)
    {
        $this->api    = $api;
        $this->router = $router;
    }

    /**
     * @inheritdoc
     */
    public function getUrl(
        string $email,
        ?int $size = null,
        ?string $rating = null,
        ?string $default = null,
        bool $secure = true
    ): string {
        return $this->api->getUrl($email, $size, $rating, $default, $this->isSecure($secure));
    }

    /**
     * @inheritdoc
     */
    public function getUrlForHash(
        string $hash,
        ?int $size = null,
        ?string $rating = null,
        ?string $default = null,
        bool $secure = true
    ): string {
        return $this->api->getUrlForHash($hash, $size, $rating, $default, $this->isSecure($secure));
    }

    /**
     * @inheritdoc
     */
    public function getProfileUrl(string $email, bool $secure = true): string
    {
        return $this->api->getProfileUrl($email, $this->isSecure($secure));
    }

    /**
     * @inheritdoc
     */
    public function getProfileUrlForHash(string $hash, bool $secure = true): string
    {
        return $this->api->getProfileUrlForHash($hash, $this->isSecure($secure));
    }

    /**
     * @param string $email
     * @param array  $options
     *
     * @return string
     */
    public function render(string $email, array $options = []): string
    {
        $size    = isset($options['size']) ? $options['size'] : null;
        $rating  = isset($options['rating']) ? $options['rating'] : null;
        $default = isset($options['default']) ? $options['default'] : null;
        $secure  = $this->isSecure();

        return $this->api->getUrl($email, $size, $rating, $default, $secure);
    }

    /**
     * @inheritdoc
     */
    public function exists(string $email): bool
    {
        return $this->api->exists($email);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gravatar';
    }

    /**
     * Returns true if avatar should be fetched over secure connection.
     *
     * @param bool|null $preset
     *
     * @return bool
     */
    protected function isSecure(?bool $preset = true): bool
    {
        if (null !== $preset) {
            return (bool) $preset;
        }

        if (null === $this->router) {
            return false;
        }

        return 'https' == strtolower($this->router->getContext()->getScheme());
    }
}
