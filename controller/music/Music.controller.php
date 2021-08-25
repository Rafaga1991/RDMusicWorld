<?php

class Music extends Connection{
    private $table = 'music';
    private $tableLike = 'likeMusic';
    private $tableGenner = 'genner';
    private $user;

    public function __construct()
    {
        if(!parent::tableExists($this->table)){
            parent::execNoQuery("CREATE TABLE $this->table(
                idMusic INTEGER(10) PRIMARY KEY AUTO_INCREMENT, 
                nameMusic VARCHAR(200) NOT NULL, 
                formatMusic VARCHAR(50) NOT NULL, 
                fileNameMusic VARCHAR(50) NOT NULL, 
                fileSizeMusic INTEGER(10) NOT NULL,
                descriptionMusic VARCHAR(500), 
                authorMusic VARCHAR(200), 
                idGenner INTEGER(10) NOT NULL, 
                idUser INTEGER(10) NOT NULL, 
                dateMusic TIMESTAMP DEFAULT NOW(), 
                dateMusicDelete TIMESTAMP DEFAULT NOW(), 
                deleteMusic BOOLEAN DEFAULT FALSE
            )");
        }

        if(!parent::tableExists($this->tableLike)){
            parent::execNoQuery("CREATE TABLE $this->tableLike(
                idLike INTEGER(10) PRIMARY KEY AUTO_INCREMENT, 
                idMusic INTEGER(10) NOT NULL, 
                idUser INTEGER(10) NOT NULL,
                deleteLike BOOLEAN DEFAULT FALSE
            )");
        }

        if(!parent::tableExists($this->tableGenner)){
            parent::execNoQuery("CREATE TABLE $this->tableGenner(
                idGenner INTEGER(10) PRIMARY KEY AUTO_INCREMENT,
                gennerName VARCHAR(100) NOT NULL,
                dateGenner TIMESTAMP DEFAULT NOW(),
                deleteGenner BOOLEAN DEFAULT FALSE
            )");
        }

        $this->user = new User();
    }

    private function __getMusic(array $musics){
        foreach($musics as $index => $music){
            $musics[$index]['user'] = $this->user->getUser($music['idUser']);
            $musics[$index]['genner'] = parent::getData("SELECT * FROM $this->tableGenner WHERE idGenner={$music['idGenner']}")[0];
            $musics[$index]['like'] = count(parent::getData("SELECT * FROM $this->tableLike WHERE idMusic={$music['idMusic']} AND idUser=" . Session::getUserID() . " AND NOT deleteLike")) == 1;
            $musics[$index]['likes'] = count(parent::getData("SELECT * FROM $this->tableLike WHERE idMusic={$music['idMusic']} AND NOT deleteLike"));
        }

        return $musics;
    }

    public function getMusics(string $search=null){
        $musics = parent::getData(
            "SELECT * FROM  $this->table WHERE NOT deleteMusic" 
            . (($search != null) ? " AND descriptionMusic LIKE '%$search%' OR nameMusic LIKE '%$search%' OR authorMusic LIKE '%$search%'" : ' LIMIT 10')
        );

        return $this->__getMusic($musics);
    }

    public function getMusic(int $idMusic){
        return $this->__getMusic(parent::getData("SELECT * FROM $this->table WHERE idMusic=$idMusic AND NOT deleteMusic"))[0];
    }

    public function newMusic(array $music){
        parent::execNoQuery("INSERT INTO $this->table(
            nameMusic, formatMusic, fileNameMusic, 
            fileSizeMusic, descriptionMusic, authorMusic, 
            idGenner, idUser
        ) VALUES(
            '{$music['nameMusic']}', '{$music['formatMusic']}', '{$music['fileNameMusic']}',
            '{$music['fileSizeMusic']}', '{$music['descriptionMusic']}', '{$music['authorMusic']}',
            {$music['idGenner']}, {$music['idUser']}
        )");
    }

    public function getDelete(){
        return parent::getData("SELECT idMusic as id, CONCAT(nameMusic, ' - ', authorMusic) as name, dateMusicDelete as date, '$this->table' as 'origin' FROM $this->table WHERE deleteMusic AND idUser=" . Session::getUserID());
    }

    public function deleteMusic(int $music){
        parent::execNoQuery("UPDATE $this->table SET deleteMusic=NOT deleteMusic, dateMusicDelete=NOW() WHERE idMusic=$music");
    }

    public function like(array $like){
        $data = parent::getData("SELECT * FROM $this->tableLike WHERE idMusic={$like['idMusic']} AND idUser={$like['idUser']}");
        if(count($data) > 0){
            parent::execNoQuery("UPDATE $this->tableLike SET deleteLike=(NOT deleteLike) WHERE idLike={$data[0]['idLike']}");
        }else{
            parent::execNoQuery("INSERT INTO $this->tableLike(idMusic, idUser) VALUES({$like['idMusic']}, " . Session::getUserID() . ")");
        }
    }

    public function newGennerMusic(string $name){
        parent::execNoQuery("INSERT INTO $this->tableGenner(gennerName) VALUES('$name')");
    }

    public function updateGenner(int $idGenner, string $name){
        parent::execNoQuery("UPDATE $this->tableGenner SET gennerName='$name' WHERE idGenner=$idGenner");
    }

    public function getGennersMusical(){
        return parent::getData("SELECT * FROM $this->tableGenner WHERE NOT deleteGenner order by gennerName", "idGenner");
    }
}