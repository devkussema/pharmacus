@extends('korona.layout')

@section('content')
    <!--Main Slider-->
    <section class="main-slider">

        <div class="main-slider-carousel owl-carousel owl-theme">

            <div class="slide"
                style="background-image:url({{ asset('landingpage/images/main-slider/content-image-3.png') }})">
                <div class="auto-container">
                    <div class="clearfix">
                        <div class="content">
                            <h2>Medidas básicas de <br>proteção contra o <br> surto de cólera em Angola</h2>
                            <div class="text">Lave regularmente e cuidadosamente as mãos com água potável e sabão, ou
                                utilize uma solução de álcool em gel quando possível. Evite o consumo de alimentos crus ou
                                água não tratada.</div>
                            <div class="link-box">
                                <a href="#" class="theme-btn btn-style-two"><span class="txt">Encontre um
                                        Médico</span></a>
                                <a href="#" class="theme-btn btn-style-three"><span class="txt">Saiba
                                        mais</span></a>
                            </div>
                        </div>
                        <div class="image-box">
                            <div class="image">
                                <img src="{{ asset('landingpage/images/main-slider/content-image.png') }}"
                                    alt="Prevenção da Cólera" title="Prevenção da Cólera">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slide"
                style="background-image:url({{ asset('landingpage/images/main-slider/content-image-3.png') }})">
                <div class="auto-container">
                    <div class="clearfix">
                        <div class="content">
                            <h2>Como prevenir o <br> surto de cólera</h2>
                            <div class="text">Evite o contato direto com fezes ou água contaminada e procure um centro de
                                saúde ao primeiro sinal de diarreia ou vômitos intensos.</div>
                            <div class="link-box">
                                <a href="#" class="theme-btn btn-style-two"><span class="txt">Encontre um
                                        Médico</span></a>
                                <a href="#" class="theme-btn btn-style-three"><span class="txt">Saiba
                                        mais</span></a>
                            </div>
                        </div>
                        <div class="image-box">
                            <div class="image">
                                <img src="{{ asset('landingpage/images/main-slider/content-image-2.png') }}"
                                    alt="Prevenção da Cólera" title="Prevenção da Cólera">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Main Slider-->

    <!--Features Section One-->
    <section class="features-section-one">
        <div class="auto-container">
            <!--Sec Title-->
            <div class="sec-title centered">
                <div class="title-icon">
                    <span class="icon"><img src="{{ asset('landingpage/images/icons/separater.png') }}"
                            alt="Ícone Separador" /></span>
                </div>
                <h2>Contágio da Cólera</h2>
                <div class="text">A cólera é altamente contagiosa e pode se espalhar rapidamente em condições de
                    saneamento precário. Saiba mais sobre as principais formas de transmissão e como se proteger.</div>
            </div>
            <div class="row clearfix">
                <!-- Feature Block One -->
                <div class="feature-block-one col-lg-4">
                    <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="content">
                            <div class="icon-box">
                                <span class="icon"><img src="{{ asset('landingpage/images/icons/1.png') }}"
                                        alt="Contato Humano" /></span>
                            </div>
                            <h3><a href="#">Contato Humano</a></h3>
                            <div class="text">O contato direto com pessoas infectadas ou com fezes contaminadas pode
                                transmitir a bactéria da cólera.</div>
                        </div>
                    </div>
                </div>

                <!-- Feature Block One -->
                <div class="feature-block-one col-lg-4">
                    <div class="inner-box wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="content">
                            <div class="icon-box">
                                <span class="icon"><img src="{{ asset('landingpage/images/icons/2.png') }}"
                                        alt="Água Contaminada" /></span>
                            </div>
                            <h3><a href="#">Água Contaminada</a></h3>
                            <div class="text">A cólera é frequentemente transmitida pelo consumo de água não tratada ou
                                contaminada por fezes humanas.</div>
                        </div>
                    </div>
                </div>

                <!-- Feature Block One -->
                <div class="feature-block-one col-lg-4">
                    <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="content">
                            <div class="icon-box">
                                <span class="icon"><img src="{{ asset('landingpage/images/icons/3.png') }}"
                                        alt="Alimentos Contaminados" /></span>
                            </div>
                            <h3><a href="#">Alimentos Contaminados</a></h3>
                            <div class="text">O consumo de alimentos mal cozidos ou preparados em condições insalubres
                                pode ser uma fonte de infecção.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Features Section-->

    <!--Symptoms Section-->
    <section class="symptoms-section">
        <div class="auto-container">
            <div class="row clearfix">
                <!--Content Column-->
                <div class="content-column col-lg-7 col-md-12 col-sm-12 order-lg-2">
                    <div class="inner-column wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <!--Sec Title-->
                        <div class="sec-title">
                            <div class="title-icon">
                                <span class="icon"><img src="{{ asset('landingpage/images/icons/separater.png') }}" alt="Ícone separador" /></span>
                            </div>
                            <div class="title">Sobre a Cólera</div>
                            <h2>Sintomas da Cólera</h2>
                        </div>
                        <div class="text">
                            <p>A cólera é uma infecção bacteriana grave que pode levar à desidratação extrema e até mesmo à
                                morte se não tratada rapidamente. É causada pela ingestão de alimentos ou água contaminados
                                pela bactéria <i>Vibrio cholerae</i>.</p>
                        </div>
                        <ul class="list-style-two mb-4">
                            <li>Diarreia intensa e aquosa</li>
                            <li>Vômitos</li>
                            <li>Sede extrema</li>
                            <li>Cãibras musculares</li>
                            <li>Fadiga</li>
                            <li>Desidratação severa</li>
                        </ul>
                        <a href="about.html" class="theme-btn btn-style-three"><span class="txt">Saiba mais</span></a>
                    </div>
                </div>

                <!--Image Column-->
                <div class="image-column col-lg-5 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="image">
                            <a href="{{ asset('landingpage/images/resource/image-2.png') }}" data-fancybox="rule" data-caption=""><img
                                    src="{{ asset('landingpage/images/resource/image-2.png') }}" alt="Imagem ilustrativa sobre a cólera" /></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Section-->

    <!--Features Section Two-->
    <section class="features-section-two">
        <div class="outer-container">
            <div class="clearfix">
                <!--Content Column-->
                <div class="content-column">
                    <div class="inner-column">
                        <!--Sec Title-->
                        <div class="sec-title">
                            <div class="title-icon">
                                <span class="icon"><img src="{{ asset('landingpage/images/icons/separater.png') }}" alt="Ícone separador" /></span>
                            </div>
                            <div class="title">Como nos proteger e proteger os outros</div>
                            <h2>Mantenha-se informado e siga os conselhos do seu profissional de saúde</h2>
                        </div>
                        <div class="text">
                            <p>A cólera é uma doença grave transmitida por alimentos e água contaminados. A prevenção é essencial para proteger a si mesmo e sua comunidade.</p>
                            <p>Adote medidas de higiene e fique atento aos sintomas. A informação correta é uma ferramenta poderosa no combate ao surto.</p>
                        </div>
                        <!-- List Style One -->
                        <ul class="list-style-two">
                            <li>Compartilhe informações verificadas para evitar alarmismo</li>
                            <li>Mostre solidariedade com as pessoas afetadas</li>
                            <li>Divulgue histórias de pessoas que superaram a doença</li>
                        </ul>
                    </div>
                </div>

                <!--Image Column-->
                <div class="image-column wow fadeInRight">
                    <div class="inner-column clearfix">
                        <div class="big-image">
                            <img src="{{ asset('landingpage/images/resource/image-1.png') }}" alt="Imagem ilustrativa sobre proteção contra a cólera" />
                            <div class="small-image">
                                <img src="{{ asset('landingpage/images/resource/image-5.png') }}" alt="Imagem ilustrativa de prevenção" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Seo Section-->

    <!--Features Section Four-->
    <section class="features-section-four">
        <div class="auto-container">
            <!--Sec Title-->
            <div class="sec-title centered">
                <div class="title-icon">
                    <span class="icon"><img src="{{ asset('landingpage/images/icons/separater.png') }}" alt="Ícone separador" /></span>
                </div>
                <h2>Prevenção Contra a Cólera</h2>
                <div class="text">
                    A cólera é uma doença perigosa, mas pode ser evitada com medidas simples de higiene e cuidados com a água e alimentos. Siga as orientações para proteger a si mesmo e sua comunidade.
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-6">
                    <ul class="accordion-box mb-30">
                        <!--Accordion Block-->
                        <li class="accordion block">
                            <div class="acc-btn">
                                <div class="icon-outer"><span class="icon icon_plus fa fa-angle-right"></span> <span
                                        class="icon icon_minus fa fa-angle-down"></span></div>O que é a cólera?
                            </div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">A cólera é uma infecção bacteriana causada pela ingestão de água ou alimentos contaminados pelo Vibrio cholerae, que pode levar à desidratação grave e até à morte se não tratada.</div>
                                </div>
                            </div>
                        </li>
                        <!--Accordion Block-->
                        <li class="accordion block">
                            <div class="acc-btn">
                                <div class="icon-outer"><span class="icon icon_plus fa fa-angle-right"></span> <span
                                        class="icon icon_minus fa fa-angle-down"></span></div>Como a cólera é transmitida?
                            </div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">A cólera é transmitida pela ingestão de água ou alimentos contaminados com fezes de pessoas infectadas. Condições de saneamento inadequado aumentam o risco.</div>
                                </div>
                            </div>
                        </li>
                        <!--Accordion Block-->
                        <li class="accordion block">
                            <div class="acc-btn">
                                <div class="icon-outer"><span class="icon icon_plus fa fa-angle-right"></span> <span
                                        class="icon icon_minus fa fa-angle-down"></span></div>Quais são os sintomas da cólera?
                            </div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">Os sintomas incluem diarreia aquosa severa, vômitos e cãibras musculares, que podem levar à desidratação rápida. Procure ajuda médica imediatamente ao notar esses sintomas.</div>
                                </div>
                            </div>
                        </li>
                        <!--Accordion Block-->
                        <li class="accordion block">
                            <div class="acc-btn">
                                <div class="icon-outer"><span class="icon icon_plus fa fa-angle-right"></span> <span
                                        class="icon icon_minus fa fa-angle-down"></span></div>O que fazer se eu desenvolver sintomas?
                            </div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">Procure imediatamente um centro de saúde. A reidratação oral e intravenosa é essencial para evitar complicações graves.</div>
                                </div>
                            </div>
                        </li>
                        <!--Accordion Block-->
                        <li class="accordion block">
                            <div class="acc-btn">
                                <div class="icon-outer"><span class="icon icon_plus fa fa-angle-right"></span> <span
                                        class="icon icon_minus fa fa-angle-down"></span></div>Como prevenir a cólera?
                            </div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">Beba somente água tratada, cozinhe bem os alimentos, lave as mãos com sabão frequentemente e evite contato com áreas contaminadas.</div>
                                </div>
                            </div>
                        </li>
                        <!-- End Block -->
                    </ul>
                </div>
                <div class="col-lg-6">
                    <!-- Services Block Four -->
                    <div class="feature-block-four">
                        <div class="inner-box wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="content">
                                <div class="icon-box">
                                    <span class="icon"><img src="{{ asset('landingpage/images/icons/4.png') }}" alt="Lavar as mãos" /></span>
                                </div>
                                <h3><a href="#">Lavar as Mãos</a></h3>
                                <div class="text">Lave as mãos com água limpa e sabão frequentemente, especialmente antes de comer e após usar o banheiro.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Services Block Four -->
                    <div class="feature-block-four">
                        <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="content">
                                <div class="icon-box">
                                    <span class="icon"><img src="{{ asset('landingpage/images/icons/5.png') }}" alt="Tratar água" /></span>
                                </div>
                                <h3><a href="#">Tratar a Água</a></h3>
                                <div class="text">Beba somente água tratada ou fervida. Armazene a água potável em recipientes limpos e bem fechados.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Services Block Four -->
                    <div class="feature-block-four">
                        <div class="inner-box wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="content">
                                <div class="icon-box">
                                    <span class="icon"><img src="{{ asset('landingpage/images/icons/6.png') }}" alt="Higienizar alimentos" /></span>
                                </div>
                                <h3><a href="#">Higienizar Alimentos</a></h3>
                                <div class="text">Lave bem os alimentos com água limpa antes de consumir e cozinhe-os completamente.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Features Section-->

    <!-- Live Map Section -->
    <section class="live-map-section">
        <div class="auto-container">
            <!--Sec Title-->
            <div class="sec-title centered">
                <h4>Área de Saúde</h4>
                <h2>Mapa ao Vivo da Cólera em Angola</h2>
                <div class="text">
                    Informações atualizadas sobre os casos de cólera em Angola e suas províncias.
                    Fique atento às áreas afetadas e medidas preventivas.
                </div>
            </div>
            <iframe
                class="maps"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13826226.300668046!2d11.497763647949217!3d-11.202692520645334!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1bb074f327ae8d3f%3A0xdb2bc601b2b04c3!2sAngola!5e0!3m2!1spt-BR!2s!4v1697382477394!5m2!1spt-BR!2s"
                width="100%"
                height="450"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>

    <!--Team Section-->
    {{-- <section class="team-section">
        <div class="auto-container">
            <!--Sec Title-->
            <div class="sec-title centered">
                <div class="title-icon">
                    <span class="icon"><img src="images/icons/separater.png" alt="" /></span>
                </div>
                <h2>Coronavirus Specialist</h2>
                <div class="text">Consequatur molestiae, eligendi molestias ratione voluptas aliquid praesentium, dolorem
                    doloribus, deleniti <br>officia numquam optio sunt eveniet consequuntur laboriosam at non ullam
                    provident</div>
            </div>

            <div class="row clearfix">

                <!--Team Block-->
                <div class="team-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="image">
                            <a href="team.html"><img src="images/resource/team-1.jpg" alt="" title=""></a>
                        </div>
                        <div class="lower-content">
                            <h3><a href="team.html">Peter Thomas</a></h3>
                            <div class="designation">Seneor Consultant</div>
                            <ul class="social-box">
                                <li><a href="#" class="fa fa-twitter"></a></li>
                                <li><a href="#" class="fa fa-facebook"></a></li>
                                <li><a href="#" class="fa fa-google-plus"></a></li>
                                <li><a href="#" class="fa fa-envelope"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!--Team Block-->
                <div class="team-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="image">
                            <a href="team.html"><img src="images/resource/team-2.jpg" alt="" title=""></a>
                        </div>
                        <div class="lower-content">
                            <h3><a href="team.html">Elizabeth Nelson</a></h3>
                            <div class="designation">Senior Virus Expert</div>
                            <ul class="social-box">
                                <li><a href="#" class="fa fa-twitter"></a></li>
                                <li><a href="#" class="fa fa-facebook"></a></li>
                                <li><a href="#" class="fa fa-google-plus"></a></li>
                                <li><a href="#" class="fa fa-envelope"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!--Team Block-->
                <div class="team-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInUp" data-wow-delay="900ms" data-wow-duration="1500ms">
                        <div class="image">
                            <a href="team.html"><img src="images/resource/team-3.jpg" alt="" title=""></a>
                        </div>
                        <div class="lower-content">
                            <h3><a href="team.html">Richard Smith</a></h3>
                            <div class="designation">Seneor Consultant</div>
                            <ul class="social-box">
                                <li><a href="#" class="fa fa-twitter"></a></li>
                                <li><a href="#" class="fa fa-facebook"></a></li>
                                <li><a href="#" class="fa fa-google-plus"></a></li>
                                <li><a href="#" class="fa fa-envelope"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section> --}}
    <!--End Team Section-->

    <!--Features Section Five-->
    <section class="features-section-five">
        <!--Title Box-->
        <div class="title-box" style="background-image: url('{{ asset('landingpage/images/background/2.jpg') }}');">
            <div class="auto-container">
                <h2>Como a Cólera se Espalha Rápido</h2>
                <div class="text">A cólera é uma infecção bacteriana que se espalha rapidamente por meio de água e alimentos contaminados. Conheça os principais modos de transmissão e como se proteger.</div>
            </div>
        </div>

        <div class="auto-container">
            <div class="inner-container">
                <div class="row clearfix">

                    <!--Feature Block Five-->
                    <div class="feature-block-five col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="icon-box">
                                <img src="{{ asset('landingpage/images/icons/7.png') }}" alt="Água Contaminada" title="Água Contaminada">
                            </div>
                            <h3><a href="#">Consumo de Água Contaminada</a></h3>
                            <div class="text">A bactéria da cólera geralmente está presente em fontes de água não tratadas, como poços e rios.</div>
                        </div>
                    </div>

                    <!--Feature Block Five-->
                    <div class="feature-block-five col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <div class="icon-box">
                                <img src="{{ asset('landingpage/images/icons/9.png') }}" alt="Comida Contaminada" title="Comida Contaminada">
                            </div>
                            <h3><a href="#">Consumo de Alimentos Contaminados</a></h3>
                            <div class="text">Alimentos lavados com água contaminada ou manuseados por pessoas infectadas podem espalhar a doença.</div>
                        </div>
                    </div>

                    <!--Feature Block Five-->
                    <div class="feature-block-five col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                            <div class="icon-box">
                                <img src="{{ asset('landingpage/images/icons/12.png') }}" alt="Higiene Precária" title="Higiene Precária">
                            </div>
                            <h3><a href="#">Má Higiene Pessoal</a></h3>
                            <div class="text">A falta de lavagem adequada das mãos após usar o banheiro ou antes de preparar alimentos pode espalhar a cólera.</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--End Features Section Five-->

    <!-- Hand Wash Process Section -->
	<section class="hand-wash-process-section">
		<div class="auto-container">
            <!--Sec Title-->
            <div class="sec-title centered">
                <div class="title-icon">
                    <span class="icon"><img src="{{ asset('landingpage/images/icons/separater.png') }}" alt="" /></span>
                </div>
                <h2>Prevenção da Cólera</h2>
                <div class="text">A cólera é uma doença infecciosa transmitida principalmente por água contaminada. A prevenção envolve cuidados com a higiene pessoal e o consumo de água potável segura. Aqui estão os passos essenciais para evitar a propagação dessa doença mortal.</div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 process-block">
                    <div class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="image"><img src="{{ asset('landingpage/images/resource/process-1.png') }}" alt="Lavar as mãos com sabão" /></div>
                        <h4>Lavar as Mãos com Sabão</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 process-block">
                    <div class="inner-box wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="image"><img src="{{ asset('landingpage/images/resource/process-2.png') }}" alt="Esfregar as palmas das mãos" /></div>
                        <h4>Esfregar as Palmas das Mãos</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 process-block">
                    <div class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="image"><img src="{{ asset('landingpage/images/resource/process-3.png') }}" alt="Lavar entre os dedos" /></div>
                        <h4>Lavar Entre os Dedos</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 process-block">
                    <div class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="image"><img src="{{ asset('landingpage/images/resource/process-4.png') }}" alt="Focar nos polegares" /></div>
                        <h4>Focar nos Polegares</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 process-block">
                    <div class="inner-box wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="image"><img src="{{ asset('landingpage/images/resource/process-5.png') }}" alt="Lavar as costas das mãos" /></div>
                        <h4>Lavar as Costas das Mãos</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 process-block">
                    <div class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="image"><img src="{{ asset('landingpage/images/resource/process-6.png') }}" alt="Focar nos pulsos" /></div>
                        <h4>Focar nos Pulsos</h4>
                    </div>
                </div>
            </div>
        </div>

	</section>

    <!--News Section-->
	<section class="news-section">
		<div class="auto-container">
            <!--Sec Title-->
            <div class="sec-title centered">
                <div class="title-icon">
                    <span class="icon"><img src="{{ asset('landingpage/images/icons/separater.png') }}" alt="" /></span>
                </div>
                <h2>Últimas Atualizações sobre Cólera</h2>
                <div class="text">Fique informado sobre os últimos desenvolvimentos relacionados à cólera. Saiba mais sobre as prevenções, tratamentos e medidas de controle da doença.</div>
            </div>
            <div class="row clearfix">

                <!--News Block-->
                <div class="news-block style-two col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1000ms">
                        <div class="image">
                            <a href="{{ route('lp.blog_single')}}"><img src="{{ asset('landingpage/images/resource/news-1.jpg') }}" alt="" /></a>
                        </div>
                        <div class="lower-content">
                            <ul class="post-meta">
                                <li>Jan 25, 2020</li>
                                <li>Por Admin</li>
                            </ul>
                            <h3><a href="{{ route('lp.blog_single')}}">Como Prevenir a Cólera</a></h3>
                            <div class="text">Descubra as melhores práticas para prevenir a cólera, como a higienização das mãos, o tratamento de água e a importância de manter as condições de saúde pública adequadas.</div>
                            <a href="{{ route('lp.blog_single')}}" class="read-more">Leia mais <span class="arrow flaticon-next-5"></span></a>
                        </div>
                    </div>
                </div>

                <!--News Block-->
                <div class="news-block style-two col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1000ms">
                        <div class="image">
                            <a href="{{ route('lp.blog_single')}}"><img src="{{ asset('landingpage/images/resource/news-2.jpg') }}" alt="" /></a>
                        </div>
                        <div class="lower-content">
                            <ul class="post-meta">
                                <li>Jan 9, 2020</li>
                                <li>Por Admin</li>
                            </ul>
                            <h3><a href="{{ route('lp.blog_single')}}">Sintomas e Tratamento da Cólera</a></h3>
                            <div class="text">Saiba como identificar os sintomas da cólera, como a diarreia intensa e a desidratação, e o que fazer para tratar a doença de forma eficaz.</div>
                            <a href="{{ route('lp.blog_single')}}" class="read-more">Leia mais <span class="arrow flaticon-next-5"></span></a>
                        </div>
                    </div>
                </div>

                <!--News Block-->
                <div class="news-block style-two col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1000ms">
                        <div class="image">
                            <a href="{{ route('lp.blog_single')}}"><img src="{{ asset('landingpage/images/resource/news-3.jpg') }}" alt="" /></a>
                        </div>
                        <div class="lower-content">
                            <ul class="post-meta">
                                <li>Jan 25, 2020</li>
                                <li>Por Admin</li>
                            </ul>
                            <h3><a href="{{ route('lp.blog_single')}}">Medidas de Prevenção da Cólera nas Comunidades</a></h3>
                            <div class="text">Como as comunidades podem se organizar para combater surtos de cólera, garantindo acesso à água potável e saneamento básico.</div>
                            <a href="{{ route('lp.blog_single')}}" class="read-more">Leia mais <span class="arrow flaticon-next-5"></span></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
	</section>
	<!--End News Section-->
@endsection
