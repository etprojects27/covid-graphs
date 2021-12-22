@extends('layouts.app')


@section('content')
    @if (isset($page))
        @switch ($page)
            @case ('cazuri_noi')
                @include('cazuri_noi')
                @break
            @case ('teste_noi')
                @include('teste_noi')
                @break
            @case ('rata_reproductie')
                @include('rata_reproductie')
                @break
            @case ('total_cazuri')
                @include('total_cazuri')
                @break
            @case ('tabel_judete')
                @include('tabel_judete')
                @break
            @default
                @include('tabel_judete')
        @endswitch
    @endif
@endsection