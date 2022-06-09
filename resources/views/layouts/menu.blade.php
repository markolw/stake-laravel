<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>

<li class="{{ Request::is('admin/messages*') ? 'active' : '' }}">
    <a href="{{ route('admin.messages.index') }}"><i class="fa fa-edit"></i><span>Messages</span></a>
</li>
