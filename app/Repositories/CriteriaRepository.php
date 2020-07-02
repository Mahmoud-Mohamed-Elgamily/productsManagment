<?php

namespace App\Repositories;

use App\Models\Criteria;
use App\Repositories\BaseRepository;

/**
 * Class CriteriaRepository
 * @package App\Repositories
 * @version July 2, 2020, 7:08 am UTC
*/

class CriteriaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'type'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Criteria::class;
    }
}
