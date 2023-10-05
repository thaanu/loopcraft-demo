<?php

namespace App\Http\Controllers;

use App\Models\Shop\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductsController extends Controller
{

    use SoftDeletes;

    protected $validationRules = [
        'name' => ['required'],
        'qty' => ['required', 'min:1'],
        'security_stock' => ['required', 'min:1'],
        'featured' => ['required', 'min:1'],
        'is_visible' => ['required', 'boolean'],
        'backorder' => ['required', 'boolean'],
        'requires_shipping' => ['required', 'boolean'],
        'weight_unit' => ['required'],
        'height_unit' => ['required'],
        'width_unit' => ['required'],
        'depth_unit' => ['required'],
        'volume_unit' => ['required']
    ];

    /**
     * This method shows all the products and also filters product on giving a search query
     * 
     * @param string $query Search by product name
     * 
     * @return object JSON response
     */
    function read( string $query = null ) 
    {
        $result = $query ? Product::where('name', 'like', "%$query%")->get() : Product::all();
        return Response()->json($result);
    }

    /**
     * This product create a new product
     * 
     * @return object JSON Response
     */
    function create( Request $request )
    {


        // todo: need to implement variation part

        // Validation
        validator($request->all(), $this->validationRules)->validate();

        $product = new Product;

        // Required Fields
        $product->name = $request->post('name');
        $product->qty = $request->post('qty');
        $product->security_stock = $request->post('security_stock');
        $product->featured = $request->post('featured'); // True / False
        $product->is_visible = $request->post('is_visible'); // True / False
        $product->backorder = $request->post('backorder'); // True / False
        $product->requires_shipping = $request->post('requires_shipping'); // True / False
        $product->weight_unit = $request->post('weight_unit'); // String
        $product->height_unit = $request->post('height_unit'); // String
        $product->width_unit = $request->post('width_unit'); // String
        $product->depth_unit = $request->post('depth_unit'); // String
        $product->depth_unit = $request->post('depth_unit'); // Number
        $product->volume_unit = $request->post('volume_unit'); // String


        // Optional fields
        $product->shop_brand_id = $request->post('shop_brand_id');
        $product->slug = $request->post('slug');
        $product->sku = $request->post('sku');
        $product->barcode = $request->post('barcode');
        $product->description = $request->post('description');
        $product->old_price = $request->post('old_price');
        $product->price = $request->post('price');
        $product->cost = $request->post('cost');
        $product->type = $request->post('type');
        $product->published_at = $request->post('published_at');
        $product->seo_title = $request->post('seo_title');
        $product->seo_description = $request->post('seo_description');
        $product->weight_value = $request->post('weight_value');
        $product->height_value = $request->post('height_value');
        $product->width_value = $request->post('width_value');
        $product->depth_value = $request->post('depth_value');
        $product->volume_value = $request->post('volume_value');


        $product->save();
        return Response()->json([
            'message' => 'New Product Added'
        ]);
    }
    
    /**
     * This method updates a given product
     * 
     * @param int $productId UID of the product
     * 
     * @return object JSON response
     */
    function update( int $productId, Request $request) 
    {
        
        // todo: need to implement variation part


        // Validation
        validator($request->all(), $this->validationRules)->validate();


        $product = Product::find($productId);

        // Required fields
        $product->name = $request->post('name');
        $product->qty = $request->post('qty');
        $product->security_stock = $request->post('security_stock');
        $product->featured = $request->post('featured'); // True / False
        $product->is_visible = $request->post('is_visible'); // True / False
        $product->backorder = $request->post('backorder'); // True / False
        $product->requires_shipping = $request->post('requires_shipping'); // True / False
        $product->weight_unit = $request->post('weight_unit'); // String
        $product->height_unit = $request->post('height_unit'); // String
        $product->width_unit = $request->post('width_unit'); // String
        $product->depth_unit = $request->post('depth_unit'); // String
        $product->volume_unit = $request->post('volume_unit'); // String

        // Optional fields
        $product->shop_brand_id = $request->post('shop_brand_id');
        $product->slug = $request->post('slug');
        $product->sku = $request->post('sku');
        $product->barcode = $request->post('barcode');
        $product->description = $request->post('description');
        $product->old_price = $request->post('old_price');
        $product->price = $request->post('price');
        $product->cost = $request->post('cost');
        $product->type = $request->post('type');
        $product->published_at = $request->post('published_at');
        $product->seo_title = $request->post('seo_title');
        $product->seo_description = $request->post('seo_description');
        $product->weight_value = $request->post('weight_value');
        $product->height_value = $request->post('height_value');
        $product->width_value = $request->post('width_value');
        $product->depth_value = $request->post('depth_value');
        $product->volume_value = $request->post('volume_value');


        $product->update();
        return Response()->json([
            'message' => 'Product updated'
        ]);
    }

    /**
     * This method soft deletes a given record
     * 
     * @return object JSON response
     */
    function delete( int $productId ) 
    {
        $product = Product::find($productId);
        $product->delete();
        return Response()->json([
            'message' => 'Product removed'
        ]);
    }
    
}
