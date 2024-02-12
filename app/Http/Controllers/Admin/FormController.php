<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use \Illuminate\Validation\ValidationException;

class FormController extends Controller
{
    public function GetStarted(Request $request)
    {
        $email = $request->email;
        // return $email;
        // exit();
        // $request->validate([
        //     'email' => 'required|email|unique:users,email'
        // ]);

        // Check if email already exists
        if(User::where('email', $email)->exists()){
            return response()->json(['message' => 'Email already exists'], 400);
        }

        $result = User::create([
            'email' => $request->email
        ]);

        $token = $result->createToken('user')->plainTextToken;

        return response()->json(['user' => $result, 'token' => $token, 'email' => $email, 'message' => 'User registered successfully'], 200);


    }
    // public function SignUp(Request $request)
    // {


    //     // $request->validate([
    //     //     'name' => 'required|name|unique:users,name',
    //     //     'email' => 'required|email|unique:users,email',
    //     //     'paswsword' => 'required|password|unique:users,password'
    //     // ]);

    //     $email = $request->email;

    //     if(User::where('email', $email)->exists()){
    //         $result = User::create([
    //             'name' => $request->name,

    //             'password' => $request->password
    //         ]);

    //         $token = $result->createToken('user')->plainTextToken;

    //         return response()->json(['user' => $result, 'token' => $token, 'message' => 'User registered successfully'], 201);

    //     }
    //     else{
    //         return response()->json(['message' => 'Email not found'], 404);
    //     }
    // }
    public function signUp(Request $request)
{
    try {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8' . ($request->has('password_confirmation') ? '|confirmed' : ''),
        ]);

        $result = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $result->createToken('user')->plainTextToken;

        // Return success response
        return response()->json(['user' => $result, 'token' => $token, 'message' => 'User registered successfully'], 201);

    } catch (ValidationException $e) {
        // Return validation error response
        return response()->json(['message' => $e->getMessage()], 400);

    } catch (\Exception $e) {
        // Log the exception
        \Log::error('Signup failed: ' . $e->getMessage());

        // Return error response
        return response()->json(['message' => 'Internal Server Error'], 500);
    }
}






public function signIn(Request $request)
{
    try {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('user')->plainTextToken;

            return response()->json(['user' => $user, 'token' => $token, 'message' => 'User authenticated successfully']);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    } catch (\Exception $e) {
        // Log the exception
        \Log::error('Sign-in failed: ' . $e->getMessage());

        // Return error response
        return response()->json(['message' => 'Internal Server Error'], 500);
    }
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
