<?php

namespace App\Livewire\Profile;

use App\Models\Favorite;
use Livewire\Component;
use Livewire\WithPagination;

class ProfileFavorites extends Component
{

  use WithPagination;
  protected string $paginationTheme = "bootstrap";


  public function removeFromFavorite($id)
  {
    Favorite::find($id)->delete();
  }

  public function render()
  {
    $favorites = Favorite::where("user_id", auth()->id())->latest()->paginate(12);
    return view('livewire.profile.profile-favorites',compact("favorites"));
  }
}
