<?php
namespace Laragen\Views;

class Question
{
  public static function oneNameOrEnter(string $question): string|null
  {
    print $question.PHP_EOL;
    $inputChoice = trim(fgets(fopen('php://stdin', 'r')));
    if(!$inputChoice){ //press [ENTER]
      return null;
    }
    return $inputChoice;
  }

  public static function choiceInput(array $arrChoices = null)
  {

    if(($arrChoices == null)||($arrChoices == [])||($arrChoices == 0)){
      return 'choiceInput([$question, $option_0, $option_1...$option_n ])';
    }
    $question = array_shift($arrChoices);
    print $question.PHP_EOL;
    $inputChoice = trim(fgets(fopen('php://stdin', 'r')));
    if(!in_array($inputChoice, $arrChoices)){
      return null;
    }
    return $inputChoice;
  }
}