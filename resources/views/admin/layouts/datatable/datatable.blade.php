@section('css')
    <link rel="stylesheet" href="{{ asset('admin/css/datatables.min.css') }}">
    @if(request()->lang == 'ar')
        <link rel="stylesheet" href="{{ asset('admin/css/datatables.bootstrap-rtl.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('admin/css/datatables.bootstrap.css') }}">
    @endif
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endsection

@push('scripts')
    <script src="https:////cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('admin/js/buttons-server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}
@endpush
