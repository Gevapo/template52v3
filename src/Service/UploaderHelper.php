<?php
/**
 * Created by Gevapo (geert) on 5/04/2021
 */

namespace App\Service;


use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\Asset\Context\RequestStackContext;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploaderHelper
{
    const PRODUCT_IMAGE = 'product_image';

    private string $uploadsPath;

    private RequestStackContext $requestStackContext;

    /**
     * UploaderHelper constructor.
     * @param string $uploadsPath
     * @param RequestStackContext $requestStackContext
     */
    public function __construct(string $uploadsPath, RequestStackContext $requestStackContext)
    {
        $this->uploadsPath = $uploadsPath;
        $this->requestStackContext = $requestStackContext;
    }

    /**
     * @param File $file
     * @return string
     */
    public function uploadProductImage(File $file): string
    {
        $destination = $this->uploadsPath.'/'.self::PRODUCT_IMAGE;

        if ($file instanceof UploadedFile) {
            $originalFilename = $file->getClientOriginalName();
        } else {
            $originalFilename = $file->getFilename();
        }

        $newFilename = Urlizer::urlize(pathinfo($originalFilename, PATHINFO_FILENAME)) .'-'.uniqid().'.'.$file->guessExtension();

        $file->move(
            $destination,
            $newFilename
        );

        return $newFilename;
    }

    /**
     * @param string $path
     * @return string
     */
    public function getPublicPath(string $path): string
    {
        return $this->requestStackContext
                ->getBasePath().'uploads/'.$path;
    }

}
