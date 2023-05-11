<?php
require_once('abstractDAO.php');
require_once('menu.php');

class menuDAO extends abstractDAO
{

    function __construct()
    {
        try {
            parent::__construct();
        } catch (mysqli_sql_exception $e) {
            throw $e;
        }
    }

    public function readMenu($id)
    {
        $query = 'SELECT * FROM assignment2 WHERE id = ?';
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $temp = $result->fetch_assoc();
            $menu = new menu($temp['id'], $temp['name'], $temp['description'], $temp['date'], $temp['price'], $temp['image']);
            $result->free();
            return $menu;
        }
        $result->free();
        return false;
    }

    public function getMenus()
    {
        $query = 'SELECT * FROM assignment2';

        $result = $this->mysqli->query('SELECT * FROM assignment2');


        $menus = array();

        if ($result->num_rows >= 1) {
            while ($row = $result->fetch_assoc()) {
                $menu = new menu($row['id'], $row['name'], $row['description'], $row['date'], $row['price'], $row['image']);
                $menus[] = $menu;
            }

            return $menus;
        }
        return array();
    }

    public function addmenu($menu)
    {
        if (!$this->mysqli->connect_errno) {
            $query = 'INSERT INTO assignment2 (name, description, date, price, image) VALUES (?,?,?,?,?)';
            $stmt = $this->mysqli->prepare($query);
            if ($stmt) {
                $name = $menu->getName();
                $description = $menu->getDescription();
                $date = $menu->getdate();
                $price = $menu->getprice();
                $image = $menu->getImage();

                $stmt->bind_param(
                    'sssss',
                    $name,
                    $description,
                    $date,
                    $price,
                    $image
                );
                $stmt->execute();

                if ($stmt->error) {
                    return $stmt->error;
                } else {
                    return $menu->getName() . ' added successfully!';
                }
            } else {
                $error = $this->mysqli->errno . ' ' . $this->mysqli->error;
                echo $error;
                return $error;
            }

        } else {
            return 'Could not connect to Database.';
        }
    }

    public function updateMenu($menu)
    {
        if (!$this->mysqli->connect_errno) {
            $query = "UPDATE assignment2 SET name=?, description=?, date=?, price=?, image=? WHERE id=?";
            $stmt = $this->mysqli->prepare($query);
            if ($stmt) {
                $id = $menu->getId();
                $name = $menu->getName();
                $description = $menu->getDescription();
                $date = $menu->getdate();
                $price = $menu->getprice();
                $image = $menu->getImage();

                $stmt->bind_param(
                    'sssssi',
                    $name,
                    $description,
                    $date,
                    $price,
                    $image,
                    $id
                );
                $stmt->execute();

                if ($stmt->error) {
                    return $stmt->error;
                } else {
                    return $menu->getName() . ' updated successfully!';
                }
            } else {
                $error = $this->mysqli->errno . ' ' . $this->mysqli->error;

                echo $error;
                return $error;
            }

        } else {
            return 'Could not connect to Database.';
        }
    }


    public function deleteMenu($id)
    {
        if (!$this->mysqli->connect_errno) {
            $query = 'DELETE FROM assignment2 WHERE id = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            if ($stmt->error) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}

?>