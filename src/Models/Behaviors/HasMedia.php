<?php

namespace LDK\Media\Models\Behaviors;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use LDK\Media\Models\Media;

trait HasMedia
{
    //----------- Relationships

    public function medias(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function media(): MorphOne
    {
        return $this->morphOne(Media::class, 'mediable')
            ->latestOfMany();
    }

    //----------- Getters

    public function single(string $type)
    {
        return $this->medias->firstWhere('type', $type);
    }

    public function multiple(string $type)
    {
        return $this->medias->where('type', $type);
    }

    public function getMediasUrlAttribute()
    {
        return $this->medias->pluck('file_url');
    }

    public function getMediaUrlAttribute()
    {
        return $this->medias->first()->file_url;
    }
}
