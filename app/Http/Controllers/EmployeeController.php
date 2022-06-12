<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeStoreRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employees = Employee::all();
        return view('employee.list', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $companies = Company::all();
        $employee = new Employee();
        return view('employee.create', compact('companies', 'employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeStoreRequest $request)
    {

        try{
            $empolyeeData = [
                Employee::FIRST_NAME    =>  trim($request->get("empFName")),
                Employee::LAST_NAME =>  trim($request->get("empLName")),
                Employee::EMAIL =>  trim($request->get("empEmail")),
                Employee::COMPANY_ID    =>  $request->get("eCompany"),
                Employee::PHONE =>  trim($request->get("empPhone")),
            ];

            Employee::create($empolyeeData);
            return redirect(route('employee'))->with('success', 'Employee added successfully');
        }catch(\Exception $e){
            return redirect(route('employee'))->withErrors(["error"  =>  "Some error occurred on server, please try again" ]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
        $companies = Company::all();

        return view('employee.edit', compact('employee','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
        try{

            $employee->{Employee::FIRST_NAME}    =  trim($request->get("empFName"));
            $employee->{Employee::LAST_NAME} =  trim($request->get("empLName"));
            $employee->{Employee::EMAIL} =  trim($request->get("empEmail"));
            $employee->{Employee::COMPANY_ID}    =  $request->get("eCompany");
            $employee->{Employee::PHONE} =  trim($request->get("empPhone"));
            $employee->save();
            return redirect(route('employee'))->with('success', 'Employee updated successfully');

        }catch(\Exception $e){
            return redirect(route('employee'))->withErrors(["error"  =>  "Some error occurred on server, please try again" ]);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect(route('employee'))->with('success', 'Employee updated successfully');

    }
}
