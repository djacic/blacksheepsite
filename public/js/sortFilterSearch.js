/*
  Sortiranje proizvoda po odredjenom kriterijumu
*/

const page = {
  productsClass : "col-md-3",
  productsDiv : $("#products"),
  categoriesDiv : $("#sidebar_categories"),
  brandsDiv : $("#brands"),
  typesDiv : $("#types"),
  searchSortDiv : $("#position"),
  paginationDiv : $("#pagination"),
  productPagesNumber : 0,
  currentPage : 1
};
var obj = {
    page : 1,
    type : "all",
    keyword : "",
    order : "date_desc"
};

var data = {

};


function byCategory(categoryId) {
    obj.page = 1;
    obj.type = "category";
    obj.categoryId = categoryId;
    obj.keyword = "";
    callAjax(obj,data);
}

function byBrand() {
    let checkedBrands = $('.brandChb:checkbox:checked');
    if (checkedBrands.length > 0) {
        obj.page = 1;
        obj.type = "brand";
        obj.brandIds = [];
        obj.keyword = "";
        for  (let i =0; i < checkedBrands.length; i++) {
            obj.brandIds.push(checkedBrands[i].value);
        }
    } else {
        obj.type = "all";
        page.typesDiv.parent().addClass('hidden');
    }
    callAjax(obj, data);
}

function byType() {
    let checkedTypes = $('.typesChb:checkbox:checked');
    if (checkedTypes.length > 0) {
        obj.page = 1;
        obj.type = "type";
        obj.keyword = "";
        obj.typeIds = [];
        for  (let i =0; i < checkedTypes.length; i++) {
            obj.typeIds.push(checkedTypes[i].value);
        }
    } else {
        obj.type = "brand";
    }
    callAjax(obj, data);
}

function paginate(pages) {
    page.productPagesNumber = pages;
    $(".paginationItem").parent().remove();
    for (let i=pages; i > 0; i--) {
        $(".paginationStart").after("<li class='hidden'><a href='#position' id='pgItem-"+ i +"' onclick='changePage("+ parseInt(i) +");' class='paginationItem'>" + parseInt(i) + "</a></li>");
    }
    $("#pgLast").click(function() {
        changePage(page.productPagesNumber);
    });
    handlePaginationDisplay(page.currentPage);
}

function handlePaginationDisplay(currentPage) {
    $("#pgItem-" + currentPage).css("background-color", "#868c93");
    $("#pgItem-" + currentPage).css("color", "#fff");
    console.log(currentPage);
    let shown = 0;
    let iterator = currentPage-2 < 0 ? 1 : currentPage - 2;
    while(shown < 5) {
        if(iterator > page.productPagesNumber)break;
        let pgItem = $("#pgItem-" + iterator++);
        if(pgItem.length > 0) {
            pgItem.parent().removeClass('hidden');
            shown++;
        }
    }
}

function changePage(pageNum) {
    obj.page = pageNum;
    page.currentPage = pageNum;
    callAjax(obj, data);
}

$(document).ready(function(){
    callAjax(obj, data);
});

function generateBrands(brands) {
    if(brands.length > 0) {
        brands.sort();
        page.brandsDiv.empty();
        page.brandsDiv.parent().removeClass('hidden');
        for( let i =0; i < brands.length; i++) {
            page.brandsDiv.append('<input type="checkbox" value="'+ brands[i].id +'" class="brandChb" onchange="byBrand()">'+ brands[i].name +'<br>');
        }
    } else {
        page.brandsDiv.parent().addClass('hidden');
    }
}

function generateTypes(types) {
    page.typesDiv.empty();
    if(types.length > 0) {
        page.typesDiv.parent().removeClass('hidden');
        for( let i =0; i < types.length; i++) {
            page.typesDiv.append('<input type="checkbox" value="'+ types[i].id +'" class="typesChb" onchange="byType()">'+ types[i].name +'<br>');
        }
    }
}

function generateCategories(categories) {
    page.categoriesDiv.empty();
    if(categories.length > 0) {
      page.categoriesDiv.append('<li class="list-group-item clearfix dropdown purple"><a href="custom-case" class="bela" ><i class="fa fa-angle-right"></i>Custom Case</a></li>');
        for (let i = 0; i < categories.length; i++) {
            page.categoriesDiv.append('<li class="list-group-item clearfix dropdown customFont"><a href="#" onclick="byCategory('+ parseInt(categories[i].id) +')"><i class="fa fa-angle-right"></i>' + categories[i].name +'</a></li>');
        }
    }
}


$("#sort").change(function(event) {
    obj.order = event.target.value;
    callAjax(obj, data);
});

/*
   Pretraga proizvoda u javascriptu
*/
$("#searchProducts").click(function(event) {
   obj.keyword = $("#searchField").val();
   obj.page = 1;
   page.currentPage = 1;
   $("#searchField").val("");
   callAjax(obj,data);

});

function callAjax(obj, dataObj) {
    $.ajax({
        url : "http://www.blacksheepmobstore.com/final/public/index.php/get-products",
        data : obj,
        beforeSend : function() {
          // page.productsDiv.html("<br><br><p class='lead text-center'><i class='fa fa-spin fa-circle-o-notch fa-5x'></i></p><br><br>");
          page.productsDiv.html("<br><br><img src='../assets/pages/img/loading.gif' width='800'/></br></br>")
        },
        success : function(data) {
            dataObj = data;
            makeChange(dataObj);
        },
        error : function(xhr, status, err) {
            console.log(err);
        }
    })
}

function makeChange(dataObj) {
    if(dataObj.categories) {
        generateCategories(dataObj.categories);
        generateProducts(dataObj);
        paginate(dataObj.pages);
    } else {
        if(dataObj.brands) {
            generateProducts(dataObj);
            generateBrands(dataObj.brands);
            paginate(dataObj.pages);
        } else {
            if(dataObj.types) {
                generateProducts((dataObj));
                paginate(dataObj.pages);
                generateTypes(dataObj.types);
            } else {
                generateProducts(dataObj);
                paginate(dataObj.pages);
            }
        }

    }

}

function generateProducts(data) {
    page.productsDiv.empty();
    if(data.products.length > 0) {
        page.paginationDiv.removeClass('hidden');
        for (let i = 0; i < data.products.length; i++) {
            createProduct(data.products[i]);
        }
    } else {
        page.productsDiv.html('<div class="text-center"><div class="alert alert-info"><p class="lead">Za odabrani kriterijum trenutno nema proizvoda.</p></div></div>');
        page.paginationDiv.addClass('hidden');
    }
}



function createProduct(product) {
   let saleSticker = null;
   let newSticker = null;
   if(product.is_offer == 1)saleSticker = "sticker-sale";
   let productDiv = '<div class="product-item ' + page.productsClass + '">\n' +
       '                    <div class="pi-img-wrapper">\n' +
       '                        <img src="http://www.blacksheepmobstore.com/final/public/assets/pages/img/products/' + product.picture.file + '" class="img-responsive" alt="">\n' +
       '                        <div>\n' +
       '                            <a href="http://www.blacksheepmobstore.com/final/public/assets/pages/img/products/' + product.picture.file + '" class="btn btn-default fancybox-button">Uvećaj</a>\n' +
       '                            <a href="#product-pop-up" onclick="getProductDetails('+ product.id +')" class="btn btn-default fancybox-fast-view">Pogledaj</a>\n' +
       '                        </div>\n' +
       '                    </div>\n' +
       '                    <h3><a href="#" id="productName">'+ product.name +'</a></h3>\n' +
       '                    <div class="pi-price"><span id="price">'+ product.price + '</span> RSD</div>\n' +
       '                    <form action="http://www.blacksheepmobstore.com/final/public/index.php/order/place" method="post">\n' +
       '                        <input type="hidden" id="productId" name="id" value="'+ product.id +'">\n' +
       '                        <input type="submit" name="order" class="btn btn-default add2cart" value="Dodaj u korpu">\n' +
       '                    </form>\n' +
       '                        <div class="sticker '+ saleSticker +'"></div>\n' +
       // '                        <div class="sticker sticker-new"></div>\n' +
       '\n' +
       '                </div>';
       product.is_active == 1 ? page.productsDiv.append(productDiv) : false


}
