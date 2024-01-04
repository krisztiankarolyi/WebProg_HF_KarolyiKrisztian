<?php 

require_once("dbManager.php");

class Stock{
    
    private $ticker;
    private $name;
    private $price;
    private $shares;
    private $dividend;

    function __construct($ticker, $name, $price, $shares, $dividend){
        $this->ticker = $ticker;
        $this->name = $name;
        $this->price = $price;
        $this->shares = $shares;
        $this->dividend = $dividend;

    }

    function save() {
        global $conn;

        try {
            // Insert data into the database
            $query = "INSERT INTO stocks (ticker, name, price, dividend, shares) 
                      VALUES ('$this->ticker', '$this->name', $this->price, $this->dividend, $this->shares)";

            if (mysqli_query($conn, $query)) {
                echo "Stock saved successfully!";
                // Optionally redirect to another page or display a success message
            } else {
                throw new Exception("Error: " . $query . "<br>" . mysqli_error($conn));
            }
        } catch (Exception $e) {
            echo "Caught exception: " . $e->getMessage();
            // Optionally log the exception or perform other error handling tasks
        }

        finally {
            $conn->close();
        }
    }

    static function getList(): array{
        global $conn;

        try{
            $query = "SELECT * FROM stocks";
            $result = $conn->query($query);

            $stockList = array();

            while ($row = $result->fetch_assoc()) {
                $stockList[] = $row;
            }
    
            return $stockList;
        }

        catch(Exception $e){
            echo $e;
            return [];
        }

        finally {
            $conn->close();
        }
    }
}