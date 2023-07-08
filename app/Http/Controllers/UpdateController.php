<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Posts;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Posts $post)
    {
        $data = $request->validated();
        $post->update($data);
        return response([]);
    }
}
