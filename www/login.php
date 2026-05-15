<?php

/*
* Author: Sean Boa
* Date: May 2026
*/


$pageTitle = "Login";

include __DIR__ . '/resources/views/header.php';

if(isset($_SESSION['errors']['login'])) {
    $errors = $_SESSION['errors']['login'];
}


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
                                            <input class="input <?=isset($errors['studentNumber']) ? 'is-danger' : '' ?>"
                                                   type="text"
                                                   id="username"
                                                   name="username"
                                                   placeholder=""
                                            >
                                        </div>
                                    <?php if (isset($errors['studentNumber'])): ?>
                                        <article class="message is-danger is-small mt-2">
                                            <div class="message-header">
                                                <p>Error</p>
                                                <button class="delete is-small" type="button"></button>
                                            </div>
                                            <div class="message-body">
                                                <?php foreach ($errors['studentNumber'] as $error): ?>
                                                <?= htmlspecialchars($error) ?>
                                                <?php endforeach; ?>
                                            </div>
                                        </article>
                                    <?php endif; ?>
                                </div>

                                <div class="field">
                                    <label class="label" for="password">Password</label>
                                    <input class="input <?=isset($errors['password']) ? 'is-danger' : '' ?>"
                                           type="password"
                                           id="password"
                                           name="password"
                                           placeholder="">
                                </div>
                                <?php if (isset($errors['password'])): ?>
                                    <article class="message is-danger is-small mt-2">
                                        <div class="message-header">
                                            <p>Error</p>
                                            <button class="delete is-small" type="button" aria-label="delete"></button>
                                        </div>
                                        <div class="message-body">
                                            <?php foreach ($errors['password'] as $error): ?>
                                                <?= htmlspecialchars($error) ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </article>
                                <?php endif; ?>
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


    <script>
        document.querySelectorAll('.message .delete').forEach(($delete) => {
                const $message = $delete.parentNode.parentNode;

                $delete.addEventListener('click', () => {
                    const $field = $message.parentNode;
                    const $input = $field.querySelector('input');
                    if ($input) {
                        $input.classList.remove('is-danger');
                    }
                    $message.parentNode.removeChild($message);
                });
            });
    </script>

<?php
unset($_SESSION['errors']['login']);
include __DIR__ . '/resources/views/footer.html';
?>