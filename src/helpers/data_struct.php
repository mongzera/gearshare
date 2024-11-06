<?php

function swap(array &$arr, int $a, int $b){

    if(isset($arr[$a]) && isset($arr[$b])){
        $temp = $arr[$a];
        $arr[$a] = $arr[$b];
        $arr[$b] = $temp;
    }
}

function linear_search( string $searchString, array $items, array $attrib_names){

    $searchString = trim($searchString); //remove whitespaces trailing and leading

    // Escape special characters in the search term
    $escapedSearchTerm = preg_quote($searchString, '/');

    // Create a regex pattern that allows for partial matches
    $pattern = '/' . $escapedSearchTerm . '|(?<=\s|^)'. preg_replace('/s$/', '', $escapedSearchTerm) . '(?=\s|$)/i';

    $matched_items = [];
    $item_names = [];
    foreach($items as $item){
        $added_row = false;
        foreach($attrib_names as $name){
            if($added_row) break;
            if(preg_match($pattern, $item[$name], $matches)){
                array_push($matched_items, $item);
                array_push($item_names, $item['name']);

                $added_row = true;
            }
        }
    }

    return [$matched_items, $item_names];
}

function linear_search_strict( string $searchString, array $items, $categories = [], $brands = [], $priceOrder = 'ascending'){
    $matched_items = [];

    $searchString = trim($searchString); //remove whitespaces trailing and leading
    
    $escapedSearchTerm = preg_quote($searchString, '/'); // Escape special characters in the search term

    $pattern = '/' . $escapedSearchTerm . '|(?<=\s|^)'. preg_replace('/s$/', '', $escapedSearchTerm) . '(?=\s|$)/i'; // Create a regex pattern that allows for partial matches


    foreach(retrieve_items() as $item){
        if(exists($item['category'], $categories)) {
            array_push($matched_items, $item);
            continue;
        }

        if(exists($item['brand'], $brands)) {
            array_push($matched_items, $item);
            continue;
        }

        if(preg_match($pattern, $item['name'], $matches)){
            array_push($matched_items, $item);
        }

    }

    return $matched_items;
}

function filter($searchString, $categories = [], $brands = [], $priceOrder = 'price_highest'){
    $completeSearchMatch = $searchString;

    //append the filters

    [$matched_items, $item_names] = linear_search($completeSearchMatch, retrieve_items(), ['name', 'category', 'brand']);

    bubble_sort($matched_items, 'price', ($priceOrder === 'price_lowest') ? 'ascending' : 'descending');

    return $matched_items;
}

function bubble_sort(array &$unsorted_arr, $basis, $order = 'ascending'){

    $arr_size = sizeof($unsorted_arr);

    for($i = 0; $i < $arr_size-1; $i++){

        $swapped = false;
        for($j = 0; $j < $arr_size-1-$i; $j++){

            //order of sorting
            if($order === 'ascending'){
                if($basis == 'price'){ //if the basis is price, it is numerical
                    if($unsorted_arr[$j][$basis] > $unsorted_arr[$j+1][$basis]){
                        swap($unsorted_arr, $j, $j+1);
                        $swapped = true;
                    }
    
                    continue;
                }
    
                //strcasecmp is a case-insensitive string array comparison. it is used to determine the alphabetical order of 2 string array
                if(strcasecmp($unsorted_arr[$j][$basis], $unsorted_arr[$j+1][$basis]) > 0){
                    swap($unsorted_arr, $j, $j+1);
                    $swapped = true;
                } 
            }else{
                if($basis == 'price'){ //if the basis is price, it is numerical
                    if($unsorted_arr[$j][$basis] < $unsorted_arr[$j+1][$basis]){
                        swap($unsorted_arr, $j, $j+1);
                        $swapped = true;
                    }
    
                    continue;
                }
    
                //strcasecmp is a case-insensitive string array comparison. it is used to determine the alphabetical order of 2 string array
                if(strcasecmp($unsorted_arr[$j][$basis], $unsorted_arr[$j+1][$basis]) < 0){
                    swap($unsorted_arr, $j, $j+1);
                    $swapped = true;
                } 
            }

        }

        if(!$swapped) break; //if there was no swapping in the last iteration, it means that the array is already sorted
                             //there is no need to iterate further
    }
}

function exists($target, $list){
    foreach($list as $element){
        if( $target === $element ) return true;
    }

    return false;
}

function enumerate($matchedItems, $basis){
    $accumulatedList = [];


    foreach($matchedItems as $item){
        if(!exists($item[$basis], $accumulatedList)) array_push($accumulatedList, $item[$basis]);
    }

    return $accumulatedList;
}