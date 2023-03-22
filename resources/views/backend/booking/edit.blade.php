@extends('layout.backend')

@section('title', 'Edit Booking')
@section('page', 'Booking')
@section('sub_page', 'Edit Booking')

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('/')}}src/plugins/src/tomSelect/tom-select.default.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('/')}}src/plugins/css/light/tomSelect/custom-tomSelect.css">
<link rel="stylesheet" type="text/css" href="{{asset('/')}}src/plugins/css/dark/tomSelect/custom-tomSelect.css">
@endpush

@section('content')
<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <form action="{{url('/booking/'.$booking->id)}}" method="post">
            @method('put')
            @csrf
            <div class="widget-content widget-content-area br-8 p-4">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="vehicle_id" class="form-label">Vehicle Name</label>
                        <select placeholder="Select a Vehicle..." autocomplete="off" class="form-select" id="vehicle_id"
                            required="" name="vehicle_id">
                            <option selected="" disabled="" value="">Choose...</option>
                            @foreach($vehicle as $row => $data)
                            @if($data->id == $booking->vehicle_id)
                            <option selected value="{{$data->id}}">{{$data->name}} -- {{$data->vin}}</option>
                            @else
                            <option value="{{$data->id}}">{{$data->name}} -- {{$data->vin}}</option>
                            @endif
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid status.
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <label for="driver_id" class="form-label">Driver Name</label>
                        <select placeholder="Select a Driver..." autocomplete="off" class="form-select" id="driver_id"
                            required="" name="driver_id">
                            <option selected="" disabled="" value="">Choose...</option>
                            @foreach($driver as $row => $data)
                            @if($data->id == $booking->driver_id)
                            <option selected value="{{$data->id}}">{{$data->name}} - {{$data->license}}</option>
                            @else
                            <option value="{{$data->id}}">{{$data->name}} - {{$data->license}}</option>
                            @endif
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid status.
                        </div>

                    </div>
                    <hr class="mb-6 mt-3">
                    <div class="col-sm-6">
                        <div class="col-md-12 mb-4">
                            <label for="name">Range Date</label>
                            <code>select the vehicle usage date range.</code>
                            <input id="rangeCalendarFlatpickr" class="form-control flatpickr flatpickr-input active"
                                type="text" name="date" placeholder="Select Date.." required
                                value="{{$booking->start}} to {{$booking->finish}}">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please fill the name
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="col-sm-12">
                            <label for="user_id" class="form-label">Approval</label>
                            <code>select the person who will approve.</code>
                            <select placeholder="Select a Person..." autocomplete="off" class="select_user" id="user_id"
                                required="" name="user_id[]">
                                @foreach($user as $row => $data)
                                <option value="{{$data->id}}">{{$data->name}} - {{$data->position}}</option>
                                @endforeach

                            </select>
                            <div class="invalid-feedback">
                                Please select a valid status.
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <div class="col-md-12 mb-4">
                            <label for="information">Information</label>
                            <textarea name="information" id="information" cols="20" rows="10"
                                class="form-control">{{isset($booking->information)?$booking->information:''}}</textarea>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please fill the name
                            </div>
                        </div>
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
<script src="{{asset('/')}}src/plugins/src/tomSelect/tom-select.base.js"></script>
<script>
    $('.form-select').each(function(i, v){
        new TomSelect(v,{
            create: true,
            sortField: {
            field: "text",
            direction: "asc"
            }
        });
    })

    const approval = @json($approval);
    console.log(approval);
    new TomSelect(".select_user",{
        maxItems: 5,
        items: approval.map(String)
    });
 
    
    
    var f3 = flatpickr(document.getElementById('rangeCalendarFlatpickr'), {
    mode: "range",
    });

    const url = `{{url('/')}}`;

    setTimeout(() => {
    $('.navbar-logo').attr('src', url + '/src/assets/img/logo.svg');
    }, 1000);
</script>
@endpush