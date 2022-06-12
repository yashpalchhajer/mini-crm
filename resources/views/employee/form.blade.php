<div class="card-body">
    <div class="form-group">
        <label for="empLName">{{ __('employee.select_company')}}</label>
        <select name="eCompany" id="eCompany" class="form-control" required>
            <option value="">--select--</option>
            @foreach ($companies as $company)
                <option value="{{ $company->{App\Models\Company::ID} }}" @if ($company->{App\Models\Company::ID} == $employee->{App\Models\Employee::COMPANY_ID}) selected @endif > {{ $company->{App\Models\Company::NAME} }} </option>
            @endforeach
        </select>
        @error('eCompany')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="empFName"> {{ __('employee.first_name') }} </label>
        <input type="text" class="form-control @error('empFName') is-invalid @enderror" id="empFName" placeholder="Enter Employee First name"
            name="empFName" required value="{{ old("empFName", $employee->{App\Models\Employee::FIRST_NAME}) }}">
        @error('empFName')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="empLName">{{ __('employee.last_name') }}</label>
        <input type="text" class="form-control @error('empLName') is-invalid @enderror" id="empLName" placeholder="Enter Employee Last name"
            name="empLName" required value="{{ old("empLName", $employee->{App\Models\Employee::LAST_NAME}) }}">
        @error('empLName')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="empEmail">{{ __('employee.emp_email') }}</label>
        <input type="email" class="form-control @error('empEmail') is-invalid @enderror" id="empEmail" placeholder="Enter Employee Email"
            name="empEmail" value="{{ old("empEmail", $employee->{App\Models\Employee::EMAIL}) }}">
        @error('empEmail')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="empPhone">{{ __('employee.emp_phone') }}</label>
        <input type="email" class="form-control @error('empPhone') is-invalid @enderror" id="empPhone" placeholder="Enter Employee Phone"
            name="empPhone" value="{{ old("empPhone", $employee->{App\Models\Employee::PHONE}) }}">
        @error('empPhone')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

</div>

@section('scripts')
<script>

    function verifyForm() {

        let company = document.getElementById("eCompany");
        let fName = document.getElementById("empFName");
        let lName = document.getElementById("empLName");
        let phoneNo = document.getElementById("empPhone");
        if(company.value == ""){
            alert("{{ __('employee.err_company') }}");
            return false;
        }
        if(fName.value.trim() == ""){
            alert(" {{ __('employee.err_first_name') }} ");
            return false;
        }

        if(lName.value.trim() == ""){
            alert("{{__('employee.err_last_name')}}");
            return false;
        }

        let reg = new RegExp('^[0-9]*$');

        if(phoneNo.value.trim() != ""){
            let number = phoneNo.value;
            if(number.length != 10){
                alert("Please enter 10 digits of phone number");
                return false;
            }
            if(reg.test(number) == false){
                alert('Only digits are allowed in phone number');
                return false;
            }
        }


        handleSubmit();
    }



    function handleSubmit()
    {
        document.getElementById("employeeForm").submit();
    }

</script>
@endsection
