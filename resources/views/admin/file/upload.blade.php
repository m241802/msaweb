@extends('app2')

@section('content')
    <h1>Upload file(s)</h1>
    <form action="/admin/files/upload"  method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
    <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
    <input type="file" name="images[]"multiple>
    <br>
    <button type="submit">Submit</button>
    </form>
@endsection