<nav class="navbar sticky-top bg-success-subtle">
    <div class="container-fluid">
        <div class="navbar-brand">

            <?php

            echo "Name: " . "<strong>" . $session_name . "</strong>";

            ?>

        </div>
        <div class="d-flex" role="search">
            <a class="text-decoration-none" href="logout.php">
                <i class="fs-5 bi-box-arrow-right"></i>
                <strong>Logout</strong>
            </a>
        </div>
    </div>
</nav>