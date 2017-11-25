<div class="item active">
    <img src="assets/pages/img/index-sliders/slide1.jpg" class="img-responsive" alt="PROIZVOD">
</div>
@foreach($anotherSlider as $slider)
<div class="item">
    <img src="{{$slider['sliderImgPath']}}" class="img-responsive" alt="{{$slider['sliderImgAlt']}}">
</div>
    @endforeach