@extends('layouts.master')

    @section('content')
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <!--begin::Toolbar container-->
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Users Edit</h1>
                        <!--end::Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('users') }}" class="text-muted text-hover-primary">Home</a>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">User Management</li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">Users Edit</li>
                            <!--end::Item-->
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>

                    <a href="{{ route('users') }}">
                        <button class="btn btn-primary"><< Back</button>
                    </a>
                    <!--end::Page title-->
                    
                </div>
                <!--end::Toolbar container-->
            </div>
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div  class="app-container container-xxl">
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <!--begin::Card-->
                    <div class="card bg-secondary">
                        <!--begin::Card body-->
                        <div class="card-body py-4">

                            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="fv-row mb-7">                                    
                                    <label class="required fw-semibold fs-6 mb-2">Full Name</label>                                                                       
                                    <input type="text" name="full_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Full name"
                                     value="{{ old('full_name', $user->name) }}" />    
                                    @error('full_name')
                                        <div class="text-danger my-2">{{ $message }}</div>
                                    @enderror                               
                                </div>

                                <div class="fv-row mb-7">                                    
                                    <label class="required fw-semibold fs-6 mb-2">User Name</label>                                  
                                    <input type="text" name="user_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="User name" 
                                    value="{{ old('user_name', $user->username) }}"/>
                                    @error('user_name')
                                        <div class="text-danger my-2">{{ $message }}</div>
                                    @enderror                               
                                </div>

                                <div class="fv-row mb-7">                                    
                                    <label class="required fw-semibold fs-6 mb-2">Email</label>                                   
                                    <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Email"
                                    value="{{ old('email', $user->email) }}" />  
                                    @error('email')
                                        <div class="text-danger my-2">{{ $message }}</div>
                                    @enderror                                  
                                </div>

                                <div class="fv-row mb-7">                                    
                                    <label class="required fw-semibold fs-6 mb-2">Phone</label>                                   
                                    <input type="number" name="user_phone" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="09" 
                                    value="{{ old('user_phone', $user->phone) }}"/> 
                                    @error('user_phone')
                                        <div class="text-danger my-2">{{ $message }}</div>
                                    @enderror                                  
                                </div>

                                <div class="fv-row mb-7">                                    
                                    <label class="required fw-semibold fs-6 mb-2">Password</label>                                   
                                    <input type="password" name="user_password" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" />
                                    @error('user_password')
                                        <div class="text-danger my-2">{{ $message }}</div>
                                    @enderror                                   
                                </div>

                                <div class="fv-row mb-7">                                    
                                    <label class="required fw-semibold fs-6 mb-2">Gender</label>    
                                    <div class="d-flex">
                                        <!--begin::Radio-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                            <input class="form-check-input" type="radio" value="1" name="user_gender" 
                                            @checked($user->gender)/>
                                            <span class="form-check-label">Male</span>
                                        </label>
                                        <!--end::Radio-->
                                        <!--begin::Radio-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                            <input class="form-check-input" type="radio" value="0" name="user_gender" 
                                            @checked(!$user->gender)/>
                                            <span class="form-check-label">FeMale</span>
                                        </label>
                                        <!--end::Radio-->
                                    </div>  
                                    @error('user_gender')
                                        <div class="text-danger my-2">{{ $message }}</div>
                                    @enderror                             
                                </div>

                                <div class="fv-row mb-7">                                    
                                    <label class="required fw-semibold fs-6 mb-2">Is Active</label>
                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                        <input class="form-check-input" type="checkbox" value="{{ 'checked' ? 1 : 0 }}" name="active" 
                                        @checked($user->is_active)/>
                                        <span class="form-check-label">Is Active</span>
                                    </label>                                   
                                </div>

                                <div class="mb-7">
                                    <label class="required fw-semibold fs-6 mb-5">Role</label>
                                    @foreach ($roles as $role)
                                        <div class="d-flex fv-row">
                                            <div class="form-check form-check-custom form-check-solid">
                                                <input class="form-check-input me-3" name="user_role" type="radio" value="{{ $role->id }}" 
                                                @checked($user->role_id == $role->id)/>
                                                <label class="form-check-label" for="kt_modal_update_role_option_0">
                                                    <div class="fw-bold text-gray-800">{{ $role->name }}</div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class='separator separator-dashed my-5'></div>
                                    @endforeach
                                    @error('user_role')
                                        <div class="text-danger my-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
    @endsection

    @push('child-scripts')
        <!--begin::Vendors Javascript(used for this page only)-->
		{{-- <script src="/assets/plugins/custom/datatables/datatables.bundle.js"></script> --}}
		<!--end::Vendors Javascript-->
		<!--begin::Custom Javascript(used for this page only)-->
		{{-- <script src="/assets/js/custom/apps/user-management/users/list/table.js"></script>
		<script src="/assets/js/custom/apps/user-management/users/list/export-users.js"></script>
		<script src="/assets/js/custom/apps/user-management/users/list/add.js"></script>
		<script src="/assets/js/widgets.bundle.js"></script>
		<script src="/assets/js/custom/widgets.js"></script>
		<script src="/assets/js/custom/apps/chat/chat.js"></script>
		<script src="/assets/js/custom/utilities/modals/upgrade-plan.js"></script>
		<script src="/assets/js/custom/utilities/modals/create-app.js"></script>
		<script src="/assets/js/custom/utilities/modals/users-search.js"></script> --}}
		<!--end::Custom Javascript-->
    @endpush