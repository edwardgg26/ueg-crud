<nav class="navbar bg-primary" data-bs-theme="dark">
    <div class="container">
        <div class="d-flex gap-2 align-items-center">
            <a class="navbar-brand" href="/dashboard.php">Facultad ingenieria UEG</a>
            <?php echo isset($_SESSION['id']) ? '<p class="mb-0 d-none d-md-block">Hola, <span class="fw-bold">'.$_SESSION["nombre"].'</span> - '.strtoupper($_SESSION['rol_nombre']).'</p>' : null;?>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end bg-primary" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Facultad ingenieria UEG</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <?php echo isset($_SESSION['id']) ? '<p class="mb-0 d-block d-md-none">Hola, <span class="fw-bold">'.$_SESSION["nombre"].'</span> - '.strtoupper($_SESSION['rol_nombre']).'</p>' : null;?>
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <?php if(isset($_SESSION) && !isset($_SESSION['id'])):?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $_SERVER['REQUEST_URI'] === '/index.php' || $_SERVER['REQUEST_URI'] === '/' ? 'active': null;?>" aria-current="page" href="/">Inicio de Sesion</a>
                        </li>
                    <?php else:?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $_SERVER['REQUEST_URI'] === '/dashboard.php'? 'active': null;?>" aria-current="page" href="/dashboard.php">Dashboard</a>
                        </li>

                        <?php if(isset($_SESSION) && $_SESSION['rol_id'] == 1):?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $_SERVER['REQUEST_URI'] === '/programas/'? 'active': null;?>" aria-current="page" href="/programas/">Programas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $_SERVER['REQUEST_URI'] === '/usuarios/'? 'active': null;?>" aria-current="page" href="/usuarios/">Usuarios</a>
                            </li>           
                            <li class="nav-item">
                                <a class="nav-link <?php echo $_SERVER['REQUEST_URI'] === '/horarios/'? 'active': null;?>" aria-current="page" href="/horarios/">Horarios</a>
                            </li>
                        <?php endif;?>

                        <?php if(isset($_SESSION) && $_SESSION['rol_id'] == 2):?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $_SERVER['REQUEST_URI'] === '/docente/horario/'? 'active': null;?>" aria-current="page" href="/docente/horario/">Materias</a>
                            </li>
                        <?php endif;?>

                        <?php if(isset($_SESSION) && $_SESSION['rol_id'] == 3):?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $_SERVER['REQUEST_URI'] === '/estudiante/matriculas/'? 'active': null;?>" aria-current="page" href="/estudiante/matriculas/">Matricular</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $_SERVER['REQUEST_URI'] === '/estudiante/horario/'? 'active': null;?>" aria-current="page" href="/estudiante/horario/">Horario</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $_SERVER['REQUEST_URI'] === '/estudiante/notas/'? 'active': null;?>" aria-current="page" href="/estudiante/notas/">Notas</a>
                            </li>
                        <?php endif;?>

                        <li class="nav-item">
                            <form action="/logout.php">
                                <input type="submit" class="nav-link" value="Cerrar Sesion">
                            </form>
                        </li>
                    <?php endif;?>
                </ul>
            </div>
        </div>
    </div>
</nav>