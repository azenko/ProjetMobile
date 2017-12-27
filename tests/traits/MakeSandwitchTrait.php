<?php

use Faker\Factory as Faker;
use App\Models\Sandwitch;
use App\Repositories\SandwitchRepository;

trait MakeSandwitchTrait
{
    /**
     * Create fake instance of Sandwitch and save it in database
     *
     * @param array $sandwitchFields
     * @return Sandwitch
     */
    public function makeSandwitch($sandwitchFields = [])
    {
        /** @var SandwitchRepository $sandwitchRepo */
        $sandwitchRepo = App::make(SandwitchRepository::class);
        $theme = $this->fakeSandwitchData($sandwitchFields);
        return $sandwitchRepo->create($theme);
    }

    /**
     * Get fake instance of Sandwitch
     *
     * @param array $sandwitchFields
     * @return Sandwitch
     */
    public function fakeSandwitch($sandwitchFields = [])
    {
        return new Sandwitch($this->fakeSandwitchData($sandwitchFields));
    }

    /**
     * Get fake data of Sandwitch
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSandwitchData($sandwitchFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'label' => $fake->word,
            'price' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $sandwitchFields);
    }
}
