<?php

if ( ! defined( 'ABSPATH' ) ){ 
    exit;
}

// offer search
function true_filter_function(){

    $categories = array();

    $position = get_terms( array(

        'taxonomy'   => 'category',

        'parent' => '4'

    ));

    if(isset($_POST['Alle'])){

        foreach ($position as $term){

            $categories[] = $term->term_id;

        }

    } else {

        foreach ($position as $term){

            if (isset($_POST[$term->name])){

                $categories[] = $term->term_id;

            }

        }

    }

    global $post;

    $tmp_post = $post;

    $post_per_page = 8;
    $numpage = $_POST["page"];

    $args = array( 'posts_per_page' => -1, 'category' => $categories );

    $myposts = get_posts( $args );

    $filterposts = [];

    
     foreach( $myposts as $post ){ 
        if(get_field("entfernung") <= $_POST["range"]){ 
            if(isset($_POST["location"])){
                $localisation = mb_strtolower(trim($_POST["location"])) ;
                $postlocalisation = mb_strtolower(trim(get_field("localisation")));
                if(empty($_POST["location"]) or stristr ($postlocalisation, $localisation)){
                    $filterposts[] = $post;
                }
            }
        }
    }

    $countposts = count($filterposts);

    if ($countposts > $post_per_page){
        $first_post = $numpage * $post_per_page - $post_per_page;
        $pages = ceil($countposts / $post_per_page);

        $filterposts = array_slice($filterposts, $first_post, $post_per_page);

    }

    ?>
    <h2 class="text-center">

        <span><?php echo $countposts ?></span> Stellenangebote gefunden

    </h2>

    <div class="job_offers_search_results_wrap">
        <?php
        foreach( $filterposts as $post ){ 
            setup_postdata($post);?>
            <div class="job_offers_search_results_item">

                <div class="job_offers_search_results_item_title">
                    <?php the_title()?>
                </div>

                <div class="job_offers_search_results_item_info">
                    <div class="job_offers_search_results_item_city">

                        <?php the_field("localisation") ?>

                    </div>
                    <a href="<?php the_field("url_for_offers", "152") ?>" class="job_offers_search_results_item_link">
                        Jetzt bewerben
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/arrow.svg" alt="alt">
                    </a>
                </div>
            </div>     
        <?php } ?>
    </div> 

    <?php

    if ($countposts > $post_per_page){
        ?>
        <div class="job_offers_search_results_pagination">
            <nav aria-label="...">
                <ul class="pagination justify-content-center"><?php
                    if($numpage != 1){
                        ?>
                            <a class="prev page-numbers search-pagination" data-page="<?php echo $numpage - 1; ?>" href="#"><img src="<?php echo get_template_directory_uri()?>/assets/img/arrow.svg" alt="alt"> Zurück</a>
                        <?php
                    }
                    $n=0;
                    while ($n++<$pages){
                        if($n == $numpage){
                            ?> <span aria-current="page" class="page-numbers current"><?php echo $n; ?></span> <?php
                        } else {
                            ?><a class="page-numbers search-pagination" data-page="<?php echo $n; ?>" href="#"><?php echo $n; ?></a><?php
                        }
                    }
                    if($numpage != $pages){ ?>
                        <a class="next page-numbers search-pagination" data-page="<?php echo $numpage + 1; ?>" href="#">Weiter <img src="<?php echo get_template_directory_uri()?>/assets/img/arrow.svg" alt="alt"></a>
                        <?php
                    }
                ?></ul>
            </nav>
        </div><?php
    }

    $post = $tmp_post;

    die();
}


add_action('wp_ajax_true_filter_function', 'true_filter_function'); 
add_action('wp_ajax_nopriv_true_filter_function', 'true_filter_function');


// site searh
function search_form_site(){
    ?>
    <ul>
    <?php
    global $post;
    $tmp_post = $post;

    $count = 0;
    $args = array( 
        'posts_per_page' => -1,
        'post_type' => 'any'
     );
    $myposts = get_posts( $args );
    foreach( $myposts as $post ){ 
        setup_postdata($post);

        $search = mb_strtolower(trim($_POST['s']));

        $content = mb_strtolower(trim(get_the_title()));

        if(stristr($content, $search) and $count < 5){
            $count += 1;
            ?>
            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <?php
        }
    }
    wp_reset_postdata();
    $post = $tmp_post;
    ?>
    </ul>
    <?php
    die();
}


add_action('wp_ajax_search_form_site', 'search_form_site'); 
add_action('wp_ajax_nopriv_search_form_site', 'search_form_site');