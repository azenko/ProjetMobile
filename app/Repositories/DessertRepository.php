<?php

namespace App\Repositories;

use App\Models\Dessert;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DessertRepository
 * @package App\Repositories
 * @version September 26, 2017, 11:25 am UTC
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
