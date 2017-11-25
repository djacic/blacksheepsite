var timesSubmited = 0;

//Regularni izrazi koji ce se koristiti pri proveri
var nameRegex = /^[A-Z][a-z]{1,20}[\s]*$/;
var emailRegex = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
var phoneRegex = /^[0-9\/-]{9,}$/;
var addressRegex = /^[a-zA-Z0-9\s,-\/]{2,30}$/;
var postRegex = /^[0-9]{5}$/;
var cityRegex = /[A-z]{2,}(\s[A-z]{2,})?/;

$(document).ready(function() {
  //Polja u koje ce se upisivati poruke za gresku pri proveri
  emailErrorField = $("#emailError");
  firstNameErrorField = $("#firstNameError");
  lastNameErrorField = $("#lastNameError");
  phoneErrorField = $("#phoneError");
  addressErrorField = $("#addressError");
  postErrorField = $("#postError");
  cityErrorField = $("#cityError");

  $("#regSubmit").click(function(event) {
    timesSubmited++;

    var errorsNum = 0;
    //Vrednosti polja koja ce se koristiti pri proveri
    var email = $("#email").val();
    var firstName = $("#firstName").val();
    var lastName = $("#lastName").val();
    var phone = $("#phone").val();
    var address = $("#address").val();
    var post = $("#post").val();
    var city = $("#city").val();

    if(!validateFieldValue(nameRegex,firstName,firstNameErrorField,"Ime nije u dobrom formatu."))errorsNum++;
    if(!validateFieldValue(nameRegex,lastName,lastNameErrorField,"Prezime nije u dobrom formatu."))errorsNum++;
    if(!validateFieldValue(emailRegex,email,emailErrorField,"Email adresa nije u dobrom formatu."))errorsNum++;
    if(!validateFieldValue(phoneRegex,phone,phoneErrorField,"Telefon nije u dobrom formatu."))errorsNum++;
    if(!validateFieldValue(addressRegex,address,addressErrorField,"Adresa nije u dobrom formatu. Primer: Vojvode Misica 11\A"))errorsNum++;
    if(!validateFieldValue(postRegex,post,postErrorField,"Poštanski broj nije u dobrom formatu. Primer: 11000"))errorsNum++;
    if(!validateFieldValue(cityRegex,city,cityErrorField,"Ime grada nije u dobrom formatu. Primer: Stara Pazova."))errorsNum++;

    console.log(errorsNum);
    if(errorsNum > 0) {
      $("#confirm").addClass("hidden");
      document.querySelector("#regSubmit").setAttribute("data-target", "");
    } else {
      document.querySelector("#regSubmit").setAttribute("data-target", "#confirm-content");
      $("#confirm").removeClass("hidden");
    }

  });

  //Provera regularnim izrazima na promenu vrednosti u polju
  $("#firstName").keyup(function(event) {
    validateFieldValue(nameRegex,event.target.value,firstNameErrorField,"Ime nije u dobrom formatu.");
  });
  $("#lastName").keyup(function(event) {
    validateFieldValue(nameRegex,event.target.value,lastNameErrorField,"Prezime nije u dobrom formatu.");
  });
  $("#email").keyup(function(event) {
    validateFieldValue(emailRegex,event.target.value,emailErrorField,"Email adresa nije u dobrom formatu.");
  });
  $("#phone").keyup(function(event) {
    validateFieldValue(phoneRegex,event.target.value,phoneErrorField,"Telefon nije u dobrom formatu. Primer: 066/555-333");
  });
  $("#address").keyup(function(event) {
    validateFieldValue(addressRegex,event.target.value,addressErrorField,"Adresa nije u dobrom formatu. Primer: Vojvode Misica 11\A");
  });
  $("#post").keyup(function(event) {
    validateFieldValue(postRegex,event.target.value,postErrorField,"Poštanski broj nije u dobrom formatu. Primer: 11000");
  });
  $("#city").keyup(function(event) {
    validateFieldValue(cityRegex,event.target.value,cityErrorField,"Ime grada nije u dobrom formatu. Primer: Stara pazova.");
  });

});


/*
 Regex - obrazac na osnovu kog se proverava
 ValueToValidate - vrednost iz tekstualnog polja koju treba potvrditi
 errorField - polje u kom ce se ispisati error
 failedText - poruka koja se salje ako validacija nije uspela
 */
function validateFieldValue(regex,valueToValidate,errorField,failedText) {
  if (timesSubmited) {
    if (valueToValidate != "") {
      if (!regex.test(valueToValidate)) {
        return fadeInError(errorField, failedText);
      }else{
        return  fadeOutError(errorField);
      }
    } else {
      return fadeInError(errorField, "Ovo polje je obavezno.");
    }
  }
}

//Funkcija za prikazivanje gresaka, prosledjuje joj se polje u kom se greska prikazuje
//I tekst greske koju treba da prikaze, kao rezultat vraca false
function fadeInError(field, error) {
  $("#confirm").addClass("hidden");
  field.removeClass('hidden');
  field.html(error);
  return false;
}

//Funkcija za uklananje prikazane greske, ocekuje polje koje treba da sakrije
//Kao rezultat vraca true
function fadeOutError(field) {
  field.addClass('hidden');
  return true;
}