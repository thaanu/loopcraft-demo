<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop\Customer;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerController extends Controller
{
    use SoftDeletes;

    protected $validationRules = [
        'name' => ['required'],
        'email' => ['required', 'email'],
        'gender' => ['required'],
        'birthday' => ['date']
    ];

    /**
     * This method shows all records and also filters records on giving a search query
     * 
     * @param string $query Search by product name
     * 
     * @return object JSON response
     */
    function read( string $query = null ) 
    {

        $result = $query ? Customer::where('name', 'like', "%$query%")->get() : Customer::all();
        return Response()->json($result);
        
    }

    /**
     * This method create new customer
     * 
     * @return object JSON Response
     */
    function create( Request $request )
    {

        // Validation
        validator($request->all(), $this->validationRules)->validate();

        $category = new Customer;

        // Required Fields
        $category->name = $request->post('name');
        $category->email = $request->post('email');
        $category->gender = $request->post('gender');

        // Optional Fields
        $category->photo = $request->post('photo');
        $category->phone = $request->post('phone');
        $category->birthday = $request->post('birthday');

        $category->save();
        return Response()->json([
            'message' => 'New customer added'
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

        $category = Customer::find($brandId);

        // Required Fields
        $category->name = $request->post('name');
        $category->email = $request->post('email');
        $category->gender = $request->post('gender');

        // Optional Fields
        $category->photo = $request->post('photo');
        $category->phone = $request->post('phone');
        $category->birthday = $request->post('birthday');

        $category->update();

        return Response()->json([
            'message' => 'Customer updated'
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
        $category = Customer::find($id);
        $category->delete();
        return Response()->json([
            'message' => 'Customer removed'
        ]);
    }
}
