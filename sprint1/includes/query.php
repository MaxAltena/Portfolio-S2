<?php

class Category {
    public function fetch() {
        global $PDO;
        $query = $PDO->prepare('SELECT short, name, preview FROM categories');
        $query->execute();
        return $query->fetchAll();
    }
}

class Photo {
    public function fetch_by_id($id) {
        global $PDO;
        $query = $PDO->prepare('SELECT name FROM media WHERE id = ? AND type = ?');
        $query->bindValue(1, $id);
        $query->bindValue(2, "IMG");
        $query->execute();
        $result = $query->fetch();
        return $result['name'];
    }
}

?>