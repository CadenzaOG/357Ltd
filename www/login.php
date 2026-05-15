<?php

$pageTitle = "Login";

include __DIR__ . '/resources/views/header.php';

?>

<main class="is-flex is-flex-direction-column">
    <div class="hero is-medium">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-centered">
                    <div class="column is-4">
                        <div class="box">
                            <h1 class="title is-primary has-text-centered">Login</h1>
                            <form class="form" action="resources/handlers/login.handler.php" method="post">
                                <div class="field is-normal">
                                        <label class="label" for="username">Student Number</label>
                                        <div class="control">
                                            <input class="input" type="text" id="username" name="username"
                                                   placeholder="">
                                        </div>
                                </div>

                                <div class="field">
                                    <label class="label" for="password">Password</label>
                                    <input class="input" type="password" id="password" name="password" placeholder="">
                                </div>
                                    <div class="control">
                                        <button class="button is-info is-fullwidth mt-3 mb-3" type="submit">Login</button>
                                    </div>
                            </form>
                            <div class="has-text-centered">
                            <span class="subtitle has-text-centered is-size-6">
                                Don't have an account? Register Here
                            </span>
                            </div>
                            <div class="control has-text-centered">
                                <a class="button is-normal is-info mt-2 mb-2" href="signup.html">Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-foot">

        </div>


    </div>




</main>

<?php include __DIR__ . '/resources/views/footer.html'; ?>