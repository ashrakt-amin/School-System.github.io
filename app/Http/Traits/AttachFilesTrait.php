<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait AttachFilesTrait
{
    public function uploadFile( $request , $name , $folder )
    {
        $file_name = $request->file($name)->getClientOriginalName();
        $request->file($name)->storeAs('attachments/',$folder.'/'.$file_name,'attachments');

    }

    public function deleteFile( $name , $folder)
    {
        $exists = Storage::disk('attachments')->exists('attachments/',$folder.'/'.$name);

        if($exists)
        {
            Storage::disk('attachments')->delete('attachments/',$folder.'/'.$name);
        }
    }
}