<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Posts;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function __invoke(Request $request, $post)
    {
        $post = Posts::withTrashed()->find($post);
        if($post->deleted_at != null){
            $post->forceDelete();
        } else {
            $post->delete();
        }
        return response([]);
    }
}
