<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">

            @foreach($modules as $m)

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>{{$m['name']}}</span>
            </h6>

            @foreach($m['resources'] as $r)
            <li class="nav-item">
                <a class="nav-link" href="{{route($r['resource'])}}">
                    <span data-feather="file"></span>
                    {{$r['name']}}
                </a>
            </li>
            @endforeach
            @endforeach
        </ul>
    </div>
</nav>