<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerUpdateRequest;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    public function index(): Response
    {
        // $customers = User::get();
        $customers = User::where('id', '!=', auth()->user()->id)->get();

        return Inertia::render('Dashboard', [
            'customers' => $customers,
        ]);
    }

    public function add(): Response
    {
        return Inertia::render('Customer/Add');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:'.User::class,
            'date_of_birth' => 'date',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect(RouteServiceProvider::HOME)->with('message', 'Customer added');;
    }

    public function edit(Request $request): Response
    {
        $customer = User::find($request->id);

        return Inertia::render('Customer/Edit', [
            'customer' => $customer
        ]);
    }

    public function update(CustomerUpdateRequest $request): RedirectResponse
    {
        $customer = User::find($request->id);

        $customer->fill($request->validated());

        $customer->save();

        return Redirect::route('customer.edit', [
            'id' => $request->id
        ])->with('message', 'Customer updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $user = User::find($request->id);

        $user->delete();

        return Redirect::route('dashboard')->with('message', 'Customer deleted');
    }
}
