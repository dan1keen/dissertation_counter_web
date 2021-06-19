@extends('app')
@section('title', 'Главная')
@section('content')
    <div class="image" style="position: absolute;z-index: -1">
        <img src="/images/bg_main.jpg">
    </div>
    <div class="text-center" style="position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);">
        <h1 style="color: #fff;">Система распознавания и подсчета объектов</h1>
        <div style="background: #f0f8ff59;
    padding: 24px;">
            <div class="row">
                <img src="/images/img.png" class="col-md-6" style="width: 100%; height: 240px; object-fit: cover">
                <img src="/images/img_1.png" class="col-md-6" style="width: 100%; height: 240px; object-fit: cover">
            </div>
            <div class="row mt-4">
                <img src="/images/img_3.png" class="col-md-6" style="width: 100%; height: 240px; object-fit: cover">
                <img src="/images/img_4.png" class="col-md-6" style="width: 100%; height: 240px; object-fit: cover">
            </div>
        </div>

    </div>
@endsection
