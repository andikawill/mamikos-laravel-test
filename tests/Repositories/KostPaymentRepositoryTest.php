<?php namespace Tests\Repositories;

use App\Models\KostPayment;
use App\Repositories\KostPaymentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class KostPaymentRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var KostPaymentRepository
     */
    protected $kostPaymentRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->kostPaymentRepo = \App::make(KostPaymentRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_kost_payment()
    {
        $kostPayment = KostPayment::factory()->make()->toArray();

        $createdKostPayment = $this->kostPaymentRepo->create($kostPayment);

        $createdKostPayment = $createdKostPayment->toArray();
        $this->assertArrayHasKey('id', $createdKostPayment);
        $this->assertNotNull($createdKostPayment['id'], 'Created KostPayment must have id specified');
        $this->assertNotNull(KostPayment::find($createdKostPayment['id']), 'KostPayment with given id must be in DB');
        $this->assertModelData($kostPayment, $createdKostPayment);
    }

    /**
     * @test read
     */
    public function test_read_kost_payment()
    {
        $kostPayment = KostPayment::factory()->create();

        $dbKostPayment = $this->kostPaymentRepo->find($kostPayment->id);

        $dbKostPayment = $dbKostPayment->toArray();
        $this->assertModelData($kostPayment->toArray(), $dbKostPayment);
    }

    /**
     * @test update
     */
    public function test_update_kost_payment()
    {
        $kostPayment = KostPayment::factory()->create();
        $fakeKostPayment = KostPayment::factory()->make()->toArray();

        $updatedKostPayment = $this->kostPaymentRepo->update($fakeKostPayment, $kostPayment->id);

        $this->assertModelData($fakeKostPayment, $updatedKostPayment->toArray());
        $dbKostPayment = $this->kostPaymentRepo->find($kostPayment->id);
        $this->assertModelData($fakeKostPayment, $dbKostPayment->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_kost_payment()
    {
        $kostPayment = KostPayment::factory()->create();

        $resp = $this->kostPaymentRepo->delete($kostPayment->id);

        $this->assertTrue($resp);
        $this->assertNull(KostPayment::find($kostPayment->id), 'KostPayment should not exist in DB');
    }
}
