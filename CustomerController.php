<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\models\Customers\CustomerModel;
use Illuminate\Http\JsonResponse;
use Response;
class CustomerController extends Controller
{
    public function customerSignupPage(){
       return view('customerLayout.customerSignup');

    }
    public function customerRegister(Request $request){
      
        $request->validate([
            
            'FirstName' =>'required|min:3',
            'LastName' =>'required|min:3',
            'DisplayName' =>'required|min:3',
            'Role' =>'required',
            'Email'=>'required|Email|unique:customers', 
           
            'PhoneNo' =>'required|min:10|max:10',
            'ReferalCode'=>'min:6|max:6'
        ]);
        if(isset($request["Email"]) && $request["Email"] != "")
        {
            $customers  = CustomerModel::getCustomerDetailsByEmail($request["Email"]);
            $customersCount  = CustomerModel::getCustomersCount();
         
        }
        
        if(empty($customers)){
          
            $customers_table = new CustomerModel;
            $customers_table->FirstName      = $request["FirstName"];
            $customers_table->LastName      = $request["LastName"];
            $customers_table->DisplayName      = $request["DisplayName"];
            $customers_table->IsGuest      = $request["Role"];
            $customers_table->Email      = $request["Email"];
            $customers_table->PhoneNo      = $request["PhoneNo"];
            $customers_table->Status      = "1";
            $customers_table->RegisteredDate      = date("Y-m-d");
            $customers_table->IsSubscriptionActive      = "0";
            $customers_table->TotalCredit      = 0;
            $customers_table->ReferalCode      = $request["ReferalCode"];
            //membership no creation begin
            $storeNo = "2821";
            $year = date('Y');
            $trimYear = substr( $year, -2);
          
            if($customersCount==null){
                $seqValue = "001";
            }else{
                $newcount = $customersCount+1;
                $seqValue= str_pad($newcount,3,"0",STR_PAD_LEFT);
                
            }
            $customers_table->MembershipNo  = $trimYear.$storeNo.$seqValue;
           //membership no creation end
            $customers_table->save();
            $insertedId = $customers_table->id;
            $customerDetails = CustomerModel::latest('CustomerID')->first();
            if($customerDetails){
                $JsonResponse = Response::json(array('status' => 200, 'message' => "succesfully Inserted", 'data' => array("customers" => $customerDetails)));
                return view('customerLayout.customerSignup', compact('JsonResponse'))->withErrors(['success' => 'Customer Successfully Registered'])->render();

            }else{
                $JsonResponse = Response::json(array('status' => 200, 'message' => "succesfully Inserted", 'data' => array("customers" => $customerDetails)));
                return view('customerLayout.customerSignup', compact('JsonResponse'))->withErrors(['faile' => 'Something went wrong'])->render();
            }
        }
    }
    public function listCustomers(){
        $customers = CustomerModel::paginate(20);

        return view('customerLayout.customerList', compact('customers'));
    }

    public function customerUpdatePage($id=0){
       
        $customers = CustomerModel::where("CustomerID","=",$id)->first();

        return view('customerLayout.customerSignup', compact('customers'));
       
    }

    public function CustomerUpdate(Request $request, $id)
    {
       $request->validate([
            
            'FirstName' =>'required|min:3',
            'LastName' =>'required|min:3',
            'DisplayName' =>'required|min:3',
            'Email'=>'required|Email|unique:customers', 
           
            'PhoneNo' =>'required|min:10|max:10',
            'ReferalCode'=>'min:6|max:6'
        ]);

        $customers_table = CustomerModel::find($id);
        $customers_table->FirstName     = $request["FirstName"];
        $customers_table->LastName     = $request["LastName"];
        $customers_table->DisplayName     = $request["DisplayName"];

        $customers_table->Email     = $request["Email"];
        $customers_table->PhoneNo     = $request["PhoneNo"];
        $customers_table->ReferalCode      = $request["ReferalCode"];
        $customers_table->update();
       
    }

}

