<?php
/**
 * @author Nicolas Charlton
 */

namespace App\Service\Util;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FileUploader
 * @package App\Service\Util
 */
class FileUploader
{
    private $targetDirectory;

    public function upload(UploadedFile $file) {
        $fileName = md5(uniqid() . '.' . $file->guessExtension());

        try {
            $file->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {

        }

        return $fileName;
    }

    public function setTargetDirecotry($dir) {
        $this->targetDirectory = $dir;
    }

    public function getTargetDirectory() {
        return $this->targetDirectory;
    }
}