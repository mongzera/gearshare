<?php

function item_container($item_name, $item_price, $item_provider){
    $dom = "
        <div class='item-container flex-col justify-space-between'>
                <img src='/static/img/blank_item.jfif' class='item-image'>
                <div class='item-description flex-col justify-space-between'>
                    <p class='item-info item-name'>{$item_name}</p>
                    <p class='item-info item-price'>{$item_price}</p>
                    <p class='item-info item-provider bold'>{$item_provider}</p>
                </div>
            </div>
    ";

    echo $dom;
}