<!-- Registration form -->
<div id="council-register" class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <h2>Good choice </h2>
        <p>It's time to make a difference.</p>
        <form action=<?php echo SITE_URL . "/register" ;?> method='post'>
            <div class="form-group">
                <input  class="form-control" type="text" class="form-control" name="council-email" placeholder="youremail@domain.com" required>
            </div>
            <div class="form-group">
                <input  class="form-control" type="password" class="form-control" name="council-password" autocomplete="off" required>
            </div>
            <button class="btn btn-default btn-lg" type="submit">Be Somebody</button>
        </form>
    </div>
</div>
<!-- End registration form -->