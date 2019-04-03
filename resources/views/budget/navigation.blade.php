@push('style')
  <link rel="stylesheet" href="{{ asset('css/navigation.css') }}">
@endpush
<nav class="navbar navbar-expand-lg navigation">
  <a class="navbar-brand text-white" href="/home">{{ $dept }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Budgets
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="navs nav-link" href="{{ route('budgets') }}" aria-expanded="false"><i class="fas fa-shopping-cart"></i>&nbsp APP</a>
          </div>
      </li>
    </ul>
    
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link notification" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-bell">
                          <small id="notif-count"></small>
                  </i>
          </a>
          <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown" id="notif-content">
                  <div class="row">
                          <div class="col-md-12">
                                  <div class="form-group mb-0">
                                          <strong>Low stock</strong>
                                  </div>
                          </div>    
                  </div>
                  <hr class="mt-0 mb-0 bg-primary">
          </div>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{auth()->user()->name}}
          </a>
          <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
              @if($page != 'Home')
              <a class="nav-link" href="home">Home <span class="sr-only">(current)</span></a>
              @endif
              <a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();" class="nav-link ">
                                  
                  {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
          </div>
      </li>
    </ul>
  </div>
</nav>