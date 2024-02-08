<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class Form extends Controller
{
    public function SignUp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email'
        ]);

        $result = User::create([
            'email' => $request->email
        ]);

        // return response()->json(['user' => $user, 'message' => 'User registered successfully'], 201);


        // Return the result of the insertion operation (true/1 if successful, false otherwise)
        return $result;
    }

    public function signIn(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = Str::random(80);
        $user->update(['api_token' => hash('sha256', $token)]);

        return response()->json(['user' => $user, 'token' => $token, 'message' => 'User authenticated successfully']);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Implement logic for sending password reset email
        $token = Str::random(60); // Laravel helper function to generate a random string
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => now(),
            ]);

        return response()->json(['message' => 'Password reset email sent successfully']);
    }



        // Implement logic for resetting the password
        public function resetPassword(Request $request)
        {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6|confirmed',
                'token' => 'required',
            ]);

            $response = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password),
                        'remember_token' => Str::random(60),
                    ])->save();
                }
            );
        if ($response != Password::PASSWORD_RESET) {
            throw ValidationException::withMessages(['email' => [trans($response)]]);
        }

        return response()->json(['message' => 'Password reset successfully']);
        }

}
