@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <!-- BEGIN SIDEBAR -->

                <!-- END SIDEBAR -->

                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <h1>Kontakt</h1>
                    <div class="content-page">
                        <h2>Pišite nam</h2>
                        <p>Na raspolaganju smo Vam za svaku vrstu nedoumice. Odgovorićemo u najkraćem mogućem roku!</p>

                        <!-- BEGIN FORM-->
                        <form action="{{ url("/contact/send") }}" class="default-form" method="post" role="form">
                            <div class="form-group">
                                <label for="name">Ime <span class="require">*</span></label>
                                <input type="text" class="form-control" name="firstName" id="firstName">
                            </div>
                            <div class="form-group">
                                <label for="name">Prezime <span class="require">*</span></label>
                                <input type="text" class="form-control" name="lastName" id="lastName">
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span class="require">*</span></label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                            <div class="form-group">
                                <label for="message">Poruka <span class="require">*</span></label>
                                <textarea class="form-control" rows="8" name="message" id="message"></textarea>
                            </div>
                            <div class="padding-top-20">
                                <button type="submit" name="send" id="send" class="btn btn-primary">Posalji</button>
                            </div>
                        </form>
                        <!-- END FORM-->
                        <br><br>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session('status'))
                            <div class="alert alert-info">
                                {{ session('status') }}
                            </div>
                        @endif
                        <!-- <div id="map" class="gmaps margin-bottom-40" style="height:400px;"></div> -->
                    </div>
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END SIDEBAR & CONTENT -->
        </div>
    </div>
    @stop
