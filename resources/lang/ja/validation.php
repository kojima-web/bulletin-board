<?php

return [
    'required' => ':attribute は必須です。',
    'max' => [
        'string' => ':attribute は :max 文字以内で入力してください。',
    ],
    'email' => ':attribute の形式が正しくありません。',
    'confirmed' => ':attribute と確認用が一致しません。',
    'unique' => ':attribute は既に使用されています。',
    'min' => [
        'string' => ':attribute は :min 文字以上で入力してください。',
    ],
    'attributes' => [
        'body' => '本文',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'password_confirmation' => 'パスワード（確認用）',
    ],
];
