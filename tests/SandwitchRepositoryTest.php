<?php

use App\Models\Sandwitch;
use App\Repositories\SandwitchRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SandwitchRepositoryTest extends TestCase
{
    use MakeSandwitchTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SandwitchRepository
     */
    protected $sandwitchRepo;

    public function setUp()
    {
        parent::setUp();
        $this->sandwitchRepo = App::make(SandwitchRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSandwitch()
    {
        $sandwitch = $this->fakeSandwitchData();
        $createdSandwitch = $this->sandwitchRepo->create($sandwitch);
        $createdSandwitch = $createdSandwitch->toArray();
        $this->assertArrayHasKey('id', $createdSandwitch);
        $this->assertNotNull($createdSandwitch['id'], 'Created Sandwitch must have id specified');
        $this->assertNotNull(Sandwitch::find($createdSandwitch['id']), 'Sandwitch with given id must be in DB');
        $this->assertModelData($sandwitch, $createdSandwitch);
    }

    /**
     * @test read
     */
    public function testReadSandwitch()
    {
        $sandwitch = $this->makeSandwitch();
        $dbSandwitch = $this->sandwitchRepo->find($sandwitch->id);
        $dbSandwitch = $dbSandwitch->toArray();
        $this->assertModelData($sandwitch->toArray(), $dbSandwitch);
    }

    /**
     * @test update
     */
    public function testUpdateSandwitch()
    {
        $sandwitch = $this->makeSandwitch();
        $fakeSandwitch = $this->fakeSandwitchData();
        $updatedSandwitch = $this->sandwitchRepo->update($fakeSandwitch, $sandwitch->id);
        $this->assertModelData($fakeSandwitch, $updatedSandwitch->toArray());
        $dbSandwitch = $this->sandwitchRepo->find($sandwitch->id);
        $this->assertModelData($fakeSandwitch, $dbSandwitch->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSandwitch()
    {
        $sandwitch = $this->makeSandwitch();
        $resp = $this->sandwitchRepo->delete($sandwitch->id);
        $this->assertTrue($resp);
        $this->assertNull(Sandwitch::find($sandwitch->id), 'Sandwitch should not exist in DB');
    }
}
