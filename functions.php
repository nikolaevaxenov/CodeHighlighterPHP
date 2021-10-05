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