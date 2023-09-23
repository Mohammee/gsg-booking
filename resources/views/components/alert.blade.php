@if ($msg)
    <div id="alert" class="toast align-items-center text-white bg-{{ $type }} border-0" role="alert"
        aria-live="assertive" style="opacity: 1;" aria-atomic="true">
        <div class="d-flex justify-content-between">
            <div class="toast-body">
                {{ $msg }}
            </div>
            <button onclick="alertcolsed()" type="button" class="btn btn-{{ $type }}">X</button>
        </div>
    </div>

    @push('scripts')
        <x-alertscript />
    @endpush
@endif
