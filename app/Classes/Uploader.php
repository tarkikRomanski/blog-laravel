<?php
namespace App\Classes;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class Uploader
{
    public const OTHER_TYPE = 0;
    public const IMAGE_TYPE = 1;

    private static $uploadDirectory = 'public';
    /**
     * Moves file from temp folder to storage
     * @param UploadedFile $file
     * @return string
     */
    public function uploadFile(UploadedFile $file) {
        $filePath = $file->store(self::$uploadDirectory);
        $fileName = str_replace(self::$uploadDirectory . '/', '', $filePath);
        return $fileName;
    }

    /**
     * Returns file type by name.
     * @param $filename
     * @return int|null
     */
    public function getFileType($filename) {
        $path = self::$uploadDirectory . '/' . $filename;
        if (Storage::exists($path)) {
            $type = Storage::mimeType($path);
            if (stristr($type, 'image') !== false) {
                return self::IMAGE_TYPE;
            } else {
                return self::OTHER_TYPE;
            }
        }
        return null;
    }

    /**
     * Returns file from storage by name
     * @param $filename
     * @return \Illuminate\Http\Response
     */
    public function getUploadFile($filename) {
        $path = self::$uploadDirectory . '/' . $filename;


        if (!Storage::exists($path)) {
            abort(404);
        }

        $file = Storage::get($path);
        $type = Storage::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}