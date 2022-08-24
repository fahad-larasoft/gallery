@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="/store-images" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Upload Image</label>
                                <input type="file" class="form-control" name="images[]" multiple>
                            </div>

                            <button class="btn btn-primary pull-right">Submit</button>
                        </form>
                        <br>
                        @foreach($images->chunk(3) as $chunkedImages)
                            <div class="row">
                                @foreach($chunkedImages as $image)
                                    <div class="col-md-4">
                                        <img src="/cache-image/{!! $image->name !!}" alt="" style="max-width: 100%">
                                    </div>
                                @endforeach
                            </div>
                                <br>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
