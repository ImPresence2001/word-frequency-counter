<?php
    
    $shopping_cart = [
    ['product' => 'Widget A', 'price' => 10],
    ['product' => 'Widget B', 'price' => 15],
    ['product' => 'Widget C', 'price' => 20],
    ];

    $total_price = 0;
    foreach ($shopping_cart as $item) {
        $total_price += $item['price'];
    }

    echo "Total price: $" . $total_price;
    

    $string = "This is a poorly written program with little
    structure and readability.";

    $string = str_replace(search: ' ', replace: '', subject: $string);
    $string = strtolower(string: $string);

    echo "\nModified string: " . $string;
    
    $number = 42;
    if ($number % 2 == 0){
    echo "\nThe number " . $number . " is even.";
    } else {
    echo "\nThe number " . $number . " is odd.";
    }