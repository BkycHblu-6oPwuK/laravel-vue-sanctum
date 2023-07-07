<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Posts;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $data['id_user'] = auth('sanctum')->user()->id;
        $post = Posts::create($data);
        return response()->json($post);
    }
}
