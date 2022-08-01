<?php

namespace Tests\Feature;

use App\Models\MadLib;
use App\Models\MadLibInstance;
use App\Models\MadLibInstancePart;
use App\Models\MadLibPart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MadLibInstanceControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShow()
    {
        $madLib = MadLib::factory()->create();
        $madLibInstance = MadLibInstance::factory()->create(['mad_lib_id' => $madLib->id])->load('madLibInstanceParts', 'madLibInstanceParts.madLibPart');
        $response = $this->get("api/mad_lib/{$madLib->id}/instance/{$madLibInstance->id}");
        $response->assertStatus(200);
        $this->assertEqualsCanonicalizing($madLibInstance->toArray(), $response->json());
    }

    public function testCreatedSuccessfully()
    {
        $madLib = MadLib::factory()->create();

        $response = $this->json('POST', "api/mad_lib/{$madLib->id}/instance");
        $response->assertStatus(201);

        $this->assertSame($madLib->id, $response->json('mad_lib_id'));
    }

    public function testUpdatedSuccessfully()
    {
        $madLib = MadLib::factory()->create();
        $madLibInstance = MadLibInstance::factory()->create(['mad_lib_id' => $madLib->id])->load('madLibInstanceParts', 'madLibInstanceParts.madLibPart');

        $partContents = ['this', 'is', 'it'];
        $data = [
            'mad_lib_instance_parts' => $madLibInstance->madLibInstanceParts->map(fn(MadLibInstancePart $part) => ['id' => $part->id, 'content' => array_pop($partContents)])
        ];

        $response = $this->json('PATCH', "api/mad_lib/{$madLib->id}/instance/{$madLibInstance->id}", $data);
        $response->assertStatus(200);

        $actualParts = $response->collect('mad_lib_instance_parts')->map(fn(array $part) => ['id' => $part['id'], 'content' => $part['content']])->toArray();
        $this->assertSame($data['mad_lib_instance_parts']->toArray(), $actualParts);
    }

    public function testOutput()
    {
        $madLib = MadLib::factory()->create(['content' => 'There once was a girl who {blank} a {blank} and {blank} the whole {blank}.']);
        $madLibInstance = MadLibInstance::factory()->create(['mad_lib_id' => $madLib->id]);

        foreach (['cooked', 'pie', 'fed', 'jungle'] as $key => $content) {
            $madLibInstance->madLibInstanceParts->get($key)->setAttribute('content', $content)->save();
        }

        $response = $this->get("api/mad_lib/{$madLib->id}/instance/{$madLibInstance->id}/output");
        $response->assertStatus(200);

        $expectedOutput = 'There once was a girl who cooked a pie and fed the whole jungle.';
        $this->assertSame($expectedOutput, $response->content());
    }
}
