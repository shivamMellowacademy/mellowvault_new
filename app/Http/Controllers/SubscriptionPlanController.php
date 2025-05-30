<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;

class SubscriptionPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptionPlans = SubscriptionPlan::latest()->take(4)->get();
        return view('admin/subscription_plans/index', compact('subscriptionPlans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subscription_plans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'plan_type' => 'required|string|max:100',
            'price' => 'required|numeric',
            'no_of_user_allowed' => 'required|integer',
            'duration' => 'required|integer',
        ]);

        SubscriptionPlan::create($request->all());

        return redirect()->route('subscription_plans.index')->with('success', 'Plan created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SubscriptionPlan $subscription_plan)
    {
        return view('subscription_plans.edit', compact('subscription_plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubscriptionPlan $subscription_plan)
    {
        $request->validate([
            'plan_type' => 'required|string|max:100',
            'price' => 'required|numeric',
            'no_of_user_allowed' => 'required|integer',
            'duration' => 'required|integer',
        ]);

        $subscription_plan->update($request->all());

        return redirect()->route('subscription_plans.index')->with('success', 'Plan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubscriptionPlan $subscription_plan)
    {
        $subscription_plan->delete();
        return redirect()->route('subscription_plans.index')->with('success', 'Plan deleted successfully.');
    }
}
