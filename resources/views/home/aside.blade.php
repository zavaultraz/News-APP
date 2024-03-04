<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="{{ route('home')}}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>

    </li><!-- End Dashboard Nav -->


    @if (Auth::user()->role=='admin')
    <li class="nav-item">
      <a class="nav-link mt-2" href="{{route('category.index')}}">
        <i class="bi bi-basket"></i>
        <span>category</span>
      </a>

    </li>
    @else
      
    @endif
    <!-- news -->

  
  </ul>

</aside>