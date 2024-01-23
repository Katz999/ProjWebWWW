<?php

session_start();

class ShoppingCart
{
    public function __construct()
    {
        // Inicjalizacja koszyka w sesji, jeśli nie istnieje
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
    }

    public function addToCart($productId, $productName, $netPrice, $quantity = 1)
    {
        // Sprawdzenie, czy produkt już istnieje w koszyku
        if (isset($_SESSION['cart'][$productId])) {
            // Jeśli tak, zwiększ ilość
            $_SESSION['cart'][$productId]['quantity'] += $quantity;
        } else {
            // Jeśli nie, dodaj nowy produkt do koszyka
            $_SESSION['cart'][$productId] = array(
                'name' => $productName,
                'netPrice' => $netPrice,
                'quantity' => $quantity
            );
        }
    }

    public function removeFromCart($productId)
    {
        // Usunięcie produktu z koszyka
        unset($_SESSION['cart'][$productId]);
    }

    public function showCart()
    {
        // Wyświetlenie zawartości koszyka
        foreach ($_SESSION['cart'] as $productId => $product) {
            echo "Produkt: {$product['name']}, Ilość: {$product['quantity']}, Cena: {$product['netPrice']} zł<br>";
        }
    }

    public function getTotalPrice()
    {
        $totalPrice = 0;

        // Zliczenie wartości produktów w koszyku
        foreach ($_SESSION['cart'] as $product) {
            $totalPrice += $product['netPrice'] * $product['quantity'];
        }

        return $totalPrice;
    }
}

$cart = new ShoppingCart();

$cart->addToCart(1, 'Laptop', 2500, 2);
$cart->addToCart(2, 'Smartfon', 1200, 1);

echo "Zawartość koszyka:<br>";
$cart->showCart();

echo "Łączna wartość koszyka: " . $cart->getTotalPrice() . " zł<br>";

$cart->removeFromCart(1);
echo "Zawartość koszyka po usunięciu produktu:<br>";
$cart->showCart();

