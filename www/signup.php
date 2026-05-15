<?php

/*
* Author: Sean Boa
* Date: May 2026
*/


$pageTitle = 'Signup';

include 'resources/views/header.php';

?>
<div class="hero">
    <div class="hero-body">
        <div class="container">
            <div class="columns has-text-centered">
                <div class="column is-two-thirds is-offset-2">
                    <div class="box">
                        <h1 class="title">Signup</h1>
                        <form class="form" method="POST" action="resources/handlers/signup.handler.php">

                            <div class="field is-horizontal">
                                <div class="field-label is-normal">
                                    <label class="label" for="student_number">Student Number</label>
                                </div>

                                <div class="field-body">
                                    <div class="field">
                                        <div class="control">
                                            <input class="input" type="text" name="student_number"
                                                   id="student_number">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="field is-horizontal">
                                <div class="field-label">
                                    <label class="label" for="forename">First Name</label>
                                </div>
                                <div class="field-body">
                                    <input class="input" type="text" name="forename" id="forename">
                                </div>
                            </div>

                            <div class="field is-horizontal">
                                <div class="field-label">
                                    <label class="label" for="surname">Surname</label>
                                </div>
                                <div class="field-body">
                                    <input class="input" type="text" name="surname" id="surname">
                                </div>
                            </div>

                            <div class="field is-horizontal">
                                <div class="field-label">
                                    <label class="label" for="house">House</label>
                                </div>
                                <div class="field-body">
                                    <input class="input" type="text" name="house" id="house">
                                </div>

                            </div>

                            <div class="field is-horizontal">
                                <div class="field-label">
                                    <label class="label" for="street">Street</label>
                                </div>
                                <div class="field-body">
                                    <input class="input" type="text" name="street" id="street">
                                </div>
                            </div>

                            <div class="field is-horizontal">
                                <div class="field-label">
                                    <label class="label" for="town">Town</label>
                                </div>
                                <div class="field-body">
                                    <input class="input" type="text" name="town" id="town">
                                </div>
                            </div>

                            <div class="field is-horizontal">
                                <div class="field-label">
                                    <label class="label" for="postcode">Postcode</label>
                                </div>
                                <div class="field-body">
                                    <input class="input" type="text" name="postcode" id="postcode">
                                </div>
                            </div>
                            <div class="field is-horizontal">
                                <div class="field-label">
                                    <label class="label" for="email" id="email">Email</label>
                                </div>
                                <div class="field-body">
                                    <input class="input" name="email" type="email" placeholder="">
                                </div>

                            </div>
                            <div class="field is-horizontal">
                                <div class="field-label">
                                    <label class="label" for="password">Password</label>
                                </div>
                                <div class="field-body">
                                    <input class="input" type="password" name="password" id="password">
                                </div>
                            </div>
                            <div class="field is-horizontal">
                                <div class="field-label">
                                    <label class="label" for="confirm_password">Confirm Password</label>
                                </div>
                                <div class="field-body">
                                    <input class="input" type="password" name="confirm_password" id="confirm_password">
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <button class="button is-info is-fullwidth" type="submit">Signup</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include 'resources/views/footer.html';?>

