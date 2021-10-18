@extends('admin/layout')
@section('title','Product create')
@section('product_select','active')
    


@section('container')

@if(session()->has('sku_error'))
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
    {{ session('sku_error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif
<h1 class="mb10">Create Product</h1>
<a href="{{ route('product.index') }}">
    <button type="button" class="btn btn-success">All Product</button>
</a>

<script src="{{asset('asset/ckeditor.js')}}"></script>
<div class="row m-t-30">
    <div class="col-md-12">
      <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
        @csrf  
        <div class="row">
            <div class="col-lg-12">
               
                <div class="card">
                 
                    <div class="card-body">

                            <div class="form-group">
                                <label for="name" class="control-label mb-1">Product Name</label>
                                <input id="name" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                @error('name')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="slug" class="control-label mb-1">Product Slug</label>
                                <input id="slug" name="slug" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                @error('slug')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image" class="control-label mb-1">Product Image</label>
                                <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" required>
                                @error('image')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="category_id" class="control-label mb-1">Product Category</label>
                                        <select id="category_id" name="category_id" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                            <option value="">Select any Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                        
                                        @error('category_id')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="is_featured" class="control-label mb-1">Is Featured</label>
                                        <select id="is_featured" name="is_featured" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                            <option value="">Select for Featured</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        @error('is_featured')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror    
                                    </div>
                                    <div class="col-md-4">
                                        <label for="is_discount" class="control-label mb-1">Is Discount</label>
                                        <select id="is_discount" name="is_discount" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                            <option value="">Select for discount</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        @error('is_discount')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror    
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="short_desc" class="control-label mb-1">Product Short Description</label>
                                <textarea id="short_desc" name="short_desc" type="text" class="form-control" aria-required="true" aria-invalid="false" required></textarea>
                                @error('short_desc')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description" class="control-label mb-1">Product Description</label>
                                <textarea id="description" name="description" type="text" class="form-control" aria-required="true" aria-invalid="false" required></textarea>
                                @error('description')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="quantity" class="control-label mb-1">Product quantity</label>
                                        <input id="quantity" name="quantity" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        @error('quantity')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="sku" class="control-label mb-1">Product SKU</label>
                                        <input id="sku" name="sku" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        @error('sku')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <h2 class="mb10 ml15">Product Images</h2>
            <div class="col-lg-12"> 
                <input id="piid" type="hidden" name="piid[]" value="">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row"  id="Product_images_box">
                                <div class="col-md-4 product_attr_1">
                                    <label for="images" class="control-label mb-1">Product Images</label>
                                    <input id="images" name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false" required>
                                     @error('images')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                     @enderror
                                </div>
                                <div class="col-md-2">
                                    <label for="images" class="control-label mb-1">
                                        &nbsp;</label><br>
                                    <button type="button" class="btn btn-success btn-lg" onclick="add_image_more()">
                                        <i class="fas fa-plus"></i> &nbsp;ADD
                                    </button>

                                </div>
                            </div>
                        </div>    
                    </div>
                </div>    
            </div>
            <h2 class="mb10 ml15">Product Attributes</h2>
            <div class="col-lg-12" id="Product_attr_box"> 
                
                <div class="card" id="product_attr_1">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                {{-- <div class="col-md-4">
                                    <label for="sku" class="control-label mb-1">Product SKU</label>
                                    <input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                     @error('sku')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                     @enderror
                                </div> --}}
                                <div class="col-md-4">
                                    <label for="orginal_price" class="control-label mb-1">Orginal Price</label>
                                    <input id="orginal_price" name="orginal_price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                     @error('orginal_price')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                     @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="offer_price" class="control-label mb-1">Offer Price</label>
                                    <input id="offer_price" name="offer_price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                     @error('offer_price')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                     @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="weight_id" class="control-label mb-1">Product Weight</label>
                                    <select id="weight_id" name="weight_id[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        <option value="">Select any Weight</option>
                                        @foreach ($weights as $weight)
                                            <option value="{{ $weight->id }}">{{ $weight->weight }}</option>
                                        @endforeach
                                    </select>
                                     @error('weight_id')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                     @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="unit_id" class="control-label mb-1">Product Unit</label>
                                    <select id="unit_id" name="unit_id[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        <option value="">Select any Weight</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->unit }}</option>
                                        @endforeach
                                    </select>
                                     @error('unit_id')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                     @enderror
                                </div>
                                {{-- <div class="col-md-4">
                                    <label for="quantity" class="control-label mb-1">Product Quantity</label>
                                    <input id="quantity" name="quantity[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                     @error('quantity')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                     @enderror
                                </div> --}}
                                <div class="col-md-4">
                                    <label for="discount" class="control-label mb-1">
                                        &nbsp;</label><br>
                                    <button type="button" class="btn btn-success btn-lg" onclick="add_more()">
                                        <i class="fas fa-plus"></i> &nbsp;ADD
                                    </button>

                                </div>
                            </div>
                        </div>    
                    </div>
                </div>    
            </div>    
        </div>
        <div>
            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block form-control">
               Submit
            </button>
        </div>
      </form>
    </div>
</div>


<script>
    var loop_count =1;
    function add_more(){
        loop_count++;
       var html ='<div class="card" id="product_attr_'+loop_count+'"><div class="card-body"><div class="form-group"><div class="row">';

        //    html+='<div class="col-md-4"><label for="sku" class="control-label mb-1">Product SKU</label><input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required>@error("sku")<div class="alert alert-danger">{{ $message }}</div> @enderror</div>';

           html+='<div class="col-md-4"><label for="orginal_price" class="control-label mb-1">Orginal Price</label><input id="orginal_price" name="orginal_price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required>@error("orginal_price")<div class="alert alert-danger">{{ $message }}</div>@enderror</div>';

           html+='<div class="col-md-4"><label for="offer_price" class="control-label mb-1">Offer Price</label><input id="offer_price" name="offer_price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" >@error("offer_price")<div class="alert alert-danger">{{ $message }}</div>@enderror</div>';


            var weight_html =jQuery('#weight_id').html();
            html+='<div class="col-md-4"><label for="weight_id" class="control-label mb-1">Product Weight</label><select id="weight_id" name="weight_id[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required>'+weight_html+'</select>@error("weight_id")<div class="alert alert-danger">{{ $message }}</div>@enderror</div>';            

            var unit_html =jQuery('#unit_id').html();
            html+='<div class="col-md-4"><label for="unit_id" class="control-label mb-1">Product Unit</label><select id="unit_id" name="unit_id[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required>'+unit_html+'</select>@error('unit_id')<div class="alert alert-danger">{{ $message }}</div>@enderror</div>'

            // html+='<div class="col-md-4"><label for="quantity" class="control-label mb-1">Product Quantity</label><input id="quantity" name="quantity[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required>@error("quantity")<div class="alert alert-danger">{{ $message }}</div>@enderror</div>';


            html+='<div class="col-md-4"><label for="discount" class="control-label mb-1">&nbsp;</label><br><button type="button" class="btn btn-danger btn-lg" onclick=remove_more("'+loop_count+'")><i class="fas fa-minus"></i> &nbsp;Remove</button></div>';

       html+='</div></div></div></div>'
       jQuery('#Product_attr_box').append(html);
    }

    function remove_more(loop_count){
        jQuery('#product_attr_'+loop_count).remove();
    }

    var loop_image_count =1;
    function add_image_more(){
        loop_image_count++;
        
        var html ='<input id="piid" type="hidden" name="piid[]" value=""><div class="col-md-4 product_images_'+loop_image_count+'"><label for="images" class="control-label mb-1">Product Image</label><input id="images" name="images[]"  type="file" class="form-control" aria-required="true" aria-invalid="false" > @error('images')<div class="alert alert-danger">{{ $message }}</div>@enderror</div>';

        html+='<div class="col-md-2 product_images_'+loop_image_count+'"><label for="discount" class="control-label mb-1">&nbsp;</label><br><button type="button" class="btn btn-danger btn-lg" onclick=remove_images_more("'+loop_image_count+'")><i class="fas fa-minus"></i> &nbsp;Remove</button></div>';

        jQuery('#Product_images_box').append(html);
    }
    function remove_images_more(loop_image_count){
        jQuery('.product_images_'+loop_image_count).remove();
    }
    CKEDITOR.replace('short_desc');
    CKEDITOR.replace('description');
    
</script>
@endsection

