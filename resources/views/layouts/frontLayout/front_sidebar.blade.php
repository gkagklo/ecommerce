<?php use App\Product;

 ?>   
<form action="{{ url('/products-filter') }}" method="post"> {{ csrf_field() }}
    @if(!empty($url))
    <input name="url" value={{ $url }} type="hidden">	
    @endif
<div class="left-sidebar">

    @if(!empty($url))
    <h2>Brands</h2>
    @if(sizeof($brandArray) > 6) <div class="scrollable"> @endif
    <div class="panel-group">
        @foreach($brandArray as $brand)
            @if(!empty($_GET['brand']))
                <?php $brandArr = explode('-',$_GET['brand']) ?>
                @if(in_array($brand,$brandArr))
                    <?php $brandcheck="checked"; ?>
                @else
                    <?php $brandcheck=""; ?>
                @endif
            @else	
                <?php $brandcheck=""; ?>
            @endif
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">	
                    <input name="brandFilter[]" onchange="javascript:this.form.submit();" id="{{$brand}}" value="{{$brand}}" type="checkbox" {{$brandcheck}}> &nbsp;&nbsp; <span class="products-brands">{{ strtoupper($brand) }}</span>
                </h4>
            </div>
        </div>
        @endforeach	
    </div>
    @if(sizeof($brandArray) > 6) </div> @endif

    <br><br>

    <h2>Colors</h2>
    @if(sizeof($colorArray) > 6) <div class="scrollable"> @endif
    <div class="panel-group">
        @foreach($colorArray as $color)
            @if(!empty($_GET['color']))
                <?php $colorArr = explode('-',$_GET['color']) ?>
                @if(in_array($color,$colorArr))
                    <?php $colorcheck="checked"; ?>
                @else
                    <?php $colorcheck=""; ?>
                @endif
            @else	
                <?php $colorcheck=""; ?>
            @endif
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">	
                    <input name="colorFilter[]" onchange="javascript:this.form.submit();" id="{{$color}}" value="{{$color}}" type="checkbox" {{$colorcheck}}> &nbsp;&nbsp; <span class="products-colors">{{ strtoupper($color) }}</span>
                </h4>
            </div>
        </div>
        @endforeach	
    </div>
    @if(sizeof($colorArray) > 6) </div> @endif

    <br><br>

  <h2>Size</h2> 
  @if(sizeof($sizeArray) > 6) <div class="scrollable"> @endif
    <div class="panel-group">
        @foreach($sizeArray as $size)
            @if(!empty($_GET['size']))
                <?php $sizeArr = explode('-',$_GET['size']) ?>
                @if(in_array($size,$sizeArr))
                    <?php $sizecheck="checked"; ?>
                @else
                    <?php $sizecheck=""; ?>
                @endif
            @else	
                <?php $sizecheck=""; ?>
            @endif
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">	
                    <input name="sizeFilter[]" onchange="javascript:this.form.submit();" id="{{$size}}" value="{{$size}}" type="checkbox" {{$sizecheck}}> &nbsp;&nbsp; <span class="products-sizes">{{ strtoupper($size) }}</span>
                </h4>
            </div>
        </div>
        @endforeach	
    </div>
    @if(sizeof($sizeArray) > 6) </div> @endif
  

<br><br>

<center><img class="img-responsive" src="{{ asset('/images/frontend_images/home/shipping.jpg') }}" alt=""></center>
 
    @endif

</div>
<br><br>
</form>

