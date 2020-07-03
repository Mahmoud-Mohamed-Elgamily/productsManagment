<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

  protected $casts = [
    'id' => 'integer',
    'name' => 'string',
    'type' => 'string',
    'details' => 'json',
  ];

  public static $rules = [
    'name' => 'required|min:3|unique:criterias',
    'type' => 'required',
    'details' => 'required',
  ];

  public function products()
  {
    return $this->belongsToMany(\App\Models\Product::class);
  }
}
