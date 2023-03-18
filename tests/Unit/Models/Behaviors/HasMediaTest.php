<?php

namespace LDK\Media\Tests\Unit\Models\Behaviors;

use Illuminate\Support\Facades\Storage;
use LDK\Media\Models\Media;
use LDK\Media\Tests\Stubs\FakeModel;
use LDK\Media\Tests\TestCase;

class HasMediaTest extends TestCase
{
    public function test_can_add_medias_to_model()
    {
        $model = FakeModel::create();

        $model->medias()->createMany(
            $medias = Media::factory(2)->make()->toArray()
        );

        $this->assertCount(2, $model->medias);
        $this->assertDatabaseHas('medias', [
            'mediable_id' => $model->id,
            'mediable_type' => FakeModel::class,
            'file_name' => $medias[0]['file_name']
        ]);
    }

    public function test_can_retrieve_latest_media()
    {
        $model = FakeModel::create();

        $model->medias()->createMany(
            $medias = Media::factory(2)->make()->toArray()
        );

        $this->assertEquals(Media::where('file_name',$medias[1]['file_name'])->first(), $model->media);
    }

    public function test_can_retrieve_single_media_by_type()
    {
        $model = FakeModel::create();

        $model->medias()->createMany([
            $media = Media::factory()->make(['type' => $type = $this->faker->macAddress])->toArray(),
            Media::factory()->make()->toArray()
        ]);

        $this->assertEquals(Media::where('file_name',$media['file_name'])->first(), $model->single($type));
    }

    public function test_can_retrieve_multiple_medias_by_type()
    {
        $model = FakeModel::create();

        $medias = Media::factory(3)->make(['type' => $type = $this->faker->macAddress])->toArray();

        $model->medias()->createMany([
            Media::factory()->make()->toArray(),
            ...$medias,
        ]);

        $this->assertEquals(
            Media::where('type', $type)->pluck('file_name', 'id'),
            $model->multiple($type)->pluck('file_name', 'id')
        );
    }

    public function test_can_get_media_url_directly_form_model()
    {
        $model = FakeModel::create();

        $model->medias()->create(
            $media = Media::factory()->make()->toArray(),
        );

        $this->assertEquals(
            Storage::disk($media['disk'])->url($media['file_name']),
            $model->media_url
        );
    }

    public function test_can_get_media_urls_directly_form_model()
    {
        $model = FakeModel::create();

        $model->medias()->createMany(
            $media = Media::factory(3)->make()->toArray(),
        );

        $this->assertEquals(
            array_map(fn($m) => Storage::disk($m['disk'])->url($m['file_name']), $media),
            $model->medias_url->toArray()
        );
    }
}
