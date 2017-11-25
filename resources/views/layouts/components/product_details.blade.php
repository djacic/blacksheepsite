
<div class="col-md-6 col-sm-6 col-xs-3">
    <div class="product-main-image">
        <img id="productImage" src="" alt="" class="img-responsive">
    </div>
</div>
<div class="col-md-6 col-sm-6 col-xs-9">
    <h2 id="productName"></h2>
    <div class="price-availability-block clearfix">
        <div class="price">
            <strong id="offerPrice">Cena: <span></span></strong>
            <em><span id="actualPrice"></span></em>
        </div>
    </div>
    <div class="description">
        <p class="lead">Opis proizvoda:</p>
        <p id="productDescription"></p>
    </div>
    <br>
    <form action="{{ url("/order/add") }}" method="post">
    <div class="product-page-options hidden" id="hasColor">
        <div class="pull-left">
            <label class="control-label">Boja:</label>
            <select class="form-control input-sm" name="productColor" id="productColors">
                <option value="0">Odaberi boju</option>
            </select>
        </div>
    </div>
    <div class="product-page-cart">
            <div class="product-quantity">
                <input id="product-quantity" type="text" value="1" readonly name="productQuantity" class="form-control input-sm">
                <input type="hidden" id="id" name="productId" value="">
            </div>
            <button class="btn btn-primary" type="submit">Dodaj u korpu</button>

    </div>
        </form>
</div>

<script>
    function getProductDetails(id) {
        $.ajax({
            url : "http://www.blacksheepmobstore.com/final/public/index.php/products/product/" + id,
            success : function(data) {
                showProductDetails(data[0]);
            },
            error : function(xhr, status, error) {
                console.log(xhr);
            }
        });
    }
    function showProductDetails(product) {
        $("#hasColor").addClass('hidden');
        var picture = document.querySelector("#productImage");
        picture.src = "http://www.blacksheepmobstore.com/final/public/assets/pages/img/products/" + product.picture.file;
        picture.alt = product.picture.alt;


        if(product.is_offer) {
            for(let i = 0; i < product.prices.length; i++) {
                if(product.prices[i].is_offer) {
                    $("#offerPrice").html(product.prices[i].price + " RSD");
                    break;
                }
            }

            for(let i = 0; i < product.prices.length; i++) {
                if(!product.prices[i].is_offer) {
                    $("#actualPrice").html(product.prices[i].price + " RSD");
                    break;
                }
            }
        } else {
            for(let i = 0; i < product.prices.length; i++) {
                if(!product.prices[i].is_offer) {
                    $("#offerPrice").html(product.prices[i].price + " RSD");
                    $("#actualPrice").html("");
                    break;
                }
            }
        }
        $("#productName").html(product.name);
        $("#productDescription").html(product.description);
        if(product.colors.length) {
            $("#hasColor").removeClass('hidden');
            $("#productColors").empty();
            $.each(product.colors, function(i, item) {
                let option = document.createElement("option");
                option.textContent = "";
                option.id = item.id;
                option.value = item.hex;
                $(option).css("background-color", item.hex);
                $("#productColors").append(option);
            });
        }
        $("#id").val(product.id);

        document.querySelector("#productColors").addEventListener("change", function(event){
           if(event.target.value != 0) {
               $(event.target).css("background-color", event.target.value);
           } else {
               $(event.target).css("background-color", "#fff");
           }
        });


    }
</script>
