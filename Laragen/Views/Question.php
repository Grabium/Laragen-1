<?php
namespace Laragen\Views;

class Question
{
  public static function oneNameOrEnter(string $question): string|null
  {
    print $question.PHP_EOL;
    $inputChoice = trim(fgets(fopen('php://stdin', 'r')));
    if(!$inputChoice){ 
      return null;//pressed [ENTER]
    }
    return $inputChoice;
  }

  public static function choiceInput(array $arrChoices): string|null
  {
    $question = array_shift($arrChoices);
    print $question.PHP_EOL;
    $inputChoice = trim(fgets(fopen('php://stdin', 'r')));
    if(!in_array($inputChoice, $arrChoices)){
      return null; //pressed [ENTER]
    }
    return $inputChoice;
  }
}