<nav id="sidebar" aria-label="Main Navigation">
  <!-- Side Header -->
  <div class="bg-header-dark">
    <div class="content-header bg-white-10">
      <!-- Logo -->
      <a class="link-fx font-w600 font-size-lg text-white" href="{{ route('pages.index') }}">
        <img class="img-logo" src="{{ asset('/front-ends-assets/images/logo.svg')}}" style="height: 64px;">
      </a>
      <div class="d-block d-lg-none">
        <button type="button" class="btn btn-hero-danger btn-square btn-hero-sm mr-1 btn-swap btn-swap-a" data-toggle="layout" data-action="sidebar_toggle">
          <i class="fa fa-fw fa-bars"></i>
        </button>
      </div>
    </div>
  </div>
  <!-- END Side Header -->

  <!-- Side Navigation -->
  <div class="content-side content-side-full">
    <ul class="nav-main">
     

      <li class="nav-main-item {{ ($name == 'Pages') ? 'open' : ''}}">
        <a class="nav-main-link {{ ($name == 'Pages') ? 'active' : ''}}" href="{{ route('pages.index') }}">
          <i class="nav-main-link-icon si si-docs"></i>
          <span class="nav-main-link-name">หน้าเว็บ</span>
        </a>
      </li>

      <li class="nav-main-item {{ ($name == 'Contact') ? 'open' : ''}}">
        <a class="nav-main-link {{ ($name == 'Contact') ? 'active' : ''}}" href="{{ route('contact.index') }}">
          <i class="nav-main-link-icon si si-call-out"></i>
          <span class="nav-main-link-name">ข้อมูลติดต่อ</span>
        </a>
      </li>

      <li class="nav-main-item {{ ($name == 'Setting') ? 'open' : ''}}">
        <a class="nav-main-link {{ ($name == 'Setting') ? 'active' : ''}}" href="{{ route('settings.show', 'manage') }}">
          <i class="nav-main-link-icon si si-settings"></i>
          <span class="nav-main-link-name">ตั้งค่าระบบ</span>
        </a>
      </li>

      <li class="nav-main-item {{ ($name == 'Users') ? 'open' : ''}}">
        <a class="nav-main-link {{ ($name == 'Users') ? 'active' : ''}}" href="{{ route('users.index') }}">
          <i class="nav-main-link-icon si si-user"></i>
          <span class="nav-main-link-name">ผู้ใช้งานระบบ</span>
        </a>
      </li>

    </ul>
  </div>
  <!-- END Side Navigation -->
</nav>
