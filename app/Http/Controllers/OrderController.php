<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop\Order;
use App\Models\Shop\OrderAddress;
use App\Models\Shop\OrderItem;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderController extends Controller
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

        $result = $query ? Order::where('name', 'like', "%$query%")->get() : Order::all();
        return Response()->json($result);
        
    }

    /**
     * This method create new order
     * 
     * @return object JSON Response
     */
    function create( Request $request )
    {

        // Validation
        validator($request->all(), $this->validationRules)->validate();

        $category = new Order;

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
            'message' => 'New order added'
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

        $category = Order::find($brandId);

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
            'message' => 'Order updated'
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
        $category = Order::find($id);
        $category->delete();
        return Response()->json([
            'message' => 'Order removed'
        ]);
    }
}
