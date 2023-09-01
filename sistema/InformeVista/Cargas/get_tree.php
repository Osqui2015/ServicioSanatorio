<?php
if(isset($_POST['folder'])) {
    $folder = $_POST['folder'];
    echo '<ul class="tree">';
    if (is_dir($folder)) {
        displayTree($folder);
    } else {
        echo '<li>No files or folder found.</li>';
    }
    echo '</ul>';
}

function displayTree($path) {
    $files = scandir($path);
    foreach($files as $file) {
        if($file != '.' && $file != '..') {
            $itemPath = $path . '/' . $file;
            echo '<li class="folder">';
            if(is_dir($itemPath)) {
                echo '<span class="fw-semibold font-monospace">' . $file . '</span>';
                echo '<ul>';
                displayTree($itemPath);
                echo '</ul>';
            } else {
                if (pathinfo($file, PATHINFO_EXTENSION) === 'pdf') {
                    echo '  <li class="file pdf">
                                <a href="' . $itemPath . '">' . $file . '</a>
                            </li>';
                } else {
                    echo '<li class="file">' . $file . '</li>';
                }
            }
            echo '</li>';
        } 
    }
}
?>

