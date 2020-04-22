<?php
namespace MyApp;

class Bingo{
    public function create(){
        $nums =[];
        for($i = 0; $i<5; $i++){
        // range()は指定した範囲を値とする配列を生成
        // 範囲：第１引数～第２引数
        $col = range($i * 15 + 1, $i * 15+ 15);
        // shuffle()で配列の要素をシャッフル
        shuffle($col);
        // array_sliceで配列の"一部"を切り取る
        // 第２引数が0の場合、1つ目から切り取る。第3引数で切り取る数を指定。
        $nums[$i] = array_slice($col,0,5);
}

$nums[2][2] = "FREE";
return $nums;
    }
}
?>