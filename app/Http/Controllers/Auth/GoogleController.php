<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Auth;

class GoogleController extends Controller
{
    /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function redirectToGoogle()
        {
            return Socialite::driver('google')->redirect();
        }


        public function handleGoogleCallback()
        {

            $user = Socialite::driver('google')->stateless()->user();
            // $user = Socialite::driver('google')->user();

            $this->_registerOrLoginUser($user);

            // Return home after login
            return redirect()->route('user.home');
        }

        protected function _registerOrLoginUser($data)
        {
            $user = User::where('email', '=', $data->email)->first();
            if (!$user) {
                $user = new User();
                $user->name = $data->name;
                $user->email = $data->email;
                $user->provider_id = $data->id;
                $user->password = encrypt('123456dummy');
                $user->type ='user';
                $user->email_verified_at = date("Y-m-d H:i:s");
                // return response()->json($user);
                 $user->save();
            }

            Auth::login($user);
        }


        // public function handleGoogleCallback()
        // {
        //     try {


        //         $user = Socialite::driver('google')->user();

        //         $finduser = User::where('google_id', $user->id)->first();

        //         if($finduser){

        //             Auth::login($finduser);

        //             return redirect()->intended('user/home');

        //         }else{
        //             $newUser = User::updateOrCreate(['email' => $user->email],[
        //                     'name' => $user->name,
        //                     'google_id'=> $user->id,
        //                     'password' => encrypt('123456dummy'),
        //                     'type' => 'user',
        //                     'email_verified_at' => date('Y-m-d H:i:s'),
        //                 ]);

        //             Auth::login($newUser);

        //             return redirect()->intended('user/home');
        //         }

        //     } catch (Exception $e) {
        //         dd($e->getMessage());
        //     }
        // }
}
