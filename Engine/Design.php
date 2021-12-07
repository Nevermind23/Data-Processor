<?php

namespace Engine;

class Design
{
    const HEADER = <<<HTML
<!doctype html>
<html lang="`en`">
<head>
<meta charset="UTF-8">
             <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                         <meta http-equiv="X-UA-Compatible" content="ie=edge">
             <title>Document</title>
             <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
HTML;

    const FOOTER = <<<HTML
</body>
</html>
HTML;

    public static function upload(): string
    {
        return self::draw(
            <<<HTML
<div class="container mt-5">
<div class="d-flex">
<div class="ms-auto"><a href="/config/reconfigure" class="btn btn-lg btn-danger">Reconfigure</a></div>
</div>
  <form action="/upload" method="post" enctype="multipart/form-data">
    <h1 class="text-center mb-5">
    Select File
</h1>
  <div class="row">
  <div class="col-10 mt-1">
  <input class="form-control" type="file" name="data" id="data">
</div>
<div class="col-2">
<button type="submit" class="btn btn-lg btn-primary">Download</button>
</div>
</div>
</form>
</div>
HTML
        );
    }

    public static function config(): string
    {
        return self::draw(
            <<<HTML
  <div class="container mt-5">
  <form action="/config/update" method="post" enctype="multipart/form-data">
    <div class="row">
<div class="col-12">
    <h1 class="text-center mb-5">
    Create new configuration
</h1>
</div>

<div class="col-12">
<div class="row mt-3" id="fields">
<div class="col-6">
  <label for="data" class="form-label">Original Name</label>
  <input class="form-control" type="text" name="data[]" id="data">
</div>
<div class="col-6">
  <label for="format" class="form-label">New Name</label>
  <input class="form-control" type="text" name="format[]" id="format">
</div>
</div>
</div>

<div class="col-12 btn-group mt-5">
<button id="addNewField" type="button" class="btn btn-lg btn-success"><b>+</b> Add new field</button>
<button type="submit" class="btn btn-lg btn-primary">Continue</button>
</div>
</div>
</div>
</form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let fields = $("#fields");
    let fClone = fields.clone();
    fClone.removeAttr("id");
    $("#addNewField").click(function () {
        fields.parent().append(fClone.clone());
    })
</script>
HTML
        );
    }

    private static function draw($content): string
    {
        return self::HEADER . $content . self::FOOTER;
    }
}