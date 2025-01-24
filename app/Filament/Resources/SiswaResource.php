<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaResource\Pages;
use App\Filament\Resources\SiswaResource\RelationManagers;
use App\Models\Siswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nim'),
                Forms\Components\TextInput::make('name'),
                Forms\Components\Select::make('jurusan_id')
                ->relationship('jurusan','name')
                ->required(),
                Forms\Components\Select::make('eskul_id')
                ->relationship('eskul','name')
                ->required(),
                Forms\Components\Select::make('kelas_id')
                ->relationship('kelas','name')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nim'),
                Tables\Columns\TextColumn::make('name') ->searchable(),
                Tables\Columns\TextColumn::make('jurusan.name') ->searchable(),
                Tables\Columns\TextColumn::make('eskul.name') ->searchable(),
                Tables\Columns\TextColumn::make('kelas.name') ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jurusan_id')
                    ->relationship('jurusan','name'),
                Tables\Filters\SelectFilter::make('eskul_id')
                    ->relationship('eskul','name'),
                Tables\Filters\SelectFilter::make('kelas_id')
                    ->relationship('kelas','name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
