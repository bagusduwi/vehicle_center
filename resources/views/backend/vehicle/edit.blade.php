@extends('layout.backend')

@section('title', 'Edit Vehicles')
@section('page', 'Vehicles')
@section('sub_page', 'Edit Vehicles')

@push('css')
<!--  BEGIN CUSTOM STYLE FILE  -->
<link href="{{asset('/')}}src/assets/css/light/scrollspyNav.css" rel="stylesheet" type="text/css" />
<link href="{{asset('/')}}src/plugins/css/light/flatpickr/custom-flatpickr.css" rel="stylesheet" type="text/css">

<link href="{{asset('/')}}src/assets/css/dark/scrollspyNav.css" rel="stylesheet" type="text/css" />
<link href="{{asset('/')}}src/plugins/css/dark/flatpickr/custom-flatpickr.css" rel="stylesheet" type="text/css">
<!--  END CUSTOM STYLE FILE  -->
@endpush

@section('content')
<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <form action="{{url('/vehicle/'.$vehicle->id)}}" method="post">
            @csrf
            @method('put')
            <div class="widget-content widget-content-area br-8 p-4">
                <div class="col-md-12 mb-4">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Vehicle Name" required
                        value="{{isset($vehicle->name)?$vehicle->name:''}}">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please fill the name
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <label for="ownership" class="form-label">Ownership</label>
                    <select class="form-select" id="ownership" required="" name="ownership">
                        <option selected="" disabled="" value="">Choose...</option>
                        @if($vehicle->ownership == 'Company Vehicle')
                        <option selected>Company Vehicle</option>
                        <option>Rental Vehicle</option>
                        @else
                        <option>Company Vehicle</option>
                        <option selected>Rental Vehicle</option>
                        @endif
                    </select>
                    <div class="invalid-feedback">
                        Please select a valid ownership.
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <label for="year">Year</label>
                    <input id="year" class="form-control" type="number" placeholder="Year.." name="year" required
                        value="{{isset($vehicle->year)?$vehicle->year:''}}">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please fill the name
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <label for="vin">VIN (Vehicle Information Number)</label>
                    <input type="number" class="form-control" name="vin" required
                        value="{{isset($vehicle->vin)?$vehicle->vin:''}}">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please fill the name
                    </div>
                </div>

                <div class="col-md-12 mb-4">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" required="" name="status">
                        <option selected="" disabled="" value="">Choose...</option>
                        @if($vehicle->status == 'Available')
                        <option selected>Available</option>
                        <option>Unavailable</option>
                        @else
                        <option>Available</option>
                        <option selected>Unavailable</option>
                        @endif
                    </select>
                    <div class="invalid-feedback">
                        Please select a valid status.
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <label for="information" class="form-label">Information</label>
                    <textarea name="information" id="information" class="form-control" cols="30" rows="10"
                        name="information">{{isset($vehicle->information)?$vehicle->information:''}}</textarea>
                    {{-- <input type="text" class="form-control" id="information" name="information"> --}}
                </div>
                <div class="col-sm-12">
                    <div class="offset-sm-10 col-sm-2">
                        <button type="submit" style="width: 100%"
                            class="btn btn-primary _effect--ripple waves-effect waves-light">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

</div>

@endsection

@push('js')
@endpush