<?php

class Category {
    public function fetch() {
        global $PDO;
        $query = $PDO->prepare('SELECT short, name, photo FROM categories');
        $query->execute();
        return $query->fetchAll();
    }
    
    public function fetch_category($short) {
        global $PDO;
        $query = $PDO->prepare('SELECT name, text, rubrix FROM categories WHERE short = ?');
        $query->bindValue(1, $short);
        $query->execute();
        $result = $query->fetchAll();
        return $result[0];
    }
    
    public function fetch_by_rubrix($id) {
        global $PDO;
        $query = $PDO->prepare('SELECT name, short FROM categories WHERE rubrix = ?');
        $query->bindValue(1, $id);
        $query->execute();
        $result = $query->fetchAll();
        return $result[0];
    }
    
    public function fetch_by_item($id) {
        global $PDO;
        $getCATIDfromITEMID = $PDO->prepare('SELECT category FROM items WHERE id = ?');
        $getCATIDfromITEMID->bindValue(1, $id);
        $getCATIDfromITEMID->execute();
        $categoryID = $getCATIDfromITEMID->fetch(PDO::FETCH_COLUMN, 0);
        
        $getCATfromID = $PDO->prepare('SELECT name, short FROM categories WHERE id = ?');
        $getCATfromID->bindValue(1, $categoryID);
        $getCATfromID->execute();
        return $getCATfromID->fetch();
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
    
    public function fetch_ids() {
        global $PDO;
        $query = $PDO->prepare('SELECT id FROM items');
        $query->execute();
        return $query->fetchAll();
    }
    
    public function fetch_item($id) {
        global $PDO;
        $query = $PDO->prepare('SELECT * FROM items WHERE id = ?');
        $query->bindValue(1, $id);
        $query->execute();
        return $query->fetch();
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

class Rubrix {
    public function fetch() {
        global $PDO;
        $query = $PDO->prepare('SELECT DISTINCT rubrix_id FROM rubrix');
        $query->execute();
        return $query->fetchAll();
    }
    
    public function fetch_rubrix($id) {
        global $PDO;
        $query = $PDO->prepare('SELECT id, criterium, zeer, goed, voldoende, onvoldoende, value FROM rubrix WHERE rubrix_id = ?');
        $query->bindValue(1, $id);
        $query->execute();
        return $query->fetchAll();
    }
}

?>