<?php

use Illuminate\Support\Facades\Session;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Services\RegisterService;
namespace App\Http\Controllers;
use App\Services\ForgetService;
use App\Models\PasswordReset;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\ForgetMail;
use App\Http\Requests;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Redirect;
use Validator;
use Session;
use Stripe;
use Hash;
use Auth;
use Mail;
use DB;


class UserController extends Controller
{

    public function login(LoginRequest $request){

        try{

           if (!Auth::attempt(['email'=>$request->email, 'password'=> $request->password ,'user_type' => $request->user_type])) {

                return response()->json([ 'error' => 'Credentials does not match']);

            }

            $token = auth()->user()->createToken('API_Token')->plainTextToken;

            return response()->json(['success'=> 'Logged in successfully', 'user' =>  auth()->user() , 200])->header('x_auth_token', $token)->header('access-control-expose-headers' , 'x_auth_token');

        } catch(BadMethodCallException $e){

            return response()->json(['error'=> 'Email/Password is invalid.' ,404]);

        }
    }

    public function register(Request $request){
        $create = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ];
        $data = session(['user' => $request->all()]);
        //$value = $request->session()->get('user');
        return response()->json(['message' => 'Form submitted successfully']);

    }

    public function payment(Request $request){


        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = Stripe\Customer::create(array(
            "address" => [
                    "line1" => "Virani Chowk",
                    "postal_code" => "360001",
                    "city" => "Rajkot",
                    "state" => "GJ",
                    "country" => "IN",
            ],
            "email" => "demo@gmail.com",
            "name" => "Hardik Savani",
            "source" => $request->stripeToken
        ));
        $charge = Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "customer" => $customer->id,
                "description" => "Test payment from itsolutionstuff.com.",
                "shipping" => [
                    "name" => "Jenny Rosen",
                    "address" => [
                        "line1" => "510 Townsend St",
                        "postal_code" => "98140",
                        "city" => "San Francisco",
                        "state" => "CA",
                        "country" => "US",
                    ],
                ]

        ]); 
        Session::flash('success', 'Payment successful!');
        return back();

    }


    public function logout()
    {

        dd(auth()->user());
        if(!auth()->user()->tokens()->delete()) return response()->json('Server Error.', 400);
        return response()->json('You are logged out successfully', 200);
    }







}
