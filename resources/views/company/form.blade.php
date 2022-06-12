<div class="card-body">
    <div class="form-group">
        <label for="nameInput">Name of Company</label>
        <input type="text" class="form-control @error('companyName') is-invalid @enderror" id="nameInput" placeholder="Enter company name"
            name="companyName" required value="{{ old("companyName", $company->{App\Models\Company::NAME}) }}">
        @error('companyName')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="companyEmail">Email address</label>
        <input type="email" class="form-control @error('companyEmail') is-invalid @enderror" id="companyEmail" placeholder="Enter company email"
            name="companyEmail" value="{{ old("companyEmail", $company->{App\Models\Company::EMAIL}) }}">
        @error('companyEmail')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="companyWebsite">Company Website</label>
        <input type="text" class="form-control @error('companyWebsite') is-invalid @enderror" id="companyWebsite"
            placeholder="Enter company website" name="companyWebsite" value=" {{ old("companyWebsite", $company->{App\Models\Company::NAME}) }} " >
        @error('companyEmail')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="logoInputFile">Logo</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input @error('companyLogo') is-invalid @enderror" id="logoInputFile" name="companyLogo">
                <label class="custom-file-label" for="logoInputFile">Choose logo</label>
            </div>
            @error('companyLogo')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

@section('scripts')
<script>

    function verifyForm() {
        let nameInput = document.getElementById("nameInput");

        let logoFile = document.getElementById("logoInputFile");

        if (nameInput.value.trim() == "") {
            alert("Please enter Company Name");
            return false;
        }

        if (logoFile.files.length > 1) {
            checkDimension();
        }else{
            handleSubmit();
        }

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
