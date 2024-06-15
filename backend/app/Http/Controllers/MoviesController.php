<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movies;

class MoviesController extends Controller
{
    public function index()
    {
        $data = Movies::all();

        return response()->json($data, 200);
    }

    public function highestRated()
    {
        $data = Movies::all();
        $sorted = $data->sortByDesc('rating')->values();

        return response()->json($sorted, 200);
    }

    public function mostViewed()
    {
        $data = Movies::all();
        $sorted = $data->sortByDesc('views')->values();

        return response()->json($sorted, 200);
    }

    public function dateAdded()
    {
        $data = Movies::all();
        $sorted = $data->sortByDesc('id')->values();

        return response()->json($sorted, 200);
    }

    public function search($search)
    {
        $data = Movies::where('title', 'like', '%' . $search . '%')
        ->orWhere('description', 'like', '%' . $search . '%')->get();

        return response()->json($data, 200);
    }

    public function show($id)
    {
        $data = Movies::find($id);

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $data = Movies::create($request->all());

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $movies = Movies::findOrFail($id);

        $data = $movies->update($request->all());

        return response()->json($data, 200);
    }

    public function delete(Request $request, $id)
    {
        $movies = Movies::findOrFail($id);
        $movies->delete();

        return response()->json('Movie successfully deleted.', 204);
    }
}
