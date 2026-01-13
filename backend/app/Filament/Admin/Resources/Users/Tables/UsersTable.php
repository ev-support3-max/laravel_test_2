<?php

namespace App\Filament\Admin\Resources\Users\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),

                TextColumn::make('name')
                    ->label('お名前')
                    ->searchable(),

                TextColumn::make('email')
                    ->label('メールアドレス')
                    ->searchable(),

                TextColumn::make('role')
                    ->label('権限')
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'admin' => '管理者',
                        'shop'  => '店舗',
                        'user'  => '一般ユーザー',
                        default => $state,
                    }),
            ])
            
            ->filters([
                SelectFilter::make('role')
                    ->options([
                        'user' => '一般ユーザー',
                        'shop' => '店舗',
                        'admin' => '管理者',
                    ]),
            ])
            
            ->actions([
                EditAction::make(),
            ])
            
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->recordUrl(null);
    }
}
