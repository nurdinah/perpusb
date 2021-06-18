@if ($errors->any())
<div class="alert alert-danger" role="alert">
    @foreach ($errors->all() as $error )
        <ul>
            <li>{{ $errors }}</li>
        </ul>
    @endforeach
</div>
@endif
