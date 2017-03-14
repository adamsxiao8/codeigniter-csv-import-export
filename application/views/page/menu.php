<nav role="navigation" class="navbar navbar-inverse">
    <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <?php echo $menu; ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo base_url("/user/logout"); ?>">Logout</a></li>
        </ul>
    </div>
</nav>
