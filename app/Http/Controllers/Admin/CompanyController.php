<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Company;
use App\Country;
use App\Industry;
use App\SearchList;
use App\SearchListItem;
use App\Imports\CompaniesImport;
use Maatwebsite\Excel\Facades\Excel;

class CompanyController extends Controller
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
        $industry = Industry::find($request->industry_id);
        $keywords = $request->keywords;

        $query = Company::with(['country', 'city', 'industry']);

        if ($list) {

            $ids = SearchListItem::where('list_id', $list->id)
                ->whereNotNull('company_id')
                ->pluck('company_id')
                ->toArray();

            $query->whereIn('id', $ids);
        }

        if ($country) {
            $query->where('country_id', $country->id);
        }

        if ($industry) {
            $query->where('industry_id', $industry->id);
        }

        if ($keywords) {
            $query->where('keywords', 'LIKE', '%' . $keywords . '%');
        }

        $companies = $query->get();

        $countries = Country::all();
        $industries = Industry::all();
        $lists = SearchList::where('type', 'company')->get();

        return view('admin.companies.index', compact('companies', 'lists', 'countries', 'industries', 'list', 'country', 'industry', 'keywords'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        $industries = Industry::all();

        return view('admin.companies.create', compact('countries', 'industries'));
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
            'address1' => 'required|string|max:255',
            'region_id' => 'required|integer',
            'country_id' => 'required|integer',
            'city_id' => 'required|integer',
            'zip' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'category' => 'required|string|max:255',
            'employees' => 'required|string|max:255',
            'industry_id' => 'required|integer',
            'keywords' => 'string|max:255'
        ]);

        Company::create($data);

        return redirect()->route('admin.companies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);
        return view('admin.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        $countries = Country::all();
        $industries = Industry::all();

        return view('admin.companies.edit', compact('company', 'countries', 'industries'));
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
            'address1' => 'required|string|max:255',
            'region_id' => 'required|integer',
            'country_id' => 'required|integer',
            'city_id' => 'required|integer',
            'zip' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'category' => 'required|string|max:255',
            'employees' => 'required|string|max:255',
            'industry_id' => 'required|integer',
            'keywords' => 'string|max:255'
        ]);

        $company = Company::find($id);
        $company->update($data);

        return redirect()->route('admin.companies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Company::destroy($id);
        return redirect()->route('admin.companies.index');
    }

    public function importForm()
    {
        return view('admin.companies.import');
    }

    public function import(Request $request)
    {
        Excel::import(new CompaniesImport,request()->file('file'));
        return redirect()->route('admin.companies.index');
    }

    public function addToList(Request $request)
    {
        $item = SearchListItem::where([
            'list_id' => $request->list_id,
            'company_id' => $request->company_id
        ])->exists();

        if (!$item) {

            SearchListItem::create([
                'list_id' => $request->list_id,
                'company_id' => $request->company_id
            ]);
        }

        return redirect()->back()->with('message', 'Company added to the list successfully');
    }
}
