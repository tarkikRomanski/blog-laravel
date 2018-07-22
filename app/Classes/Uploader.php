<?php
namespace App\Classes;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class Uploader
{
    private static $uploadDirectory = 'public';
    /**
     * Moves file from temp folder to storage
     * @param UploadedFile $file
     * @return string
     */
    public function uploadFile(UploadedFile $file) {
        $filePath = $file->store(self::$uploadDirectory);
        $fileName = str_replace(self::$uploadDirectory . '/', '', $filePath);
        $filUrl = url('/storage/' . $fileName);
        return $filUrl;
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