@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="container">
        @component('components.sidebar')@endcomponent
        <!-- <input type="submit" value="Submit"> -->
            <!-- BEGIN CONTENT -->
            <div class="col-md-9 col-sm-7">
                <div class="row list-view-sorting clearfix">
                    <div class="col-md-2 col-sm-2 list-view">
                        <a href="javascript:;"><i class="fa fa-th-large"></i></a>
                        <a href="javascript:;"><i class="fa fa-th-list"></i></a>
                    </div>
                    <div class="col-md-10 col-sm-10" id="position">
                        @component('components.show_and_sort')@endcomponent
                        @component('components.search_category')@endcomponent
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <ul class="pagination pull-right" id="pagination">
                            <li class="paginationStart"><a onclick="changePage(1)"  href="#position">&laquo;</a></li>

                            <li class="paginationEnd"><a id="pgLast" href="#position">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
                    <div id="products" class="row">

                    </div>
                </div>
        </div>
    </div>
    </div>
    </div>
    <script src="{{ asset("js/sortFilterSearch.js") }}"></script>
@endsection
