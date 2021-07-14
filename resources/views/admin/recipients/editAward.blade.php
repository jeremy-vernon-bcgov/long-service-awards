@extends('blank')

@section('content')

    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <form method="post" action="">
        @csrf
        @method('PUT')


        <div class="row">

        </div>


    </form>


@endsection
