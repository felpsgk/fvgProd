<!-- Barra lateral -->
<ul class="navbar-nav  sidebar sidebar-dark accordion" style="background-color:#198754;" id="accordionSidebar">

    <!-- Sidebar - LOGO + Nome -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">FVG</div>
    </a>

    <!-- divisor -->
    <hr class="sidebar-divisor bg-success my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- divisor -->
    <hr class="sidebar-divisor bg-success">

    <!-- Titulo opaco menu -->
    <div class="sidebar-heading">
        Registrar
    </div>

    <!-- Nav Item - Opcao opaco menu -->
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="presenca.php">
            <i class="fas fa-fw fa-user-check"></i>
            <span>Presença</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="atendimento.php">
            <i class="fas fa-ticket-alt"></i>
            <span>Atendimentos</span></a>
    </li>
    <li class="nav-item">
        <a id="medicoCadModalBt" class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#medicoCadModal">
            <i class="fa-solid fa-address-card"></i>Cadastrar médico</a>
    </li>
    <li class="nav-item">
        <a id="chatModalBt" class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#chatModal">
            <i class="fa-regular fa-comments"></i>Chat</a>
    </li>
    <!-- divisor -->
    <hr class="sidebar-divisor bg-success">
    <!-- divisor -->
    <hr class="sidebar-divisor d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>