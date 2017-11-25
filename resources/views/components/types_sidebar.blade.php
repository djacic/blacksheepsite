<div class='filterBox'>
    @foreach($categories as $category)
        <input type="checkbox" name="typeChbs" onchange="hideByType({{ $category['id'] }})" name="{{strtolower(trim($category['name'],' '))}}" value="{{$category['id']}}">{{$category['name']}}<br>
    @endforeach
</div>
<script>
    function hideByType(brandId)
    {
        //Dohvatanje checkboxova
        var brands = document.getElementsByName('typeChbs');
        var hasChecked = false;
        //Dohvatanje proizvoda
        var products = document.getElementsByClassName("product-item");
        for(let i = 0; i < brands.length; i++) {
            if (brands[i].checked) {
                hasChecked = true;
                for(let j=0; j<products.length; j++) {
                    if($(products[j]).find("#productType").val() == brands[i].value) {
                        $(products[j]).removeClass('hide-type');
                    }
                }
            } else {
                for(let j=0; j<products.length; j++) {
                    if($(products[j]).find("#productType").val() == brands[i].value) {
                        $(products[j]).addClass('hide-type');
                    }
                }
            }
        }
        if(!hasChecked) {
            for(let i = 0; i < products.length; i++) {
                $(products[i]).removeClass('hide-type');
            }
        }

    }
</script>