<?php

namespace App\Http\Controllers;

use App\Models\Shop\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductsController extends Controller
{

    use SoftDeletes;

    /**
     * This method lists all the products
     * 
     * @return object JSON response
     */
    function list() 
    {
        return Response()->json(Product::all());
    }

    /**
     * This method returns a list of items according to the search query
     * 
     * @param string $productName
     * 
     * @return object JSON Response
     */
    function search( string $productName ) 
    {
        // $results = Product::where('name', 'like', "%$productName%")->get();
        // return Response()->json($results);
        return $productName;
    }

    /**
     * This product create a new product
     * Todo: Need to work on this method to create all the fields
     * 
     * @return object JSON Response
     */
    function create( Request $request )
    {
        // Rules for the input
        $rules = [
            'name' => ['required'],
            'qty' => ['required', 'min:1'],
            'security_stock' => ['required', 'min:1'],
            'featured' => ['required', 'min:1'],
        ];

        // Validation
        validator($request->all(), $rules)->validate();

        $product = new Product;
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
        $product->save();
        return Response()->json([
            'message' => 'New Product Added'
        ]);
    }
    
    /**
     * This method updates a given product
     * Todo: Need to work on this method to update all the fields
     * 
     * @param int $productId UID of the product
     * 
     * @return object JSON response
     */
    function update( int $productId, Request $request) 
    {
        // Rules for the input
        $rules = [
            'name' => ['required'],
            'qty' => ['required', 'min:1'],
            'security_stock' => ['required', 'min:1'],
            'featured' => ['required', 'min:1'],
        ];

        // Validation
        validator($request->all(), $rules)->validate();

        $product = Product::find($productId);
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
