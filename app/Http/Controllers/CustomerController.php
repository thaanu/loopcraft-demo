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
     * @param string $query Search
     * 
     * @return object JSON response
     */
    function read( string $query = null ) 
    {

        $result = $query ? Customer::where('name', 'like', "%$query%")->get() : Customer::all();
        return Response()->json($result);
        
    }

    /**
     * This method create new payment
     * 
     * @return object JSON Response
     */
    function create( Request $request )
    {

        // Validation
        validator($request->all(), $this->validationRules)->validate();

        $customer = new Customer;

        // Required Fields
        $customer->name = $request->post('name');
        $customer->email = $request->post('email');
        $customer->gender = $request->post('gender');

        // Optional Fields
        $customer->photo = $request->post('photo');
        $customer->phone = $request->post('phone');
        $customer->birthday = $request->post('birthday');

        $customer->save();
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

        $customer = Customer::find($brandId);

        // Required Fields
        $customer->name = $request->post('name');
        $customer->email = $request->post('email');
        $customer->gender = $request->post('gender');

        // Optional Fields
        $customer->photo = $request->post('photo');
        $customer->phone = $request->post('phone');
        $customer->birthday = $request->post('birthday');

        $customer->update();

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
