<?php

namespace App\Classes;

class UploadFile
{
    protected $filename;
    protected $max_file_size = 2097152;
    protected $extension;
    protected $path;

    public function getFilename()
    {
        return $this->filename;
    }

    protected function setFilename($file, $name = '')
    {
        if ($name = '') {
            $name = pathinfo($file, PATHINFO_FILENAME);
        }

        $name = strtolower(str_replace(['_', ' '], '-', $name));
        $hash = md5(microtime());
        $ext = $this->getFileExtension($file);

        $this->filename = "{$name}-{$hash}.{$ext}";
    }

    protected function getFileExtension($file)
    {
        return $this->extension = pathinfo($file, PATHINFO_EXTENSION);
    }

    public static function fileSize($file)
    {
        $fileObj = new static;
        return $file > $fileObj->max_file_size ? true : false;
    }

    public static function isImage($file)
    {
        $fileObj = new static;
        $ext = $fileObj->getFileExtension($file);
        $validExtensions = ['jpg', 'jpeg', 'png', 'bmp', 'gif'];
        
        if (!in_array(strtolower($ext), $validExtensions)) {
            return false;
        }

        return true;
    }

    public function getPath()
    {
        return $this->path;
    }

    public static function move($temp_path, $folder, $file, $new_filename)
    {
        $fileObj = new static;
        $ds = DIRECTORY_SEPARATOR;

        $fileObj->setFilename($file, $new_filename);
        $filename = $fileObj->getFilename();

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $fileObj->path = "{$folder}{$ds}{$filename}";
        $absolute_path = BASE_PATH . "{$ds}public{$ds}{$fileObj->path}";

        if (move_uploaded_file($temp_path, $absolute_path)) {
            return $fileObj;
        }

        return null;
    }
}
