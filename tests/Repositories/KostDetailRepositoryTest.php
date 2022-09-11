<?php namespace Tests\Repositories;

use App\Models\KostDetail;
use App\Repositories\KostDetailRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class KostDetailRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var KostDetailRepository
     */
    protected $kostDetailRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->kostDetailRepo = \App::make(KostDetailRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_kost_detail()
    {
        $kostDetail = KostDetail::factory()->make()->toArray();

        $createdKostDetail = $this->kostDetailRepo->create($kostDetail);

        $createdKostDetail = $createdKostDetail->toArray();
        $this->assertArrayHasKey('id', $createdKostDetail);
        $this->assertNotNull($createdKostDetail['id'], 'Created KostDetail must have id specified');
        $this->assertNotNull(KostDetail::find($createdKostDetail['id']), 'KostDetail with given id must be in DB');
        $this->assertModelData($kostDetail, $createdKostDetail);
    }

    /**
     * @test read
     */
    public function test_read_kost_detail()
    {
        $kostDetail = KostDetail::factory()->create();

        $dbKostDetail = $this->kostDetailRepo->find($kostDetail->id);

        $dbKostDetail = $dbKostDetail->toArray();
        $this->assertModelData($kostDetail->toArray(), $dbKostDetail);
    }

    /**
     * @test update
     */
    public function test_update_kost_detail()
    {
        $kostDetail = KostDetail::factory()->create();
        $fakeKostDetail = KostDetail::factory()->make()->toArray();

        $updatedKostDetail = $this->kostDetailRepo->update($fakeKostDetail, $kostDetail->id);

        $this->assertModelData($fakeKostDetail, $updatedKostDetail->toArray());
        $dbKostDetail = $this->kostDetailRepo->find($kostDetail->id);
        $this->assertModelData($fakeKostDetail, $dbKostDetail->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_kost_detail()
    {
        $kostDetail = KostDetail::factory()->create();

        $resp = $this->kostDetailRepo->delete($kostDetail->id);

        $this->assertTrue($resp);
        $this->assertNull(KostDetail::find($kostDetail->id), 'KostDetail should not exist in DB');
    }
}
