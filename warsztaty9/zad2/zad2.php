    <head>
        <meta charset="UTF-8">
        <title>Zadanie 2</title>
        <link rel="stylesheet" href="../warszaty9.css">
    </head>
    <body>
    <form method="GET" action="zad2.php">
        <label for="path">Podaj sciezke </label>
        <input name="path" id="path" autocomplete="off">
        <label for="directory">Podaj nazwe katalogu</label>
        <input name="directory" id="directory" autocomplete="off">
        <label for="operation">Podaj operacje</label>
        <select name="operation" id="operation">
            <option>-read</option>
            <option>-delete</option>
            <option>-create</option>
        </select>
        <button type="submit">send</button>
    </form>
    <?php
    function func($path, $dirName, $operator = '-read')
    {
    if(isset($path)) {
        if (!empty($path) && $path[strlen($path) - 1] != '/') {
            $path .= '/';
        }
        $fullPath = $path . $dirName;

        switch ($operator) {
            case '-read':
                if (file_exists($fullPath)) {
                    $array = scandir($fullPath);
                    $result = "";
                    foreach ($array as $file) {
                        if ($file != "." && $file != "..") {
                            $result .= "$fullPath$file <br>";
                        }
                    }
                    return $result;
                } else {
                    return "Katalog nie istnieje";
                }
                break;
            case '-delete':
                if (file_exists($fullPath)) {
                    $array = scandir($fullPath);
                    $i = 0;
                    foreach ($array as $file) {
                        if ($file != "." && $file != "..") {
                            $i += 1;
                        }
                    }
                    if ($i == 0) {
                        rmdir($fullPath);
                        return "Usunieto katalog";
                    } else {
                        return "Nie jest pusty.";
                    }
                }
                break;
            case '-create':
                if (!file_exists($fullPath)) {
                    mkdir($fullPath);
                    return "Utworzono katalog $dirName w $path";
                }
                break;
        }
    } else {
        return "Podaj sciezke katalogu";
    }
    }
    if (isset($_GET['path'], $_GET['directory'], $_GET['operation'])) {
        $path = $_GET['path'];
        $dirName = $_GET['directory'];
        $operator = $_GET['operation'];
        echo func($path, $dirName, $operator);
    }
    ?>
    </body>
