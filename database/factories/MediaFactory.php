<?php

namespace LDK\Media\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use LDK\Media\Models\Media;

class MediaFactory extends Factory
{
    protected $model = Media::class;

    public function definition()
    {
        $file = UploadedFile::fake()
            ->create('test.pdf')
            ->store('fake');

        return [
            'file_name' => $file,
            'disk' => 'public',
            'type' => 'default'
        ];
    }
}
