<?php

class SearchFilePath
{
    private static $file = [];
    private static $absolutePath = [];

    private static function __getFiles(string $dirname, array $exception = [])
    {
        if (empty(self::$absolutePath)) {
            self::$absolutePath = explode('/', $dirname);
        } else {
            array_push(self::$absolutePath, $dirname);
        }

        $dirname = join('/', self::$absolutePath);

        if (is_dir($dirname)) {
            $dir = opendir($dirname);
            while ($data = readdir($dir)) {
                $req = false;

                foreach ($exception as $ex) {
                    $req = in_array(strtolower($ex), explode('/', strtolower($dirname)));
                    if ($req) {
                        break;
                    }
                }

                if (!in_array($data, ['.', '..']) && !$req) {
                    if (is_file("$dirname/$data")) {
                        if (!empty(explode('.', $data)[0])) {
                            array_push(self::$file, "$dirname/$data");
                        }
                    } elseif (is_dir("$dirname/$data")) {
                        self::__getFiles($data, $exception);
                        array_pop(self::$absolutePath);
                        array_push(self::$file, "$dirname/$data");
                    }
                }
            }
        }
    }

    private static function limitPath(string $path, string $newPath)
    {
        $path = explode('/', $path);
        $newPath = explode('/', $newPath);
        krsort($newPath);
        for ($i = 0; $i < count($path); $i++) {
            array_pop($newPath);
        }
        ksort($newPath);
        array_pop($newPath);
        return $newPath;
    }

    public static function getFiles(string $pathdir = '.', array $exceptionDirName = [])
    {
        self::$file = [];
        self::$absolutePath = [];
        self::__getFiles($pathdir, $exceptionDirName);
        $path = [];
        foreach (self::$file as $value) {
            $limitPath = self::limitPath($pathdir, $value);
            if (is_file($value)) {
                $fileName = explode('/', $value);
                $fileName = strtolower($fileName[count($fileName) - 1]);
                $fileName = explode('.', $fileName)[0];
                $acum = '';
                $param = '';
                $pathDir = '.';
                foreach ($limitPath as $limit) {
                    $param .= '["' . strtoupper($limit) . '"]';
                    $pathDir .= '/' . strtolower($limit);

                    $acum = '
                            if(!isset($path' . $param . ')){
                                $path' . $param . '["FILE_DIR"] = [];
                                $path' . $param . '["PATH_DIR"] = "' . $pathDir . '";
                            }
                        ';
                    eval($acum);
                }
                eval('
                    if(!isset($path' . $param . '["' . $fileName . '"])){
                        $path' . $param . '["FILE_DIR"]["' . $fileName . '"] = "' . $value . '";
                    }
                    array_push($path' . $param . '["FILE_DIR"], "' . $value . '");
                    for($i=0; $i<count($path' . $param . '["FILE_DIR"]); $i++){
                        if(isset($path' . $param . '["FILE_DIR"][$i])){
                            unset($path' . $param . '["FILE_DIR"][$i]);
                        } 
                    }
                ');
            }
        }
        return $path;
    }

    public static function getFilesFilter(string $filter = '.', string $pathDir = '.', array $exceptionFileName = [])
    {
        foreach ($exceptionFileName as $index => $filename) {
            $exceptionFileName[$index] = strtolower($filename);
        }
        self::$file = [];
        self::$absolutePath = [];
        self::__getFiles($pathDir, []);
        $files = [];
        foreach (self::$file as $file) {
            if (is_file($file)) {
                $acum = explode('/', $file);
                $fileName = $acum[count($acum) - 1];
                if (strpos(strtolower(' ' . $fileName), strtolower($filter)) > 0) {
                    if (!in_array(strtolower($fileName), $exceptionFileName)) {
                        array_push($files, "./$file");
                    }
                }
            }
        }
        return $files;
    }
}
