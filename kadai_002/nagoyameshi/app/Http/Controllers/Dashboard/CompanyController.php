<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('dashboard.company.index', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
            
            $company->name = $request->input('name');
            $company->postal_code = $request->input('postal_code');
            $company->address = $request->input('address');
            $company->representative = $request->input('representative');
            $company->capital = $request->input('capital');
            $company->business = $request->input('business');
            $company->number_of_employees = $request->input('number_of_employees');
            $company->save();
    
            return redirect()->route('dashboard.company.index')->with('message', '会社情報を更新しました。');
    }
}
