<?php


echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>';


class Database {
    private $connection;

    public function connect($host, $dbname, $username, $password) {
        try {
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
            $this->connection = new PDO($dsn, $username, $password);
            // echo "Connected to the database successfully.";
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function insert($table, $columns, $values) {
        try {
            $columns_str = implode(", ", $columns);
            $placeholders = rtrim(str_repeat("?, ", count($values)), ", ");
            $sql = "INSERT INTO $table ($columns_str) VALUES ($placeholders)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($values);
            echo "Record inserted successfully.";
        } catch (PDOException $e) {
            echo "Error inserting record: " . $e->getMessage();
        }
    }

    public function select($table) {
        try {
            $stmt = $this->connection->query("SELECT * FROM $table");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error selecting data: " . $e->getMessage();
            return [];
        }
    }

    public function update($table, $id, $updates) {
        try {
            $set_clause = implode(", ", array_map(function($key) {
                return "$key = ?";
            }, array_keys($updates)));

            $sql = "UPDATE $table SET $set_clause WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $values = array_values($updates);
            $values[] = $id;

            $stmt->execute($values);
            echo "Record updated successfully.";
        } catch (PDOException $e) {
            echo "Error updating record: " . $e->getMessage();
        }

        
    }

    public function delete($table, $id) {
        try {
            $sql = "DELETE FROM $table WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            echo "Record deleted successfully.";
        } catch (PDOException $e) {
            echo "Error deleting record: " . $e->getMessage();
        }
    }

    public function drawTable($data) {
        if (empty($data)) {
            echo "<p>No data available to display.</p>";
            return;
        }
        echo "<table class='table'>";
        echo "<tr>";
        foreach (array_keys($data[0]) as $header) {
            echo "<th>" . ucfirst($header) . "</th>";
        }
        echo "<th>Edit</th><th>Delete</th>";
        echo "</tr>";
        foreach ($data as $row) {
            echo "<tr>";
            foreach ($row as $key => $value) {
                if ($key == "image") {
                    echo "<td><img src='{$value}' width='100' height='100'></td>";
                } else {
                    echo "<td>{$value}</td>";
                }
            }
            echo "<td><a class='btn btn-secondary' href='user_edit.php?id={$row['id']}'>Edit</a></td>";
            echo "<td><a class='btn btn-danger' href='delete.php?id={$row['id']}'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    public function edit($table, $id) {
        try {
            $sql = "SELECT * FROM $table WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error selecting record: " . $e->getMessage();
            return null;
        }
    }

    public function close() {
        $this->connection = null;
        // echo "Database connection closed.";
    }


    

    
}
$db = new Database();
$db->connect('localhost', 'cafe', 'root', '');

// Inserting 
// $db->insert('users', ['name', 'email'], ['iman', 'iman@gmail.com']);

// Selecting 
// print_r($db->select('users'))

// // // Update ID 1
// $db->update('users', 5, ['name' => 'ali']);

// // Delete 
// $db->delete('users', 1);

// // Closing the connection
// $db->close();




// $db->insert('products', ['name', 'price', 'description'], ['Alice', '67.5', 'alice@example.com']);

// $products = [
//     ['id' => 1, 'name' => 'Laptop', 'price' => '1000', 'description' => 'Gaming laptop'],
//     ['id' => 2, 'name' => 'Phone', 'price' => '500', 'description' => 'Smartphone']
// ];


// echo "<h2>Products Table</h2>";
// $db->drawTable($products);

// $db->close();
?>
