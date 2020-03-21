<?php

namespace Mluex\GravatarBundle\Twig;

use Mluex\GravatarBundle\Templating\Helper\GravatarHelperInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * @author Thibault Duplessis
 * @author Henrik Bjornskov   <hb@peytz.dk>
 * @author Marius Luexmann   <m.luexmann@gmail.com>
 */
class GravatarExtension extends AbstractExtension implements GravatarHelperInterface
{
    /**
     * @var GravatarHelperInterface
     */
    protected $baseHelper;

    /**
     * @param GravatarHelperInterface $helper
     */
    public function __construct(GravatarHelperInterface $helper)
    {
        $this->baseHelper = $helper;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('gravatar', [$this, 'getUrl']),
            new TwigFunction('gravatar_hash', [$this, 'getUrlForHash']),
            new TwigFunction('gravatar_profile', [$this, 'getProfileUrl']),
            new TwigFunction('gravatar_profile_hash', [$this, 'getProfileUrlForHash']),
            new TwigFunction('gravatar_exists', [$this, 'exists']),
        ];
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
        return $this->baseHelper->getUrl($email, $size, $rating, $default, $secure);
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
        return $this->baseHelper->getUrlForHash($hash, $size, $rating, $default, $secure);
    }

    /**
     * @inheritdoc
     */
    public function getProfileUrl(string $email, bool $secure = true): string
    {
        return $this->baseHelper->getProfileUrl($email, $secure);
    }

    /**
     * @inheritdoc
     */
    public function getProfileUrlForHash(string $hash, bool $secure = true): string
    {
        return $this->baseHelper->getProfileUrlForHash($hash, $secure);
    }

    /**
     * @inheritdoc
     */
    public function exists(string $email): bool
    {
        return $this->baseHelper->exists($email);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mluex_gravatar';
    }
}
