<?php 

class ListPlayer extends ListMusic{
    private $table = 'listplayer';

    public function __construct()
    {
        if(!parent::tableExists($this->table)){
            parent::execNoQuery("CREATE TABLE $this->table(
                idList INTEGER(10) PRIMARY KEY AUTO_INCREMENT, 
                listName VARCHAR(200) NOT NULL, 
                dateList TIMESTAMP DEFAULT NOW(), 
                dateListDelete TIMESTAMP DEFAULT NOW(), 
                idUser INTEGER(10) NOT NULL, 
                deleteList BOOLEAN DEFAULT FALSE
            )");
        }
    }

    public function newList(string $namelist){
        parent::execNoQuery("INSERT INTO $this->table(listname,idUser) VALUES('$namelist', " . Session::getUserID() .")");
    }
    
    public function getListMusic(string $listMusic){
        $lists = parent::getData("SELECT * FROM $this->table WHERE NOT deleteList AND MD5(idList)='$listMusic'");

        if(!empty($lists)){
            $lists[0]['musics'] = parent::getList($lists[0]['idList'], new Music());
        }

        return !empty($lists) ? $lists[0] : [];
    }

    public function addMusicToList(int $idList, int $idMusic){
        if(!parent::existsMusicInList($idMusic, $idList)){
            parent::newMusicToList(['idList' => $idList, 'idMusic' => $idMusic]);
        }
    }

    public function deleteList(int $idList){
        parent::execNoQuery("UPDATE $this->table SET deleteList=NOT deleteList, dateListDelete=NOW() WHERE idList=$idList AND idUser=" . Session::getUserID());
    }

    public function getDelete(){
        return parent::getData("SELECT idList as id, listName as name, dateListDelete AS date, '$this->table' as 'origin' FROM $this->table WHERE deleteList AND idUser=" . Session::getUserID());
    }

    public function getListName(){
        return parent::getData("SELECT * FROM $this->table WHERE NOT deleteList AND idUser=" . Session::getUserID());
    }
}