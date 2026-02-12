<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $customers = Customer::all();
        return view('customers.index', compact('customers'));
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
        Log::info('Starting customer creation');

        try {
            $validatedData = $request->validated();
            Log::info('Validation passed', $validatedData);

            if ($request->hasFile('image')) {

                $uploadsPath = public_path('uploads');

                if (!File::exists($uploadsPath)) {
                    File::makeDirectory($uploadsPath, 0777, true);
                }

                $image = $request->file('image');
                $filename = Carbon::now()->format('Y-m-d_His') . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                $image->move($uploadsPath, $filename);
                Log::info('Image uploaded: ' . $filename);

                $validatedData['image'] = $filename;
            }

            $customer = Customer::create($validatedData);
            Log::info('Customer created', ['id' => $customer->id]);

            return redirect()->route('customers.index')
                ->with('success', 'Customer created successfully!');
        } catch (\Exception $e) {
            Log::error('Customer creation failed', [
                'message' => $e->getMessage(),
                // 'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'Failed to create customer'])
                ->withInput($request->except('image'));
        }
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
    public function edit(Customer $customer)
    {
        ///retreive the customer details

        // dd($customer);
        return view('customers.edit',compact(
            'customer'
        ));
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
