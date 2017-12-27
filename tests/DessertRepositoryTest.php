<?php

use App\Models\Dessert;
use App\Repositories\DessertRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DessertRepositoryTest extends TestCase
{
    use MakeDessertTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var DessertRepository
     */
    protected $dessertRepo;

    public function setUp()
    {
        parent::setUp();
        $this->dessertRepo = App::make(DessertRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateDessert()
    {
        $dessert = $this->fakeDessertData();
        $createdDessert = $this->dessertRepo->create($dessert);
        $createdDessert = $createdDessert->toArray();
        $this->assertArrayHasKey('id', $createdDessert);
        $this->assertNotNull($createdDessert['id'], 'Created Dessert must have id specified');
        $this->assertNotNull(Dessert::find($createdDessert['id']), 'Dessert with given id must be in DB');
        $this->assertModelData($dessert, $createdDessert);
    }

    /**
     * @test read
     */
    public function testReadDessert()
    {
        $dessert = $this->makeDessert();
        $dbDessert = $this->dessertRepo->find($dessert->id);
        $dbDessert = $dbDessert->toArray();
        $this->assertModelData($dessert->toArray(), $dbDessert);
    }

    /**
     * @test update
     */
    public function testUpdateDessert()
    {
        $dessert = $this->makeDessert();
        $fakeDessert = $this->fakeDessertData();
        $updatedDessert = $this->dessertRepo->update($fakeDessert, $dessert->id);
        $this->assertModelData($fakeDessert, $updatedDessert->toArray());
        $dbDessert = $this->dessertRepo->find($dessert->id);
        $this->assertModelData($fakeDessert, $dbDessert->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteDessert()
    {
        $dessert = $this->makeDessert();
        $resp = $this->dessertRepo->delete($dessert->id);
        $this->assertTrue($resp);
        $this->assertNull(Dessert::find($dessert->id), 'Dessert should not exist in DB');
    }
}
