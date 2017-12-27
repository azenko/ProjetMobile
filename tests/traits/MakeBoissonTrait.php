<?php

use Faker\Factory as Faker;
use App\Models\Boisson;
use App\Repositories\BoissonRepository;

trait MakeBoissonTrait
{
    /**
     * Create fake instance of Boisson and save it in database
     *
     * @param array $boissonFields
     * @return Boisson
     */
    public function makeBoisson($boissonFields = [])
    {
        /** @var BoissonRepository $boissonRepo */
        $boissonRepo = App::make(BoissonRepository::class);
        $theme = $this->fakeBoissonData($boissonFields);
        return $boissonRepo->create($theme);
    }

    /**
     * Get fake instance of Boisson
     *
     * @param array $boissonFields
     * @return Boisson
     */
    public function fakeBoisson($boissonFields = [])
    {
        return new Boisson($this->fakeBoissonData($boissonFields));
    }

    /**
     * Get fake data of Boisson
     *
     * @param array $postFields
     * @return array
     */
    public function fakeBoissonData($boissonFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'label' => $fake->word,
            'price' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $boissonFields);
    }
}
