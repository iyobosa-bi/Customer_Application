<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('customers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        $validatedData =  $request->validated();

        // dd($validatedData);

        //handle uploaded images
        if($request->hasFile('image')){
             

        //    if (!File::exists(public_path('uploads'))) {
        //     File::makeDirectory(public_path('uploads'), 0755, true);
        //      }
            $image= $request->file('image');
            $filename  = Carbon::now()->format('Y-m-d_H-i-s') . '_' . uniqid() . '.' .$image->getClientOriginalExtension();
            $filePath = 'uploads/'.$filename; 
            $image->move(public_path('uploads'),$filename);
        }

        Customer::create(array_merge($validatedData,["image"=> $filename]));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
