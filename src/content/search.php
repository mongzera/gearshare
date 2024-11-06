<div class="content-container justify-center">
    <div class="search-container  flex-col align-center">
        <form action="" method="GET">
            <input type="text" class="search-bar" value="<?php if(isset($_GET['search_bar'])) echo $_GET['search_bar'] ?>" name="search_bar" id="search_bar" placeholder="Search Item..."/>
        </form>

        <div class="most-bought-category-container justfy-center">
            <!--this categories are queries and displayed-->
            <a href="/?search_bar=bike+frame" class="most-bought-category">Bike Frame</a> | 
            <a href="/?search_bar=bike+frame" class="most-bought-category">Bike Frame</a> | 
            <a href="/?search_bar=bike+frame" class="most-bought-category">Bike Frame</a> 
        </div>
    </div>

    <?php

        $count = count($matchedItems);
                            

        if($count <= 0) echo "<p class='inter'>No items are found...</p>";
        else{

            if(isset($_GET['search_bar']) && trim($_GET['search_bar'])!= ""){
                $trimmed_search_keyword = trim($_GET['search_bar']);
                echo "<p class='inter'>{$count} results for <span class='bold'>{$trimmed_search_keyword}</span></p>";
            }
            
        }

    ?>

    <div class="main-content flex-row">
        <div class="category-container flex-col">
            category
        </div>

        

        <div class="items-view grid-col-4">
            
            <?php
                

                if(isset($matchedItems)){
                    
                    foreach($matchedItems as $item){
                        item_container($item['name'], $item['price'] . " USD", $item['brand']);
                    }
                }
                

            ?>
        </div>

        <div class="filter-container flex-col">
            <div class="filter-main">
                <h3>Item Filter</h3>
                <hr><br>
                
                <form action='' method="GET">
                <?php if(isset($search_keyword)) echo "<input type='hidden' name='search_bar' value='$search_keyword'>"; ?>

                    <h4>Price</h4>
                    <input type="radio" name="price_order" value='price_highest' id="price_highest"><label class='inter' for='price_highest'>  Price Highest</label><br>
                    <input type="radio" name="price_order" value='price_lowest' id="price_lowest"><label class='inter' for='price_lowest'>  Price Lowest</label>
                    <br><br>
                    <h4>Brand Name</h4>
                    <!--LIST OUT ALL BRAND NAMES OF THE SEARCHED ITEMS-->

                    <?php

                        if(isset($brand_names)){
                            foreach($brand_names as $brand){
                                echo "<input type='checkbox' name='selected_brands' class='brands' id='brands' value='$brand'><label> $brand </label><br>";
                            }
                        }

                    ?>

                    <br>
                    <h4>Category</h4>
                    <!--LIST OUT ALL CATEGORIES OF THE SEARCHED ITEMS-->
                    <input type="radio" name="price_order" value='price_highest' id="price_highest"><label class='inter' for='price_highest'>  Price Highest</label><br>
                    <input type="radio" name="price_order" value='price_lowest' id="price_lowest"><label class='inter' for='price_lowest'>  Price Lowest</label>
                    
                    <input type="submit" value="Apply Filters"/>
                </form>
            </div>
        </div>
    </div>

</div>
