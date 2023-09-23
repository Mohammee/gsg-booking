@extends('errors.error')
@section('title', '403 | Error')
@section('errorNumber', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
