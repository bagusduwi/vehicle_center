@extends('layout.backend')

@section('title', 'Add New Vehicles')
@section('page', 'Vehicles')
@section('sub_page', 'Add New Vehicles')

@section('content')
<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <form action="{{url('/vehicle')}}" method="post">
            @csrf
            <div class="widget-content widget-content-area br-8 p-4">
                <div class="col-md-12 mb-4">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Vehicle Name" required>
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
                        <option>Company Vehicle</option>
                        <option>Rental Vehicle</option>
                    </select>
                    <div class="invalid-feedback">
                        Please select a valid ownership.
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <label for="year">Year</label>
                    <input id="year" class="form-control" type="number" placeholder="Year.." name="year">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please fill the name
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <label for="vin">VIN (Vehicle Information Number)</label>
                    <input type="number" class="form-control" name="vin" required>
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
                        <option>Available</option>
                        <option>Unavailable</option>
                    </select>
                    <div class="invalid-feedback">
                        Please select a valid status.
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <label for="information" class="form-label">Information</label>
                    <textarea name="information" id="information" class="form-control" cols="30" rows="10"
                        name="information"></textarea>
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