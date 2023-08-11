<nav class="main-navbar">
    <div class="container">
        <ul>
            <li class="menu-item">
                <a href="{{route('dashboard.index')}}" class="menu-link">
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{route('control.index')}}" class="menu-link">
                    <i class="bi bi-stack"></i>
                    <span>Control</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{route('node.index')}}" class="menu-link">
                    <i class="bi bi-stack"></i>
                    <span>Node</span>
                </a>
            </li>

            <li class="menu-item active">
                <a href="{{route('sensor.index')}}" class="menu-link">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Sensor</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{route('relay.index')}}" class="menu-link">
                    <i class="bi bi-file-earmark-medical-fill"></i>
                    <span>Relay</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{route('user.index')}}" class="menu-link">
                    <i class="bi bi-table"></i>
                    <span>User</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{route('log.index')}}" class="menu-link">
                    <i class="bi bi-plus-square-fill"></i>
                    <span>Log</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
