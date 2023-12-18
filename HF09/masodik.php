<?php

    $jsonData = '[
        {
            "title": "The Catcher in the Rye",
            "author": "J.D. Salinger",
            "publication_year": 1951,
            "category": "Fiction"
        },
        {
            "title": "To Kill a Mockingbird",
            "author": "Harper Lee",
            "publication_year": 1960,
            "category": "Fiction"
        },
        {
            "title": "1984",
            "author": "George Orwell",
            "publication_year": 1949,
            "category": "Dystopian"
        },
        {
            "title": "The Great Gatsby",
            "author": "F. Scott Fitzgerald",
            "publication_year": 1925,
            "category": "Fiction"
        },
        {
            "title": "Brave New World",
            "author": "Aldous Huxley",
            "publication_year": 1932,
            "category": "Dystopian"
        }
    ]';

// a)
    $books = json_decode($jsonData, true);

/*
 *  b) Kategóriák szerinti rendezés: Elmentem a kategóriákat egy tömbbe, majd
       a könyveket hozzárendelem a saját kategóriájukhoz az új tömbben
*/
$booksByCategory = [];

foreach ($books as $book) {
    $category = $book['category'];

    if (!isset($booksByCategory[$category])) {
        $booksByCategory[$category] = [];
    }

    $booksByCategory[$category][] = $book;
}

//c  HTML táblázat
?>
<!DOCTYPE html>
<html>
<head>
    <title>HF 09 Károlyi Krisztián</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>


<?php
echo '<table class="table is-bordered is-striped is-narrow is-hoverable">';
echo '<thead><tr><th>Kategória</th><th>Cím</th><th>Szerző</th><th>Kiadás Éve</th></tr></thead>';
echo '<tbody>';

foreach ($booksByCategory as $category => $categoryBooks) {
    echo "<tr><td colspan='4' align='center' class='has-background-info has-text-white'><strong>$category</strong></td></tr>";

    foreach ($categoryBooks as $book) {
        echo '<tr>';
        echo '<td></td>'; // Üres cella a kategória miatt
        echo '<td>' . $book['title'] . '</td>';
        echo '<td>' . $book['author'] . '</td>';
        echo '<td>' . $book['publication_year'] . '</td>';
        echo '</tr>';
    }
}

echo '</tbody></table>';

?>
</body>
</html>