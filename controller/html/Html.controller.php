<?php

class Html
{
    private $title;
    private $icon;
    private $html;
    private $head;
    private $body;
    private $style;
    private $script;
    private $meta;
    private $content;

    public function __construct()
    {
        $this->title = [];
        $this->icon = [];
        $this->html = [];
        $this->head = [];
        $this->body = [];
        $this->style = [];
        $this->script = [];
        $this->meta = [];
        $this->content = '';

        // Cargando meta
        $this->loadMeta(['http-equiv' => 'Content-Type', 'content' => 'text/html;charset=UTF-8']);
        $this->loadMeta(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
        $this->loadMeta(['name' => 'description', 'content' => 'Escucha tu musica favorita donde y cuando quieras.']);
        $this->loadMeta(['name' => 'author', 'content' => 'Creado por RMB']);
    }

    public function setTitle(string $title)
    {
        $this->title = [
            'start' => '<title>',
            'text' => $title,
            'end' => '</title>'
        ];
    }

    public function setIconPage(string $url)
    {
        $this->icon = [
            'start' => '<link',
            0 => ' ',
            1 => "rel='",
            'rel' => 'icon',
            2 => "' ",
            3 => "href='",
            'href' => $url,
            4 => "' ",
            5 => "type='",
            'type' => 'image/png',
            'end' => "'>"
        ];
    }

    public function loadMeta(array $meta)
    {
        $acum = '<meta ';
        foreach ($meta as $index => $value) {
            $acum .= "$index='$value' ";
        }
        $acum = trim($acum) . '>';
        array_push($this->meta, $acum);
    }

    public function loadScripts(array $urls){
        foreach($urls as $url){
            array_push($this->script, "<script src='$url'></script>");
        }
    }
    
    public function loadStyles(array $urls){
        foreach($urls as $url){
            array_push($this->style, "<link rel='stylesheet' href='$url' type='text/css'>");
        }
    }

    public function loadHTML(string $html){
        $this->content = $html;
    }

    public function output()
    {
        $this->head = [
            'meta' => implode($this->meta),
            'title' => implode($this->title),
            'icon' => implode($this->icon),
            'style' => implode($this->style)
        ];

        $this->body = [
            'content' => $this->content,
            'script' => implode($this->script)
        ];

        $this->html = [
            'head' => implode($this->head),
            'body' => implode($this->body)
        ];

        echo implode($this->html);
    }

    public function getTitle()
    {
        return isset($this->title['text']) ? $this->title['text'] : '';
    }

    public function getIconPage(string $atribute='href')
    {
        return $this->icon[$atribute];
    }
}
