<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{

    public function home()
    {
        return view('static_pages/home', ['home' => "主页"]);
    }

    public function help()
    {
        return view('static_pages/help', ['content' => "帮助"]);
    }

    public function about()
    {
        return "关于我们";
    }

    public function rand()
    {
        try {
            $n = 100;
            if ($n > 100) {
                exit("不能超过100");
            }
            $tmpArray = [];
            for ($i=1; $i<= $n; $i++) {
                $randNum = $this->checkRepeatNum($tmpArray);
                $tmpArray[] = $randNum;
            }
            echo count($tmpArray) . PHP_EOL;
            echo count(array_unique($tmpArray)) . PHP_EOL;

            if (max($tmpArray) <= 50) {
                $tmpArray[rand(0, count($tmpArray) -1)] = rand(51, 100);
            }
            var_dump($tmpArray);
            var_dump(array_diff_assoc($tmpArray, array_unique($tmpArray)));
        } catch (\Exception $e) {
            echo "系统异常" . $e->getMessage();
        }
    }

    private function generateNum()
    {
        return rand(1, 100);
    }

    private function checkRepeatNum($tmpArray)
    {
        $randNum = $this->generateNum();
        if (in_array($randNum, $tmpArray)) {
            $randNum = $this->checkRepeatNum($tmpArray);
        }
        return $randNum;
    }


}
