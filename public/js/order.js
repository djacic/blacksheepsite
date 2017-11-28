
function setDataFields(data) {
    $("#firstName").val(data.user.firstName);
    $("#lastName").val(data.user.lastName);
    $("#email").val(data.user.email);
    $("#address").val(data.user.address);
    $("#phone").val(data.user.phone);
    $("#city").val(data.user.city);
    $("#post").val(data.user.postNumber);
    var input = document.createElement('input');
    $(input).attr("type", "hidden");
    $(input).attr("id", "userId");
    $(input).attr("value", data.user.id);
    $("#payment-address-content").append(input);
}

function clearFields() {
    $("#firstName").val("");
    $("#lastName").val("");
    $("#email").val("");
    $("#address").val("");
    $("#phone").val("");
    $("#city").val("");
    $("#post").val("");
    $("#userId").remove();
}

function userByToken(sender)
{
    var token = $("#token").val();
    $.ajax({
        url : "http://localhost/blacksheep/blacksheepsite/public/index.php/token",
        data: {
            token : token
        },
        success : function(data) {
            if(data.status) {
                $("#tokenFeedbackSuccess").removeClass('hidden');
                $("#tokenFeedbackError").addClass('hidden');
                $("#tokenFeedbackSuccess").html('Nastavi kupovinu kao <strong>' + data.user.firstName + '</strong>' +
                    '&nbsp&nbsp<button data-parent="#checkout-page" data-toggle="collapse" data-target="#payment-address-content" id="sender" class="btn btn-primary btn-sm">Prihvati</button>&nbsp' +
                    '<button data-parent="#checkout-page" onclick="clearFields()" data-toggle="collapse" data-target="#payment-address-content" id="sender" class="btn btn-primary btn-sm">Otkazi</button>');
                setDataFields(data);


            } else {
                $("#sender").attr("data-target", "");
                $("#tokenFeedbackSuccess").addClass('hidden');
                $("#tokenFeedbackError").removeClass('hidden');
            }
        },
        error : function(xhr, status, err) {

        }
    });
}


function placeAnOrder()
{
    var obj = {
        firstName : $("#firstName").val(),
        lastName : $("#lastName").val(),
        email : $("#email").val(),
        phone : $("#phone").val(),
        address : $("#address").val(),
        city : $("#city").val(),
        postNumber : parseInt($("#post").val()),
    };

    if($("#userId").val()) obj.userId = $("#userId").val();

    $.ajax({
        url : base_url + "/checkout/buy",
        type : "post",
        data : obj,
        success : function(data) {
            console.log(data);
            if(data.status) {
                $("#milanko").fadeOut(function () {
                    $("#orderFeedback").addClass('alert alert-success');
                    $("#orderFeedback").html("<p class='text-center lead'>Porudžbina uspešno obavljena!</br><strong>Detaljne informacije su Vam poslate na priloženu email adresu.</strong></p>" +
                        "<p class='text-center text-info'>Pri sledećoj kupovini možete uneti kod: <strong>" + data.token + "</strong> kako ne biste iznova unosili podatke.</p>");
                });
            }
        },
        error : function(xhr, status, error) {
        }
    });
}
