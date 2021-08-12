@extends('blank')

@section('content')
    @yield('list-name')

    <div class="row">
       <table class="reportTable bg-white table table-striped table-hover nowrap rounded shadow-xs border-xs mt-2" cellspacing="0">
            <thead>
                <tr>
                    @if (isset($columns))
                        @foreach ($columns as $column)
                            <th data-orderable="{{$column['orderable'], true}}"
                            data-priority="">
                            {!!$column['label']!!}
                            </th>
                        @endforeach
                    @endif
                </tr>
            </thead>
            <tbody>
                @yield('table-content')

            </tbody>
            <tfoot>
                <tr>
                    @if (isset($columns))
                        @foreach($columns as $column)
                            <th>{!! $column['label'] !!}</th>
                        @endforeach
                    @endif
                </tr>
            </tfoot>
        </table>
    </div>
@endsection

@section('after_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">

@endsection

@yield('jsTableConfig')

@section('after_scripts')
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

    <script>
        jQuery(document).ready(function($) {
            if (typeof tableConfigs !== 'undefined') {
                if (tableConfigs.length > 1) {
                    //TODO:: Iterate over collection of configs and assign to appropriate IDs.
                } else {
                    $('.reportTable').DataTable(tableConfigs[0]);
                }
            } else {
                let defaultTableConfig = {
                    dom: 'liftBp',
                    buttons: [],
                    fixedHeader: true,
                    autoWidth: false,
                    pageLength: 50,
                    lengthMenu: [[25,50,75,100,-1],[25,50,75,100,'All ']],
                    aaSorting: [],
                }
                $('.reportTable').DataTable(defaultTableConfig);
            }
        });
    </script>
@endsection

