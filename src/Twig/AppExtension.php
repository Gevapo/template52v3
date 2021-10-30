<?php
/**
 * Created by Gevapo (geert) on 5/04/2021
 */

namespace App\Twig;


use Psr\Container\ContainerInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;
use Twig\Extension\AbstractExtension;
use App\Service\UploaderHelper;
use Twig\TwigFunction;

//
class AppExtension extends AbstractExtension implements ServiceSubscriberInterface
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('uploaded_asset', [
                $this, 'getUploadedAssetPath'
            ])
        ];
    }

    public function getUploadedAssetPath(string $path): string
    {
        return $this->container
            ->get(UploaderHelper::class)
            ->getPublicPath($path);
    }

    public static function getSubscribedServices(): array
    {
        return [
            UploaderHelper::class
        ];
    }



}
