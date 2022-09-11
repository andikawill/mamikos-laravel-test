<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\KostAvailability;

class KostAvailabilityApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_kost_availability()
    {
        $kostAvailability = KostAvailability::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/kost_availabilities', $kostAvailability
        );

        $this->assertApiResponse($kostAvailability);
    }

    /**
     * @test
     */
    public function test_read_kost_availability()
    {
        $kostAvailability = KostAvailability::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/kost_availabilities/'.$kostAvailability->id
        );

        $this->assertApiResponse($kostAvailability->toArray());
    }

    /**
     * @test
     */
    public function test_update_kost_availability()
    {
        $kostAvailability = KostAvailability::factory()->create();
        $editedKostAvailability = KostAvailability::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/kost_availabilities/'.$kostAvailability->id,
            $editedKostAvailability
        );

        $this->assertApiResponse($editedKostAvailability);
    }

    /**
     * @test
     */
    public function test_delete_kost_availability()
    {
        $kostAvailability = KostAvailability::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/kost_availabilities/'.$kostAvailability->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/kost_availabilities/'.$kostAvailability->id
        );

        $this->response->assertStatus(404);
    }
}
