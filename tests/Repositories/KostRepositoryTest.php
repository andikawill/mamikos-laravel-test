<?php namespace Tests\Repositories;

use App\Models\Kost;
use App\Repositories\KostRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class KostRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var KostRepository
     */
    protected $kostRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->kostRepo = \App::make(KostRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_kost()
    {
        $kost = Kost::factory()->make()->toArray();

        $createdKost = $this->kostRepo->create($kost);

        $createdKost = $createdKost->toArray();
        $this->assertArrayHasKey('id', $createdKost);
        $this->assertNotNull($createdKost['id'], 'Created Kost must have id specified');
        $this->assertNotNull(Kost::find($createdKost['id']), 'Kost with given id must be in DB');
        $this->assertModelData($kost, $createdKost);
    }

    /**
     * @test read
     */
    public function test_read_kost()
    {
        $kost = Kost::factory()->create();

        $dbKost = $this->kostRepo->find($kost->id);

        $dbKost = $dbKost->toArray();
        $this->assertModelData($kost->toArray(), $dbKost);
    }

    /**
     * @test update
     */
    public function test_update_kost()
    {
        $kost = Kost::factory()->create();
        $fakeKost = Kost::factory()->make()->toArray();

        $updatedKost = $this->kostRepo->update($fakeKost, $kost->id);

        $this->assertModelData($fakeKost, $updatedKost->toArray());
        $dbKost = $this->kostRepo->find($kost->id);
        $this->assertModelData($fakeKost, $dbKost->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_kost()
    {
        $kost = Kost::factory()->create();

        $resp = $this->kostRepo->delete($kost->id);

        $this->assertTrue($resp);
        $this->assertNull(Kost::find($kost->id), 'Kost should not exist in DB');
    }
}
