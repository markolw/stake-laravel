@extends('layouts.app')
@push('page_css')
    <link rel="stylesheet" href="{{ asset('/css/datatables/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/datatables/responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/datatables/buttons.bootstrap4.min.css') }}" />
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Messages</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="Messages" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Username</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page_scripts')
    <script src="{{ asset('/js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/js/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/js/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/js/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            let dataSet = JSON.parse(@json($messages));
            $('#Messages thead tr')
                .clone(true)
                .addClass('filters')
                .insertBefore('#Messages thead tr');
            $("#Messages").DataTable({
                "data": dataSet,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                columns: [{
                        data: 'stake_date'
                    },
                    {
                        data: 'client.name'
                    },
                    {
                        data: 'message'
                    },
                ],
                columnDefs: [{
                    targets: 0,
                    render: function(data) {
                        return moment(data).format('MM/DD/YYYY (hh:mm:ss)');
                    }
                }],
                initComplete: function() {
                    var api = this.api();

                    // For each column
                    api
                        .columns()
                        .eq(0)
                        .each(function(colIdx) {
                            // Set the header cell to contain the input element
                            var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            var title = $(cell).text();
                            if (colIdx > 0) {
                                $(cell).html(
                                    '<input type="text" class="form-control" placeholder="' +
                                    title + '" />');
                            } else {
                                $(cell).html('');
                            }

                            // On every keypress in this input
                            $(
                                    'input',
                                    $('.filters th').eq($(api.column(colIdx).header()).index())
                                )
                                .off('keyup change')
                                .on('change', function(e) {
                                    // Get the search value
                                    $(this).attr('title', $(this).val());
                                    var regexr =
                                        '({search})'; //$(this).parents('th').find('select').val();

                                    var cursorPosition = this.selectionStart;
                                    // Search the column for that value
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != '' ?
                                            regexr.replace('{search}', '(((' + this.value +
                                                ')))') :
                                            '',
                                            this.value != '',
                                            this.value == ''
                                        )
                                        .draw();
                                })
                                .on('keyup', function(e) {
                                    e.stopPropagation();

                                    $(this).trigger('change');
                                    $(this)
                                        .focus()[0]
                                        .setSelectionRange(cursorPosition, cursorPosition);
                                });
                        });
                },
            });
        });
    </script>
@endpush
