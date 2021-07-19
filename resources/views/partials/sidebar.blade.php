<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                    <span data-feather="home"></span>
                    Home <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a
                    class="nav-link
                    {{ Request::is('view-results') ||
                    Request::is('view-results/game-results') ||
                    Request::is('view-results/mini-game-results') ? 'active' : '' }}"
                    href="{{ url('view-results') }}">
                    <span data-feather="file-text"></span>
                    View Results
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('statistics') ? 'active' : '' }}" href="{{ url('statistics') }}">
                    <span data-feather="bar-chart-2"></span>
                    Statistics <span class="sr-only">(current)</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
