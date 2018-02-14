<?php

class Category {
    public function fetch() {
        global $PDO;
        $query = $PDO->prepare('SELECT short, name, photo FROM categories');
        $query->execute();
        return $query->fetchAll();
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