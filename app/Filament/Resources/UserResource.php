<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Faker\Provider\Text;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'User Management';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make("name")->required()->maxLength(255),
                    TextInput::make("email")->label("Email")->required()->maxLength(255),

                    TextInput::make("password")
                        ->password()
                        ->required(fn(Page $page): bool => $page instanceof CreateRecord)
                        ->maxLength(255)
                        ->minLength(5)
                        ->same("password_confirmation")
                        ->dehydrated(fn($state) => filled($state))
                        ->dehydrateStateUsing(fn($state) => bcrypt($state)),

                TextInput::make("password_confirmation")
                    ->password()
                    ->label("Password Confirmation")
                    ->required(fn(Page $page) => $page instanceof CreateRecord)
                    ->minLength(5)
                    ->dehydrated(false)
            ])

            ]);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name")->searchable(),
                TextColumn::make("email")->searchable(),
                TextColumn::make("created_at")->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
