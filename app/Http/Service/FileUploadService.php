<?php


namespace App\Http\Service;


class FileUploadService{

    public function cloudinaryUpload($file) {
        $response = cloudinary()->upload($file->getRealPath());
        return $response->getSecurePath();
    }
}
