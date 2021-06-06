@extends('layouts.adminLayout.admin_design')
@section('content')
<?php
use App\Product;
$productsCount = Product::where('status',1)->count(); 
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="/admin/dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a class="current" href="">Products</a>  </div>
    <h1>Products</h1>
    @if(Session::has('flash_message_error'))
            <div class="alert alert-error alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{!! session('flash_message_error') !!}</strong>
            </div>
        @endif   
        @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{!! session('flash_message_success') !!}</strong>
            </div>
        @endif
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Products</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Product ID</th>
                  <th>Category ID</th>
                  <th>Category Name</th>
                  <th>Product Code</th>
                  <th>Product Brand</th>
                  <th style="width:200px;">Product Name</th>
                  <th>Product Color</th>
                  <th>Price</th>
                  <th>On Sale</th>
                  <th>Image</th> 
                  <th>Enable</th>            
                  <th>New Arrival</th>
                  <th>Feature Item</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php $count=1; ?>
                @foreach($products as $product)
                <tr class="gradeX">
                  <td class="center">{{ $product->id }}</td>
                  <td class="center">{{ $product->category_id }}</td>
                  <td class="center">{{ $product->category_name }}</td>
                  <td class="center">{{ $product->product_code }}</td>
                  <td class="center">{{ $product->product_brand }}</td>
                  <td class="center">{{ $product->product_name }}</td>    
                  <td class="center">{{ $product->product_color }}</td>
                  <td class="center">{{ $product->price }}</td>               
                  <td class="center">
                    <div id="checkSale<?php echo $count;?>">
                      <input type="checkbox" id="onSale<?php echo $count;?>"> Yes
                    </div>
                    <div id="amountDiv<?php echo $count;?>">
                    <input type="hidden" id="pro_id<?php echo $count;?>" value="{{ $product->id }}"/>
                        <input type="checkbox" id="noSale<?php echo $count;?>"  />No <br>
                    <input type="text"  id="spl_price<?php echo $count;?>" value="{{$product->sale_price}}" placeholder="Sale price" style="width:95px;"/><br>
                        <button  id="saveAmount<?php echo $count;?>" class="btn btn-success" >Save Amount</button>
                    </div>
                  </td>
                  <td class="center">
                      @if(!empty($product->image))
                      <img src="{{ asset('/images/backend_images/product/small/'.$product->image) }}" style="width:50px;">
                      @endif
                    </td>
                    <td class="center">@if($product->status == 1 ) Yes @else No @endif </td>
                  <td class="center">@if($product->new_arrival == 1 ) Yes @else No @endif </td>
                  <td class="center">@if($product->feature_item == 1 ) Yes @else No @endif </td>
                 
                  <td class="center">
                    <a href="#myModal{{ $product->id }}" data-toggle="modal" title="More information" class="btn btn-success btn-mini">View</a> 
                    <a href="{{ url('/admin/edit-product/'.$product->id) }}" title="Edit product" class="btn btn-primary btn-mini">Edit</a> 
                    <a href="{{ url('/admin/add-attributes/'.$product->id) }}" title="Add attributes" class="btn btn-success btn-mini">Add</a>
                    <a href="{{ url('/admin/add-images/'.$product->id) }}" title="Add images" class="btn btn-info btn-mini">Add</a>
                    <a  rel="{{ $product->id }}" rel1="delete-product" title="Delete product" href="javascript:"  class="btn btn-danger btn-mini deleteRecord">Delete</a>
 
                        <div id="myModal{{ $product->id }}" class="modal hide">
                          <div class="modal-header">
                            <button data-dismiss="modal" class="close" type="button">×</button>
                            <h3>{{ $product->product_name }} Full Details</h3>
                          </div>
                          <div class="modal-body">
                            <table id="table">                    
                            <tr> <td width="40%"> Product ID:</td> <td width="60%">{{ $product->id }}</td></tr>
                            <tr> <td> Category ID: </td> <td> {{ $product->category_id }} </td></tr>
                            <tr> <td> Category Name: </td> <td> {{ $product->category_name }} </td></tr>
                            <tr> <td> Product Code: </td> <td> {{ $product->product_code }} </td></tr>
                            <tr> <td> Product Brand: </td> <td> {{ $product->product_brand }} </td></tr>
                            <tr> <td> Product Name: </td> <td> {{ $product->product_name }} </td></tr>
                            <tr> <td> Product Color: </td> <td> {{ $product->product_color }} </td></tr>
                            <tr> <td> Price: </td> <td> {{ $product->price }}&euro; </td></tr>
                            <tr> <td> Sale Price: </td> <td> {{ $product->sale_price }}&euro; </td></tr>
                            <tr> <td> Enable: </td> <td> @if($product->status == 1 ) True @else False @endif </td></tr>
                            <tr> <td> New Arrival: </td> <td> @if($product->new_arrival == 1 ) True @else False @endif </td></tr>
                            <tr> <td> Feature Item: </td> <td> @if($product->feature_item == 1 ) True @else False @endif </td></tr>
                            <tr> <td> Description: </td> <td> {!! $product->description !!}   </td></tr>
                          </table>             
                          </div>
                        </div>

                  </td>
                </tr>
                <?php $count=$count+1; ?>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    <?php for($i=1;$i<=$productsCount;$i++){ ?>
    $('#amountDiv<?php echo $i;?>').hide();
    $('#checkSale<?php echo $i;?>').show();

    $('#onSale<?php echo $i;?>').click(function(){
     $('#amountDiv<?php echo $i;?>').show();
     $('#checkSale<?php echo $i;?>').hide();
    
        $('#saveAmount<?php echo $i;?>').click(function(){  
          var salePrice<?php echo $i;?> = $('#spl_price<?php echo $i;?>').val();
          var pro_id<?php echo $i;?> = $('#pro_id<?php echo $i;?>').val();
          $.ajax({
          type: 'get',
          dataType: 'html',
          async: false,
          url: '<?php echo url('/admin/addSale'); ?>',
          data: "salePrice=" + salePrice<?php echo $i;?> + "& pro_id=" + pro_id<?php echo $i;?>,
          success: function (response){
          console.log(response);
          alert("You have successfully added sale price.");
          }
          });
        });

    });

    $('#noSale<?php echo $i;?>').click(function(){
     $('#amountDiv<?php echo $i;?>').hide();
     $('#checkSale<?php echo $i;?>').show();
    });
    <?php }?>

  });
</script>
@endsection