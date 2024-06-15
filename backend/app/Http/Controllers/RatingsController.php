<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ratings;

class RatingsController extends Controller
{
    public function index()
    {
        $data = Ratings::all();

        return response()->json($data, 200);
    }

    public function show($id)
    {
        $data = Ratings::find($id);

        return response()->json($data, 200);
    }

    public function getCount($id)
    {
        $data = count(Ratings::where('movie_id', '=', $id)->get());

        return response()->json($data, 200);
    }

    public function searchUsername(Request $request)
    {
        $username = $request->input('username');
        $data = Ratings::where('username', '=', $username)->get();

        return response()->json($data, 200);
    }

    public function searchMovie($id)
    {
        $data = Ratings::where('movie_id', '=', $id)->get();

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $data = Ratings::create($request->all());

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $ratings = Ratings::findOrFail($id);

        $data = $ratings->update($request->all());

        return response()->json($data, 200);
    }

    public function delete(Request $request, $id)
    {
        $ratings = Ratings::findOrFail($id);
        $ratings->delete();

        return response()->json('Rating successfully deleted.', 204);
    }
}
