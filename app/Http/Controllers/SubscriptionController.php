<?php

namespace App\Http\Controllers;

use App\Mail\PurchaseMail;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use App\Http\Middleware\isEmployer;
use App\Http\Middleware\donotAllowUserToMakePayment;

class SubscriptionController extends Controller
{
    const WEEKLY_AMOUNT = 20;
    const MONTHLY_AMOUNT = 80;
    const YEARLY_AMOUNT = 200;
    const CURRENCY = 'USD';

    public function __construct()
    {
        $this->middleware(['auth', isEmployer::class]);
        $this->middleware([ donotAllowUserToMakePayment::class])->except('subscribe');
    }

    public function subscribe()
    {
        return view('subscription.index');
    }

    public function initiatePayment(Request $request)
    {
        $plans = array(
            'weekly' => [
                'id' => 'price_1OWzq2SJCVKu9fZqsuY8Bzfc',
                'name' => 'weekly',
                'description' => 'weekly payments',
                'price' => self::WEEKLY_AMOUNT,
                'currency' => self::CURRENCY,
                'quantity' => 1,
            ],
            'monthly' => [
                'id' => 'price_1OWztJSJCVKu9fZq0qSgyOip',
                'name' => 'monthly',
                'description' => 'monthly payments',
                'price' => self::MONTHLY_AMOUNT,
                'currency' => self::CURRENCY,
                'quantity' => 1,
            ],
            'yearly' => [
                'id' => 'price_1OWzukSJCVKu9fZqEiTCMtcs',
                'name' => 'yearly',
                'description' => 'yearly payments',
                'price' => self::YEARLY_AMOUNT,
                'currency' => self::CURRENCY,
                'quantity' => 1,
            ]
        );

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $selectPlan = null;
            if ($request->is('pay/weekly')) {
                $selectPlan = $plans['weekly'];
                $billingEnds = now()->addWeek()->startOfDay()->toDateString();
            } elseif ($request->is('pay/monthly')) {
                $selectPlan = $plans['monthly'];
                $billingEnds = now()->addMonth()->startOfDay()->toDateString();
            } elseif ($request->is('pay/yearly')) {
                $selectPlan = $plans['yearly'];
                $billingEnds = now()->addYear()->startOfDay()->toDateString();
            }

            if ($selectPlan) {
                $successURl = URL::signedRoute('payment.success', [
                    'plan' => $selectPlan['name'],
                    'billing_ends' => $billingEnds
                ]);
                $session = Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => [
                        [
                            [
                                'price' => $selectPlan['id'],
                                'quantity' => 1,
                            ]
                        ]
                    ],
                    'mode' => 'subscription',
                    'success_url' => $successURl,
                    'cancel_url' => route('payment.cancel')
                ]);
                return redirect($session->url);
            }
        } catch (\Exception $exception) {
            return response()->json($exception);
        }
    }

    public function paymentSuccess(Request $request)
    {
       $plan = $request->plan;
       $billing_ends = $request->billing_ends;
        User::where('id', auth()->user()->id)->update([
            'plan' => $plan,
            'billing_end' => $billing_ends,
            'status' => 'paid',
        ]);

        try {
            Mail::to(auth()->user())->queue(new PurchaseMail($plan,$billing_ends));
        }catch (\Exception $e){
            return response()->json($e);
        }

        return redirect()->route('dashboard')->with('success','Payment Successfully proceed');
    }

    public function cancel()
    {
        return redirect()->route('dashboard')->with('error','Payment Unsuccessfully');
    }
}
