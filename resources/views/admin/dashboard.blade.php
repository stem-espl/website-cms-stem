@extends('admin.layout')
@section('content')
@php
$admin = Auth::guard('admin')->user();
if (!empty($admin->role)) {
    $permissions = $admin->role->permissions;
    $permissions = json_decode($permissions, true);
}
@endphp
<div class="mt-2 mb-4">
    <h1 class="text-dark pb-2">Dashboard </h1>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="row row-card-no-pd">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-head-row">
                            <h3 class="card-title">Welcome Back, {{Auth::guard('admin')->user()->first_name}} {{Auth::guard('admin')->user()->last_name}}!</h3>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
