<?php

namespace App\Panel\views\Livewire\Classes\PublicComponents;

use App\Models\User;
use App\Panel\helpers\XFileHelper;
use App\Panel\Models\Background;
use Livewire\Component;
use Livewire\WithPagination;
use Psy\Output\Theme;

class HeaderThemeDialog extends Component
{
  public $show = false;
  public $showed = false;
  use WithPagination;

  protected string $paginationTheme = "bootstrap";

  protected $listeners = [
    'show-background-dialog' => "show",
    'upload-background' => "upload",
    "refresh" => '$refresh',
    "theme-changed" => "themeChanged",
  ];

  public function themeChanged($data)
  {
    cache()->put("theme",$data);
    $this->dispatch("submit-theme-changed");
  }


  public function upload($data)
  {
    $result = XFileHelper::uploadBase64("backgrounds", $data);
    $this->showed = true;

    Background::create([
      "path" => $result,
      "is_public" => false,
      "user_id" => auth()->user()->id,
    ]);

  }

  public function dismiss()
  {
    $this->showed = false;
    $this->show = false;
  }


  public function show()
  {
    $this->dispatch("dialog-show");
    $this->show = true;
  }

  public function makeDefault($id)
  {
    $this->showed = true;
    auth()->user()->update(["background_id" => $id]);
    $this->redirect("/panel");
  }


  public function switch($id)
  {
    $this->showed = true;
    $background = Background::find($id);
    $background->update(["is_public" => !$background->is_public]);
  }


  public function delete($id)
  {
    $this->showed = true;
    $background = Background::find($id);
    $background->delete();
    User::where('background_id', $id)->update(["background_id" => 0]);
  }


  public function gotoPage($page, $pageName = 'page')
  {
    $this->showed = true;
    $this->setPage($page, $pageName);
  }


  public function render()
  {
    $records = Background::where("user_id", auth()->user()->id)
      ->orWhere("is_public", true)->latest("id")->paginate(6);
    return view('livewire.views.public-components.header-theme-dialog', compact("records"));
  }
}
