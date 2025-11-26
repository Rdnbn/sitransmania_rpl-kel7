@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Periksa input Anda:</strong>
        <ul class="mt-2 mb-0">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif
