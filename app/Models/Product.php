<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    // 'criteria_id'
    'priced',
    'priceless',
  ];

  protected $casts = [
    'id' => 'integer',
    'name' => 'string',
    'description' => 'string',
    'vendor' => 'string',
    'sale' => 'integer',
    'mainImagePath' => 'string',
    // 'criteria_id' => 'integer'
  ];

  public static $rules = [
    'name' => 'required|min:3|unique:products',
    'description' => 'required|min:25',
    'vendor' => 'required',
    'mainImagePath' => 'required',
    'PricedCriteria_id' => 'required',
    // 'criteria_id' => 'required'
  ];

  public function criterias()
  {
    return $this->belongsToMany(\App\Models\Criteria::class)->as('subscription')->withTimestamps();
  }
}
