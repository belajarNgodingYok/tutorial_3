<?php

namespace Tests\Feature;

use App\Series;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateLessonsTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_user_can_create_lessons()
    {
        //end point : admin/3/lesson
        $this->loginAdmin();
    	$this->withoutExceptionHandling();
        $series = factory(Series::class)->create();
        $lesson = [
            "title" => 'new lesson',
            'description' => 'new lesson description',
            'episode_number' => 23,
    		'video_id' => 222222
        ];

        $this->postJson("/admin/{$series->id}/lessons", $lesson)
        ->assertStatus(201)
        ->assertJson($lesson);

        $this->assertDatabaseHas('lessons', [
            'title' =>$lesson['title']
        ]);
    }
}
