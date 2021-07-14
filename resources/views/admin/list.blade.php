@extends('blank')

@section('content')
    @yield('list-name')

    <div class="row">
        <div class="row mb-0">
            <div class="col-sm-6">
                    <div class="d-print-none">
                            <!-- WHERE BUTTONS GO -->
                    </div>
            </div>
            <div class="col-sm-6">
                <div id="datatable_search_stack" class="mt-sm-0 mt-2 d-print-none"></div>
            </div>
        </div>

        <table id="crudTable" class="bg-white table table-striped table-hover nowrap rounded shadow-xs border-xs mt-2" cellspacing="0">
            <thead>
                <tr>
                    @foreach ($columns as $column)
                        <th data-orderable="{{$column['orderable'], true}}"
                        data-priority="">
                        {!!$column['label']!!}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @yield('table-content')

            </tbody>
            <tfoot>
                <tr>
                    @foreach($columns as $column)
                        <th>{!! $column['label'] !!}</th>
                    @endforeach
                </tr>
            </tfoot>
        </table>
    </div>
@endsection


@section('after_styles')
    <!-- DATA TABLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/crud.css').'?v='.config('backpack.base.cachebusting_string') }}">
    <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/form.css').'?v='.config('backpack.base.cachebusting_string') }}">
    <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/list.css').'?v='.config('backpack.base.cachebusting_string') }}">

    <!-- CRUD LIST CONTENT - crud_list_styles stack -->
    @stack('crud_list_styles')
@endsection


@section('after_scripts')
    <script src="{{asset('packages/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('packages/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('packages/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('packages/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('packages/datatables.net-fixedheader/hs/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('packages/datatables.net-fixedheader-bs4/js/fixedHeader.bootstrap4.min.js')}}"></script>


    <script>

        var crud = {
            exportButtons: JSON.parse('null'),
            functionsToRunOnDataTablesDrawEvent: [],
            addFunctionToDataTablesDrawEventQueue: function (functionName) {
                if (this.functionsToRunOnDataTablesDrawEvent.indexOf(functionName) == -1) {
                    this.functionsToRunOnDataTablesDrawEvent.push(functionName);
                }
            },
            responsiveToggle: function(dt) {
                $(dt.table().header()).find('th').toggleClass('all');
                dt.responsive.rebuild();
                dt.responsive.recalc();
            },
            executeFunctionByName: function(str, args) {
                var arr = str.split('.');
                var fn = window[ arr[0] ];

                for (var i = 1; i < arr.length; i++)
                { fn = fn[ arr[i] ]; }
                fn.apply(window, args);
            },
            updateUrl : function (new_url) {
                url_start = "";
                url_end = new_url.replace(url_start, '');
                url_end = url_end.replace('/search', '');
                new_url = url_start + url_end;

                window.history.pushState({}, '', new_url);
                localStorage.setItem('adminrecipient_list_url', new_url);
            },
            dataTableConfiguration: {

                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal( {
                            header: function ( row ) {
                                // show the content of the first column
                                // as the modal header
                                // var data = row.data();
                                // return data[0];
                                return '';
                            }
                        } ),
                        renderer: function ( api, rowIdx, columns ) {

                            var data = $.map( columns, function ( col, i ) {
                                var columnHeading = crud.table.columns().header()[col.columnIndex];

                                // hide columns that have VisibleInModal false
                                if ($(columnHeading).attr('data-visible-in-modal') == 'false') {
                                    return '';
                                }

                                return '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                    '<td style="vertical-align:top; border:none;"><strong>'+col.title.trim()+':'+'<strong></td> '+
                                    '<td style="padding-left:10px;padding-bottom:10px; border:none;">'+col.data+'</td>'+
                                    '</tr>';
                            } ).join('');

                            return data ?
                                $('<table class="table table-striped mb-0">').append( '<tbody>' + data + '</tbody>' ) :
                                false;
                        },
                    }
                },
                fixedHeader: true,

                stateSave: true,
                /*
                    if developer forced field into table 'visibleInTable => true' we make sure when saving datatables state
                    that it reflects the developer decision.
                */

                stateSaveParams: function(settings, data) {

                    localStorage.setItem('adminrecipient_list_url_time', data.time);

                    data.columns.forEach(function(item, index) {
                        var columnHeading = crud.table.columns().header()[index];
                        if ($(columnHeading).attr('data-visible-in-table') == 'true') {
                            return item.visible = true;
                        }
                    });
                },
                autoWidth: false,
                pageLength: $dtDefaultPageLength,
                lengthMenu: [[10,25,50,100,-1],[10,25,50,100,"All "]],
                /* Disable initial sort */
                aaSorting: [],
                language: {
                    "emptyTable":     "No data available in table",
                    "info":           "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty":      "No entries",
                    "infoFiltered":   "(filtered from _MAX_ total entries)",
                    "infoPostFix":    ".",
                    "thousands":      ",",
                    "lengthMenu":     "_MENU_ entries per page",
                    "loadingRecords": "Loading...",
                    "processing":     "<img src='http://localhost/packages/backpack/crud/img/ajax-loader.gif' alt='Processing...'>",
                    "search": "_INPUT_",
                    "searchPlaceholder": "Search...",
                    "zeroRecords":    "No matching entries found",
                    "paginate": {
                        "first":      "First",
                        "last":       "Last",
                        "next":       ">",
                        "previous":   "<"
                    },
                    "aria": {
                        "sortAscending":  ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    },
                    "buttons": {
                        "copy":   "Copy",
                        "excel":  "Excel",
                        "csv":    "CSV",
                        "pdf":    "PDF",
                        "print":  "Print",
                        "colvis": "Column visibility"
                    },
                },
                processing: true,
                serverSide: true,
                searching: true,
                ajax: {
                    "url": "{{url('/')}}/search",
                    "type": "POST"
                },
                dom:
                    "<'row hidden'<'col-sm-6'i><'col-sm-6 d-print-none'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row mt-2 d-print-none '<'col-sm-12 col-md-4'l><'col-sm-0 col-md-4 text-center'B><'col-sm-12 col-md-4 'p>>",
            }
        }
    </script>
    <script>

        jQuery(document).ready(function($) {

            crud.table = $("#crudTable").DataTable(crud.dataTableConfiguration);

            // move search bar
            $("#crudTable_filter").appendTo($('#datatable_search_stack' ));
            $("#crudTable_filter input").removeClass('form-control-sm');

            // move "showing x out of y" info to header
            $("#datatable_info_stack").html($('#crudTable_info')).css('display','inline-flex').addClass('animated fadeIn');

            // create the reset button
            var crudTableResetButton = '<a href="http://localhost/admin/recipient" class="ml-1" id="crudTable_reset_button">Reset</a>';

            $('#datatable_info_stack').append(crudTableResetButton);

            // when clicking in reset button we clear the localStorage for datatables.
            $('#crudTable_reset_button').on('click', function() {
                /*
                //clear the filters
                if (localStorage.getItem('adminrecipient_list_url')) {
                    localStorage.removeItem('adminrecipient_list_url');
                }
                if (localStorage.getItem('adminrecipient_list_url_time')) {
                    localStorage.removeItem('adminrecipient_list_url_time');
                }

                //clear the table sorting/ordering/visibility
                if(localStorage.getItem('DataTables_crudTable_/admin/recipient')) {
                    localStorage.removeItem('DataTables_crudTable_/admin/recipient');
                }
                 */
            });

            // move the bottom buttons before pagination
            $("#bottom_buttons").insertBefore($('#crudTable_wrapper .row:last-child' ));

            // override ajax error message
            $.fn.dataTable.ext.errMode = 'none';
            $('#crudTable').on('error.dt', function(e, settings, techNote, message) {
                new Noty({
                    type: "error",
                    text: "<strong>Error</strong><br>Error loading page. Please refresh the page."
                }).show();
            });

            // when changing page length in datatables, save it into localStorage
            // so in next requests we know if the length changed by user
            // or by developer in the controller.
            /*
            $('#crudTable').on( 'length.dt', function ( e, settings, len ) {
                localStorage.setItem('DataTables_crudTable_/admin/recipient_pageLength', len);
            });
            */
            // make sure AJAX requests include XSRF token
            $.ajaxPrefilter(function(options, originalOptions, xhr) {
                var token = $('meta[name="csrf_token"]').attr('content');

                if (token) {
                    return xhr.setRequestHeader('X-XSRF-TOKEN', token);
                }
            });

            // on DataTable draw event run all functions in the queue
            // (eg. delete and details_row buttons add functions to this queue)
            $('#crudTable').on( 'draw.dt',   function () {
                crud.functionsToRunOnDataTablesDrawEvent.forEach(function(functionName) {
                    crud.executeFunctionByName(functionName);
                });
            } ).dataTable();

            // when datatables-colvis (column visibility) is toggled
            // rebuild the datatable using the datatable-responsive plugin
            $('#crudTable').on( 'column-visibility.dt',   function (event) {
                crud.table.responsive.rebuild();
            } ).dataTable();

            // when columns are hidden by reponsive plugin,
            // the table should have the has-hidden-columns class
            crud.table.on( 'responsive-resize', function ( e, datatable, columns ) {
                if (crud.table.responsive.hasHidden()) {
                    $("#crudTable").removeClass('has-hidden-columns').addClass('has-hidden-columns');
                } else {
                    $("#crudTable").removeClass('has-hidden-columns');
                }
            } );

        });


    </script>

    <script src="{{ asset('packages/backpack/crud/js/crud.js').'?v='.config('backpack.base.cachebusting_string') }}"></script>
    <script src="{{ asset('packages/backpack/crud/js/form.js').'?v='.config('backpack.base.cachebusting_string') }}"></script>
    <script src="{{ asset('packages/backpack/crud/js/list.js').'?v='.config('backpack.base.cachebusting_string') }}"></script>

    <!-- CRUD LIST CONTENT - crud_list_scripts stack -->
    @stack('crud_list_scripts')
@endsection

