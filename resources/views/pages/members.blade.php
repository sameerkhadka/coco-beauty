@extends('layout.app')

@section('css')
    @livewireStyles
@endsection

@section('js')
    @livewireScripts
@endsection

@section('main')
   @livewire('members')
@endsection
