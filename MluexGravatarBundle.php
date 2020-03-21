<?php

namespace Mluex\GravatarBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class MluexGravatarBundle
 * @package Mluex\GravatarBundle
 */
class MluexGravatarBundle extends Bundle
{
    /**
     * @inheritDoc
     */
    public function getNamespace()
    {
        return __NAMESPACE__;
    }

    /**
     * @inheritDoc
     */
    public function getPath()
    {
        return __DIR__;
    }
}
