<?php
echo '     
<div id="result">';
$count = 0;
$p = 0;
$voters = $voting->voters($_GET["voting_result"]);
echo '<h1>Správných hlasů: ' . $right . '</h1>
<fieldset class="graph">
  <ul id="legenda">';
    $p = 0;
    foreach ($voters as $voter)
    {
      $palette[] = random_color();
      echo '<li style="color:' . $palette[$p] . ';"><span class="question">' . $voter . '</span>';
      $p = $p + 1;
    }
    echo  '
  </ul>
  <div class="chart">';
    $p = 0;
    foreach ($voters as $voter)
    {
      $count = $voting->count_answered_right($_GET["voting_result"], $voter);
      echo '<div style="width: ' . ($count * 10) . 'px;background-color:' . $palette[$p] . '">' . $count . '</div>';
      $p = $p + 1;
    }
    echo '
    </div>
  </fieldset>
</div>
';
?>