@include('templates.cnews.header')
  <div class="body">
    <div class="body_resize">
      <div class="left">
        @yield('content')
      </div>
      @include('templates.cnews.right_bar')
      <div class="clr"></div>
    </div>
  </div>
@include('templates.cnews.footer')