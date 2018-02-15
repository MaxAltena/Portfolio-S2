<?php

class Category {
    public function fetch() {
        global $PDO;
        $query = $PDO->prepare('SELECT short, name, photo FROM categories');
        $query->execute();
        return $query->fetchAll();
    }
}

class Item {
    public function fetch_for_preview_by_category($short) {
        global $PDO;
        $getIDfromSHORT = $PDO->prepare('SELECT id FROM categories WHERE short = ?');
        $getIDfromSHORT->bindValue(1, $short);
        $getIDfromSHORT->execute();
        $categoryID = $getIDfromSHORT->fetch(PDO::FETCH_COLUMN, 0);
        
        $getITEMSfromCAT = $PDO->prepare('SELECT id, name, description, photos, sprint FROM items WHERE category = ? ORDER BY sprint ASC');
        $getITEMSfromCAT->bindValue(1, $categoryID);
        $getITEMSfromCAT->execute();
        return $getITEMSfromCAT->fetchAll();
    }
}

class Photo {
    public function fetch_by_id($id) {
        global $PDO;
        $query = $PDO->prepare('SELECT name FROM photos WHERE id = ?');
        $query->bindValue(1, $id);
        $query->execute();
        $result = $query->fetch();
        return $result['name'];
    }
}

?>