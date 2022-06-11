<div class="card-body">
    <div class="form-group">
        <label for="nameInput">Name of Company</label>
        <input type="email" class="form-control @error('companyName') is-invalid @enderror" id="nameInput" placeholder="Enter company name"
            name="companyName" required>
        @error('companyName')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="companyEmail">Email address</label>
        <input type="email" class="form-control @error('companyEmail') is-invalid @enderror" id="companyEmail" placeholder="Enter company email"
            name="companyEmail">
        @error('companyEmail')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="companyWebsite">Company Website</label>
        <input type="text" class="form-control @error('companyWebsite') is-invalid @enderror" id="companyWebsite"
            placeholder="Enter company website" name="companyWebsite" >
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
