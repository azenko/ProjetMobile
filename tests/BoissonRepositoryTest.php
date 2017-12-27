<?php

use App\Models\Boisson;
use App\Repositories\BoissonRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BoissonRepositoryTest extends TestCase
{
    use MakeBoissonTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BoissonRepository
     */
    protected $boissonRepo;

    public function setUp()
    {
        parent::setUp();
        $this->boissonRepo = App::make(BoissonRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateBoisson()
    {
        $boisson = $this->fakeBoissonData();
        $createdBoisson = $this->boissonRepo->create($boisson);
        $createdBoisson = $createdBoisson->toArray();
        $this->assertArrayHasKey('id', $createdBoisson);
        $this->assertNotNull($createdBoisson['id'], 'Created Boisson must have id specified');
        $this->assertNotNull(Boisson::find($createdBoisson['id']), 'Boisson with given id must be in DB');
        $this->assertModelData($boisson, $createdBoisson);
    }

    /**
     * @test read
     */
    public function testReadBoisson()
    {
        $boisson = $this->makeBoisson();
        $dbBoisson = $this->boissonRepo->find($boisson->id);
        $dbBoisson = $dbBoisson->toArray();
        $this->assertModelData($boisson->toArray(), $dbBoisson);
    }

    /**
     * @test update
     */
    public function testUpdateBoisson()
    {
        $boisson = $this->makeBoisson();
        $fakeBoisson = $this->fakeBoissonData();
        $updatedBoisson = $this->boissonRepo->update($fakeBoisson, $boisson->id);
        $this->assertModelData($fakeBoisson, $updatedBoisson->toArray());
        $dbBoisson = $this->boissonRepo->find($boisson->id);
        $this->assertModelData($fakeBoisson, $dbBoisson->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteBoisson()
    {
        $boisson = $this->makeBoisson();
        $resp = $this->boissonRepo->delete($boisson->id);
        $this->assertTrue($resp);
        $this->assertNull(Boisson::find($boisson->id), 'Boisson should not exist in DB');
    }
}
