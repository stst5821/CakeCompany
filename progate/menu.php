<?php

class Menu { // クラスを定義する
    public $name;
    private $price;
    public $image;
    private $orderCount = 0;

    // メソッドを定義する
    
    public function hello() {
        echo '私の名前は'.$this->name.'です。'; // $thisは、メソッド内でのみ使える
    }

    // 税込み価格を得るメソッド
    public function taxIn() {
        return floor($this->price * 1.10); // floor関数は、小数点を切り捨てた値を得る
    }

    public function getName() {
        return $this->name;
    }
    

// priceの値を取得する ゲッター
public function getPrice() {
return $this->price;
}

// orderCountの値を取得する ゲッター 取得して返すだけの役割
public function getOrderCount() {
return $this->orderCount;
}

// priceの値を更新する セッター
public function setPrice($price) {
$this->price = $price;
return $this->price;
}

public function setOrderCount($orderCount) {
$this->orderCount = $orderCount;
}

// 小計を出す
public function getTotalPrice() {
return $this->orderCount * $this->taxIn(); // orderCountは変数なので、()は不要。
}

// コンストラクタを定義する

public function __construct($name,$price,$image) { // 引数を受け取る。この場合は「カレー」が入る
$this->name = $name; // インスタンスのnameプロパティに値を定義している
$this->price = $price;
$this->image = $image;
}
}

?>