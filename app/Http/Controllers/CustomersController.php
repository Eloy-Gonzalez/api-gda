<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CustomersController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $customers = \DB::table('customers')
            ->select(['name', 'last_name', 'address', 'regions.description as region_description', 'communes.description as commune.description'])
            ->leftJoin('regions', 'customers.id_reg', '=', 'regions.id_reg')
            ->leftJoin('communes', 'customers.id_com', '=', 'communes.id_com')
            ->Where('customers.status', '!=', 'trash')
            ->Where('customers.status', '!=', 'I')
            ->OrWhere('customers.dni', '=', $request->dni)
            ->OrWhere('customers.email', '=', $request->email)
            ->paginate(20);
        return response()->json($customers);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = \validator($request->all(), [
            'dni'       => 'required|string|unique:customers,dni',
            'id_reg'    => 'required|integer|exists:regions,id_reg',
            'id_com'    => 'required|integer|exists:communes,id_com',
            'email'     => 'required|email|unique:customers,email',
            'name'      => 'required|string',
            'last_name' => 'required|string',
            'address'   => 'string',
        ]);

        if ($validator->fails())
            return response()->json([
                'type' => 'danger',
                'title' => env('APP_NAME'),
                'message' => $validator->errors()
            ]);

        $request['date_reg'] = now();
        $customer = Customers::create($request->all());

        return response()->json([
            'type' => 'success',
            'title' => env('APP_NAME'),
            'message' => 'Customer created Successfully',
            'customer' => $customer
        ]);
    }

    public function update(Request $request): JsonResponse
    {
        $msg = null;
        $type = null;
        $validator = \validator($request->all(), [
            'dni' => 'required|string',
        ]);

        if ($validator->fails())
            return response()->json([
                'type' => 'danger',
                'title' => env('APP_NAME'),
                'message' => $validator->errors()
            ]);

        $customer = Customers::findOrFail($request->dni);
        if ($customer->status == 'trash') {
            $type = 'danger';
            $msg = 'Registro no existe';
        } else {
            $customer->status = 'trash';
            if ($customer->save()) {
                $type = 'success';
                $msg = '¡Customer updated successfully!';
            } else {
                $type = 'danger';
                $msg = '¡Error to update the customer!';
            }
        }

        return response()->json([
            'type' => $type,
            'title' => env('APP_NAME'),
            'message' => $msg
        ]);
    }
}
