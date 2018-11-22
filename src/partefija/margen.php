<ul class="etiquetasFrecuentes">
  <?php
  $frecuentes = etiquetasFrecuentes();
  foreach ($frecuentes as $etiqueta) {
    ?>
    <li class=etiqueta><a href="/index.php?etiquetas=<?=strtolower($etiqueta["etiqueta"])?>">#<?=$etiqueta["etiqueta"]?></a></li>
    <?php
  }
 ?>
</ul>
