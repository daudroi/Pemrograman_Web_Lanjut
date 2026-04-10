<?php

namespace App\Filament\Admin\Resources\Posts\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use App\Models\Post;
use App\Models\Category;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Section 1: Basic Information
                Section::make('Basic Information')
                    ->description('Fill in the basic details of your post')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->label('Post Title')
                            ->placeholder('Enter post title'),

                        TextInput::make('slug')
                            ->required()
                            ->unique(Post::class, 'slug', ignoreRecord: true)
                            ->maxLength(255)
                            ->label('Slug')
                            ->placeholder('auto-generated-slug'),
                    ])->columns(2),

                // Section 2: Category & Color
                Section::make('Category & Styling')
                    ->description('Select category and customize appearance')
                    ->schema([
                        Select::make('category_id')
                            ->label('Category')
                            ->options(Category::all()->pluck('name', 'id'))
                            ->required()
                            ->searchable(),

                        ColorPicker::make('color')
                            ->label('Highlight Color'),
                    ])->columns(2),

                // Section 3: Content
                Section::make('Content')
                    ->description('Write your post content using Markdown')
                    ->schema([
                        MarkdownEditor::make('body')
                            ->label('Post Content')
                            ->columnSpanFull()
                            ->required(),
                    ]),

                // Section 4: Media & Tags
                Section::make('Media & Tags')
                    ->description('Upload featured image and add tags')
                    ->schema([
                        FileUpload::make('image')
                            ->disk('public')
                            ->directory('post')
                            ->label('Featured Image')
                            ->image()
                            ->maxSize(5120),

                        TagsInput::make('tags')
                            ->label('Tags')
                            ->placeholder('Add tags...')
                            ->separator(','),
                    ])->columns(2),

                // Section 5: Publishing
                Section::make('Publishing')
                    ->description('Set publishing status and date')
                    ->schema([
                        Checkbox::make('published')
                            ->label('Publish this post')
                            ->inline(),

                        DatePicker::make('published_at')
                            ->label('Published At'),
                    ])->columns(2),
            ]);
    }
}
