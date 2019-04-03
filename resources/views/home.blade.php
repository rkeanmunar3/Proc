@extends('layouts.masters')
@push('style')
        <link rel="stylesheet" href="{{ url('css/navigation.css') }}">
@endpush
@section('content')
        <div class="wrapper">
                    <!-- Sidebar  -->
                    <!--<nav id="sidebar">
                        <div class="sidebar-header">
                            <div class="row">
                                <div class="col-sm-4">
                                    <img src="{{ asset('img/logo.png') }}" style="width:60px; height:60px">
                                </div>
                                <div class="col-sm-6 ">
                                    <h4 class="mt-3">ePROC</h4>
                                </div>
                            </div>
                        </div>

                        <ul class="list-unstyled components">
                            <p>{{ auth()->user()->name }}</p>
                            <li>
                                <a class="navs" href="{{ route('dashboard') }}" aria-expanded="false"><i class="fas fa-tachometer-alt"></i>&nbsp Dashboard </a>
                            </li>
                            <li>
                                <a class="navs " href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-handshake"></i>&nbsp Transactions</a>
                                @if(auth()->user()->role == 1)
                                        <ul class="collapse list-unstyled active {{ is_active('mcc/transactions') ? 'show' : '' }}" id="pageSubmenu2">
                                                <li >
                                                        <a class="navs " href="{{ route('mcctransactions', ['status' => 'P']) }}" aria-expanded="false"><i class="fas fa-shopping-cart"></i>&nbsp Pending</a>
                                                </li>
                                                <li>
                                                        <a href="{{ route('mcctransactions', ['status' => 'A']) }}"><i class="fas fa-check"></i>&nbsp Approved</a>
                                                </li>
                                                <li>
                                                        <a href="{{ route('mcctransactions', ['status' => 'D']) }}"><i class="fas fa-times"></i>&nbsp Dispproved</a>
                                                </li>
                                                <li>
                                                        <a href="{{ route('mcctransactions', ['status' => 'R']) }}"><i class="fas fa-sync"></i>&nbsp Returned</a>
                                                </li>
                                        </ul>
                                @elseif(auth()->user()->role == 2)
                                        <ul class="collapse list-unstyled active {{ is_active('pmo/pr') ? 'show' : '' }}" id="pageSubmenu2">
                                                <li cl>
                                                        <a class="navs " href="{{ route('pr', ['status' => 'A']) }}" aria-expanded="false"><i class="fas fa-shopping-cart"></i>&nbsp Pending</a>
                                                </li>
                                                <li>
                                                        <a href="{{ route('pr', ['status' => 'C']) }}"><i class="fas fa-check"></i>&nbsp Approved</a>
                                                </li>
                                                <li>
                                                        <a href="{{ route('pr', ['status' => 'D']) }}"><i class="fas fa-times"></i>&nbsp Dispproved</a>
                                                </li>
                                                <li>
                                                        <a href="{{ route('pr', ['status' => 'R']) }}"><i class="fas fa-sync"></i>&nbsp Returned</a>
                                                </li>
                                        </ul>
                                @elseif(auth()->user()->role == 3)
                                        <ul class="collapse list-unstyled active {{ is_active('users/pr') ? 'show' : '' }}" id="pageSubmenu2">
                                                <li>
                                                        <a class="navs " href="{{ route('usertransactions') }}" aria-expanded="false"><i class="fas fa-shopping-cart"></i>&nbsp ALL</a>
                                                </li>
                                                <li>
                                                        <a class="navs " href="{{ route('usertransactions') }}" aria-expanded="false"><i class="fas fa-shopping-cart"></i>&nbsp PR</a>
                                                </li>
                                                <li>
                                                        <a class="navs " href="{{ route('usertransactions') }}" aria-expanded="false"><i class="fas fa-shopping-cart"></i>&nbsp PPMP</a>
                                                </li>
                                        </ul>
                                @elseif(auth()->user()->role == 4)
                                        <ul class="collapse list-unstyled active {{ is_active('users/pr') ? 'show' : '' }}" id="pageSubmenu2">
                                                <li>
                                                        <a class="navs " href="{{ route('userpr') }}" aria-expanded="false"><i class="fas fa-shopping-cart"></i>&nbsp Incoming Equipments</a>
                                                </li>
                                                <li>
                                                        <a class="navs " href="{{ route('userpr') }}" aria-expanded="false"><i class="fas fa-shopping-cart"></i>&nbsp Received Equipments</a>
                                                </li>
                                                <li>
                                                        <a class="navs " href="{{ route('userpr') }}" aria-expanded="false"><i class="fas fa-shopping-cart"></i>&nbsp Delivered Equipments</a>
                                                </li>
                                        </ul>
                                @endif
                            </li>
                                <li>
                                        <a class="navs " href="{{ route('ppmp') }}" aria-expanded="false"><i class="fas fa-file-alt"></i>&nbsp Inventory</a>
                                </li>
                            @if(auth()->user()->role == '2')
                                <li>
                                        <a class="navs " href="{{ route('ppmp') }}" aria-expanded="false"><i class="fas fa-file-alt"></i>&nbsp PPMP</a>
                                </li>
                                <li>
                                        <a class="navs" href="{{ route('app') }}" aria-expanded="false"><i class="fas fa-file-alt"></i>&nbsp APP</a>
                                </li>
                            @endif
                            
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                    <i class="fas fa-sign-out-alt"></i>
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </nav>
                    
                    Page Content  -->
                    
                    <div id="content">
                        <!--<nav class="navbar navbar-expand-lg navigation">
                                //<a class="navbar-brand text-white" href="/home">{{ $dept }}</a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                                </button>

                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <ul class="navbar-nav ml-auto">
                                                <li class="nav-item dropdown dropdown" >
                                                        <a class="nav-link notification" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Notifications&nbsp
                                                                <i class="fas fa-bell">
                                                                        <small id="notif-count"></small>
                                                                </i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown" id="notif-content">
                                                                <div class="row container-fluid">
                                                                        <div class="col-md-12">
                                                                                <div class="form-group mb-0">
                                                                                        <strong>Low stock</strong>
                                                                                </div>
                                                                        </div>    
                                                                </div>
                                                                <hr class="mt-0 mb-0 bg-primary">
                                                        </div>
                                                </li>
                                        </ul>
                                </div>
                        </nav>-->
                        <div class="container-fluid" id="content">
                            @yield('content')
                        </div>
                    </div>
                 </div>
@endsection

@section('scripts')

@endsection