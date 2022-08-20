<?php include_once __DIR__ . "/layout/header.php"; ?>

<main class="modal-content-main">
    <div class="form-signin w-25 m-auto">
        <form method="post" action="<?= route('login.store') ?>">
            <h2><a href="" class="text-decoration-none text-danger fw-bold">Meta Script Mint</a></h2>
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <?php if (isset(\App\Config\Validator::$errors['email'])){dd(\App\Config\Validator::$errors['email']);} ?>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">&copy; <?= date('Y') . '-' . date('Y', strtotime("-5 years", strtotime(date("Y")))) ?></p>
        </form>
    </div>
</main>


<?php include_once __DIR__ . "/layout/footer.php" ?>
