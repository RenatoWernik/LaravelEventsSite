@extends('layouts.main')
@section("title",'Product')
@section("content")
@if($id!=null)
<p>Exibindo produto id: {{$id}}</p>
@else
<p>nenhum id selecionado</p>
@endif


@endsection