<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">E-maji</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Alat</li>
            <li><a class="nav-link" href="{{ route('tool.index') }}"> <i class="fas fa-toolbox"></i> <span>Alat</span></a> </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="menu-header">Hasil</li>
            <li><a class="nav-link" href="{{ route('task.result.index') }}"> <i class="fas fa-poll-h"></i> <span>Hasil</span></a> </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="menu-header">File</li>
            <li><a class="nav-link" href="{{ route('file.index') }}"> <i class="fas fa-file-alt"></i> <span>File</span></a> </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="menu-header">User</li>
            <li><a class="nav-link" href="{{ route('user.index') }}" > <i class="fas fa-user"></i> <span>User</span></a> </li>
        </ul>
    </aside>
</div>