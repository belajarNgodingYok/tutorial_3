<?php

namespace Tests\Feature;

use Storage;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateSeriesTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_user_can_create_a_series()
    {
        $this->withoutExceptionHandling();

        Storage::fake(config('filesystems.default'));

        $this->post('admin/series',[
            'title' => 'vuejs for the best',
            'description' => 'the best vue casts ever',
            'image' => UploadedFile::fake()->image('image-series.png')
        ])->assertRedirect()
        ->assertSessionHas('success', 'Series created successfully. ');

        Storage::disk(config('filesystems.default'))->assertExists(
            'series/'.str_slug('vuejs for the best').'.png'
        );

        $this->assertDatabaseHas('series', [
            'slug' => str_slug('vuejs for the best')
        ]);

    }

    public function test_a_series_must_be_created_with_a_title()
    {
        // $this->withoutExceptionHandling();
        $this->post('admin/series',[
            'description' => 'the best vue casts ever',
            'image' => UploadedFile::fake()->image('image-series.png')
        ])->assertSessionHasErrors('title');
    }

    public function test_a_series_must_be_created_with_a_description()
    {
        // $this->withoutExceptionHandling();
        $this->post('admin/series',[
            'title' => 'the best vue casts ever',
            'image' => UploadedFile::fake()->image('image-series.png')
        ])->assertSessionHasErrors('description');
    }

    public function test_a_series_must_be_created_with_an_image()
    {
        // $this->withoutExceptionHandling();
        $this->post('admin/series',[
            'title' => 'the best vue casts ever',
            'description' => 'the best vue casts ever'
        ])->assertSessionHasErrors('image');
    }

    public function test_a_series_must_be_created_with_an_image_which_is_actually_an_image()
    {
        // $this->withoutExceptionHandling();
        $this->post('admin/series',[
            'title' => 'the best vue casts ever',
            'description' => 'the best vue casts ever',
            'image' => 'STRING_INVALID_IMAGE' 
        ])->assertSessionHasErrors('image');
    }

}
