<?php

namespace app\core;

class Game
{
    public static array $combs = [
            [0, 1, 2],
            [3, 4, 5],
            [6, 7, 8],
            [0, 3, 6],
            [1, 4, 7],
            [2, 5, 8],
            [0, 4, 8],
            [2, 4, 6],
        ];

    static function findCombination(array $fields){

        $countO = 0;
        $countX = 0;
        $bestComb = [];
        $theBestCombs = [];

        $combs = self::$combs;
        for ($i = 0; $i < count($combs) ;$i++){
            if($fields[$combs[$i][0]]=='0')
                $countO++;
            if($fields[$combs[$i][1]]=='0')
                $countO++;
            if($fields[$combs[$i][2]]=='0')
                $countO++;
            if($countO > 1){
                $check = false;
                $var = 0;
                for ($j = 0; $j < 3; $j++){
                    if($fields[$combs[$i][$j]] =='X'){
                        $check = true;
                    }
                    if($fields[$combs[$i][$j]] == ''){
                        $var = $combs[$i][$j];
                    }
             }
                if(!$check){
                     $theBestCombs['100'] = $combs[$i][$j];

                }
                else{
                    $countO = 0;
                }

            }

            if($fields[$combs[$i][0]]=='X')
                $countX++;
            if($fields[$combs[$i][1]]=='X')
                $countX++;
            if($fields[$combs[$i][2]]=='X')
                $countX++;

            if($countX > 1){
                $check = false;
                $var = 0;
                for ($j = 0; $j < 3; $j++){
                    if($fields[$combs[$i][$j]] =='0'){
                        $check = true;
                    }
                    if($fields[$combs[$i][$j]] == ''){
                        $var = $combs[$i][$j];
                    }
                }
                if(!$check){
                    $theBestCombs['50'] = $combs[$i][$j];

                }
                else{
                    $countX = 0;
                }
            }

            if($countO>$countX)
                $bestComb[] = $countO;
            else
                $bestComb[] = $countX;
            $countX = 0;
            $countO = 0;
        }
        if($theBestCombs['100']!=null)
            return $theBestCombs['100'][0];
        if($theBestCombs['50']!=null)
            return $theBestCombs['50'][0];

        $key1 = 0;
        $max = max($bestComb);

        foreach ($bestComb as $key => $value){
            if($max == $value)
            {
                $key1 = $key;
                break;
            }
        }
        $res = null;
        for ($i = 0; $i<3; $i++){
            if($fields[$combs[$key1][$i]] == '')
                $res = $combs[$key1][$i];

        }
        if($res!=null)
             return $res;
        else
            foreach ($fields as $key5=> $item) {
                if($item == '') return $key5;
            }


    }
    public static function checkBotWin(array $fields){
        $combs = self::$combs;

        for ($i = 0; $i < count($combs) ;$i++){
            if($fields[$combs[$i][0]] == $fields[$combs[$i][1]] &&
            $fields[$combs[$i][1]] == $fields[$combs[$i][2]] &&
            $fields[$combs[$i][0]]!= '')
                return true;
        }
        return false;
    }
}