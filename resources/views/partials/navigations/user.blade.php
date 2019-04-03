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
            Purchase Request
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="navs nav-link" href="{{ route('newPR') }}" aria-expanded="false"><i class="fas fa-plus"></i>&nbsp New</a>
                <a class="navs nav-link" href="{{ route('usertransactions', ['type' => 'PR']) }}" aria-expanded="false"><i class="fas fa-eye"></i>&nbsp View All</a>
                
          </div>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            PPMP
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="navs nav-link" href="{{ route('newPPMP') }}" aria-expanded="false"><i class="fas fa-plus"></i>&nbsp New</a>
              <a class="navs nav-link" href="{{ route('usertransactions', ['type' => 'PPMP']) }}" aria-expanded="false"><i class="fas fa-eye"></i>&nbsp View All</a>
               
          </div>
      </li>
    </ul>
    <!--
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Inventory
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a href="#"></a>
          </div>
      </li>
    </ul>-->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link notification" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-bell">
                          <small id="notif-count"></small>
                  </i>
          </a>
          <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown" id="notif-content">

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
