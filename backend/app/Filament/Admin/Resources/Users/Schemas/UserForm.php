<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\CheckboxList;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('ユーザー情報')
                    ->description('ユーザーの基本プロフィールと権限設定')
                    // ★ここがレスポンシブの要（PCでは4分割、スマホでは1分割）
                    ->columns([
                        'default' => 1, // スマホ
                        'sm'      => 4, // PC・タブレット
                    ])
                    ->schema([
                        // --- 1行目 ---
                        
                        // 1. お名前（PC: 1/4幅 = 25%）
                        TextInput::make('name')
                            ->label('お名前')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan([
                                'default' => 1, 
                                'sm'      => 1, // 4分の1
                            ]),

                        // 2. 権限（PC: 3/4幅 = 75%）
                        // お名前の横のスペースを有効活用
                        CheckboxList::make('role')
                            ->label('権限')
                            ->options([
                                'admin' => '管理者',
                                'shop'  => '店舗',
                                'user'  => '一般ユーザー',
                            ])
                            ->required()
                            // チェックボックス自体の並び（PCなら横に3つ並べる）
                            ->columns([
                                'default' => 2, // スマホは2列
                                'sm'      => 3, // PCは3列
                            ])
                            ->gridDirection('row')
                            ->columnSpan([
                                'default' => 1,
                                'sm'      => 3, // 4分の3を使う
                            ]),

                        // --- 2行目 ---

                        // 3. 会社名（PC: 2/4幅 = 50%）
                        TextInput::make('company')
                            ->label('会社名')
                            ->maxLength(255)
                            ->columnSpan([
                                'default' => 1,
                                'sm'      => 2, // 半分
                            ]),

                        // 4. 電話番号（PC: 2/4幅 = 50%）
                        TextInput::make('phone')
                            ->label('電話番号')
                            ->tel()
                            ->maxLength(255)
                            ->columnSpan([
                                'default' => 1,
                                'sm'      => 2, // 半分
                            ]),

                        // --- 3行目 ---
                        // 住所
                        TextInput::make('address')
                            ->label('住所')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        // 4行目
                        // 5. メールアドレス（PC: 4/4幅 = 100%）
                        // 長くなりがちなので1行使う
                        TextInput::make('email')
                            ->label('メール')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        
                        // 5行目
                        // メモ
                        Textarea::make('memo')
                            ->label('メモ')
                            ->maxLength(3000)
                            ->columnSpanFull(),

                    ]),
            ]);
    }
}