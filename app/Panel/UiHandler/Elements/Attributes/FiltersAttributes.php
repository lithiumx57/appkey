<?php

namespace App\Panel\UiHandler\Elements\Attributes;

trait FiltersAttributes
{


  /**
   * @param $value
   * تعیین کنید که حد اقل تعداد کاراکتر وارد شده چقدر باشد
   * @return $this
   */
  function minFilter($value)
  {
    $this->role->min = $value;
    return $this;
  }

  /**
   * @param $value
   *     تعیین کنید که حد اکثر تعداد کاراکتر وارد شده چقدر باشد
   * @return $this
   */
  function maxFilter($value)
  {
    $this->role->max = $value;
    return $this;
  }

  /**
    * این فیلتر تعیین می کند که این فیلد حتما باید از جنس ایمیل باشد
   * @return $this
   */

  function emailFilter()
  {
    $this->role->email = true;
    return $this;
  }

  function numericFilter()
  {
    $this->role->numeric = true;
    return $this;
  }


  function dateFilter()
  {
    $this->role->date = true;
    return $this;
  }

  function mimesFilter(...$value)
  {
    $this->role->mimes = $value;
    return $this;
  }

  function uniqueFilter($field)
  {
    $this->role->unique = $field;
    return $this;
  }

  function imageFilter()
  {
    $this->role->image = true;
    return $this;
  }

  function updateNotRequired()
  {
    $this->role->patchNotRequired = true;
    return $this;
  }

}
