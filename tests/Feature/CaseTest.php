<?php

namespace Tests\Feature;

use App\Models\CaseType;
use App\Models\POCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CaseTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setup(): void
    {
        parent::setUp();

        Artisan::call('db:seed');

        $this->user = User::factory()->hasAccess()->create();
    }

    public function test_get_cases_only_gets_user_cases(): void
    {
        // Arrange
        $otherUser = User::factory()->hasAccess()->create();
        
        POCase::factory()->count(5)->create(['user_id' => $this->user->id]);
        POCase::factory()->count(5)->create(['user_id' => $otherUser->id]);
        
        // Act
        $response = $this->actingAs($this->user)->json('GET', '/api/cases');
        $response2 = $this->actingAs($otherUser)->json('GET', '/api/cases');

        // Assert
        $response->assertStatus(200);
        $response2->assertStatus(200);
        $responseData = $response->json();
        $responseData2 = $response2->json();

        foreach ($responseData['data'] as $caseData) {
            $this->assertEquals($this->user->id, $caseData['user_id']);
        }
        foreach ($responseData2['data'] as $caseData) {
            $this->assertEquals($otherUser->id, $caseData['user_id']);
        }
    }

    public function test_create_new_case()
    {
        // Arrange
        $case_type = CaseType::first();
        $case_name = fake()->name();

        // Act
        $response = $this->actingAs($this->user)->json('POST', "/api/cases/$case_type->name", ['case-name' => $case_name]);
        $response2 = $this->actingAs($this->user)->json('POST', "/api/cases/$case_type->name");

        // Assert
        $response->assertStatus(200);
        $response2->assertStatus(400);
        $createdCase = POCase::first();

        $this->assertNotNull($createdCase);
        $this->assertEquals($this->user->id, $createdCase->user_id);
        $this->assertEquals($case_type->id, $createdCase->case_type_id);
    }

    public function test_case_soft_deletes()
    {
        // Arrange
        $case = POCase::factory()->create(['user_id' => $this->user->id]);
        
        // Act
        $response = $this->actingAs($this->user)->json('DELETE', "/api/cases/{$case->id}");

        // Assert
        $response->assertStatus(200);
        $this->assertSoftDeleted($case);
    }

    // public function testUploadFile()
    // {
    //     $user = User::factory()->create();
    //     $case = POCase::factory()->create(['user_id' => $user->id]);

    //     Storage::fake('public');

    //     $file = UploadedFile::fake()->create('document.pdf', 1000);

    //     $response = $this->actingAs($user)->json('POST', "/cases/{$case->id}/upload", [
    //         'file' => $file,
    //     ]);

    //     $response->assertStatus(200);

    //     $fileData = $response->json();

    //     $this->assertNotEmpty($fileData['path']);
    //     $this->assertEquals($file->getClientOriginalName(), $fileData['filename']);

    //     $expectedPath = "/userUploads/{$user->id}/caseFiles/{$case->id}/{$file->getClientOriginalName()}";
    //     Storage::disk('public')->assertExists($expectedPath);
    // }
}