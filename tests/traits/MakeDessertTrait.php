<?php

use Faker\Factory as Faker;
use App\Models\Dessert;
use App\Repositories\DessertRepository;

trait MakeDessertTrait
{
    /**
     * Create fake instance of Dessert and save it in database
     *
     * @param array $dessertFields
     * @return Dessert
     */
    public function makeDessert($dessertFields = [])
    {
        /** @var DessertRepository $dessertRepo */
        $dessertRepo = App::make(DessertRepository::class);
        $theme = $this->fakeDessertData($dessertFields);
        return $dessertRepo->create($theme);
    }

    /**
     * Get fake instance of Dessert
     *
     * @param array $dessertFields
     * @return Dessert
     */
    public function fakeDessert($dessertFields = [])
    {
        return new Dessert($this->fakeDessertData($dessertFields));
    }

    /**
     * Get fake data of Dessert
     *
     * @param array $postFields
     * @return array
     */
    public function fakeDessertData($dessertFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'label' => $fake->word,
            'price' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $dessertFields);
    }
}
