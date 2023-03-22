@extends('layout.backend')

@section('title', 'Edit Driver')
@section('page', 'Driver')
@section('sub_page', 'Edit Driver')

@section('content')
<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <form action="{{url('/driver/'.$driver->id)}}" method="post">
            @method('put')
            @csrf
            <div class="widget-content widget-content-area br-8 p-4">
                <div class="col-md-12 mb-4">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Driver Name" required
                        value="{{isset($driver->name)?$driver->name:''}}">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please fill the name
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <label for="license">License</label>
                    <input type="text" class="form-control" name="license" required placeholder="License.."
                        style="text-transform: capitalize;" value="{{isset($driver->license)?$driver->license:''}}">
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
                        @if($driver->status == 'Available')
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