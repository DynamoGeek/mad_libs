<?php

namespace Tests\Feature;

use App\Models\MadLib;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MadLibControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexDisplays()
    {
        MadLib::factory()->count(3)->create();
        $response = $this->get('api/mad_lib')->json();
        $this->assertCount(3, $response);
        $this->assertCount(3, $response[0]['mad_lib_parts']);
    }

    public function testShows()
    {
        $madLib = MadLib::factory()->create();
        $response = $this->get('api/mad_lib/' . $madLib->id)->json();
        $this->assertSame($madLib->content, $response['content']);
        $this->assertEquals($madLib->madLibParts->toArray(), $response['mad_lib_parts']);
    }

    public function testCreatedSuccessfully()
    {
        $data = [
            'content' => 'There once was a girl who {blank} a {blank} and {blank} the whole {blank}.',
            'mad_lib_parts' => ['past tense verb', 'noun', 'past tense verb', 'noun'],
        ];
        $response = $this->json('POST', 'api/mad_lib', $data);
        $response->assertStatus(201);

        $madLibs = MadLib::all();
        $this->assertCount(1, $madLibs);
        $this->assertSame($data['content'], $madLibs[0]->content);
        $this->assertSame($data['mad_lib_parts'], $madLibs[0]->madLibParts->pluck('type')->toArray());
    }
}
