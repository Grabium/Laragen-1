<?php

    $migration_tables = 
'            $table->id();
            $table->timestamps();';

    $without_foreing_migrate = 
'            $table->timestamp("created_at");';

    $with_foreing_migrate = 
'            $table->timestamp("created_at");

  //$table->foreign("col_local")->references("col_foreing")->on("table_foreing");';


    $newContent = '';
    foreach($this->arrayData as $key => $col){
      $newContent = $newContent.
'            $table->'.$col['type'].'("'.$col['name'].'");'.PHP_EOL;
    }
    $contentFile = str_replace($migration_tables, $newContent, $contentFile);
    $contentFile = str_replace($without_foreing_migrate, $with_foreing_migrate, $contentFile);

    