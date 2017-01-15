<!-- Footer -->
<footer>
    <div class="text-center">
    <br>
    <hr>
        <p>Copyright &copy; Jason Majors 2016</p>
    </div>
    <!-- jQuery -->
    <script src="vendor/jquery/jquery.js"></script>
    <script src="assets/js/main.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>


    <!-- Theme JavaScript -->
    <script src="assets/js/grayscale.js"></script>
    <!-- Alerts -->
    <?php if (isset($alert)):  ?>
        <script>
            $('#submission-modal').modal('show');
        </script>
    <?php endif; ?>
    <!-- End alerts -->
</footer>