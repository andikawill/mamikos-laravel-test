<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Kost;

class KostApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_kost()
    {
        $kost = Kost::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/kosts', $kost
        );

        $this->assertApiResponse($kost);
    }

    /**
     * @test
     */
    public function test_read_kost()
    {
        $kost = Kost::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/kosts/'.$kost->id
        );

        $this->assertApiResponse($kost->toArray());
    }

    /**
     * @test
     */
    public function test_update_kost()
    {
        $kost = Kost::factory()->create();
        $editedKost = Kost::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/kosts/'.$kost->id,
            $editedKost
        );

        $this->assertApiResponse($editedKost);
    }

    /**
     * @test
     */
    public function test_delete_kost()
    {
        $kost = Kost::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/kosts/'.$kost->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/kosts/'.$kost->id
        );

        $this->response->assertStatus(404);
    }
}
