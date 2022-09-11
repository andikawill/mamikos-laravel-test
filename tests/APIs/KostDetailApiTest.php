<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\KostDetail;

class KostDetailApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_kost_detail()
    {
        $kostDetail = KostDetail::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/kost_details', $kostDetail
        );

        $this->assertApiResponse($kostDetail);
    }

    /**
     * @test
     */
    public function test_read_kost_detail()
    {
        $kostDetail = KostDetail::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/kost_details/'.$kostDetail->id
        );

        $this->assertApiResponse($kostDetail->toArray());
    }

    /**
     * @test
     */
    public function test_update_kost_detail()
    {
        $kostDetail = KostDetail::factory()->create();
        $editedKostDetail = KostDetail::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/kost_details/'.$kostDetail->id,
            $editedKostDetail
        );

        $this->assertApiResponse($editedKostDetail);
    }

    /**
     * @test
     */
    public function test_delete_kost_detail()
    {
        $kostDetail = KostDetail::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/kost_details/'.$kostDetail->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/kost_details/'.$kostDetail->id
        );

        $this->response->assertStatus(404);
    }
}
