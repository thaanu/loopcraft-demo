<?php

namespace App\Http\Controllers;

use App\Models\Shop\Brand;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrandController extends Controller
{

    use SoftDeletes;

    protected $validationRules = [
        'name' => ['required'],
        'slug' => ['required', 'min:1'],
        'position' => ['required', 'min:0'],
        'is_visible' => ['required', 'boolean']
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

        $result = $query ? Brand::where('name', 'like', "%$query%")->get() : Brand::all();
        return Response()->json($result);
        
    }

    /**
     * This product create a new product
     * 
     * @return object JSON Response
     */
    function create( Request $request )
    {

        // Validation
        validator($request->all(), $this->validationRules)->validate();

        $brand = new Brand;

        // Required Fields
        $brand->name = $request->post('name');
        $brand->slug = $request->post('slug');
        $brand->position = $request->post('position');
        $brand->is_visible = $request->post('is_visible'); // True / False

        // Optional Fields
        $brand->website = $request->post('website');
        $brand->description = $request->post('description');
        $brand->seo_title = $request->post('seo_title');
        $brand->seo_description = $request->post('seo_description');
        $brand->sort = $request->post('sort');

        $brand->save();
        return Response()->json([
            'message' => 'New brand added'
        ]);
    }
    
    /**
     * This method updates a given brand
     * 
     * @param int $brandId UID of the brand
     * 
     * @return object JSON response
     */
    function update( int $brandId, Request $request) 
    {

        // Validation
        validator($request->all(), $this->validationRules)->validate();

        $brand = Brand::find($brandId);

        // Required Fields
        $brand->name = $request->post('name');
        $brand->slug = $request->post('slug');
        $brand->position = $request->post('position');
        $brand->is_visible = $request->post('is_visible'); // True / False

        // Optional Fields
        $brand->website = $request->post('website');
        $brand->description = $request->post('description');
        $brand->seo_title = $request->post('seo_title');
        $brand->seo_description = $request->post('seo_description');
        $brand->sort = $request->post('sort');


        $brand->update();

        return Response()->json([
            'message' => 'Brand updated'
        ]);
    }

    /**
     * This method soft deletes a given record
     * 
     * @param int $id UID of the record
     * 
     * @return object JSON response
     */
    function delete( int $id ) 
    {
        $brand = Brand::find($id);
        $brand->delete();
        return Response()->json([
            'message' => 'Brand removed'
        ]);
    }
}
