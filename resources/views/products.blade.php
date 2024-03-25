@extends('layouts.main')
@section("title",'Renato Wernik')
@section("content")



<h1>Tela produtos</h1>
<a href="/">Voltar para Home</a>
<a href="/contacts">Contacts</a>
@if($busca!=null)
<p>o produto pesquisado foi: {{$busca}}</p>
@else
<p>Nenhum produto foi pesquisado</p>
@endif
@endsection