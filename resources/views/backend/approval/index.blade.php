@extends('layout.backend')

@section('title', 'Bookings')
@section('page', 'Bookings')
@section('sub_page', 'Booking Lists')

@section('content')
<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <div class="widget-content widget-content-area br-8">
            <table id="zero-config" class="table table-striped dt-table-hover" style="width: 100%;">
                <thead style="width: 100%;">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Vehicle</th>
                        <th class="text-center">Driver</th>
                        <th class="text-center">Start</th>
                        <th class="text-center">Finish</th>
                        <th class="text-center">Approval</th>
                        <th class="text-center">Information</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($booking as $row => $data)
                    <tr>
                        <td class="text-center">{{$row + 1}}</td>
                        <td class="text-center">{{$data->vehicle_name}}</td>
                        <td class="text-center">{{$data->driver_name}}</td>
                        <td class="text-center">{{$data->start}}</td>
                        <td class="text-center">{{$data->finish}}</td>
                        <td class="text-center">
                            <button id="{{$data->id}}" type="button" class="approval btn btn-sm btn-light mb-2 me-4 _effect--ripple waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modalApproval">
                                show
                            </button>
                        </td>
                        <td class="text-center">
                            <input type="hidden" id="{{$data->id}}" value="{{$data->information}}">
                            <button id="{{$data->id}}" type="button" class="information btn btn-sm btn-light mb-2 me-4 _effect--ripple waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modalInformation">
                                show
                            </button>
                        </td>
                        <td>
                            <a href="{{url('/approval/'.$data->id.'/1')}}" style="color: lightgreen;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </a>
                            <a href="{{url('/approval/'.$data->id.'/2')}}" style="color:red;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Vehicle</th>
                        <th class="text-center">Driver</th>
                        <th class="text-center">Start Date</th>
                        <th class="text-center">Finish Date</th>
                        <th class="text-center">Status Approval</th>
                        <th class="text-center">Information</th>
                        <th class="text-center">Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>

<div class="modal fade modal-notification" id="modalInformation" tabindex="-1" role="dialog" aria-labelledby="modalInformationLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" id="modalInformationLabel">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="icon-content">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                </div>
                <p class="modal-text" style="text-align: justify; width: 100%; font-size: 16px; overflow-x: hidden;">
                </p>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-notification" id="modalApproval" tabindex="-1" role="dialog" aria-labelledby="modalApprovalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" id="modalApprovalLabel">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="icon-content">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                </div>
                <table class="table bordered-table table-sm">
                    <tr class="approval_name">
                        <th class="text-center">Name</th>
                        <th class="text-center">Position</th>
                        <th class="text-center">Status</th>
                    </tr>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $('#zero-config').DataTable({
        "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
            "<'table-responsive'tr>" +
            "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
        "oLanguage": {
            "oPaginate": {
                "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
            },
            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search...",
            "sLengthMenu": "Results :  _MENU_",
        },
        "stripeClasses": [],
        "lengthMenu": [7, 10, 20, 50],
        "pageLength": 10,
        "drawCallback": function(setting) {
            loading_data();
        }
    });

    function loading_data() {
        $('.information').on('click', function() {
            const id = $(this).attr('id');
            const text = $(`input[id=${id}]`).val();
            $('.modal-text').text(text);
        })

        $('.approval').on('click', function() {
            const id = $(this).attr('id');
            console.log(id)
            $.get("{{url('/approval')}}/" + id, function(m) {
                $('.approval_append').remove();
                $.each(m, function(i, v) {
                    // console.log(v)
                    if (v.status == 0) {
                        v.status = 'Not Yet Approved';
                    } else if (v.status == 1) {
                        v.status = 'Approved';
                    } else {
                        v.status = 'Rejected';
                    }
                    $('.approval_name').after(`<tr class="approval_append"><td>${v.name}</td><td>${v.position}</td><td>${v.status}</td></tr>`);
                });
            })
        })
    }

    loading_data();
</script>
@endpush