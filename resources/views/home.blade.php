@extends('layouts.app')

@section('title', 'Home')

@section('content')

    {{-- About Section --}}
    @include('components.about')

    {{-- Service Section --}}
    @include('components.services')

    {{-- Destination Section --}}
    @include('components.destination', ['destinations' => $destinations])

    {{-- Packages Section --}}
    @if (isset($packages))
        @include('components.packages', ['packages' => $packages])
    @endif
    {{-- Booking Section --}}
    @include('components.booking')

    {{-- Process Section --}}
    @include('components.process')

    {{-- Team Section --}}
    @include('components.team')

    {{-- Testimonial Section --}}
    @include('components.testimonial', ['testimonials' => $testimonials])


@endsection
