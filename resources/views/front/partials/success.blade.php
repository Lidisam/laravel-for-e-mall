@if (Session::has('success'))
    <script>
        layer.msg("{{ Session::get('success') }}");
    </script>
@endif