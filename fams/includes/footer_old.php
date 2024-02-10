<!--
<footer class="site-footer" id="contact">
    <br>
    <br>
    <div class="container">
        <div class="row">
            <!-- Contact Information -->
            <div class="col-lg-5 me-auto col-12">
                <?php
                $sql = "SELECT * FROM tblpage WHERE PageType='contactus'";
                $query = $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);

                if ($query->rowCount() > 0) {
                    foreach ($results as $row) {
                        ?>
                        <h5 class="mb-lg-4 mb-3">School Open Hours</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex">
                                <?php echo $row->Timing; ?>
                            </li>
                        </ul>
                        <h5 class="mb-lg-4 mb-3">Email</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex">
                                <?php echo $row->Email; ?>
                            </li>
                        </ul>
                        <h5 class="mb-lg-4 mb-3">Contact Number</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex">
                                <?php echo $row->MobileNumber; ?>
                            </li>
                        </ul>
                        <?php
                    }
                }
                ?>
            </div>

            <!-- School Address -->
            <div class="col-lg-3 col-md-12 col-12 my-4 my-lg-0">
                <h5 class="mb-lg-4 mb-3">School Address</h5>
                <p><?php echo $row->PageDescription; ?></p>
            </div>

            <!-- Social Links -->
            <div class="col-lg-3 col-md-6 col-12 ms-auto">
                <h5 class="mb-lg-4 mb-2">SVCC Links</h5>
                <ul class="social-icon">
                    <li><a href="https://www.facebook.com/svcccabuyaoofficial" class="social-icon-link bi-facebook" target="_blank" style="color: #3b5998;"></a></li>
                    <li><a href="#" class="social-icon-link bi-twitter" style="color: #55acee;"></a></li>
                    <li><a href="http://www.svccsystem.com/" class="social-icon-link bi-instagram" style="color: #ac2bac;" target="_blank"></a></li>
                    <li><a href="#" class="social-icon-link bi-youtube" style="color: #ed302f;" target="_blank"></a></li>
                </ul>
            </div>
        </div>

        <!-- Google Map Embed -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="google-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3867.3478540570436!2d121.14597937387246!3d14.232918985975262!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd623f86aed823%3A0x73d3008db710fa11!2sSt.%20Vincent%20College%20Of%20Cabuyao!5e0!3m2!1sen!2sph!4v1700287677982!5m2!1sen!2sph" width="100%" height="300" style="border:0; border-radius: 15px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
    <br>
</footer>
