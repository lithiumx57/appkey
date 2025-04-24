<?php
use App\Panel\helpers\XFieldMerger;
?>


<div style="width: {{$attribute["width"]}};height: {{$attribute["width"]}};margin: auto;">
  <?php
  $result = (new XFieldMerger())->merge($attribute["fields"]);
  foreach ($result as $row) {
    if ($row instanceof \App\Panel\UiHandler\Elements\Element) {
      $row->render();
    }
  }

  ?>
</div>

