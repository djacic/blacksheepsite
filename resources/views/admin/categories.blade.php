@extends("admin.master")
@section("title")
    Admin - Kategorije
@endsection
@section("page-title")
    Upravljanje kategorijama
@endsection
@section("content")
    <div class="col-md-6">
        <category-table></category-table>
    </div>
    <div class="col-md-6">
        <div class="col-md-8">
            <category-form></category-form>
        </div>
    </div>
@endsection