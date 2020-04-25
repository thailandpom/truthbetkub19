<header id="page-header">
  <div class="content-header">
    <div>
      <button type="button" class="btn btn-hero-danger btn-square btn-hero-sm mr-1 btn-swap btn-swap-a" data-toggle="layout" data-action="sidebar_toggle">
        <i class="fa fa-fw fa-bars"></i>
      </button>
    </div>
    <div>
      <div class="dropdown d-inline-block">
        <a href="{{ route('logout') }}" class="btn btn-square btn-hero-danger new-btn btn-swap"
          onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
           Sign Out <i class="fas fa-sign-out-alt"></i>
        </a>
        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
      </div>
    </div>
  </div>
</header>
