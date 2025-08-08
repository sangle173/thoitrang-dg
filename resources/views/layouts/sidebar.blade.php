<div class="sidebar bg-dark text-white">
    <ul class="nav flex-column">
        <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
        href="{{ route('dashboard') }}">Dashboard</a>
        </li>
    
        <!-- Add more links as needed -->
    </ul>
</div>
