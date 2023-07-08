<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Posts;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function __invoke(Request $request, $post)
    {
        $post = Posts::withTrashed()->find($post);
        $post['date'] = Carbon::parse($post['created_at'])->format('d.m.Y');

        return response()->json($post);
    }
}
