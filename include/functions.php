<?php
// display items in html
    function get_item_html($id, $item){
        $output = "<li>".
            "<a href='#'>".
            "<img src='".$item['img']."' alt='".$item[title].
            "'<p>View Details</p></a></li>";
        return $output;
    } 

    //random product dispaly in home page
    function array_category($catalog, $category){
      
        $output = array();
        foreach($catalog as $id => $item){
            if($category == null or strtolower($category) == strtolower($item['category'])){
                $sort = $item['title'];
                 // remove "the ,A ,An" from item title
                 $sort = ltrim($sort, "The ");
                 $sort = ltrim($sort, "A ");
                 $sort = ltrim($sort, "An ");
                $output[$id] = $sort;
            }
        }
        //sort items
        asort($output);
        return array_keys($output);

    }