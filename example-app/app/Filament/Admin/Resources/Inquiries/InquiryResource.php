<?php

namespace App\Filament\Admin\Resources\Inquiries;

use App\Filament\Admin\Resources\Inquiries\Pages;
use App\Models\Inquiry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;


use BackedEnum;


class InquiryResource extends Resource
{
    protected static ?string $model = Inquiry::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $recordTitleAttribute = 'name';

    // ■入力フォーム
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->schema([
                // お名前
                Group::make()
                    ->schema([
                        TextInput::make('first_name')
                            ->label('お名前（姓）')
                            ->required()
                            ->maxLength(255),
        
                        TextInput::make('last_name')
                            ->label('お名前（名）')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2)
                    ->columnSpan(2),

                TextInput::make('corp_name')
                    ->label('会社名')
                    ->maxLength(255)
                    ->columns(2)
                    ->columnSpan(2),

                // メールアドレス
                TextInput::make('email')
                    ->label('メールアドレス')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->columns(2)
                    ->columnSpan(2),
                
                // 内容
                Textarea::make('content')
                    ->label('お問い合わせ内容')
                    ->required()
                    ->columns(2)
                    ->columnSpan(2),
            ]);
    }

    // ■一覧テーブル
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Group::make()
                ->schema([
                    // 名前カラム
                    TextColumn::make('first_name')
                        ->label('お名前（姓）')
                        ->sortable()
                        ->searchable(),
    
                    TextColumn::make('last_name')
                        ->label('お名前（名）')
                        ->sortable()
                        ->searchable(),
                ])
                ->columns(2),

                TextColumn::make('corp_name')
                    ->label('会社名')
                    ->sortable()
                    ->searchable(),

                // メールアドレスカラム
                TextColumn::make('email')
                    ->label('メールアドレス')
                    ->icon('heroicon-m-envelope')
                    ->sortable()
                    ->copyable(),

                // 受信日
                TextColumn::make('created_at')
                    ->label('受信日時')
                    ->dateTime('Y年m月d日 H:i')
                    ->sortable(),
                
                ])
                ->actions([
                    Action::make('view')
                        ->label('詳細を見る')
                        ->icon('heroicon-o-eye')
                        ->url(fn (Inquiry $record) => static::getUrl('edit', ['record' => $record])),
                ])
                ->bulkActions([
                    BulkActionGroup::make([
                        DeleteBulkAction::make(),
                    ]),
                ]);
        
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInquiries::route('/'),
            'create' => Pages\CreateInquiry::route('/create'),
            'edit' => Pages\EditInquiry::route('/{record}/edit'),
        ];
    }
}
