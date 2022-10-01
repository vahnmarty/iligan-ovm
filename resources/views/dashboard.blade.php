@extends('layouts.admin') 
@section('content')
    @role('admin')
    @livewire('dashboard.admin-dashboard')
    @endrole

    @role('cashier')
    @livewire('dashboard.cashier-dashboard')
    @endrole
@endsection
