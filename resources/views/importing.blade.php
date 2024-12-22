<form action="{{ url('import-users') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <input type="file" name="file" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Import</button>
</form>
