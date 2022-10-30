@php
    global $header, $current_user, $list_users;
    $current_user = Auth::user()->role;

    include 'list_user.php';

    $user_authorized = array($list_users["Admin"], $list_users["Presensi"]);
    $admin_privilege = array($list_users["Admin"], $list_users["Presensi"]);
    $user_unauthorized = array($list_users["Inventory"]);

@endphp

@if (!in_array($current_user, $user_authorized) || in_array($current_user, $user_unauthorized))
    @php
        header( "refresh:0;url=/unauthorized" );
    @endphp
@else

<!-- Extend Tamplate Master -->
@extends('layouts.master')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambahkan Data Staff</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

    <!-- cotent disini     -->
    <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Masukkan Data Staff</h6>
            </div>
            <div class="card-body">
                <form action="/storeStaff" method="POST" enctype="multipart/form-data" class="row g-3">
                    @csrf
                    <div class="p-3 col-md-6">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="p-3 col-md-3">
                        <label for="pin" class="form-label">PIN</label>
                        <input type="number" class="form-control" name="pin" id="pin">
                    </div>
                    <div class="p-3 col-md-6">
                        <label for="position" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" name="position" id="position">
                    </div>
                    <div class="p-3 col-md-3">
                    <label for="id_times" class="form-label">Shiff</label>
                    <select class="form-control" name="id_times" id="id_times">
                        <option>Pilih Shiff</option>
                        @foreach ($time as $value)
                            <option value="{{ $value->id }}">
                                {{ $value->commant }}
                            </option>
                        @endforeach
                    </select>
                    </div>
                    <div class="p-3 col-12">
                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection

@endif