@extends('layouts.master')

@section('title')
Xin chào
@endsection

@section('content')

<div>
    <h1>Xin chào sinh viên {{$maso}}-{{$name}}</h1>
</div>
@if($dadangnhap)
<button>Đăng xuất</button>
@else 
<button>Đăng nhập</button>
@endif

<table>
    <tr>
        <td><b>id</b></td>
        <td><b>first_name</b></td>
        <td><b>last_name</b></td>
        <td><b>email</b></td>
        <td><b>gender</b></td>
        <td><b>ip_address</b></td>
    </tr>
    @foreach($data as $v)
        <tr>
            <td>{{ $v->id }}</td>
            <td>{{ $v->first_name }}</td>
            <td>{{ $v->last_name }}</td>
            <td>{{ $v->email }}</td>
            <td>{{ $v->gender }}</td>
            <td>{{ $v->ip_address }}</td>
        </tr>
    @endforeach
</table>
@endsection