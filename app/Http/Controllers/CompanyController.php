<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $companyData = Company::all();
        return view('company.list', compact('companyData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyStoreRequest $request)
    {
        $logoFileName = "";
        try{
            $companyData = [
                Company::NAME =>    trim($request->get("companyName")),
                Company::EMAIL =>   trim($request->get("companyEmail")),
                Company::LOGO =>    "",
                Company::WEBSITE => trim($request->get("companyWebsite"))
            ];

            if($request->hasFile("companyLogo")){
                $extenstion = $request->companyLogo->getClientOriginalExtension();
                $logoFileName = time() . ".$extenstion";
                $request->file('companyLogo')->storeAs(
                    'public', $logoFileName
                );

                $companyData[Company::LOGO] = $logoFileName;

            }

            Company::create($companyData);

            return redirect(route('company'))->with('success', 'Company added successfully');
        }catch(\Exception $e){
            Storage::disk('public')->delete($logoFileName);
            return redirect(route('company'))->withErrors(["error"  =>  "Some error occured on server, please try again" ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
