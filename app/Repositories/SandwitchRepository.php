<?php

namespace App\Repositories;

use App\Models\Sandwitch;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SandwitchRepository
 * @package App\Repositories
 * @version September 26, 2017, 11:23 am UTC
 *
 * @method Sandwitch findWithoutFail($id, $columns = ['*'])
 * @method Sandwitch find($id, $columns = ['*'])
 * @method Sandwitch first($columns = ['*'])
*/
class SandwitchRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'label',
        'price'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Sandwitch::class;
    }
}
