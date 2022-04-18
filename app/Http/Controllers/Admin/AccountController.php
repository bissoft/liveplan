<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Account;
use App\Company;
use App\Country;
use App\SearchList;
use App\SearchListItem;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = SearchList::find($request->list_id);
        $country = Country::find($request->country_id);
        $company = Company::find($request->company_id);
        $name = $request->name;
        $email = $request->email;
        $title = $request->title;

        $query = Account::with(['country', 'company']);

        if ($list) {

            $ids = SearchListItem::where('list_id', $list->id)
                ->whereNotNull('account_id')
                ->pluck('account_id')
                ->toArray();

            $query->whereIn('id', $ids);
        }

        if ($name) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        }

        if ($email) {
            $query->where('email', 'LIKE', '%' . $email . '%');
        }

        if ($title) {
            $query->where('title', 'LIKE', '%' . $title . '%');
        }

        if ($country) {
            $query->where('country_id', $country->id);
        }

        if ($company) {
            $query->where('company_id', $company->id);
        }

        $accounts = $query->get();

        $countries = Country::all();
        $companies = Company::all();
        $lists = SearchList::where('type', 'account')->get();

        return view('admin.accounts.index', compact('accounts', 'lists', 'countries', 'companies', 'list', 'name', 'email', 'title', 'country', 'company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        $companies = Company::all();

        return view('admin.accounts.create', compact('countries', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:accounts',
            'title' => 'required|string|max:255',
            // 'region_id' => 'required|integer',
            'country_id' => 'required|integer',
            // 'city_id' => 'required|integer',
            // 'zip' => 'required|string|max:255',
            'company_id' => 'required|integer',
        ]);

        Account::create($data);

        return redirect()->route('admin.accounts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account = Account::find($id);
        return view('admin.accounts.show', compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = Account::find($id);
        $countries = Country::all();
        $companies = Company::all();

        return view('admin.accounts.edit', compact('account', 'countries', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:accounts,email',
            'title' => 'required|string|max:255',
            // 'region_id' => 'required|integer',
            'country_id' => 'required|integer',
            // 'city_id' => 'required|integer',
            // 'zip' => 'required|string|max:255',
            'company_id' => 'required|integer',
        ]);

        $account = Account::find($id);
        $account->update($data);

        return redirect()->route('admin.accounts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Account::destroy($id);
        return redirect()->route('admin.accounts.index');
    }

    public function addToList(Request $request)
    {
        $item = SearchListItem::where([
            'list_id' => $request->list_id,
            'account_id' => $request->account_id
        ])->exists();

        if (!$item) {

            SearchListItem::create([
                'list_id' => $request->list_id,
                'account_id' => $request->account_id
            ]);
        }

        return redirect()->back()->with('message', 'Account added to the list successfully');
    }
    
  
}
