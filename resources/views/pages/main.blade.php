@extends( Request::segment(1)=='admin' ? 'layout.admin' : 'layout.app')

@section('css')
    @livewireStyles
@endsection

@section('js')
    @livewireScripts
@endsection

@section('main')
   @livewire($type)
@endsection


