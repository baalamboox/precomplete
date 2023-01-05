<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="">
        <img src="img/logo.png" width="30" height="30" alt="" loading="lazy">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item p-2">
                <div id="nav_mail_usuario" style="color: white;" class="">
                    <?php echo (!($usuario == "")) ? "$usuario" : "" ; ?></div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="salir" style="color:crimson;"
                    <?php echo (!($usuario == "")) ? "" : "hidden" ?>>Cerrar Sesión</a>
            </li>
        </ul>
    </div>
</nav>