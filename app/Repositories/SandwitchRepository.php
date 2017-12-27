<?php

namespace App\Repositories;

use App\Models\Sandwitch;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SandwitchRepository
 * @package App\Repositories
 * @version December 27, 2017, 9:42 pm UTC
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
