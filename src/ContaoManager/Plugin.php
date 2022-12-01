<?php

namespace LucasGehin\ContaoEastBarsBundle\ContaoManager;

use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\CoreBundle\ContaoCoreBundle;
use Symfony\Component\Routing\RouteCollection;
use LucasGehin\ContaoEastBarsBundle\ContaoEastBarsBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(ContaoEastBarsBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}