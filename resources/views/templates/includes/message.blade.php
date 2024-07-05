@push('scripts')
    <script>
        @if (session('success'))
            M.toast({
                html: "{!! session('success') !!}",classes: 'rounded teal darken-4 close'
            })
        @endif
        @if (session('warning'))
            M.toast({
                html: "{{!! session('warning') !!}}",classes: 'black-text rounded orange darken-4 close'
            })
        @endif

        @if (session('error'))
            M.toast({
                html: "{{!! session('error') !!}}",classes: 'rounded red darken-4 close'
            })
        @endif
    </script>
@endpush
