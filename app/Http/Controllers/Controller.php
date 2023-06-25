<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected function updateAttribute()
		{
			$payload[request('attr')] = request('value');
      $model = request('model');
      $reflectionClass = '\\App\\Models\\'.$model;
      // call_user_func(array('\\App\\Models\\'.$model, '::update'), $payload);
      $reflectionClass::whereId(request('id'))->update($payload);
      return response()->json(['message' => 'ok']);
		}
}
