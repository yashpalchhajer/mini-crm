@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Company</h1>
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
                    <h3 class="card-title">Update Company</h3>
                </div>

                <form action="{{ route('company.update', $company->{App\Models\Company::ID}) }}" method="POST" enctype="multipart/form-data" id="companyForm">
                    @csrf
                    @method('patch')
                    @include('company.form')
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

@section('scripts')
<script>

    function verifyForm() {
        let nameInput = document.getElementById("nameInput");
        let companyEmail = document.getElementById("companyEmail");
        let companyWebsite = document.getElementById("companyWebsite");
        let logoFile = document.getElementById("logoInputFile");

        if (nameInput.value.trim() == "") {
            alert("Please enter Company Name");
            return false;
        }

        if (companyEmail.value.trim() == "") {
            alert("Please enter company Email");
            return false;
        }

        if (companyWebsite.value.trim() == "") {
            alert("Please enter company website");
            return false;
        }

        if (logoFile.files.length < 1) {
            alert("Please select logo file");
            return false;
        }

        checkDimension();

    }

    function checkDimension() {

        var fileUpload = document.getElementById("logoInputFile");

        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|jpeg|.png)$");

        if (regex.test(fileUpload.value.toLowerCase())) {
            //Check whether HTML5 is supported.
            if (typeof (fileUpload.files) != "undefined") {
                //Initiate the FileReader object.
                var reader = new FileReader();
                //Read the contents of Image File.
                reader.readAsDataURL(fileUpload.files[0]);
                reader.onload = function (e) {
                    //Initiate the JavaScript Image object.
                    var image = new Image();

                    //Set the Base64 string return from FileReader as source.
                    image.src = e.target.result;

                    //Validate the File Height and Width.
                    image.onload = function () {
                        var height = this.height;
                        var width = this.width;
                        if (height < 100 || width < 100) {
                            alert("Height and Width should be above 100px.");
                            return false;
                        }
                        handleSubmit();
                        return true;
                    };

                }
            } else {
                alert("This browser does not support HTML5.");
                return false;
            }
        } else {

            alert("Please select a valid Image file.");
            return false;
        }
    }

    function handleSubmit()
    {
        document.getElementById("companyForm").submit();
    }

</script>
@endsection
