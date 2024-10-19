<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
          <a href="{{route('api.index')}}" class="logo">
            <img
              src="{{asset('kai/img/kaiadmin/logo_light.svg')}}"
              alt="navbar brand"
              class="navbar-brand"
              height="20"
            />
          </a>
          <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
              <i class="gg-menu-right"></i>
            </button>
            <button class="btn btn-toggle sidenav-toggler">
              <i class="gg-menu-left"></i>
            </button>
          </div>
          <button class="topbar-toggler more">
            <i class="gg-more-vertical-alt"></i>
          </button>
        </div>
        <!-- End Logo Header -->
        
    </div>   
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
        <ul class="nav nav-secondary" id="main-folder-list">

        </ul>
      </div>
      {{-- <form method="POST" action="{{ route('api.logout') }}">
        @csrf

        <x-dropdown-link :href="route('api.logout')"
                onclick="event.preventDefault();
                            this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-dropdown-link>
    </form> --}}
  </div>       
</div>
{{-- @section('additional_js')
<script src="{{ asset('js/navigation_page.js') }}"></script>
@endsection --}}

