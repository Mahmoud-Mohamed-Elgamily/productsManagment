<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class TableController extends Controller
{
  public function createTable($table_name, $fields = [])
  {
    // check if table is not already exists
    if (!Schema::hasTable($table_name)) {
      Schema::create($table_name, function (Blueprint $table) use ($fields, $table_name) {
        $table->increments('id');
        if (count($fields) > 0) {
          foreach ($fields as $field) {
            $table->{$field['type']}($field['name']);
          }
        }
        $table->timestamps();
      });

      return response()->json(['message' => 'Given table has been successfully created!'], 200);
    }

    return response()->json(['message' => 'Given table is already existis.'], 400);
  }


  public function operate($tableName ,$tableFields)
  {
    $table_name = 'demo';

    $fields = [
      ['name' => 'field_1', 'type' => 'string'],
      ['name' => 'field_2', 'type' => 'text'],
      ['name' => 'field_3', 'type' => 'integer'],
      ['name' => 'field_4', 'type' => 'longText']
    ];

    return $this->createTable($table_name, $fields);
  }
  
  public function removeTable($table_name)
  {
    Schema::dropIfExists($table_name);

    return true;
  }
}
