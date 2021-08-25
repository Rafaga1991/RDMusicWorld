<?php

class ListMusic extends Connection{
    private $table = 'listmusic';

    public function __construct()
    {
        if(!parent::tableExists($this->table)){
            parent::execNoQuery("CREATE TABLE $this->table(
                idListMusic INTEGER(10) PRIMARY KEY AUTO_INCREMENT,
                idMusic INTEGER(10) NOT NULL,
                idList INTEGER(10) NOT NULL,
                dateListMusic TIMESTAMP DEFAULT NOW(),
                deleteListMusic BOOLEAN DEFAULT FALSE
            )");
        }
    }

    protected function newMusicToList(array $data){
        parent::execNoQuery("INSERT INTO $this->table(idMusic,idList) VALUES({$data['idMusic']}, {$data['idList']})");
    }

    protected function existsMusicInList(int $idMusic, int $idList){
        $result = parent::getData("SELECT * FROM $this->table WHERE idMusic=$idMusic AND idList=$idList");
        return !empty($result);
    }

    protected function getList(int $idList){
        $Music = new Music();
        $musics = parent::getData("SELECT * FROM $this->table WHERE idList=$idList AND NOT deleteListMusic");
        foreach($musics as $index => $music){
            $musics[$index]['music'] = $Music->getMusic($music['idMusic']);
        }
        return $musics;
    }
}