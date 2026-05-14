<?php

namespace App\Filament\Admin\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Product Tabs')
                ->tabs([
                    Tabs\Tab::make('Product Info')
                        ->icon('heroicon-o-academic-cap')
                        ->schema([
                            TextEntry::make('name')
                                ->label('Product Name')
                                ->weight('bold')
                                ->color('primary'),
                            TextEntry::make('sku')
                                ->label('SKU')
                                ->badge()
                                ->color('success'),
                            TextEntry::make('description')
                                ->label('Description'),
                        ])
                        ->columnSpanFull(),
                    Tabs\Tab::make('Pricing & Stock')
                        ->icon('heroicon-o-currency-dollar')
                        ->badge('10')
                        ->badgeColor('info')
                        ->schema([
                            TextEntry::make('price')
                                ->label('Price')
                                ->icon('heroicon-o-currency-dollar'),
                            TextEntry::make('stock')
                                ->label('Stock'),
                        ]),
                    Tabs\Tab::make('Media & Status')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            ImageEntry::make('image')
                                ->label('Product Image')
                                ->disk('public'),
                            IconEntry::make('is_active')
                                ->label('Active')
                                ->boolean(),
                            IconEntry::make('is_featured')
                                ->label('Featured')
                                ->boolean(),
                            TextEntry::make('created_at')
                                ->label('Product Creation Date')
                                ->date('d M Y')
                                ->color('info'),
                        ]),
                ])
                ->vertical()
            ])->columns(1);
    }
}
