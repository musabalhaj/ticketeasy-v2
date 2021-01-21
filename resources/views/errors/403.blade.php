@extends('errors::minimal')
    <style>
        * {
            font-family: 'Nunito', sans-serif;
            background-color: #1f2937 !important;
            background: url('images/403.png') no-repeat center fixed;
            background-size: 50% !important;
            color: red !important;
        }
    </style>
@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
