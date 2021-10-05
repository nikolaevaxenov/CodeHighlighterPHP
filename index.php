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
    
    <?php 
		session_start();

    if(isset($_POST['code']) && $_POST['code']!=""){
        $_SESSION['code'] = $_POST['code'];
    }
	else {
		$_SESSION['code'] = "";
	}

    if(isset($_POST['highlightStyle']) && $_POST['highlightStyle']!=""){
        $_SESSION['style'] = $_POST['highlightStyle'];
    }
	else {
		$_SESSION['style'] = "";
	}

    if(isset($_POST['languageCode']) && $_POST['languageCode']!=""){
        $_SESSION['language'] = $_POST['languageCode'];
    }
	else {
		$_SESSION['language'] = "";
	}
    
    function getLanguagesSyntaxes() {
        if ($handle = opendir('.\modules\highlightjs\languages')) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    if (substr($entry, 0, -7) == $_SESSION['language']) {
                        echo "<option selected> " . substr($entry, 0, -7) . "</option>";
                    }
                    else {
                        echo "<option>" . substr($entry, 0, -7) . "</option>";
                    }
                    
                }
            }
            closedir($handle);
        }
    }

    function getSyntaxHighlightingStyles() {
        if ($handle = opendir('.\modules\highlightjs\styles')) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != ".." && strpos($entry, '.min.css')) {
                    if (substr($entry, 0, -8) == $_SESSION['style']) {
                        echo "<option selected> " . substr($entry, 0, -8) . "</option>";
                    }
                    else {
                        echo "<option>" . substr($entry, 0, -8) . "</option>";
                    }
                }
            }
            closedir($handle);
        }
    }

    function showHighlighted() {
        echo '<link rel="stylesheet" href="modules\highlightjs\styles\\' . $_SESSION['style'] . '.min.css">';
        echo '<pre><code id="highlighted" class="m-2 language-' . $_SESSION['language'] . '">' . $_SESSION['code'] . "</code></pre>";
        echo "<script>hljs.highlightAll();</script>";
    }
	?>

    <title>HighlightWord</title>
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
</body>
</html>