@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Employee</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Update Employee</h3>
                </div>

                <form action="{{ route('employee.update', $employee->{App\Models\Employee::ID}) }}" method="POST" enctype="multipart/form-data" id="employeeForm">
                    @csrf
                    @method('patch')
                    @include('employee.form')
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" onclick="verifyForm()">Submit</button>
                    </div>
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection
