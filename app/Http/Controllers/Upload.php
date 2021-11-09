<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Upload extends Controller
{
    /**
     * Method upload
     *
     * @param $request
     * @param $folder
     *
     * @return string
     */
    public static function upload($request, $folder)
    {
        $request->store($folder);

        $fileName = $request->hashName();

        return $fileName;
    }
}
