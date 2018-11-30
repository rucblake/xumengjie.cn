<?php

namespace App\Services;

use App\Entities\Image;
use App\Exceptions\ErrorException;
use App\Libraries\Util\PageUtil;
use App\Repositories\ImageRepository;

class ImageService {

    protected $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function getImageList($currentPage, $pageSize)
    {
        $list = $this->imageRepository->getImageList($currentPage, $pageSize);
        return PageUtil::getCommonPage($list);
    }

    public function addSingleImage($file)
    {
        $uploadResult = $this->uploadFile($file);
        $params = [
            'hash_key'    => $uploadResult['hash_key'],
            'md5'         => md5_file($file->getPathname()),
            'origin_name' => $file->getClientOriginalName(),
            'url'         => $uploadResult['url'],
            'width'       => $uploadResult['width'],
            'height'      => $uploadResult['height'],
        ];
        $result = $this->imageRepository->create($params);
        return $params;
    }

    public function uploadFile($file)
    {
        if (empty($file)) {
            throw new ErrorException();
        }

        if ($file->getClientSize() > Image::LIMIT_IMG_SIZE) {
            throw new ErrorException(Image::LIMIT_IMG_SIZE);
        }
        $path = $file->getPathname();

        $result = $this->sendFile($path);

        if ($result['code'] == 200) {
            return [
                'hash_key' => $result['hash_key'],
                'url'      => env('IMAGE_SERVER_HOST'),
                'width'    => $result['width'],
                'height'   => $result['height'],
            ];
        }
        return false;
    }

    public function sendFile($path)
    {
        header('content-type:text/html;charset=utf8;');
        $curl = curl_init();
        $data = array('name' => 'image', 'file' => new \CURLFille($path));
        curl_setopt($curl, CURLOPT_URL, env('IMAGE_SERVER_HOST'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($curl);
        curl_close($curl);
        return json_decode($result, true);
    }
}