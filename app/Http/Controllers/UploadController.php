<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;

class UploadController {
    public function uploadImage(Request $request)
    {
        if($request->hasFile('upload')) {
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $filenametostore = $filename.'_blog_image_'.time().'.'.$extension;
            $logo = asset('uploads/'.time().$filenametostore);
            //Upload the file
            $request->file('upload')->move(public_path('uploads'), $logo);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = $logo;

            $msg = 'Image added successfully';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }
}

?>