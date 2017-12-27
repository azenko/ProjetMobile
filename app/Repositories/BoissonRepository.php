<?php

namespace App\Repositories;

use App\Models\Boisson;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class BoissonRepository
 * @package App\Repositories
 * @version December 27, 2017, 9:41 pm UTC
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
