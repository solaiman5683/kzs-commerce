@extends('layouts.vertical', ['page_title' => 'Widgets', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid py-3">
        <div class="text-center">
            <h2>
                Hello Bangladesh
            </h2>
        </div>
    </div> <!-- container -->
@endsection

@section('script')
    @vite(['resources/js/pages/demo.widgets.js', 'resources/js/pages/component.chat.js'])
@endsection
