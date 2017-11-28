@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <!-- BEGIN CONTENT -->
            <div class="col-md-12 col-sm-12">
                <h1>Custom Case - Maska dok trepneš!</h1>
                <p>
                  Ako ne želite da budete kao drugi, ako ne želite da Vam drugi<br>
                  ograničavaju izbor i želite nešto samo svoje, onda je ovo stranica baš za Vas !<br><br>
                  Nudimo Vam mogućnost da fotografije koje volite i koje Vam znače<br>
                  budu uvek sa Vama – na futroli Vašeg mobilnog telefona.<br><br>
                  Želite fotografiju Vašeg kućnog ljubimca, članova porodice, osobe koju volite<br>
                  ili ličnosti kojoj se divite? Igrajte se dizajniranja i napravite svoju unikatnu futrolu.<br><br>
                  Jedina granica je Vaša kreativnost. Na nama je da je realizujemo.<br>
                  Dovoljno je da pripremite fotografiju, pošaljete nam je i odaberite model futrole koji želite.<br>
                  Mi ćemo na odabranom modelu odštampati fotografiju za Vas.<br><br>

                  Imaćete kvalitetnu i trajnu futrolu kojoj ćete sami dati jedinstven dizajn.<br>
                  Kreirajte, stvarajte i budite drugačiji !<br><br>
                  Cena futrole sa štampom:<br>
                  799 din na klasičnom (debljem) silikonu<br>
                  799 din na ultra tankom silikonu<br><br>
                  Napomena : Za izradu samo Vaše futrole potrebno je od 3 do 5 radnih dana
                </p>
                <div class="content-form-page">
                    <form role="form" class="form-horizontal form-without-legend" action="{{ url("custom-case/add") }}" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Dodaj fotografiju:</label>
                            <div class="col-lg-8">
                                <input type="file" name="file">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="model">Model telefona:</label>
                            <div class="col-lg-8">
                                <input type='text' class="form-control" name="model" size="20"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="message">Napomene:</label>
                            <div class="col-lg-8">
                                <textarea class="form-control" name="comment" rows="5" size="20"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-offset-2 padding-left-0 padding-top-20">
                                <button class="btn btn-primary" name="add" type="submit">Dodaj u korpu</button>
                            </div>
                        </div>
                    </form>
                    @if(session('success'))
                        <div class="row">
                            <div class="alert alert-info col-md-4 col-md-offset-4 text-center">
                                <strong>{{ session('success') }}</strong>
                            </div>
                        </div>
                    @endif

                    @if (session('errors'))
                        <div class="row">
                            <div class="alert alert-danger col-md-4 col-md-offset-4">
                                <ul>
                                    @foreach (session('errors') as $error)
                                        <li>{{ $error[0] }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
    </div>
    </div>
    @stop
