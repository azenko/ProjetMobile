<?php

namespace App\Repositories;

use App\Models\Boisson;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class BoissonRepository
 * @package App\Repositories
 * @version September 26, 2017, 11:24 am UTC
 *
 * @method Boisson findWithoutFail($id, $columns = ['*'])
 * @method Boisson find($id, $columns = ['*'])
 * @method Boisson first($columns = ['*'])
*/
class BoissonRepository extends BaseRepository
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
        return Boisson::class;
    }
}
