<div id="payment-address-content" class="panel-collapse collapse">
    <div class="panel-body row">
        <div class="col-md-6 col-sm-6">
            <h3>Lični podaci</h3>
            <div class="form-group">
                <label for="firstname">Ime <span class="require">*</span></label>
                <input type="text" id="firstName" class="form-control" value="">
                <p class="hidden text-danger" id="firstNameError"></p>
            </div>
            <div class="form-group">
                <label for="lastname">Prezime <span class="require">*</span></label>
                <input type="text" id="lastName" class="form-control" value="">
                <p class="hidden text-danger" id="lastNameError"></p>
            </div>
            <div class="form-group">
                <label for="email">E-Mail <span class="require">*</span></label>
                <input type="text" id="email" class="form-control" value="">
                <p class="hidden text-danger" id="emailError"></p>
            </div>
            <div class="form-group">
                <label for="telephone">Telefon <span class="require">*</span></label>
                <input type="text" id="phone" class="form-control" value="">
                <p class="hidden text-danger" id="phoneError"></p>
            </div>



        </div>
        <div class="col-md-6 col-sm-6">
            <h3>Adresa</h3>
            <div class="form-group">
                <label for="adresa1">Adresa <span class="require">*</span></label>
                <input type="text" id="address" class="form-control" value="">
                <p class="hidden text-danger" id="addressError"></p>
            </div>
            <div class="form-group">
                <label for="grad">Grad/Opstina <span class="require">*</span> </label>
                <input type="text" id="city" class="form-control" value="">
                <p class="hidden text-danger" id="cityError"></p>
            </div>
            <div class="form-group">
                <label for="postanskibroj">Poštanski broj <span class="require">*</span></label>
                <input type="text" id="post" class="form-control" value="">
                <p class="hidden text-danger" id="postError"></p>
            </div>
            <button class="btn btn-primary  pull-right" type="submit" data-toggle="collapse" data-parent="#checkout-page" id="regSubmit">Nastavite</button>
        </div>
    </div>
</div>
<script src="{{ asset("js/regValidation.js") }}">

</script>