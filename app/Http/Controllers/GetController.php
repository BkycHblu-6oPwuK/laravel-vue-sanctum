<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GetController extends Controller
{
    public function __invoke(Request $request)
    {
        if(request()->get('filter') === 'deleted'){
            $posts = Posts::onlyTrashed()->where('id_user', auth('sanctum')->user()->id)->where('deleted_at','>=',Carbon::now()->subDays(30));
        } else {
            $posts = Posts::where('id_user', auth('sanctum')->user()->id);
        }
        $posts = $posts->orderByDesc('id')->get();
        $posts = $posts->map(function ($post) {
            $post['date'] = Carbon::parse($post['created_at'])->format('d.m.Y');
            return $post;
        });

        return response()->json($posts);
    }
}
