<?php


namespace App\Panel\helpers;


use App\Panel\Dynamic\LiModel;

trait XObjectHandler
{

  public abstract function xObjectPreEdit(callable $next);

  public static abstract function xPreCreateFormRendered(callable $next);

  public static abstract function xObjectPreCreate(callable $next);
  public abstract function xObjectCreating(callable $next);
  public abstract function xObjectCreated(callable $next);

  public abstract function xObjectPreUpdate(callable $next);
  public abstract function xObjectUpdating(callable $next);
  public abstract function xObjectUpdated(callable $next);

  public abstract function xObjectSyncing(callable $next);

  public abstract function xObjectPreCopy(callable $next);
  public abstract function xObjectCoping($newObject, callable $next);
  public abstract function xObjectCoppied($newObject, callable $next);



  public abstract function xObjectPreSwitch(callable $next);
  public abstract function xObjectDeleting(callable $next);
  public abstract function xObjectRestoring(callable $next);
  public abstract function xObjectPreSwitchableFieldChange(callable $next);
  public abstract function xObjectSwitchableFieldChange(callable $next);


}
