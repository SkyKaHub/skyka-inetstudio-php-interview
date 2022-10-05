<?php 
    class PHPInterview {
        
        //Выделение уникальных записей
        public function firstTask($array = []) : array {
            $array_ids = array_map([$this, 'getArrayID'], $array);
            $array_ids = array_map(function($item) {return $item['id'];}, $array);
            $unique_array_ids = array_unique($array_ids, SORT_NUMERIC);
            return array_values(array_intersect_key($array, $unique_array_ids));
        }
        
        //Сортировка массива по ключу
        public function secondTask($array = [], $key = '', $order = SORT_ASC) : array {
            if ( $order ==  SORT_ASC) {
                usort($array, function ($item1, $item2) use ($key, $order) {
                    return (array_key_exists($key, $item1) && array_key_exists($key, $item2)) ? $item1[$key] <=> $item2[$key] : false;
                });
            } else {
                usort($array, function ($item1, $item2) use ($key, $order) {
                    return (array_key_exists($key, $item1) && array_key_exists($key, $item2)) ? $item2[$key] <=> $item1[$key] : false;
                });
            }
            return $array;
        }
        
        //вернуть из массива только элементы, удовлетворяющие внешним условиям
        public function thirdTask($array = []) : array {
            return array_filter($array , [$this, 'customSort']);
        }
        
        public function fourthTask($array = [], $key = '', $value = '') : array {
            $result = [];
            $test = array_map(function($item) use ($key, $value, &$result) {
                $result[$item[$key]] = $item[$value];
            }, $array);
            return $result;
        }
        
        //Выведите id и названия всех товаров, которые имеют все возможные теги в этой базе.
        public function fifthTask() : string {
            return "SELECT `goods`.`id`, `goods`.`name` FROM `goods` WHERE `goods`
            LEFT JOIN `goods_tags` ON `goods`.`id` = `goods_tags`.`goods_id`
            GROUP BY `goods`.`id`";
        }

        //Выбрать без join-ов и подзапросов все департаменты, в которых есть мужчины, и все они (каждый) поставили высокую оценку (строго выше 5)
        public function sixthTask() : string {
            return "SELECT *` FROM `evaluations` WHERE `gender` = true AND value >= 5";
        }
        
        //Функция сортировки массива
        private function customSort($item) {
            return $item['id'] == 1;
        }
    }
    
    $PHPInterview = new PHPInterview();
    $array = [
      ["id" => 1, "date" => "12.01.2020", "name" => "test1"],
      ["id" => 2, "date" => "02.05.2020", "name" => "test2"],
      ["id" => 4, "date" => "08.03.2020", "name" => "test4"],
      ["id" => 1, "date" => "22.01.2020", "name" => "test1"],
      ["id" => 2, "date" => "11.11.2020", "name" => "test4"],
      ["id" => 3, "date" => "06.06.2020", "name" => "test3"],
    ];
    var_dump($PHPInterview->firstTask($array));
    // $PHPInterview->secondTask($array, 'id')
    // $PHPInterview->thirdTask($array);
    // $PHPInterview->fourthTask($array, 'name', 'id')
    
?>