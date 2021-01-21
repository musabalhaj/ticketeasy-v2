@extends('errors::minimal')
    <style>
        * {
            font-family: 'Nunito', sans-serif;
            background-color: #1f2937 !important;
            background: url('images/404.png') no-repeat center fixed;
            background-size: 50% !important;
            color: red !important;
        }
    </style>
@section('title', __('Not Found'))
@section('code','404')
@section('message', __('Not Found'))
