<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProfileRequest;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function show(Profile $profile)
{
    if ($profile->user_id !== auth()->id()) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    return response()->json([
        'message' => 'Profile found',
        'profile' => $profile
    ], 200);
}


    public function store(StoreProfileRequest $request)
    {
       $profile = Profile::create([
    'user_id' => auth()->id(),
    'phone' => $request->phone,
    'address' => $request->address,
    'date_of_birth' => $request->date_of_birth,
    'bio' => $request->bio,
  ]);


        return response()->json([
            'message' => 'Profile created successfully',
            'profile' => $profile,
        ], 201);
    }
}
