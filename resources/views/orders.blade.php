@extends('layouts.app')
@section('content')
<div class="main">
    <div class="container">


        <!-- BEGIN CONTENT -->
        <div class="col-md-9 col-sm-7">
            <h1>Moj Black Sheep</h1>
            <div class="content-page">
                <div id="payment-address" class="panel panel-default">
                    <div class="panel-heading">
                        <form>
                            Unesite petocifreni token: <input type="text" id="token"/>
                            <a data-toggle="collapse" data-parent="#checkout-page" href="#orders" class="accordion-toggle">
                                Potvrdi
                            </a>
                        </form>
                    </div>
                    <div id="orders" class="panel-collapse collapse">
                        <div class="panel-body row">
                            <div class="col-md-12 col-sm-12">
                                <h3>Dosadašnje porudžbine:</h3>
                                <?php

                                    $data = [
                                        'details' => [
                                            [
                                                'id' => '0000001',
                                                'date' => '22.04.1998.',
                                                'quantity' => '3',
                                                'price' => '23412',
                                                'status' => 'delivered'
                                            ],
                                            [
                                                'id' => '0000001',
                                                'date' => '22.04.1998.',
                                                'quantity' => '3',
                                                'price' => '23412',
                                                'status' => 'pending'
                                            ],
                                            [
                                                'id' => '0000001',
                                                'date' => '22.04.1998.',
                                                'quantity' => '3',
                                                'price' => '23412',
                                                'status' => 'courier'
                                            ]

                                        ]
                                    ]
        ?>
                                @component('components.order',$data)@endcomponent



                            </div>




                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- END CONTENT -->
</div>
<!-- END SIDEBAR & CONTENT -->
</div>
</div>
@stop
