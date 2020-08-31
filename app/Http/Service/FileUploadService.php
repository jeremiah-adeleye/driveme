<?php


namespace App\Http\Service;


class FileUploadService{

    public function cloudinaryUpload($file, $userId) {
        $response = cloudinary()->upload($file->getRealPath());
        dump($response);
        dump($response->getSecurePath());

        return true;
    }
}
