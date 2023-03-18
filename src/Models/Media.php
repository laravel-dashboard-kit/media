<?php

namespace LDK\Media\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Media extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'medias';

    protected $fillable = ['mediable_id', 'mediable_type', 'file_name', 'disk', 'type'];

    public static function booted()
    {
        static::deleting(function (self $media) {
            Storage::disk($media->disk)->delete($media->file_name);
        });
    }

    protected static function newFactory()
    {
        if (!Str::startsWith(static::class, "App\\Models")) {
            $factoryClass = str_replace("Models", "Database\\Factories", basename(static::class))."Factory";

            return new $factoryClass;
        }
    }

    //----------- Relationships

    public function mediable()
    {
        return $this->morphTo();
    }

    //----------- Getters

    public function getFileUrlAttribute()
    {
        return Storage::disk($this->disk)->url($this->file_name);
    }

    public function getFilePathAttribute()
    {
        return Storage::disk($this->disk)->path($this->file_name);
    }

    public function getBase64Attribute()
    {
        if (is_null($this->file_name) || ! Storage::disk('public')->exists($this->file_name)) {
            return 'data:image/svg+xml;base64, '.base64_encode('<?xml version="1.0" encoding="UTF-8"?><svg xmlns="http://www.w3.org/2000/svg" width="17"><path fill="#FFF" d="m4,4v9h9V4z"/></svg>');
        }

        return 'data:'.mime_type($this->file_path).';base64, '.base64_encode(Storage::disk('public')->get($this->file_name));
    }
}
