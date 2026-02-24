@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <h3>Customers</h3>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="{{ route('customers.index') }}" class="btn btn-dark"
                                style="background-color: #4643d3; color: white;"><i class="fas fa-arrow-left"></i>
                                Back</a>
                        </div>
                        <div class="col-md-8">
                            <form action="{{ route('customers.index') }}" method="GET">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Search anything..."
                                        aria-describedby="button-addon2" name="search" value="{{ request('search') }}">
                                    <button class="btn btn-outline-secondary" type="submit"
                                        id="button-addon2">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2">
                            <form action="{{ route('customers.index') }}" method="GET" class="form-order">
                                <div class="input-group mb-3">
                                    <select class="form-select" name="order" id="order"
                                        onchange="$('.form-order').submit()">
                                        <option @selected(request()->order == 'desc') value="desc">Newest to Old</option>
                                        <option @selected(request()->order == 'asc') value="asc">Old to Newest</option>
                                    </select>
                                </div>
                            </form>

                        </div>
                        {{-- <div class="col-md-2">
                           <a href="{{ route('customers.trash') }}" class="btn btn-dark ms-24"
                                ><i class="fas fa-trash-alt"></i> Trash</a>
                        </div> --}}
                    </div>

                </div>
                <div class="card-body">
                    <table class="table table-bordered" style="border: 1px solid #dddddd">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Date of Birth</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Email</th>
                                <th scope="col">BAN</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $customer->first_name }}</td>
                                    <td>{{ $customer->last_name }}</td>
                                    <td>7-7-2000</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->bank_account_number }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('customers.edit', $customer->id) }}" style="color: #2c2c2c;"
                                                class="ms-1 me-1"><i class="far fa-edit"></i></a>
                                            <a href="{{ route('customers.show', $customer->id) }}" style="color: #2c2c2c;"
                                                class="ms-1 me-1"><i class="far fa-eye"></i></a>

                                            <a href="javascript:;"
                                                onclick="if(confirm('Are you sure you want to delete this item?')){$('.form-{{ $customer->id }}').submit();}else{return false;}"
                                                style="color: #2c2c2c;" class="ms-1 me-1"><i
                                                    class="fas fa-trash-alt"></i></a>
                                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                                                class="form-{{ $customer->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    style="color: #2c2c2c; border: none; background: none;"
                                                    class="ms-1 me-1"></button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
