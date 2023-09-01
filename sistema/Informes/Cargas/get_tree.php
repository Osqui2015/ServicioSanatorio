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
            $carp = "'".$itemPath."'";
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
                                
                                <button onclick="delteFile('.$carp.')" type="button" class="btn btn-danger"
                                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" hidden>
                                        
                                            <i class="ri-delete-bin-5-line"></i>

                                </button>



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

