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
    public function index(Request $request)
    {

        $searchInput =  $request->input('search');
        // $customers = Customer::all();
        $customers =  Customer::when($searchInput, function ($query) use ($request) {
            $query->where('first_name', 'LIKE', "%$request->search%")->orWhere('last_name', 'LIKE', "%$request->search%");
        })->orderBy('id', $request->has('order') && $request->order == "asc"?"ASC":"DESC")->get();

        // ds($customers);
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
        // ds($request);
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

            // ds($validatedData);

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
    public function show(Customer $customer)
    {
        ds($customer);
        return  view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        ///retreive the customer details

        // dd($customer);
        return view('customers.edit', compact(
            'customer'
        ));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, string $id)
    {
        $validatedRequest =  $request->validated();

        //get the instance of the passed customer

        $customer =  Customer::findOrFail($id);

        // dd($filePath);
        if ($request->hasFile('image')) {

            if ($customer->image) {

                $filePath = public_path('uploads/' . $customer->image);
                ds($filePath);
                $filePath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $filePath);

                if (File::exists($filePath)) {

                    File::delete(public_path($filePath));
                }
            }
            //handles new image
            $newImage =  $request->file('image');
            $fileName =  Carbon::now()->format('Y-m-d_His') . '_' . uniqid() . '.' . $newImage->getClientOriginalExtension();
            //move file name to
            $newImage->move(public_path('uploads'), $fileName);

            $validatedRequest['image'] =  $fileName;
        } else {
            unset($validatedRequest['image']);
        }

        //update the customer
        $customer->update($validatedRequest);

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {

        //handle the deletion of the image if it exists
        if ($customer->image) {
            // dd(public_path('uploads/'.$customer->image));
            $fullFilePath =  str_replace(['/', '\\'], DIRECTORY_SEPARATOR, public_path('uploads/' . $customer->image));
            // dd($fullFilePath);
            if (File::exists($fullFilePath)) {
                File::delete($fullFilePath);
            }

            $storedDeleteInfo =  $customer->delete();

            if (!$storedDeleteInfo) {
                return redirect()->route('customers.index')->with('error', 'Failed to delete customer');
            }

            return redirect()->route('customers.index')->with('success', 'Customer deleted successfully');
        }
    }
}
