<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\URL;
use App\Services\RegisterService;
use App\Services\ForgetService;
use App\Models\PasswordReset;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\ForgetMail;
use App\Http\Requests;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Redirect;
use Validator;
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


    public function test(){
        $randomPassword = "new" . Str::random(10) . "user"; 
        $create['password'] = bcrypt($randomPassword);
        dd($create);
    }
    
   

    public function payment(Request $request){
        
        $previousUrl = URL::previous();
        $request = Request::create($previousUrl);
        $serviceDetail = $request->segments();

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        // $intent = \Stripe\PaymentIntent::create([
        //             'amount' => 1099,
        //             'currency' => 'aed',
        //         ]);
                
            
        
        $customer = $stripe->Customer::create(array(
            "address" => [
                    "line1" => $request['line1'],
                    "postal_code" => $request['postal_code'],
                    "city" => $request['city'],
                    "state" => $request['state'],
                    "country" => $request['country'],
            ],
        "email" =>  $request['email'],
            "name" =>  $request['name'],
            "source" => $request->input('stripeToken')
        ));
        return $customer;
       
        $charge = Stripe\Charge::create ([
                "amount" => 100 * $request['amount'],
                "currency" => "usd",
                "customer" => $customer->id,
                "description" => "Test payment from itsolutionstuff.com",
                "shipping" => [
                                "name" => $request['name'],
                                "address" => [
                                    "line1" => $request['line1'],
                                    "postal_code" => $request['postal_code'],
                                    "city" => $request['city'],
                                    "state" => $request['state'],
                                    "country" => $request['country'],
                                ],
                            ]
        ]); 
        $payment = (new PaymentService())->makePayment($request->all(),$customer , $serviceDetail);
   
        if($payment){

            Session::flash('success', 'Payment successful!');
            return back();
        }else{
           Session::flash('error', 'Something Went Wrong!');
            return back();
        }



    }


    public function logout()
    {

        dd(auth()->user());
        if(!auth()->user()->tokens()->delete()) return response()->json('Server Error.', 400);
        return response()->json('You are logged out successfully', 200);
    }


    public function me()
    {
        return auth()->user();
    }



  


}
