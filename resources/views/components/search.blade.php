<form action="{{ url("/products") }}" method="get">
    <div class="input-group">
        <input type="text" placeholder="Pretraži proizvode" name="keyword" class="form-control" />
            <span class="input-group-btn">
                      <button class="btn btn-primary" type="submit">Pretraži</button>
            </span>
    </div>
</form>
