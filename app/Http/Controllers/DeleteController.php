<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Posts;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function __invoke(Posts $post)
    {
        $post->delete();
        return response([]);
    }
}
