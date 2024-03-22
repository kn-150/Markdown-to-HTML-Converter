<?php

// Composerのオートローダーを読み込む
require 'vendor/autoload.php';

// Parsedownクラスのインスタンスを作成
$parsedown = new Parsedown();


// 引数の入力が正しいかどうかをチェックするバリデータ
if($argc !== 4) {
    echo "入力が正しくありません。正しい入力方法は、" . "\n";
    echo "php fileConverter.php markdown <input.md> <output.html>" . "\n";
    exit(1);
}

// 入力されたコマンドを取得する
$command = $argv[1];
$inputMd = $argv[2];
$outputHtml = $argv[3];

// コマンドがただしいかどうかチェック
if($command !== "markdown") {
    echo "入力が正しくありません。正しい入力方法は、" . "\n";
    echo "php fileConverter.php markdown <input.md> <output.html>" . "\n";
    exit(1);
}

// マークダウンの内容を取得してくる
$markdownContent = file_get_contents($inputMd);

// マークダウンが正常に開かれなかった場合たら処理しないよっていう
if ($markdownContent === false) {
    echo "Failed to open input file: $inputFileName\n";
    exit(1);
}

// マークダウンをHTMLに変換
$htmlContent = $parsedown->text($markdownContent);

file_put_contents($outputHtml, $htmlContent);

echo "マークダウンに変更完了しました！" . PHP_EOL;