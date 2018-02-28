<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?= url(''); ?>">Home</a></li>
                <li><a href="<?= url('about'); ?>">About</a></li>
                <li><a href="<?= url('contact'); ?>">Contact</a></li>
                <?php if(\App\Auth\Auth::guest() === false): ?>
                <li><a href="<?= url('login'); ?>">Login</a></li>
                <li><a href="<?= url('register'); ?>">Register</a></li>
                <?php else: ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= \App\Auth\Auth::User()['name']; ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= url('dashboard'); ?>">Dashboard</a></li>
                            <li><a href="<?= url('logout'); ?>">Logout</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>