<?php

namespace App\Repositories;

use App\Models\Dessert;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DessertRepository
 * @package App\Repositories
 * @version December 27, 2017, 9:42 pm UTC
 *
 * @method Dessert findWithoutFail($id, $columns = ['*'])
 * @method Dessert find($id, $columns = ['*'])
 * @method Dessert first($columns = ['*'])
*/
class DessertRepository extends BaseRepository
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
        return Dessert::class;
    }
}
