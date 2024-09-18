<?php

namespace App\Services\Path;

use Illuminate\Http\Request;

class TypeService
{
    public function type(Request $request){
        $type = $request->path();
        $type = str_replace('api/', '', $type);
        $parts = explode('/', $type);

        return $parts[3];
    }
}
