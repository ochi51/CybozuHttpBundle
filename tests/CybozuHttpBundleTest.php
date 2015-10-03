<?php

namespace CybozuHttpBundle\Tests;

use CybozuHttpBundle\CybozuHttpBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author ochi51 <ochiai07@gmail.com>
 */
class CybozuHttpBundleTest extends \PHPUnit_Framework_TestCase
{

    public function testBundle()
    {
        $container = new ContainerBuilder();
        $bundle    = new CybozuHttpBundle();
        $bundle->build($container);

        $this->assertTrue($bundle instanceof Bundle);
    }
}
