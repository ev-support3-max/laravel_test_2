<?php

namespace App\Filament\Admin\Resources\Inquiries;

use App\Filament\Admin\Resources\Inquiries\Pages;
use App\Models\Inquiry;
use BackedEnum;
use Illuminate\Database\Eloquent\Model;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Group;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Support\Icons\Heroicon;


class InquiryResource extends Resource
{
    protected static ?string $model = Inquiry::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    protected static ?string $recordTitleAttribute = 'name';

    // ■入力フォーム
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->schema([
                // 姓・名
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
                    ->columnSpan(2),

                // メールアドレス
                TextInput::make('email')
                    ->label('メールアドレス')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(2),
                
                // 内容
                Textarea::make('content')
                    ->label('お問い合わせ内容')
                    ->required()
                    ->columnSpan(2),
            ]);
    }

    // ■一覧テーブル
    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->columns([
                // 名前カラム
                TextColumn::make('full_name')
                    ->label('お名前')
                    ->getStateUsing(fn (Model $record) =>
                        "{$record->last_name} {$record->first_name}"
                    )
                    ->searchable(['last_name', 'first_name'])
                    ->sortable(
                        query: fn ($query, string $direction) =>
                            $query
                                ->orderBy('last_name', $direction)
                                ->orderBy('first_name', $direction)
                    ),

                TextColumn::make('corp_name')
                    ->label('会社名')
                    ->searchable()
                    ->toggleable(),
                
                TextColumn::make('email')
                    ->label('メールアドレス')
                    ->copyable()
                    ->toggleable(),
                
                TextColumn::make('created_at')
                    ->label('受信日時')
                    ->dateTime('Y/m/d H:i')
                    ->sortable()
                    ->toggleable(),
                ])
                ->actions([
                    Action::make('view')
                        ->label('詳細')
                        ->icon(Heroicon::OutlinedEye)
                        ->url(fn (Inquiry $record) =>
                            static::getUrl('edit', ['record' => $record])
                    ),
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
