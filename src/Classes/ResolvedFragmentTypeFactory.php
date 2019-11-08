<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Aztec\Form\Classes;

use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\ResolvedFormTypeFactoryInterface;
use Symfony\Component\Form\ResolvedFormTypeInterface;

/**
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class ResolvedFragmentTypeFactory implements ResolvedFormTypeFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createResolvedType(FormTypeInterface $type, array $typeExtensions, ResolvedFormTypeInterface $parent = null)
    {
        return new ResolvedFragmentType($type, $typeExtensions, $parent);
    }
}
