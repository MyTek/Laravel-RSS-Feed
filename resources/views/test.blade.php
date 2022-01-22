<?php
use Illuminate\Http\Request;

if(\request()->post()){
    echo 'you have post data!';
    return;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PHP Test</title>
    </head>
    <body class="antialiased">
    <h2>PHP Test</h2>

    <form method="get" action="api/download" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group row">
            <label for="url" class="col-sm-3 col-form-label">URL</label>
            <div class="col-sm-9">
                <input name="url" type="text" class="form-control" id="url" placeholder="URL">
            </div>
        </div>
        <div class="form-group row mt-2">
            <div class="offset-sm-3 col-sm-9">
                <button type="submit" class="btn btn-primary">Submit URL</button>
            </div>
        </div>
    </form>
    </body>
</html>
