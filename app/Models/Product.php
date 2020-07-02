<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App\Models
 * @version July 2, 2020, 6:39 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $criterias
 * @property string $name
 * @property string $description
 * @property string $vendor
 * @property integer $sale
 * @property string $mainImagePath
 * @property integer $criteria_id
 */
class Product extends Model
{
    use SoftDeletes;

    public $table = 'products';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'description',
        'vendor',
        'sale',
        'mainImagePath',
        'criteria_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'vendor' => 'string',
        'sale' => 'integer',
        'mainImagePath' => 'string',
        'criteria_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|min:3|unique:products',
        'description' => 'required|min:25',
        'vendor' => 'required',
        'criteria_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function criterias()
    {
        return $this->belongsToMany(\App\Models\Criteria::class);
    }
}
