<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ secure_asset("icon.png") }}" type="image/png">

    <script src="{{ secure_asset("storage/highlightjs/highlight.min.js") }}"></script>

    <script src="{{ secure_asset("bootstrap/js/bootstrap.min.js") }}"></script>
    <link rel="stylesheet" href="{{ secure_asset("bootstrap/css/bootstrap.min.css") }}">

    <link rel="stylesheet" href="{{ secure_asset("css/index.css") }}">

    <title>Highlight for Word documents</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="{{ route('index') }}" method="post">
                    @csrf
                    <div class="language m-2">
                        <label for="languageCode">Choose syntax language</label>
                        <select class="form-select" name="languageCode" id="languageCode">
                            @foreach ($data['syntaxes'] as $syntax)
                            @if (str_replace(".min.js", "", str_replace("highlightjs/languages/", "", $syntax)) == session()->get('language'))
                            <option selected>{{str_replace(".min.js", "", str_replace("highlightjs/languages/", "", $syntax))}}</option>
                            @else
                            <option>{{str_replace(".min.js", "", str_replace("highlightjs/languages/", "", $syntax))}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="style m-2">
                        <label for="styleCode">Choose style for highlighting</label>
                        <select class="form-select" name="highlightStyle" id="highlightStyle">
                            @foreach ($data['styles'] as $style)
                            @if (str_replace(".min.css", "", str_replace("highlightjs/styles/", "", $style)) == session()->get('style'))
                            <option selected>{{str_replace(".min.css", "", str_replace("highlightjs/styles/", "", $style))}}</option>
                            @else
                            <option>{{str_replace(".min.css", "", str_replace("highlightjs/styles/", "", $style))}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="textcode m-2">
                        <div><label for="code">Enter your code here</label></div>
                        <textarea class="form-control" style="resize: none;" name="code" id="code" cols="50" rows="20">{{ session()->get('code') }}</textarea>
                    </div>
                    <div class="text-center"><p class="lead">Author: Nikolaev-Axenov</p></div>
                    <div class="text-center"><button type="submit" class="btn btn-success">Highlight!</button></div>
                </form>
            </div>
            <div class="col">
                @if (session()->get('highlighted') == true)
                <link rel="stylesheet" href="{{ secure_asset("storage/highlightjs/styles") }}/{{session()->get('style')}}.min.css">
                <pre><code id="highlighted" class="m-2 language-{{session()->get('language')}}">{{session()->get('code')}}</code></pre>
                <script>hljs.highlightAll();</script>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
