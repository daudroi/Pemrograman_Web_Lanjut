<?php

namespace App\Filament\Admin\Resources\Posts\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group; 
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use App\Models\Post;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make([
                    Section::make('Fields')
                        ->description('Detail post form')
                        ->icon('heroicon-o-document-text')
                        ->schema([
                            TextInput::make('title')
                                ->required()
                                ->rules('min:3|max:100'),
                            TextInput::make('slug')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->validationMessages([
                                    'unique' => 'Slug harus unik.',
                                ]),
                            Select::make('category_id')
                                ->relationship('category', 'name')
                                ->preload() // Memuat data di awal untuk efisiensi jika opsi sedikit
                                ->searchable() // Mengaktifkan fitur pencarian pada dropdown untuk dataset besar
                                ->required(),
                            ColorPicker::make('color'),
                        ])->columns(2),
                    MarkdownEditor::make('body')
                        ->columnSpanFull(),
                ])->columnSpan(2),

                Group::make([
                    Section::make('Image Upload')
                        ->description('Upload your image here')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            FileUpload::make('image')
                                ->disk('public')
                                ->directory('post')
                                ->required(),
                        ]),
                    Section::make('Meta')
                        ->description('Additional info')
                        ->icon('heroicon-o-tag')
                        ->schema([
                            TagsInput::make('tags'),
                            Checkbox::make('published'),
                            DatePicker::make('published_at'),
                        ]),
                ])->columnSpan(1),
            ])->columns(3);
    }
}
