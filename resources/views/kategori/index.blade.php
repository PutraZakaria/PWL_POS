@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Kategori')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Kategori')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card_header"></div>
            <div class="card-body">
                {{-- Praktikum 5-Soal 1 --}}
                <form action="{{ url('kategori/create') }}">
                    <button class="btn btn-primary" style="float: right">Add</button>
                </form>
                {{$dataTable->table()}}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts()}}
@endpush
