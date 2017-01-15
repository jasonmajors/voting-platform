<!DOCTYPE html>
<html lang="en">

<?php include_once dirname(__FILE__) . '/partials/site-head.view.php'; ?>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    rwp
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">The Stuff</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#council">Join the Council</a>
                    </li>
<!--                     <li>
                        <a data-toggle="modal" data-target="#login-modal" href="#">Login</a>
                    </li> -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
            <?php include_once dirname(__FILE__) . '/partials/modals/alert-modal.view.php'; ?>
            <?php include_once dirname(__FILE__) . '/partials/modals/login-modal.view.php'; ?>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">OC People Stuff</h1>
                        <p class="intro-text">That Orange County stuff...
                            <br>Together we can catalog it all.</p>
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- The Stuff Section -->
    <section id="about" class="container content-section">
        <div class="row">
            <h2 class="text-center">Here's what we got</h2>
            <div class="col-lg-8">
                <ul>
                <?php 
                    foreach ($approved as $item):
                        $html  = $item['content'];
                        $html .= ' - Rating: ' . $item['percentage'];
                    ?>
                    <li><?php echo $html; ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <hr>
        <!-- New entries -->
        <div class="row">
            <div class="text-center">
                <h1>What are we missing?</h1>
                <p>Submit an entry, and the council will decide.</p>
                <div class="col-lg-4 col-lg-offset-4">
                    <form action="/rwp/" method='post'>
                        <div class="form-group">
                            <input type="text" class="form-control" name="content" placeholder="Some OC Stuff">
                        </div>
                            <button class="btn btn-default" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- End New entries -->
        <br>
        <hr>
    </section>

    <!-- Join The Council Section -->
    <section id="council" class="content-section text-center">
        <div class="council-section">
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>Become Part Of the Council</h2>
                    <h4>Register and have your submissions tracked.</h4>
                    <p>If ten of your submissions are approved, you will become a part of the council. Councilmembers are the chosen ones who vote yay or nay on all submissions.</p>
                    <p>You will help decide which stuff is truly the most OC.</p>
                    <div id="register-handle" class="col-lg-4 col-lg-offset-4">
                        <button id="register-cta" class="btn btn-default btn-lg" type="submit">Register</button>
                    </div>
                    <!-- registration form -->
                    <?php include_once dirname(__FILE__) . '/partials/registration.view.php'; ?>
                </div>
            </div>
        </div>
    </section>
    <?php include_once dirname(__FILE__) . '/partials/footer.view.php'; ?>
</body>

</html>
