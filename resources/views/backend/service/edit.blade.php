@extends('layout.backend')

@section('title', 'Edit Services')
@section('page', 'Services')
@section('sub_page', 'Edit Service')

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('/')}}src/plugins/src/tomSelect/tom-select.default.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('/')}}src/plugins/css/light/tomSelect/custom-tomSelect.css">
<link rel="stylesheet" type="text/css" href="{{asset('/')}}src/plugins/css/dark/tomSelect/custom-tomSelect.css">
@endpush

@section('content')
<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <form action="{{url('/service/'.$service->id)}}" method="post">
            @method('put')
            @csrf
            <div class="widget-content widget-content-area br-8 p-4">
                <div class="col-md-12 mb-4">
                    <label for="vehicle_id" class="form-label">Vehicle Name</label>
                    <select id="select-beast" placeholder="Select a Vehicle..." autocomplete="off" class="form-select"
                        id="vehicle_id" required="" name="vehicle_id">
                        <option selected="" disabled="" value="">Choose...</option>
                        @foreach($vehicle as $row => $data)
                        @if($data->id == $service->vehicle_id)
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

                <div class="col-md-12 mb-4">
                    <label for="name">Service Date</label>
                    <input id="basicFlatpickr" name="date" class="form-control flatpickr flatpickr-input active"
                        type="text" placeholder="Select Date.." required
                        value="{{isset($service->date)?$service->date:''}}">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please fill the name
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
    const url = `{{url('/')}}`;

    new TomSelect("#select-beast",{
    create: true,
    sortField: {
    field: "text",
    direction: "asc"
    }
    });

    var f1 = flatpickr(document.getElementById('basicFlatpickr'), {
    defaultDate: new Date()
    });

    setTimeout(() => {
        $('.navbar-logo').attr('src', url + '/src/assets/img/logo.svg');
    }, 1000);
</script>
@endpush