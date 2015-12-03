<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Photo extends Model
{
    public $fillable = ['description', 'filename', 'album_id'];

    public function fileUrl($value='')
    {
        $disk = Storage::disk('s3');
        if ($disk->exists($this->filename)) {
            $command = $disk->getDriver()->getAdapter()->getClient()->getCommand('GetObject', [
                'Bucket'                     => env('S3_BUCKET'),
                'Key'                        => $this->filename,
                'ResponseContentDisposition' => 'attachment;'
            ]);

            $request = $disk->getDriver()->getAdapter()->getClient()->createPresignedRequest($command, '+5 minutes');

            return (string) $request->getUri();
        }

    }
}
