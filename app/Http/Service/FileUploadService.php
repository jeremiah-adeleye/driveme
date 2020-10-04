<?php


namespace App\Http\Service;


class FileUploadService{

    public function cloudinaryUpload($file) {
        $response = cloudinary()->upload($file->getRealPath(), ['transformation' => 'ar_1:1,c_fill,g_face,h_200,q_100,r_100,w_200']);
        return $response->getSecurePath();
    }
}
