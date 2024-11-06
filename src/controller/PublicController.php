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

        $matchedItems = retrieve_items();

        if(isAllSet($_GET, ['search_bar'])){
            $search_keyword = cleanValues($_GET, ['search_bar'])['search_bar'];
            $matchedItems = filter($search_keyword, (isset($_GET['categories']) ? $_GET['categories'] : []), (isset($_GET['selected_brands']) ? $_GET['selected_brands'] : []), (isset($_GET['price_order']) ? $_GET['price_order'] : []));
            //$matchedItems = linear_search_strict($search_keyword, $matchedItems, (isset($_GET['selected_brands']) ? $_GET['selected_brands'] : []), (isset($_GET['brands']) ? $_GET['brands'] : []));
            $brand_names = enumerate($matchedItems, 'brand');
        }

        


        include '../src/templates/base.php';
    }
}