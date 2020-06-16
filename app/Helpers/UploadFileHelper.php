<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class UploadFileHelper {
    public function uploadAndStoreFile(Request $request) {
        $path = '';
        if ($request->hasFile('blfile')) {
            $supplier_name = $request->suppliers;
            $extension = $request->blfile->extension();
            $filename = "BL".date("Ymd").date("his").".".$extension;
            $path = $request->blfile->storeAs('uploads', $filename);
        }
        return $path;
    }
}