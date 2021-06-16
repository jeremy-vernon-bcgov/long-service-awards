@if ($crud->hasAccess('ceremonyInvite') && $crud->get('list.bulkActions'))
    <a href="javascript:void(0)" onclick="ceremonyInvite(this)" class="btn btn-sm btn-secondary bulk-button" ><i class="fa fa-envelope"></i> Email</a>
@endif

@push('after_scripts')
    <script>
        if (typeof ceremonyInvite != 'function') {
            function ceremonyInvite(button) {

                if (typeof crud.checkedItems === 'undefined' || crud.checkedItems.length == 0) {
                    new Noty({
                        text: "<strong>{{ trans('backpack::crud.bulk_no_entries_selected_title') }}</strong><br>{{ trans('backpack::crud.bulk_no_entries_selected_message') }}",
                        type: "notice"
                    }).show();

                    return;
                }

                var message = "Are you sure you want to send these emails? :number total email recipients selected.";
                message = message.replace(":number", crud.checkedItems.length);
                const div = document.createElement("div");
                // Show confirm message
                swal({
                    title: "{{ trans('backpack::base.notice') }}",
                    text: message,
                    icon: "info",
                    content: {
                        element: "input",
                        attributes: {
                            placeholder: "Custom subject line",
                            type: "text",
                            id: "111", // We can only pass one value through swal, so we need to pull this data from the id.
                        }
                    },
                    buttons: {
                        cancel: {
                            text: "{{ trans('backpack::crud.cancel') }}",
                            value: null,
                            visible: true,
                            className: "bg-secondary",
                            closeModal: true,
                        },
                        email: {
                            text: "Email",
                            value: 'email',
                            visible: true,
                            className: "bg-danger",
                        },
                        test: {
                            text: "Test",
                            value: 'test',
                            visible:true,
                            className: "bg-primary",
                        },
                    },

                }).then((value) => {
                    if (value) {
                        var ajax_calls = [];
                        var invites = crud.checkedItems.length;
                        var ceremonyinvite_route = "{{ url($crud->route) }}/ceremonyinvite";
                        // Put our text for subject here:
                        if($('#111').val() != '') {
                            crud.checkedItems.push($('#111').val());
                        } else {
                            crud.checkedItems.push(null);
                        }

                        if(value == 'test') {
                            crud.checkedItems.push(true);
                        } else {
                            crud.checkedItems.push(false);
                        }
                        // submit an AJAX delete call
                        $.ajax({
                            url: ceremonyinvite_route,
                            type: 'POST',
                            data: {entries: crud.checkedItems},
                            success: function (result) {
                                // Show an alert with the result
                                new Noty({
                                    type: "success",
                                    text: "<strong>Note</strong><br>" + invites + " new emails added to the queue."
                                }).show();

                                crud.checkedItems = [];
                                crud.table.ajax.reload();
                            },
                            error: function (result) {
                                // Show an alert with the result
                                new Noty({
                                    type: "danger",
                                    text: "<strong>Email failed</strong><br>One or more emails could not be created. Please try again."
                                }).show();
                            }
                        });
                    }
                });
            }
        }
    </script>
@endpush
