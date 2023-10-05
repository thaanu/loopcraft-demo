<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop\Category;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryController extends Controller
{

    use SoftDeletes;

    protected $validationRules = [
        'name' => ['required'],
        'slug' => ['required'],
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

        $result = $query ? Category::where('name', 'like', "%$query%")->get() : Category::all();
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

        $category = new Category;

        // Required Fields
        $category->name = $request->post('name');
        $category->slug = $request->post('slug');
        $category->position = $request->post('position');
        $category->is_visible = $request->post('is_visible'); // True / False

        // Optional Fields
        $category->description = $request->post('description');
        $category->seo_title = $request->post('seo_title');
        $category->seo_description = $request->post('seo_description');
        $category->parent_id = $request->post('parent_id');

        $category->save();
        return Response()->json([
            'message' => 'New category added'
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

        $category = Category::find($brandId);

        // Required Fields
        $category->name = $request->post('name');
        $category->slug = $request->post('slug');
        $category->position = $request->post('position');
        $category->is_visible = $request->post('is_visible'); // True / False

        // Optional Fields
        $category->description = $request->post('description');
        $category->seo_title = $request->post('seo_title');
        $category->seo_description = $request->post('seo_description');
        $category->parent_id = $request->post('parent_id');


        $category->update();

        return Response()->json([
            'message' => 'Category updated'
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
        $category = Category::find($id);
        $category->delete();
        return Response()->json([
            'message' => 'Category removed'
        ]);
    }
}
