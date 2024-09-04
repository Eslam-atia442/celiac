<?php

namespace App\Traits;


trait HelperTrait
{
    public function translateSettingColumn($data, $name)
    {
        $name = $name . "_" . app()->getLocale();
        return $data->$name;
    }

    public function generateFile($originalFile, $destination, $filename): void
    {
        $sourceFilePath = public_path($originalFile);  // Path to the file in the public directory
        $destinationPath = storage_path($destination);  // Path inside the storage directory
        \File::makeDirectory($destinationPath, 0755, true, true);
        \File::copy($sourceFilePath, $destinationPath . '/' . $filename);// Copy the file from public to storage
    }

    public function getFileSize($filePath)
    {
        if (\File::exists($filePath)) {
            $fileSize = filesize($filePath);
            return $this->formatSizeUnits($fileSize);
        }
        return '';
    }

    public function getFileExtension($filePath)
    {
        if (\File::exists($filePath)) {
            $fileInfo = pathinfo($filePath);
            return $fileInfo['extension']; // Get the file extension
        }
    }

    public function getFileInfo($filePath): mixed
    {
        if (\File::exists($filePath)) {
            $fileInfo = pathinfo($filePath);
            return $fileInfo; // Get the file extension
        }
        return [];
    }

    public function formatSizeUnits($bytes): mixed
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        $i = floor(log((float) $bytes, 1024));
        return @round($bytes / pow(1024, $i), 2) . ' ' . $units[$i];
    }
}
