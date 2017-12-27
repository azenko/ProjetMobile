<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BoissonApiTest extends TestCase
{
    use MakeBoissonTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateBoisson()
    {
        $boisson = $this->fakeBoissonData();
        $this->json('POST', '/api/v1/boissons', $boisson);

        $this->assertApiResponse($boisson);
    }

    /**
     * @test
     */
    public function testReadBoisson()
    {
        $boisson = $this->makeBoisson();
        $this->json('GET', '/api/v1/boissons/'.$boisson->id);

        $this->assertApiResponse($boisson->toArray());
    }

    /**
     * @test
     */
    public function testUpdateBoisson()
    {
        $boisson = $this->makeBoisson();
        $editedBoisson = $this->fakeBoissonData();

        $this->json('PUT', '/api/v1/boissons/'.$boisson->id, $editedBoisson);

        $this->assertApiResponse($editedBoisson);
    }

    /**
     * @test
     */
    public function testDeleteBoisson()
    {
        $boisson = $this->makeBoisson();
        $this->json('DELETE', '/api/v1/boissons/'.$boisson->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/boissons/'.$boisson->id);

        $this->assertResponseStatus(404);
    }
}
