@extends('layout.backend')

@section('title', 'Vehicles')
@section('page', 'Vehicles')
@section('sub_page', 'Vehicle Lists')

@section('content')
<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <div class="widget-content widget-content-area br-8">
            <table id="zero-config" class="table table-striped dt-table-hover">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Ownership</th>
                        <th class="text-center">Year</th>
                        <th class="text-center">VIN</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Information</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vehicle as $row => $data)
                    <tr>
                        <td class="text-center">{{$row + 1}}</td>
                        <td class="text-center">{{$data->name}}</td>
                        <td class="text-center">{{$data->ownership}}</td>
                        <td class="text-center">{{$data->year}}</td>
                        <td class="text-center">{{$data->vin}}</td>
                        <td class="text-center">
                            <p style="color:{{$data->status == 'Available'?'green':'red'}}; font-size:10px;">
                                {{$data->status}}</p>
                        </td>
                        <td class="text-center">
                            <input type="hidden" id="{{$data->id}}" value="{{$data->information}}">
                            <button id="{{$data->id}}" type="button"
                                class="information btn btn-sm btn-light mb-2 me-4 _effect--ripple waves-effect waves-light"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                show
                            </button>
                        </td>
                        <td class="text-center">
                            <a href="{{url('/vehicle/'.$data->id.'/edit')}}" class="bs-tooltip" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="" data-original-title="Update"
                                data-bs-original-title="Update" aria-label="Update"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-edit">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg></a>
                            <form action="{{url('vehicle/'.$data->id)}}" method="post" style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <button type="submit" style="border: 0; background: transparent;"
                                    href="javascript:void(0);" class="bs-tooltip" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="" data-original-title="Delete"
                                    data-bs-original-title="Delete" aria-label="Delete"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-x-circle table-cancel">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="15" y1="9" x2="9" y2="15"></line>
                                        <line x1="9" y1="9" x2="15" y2="15"></line>
                                    </svg>
                                </button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Ownership</th>
                        <th class="text-center">Year</th>
                        <th class="text-center">VIN</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Information</th>
                        <th class="text-center">Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>

<div class="modal fade modal-notification" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" id="exampleModalLabel">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="icon-content">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-bell">
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
@endsection

@push('js')
<script>
    $('#zero-config').DataTable({
        "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
    "<'table-responsive'tr>" +
    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
        "oLanguage": {
            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search...",
        "sLengthMenu": "Results :  _MENU_",
        },
        "stripeClasses": [],
        "lengthMenu": [7, 10, 20, 50],
        "pageLength": 10 
    });

    $('.information').on('click', function(){
        const id = $(this).attr('id');
        const text = $(`input[id=${id}]`).val();
        
        $('.modal-text').text(text);
    })

</script>
@endpush