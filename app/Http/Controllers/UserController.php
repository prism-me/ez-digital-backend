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
use App\Models\Project;
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
            $site_id = 0;

            if(Project::where('user_id', Auth::id())->count() > 0){
                $project = Project::where('user_id', Auth::id())->first();
                $site_id = $project->site_id;
            }

            return response()->json(['success'=> 'Logged in successfully', 'user' =>  auth()->user(), 'site_id' => $site_id , 200])->header('x_auth_token', $token)->header('access-control-expose-headers' , 'x_auth_token');

        } catch(BadMethodCallException $e){

            return response()->json(['error'=> 'Email/Password is invalid.' ,404]);

        }
    }


    public function test(){
        $randomPassword = "new" . Str::random(10) . "user";
        $create['password'] = bcrypt($randomPassword);
        dd($create);
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

    public function get_intent(Request $request){
        // 'amount' => $request['amount'],

        $intent = \Stripe\PaymentIntent::create([
            'amount' => 200,

            'currency' => 'aed',
        ]);

        return json_encode(array('client_secret' => $intent->client_secret));

    }

    public function payment(Request $request){
        $stripeToken = $request->stripeToken;
        // dd($stripeToken);


// dd($request);

        $stripe = Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = Stripe\Customer::create(array(
            "address" => [
                    "line1" => $request['line1'],
                    "postal_code" => $request['postal_code'],
                    "city" => $request['city'],
                    "state" => $request['state'],
                    "country" => $request['country'],
            ],
        "email" =>  $request['email'],
            "name" =>  $request['name'],
            "source" => $stripeToken
        ));
// dd($customer);
//         $intent = \Stripe\PaymentIntent::create([
//             'customer' => $customer->id,
//             'setup_future_usage' => 'off_session',
//             'amount' => 100 * $request['amount'],
//             'currency' => 'aed',
//             // In the latest version of the API, specifying the `automatic_payment_methods` parameter is optional because Stripe enables its functionality by default.
//             'automatic_payment_methods' => [
//               'enabled' => 'true',
//             ],
//           ]);

        //   dd($intent);

        // dd($customer);

        $charge = Stripe\Charge::create ([
                "amount" => 100 * 200,
                "currency" => "aed",
                "customer" => $customer->id,
                "description" => "Test payment for ez-digital",
        ]);
// dd($request->input('stripeToken'));
    //     $charge = Stripe\Charge::create ([
    //         "amount" => 100 * $request['amount'],
    //         "currency" => "aed",
    //         "description" => "Test payment for ez-digital",
    //         "source" => $stripeToken
    // ]);
        $previousUrl = URL::previous();
        $request1 = Request::create($previousUrl);
        $serviceDetail = $request1->segments();

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
