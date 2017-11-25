@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40" id="milanko">
                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <h1>NARUDŽBINA</h1>
                    <!-- BEGIN CHECKOUT PAGE -->
                    <div class="panel-group checkout-page accordion scrollable" id="checkout-page">

                        <!-- BEGIN CHECKOUT -->
                        <div id="checkout" class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#checkout-page" href="#checkout-content" class="accordion-toggle">
                                        Korak 1: Opcije
                                    </a>
                                </h2>
                            </div>
                            <div id="checkout-content" class="panel-collapse collapse in">
                                <div class="panel-body row">
                                    <div class="col-md-6 col-sm-6">
                                        <h3>PRVI PUT KUPUJEM OVDE</h3>
                                        <p>Obaveštenje:</p>
                                        <p>Nakon prve kupovine, dobićete petocifreni kod koji ćete u budućnosti moći da koristite kako biste pregledali istoriju kupovine i iskoristili potencijalne popuste.</p>
                                        <button class="btn btn-primary" type="submit" data-toggle="collapse" data-parent="#checkout-page" data-target="#payment-address-content">Nastavite</button>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <h3>VEĆ SAM BLACK SHEEP KORISNIK</h3>
                                        <p>Unesite kod dobijen pri prethodnoj kupovini:</p>
                                            <div class="form-group">
                                                <input type="text" id="token" class="form-control">
                                            </div>
                                            <button class="btn btn-primary" data-toggle="collapse" onclick="userByToken()"  >Potvrdi</button>
                                                <div id="tokenFeedbackError" style="margin-top:15px;" class="alert alert-warning hidden ">Korisnik nije pronadjen.</div>
                                        <div id="tokenFeedbackSuccess" style="margin-top:15px;" class="alert alert-info hidden ">

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- END CHECKOUT -->

                        <!-- BEGIN PAYMENT ADDRESS -->
                        <div id="payment-address" class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#checkout-page" href="#payment-address-content" class="accordion-toggle">
                                        Korak 2: Detalji za isporuku
                                    </a>
                                </h2>
                            </div>
                                @component('components.delivery_details')@endcomponent

                        </div>
                        <!-- END PAYMENT ADDRESS -->


                        <!-- BEGIN CONFIRM -->
                        <div id="confirm" class="panel panel-default hidden">
                            <div class="panel-heading">
                                <h2 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#checkout-page" href="#confirm-content" class="accordion-toggle">
                                        Korak 3: Potvrdi narudžbinu
                                    </a>
                                </h2>
                            </div>
                            <div id="confirm-content" class="panel-collapse collapse ">
                                <div class="panel-body row">
                                    <div class="col-md-12 clearfix">
                                        <div class="table-wrapper-responsive">
                                            <?php
                                            $data = [
                                                'article'=> [
                                                    [
                                                        'imgPath' => 'assets/pages/img/products/model3.jpg',
                                                        'name' => 'name test',
                                                        'color' => 'color test',
                                                        'description' => 'desc test',
                                                        'code' => 'code test',
                                                        'quantity' => '3',
                                                        'pricePerArticle' => '500',
                                                        'totalPrice' => '1500'
                                                    ],
                                                    [
                                                        'imgPath' => 'assets/pages/img/products/model3.jpg',
                                                        'name' => 'name test',
                                                        'color' => 'color test',
                                                        'description' => 'desc test',
                                                        'code' => 'code test',
                                                        'quantity' => '2',
                                                        'pricePerArticle' => '200',
                                                        'totalPrice' => '400'
                                                    ]

                                                ],
                                                'info'=>
                                                    [
                                                        'cost' => '2222',
                                                        'deliveryCost' => '555',
                                                        'totalCost' => '2777'
                                                    ]
                                            ]
                                            ?>
                                            @component('components.cart_article', $data)@endcomponent
                                        </div>


                                        <div class="clearfix"></div>
                                        <button class="btn btn-primary pull-right" type="submit" onclick="placeAnOrder()" id="button-confirm">Naruči</button>
                                        <button type="button" class="btn btn-default pull-right margin-right-20">Odustani</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END CONFIRM -->
                    </div>
                    <!-- END CHECKOUT PAGE -->
                    <div id="orderFeedback">

                    </div>
                </div>
                <!-- END CONTENT -->

            </div>

            <!-- END SIDEBAR & CONTENT -->
        </div>
    </div>
    @stop

<script src="{{ asset("js/order.js") }}"></script>