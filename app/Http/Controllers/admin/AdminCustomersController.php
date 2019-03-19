<?php

namespace App\Http\Controllers\admin;

use App\Customer;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class AdminCustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $customers=Customer::paginate(5);
        return view('customers.index',compact('customers'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCustomer(Request $request){
//        $this->validate($request,[
//            'firstname'=>'required',
//            'lastname'=>'required',
//            'email'=>'required|unique',
//            'address'=>'required',
//            'password'=>'required'
//        ],[],[
//            'firstname'=>'First name',
//            'lastname'=>'Last name',
//            'email'=>'Email',
//            'address'=>'Address',
//            'password'=>'Password'
//        ]);
        $firstname=$request['firstname'];
        $lastname=$request['lastname'];
        $email=$request['email'];
        $gender=$request['gender'];
        $address=$request['address'];
        $password=$request['password'];

        $customer=new Customer();
        $customer->firstname=$firstname;
        $customer->lastname=$lastname;
        $customer->email=$email;
        $customer->gender=$gender;
        $customer->address=$address;
        $customer->password=$password;
        $customer->save();
        return response()->json($customer);
    }

    public function showCustomer(Request $request){
        $customer=Customer::find($request['id']);
        return response()->json($customer);
    }

    public function editCustomer(Request $request){

        $customer=Customer::find($request['id']);
        $customer->firstname=$request['firstname'];
        $customer->lastname=$request['lastname'];
        $customer->email=$request['email'];
        $customer->gender=$request['gender'];
        $customer->address=$request['address'];
        $customer->password=$request['password'];
        $customer->save();
        return response()->json($customer);
    }

    public function deleteCustomer(Request $request){
        $customer=Customer::find($request['id']);
        $customer->delete();
        return response()->json($customer);
    }
}
