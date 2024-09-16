@extends('layouts.front.app')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

        <img src="{{ asset('front/assets/img/hero-bg.jpg') }}" alt="" data-aos="fade-in" class="">

        <div class="container d-flex flex-column align-items-center text-center mt-auto">
            <h2 data-aos="fade-up" data-aos-delay="100" class="">THE ANNUAL<br><span>MARKETING</span>
                CONFERENCE</h2>
            <p data-aos="fade-up" data-aos-delay="200">10-12 December, Downtown Conference Center, New York</p>
            <div data-aos="fade-up" data-aos-delay="300" class="">
                <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn mt-3"></a>
            </div>
        </div>

        <div class="about-info mt-auto position-relative">

            <div class="container position-relative" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-6">
                        <h2>About The Event</h2>
                        <p>Sed nam ut dolor qui repellendus iusto odit. Possimus inventore eveniet accusamus error
                            amet eius aut
                            accusantium et. Non odit consequatur repudiandae sequi ea odio molestiae. Enim possimus
                            sunt inventore in
                            est ut optio sequi unde.</p>
                    </div>
                    <div class="col-lg-3">
                        <h3>Where</h3>
                        <p>Downtown Conference Center, New York</p>
                    </div>
                    <div class="col-lg-3">
                        <h3>When</h3>
                        <p>Monday to Wednesday<br>10-12 December</p>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- /Hero Section -->

    <!-- Speakers Section -->
    <section id="speakers" class="speakers section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Event Speakers<br></h2>

        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="member">
                        <img src="{{ asset('front/assets/img/speakers/speaker-1.jpg') }}" class="img-fluid" alt="">
                        <div class="member-info">
                            <div class="member-info-content">
                                <h4><a href="speaker-details.html">Walter White</a></h4>
                                <span>Quas alias incidunt</span>
                            </div>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Team Member -->

                <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="member">
                        <img src="{{ asset('front/assets/img/speakers/speaker-2.jpg') }}" class="img-fluid" alt="">
                        <div class="member-info">
                            <div class="member-info-content">
                                <h4><a href="speaker-details.html">Hubert Hirthe</a></h4>
                                <span>Consequuntur odio aut</span>
                            </div>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Team Member -->

                <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="member">
                        <img src="{{ asset('front/assets/img/speakers/speaker-3.jpg') }}" class="img-fluid" alt="">
                        <div class="member-info">
                            <div class="member-info-content">
                                <h4><a href="speaker-details.html">Amanda Jepson</a></h4>
                                <span>Fugiat laborum et</span>
                            </div>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Team Member -->

                <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="member">
                        <img src="{{ asset('front/assets/img/speakers/speaker-4.jpg') }}" class="img-fluid" alt="">
                        <div class="member-info">
                            <div class="member-info-content">
                                <h4><a href="speaker-details.html">William Anderson</a></h4>
                                <span>Debitis iure vero</span>
                            </div>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter-x"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Team Member -->

            </div>

        </div>

    </section><!-- /Speakers Section -->

    <!-- Schedule Section -->
    <section id="schedule" class="schedule section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Event Schedule<br></h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container">

            <ul class="nav nav-tabs" role="tablist" data-aos="fade-up" data-aos-delay="100">
                <li class="nav-item">
                    <a class="nav-link active" href="#day-1" role="tab" data-bs-toggle="tab">Day 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#day-2" role="tab" data-bs-toggle="tab">Day 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#day-3" role="tab" data-bs-toggle="tab">Day 3</a>
                </li>
            </ul>

            <div class="tab-content row justify-content-center" data-aos="fade-up" data-aos-delay="200">

                <h3 class="sub-heading">Voluptatem nulla veniam soluta et corrupti consequatur neque eveniet
                    officia. Eius necessitatibus voluptatem quis labore perspiciatis quia.</h3>

                <!-- Schdule Day 1 -->
                <div role="tabpanel" class="col-lg-9 tab-pane fade show active" id="day-1">

                    <div class="row schedule-item">
                        <div class="col-md-2"><time>09:30 AM</time></div>
                        <div class="col-md-10">
                            <h4>Registration</h4>
                            <p>Fugit voluptas iusto maiores temporibus autem numquam magnam.</p>
                        </div>
                    </div>

                    <div class="row schedule-item">
                        <div class="col-md-2"><time>10:00 AM</time></div>
                        <div class="col-md-10">
                            <div class="speaker">
                                <img src="{{ asset('front/assets/img/speakers/speaker-1-2.jpg') }}" alt="Brenden Legros">
                            </div>
                            <h4>Keynote <span>Brenden Legros</span></h4>
                            <p>Facere provident incidunt quos voluptas.</p>
                        </div>
                    </div>

                    <div class="row schedule-item">
                        <div class="col-md-2"><time>11:00 AM</time></div>
                        <div class="col-md-10">
                            <div class="speaker">
                                <img src="{{ asset('front/assets/img/speakers/speaker-2-2.jpg') }}" alt="Hubert Hirthe">
                            </div>
                            <h4>Et voluptatem iusto dicta nobis. <span>Hubert Hirthe</span></h4>
                            <p>Maiores dignissimos neque qui cum accusantium ut sit sint inventore.</p>
                        </div>
                    </div>

                    <div class="row schedule-item">
                        <div class="col-md-2"><time>12:00 AM</time></div>
                        <div class="col-md-10">
                            <div class="speaker">
                                <img src="front/assets/img/speakers/speaker-3-2.jpg" alt="Cole Emmerich">
                            </div>
                            <h4>Explicabo et rerum quis et ut ea. <span>Cole Emmerich</span></h4>
                            <p>Veniam accusantium laborum nihil eos eaque accusantium aspernatur.</p>
                        </div>
                    </div>

                    <div class="row schedule-item">
                        <div class="col-md-2"><time>02:00 PM</time></div>
                        <div class="col-md-10">
                            <div class="speaker">
                                <img src="front/assets/img/speakers/speaker-4-2.jpg" alt="Jack Christiansen">
                            </div>
                            <h4>Qui non qui vel amet culpa sequi. <span>Jack Christiansen</span></h4>
                            <p>Nam ex distinctio voluptatem doloremque suscipit iusto.</p>
                        </div>
                    </div>

                    <div class="row schedule-item">
                        <div class="col-md-2"><time>03:00 PM</time></div>
                        <div class="col-md-10">
                            <div class="speaker">
                                <img src="front/assets/img/speakers/speaker-5.jpg" alt="Alejandrin Littel">
                            </div>
                            <h4>Quos ratione neque expedita asperiores. <span>Alejandrin Littel</span></h4>
                            <p>Eligendi quo eveniet est nobis et ad temporibus odio quo.</p>
                        </div>
                    </div>

                    <div class="row schedule-item">
                        <div class="col-md-2"><time>04:00 PM</time></div>
                        <div class="col-md-10">
                            <div class="speaker">
                                <img src="front/assets/img/speakers/speaker-6.jpg" alt="Willow Trantow">
                            </div>
                            <h4>Quo qui praesentium nesciunt <span>Willow Trantow</span></h4>
                            <p>Voluptatem et alias dolorum est aut sit enim neque veritatis.</p>
                        </div>
                    </div>

                </div><!-- End Schdule Day 1 -->

                <!-- Schdule Day 2 -->
                <div role="tabpanel" class="col-lg-9  tab-pane fade" id="day-2">

                    <div class="row schedule-item">
                        <div class="col-md-2"><time>10:00 AM</time></div>
                        <div class="col-md-10">
                            <div class="speaker">
                                <img src="front/assets/img/speakers/speaker-1-2.jpg" alt="Brenden Legros">
                            </div>
                            <h4>Libero corrupti explicabo itaque. <span>Brenden Legros</span></h4>
                            <p>Facere provident incidunt quos voluptas.</p>
                        </div>
                    </div>

                    <div class="row schedule-item">
                        <div class="col-md-2"><time>11:00 AM</time></div>
                        <div class="col-md-10">
                            <div class="speaker">
                                <img src="front/assets/img/speakers/speaker-2-2.jpg" alt="Hubert Hirthe">
                            </div>
                            <h4>Et voluptatem iusto dicta nobis. <span>Hubert Hirthe</span></h4>
                            <p>Maiores dignissimos neque qui cum accusantium ut sit sint inventore.</p>
                        </div>
                    </div>

                    <div class="row schedule-item">
                        <div class="col-md-2"><time>12:00 AM</time></div>
                        <div class="col-md-10">
                            <div class="speaker">
                                <img src="front/assets/img/speakers/speaker-3-2.jpg" alt="Cole Emmerich">
                            </div>
                            <h4>Explicabo et rerum quis et ut ea. <span>Cole Emmerich</span></h4>
                            <p>Veniam accusantium laborum nihil eos eaque accusantium aspernatur.</p>
                        </div>
                    </div>

                    <div class="row schedule-item">
                        <div class="col-md-2"><time>02:00 PM</time></div>
                        <div class="col-md-10">
                            <div class="speaker">
                                <img src="front/assets/img/speakers/speaker-4-2.jpg" alt="Jack Christiansen">
                            </div>
                            <h4>Qui non qui vel amet culpa sequi. <span>Jack Christiansen</span></h4>
                            <p>Nam ex distinctio voluptatem doloremque suscipit iusto.</p>
                        </div>
                    </div>

                    <div class="row schedule-item">
                        <div class="col-md-2"><time>03:00 PM</time></div>
                        <div class="col-md-10">
                            <div class="speaker">
                                <img src="front/assets/img/speakers/speaker-5.jpg" alt="Alejandrin Littel">
                            </div>
                            <h4>Quos ratione neque expedita asperiores. <span>Alejandrin Littel</span></h4>
                            <p>Eligendi quo eveniet est nobis et ad temporibus odio quo.</p>
                        </div>
                    </div>

                    <div class="row schedule-item">
                        <div class="col-md-2"><time>04:00 PM</time></div>
                        <div class="col-md-10">
                            <div class="speaker">
                                <img src="front/assets/img/speakers/speaker-6.jpg" alt="Willow Trantow">
                            </div>
                            <h4>Quo qui praesentium nesciunt <span>Willow Trantow</span></h4>
                            <p>Voluptatem et alias dolorum est aut sit enim neque veritatis.</p>
                        </div>
                    </div>

                </div><!-- End Schdule Day 2 -->

                <!-- Schdule Day 3 -->
                <div role="tabpanel" class="col-lg-9  tab-pane fade" id="day-3">

                    <div class="row schedule-item">
                        <div class="col-md-2"><time>10:00 AM</time></div>
                        <div class="col-md-10">
                            <div class="speaker">
                                <img src="front/assets/img/speakers/speaker-2-2.jpg" alt="Hubert Hirthe">
                            </div>
                            <h4>Et voluptatem iusto dicta nobis. <span>Hubert Hirthe</span></h4>
                            <p>Maiores dignissimos neque qui cum accusantium ut sit sint inventore.</p>
                        </div>
                    </div>

                    <div class="row schedule-item">
                        <div class="col-md-2"><time>11:00 AM</time></div>
                        <div class="col-md-10">
                            <div class="speaker">
                                <img src="front/assets/img/speakers/speaker-3-2.jpg" alt="Cole Emmerich">
                            </div>
                            <h4>Explicabo et rerum quis et ut ea. <span>Cole Emmerich</span></h4>
                            <p>Veniam accusantium laborum nihil eos eaque accusantium aspernatur.</p>
                        </div>
                    </div>

                    <div class="row schedule-item">
                        <div class="col-md-2"><time>12:00 AM</time></div>
                        <div class="col-md-10">
                            <div class="speaker">
                                <img src="front/assets/img/speakers/speaker-1-2.jpg" alt="Brenden Legros">
                            </div>
                            <h4>Libero corrupti explicabo itaque. <span>Brenden Legros</span></h4>
                            <p>Facere provident incidunt quos voluptas.</p>
                        </div>
                    </div>

                    <div class="row schedule-item">
                        <div class="col-md-2"><time>02:00 PM</time></div>
                        <div class="col-md-10">
                            <div class="speaker">
                                <img src="front/assets/img/speakers/speaker-4-2.jpg" alt="Jack Christiansen">
                            </div>
                            <h4>Qui non qui vel amet culpa sequi. <span>Jack Christiansen</span></h4>
                            <p>Nam ex distinctio voluptatem doloremque suscipit iusto.</p>
                        </div>
                    </div>

                    <div class="row schedule-item">
                        <div class="col-md-2"><time>03:00 PM</time></div>
                        <div class="col-md-10">
                            <div class="speaker">
                                <img src="front/assets/img/speakers/speaker-5.jpg" alt="Alejandrin Littel">
                            </div>
                            <h4>Quos ratione neque expedita asperiores. <span>Alejandrin Littel</span></h4>
                            <p>Eligendi quo eveniet est nobis et ad temporibus odio quo.</p>
                        </div>
                    </div>

                    <div class="row schedule-item">
                        <div class="col-md-2"><time>04:00 PM</time></div>
                        <div class="col-md-10">
                            <div class="speaker">
                                <img src="front/assets/img/speakers/speaker-6.jpg" alt="Willow Trantow">
                            </div>
                            <h4>Quo qui praesentium nesciunt <span>Willow Trantow</span></h4>
                            <p>Voluptatem et alias dolorum est aut sit enim neque veritatis.</p>
                        </div>
                    </div>

                </div><!-- End Schdule Day 3 -->

            </div>

        </div>
    </section><!-- /Schedule Section -->

    <!-- Venue Section -->
    <section id="venue" class="venue section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Event Venue<br></h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container-fluid" data-aos="fade-up">

            <div class="row g-0">
                <div class="col-lg-6 venue-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621"
                        frameborder="0" style="border:0" allowfullscreen=""></iframe>
                </div>

                <div class="col-lg-6 venue-info">
                    <div class="row justify-content-center">
                        <div class="col-11 col-lg-8 position-relative">
                            <h3>Downtown Conference Center, New York</h3>
                            <p>Iste nobis eum sapiente sunt enim dolores labore accusantium autem. Cumque beatae
                                ipsam. Est quae sit qui voluptatem corporis velit. Qui maxime accusamus possimus.
                                Consequatur sequi et ea suscipit enim nesciunt quia velit.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="container-fluid venue-gallery-container" data-aos="fade-up" data-aos-delay="100">
            <div class="row g-0">

                <div class="col-lg-3 col-md-4">
                    <div class="venue-gallery">
                        <a href="front/assets/img/venue-gallery/venue-gallery-1.jpg" class="glightbox"
                            data-gall="venue-gallery">
                            <img src="front/assets/img/venue-gallery/venue-gallery-1.jpg" alt=""
                                class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4">
                    <div class="venue-gallery">
                        <a href="front/assets/img/venue-gallery/venue-gallery-2.jpg" class="glightbox"
                            data-gall="venue-gallery">
                            <img src="front/assets/img/venue-gallery/venue-gallery-2.jpg" alt=""
                                class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4">
                    <div class="venue-gallery">
                        <a href="front/assets/img/venue-gallery/venue-gallery-3.jpg" class="glightbox"
                            data-gall="venue-gallery">
                            <img src="front/assets/img/venue-gallery/venue-gallery-3.jpg" alt=""
                                class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4">
                    <div class="venue-gallery">
                        <a href="front/assets/img/venue-gallery/venue-gallery-4.jpg" class="glightbox"
                            data-gall="venue-gallery">
                            <img src="front/assets/img/venue-gallery/venue-gallery-4.jpg" alt=""
                                class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4">
                    <div class="venue-gallery">
                        <a href="front/assets/img/venue-gallery/venue-gallery-5.jpg" class="glightbox"
                            data-gall="venue-gallery">
                            <img src="front/assets/img/venue-gallery/venue-gallery-5.jpg" alt=""
                                class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4">
                    <div class="venue-gallery">
                        <a href="front/assets/img/venue-gallery/venue-gallery-6.jpg" class="glightbox"
                            data-gall="venue-gallery">
                            <img src="front/assets/img/venue-gallery/venue-gallery-6.jpg" alt=""
                                class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4">
                    <div class="venue-gallery">
                        <a href="front/assets/img/venue-gallery/venue-gallery-7.jpg" class="glightbox"
                            data-gall="venue-gallery">
                            <img src="front/assets/img/venue-gallery/venue-gallery-7.jpg" alt=""
                                class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4">
                    <div class="venue-gallery">
                        <a href="front/assets/img/venue-gallery/venue-gallery-8.jpg" class="glightbox"
                            data-gall="venue-gallery">
                            <img src="front/assets/img/venue-gallery/venue-gallery-8.jpg" alt=""
                                class="img-fluid">
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </section><!-- /Venue Section -->

    <!-- Hotels Section -->
    <section id="hotels" class="hotels section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Hotels</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100">
                        <div class="card-img">
                            <img src="front/assets/img/hotels-1.jpg" alt="" class="img-fluid">
                        </div>
                        <h3><a href="#" class="stretched-link">Non quibusdam blanditiis</a></h3>
                        <div class="stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                        <p>0.4 Mile from the Venue</p>
                    </div>
                </div><!-- End Card Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card h-100">
                        <div class="card-img">
                            <img src="front/assets/img/hotels-2.jpg" alt="" class="img-fluid">
                        </div>
                        <h3><a href="#" class="stretched-link">Aspernatur assumenda</a></h3>
                        <div class="stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                        <p>0.5 Mile from the Venue</p>
                    </div>
                </div><!-- End Card Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="card h-100">
                        <div class="card-img">
                            <img src="front/assets/img/hotels-3.jpg" alt="" class="img-fluid">
                        </div>
                        <h3><a href="#" class="stretched-link">Dolores ut ut voluptatibu</a></h3>
                        <div class="stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                        <p>0.6 Mile from the Venue</p>
                    </div>
                </div><!-- End Card Item -->

            </div>

        </div>

    </section><!-- /Hotels Section -->

    <!-- Gallery Section -->
    <section id="gallery" class="gallery section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Gallery</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
        {
          "loop": true,
          "speed": 600,
          "autoplay": {
            "delay": 5000
          },
          "slidesPerView": "auto",
          "centeredSlides": true,
          "pagination": {
            "el": ".swiper-pagination",
            "type": "bullets",
            "clickable": true
          },
          "breakpoints": {
            "320": {
              "slidesPerView": 1,
              "spaceBetween": 0
            },
            "768": {
              "slidesPerView": 3,
              "spaceBetween": 20
            },
            "1200": {
              "slidesPerView": 5,
              "spaceBetween": 20
            }
          }
        }
      </script>
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="front/assets/img/event-gallery/event-gallery-1.jpg"><img
                                src="front/assets/img/event-gallery/event-gallery-1.jpg" class="img-fluid"
                                alt=""></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="front/assets/img/event-gallery/event-gallery-2.jpg"><img
                                src="front/assets/img/event-gallery/event-gallery-2.jpg" class="img-fluid"
                                alt=""></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="front/assets/img/event-gallery/event-gallery-3.jpg"><img
                                src="front/assets/img/event-gallery/event-gallery-3.jpg" class="img-fluid"
                                alt=""></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="front/assets/img/event-gallery/event-gallery-4.jpg"><img
                                src="front/assets/img/event-gallery/event-gallery-4.jpg" class="img-fluid"
                                alt=""></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="front/assets/img/event-gallery/event-gallery-5.jpg"><img
                                src="front/assets/img/event-gallery/event-gallery-5.jpg" class="img-fluid"
                                alt=""></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="front/assets/img/event-gallery/event-gallery-6.jpg"><img
                                src="front/assets/img/event-gallery/event-gallery-6.jpg" class="img-fluid"
                                alt=""></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="front/assets/img/event-gallery/event-gallery-7.jpg"><img
                                src="front/assets/img/event-gallery/event-gallery-7.jpg" class="img-fluid"
                                alt=""></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="front/assets/img/event-gallery/event-gallery-8.jpg"><img
                                src="front/assets/img/event-gallery/event-gallery-8.jpg" class="img-fluid"
                                alt=""></a></div>
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>

    </section><!-- /Gallery Section -->

    <!-- Sponsors Section -->
    <section id="sponsors" class="sponsors section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Sponsors</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row g-0 clients-wrap">

                <div class="col-xl-3 col-md-4 client-logo">
                    <img src="front/assets/img/clients/client-1.png" class="img-fluid" alt="">
                </div><!-- End Client Item -->

                <div class="col-xl-3 col-md-4 client-logo">
                    <img src="front/assets/img/clients/client-2.png" class="img-fluid" alt="">
                </div><!-- End Client Item -->

                <div class="col-xl-3 col-md-4 client-logo">
                    <img src="front/assets/img/clients/client-3.png" class="img-fluid" alt="">
                </div><!-- End Client Item -->

                <div class="col-xl-3 col-md-4 client-logo">
                    <img src="front/assets/img/clients/client-4.png" class="img-fluid" alt="">
                </div><!-- End Client Item -->

                <div class="col-xl-3 col-md-4 client-logo">
                    <img src="front/assets/img/clients/client-5.png" class="img-fluid" alt="">
                </div><!-- End Client Item -->

                <div class="col-xl-3 col-md-4 client-logo">
                    <img src="front/assets/img/clients/client-6.png" class="img-fluid" alt="">
                </div><!-- End Client Item -->

                <div class="col-xl-3 col-md-4 client-logo">
                    <img src="front/assets/img/clients/client-7.png" class="img-fluid" alt="">
                </div><!-- End Client Item -->

                <div class="col-xl-3 col-md-4 client-logo">
                    <img src="front/assets/img/clients/client-8.png" class="img-fluid" alt="">
                </div><!-- End Client Item -->

            </div>

        </div>

    </section><!-- /Sponsors Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Frequently Asked Questions</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

                    <div class="faq-container">

                        <div class="faq-item faq-active">
                            <h3>Non consectetur a erat nam at lectus urna duis?</h3>
                            <div class="faq-content">
                                <p>Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus
                                    laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor
                                    rhoncus dolor purus non.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>Feugiat scelerisque varius morbi enim nunc faucibus?</h3>
                            <div class="faq-content">
                                <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id
                                    interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus
                                    scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim.
                                    Mauris ultrices eros in cursus turpis massa tincidunt dui.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>Dolor sit amet consectetur adipiscing elit pellentesque?</h3>
                            <div class="faq-content">
                                <p>Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci.
                                    Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl
                                    suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis
                                    convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                                </p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?</h3>
                            <div class="faq-content">
                                <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id
                                    interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus
                                    scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim.
                                    Mauris ultrices eros in cursus turpis massa tincidunt dui.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>Tempus quam pellentesque nec nam aliquam sem et tortor?</h3>
                            <div class="faq-content">
                                <p>Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse
                                    in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl
                                    suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in
                                </p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>Perspiciatis quod quo quos nulla quo illum ullam?</h3>
                            <div class="faq-content">
                                <p>Enim ea facilis quaerat voluptas quidem et dolorem. Quis et consequatur non sed
                                    in suscipit sequi. Distinctio ipsam dolore et.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                    </div>

                </div><!-- End Faq Column-->

            </div>

        </div>

    </section><!-- /Faq Section -->

    <!-- Buy Tickets Section -->
    <section id="buy-tickets" class="buy-tickets section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Buy Tickets<br></h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4 pricing-item" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-3 d-flex align-items-center justify-content-center">
                    <h3>Standard Access</h3>
                </div>
                <div class="col-lg-3 d-flex align-items-center justify-content-center">
                    <h4><sup>$</sup>150<span> / month</span></h4>
                </div>
                <div class="col-lg-3 d-flex align-items-center justify-content-center">
                    <ul>
                        <li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
                        <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
                        <li class="na"><i class="bi bi-x"></i> <span>Pharetra massa massa ultricies</span>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 d-flex align-items-center justify-content-center">
                    <div class="text-center"><a href="#" class="buy-btn">Buy Now</a></div>
                </div>
            </div><!-- End Pricing Item -->

            <div class="row gy-4 pricing-item featured mt-4" data-aos="fade-up" data-aos-delay="200">
                <div class="col-lg-3 d-flex align-items-center justify-content-center">
                    <h3>Premium Access<br></h3>
                </div>
                <div class="col-lg-3 d-flex align-items-center justify-content-center">
                    <h4><sup>$</sup>250<span> / month</span></h4>
                </div>
                <div class="col-lg-3 d-flex align-items-center justify-content-center">
                    <ul>
                        <li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
                        <li><i class="bi bi-check"></i> <strong>Nec feugiat nisl pretium</strong></li>
                        <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
                    </ul>
                </div>
                <div class="col-lg-3 d-flex align-items-center justify-content-center">
                    <div class="text-center"><a href="#" class="buy-btn">Buy Now</a></div>
                </div>
            </div><!-- End Pricing Item -->

            <div class="row gy-4 pricing-item mt-4" data-aos="fade-up" data-aos-delay="300">
                <div class="col-lg-3 d-flex align-items-center justify-content-center">
                    <h3>Pro Access<br></h3>
                </div>
                <div class="col-lg-3 d-flex align-items-center justify-content-center">
                    <h4><sup>$</sup>350<span> / month</span></h4>
                </div>
                <div class="col-lg-3 d-flex align-items-center justify-content-center">
                    <ul>
                        <li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
                        <li><i class="bi bi-check"></i> <span>Nec feugiat nisl pretium</span></li>
                        <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
                    </ul>
                </div>
                <div class="col-lg-3 d-flex align-items-center justify-content-center">
                    <div class="text-center"><a href="#" class="buy-btn">Buy Now</a></div>
                </div>
            </div><!-- End Pricing Item -->

        </div>

    </section><!-- /Buy Tickets Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Contact</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-6">
                    <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up"
                        data-aos-delay="200">
                        <i class="bi bi-geo-alt"></i>
                        <h3>Address</h3>
                        <p>A108 Adam Street, New York, NY 535022</p>
                    </div>
                </div><!-- End Info Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up"
                        data-aos-delay="300">
                        <i class="bi bi-telephone"></i>
                        <h3>Call Us</h3>
                        <p>+1 5589 55488 55</p>
                    </div>
                </div><!-- End Info Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up"
                        data-aos-delay="400">
                        <i class="bi bi-envelope"></i>
                        <h3>Email Us</h3>
                        <p>info@example.com</p>
                    </div>
                </div><!-- End Info Item -->

            </div>

            <div class="row gy-4 mt-1">
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus"
                        frameborder="0" style="border:0; width: 100%; height: 400px;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div><!-- End Google Maps -->

                <div class="col-lg-6">
                    <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up"
                        data-aos-delay="400">
                        <div class="row gy-4">

                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Your Name"
                                    required="">
                            </div>

                            <div class="col-md-6 ">
                                <input type="email" class="form-control" name="email" placeholder="Your Email"
                                    required="">
                            </div>

                            <div class="col-md-12">
                                <input type="text" class="form-control" name="subject" placeholder="Subject"
                                    required="">
                            </div>

                            <div class="col-md-12">
                                <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                            </div>

                            <div class="col-md-12 text-center">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>

                                <button type="submit">Send Message</button>
                            </div>

                        </div>
                    </form>
                </div><!-- End Contact Form -->

            </div>

        </div>

    </section><!-- /Contact Section -->

    {{-- Modal Pengajuan --}}
    <div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Daftar Pengajuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12 mb-4">
                        <div class="bs-stepper wizard-numbered mt-2">
                            <div class="bs-stepper-header">
                                <div class="step" data-target="#account-details">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title">Detail Pemohon</span>
                                            <span class="bs-stepper-subtitle">Masukkan data diri</span>
                                        </span>
                                    </button>
                                </div>
                                <div class="line">
                                    <i class="ti ti-chevron-right"></i>
                                </div>
                                <div class="step" data-target="#personal-info">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title">Detail Sekolah/Universitas</span>
                                            <span class="bs-stepper-subtitle">Masukkan data pendidikan</span>
                                        </span>
                                    </button>
                                </div>
                                <div class="line">
                                    <i class="ti ti-chevron-right"></i>
                                </div>
                                <div class="step" data-target="#social-links">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title">File Permohonan</span>
                                            <span class="bs-stepper-subtitle">Masukkan surat permohonan</span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div class="bs-stepper-content">
                                <form action="{{ route('landing-page.daftar') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <!-- Account Details -->
                                    <div id="account-details" class="content">
                                        <div class="content-header mb-3">
                                            <h6 class="mb-0">Detail Pemohon</h6>
                                            <small>Masukkan data diri</small>
                                        </div>
                                        <div class="row g-3">
                                            <div>
                                                <label class="form-label">Jenis Kegiatan</label>
                                                <select name="jenis_kegiatan" id="jenis_kegiatan" class="form-select"
                                                    required @error('jenis_kegiatan') is-invalid @enderror>
                                                    <option value="Riset">Penelitian/Riset</option>
                                                    <option value="KKP">Kuliah Kerja Praktik</option>
                                                    <option value="Prakerin">Praktik Kerja Industri</option>
                                                </select>
                                                @error('jenis_kegiatan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="nama">Nama Lengkap</label>
                                                <input type="text" id="nama" class="form-control"
                                                    placeholder="johndoe" required name="nama_pemohon" required
                                                    @error('nama_pemohon') is-invalid @enderror>
                                                @error('nama_pemohon')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="email" id="email" class="form-control"
                                                    placeholder="john.doe@email.com" aria-label="john.doe"
                                                    name="email_pemohon" required
                                                    @error('email_pemohon') is-invalid @enderror>
                                                @error('email_pemohon')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="no_telp_pemohon">Telepon</label>
                                                <input type="number" id="no_telp_pemohon" class="form-control"
                                                    placeholder="08xxxxxxxxx" aria-label="john.doe"
                                                    name="no_telp_pemohon" required
                                                    @error('no_telp_pemohon') is-invalid
                                                    @enderror>
                                                @error('no_telp_pemohon')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select"
                                                    required @error('jenis_kelamin') is-invalid @enderror>
                                                    <option value="L">Laki-Laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                                @error('jenis_kelamin')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                                                <input type="date" id="tanggal_lahir" class="form-control"
                                                    placeholder="YYYY/MM/DD" name="tanggal_lahir" required
                                                    @error('tanggal_lahir') is-invalid @enderror>
                                                @error('tanggal_lahir')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-12 d-flex justify-content-between">
                                                <button type="button" class="btn btn-label-secondary btn-prev" disabled>
                                                    <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                </button>
                                                <button type="button" class="btn btn-primary btn-next">
                                                    <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                                    <i class="ti ti-arrow-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Personal Info -->
                                    <div id="personal-info" class="content">
                                        <div class="content-header mb-3">
                                            <h6 class="mb-0">Detail Sekolah/Universitas</h6>
                                            <small>Masukkan data pendidikan</small>
                                        </div>
                                        <div class="kuliah">
                                            <div class="row g-3">
                                                <div>
                                                    <label class="form-label" for="nim">NIM</label>
                                                    <input type="number" id="nim" class="form-control"
                                                        placeholder="212xxxxxxxxx" required name="nim"
                                                        @error('nim') is-invalid @enderror />
                                                    @error('nim')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label" for="universitas">Universitas</label>
                                                    <input type="text" id="universitas" class="form-control"
                                                        name="universitas" placeholder="UNIVERSITAS SWISS" required
                                                        @error('universitas') is-invalid @enderror />
                                                    @error('universitas')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label" for="fakultas">Fakultas</label>
                                                    <input type="text" id="fakultas" class="form-control"
                                                        name="fakultas" placeholder="ILMU BUDAYA" required
                                                        @error('fakultas') is-invalid @enderror />
                                                    @error('fakultas')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label" for="prodi">Program Studi</label>
                                                    <input type="text" id="prodi" class="form-control"
                                                        name="prodi" placeholder="SASTRA MESIN" required
                                                        @error('prodi') is-invalid @enderror />
                                                    @error('prodi')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label" for="semester">Semester</label>
                                                    <input type="number" id="semester" class="form-control"
                                                        name="semester" placeholder="5" required />
                                                </div>
                                                <div class="col-12 d-flex justify-content-between">
                                                    <button type="button" class="btn btn-label-secondary btn-prev">
                                                        <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                    </button>
                                                    <button type="button" class="btn btn-primary btn-next">
                                                        <span
                                                            class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                                        <i class="ti ti-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sekolah">
                                            <div class="row g-3">
                                                <div>
                                                    <label class="form-label" for="nis">NIS</label>
                                                    <input type="number" id="nis" class="form-control"
                                                        placeholder="212xxxxxxxxx" required name="nis"
                                                        @error('nis') is-invalid
                                                        @enderror />

                                                    @error('nis')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label" for="sekolah">Sekolah</label>
                                                    <input type="text" id="sekolah" class="form-control"
                                                        name="sekolah" placeholder="SMK 17" required
                                                        @error('sekolah') is-invalid @enderror />
                                                    @error('sekolah')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label" for="kelas">Kelas</label>
                                                    <input type="number" id="kelas" class="form-control"
                                                        name="kelas" placeholder="10" required
                                                        @error('kelas') is-invalid @enderror />

                                                    @error('kelas')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 d-flex justify-content-between">
                                                    <button class="btn btn-label-secondary btn-prev">
                                                        <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                    </button>
                                                    <button type="button" class="btn btn-primary btn-next">
                                                        <span
                                                            class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                                        <i class="ti ti-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Social Links -->
                                    <div id="social-links" class="content">
                                        <div class="content-header mb-3">
                                            <h6 class="mb-0">File Permohonan</h6>
                                            <small>Masukkan data permohonan</small>
                                        </div>
                                        <div class="row g-3">
                                            <div>
                                                <label class="form-label" for="nama_kegiatan">Nama Kegiatan</label>
                                                <input type="text" id="nama_kegiatan" class="form-control" required
                                                    name="nama_kegiatan" placeholder="Masukkan nama kegiatan" required
                                                    @error('nama_kegiatan') is-invalid @enderror />
                                                @error('nama_kegiatan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="tanggal_mulai">Tanggal Mulai</label>
                                                <input type="date" id="tanggal_mulai" class="form-control"
                                                    placeholder="YYYY-MM-DD" name="tanggal_mulai" required
                                                    @error('tanggal_mulai') is-invalid @enderror />
                                                @error('tanggal_mulai')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="tanggal_selesai">Tanggal
                                                    Selesai</label>
                                                <input type="date" id="tanggal_selesai" class="form-control"
                                                    placeholder="YYYY-MM-DD" name="tanggal_selesai" required
                                                    @error('tanggal_selesai') is-invalid @enderror />
                                                @error('tanggal_selesai')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div>
                                                <label class="form-label" for="surat_permohonan">Upload Surat
                                                    Permohonan:
                                                    (.pdf)</label>
                                                <input type="file" id="surat_permohonan" class="form-control" required
                                                    name="surat_permohonan"
                                                    @error('surat_permohonan') is-invalid
                                                    @enderror />
                                                @error('surat_permohonan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-12 d-flex justify-content-between">
                                                <button type="button" class="btn btn-label-secondary btn-prev">
                                                    <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                </button>
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
            });
        </script>
    @elseif($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Periksa kembali data yang anda masukkan',
            });
        </script>
    @elseif(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
            });
        </script>
    @endif
    <script>
        $('.sekolah').hide();
        $('input[name="nis"]').prop('required', false);
        $('input[name="kelas"]').prop('required', false);
        $('input[name="sekolah"]').prop('required', false);
        $('select[name="jenis_kegiatan"]').on('change', function() {
            if ($(this).val() == 'Riset' || $(this).val() == 'KKP') {
                $('.kuliah').show();
                $('.sekolah').hide();
                // disable input sekolah
                $('input[name="sekolah"]').prop('disabled', true);
                $('input[name="sekolah"]').prop('required', false);
                $('input[name="kelas"]').prop('disabled', true);
                $('input[name="kelas"]').prop('required', false);
                $('input[name="nis"]').prop('disabled', true);
                $('input[name="nis"]').prop('required', false);
            } else {
                $('.kuliah').hide();
                $('.sekolah').show();
                // disable input kuliah
                $('input[name="nim"]').prop('disabled', true);
                $('input[name="nim"]').prop('required', false);
                $('input[name="universitas"]').prop('disabled', true);
                $('input[name="universitas"]').prop('required', false);
                $('input[name="fakultas"]').prop('disabled', true);
                $('input[name="fakultas"]').prop('required', false);
                $('input[name="prodi"]').prop('disabled', true);
                $('input[name="prodi"]').prop('required', false);
                $('input[name="semester"]').prop('disabled', true);
                $('input[name="semester"]').prop('required', false);
            }
        });

        // capitalize universitas, fakultas, prodi, sekolah, nama kegiatan
        $('input[name="universitas"]').on('keyup', function() {
            $(this).val($(this).val().toUpperCase());
        });
        $('input[name="fakultas"]').on('keyup', function() {
            $(this).val($(this).val().toUpperCase());
        });
        $('input[name="prodi"]').on('keyup', function() {
            $(this).val($(this).val().toUpperCase());
        });
        $('input[name="sekolah"]').on('keyup', function() {
            $(this).val($(this).val().toUpperCase());
        });
        $('input[name="nama_kegiatan"]').on('keyup', function() {
            $(this).val($(this).val().toUpperCase());
        });
    </script>
@endpush
