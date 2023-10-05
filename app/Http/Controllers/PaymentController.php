<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop\Payment;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentController extends Controller
{
    use SoftDeletes;

    protected $validationRules = [
        'order_id' => ['required'],
        'reference' => ['required', 'email'],
        'provider' => ['required'],
        'method' => ['required', 'min:1'],
        'amount' => ['required', 'min:1'],
        'currency' => ['required', 'min:1']
    ];

    /**
     * This method shows all records and also filters records on giving a search query
     * 
     * @param string $query
     * 
     * @return object JSON response
     */
    function read( string $query = null ) 
    {

        $result = $query ? Payment::where('name', 'like', "%$query%")->get() : Payment::all();
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

        $payment = new Payment;

        // Required Fields
        $payment->order_id = $request->post('order_id');
        $payment->reference = $request->post('reference');
        $payment->provider = $request->post('provider');
        $payment->method = $request->post('method');
        $payment->amount = $request->post('amount');
        $payment->currency = $request->post('currency');

        $payment->save();
        return Response()->json([
            'message' => 'New payment processed'
        ]);
    }
    
    /**
     * This method update the record given
     * 
     * @param int $id
     * 
     * @return object JSON response
     */
    function update( int $id, Request $request) 
    {

        // Validation
        validator($request->all(), $this->validationRules)->validate();

        $payment = Payment::find($id);

        // Required Fields
        $payment->order_id = $request->post('order_id');
        $payment->reference = $request->post('reference');
        $payment->provider = $request->post('provider');
        $payment->method = $request->post('method');
        $payment->amount = $request->post('amount');
        $payment->currency = $request->post('currency');

        $payment->save();
        return Response()->json([
            'message' => 'New payment processed'
        ]);

        $payment->update();

        return Response()->json([
            'message' => 'Payment updated'
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
        $category = Payment::find($id);
        $category->delete();
        return Response()->json([
            'message' => 'Payment removed'
        ]);
    }
}


