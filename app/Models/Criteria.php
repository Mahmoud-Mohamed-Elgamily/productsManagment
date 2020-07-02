<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Criteria
 * @package App\Models
 * @version July 2, 2020, 7:08 am UTC
 *
 * @property string $name
 * @property string $type
 */
class Criteria extends Model
{
  use SoftDeletes;

  public $table = 'criterias';


  protected $dates = ['deleted_at'];



  public $fillable = [
    'name',
    'type',
    'details'
  ];

  /**
   * The attributes that should be casted to native types.
   *
   * @var array
   */
  protected $casts = [
    'id' => 'integer',
    'name' => 'string',
    'type' => 'string',
    'details' => 'json',
  ];

  /**
   * Validation rules
   *
   * @var array
   */
  public static $rules = [
    'name' => 'required|min:3|unique:criterias',
    'type' => 'required',
    'details' => 'required',
  ];
}
