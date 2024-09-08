@if ($errors->any())
    <div class="alert alert-danger text-center">
        <strong>Whoops! Something went wrong.</strong>
        <ul class="mt-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
