<?php
class ArrayManipulator {
    private $data = [];

    // __get magic metódus
    public function __get($key) {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        } else {
            return null;
        }
    }

    // __set magic metódus
    public function __set($key, $value) {
        $this->data[$key] = $value;
    }

    // __isset magic metódus
    public function __isset($key) {
        return isset($this->data[$key]);
    }

    // __unset magic metódus
    public function __unset($key) {
        unset($this->data[$key]);
    }

    // __toString magic metódus
    public function __toString() {
        return json_encode($this->data);
    }

    // __clone magic metódus
    public function __clone() {
        // Az adattag másolása
        $this->data = array_merge([], $this->data);
    }
}

// Tesztelés
$obj = new ArrayManipulator();
$obj->foo = "bar";
$obj->baz = 42;

// __get tesztelése
echo $obj->foo . "\n";  // Kiír: "bar"

// __set tesztelése
echo $obj->baz . "\n";  // Kiír: 42

// __isset tesztelése
if (isset($obj->foo)) {
    echo "foo létezik\n";
}

// __unset tesztelése
unset($obj->foo);
if (!isset($obj->foo)) {
    echo "foo nem létezik\n";
}

// __toString tesztelése
echo $obj . "\n";  // Kiír: {"baz":42}

// __clone tesztelése
$clone = clone $obj;
$clone->baz = 100;
echo $obj->baz . "\n";   // Kiír: 42
echo $clone->baz . "\n";  // Kiír: 100
