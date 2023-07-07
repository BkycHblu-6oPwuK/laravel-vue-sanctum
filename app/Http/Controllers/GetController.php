<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GetController extends Controller
{
    public function __invoke()
    {
        $posts = Posts::where('id_user', auth('sanctum')->user()->id)->get();

        $posts = $posts->map(function ($post) {
            $post['date'] = Carbon::parse($post['created_at'])->format('d.m.Y');
            return $post;
        });

        return response()->json($posts);
    }
}
