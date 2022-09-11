<?php namespace Tests\Repositories;

use App\Models\KostAvailability;
use App\Repositories\KostAvailabilityRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class KostAvailabilityRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var KostAvailabilityRepository
     */
    protected $kostAvailabilityRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->kostAvailabilityRepo = \App::make(KostAvailabilityRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_kost_availability()
    {
        $kostAvailability = KostAvailability::factory()->make()->toArray();

        $createdKostAvailability = $this->kostAvailabilityRepo->create($kostAvailability);

        $createdKostAvailability = $createdKostAvailability->toArray();
        $this->assertArrayHasKey('id', $createdKostAvailability);
        $this->assertNotNull($createdKostAvailability['id'], 'Created KostAvailability must have id specified');
        $this->assertNotNull(KostAvailability::find($createdKostAvailability['id']), 'KostAvailability with given id must be in DB');
        $this->assertModelData($kostAvailability, $createdKostAvailability);
    }

    /**
     * @test read
     */
    public function test_read_kost_availability()
    {
        $kostAvailability = KostAvailability::factory()->create();

        $dbKostAvailability = $this->kostAvailabilityRepo->find($kostAvailability->id);

        $dbKostAvailability = $dbKostAvailability->toArray();
        $this->assertModelData($kostAvailability->toArray(), $dbKostAvailability);
    }

    /**
     * @test update
     */
    public function test_update_kost_availability()
    {
        $kostAvailability = KostAvailability::factory()->create();
        $fakeKostAvailability = KostAvailability::factory()->make()->toArray();

        $updatedKostAvailability = $this->kostAvailabilityRepo->update($fakeKostAvailability, $kostAvailability->id);

        $this->assertModelData($fakeKostAvailability, $updatedKostAvailability->toArray());
        $dbKostAvailability = $this->kostAvailabilityRepo->find($kostAvailability->id);
        $this->assertModelData($fakeKostAvailability, $dbKostAvailability->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_kost_availability()
    {
        $kostAvailability = KostAvailability::factory()->create();

        $resp = $this->kostAvailabilityRepo->delete($kostAvailability->id);

        $this->assertTrue($resp);
        $this->assertNull(KostAvailability::find($kostAvailability->id), 'KostAvailability should not exist in DB');
    }
}
