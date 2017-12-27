<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SandwitchApiTest extends TestCase
{
    use MakeSandwitchTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSandwitch()
    {
        $sandwitch = $this->fakeSandwitchData();
        $this->json('POST', '/api/v1/sandwitches', $sandwitch);

        $this->assertApiResponse($sandwitch);
    }

    /**
     * @test
     */
    public function testReadSandwitch()
    {
        $sandwitch = $this->makeSandwitch();
        $this->json('GET', '/api/v1/sandwitches/'.$sandwitch->id);

        $this->assertApiResponse($sandwitch->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSandwitch()
    {
        $sandwitch = $this->makeSandwitch();
        $editedSandwitch = $this->fakeSandwitchData();

        $this->json('PUT', '/api/v1/sandwitches/'.$sandwitch->id, $editedSandwitch);

        $this->assertApiResponse($editedSandwitch);
    }

    /**
     * @test
     */
    public function testDeleteSandwitch()
    {
        $sandwitch = $this->makeSandwitch();
        $this->json('DELETE', '/api/v1/sandwitches/'.$sandwitch->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/sandwitches/'.$sandwitch->id);

        $this->assertResponseStatus(404);
    }
}
