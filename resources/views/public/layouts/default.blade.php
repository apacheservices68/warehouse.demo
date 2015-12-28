@extends('public.layouts.master')
{{-- section('title',$title) --}}
@section('content')
	<!-- Main component for a primary marketing message or call to action -->
	@include('public.home.nav')
	@include($body)
@stop
