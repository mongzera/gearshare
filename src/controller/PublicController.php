<?php

namespace Src\Controller;

use Src\Middleware\Auth;

include_once '../src/db/db.php';
include_once '../src/helpers/helper.php';
include_once '../src/helpers/data_struct.php';
include_once '../src/partials/item_container.php';

class PublicController{
    public function index(){
        $content = [
            'css' => ['/static/css/search.css'],
            'js' => ['/static/js/brand_selection.js'],
            'header' => '../src/templates/header.php',
            'body' => '../src/content/search.php'
        ];

        //if(isset('GET', 'price_order') && !isset('GET', 'search_bar') &&)
        $matchedItems = retrieve_items();
        
        if(isAllSet($_GET, ['search_bar'])){
            $search_keyword = cleanValues($_GET, ['search_bar'])['search_bar'];
            $matchedItems = filter($search_keyword, (isset($_GET['categories']) ? $_GET['categories'] : []), (isset($_GET['selected_brands']) ? $_GET['selected_brands'] : []), (isset($_GET['price_order']) ? $_GET['price_order'] : []));
            //$matchedItems = linear_search_strict($search_keyword, $matchedItems, (isset($_GET['selected_brands']) ? $_GET['selected_brands'] : []), (isset($_GET['brands']) ? $_GET['brands'] : []));
            $brand_names = enumerate($matchedItems, 'brand');
        }else{
            if(isset($_GET['price_order'])) bubble_sort($matchedItems, 'price', ($_GET['price_order'] === 'price_lowest') ? 'ascending' : 'descending');
        }

        
        include '../src/templates/base.php';
    }

    public function itemView($itemId){
        $content = [
            'css' => ['/static/css/item_view.css'],
            'header' => '../src/templates/header.php',
            'body' =>  '../src/content/item_view.php'
        ];

        $item = retrieve_item_by_id($itemId);

        include '../src/templates/base.php';
    }
}