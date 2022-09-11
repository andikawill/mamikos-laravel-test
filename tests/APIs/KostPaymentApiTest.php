<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\KostPayment;

class KostPaymentApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_kost_payment()
    {
        $kostPayment = KostPayment::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/kost_payments', $kostPayment
        );

        $this->assertApiResponse($kostPayment);
    }

    /**
     * @test
     */
    public function test_read_kost_payment()
    {
        $kostPayment = KostPayment::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/kost_payments/'.$kostPayment->id
        );

        $this->assertApiResponse($kostPayment->toArray());
    }

    /**
     * @test
     */
    public function test_update_kost_payment()
    {
        $kostPayment = KostPayment::factory()->create();
        $editedKostPayment = KostPayment::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/kost_payments/'.$kostPayment->id,
            $editedKostPayment
        );

        $this->assertApiResponse($editedKostPayment);
    }

    /**
     * @test
     */
    public function test_delete_kost_payment()
    {
        $kostPayment = KostPayment::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/kost_payments/'.$kostPayment->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/kost_payments/'.$kostPayment->id
        );

        $this->response->assertStatus(404);
    }
}
