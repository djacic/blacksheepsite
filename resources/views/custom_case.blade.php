@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
            <!-- BEGIN CONTENT -->
            <div class="col-md-12 col-sm-12">
                <h1>Custom Case - Maska dok trepneš!</h1>
                <p>Prelako je! Samo izaberite sliku!</p>
                <div class="content-form-page">
                    <form role="form" class="form-horizontal form-without-legend" action="{{ url("custom-case/add") }}" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Izaberite sliku:</label>
                            <div class="col-lg-8">
                                <input type="file" name="file">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="message">Napomene:</label>
                            <div class="col-lg-8">
                                <textarea class="form-control" name="comment" rows="6"></textarea>
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