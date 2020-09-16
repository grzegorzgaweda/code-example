@if(count($errors) > 0)
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @foreach($errors->getMessages() as $error)
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach($error as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endif
