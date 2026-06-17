<?php

namespace App\Filament\Resources\OfficeSpaces\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

use function Laravel\Prompts\textarea;

class OfficeSpaceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                ->required()
                ->maxLength(255),
                TextInput::make('address')
                ->required()
                ->maxLength(255),
                FileUpload::make('thumbnail')
                ->image()
                ->required(),
                Textarea::make('about')
                ->required()
                ->rows(10)
                ->cols(20),
                Repeater::make('photos')
                ->relationship('photos')
                ->schema([
                    FileUpload::make('photo')
                    ->required(),
                ]),

                Repeater::make('benefits')
                ->relationship('benefits')
                ->schema([
                    TextInput::make('name')
                    ->required()
                ]),

                Select::make('city_id')
                ->relationship('city', 'name')
                ->searchable()
                ->preload()
                ->required(),
                
                TextInput::make('price')
                ->required()
                ->numeric()
                ->prefix('IDR'),
                
                TextInput::make('duration')
                ->required()
                ->numeric()
                ->prefix('Days'),
                
                Select::make('is_open')
                ->options([
                    true => 'Open',
                    false => 'Not Open'
                ])
                ->required(),
                
                Select::make('is_full_booked')
                ->options([
                    true => 'Not Available',
                    false => 'Available'
                ])
                ->required(),
            ]);
    }
}
