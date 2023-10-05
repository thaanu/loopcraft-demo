<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * This method generates authentication code
     * 
     * @return object   JSON response
     */
    function authenticate()
    {
        // Input Validation
        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required']
        ];

        // Validate
        validator(request()->all(), $rules)->validate();

        // Find the user
        $user = User::where('email', request('email'))->first();

        // Generate the token if the provided password matches with the stored password in database
        if ( Hash::check(request('password'), $user->getAuthPassword()) ) {

            // Return the response containing the token
            return Response()->json([
                'token' => $user->createToken(time())->plainTextToken
            ]);

        }

    }
}
