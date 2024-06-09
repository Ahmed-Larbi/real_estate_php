<?php

namespace App\Http\Controllers;

use App\Liked;
use Illuminate\Http\Request;

class LikedController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'account_id' => 'required|exists:accounts,id'
        ]);

        $likeds = Liked::where('account_id', $request->account_id)
            ->with('property') // Ensure you have a relationship defined in the Liked model to fetch the property details
            ->get();

        return response()->json($likeds);
    }

    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:posts,id',
            'account_id' => 'required|exists:accounts,id'
        ]);

        $liked = Liked::create($request->all());
        return response()->json($liked, 201);
    }

    public function show(Liked $liked)
    {
        return response()->json($liked, 200);
    }



    public function update(Request $request, Liked $liked)
    {
        $request->validate([
            'property_id' => 'required|exists:posts,id',
            'account_id' => 'required|exists:accounts,id'
        ]);

        $liked->update($request->all());
        return response()->json($liked, 200);
    }

    public function destroy(Liked $liked)
    {
        $liked->delete();
        return response()->json(null, 204);
    }
}

