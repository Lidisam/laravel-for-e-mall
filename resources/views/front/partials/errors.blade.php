@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <script>
            layer.msg("{{ $error }}");
        </script>
        @break(1)
    @endforeach
@endif
