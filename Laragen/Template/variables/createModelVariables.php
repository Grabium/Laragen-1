<?php

$entity = $this->arrayData[0];
  $blankModel = 
'{
    use HasFactory;';

  $fillable = '';
  foreach($entity->fillable as $k => $f){
    $fillable .= "'$f', ";
  }
  $fillable = substr($fillable, 0, -2);
  //$fillable .= '';


  $hidden = '';
  foreach($entity->hidden as $k => $h){
    $hidden .= "'$h', ";
  }
  $hidden = substr($hidden, 0, -2);

  $newContent =
'{

  protected $table = \''.$entity->tableName.'\';
  protected $fillable = ['.$fillable.'];
  protected $hidden = ['.$hidden.'];
  
  /*public function <entity>()
  {
    //return $this->hasOne(<Entity>::class, "foreign_key", "selflocal_key");
    //return $this->belongsTo(<Entity>::class ...);
    //return $this->hasMany(<Entity>::class);
    //return $this->belongsToMany(<Entity>::class);
  }*/';

  $contentFile = str_replace($blankModel, $newContent, $contentFile);