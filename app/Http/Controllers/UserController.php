<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetRequest;
use Illuminate\Support\Facades\URL;
use App\Services\RegisterService;
use App\Services\ForgetService;
use App\Models\PasswordReset;
use App\Services\PaymentService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Models\PackagePrice;
use Illuminate\Support\Str;
use App\Models\Service;
use App\Models\Package;
use App\Models\Plan;
use App\Models\Project;
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

    public function login(LoginRequest $request)
    {

        try {

            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return response()->json(['error' => 'Credentials does not match']);
            }

            $token = auth()->user()->createToken('API_Token')->plainTextToken;
            $site_id = 0;

            if (Project::where('user_id', Auth::id())->count() > 0) {
                $project = Project::where('user_id', Auth::id())->first();
                $site_id = $project->site_id;
            }

            return response()->json(['success' => 'Logged in successfully', 'user' => auth()->user(), 'site_id' => $site_id, 200])->header('x_auth_token', $token)->header('access-control-expose-headers', 'x_auth_token');

        } catch (BadMethodCallException $e) {

            return response()->json(['error' => 'Email/Password is invalid.', 404]);

        }
    }


    public function payment(Request $request)
    {

        $previousUrl = URL::previous();
        $instance = Request::create($previousUrl);
        $serviceDetail = $instance->segments();

        if (count($serviceDetail) != 3) {

            $service = Service::where('route', $serviceDetail[1])->first();
            $package = Package::where('route', $serviceDetail[2])->first();
            $plan = Plan::where('route', $serviceDetail[3])->first();

        } else {

            $service = Service::where('route', $serviceDetail[0])->first();
            $package = Package::where('route', $serviceDetail[1])->first();
            $plan = Plan::where('route', $serviceDetail[2])->first();


        }

        $amount = PackagePrice::where('service_id', $service['id'])
            ->where('package_id', $package['id'])
            ->where('plan_id', $plan['id'])
            ->first();



        $gst = 5 / 100 * $amount['amount'];
        $total = $amount['amount'] + $gst;



        $stripeToken = $request->stripeToken;

        $stripe = Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $customer = Stripe\Customer::create(
            array(
                "address" => [
                    "line1" => $request['line1'],
                    "postal_code" => $request['postal_code'],
                    "city" => $request['city'],
                    "state" => $request['state'],
                    "country" => $request['country'],
                ],
                "email" => $request['email'],
                "name" => $request['name'],
                "source" => $stripeToken
            )
        );


        $charge = Stripe\Charge::create([
            "amount" => 100 * $total,
            "currency" => "aed",
            "customer" => $customer->id,
            "description" => "Test payment for ez-digital",
        ]);


        $payment = (new PaymentService())->makePayment($request->all(), $customer, $serviceDetail, $total);

        if ($payment) {

            return view('invoice.thankyou');
        } else {
            Session::flash('error', 'Something Went Wrong!');
            return back();
        }



    }


    public function logout()
    {

        dd(auth()->user());
        if (!auth()->user()->tokens()->delete())
            return response()->json('Server Error.', 400);
        return response()->json('You are logged out successfully', 200);
    }


    public function me()
    {
        return auth()->user();
    }


    public function changePassword(ResetRequest $request)
    {
        $data = $request->all();
        $user = (new UserService())->changePassword($data);
        return $user;
    }

    public function updateProfile(Request $request)
    {

        $data = $request->all();
        $user = (new UserService())->updateProfile($data);
        return $user;
    }


    public function currentPlan($id)
    {
        $user = User::with(
            'userPackages.service',
            'userPackages.plan',
            'userPackages.package'
        )->where('id', $id)->first();
        return response()->json(['data' => $user, 'status' => 200]);
    }








}