<?php

// Placeholder index page, just using for testing backend and outputting database/session information.

session_start();

if (isset($_SESSION['user'])) {
    $name = $_SESSION['user']['name'];
}

$pageTitle = '357ltd';
include 'resources/views/header.php'
?>

<section class="hero is-medium is-primary">
    <div class="hero-body has-text-centered">
        <div class="container">
            <p class="title is-1">357Ltd</p>
            <p class="subtitle">Student computing resources, based in the Highlands of Scotland</p>
            <section class="section">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec iaculis dui libero, sit amet suscipit
                    magna ullamcorper at. Morbi ante lacus, sodales at tincidunt non, maximus ultricies magna. In mi
                    metus, congue non faucibus at, maximus eget odio. Aenean laoreet nec mi vel eleifend. Morbi orci
                    ipsum, ornare nec faucibus euismod, accumsan malesuada turpis. Aliquam ultrices nisi velit, sit amet
                    facilisis felis dictum sit amet. Proin et aliquam ligula. Nulla venenatis vel libero at vestibulum.
                    Nullam at massa sed lectus fermentum hendrerit.</p>
            </section>
        </div>

    </div>
    <div class="hero-foot">
        <nav class="level mb-5">
            <div class="level-item has-text-centered">
                <div>
                    <span class="icon-text">
                    <span class="icon has-text-primary-30">
                    <i class="fas fa-at fa-xl"></i>
                    </span>
                    <span class="heading">Email Us</span>
                    </span>
                    <p class="title is-4">contact@357ltd.com</p>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <span class="icon-text">
                    <span class="icon has-text-primary-30">
                    <i class="fas fa-phone fa-xl"></i>
                    </span>
                    <span class="heading">Phone Us</span>
                    </span>
                    <p class="title is-4">+44 (0) 1463 357 753</p>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <span class="icon-text">
                    <span class="icon has-text-primary-30">
                    <i class="fa-brands fa-instagram fa-xl"></i>
                    </span>
                    <span class="heading">Instagram</span>
                    </span>
                    <p class="title is-4">@357Scotland</p>
                </div>
            </div>
        </nav>
    </div>
</section>


<?php include 'resources/views/footer.html' ?>
