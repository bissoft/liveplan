<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class StripePaymentController extends Controller
{
    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
    }
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(Request $request)
    {
        if (!$request->session()->has('name')) {
            return redirect(route('register'));
        };
        $plans = $this->stripe->plans->all()->data;
        foreach ($plans as $plan) {
            $prod = $this->stripe->products->retrieve(
                $plan->product,
                []
            );
            $plan->product = $prod;
        }
        return view('checkout', ['plans' => $plans]);
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        if (!$request->session()->has('name')) {
            return redirect(route('register'));
        };
        $request->validate([
            'number' => 'required',
            'cvc' => 'required',
        ]);
        try {
            $payment_method = $this->stripe->paymentMethods->create([
                'type' => 'card',
                'card' => [
                    'number' => $request->number,
                    'exp_month' => $request->exp_month,
                    'exp_year' => $request->exp_year,
                    'cvc' => $request->cvc,
                ],
            ]);

            $user = User::create([
                'name' => $request->session()->get('name'),
                'company_name' => $request->session()->get('company_name'),
                'email' => $request->session()->get('email'),
                'password' => $request->session()->get('password'),
                'vat' => $request->session()->get('vat'),
                'job_title' => $request->session()->get('job_title'),
                'corporate_structure' => $request->session()->get('corporate_structure'),
                'phone' => $request->session()->get('phone'),
                'industry' => $request->session()->get('industry'),
                'address' => $request->session()->get('address'),
            ]);
            if(!$user)
            return redirect()->back()->withErrors(['User could not be registered. So Payment will not be accepted. Go Back and Register User first']);
            $user->newSubscription('default', $request->plan)->create($payment_method);
            Auth::login($user);
        } catch (Throwable $e) {
            return redirect()->back()->withErrors([$e->getMessage()])->withInput();
        }
        return redirect('/');
    }
}
