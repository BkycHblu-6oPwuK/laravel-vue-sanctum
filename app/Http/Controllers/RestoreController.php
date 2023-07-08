<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Posts;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RestoreController extends Controller
{
    public function __invoke(Request $request, $post)
    {
        $post = Posts::withTrashed()->find($post);
        $post->restore();

        return response()->json($post);
    }
}
