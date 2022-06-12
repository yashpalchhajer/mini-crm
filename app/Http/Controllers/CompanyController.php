<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyRegisteredMail;
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
        $company = new Company();
        return view('company.create', compact('company'));
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

            try{
                Mail::to($companyData[Company::EMAIL])->send(new CompanyRegisteredMail);
            }catch(\Exception $e){

            }



            return redirect(route('company'))->with('success', 'Company added successfully');
        }catch(\Exception $e){
            Storage::disk('public')->delete($logoFileName);
            return redirect(route('company'))->withErrors(["error"  =>  "Some error occurred on server, please try again" ]);
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

        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyStoreRequest $request, Company $company)
    {

        $logoFileName = "";
        try{

            if($request->hasFile("companyLogo")){
                $extenstion = $request->companyLogo->getClientOriginalExtension();
                $logoFileName = time() . ".$extenstion";
                $request->file('companyLogo')->storeAs(
                    'public', $logoFileName
                );
                Storage::disk('public')->delete($company->{Company::LOGO});
                $company->{Company::LOGO} = $logoFileName;
            }

            $company->{Company::NAME} = trim($request->get("companyName"));
            $company->{Company::EMAIL} = trim($request->get("companyEmail"));
            $company->{Company::WEBSITE} = trim($request->get("companyWebsite"));
            $company->save();
            return redirect(route('company'))->with('success', 'Company updated successfully');
        }catch(\Exception $e){
            return redirect(route('company'))->withErrors(["error"  =>  "Some error occurred on server, please try again" ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect(route('company'))->with('success', 'Company Delete');
    }
}
