<?php

namespace App\Http\Controllers;

use App\Package;
use App\PackageSale;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Stripe;

class StripeController extends Controller
{
    // public function __construct()
    // {
    //     $this->stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
    // }

    public function plan($id)
    {
        $package = Package::where('token', $id)->first();
        return view('plan', compact('package'));
    }
    public function plan_post(Request $request)
    {
        try {
            $package = Package::find($request->package_id);
            Stripe\Stripe::setApiKey(config('app.stripe_secret'));
            Stripe\Charge::create([
                "amount" => $package->price.'00',
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Package Purchased by " . Auth()->user()->email
            ]);

            if (Auth()->user()->paid == 0) {
                $user = User::find(Auth()->user()->id);
                $user->paid = 1;
                $user->expiry_date = Carbon::now()->addDay($package->days);
                $user->update();
            } else {
                $user = User::find(Auth()->user()->id);
                $user->expiry_date = $user->expiry_date->addDay($package->days);
                $user->update();
            }
            $packageSale = new PackageSale;
            $packageSale->package_id = $package->id;
            $packageSale->package_price = $package->price;
            $packageSale->package_days = $package->days;
            $packageSale->user_id = Auth()->user()->id;
            $packageSale->save();
            return redirect('Payment_successfully');
        } catch (\Exception $e) {
            return back()->with("error", $e->getMessage());
        }
    }

    // public function stripe()
    // {
    //     return view('plan');
    // }

    // public function makePayment(){
    //     return view('admin.stripe.create_plan');
    // }

    // public function createPlanForm(){
    //     return view('admin.stripe.create_plan');
    // }

    // public function createPlan(Request $request)
    // {
    //     $this->validate($request, [
    //         'name' => 'required|string|max:255',
    //         'amount' => 'required|numeric'
    //     ]);

    //     $stripeProduct = $this->stripe->products->create([
    //         'name' => $request->name,
    //     ]);
    //     if($request->type==0){
    //         $type = 'month';
    //     }else{
    //         $type = 'year';
    //     }
    //     $this->stripe->prices->create([
    //         'unit_amount' => $request->amount * 100,
    //         'currency' => 'usd',
    //         'recurring' => ['interval' => $type],
    //         'product' => $stripeProduct->id,
    //     ]);

    //     return redirect()->to('plans');
    // }
    // public function retrievePlans()
    // {
    //     $plans = $this->stripe->plans->all()->data;

    //     return view('admin.stripe.plans', compact('plans'));
    // }

    // public function retrieveSubscriptions(){
    //     $subscriptions = Subscription::get();
    //     return view('admin.stripe.subscriptions', ['subscriptions' => $subscriptions]);

    // }

    // public function subscribe()
    // {
    //     \Stripe\Stripe::setApiKey(config('app.stripe_secret'));
    //     $stripe = new \Stripe\StripeClient(config('app.stripe_secret'));
    //     $product = $stripe->products->create([
    //         'name' => 'Default Subscription',
    //     ]);

    //     $price = $stripe->prices->create([
    //         'unit_amount' => 10000,
    //         'currency' => 'usd',
    //         'recurring' => ['interval' => 'month'],
    //         'product' => $product->id
    //     ]);

    //     $session = \Stripe\Checkout\Session::create([
    //         'success_url' => url('subscribed?session_id={CHECKOUT_SESSION_ID}'),
    //         'cancel_url' => url('/'),
    //         'mode' => 'subscription',
    //         'line_items' => [[
    //             'price' => $price->id,
    //             'quantity' => 1
    //         ]],
    //     ]);

    //     session()->put('checkout_session_id', $session->id);

    //     return redirect()->to($session->url);
    // }

    // public function subscribed(Request $request)
    // {
    //     $subscription = Subscription::create([
    //         'user_id' => auth()->user()->id,
    //         'name' => 'default',
    //         'stripe_status' => 'active',
    //         'quantity' => 1,
    //         'stripe_id' => 'sub_123',
    //         'stripe_plan' => 'price_123',
    //         'ends_at' => \Carbon\Carbon::now()->addMonths(1)
    //     ]);

    //     session()->flash('success', 'You\'ve successfully subscribed to the default plan');
    //     return redirect()->to('/');
    // }

    // public function webhook(Request $request)
    // {
    //     $checkout_session_id = session()->get('checkout_session_id');

    //     if ($request->type == 'checkout.session.completed' && $request->data['object']['status'] == 'complete' && $checkout_session_id && $request->data['object']['id'] == $checkout_session_id) {

    //         $subscription = Subscription::create([
    //             'user_id' => auth()->user()->id,
    //             'name' => 'default',
    //             'stripe_status' => 'active',
    //             'quantity' => 1,
    //             'stripe_id' => $request->data['object']['subscription'],
    //             'stripe_plan' => $request->data['object']['subscription'],
    //             'ends_at' => \Carbon\Carbon::now()->addMonths(1)
    //         ]);
    //     }

    //     http_response_code(200);
    // }
}
