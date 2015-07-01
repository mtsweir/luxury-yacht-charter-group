<footer class="site-footer">

    <div class="footer-nav">
        <div class="row">
            <div class="medium-6 medium-push-3 columns">
                <div class="row collapse">
                    <div class="medium-4 columns">
                        <h4>Yachts</h4>
                        <ul class="nav-list no-bullet">
                          <li><a href="#">Sailing Yachts</a></li>
                          <li><a href="#">Motor Yachts</a></li>
                          <li><a href="#">Catamarans</a></li>
                          <li><a href="#">Gulets</a></li>
                        </ul>
                    </div>
                    <div class="medium-4 columns">
                        <h4>About Us</h4>
                        <ul class="nav-list no-bullet">
                          <li><a href="#">Our Vision</a></li>
                          <li><a href="#">Why choose us</a></li>
                          <li><a href="#">Testimonials</a></li>
                          <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="medium-4 columns">
                        <h4>Resources</h4>
                        <ul class="nav-list no-bullet">
                          <li><a href="#">Meet our Brokers</a></li>
                          <li><a href="#">Latest News</a></li>
                          <li><a href="#">Blog</a></li>
                          <li><a href="#">Faq's</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="medium-3 medium-push-3 columns">
                <h4>Keep in Touch</h4>
                <p>Get the latest updates on our work delivered to your inbox.</p>

                <form class="nav-subscribe">
                  <div class="row collapse">
                    <div class="large-12 columns">
                      <div class="row collapse">
                        <div class="small-10 column">
                          <input class="input-subscribe" type="text" placeholder="email address">
                        </div>
                        <div class="small-2 column">
                          <a href="#" class="button-subscribe button postfix postfix-radius">Go</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>

            </div>
            <div class="medium-3 medium-pull-9 columns">
                <h4>Follow us on</h4>
                <nav class="nav-social">
                    <?php if ($settingsRecord['facebook']): ?><a href="<?php echo $settingsRecord['facebook'] ?>" class="social-icon social-icon-facebook"><i class="fa fa-facebook"></i></a><?php endif ?>
                    <?php if ($settingsRecord['twitter']): ?><a href="<?php echo $settingsRecord['twitter'] ?>" class="social-icon social-icon-twitter"><i class="fa fa-twitter"></i></a><?php endif ?>
                    <?php if ($settingsRecord['google']): ?><a href="<?php echo $settingsRecord['google'] ?>" class="social-icon social-icon-googleplus"><i class="fa fa-google-plus"></i></a><?php endif ?>
                </nav>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="row">
            <div class="small-12 column">
                <a class="logo-myba" href="http://www.myba-association.com/en/myba-members.cfm?search=luxurychartergroup" target="_blank" rel="nofollow">The Worldwide Yachting Association</a>
                <p>Member of MYBA, The Worldwide Yachting Association.</p>
                <ul class="nav-footer-info inline-list">
                    <li><?php echo $settingsRecord['copyright'] ?></li>
                    <li><a href="/page.php/privacy-policy-6/">Privacy Policy</a></li>
                </ul>
                <p style="color: #999;">Page Loaded in <?php echo showExecuteSeconds(true); ?> seconds <?php if ($country_code): ?>from "<?php echo($country_code); ?>"<?php endif ?></p>
            </div>
        </div>
    </div>

</footer>