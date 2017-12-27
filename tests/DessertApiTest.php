<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DessertApiTest extends TestCase
{
    use MakeDessertTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateDessert()
    {
        $dessert = $this->fakeDessertData();
        $this->json('POST', '/api/v1/desserts', $dessert);

        $this->assertApiResponse($dessert);
    }

    /**
     * @test
     */
    public function testReadDessert()
    {
        $dessert = $this->makeDessert();
        $this->json('GET', '/api/v1/desserts/'.$dessert->id);

        $this->assertApiResponse($dessert->toArray());
    }

    /**
     * @test
     */
    public function testUpdateDessert()
    {
        $dessert = $this->makeDessert();
        $editedDessert = $this->fakeDessertData();

        $this->json('PUT', '/api/v1/desserts/'.$dessert->id, $editedDessert);

        $this->assertApiResponse($editedDessert);
    }

    /**
     * @test
     */
    public function testDeleteDessert()
    {
        $dessert = $this->makeDessert();
        $this->json('DELETE', '/api/v1/desserts/'.$dessert->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/desserts/'.$dessert->id);

        $this->assertResponseStatus(404);
    }
}
