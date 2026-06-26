<?php

namespace App\Filament\Admin\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ReplicateAction;
use Filament\Actions\Action;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->toggleable(),

                TextColumn::make('slug')
                    ->searchable()
                    ->sortable()
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('category.name')
                    ->searchable()
                    ->sortable()
                    ->label('Category')
                    ->toggleable(),

                ColorColumn::make('color')
                    ->label('Color')
                    ->toggleable(),

                ImageColumn::make('image')
                    ->disk('public')
                    ->label('Image')
                    ->size(40)
                    ->toggleable(),

                IconColumn::make('published')
                    ->boolean()
                    ->label('Published')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('tags.name')
                    ->label('Tags')
                    ->badge()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Select Category')
                    ->relationship('category', 'name')
                    ->preload(),

                Filter::make('created_at')
                    ->label('Creation Date')
                    ->schema([
                        DatePicker::make('created_at')
                            ->label('Select Date'),
                    ])
                    ->query(function ($query, $data) {
                        return $query->when(
                            $data['created_at'],
                            fn ($query, $date) => $query->whereDate('created_at', $date)
                        );
                    }),

                TernaryFilter::make('published')
                    ->label('Published'),
            ])
            ->recordActions([
                EditAction::make()
                    ->icon('heroicon-o-pencil'),
                
                ReplicateAction::make()
                    ->icon('heroicon-o-document-duplicate')
                    ->label('Replicate'),
                
                Action::make('status')
                    ->label('Toggle Publish')
                    ->icon('heroicon-o-check-circle')
                    ->color('warning')
                    ->schema([
                        Checkbox::make('published')
                            ->label('Publish this post')
                            ->default(fn($record): bool => $record->published),
                    ])
                    ->action(function ($record, $data) {
                        $record->update(['published' => $data['published']]);
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Update Publish Status')
                    ->modalDescription('Are you sure you want to change the publish status?')
                    ->modalSubmitActionLabel('Update'),
                
                DeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->requiresConfirmation(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
