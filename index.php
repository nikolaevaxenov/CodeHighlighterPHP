<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="icon.png" type="image/png">

    <script src="modules\highlightjs\highlight.min.js"></script>

    <script src="modules\bootstrap\js\bootstrap.min.js"></script>
    <link rel="stylesheet" href="modules\bootstrap\css\bootstrap.min.css">

    <script src="index.js"></script>
    <link rel="stylesheet" href="index.css">
    
    <?php include("functions.php") ?>

    <title>Highlight for Word documents</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="index.php" method="post">
                    <div class="language m-2">
                        <label for="languageCode">Choose syntax language</label>
                        <select class="form-select" name="languageCode" id="languageCode">
                            <?php getLanguagesSyntaxes(); ?>
                        </select>
                    </div>
                    <div class="style m-2">
                        <label for="styleCode">Choose style for highlighting</label>
                        <select class="form-select" name="highlightStyle" id="highlightStyle">
                            <?php getSyntaxHighlightingStyles(); ?>
                        </select>
                    </div>
                    <div class="textcode m-2">
                        <div><label for="code">Enter your code here</label></div>
                        <textarea class="form-control" style="resize: none;" name="code" id="code" cols="50" rows="20"><?php echo $_SESSION['code']; ?></textarea>
                    </div>
                    <div class="text-center"><button type="submit" class="btn btn-success">Highlight!</button></div>
                </form>
            </div>
            <div class="col">          
                <?php showHighlighted(); ?>
            </div>
        </div>
    </div>
    <div class="text-center"><a href="http://<?php echo $_SERVER['HTTP_HOST'] ?>">На главную</a></div>
</body>
</html>