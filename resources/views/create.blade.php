@extends('layouts.app')

@section('content')
    <form id="emailForm" action="{{route('email.store')}}" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Имя</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp"
                   placeholder="введите имя">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email </label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp"
                   placeholder="Enter email">
        </div>
        <div class="form-group">
            <textarea id="body" name="text"></textarea>
        </div>
        <input type="checkbox" name="person_data_processing_agree">

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section('scripts')

    <script src="{{ asset('js/form/form.js') }}" type="text/javascript"></script>

@endsection
