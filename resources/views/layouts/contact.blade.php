<div id="contact" class="contact-us section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="section-heading wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                    <h6>Hubungi Kami</h6>
                    <h4>Cek Kami <em>Sekarang</em></h4>
                    <div class="line-dec"></div>
                </div>
            </div>
            <div class="col-lg-12 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
                <form id="contact" action="" method="post">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="contact-dec">
                                <img src="{{asset('frontend/assets/images/contact-dec-v3.png')}}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div id="map">
                                <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9218.559892080784!2d109.33937804185899!3d-0.059263307934824205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1d59972b85950f%3A0x3e453dacc71a6e21!2sGedung%20Prodi%20Sistem%20Komputer!5e0!3m2!1sen!2sid!4v1689782900754!5m2!1sen!2sid"
                                    width="100%" height="636px" frameborder="0" style="border:0"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="fill-form">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="info-post">
                                            <div class="icon">
                                                <img src="{{asset('frontend/assets/images/phone-icon.png')}}" alt="">
                                                <a href="#">010-020-0340</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="info-post">
                                            <div class="icon">
                                                <img src="{{asset('frontend/assets/images/email-icon.png')}}" alt="">
                                                <a href="#">our@email.com</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="info-post">
                                            <div class="icon">
                                                <img src="{{asset('frontend/assets/images/location-icon.png')}}" alt="">
                                                <a href="#">123 Rio de Janeiro</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <fieldset>
                                            <input type="name" name="name" id="name"
                                                placeholder="Name" autocomplete="on" required>
                                        </fieldset>
                                        <fieldset>
                                            <input type="text" name="email" id="email"
                                                pattern="[^ @]*@[^ @]*" placeholder="Your Email" required="">
                                        </fieldset>
                                        <fieldset>
                                            <input type="subject" name="subject" id="subject"
                                                placeholder="Subject" autocomplete="on">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6">
                                        <fieldset>
                                            <textarea name="message" type="text" class="form-control" id="message" placeholder="Message" required=""></textarea>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <button type="submit" id="form-submit" class="main-button ">Send
                                                Message Now</button>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
