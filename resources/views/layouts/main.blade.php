<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SURL</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <script src=" {{ asset('js/app.js') }}"></script> --}}
    
    {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> --}}
    <link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- CSS only -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> --}}
    

    </head>
    <body>
        {{-- <header> --}}
            @include('panels.navbar')
        {{-- </header> --}}
        <!-- Modal -->
        <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Feedback form:</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</i></span>
                        </button>
                    </div>
                    <form id="feedbackForm" method="POST" action="" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Sender:</label>
                        <input type="text" name="sender" class="form-control" placeholder="Anonymous" id="recipient-name">
                        </div>
                        <div class="mb-3">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" name="feedbackMessage" id="message-text"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="feedback_button" class="btn btn-primary">Send feedback</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        
        <main>
            <div class="container mt-4 gy-2">
                @yield('contents')
            </div>
        </main>
        
        <footer class="footer py-3 pt-2 bg-dark fixed-bottom">
            @include('panels.footer')
        </footer>

        <!-- JavaScript Bundle with Popper -->
        <script src=" {{ asset('js/app.js') }}"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script> --}}
        <script src="{{ asset('js/bootstrap-notify.min.js') }}"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
        <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        @stack('custom-js')
        <script>
            $('document').ready(function(){
                $('#feedbackForm').submit(function(e){
                    e.preventDefault();
                    var data = $(this).serializeArray();
                    $.ajax({
                        url: '{{ route('feedback.store') }}',
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
                            $('#feedbackModal').modal('hide');
                        }
                    })
                });
            })

        </script>
    </body>
</html>