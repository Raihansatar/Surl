@extends('layouts.main')

@section('contents')
    @include('panels.flash-message')
    @auth
        <div class="card">
            <div class="card-header">
                Welcome <strong>{{ $name }}</strong>, paste the URL to be shortened
            </div>

            <div class="card-body">
                <form action="{{ route('url.store') }}" method="POST" id="submitUrlForm" enctype="multipart/form-data">
                    @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Link</label>
                            <input class="form-control" type="text" name="link" id="link" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Length <small style="color: red"> (4 - 6 length)</small> </label>
                            <input class="form-control" type="number" max="6" min="4" name="length" id="length" required>
                        </div>
                    <input type="submit" class="btn btn-sm btn-success" name="submit" id="submit">
                </form>
            </div>
        </div>

        @if(!empty($data))
            <div class="pt-4">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="surl-datatable">
                            <thead>
                                <th>ID</th>
                                <th>URL</th>
                                <th>ShortUrl</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </thead>
                                
                        </table>
                    </div>

                </div>

            </div>
        @endif

        @push('custom-js')
            <script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
            

            <script>
                $('document').ready(function(){

                    $('#submitUrlForm').submit(function(e){
                        e.preventDefault();
                        var data = $(this).serializeArray();
                        $.ajax({
                            url: '{{ route('url.store') }}',
                            type: 'POST',
                            data: data,
                            dataType: 'JSON',
                            success: function(data){
                                console.log(data)
                                $.notify({
                                    message: data.message
                                },{
                                    placement: {
                                    from: "top",
                                    align: "center"
                                },
                                    type: data.type
                                });
                                urlTable.draw();
                            }
                        })
                    });

                    var urlTable = $('#surl-datatable').DataTable({
                        "responsive": true,
                        "order": [[ 3, "asc" ]],
                        "serverSide": true,
                        "processing": true,
                        "ajax": {
                            url: "{{ route('url.datatable') }}",
                            complete: function(){
                                $('.delete_url').click(function(){
                                    var id = $(this).data('id');
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                                    $.ajax({
                                        url: '{{ route('url.deleteUrl') }}',
                                        type: 'POST',
                                        data: {
                                            "id" : id
                                        },
                                        dataType: 'JSON',
                                        success: function(data){
                                            console.log(data)
                                            $.notify({
                                                message: data.message
                                            },{
                                                placement: {
                                                from: "top",
                                                align: "center"
                                            },
                                                type: data.type
                                            });
                                            urlTable.draw();
                                        }
                                    })
                                })
                            }
                        },
                        "columnDefs": [
                            {
                                "render": function ( data, type, row ) {
                                    return moment(data).calendar();
                                },
                                "targets": 3
                            }
                        ],
                        "columns": [
                            {data: 'id', name: 'id'},
                            {data: 'Url', name: 'Url'},
                            {data: 'ShortUrl', name: 'ShortUrl'},
                            {data: 'DateCreated', name: 'DateCreated'},
                            {data: 'action', name: 'action'},
                        ],
                    });
                })
            </script>
        @endpush
    
    @endauth

    @guest
        <section>
            <div>
                
                <h2>
                    Welcome to SURL.

                </h2>
                A simple URL shortener web app.

                
            </div>

        </section>
    @endguest
@endsection

