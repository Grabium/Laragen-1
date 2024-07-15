<?php

$migration_tables = 
'            $table->id();
            $table->timestamps();';

$without_foreing_migrate = 
'            $table->timestamp(created_at);';

$with_foreing_migrate = 
'            $table->timestamp(created_at);

            //$table->foreign("col_local")->references("col_foreing")->on("table_foreing");';


    $content = '';
    foreach($this->arrayData as $key => $col){
      $content = $content.
'            $table->'.$col[0].'('.$col[1].');'.PHP_EOL;
    }
    $this->contentFile = str_replace($migration_tables, $content, $this->contentFile);
    $this->contentFile = str_replace($without_foreing_migrate, $with_foreing_migrate, $this->contentFile);

    