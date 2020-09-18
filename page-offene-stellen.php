<?php get_header(); ?>


  <section class="sales_stars_first">
      <?php if(get_field('header_image')){ ?>
        <img src="<?php the_field('header_image' , '152'); ?>" alt="alt">
      <?php } ?>
  </section>


  <section class="job_offers_first">

    <div class='container'>

      <div class='row'>

        <div class='col-12'>

          <h1 class="text-center">

            <?php the_title(); ?> 

          </h1>

        </div>

        <div class="col-12">

          <form  action="<?php echo admin_url( 'admin-ajax.php?action=true_filter_function' ) ?>" method="POST" id="job_offers_search_form">

            <div class="job_offers_search_wrap">

              <div class="job_offers_search_where">

                <label for="where" class="label_where">
                  <p>Wo sollen wir für dich suchen?</p>
                  <input type="text" id="where" name="location">
                </label>
                <div class="range">

                  <label for="rangeInput">
                    <p>Max. Entfernung in km: <span id="rangeKM">200</span></p>
                    <input onchange="
                    document.querySelector('#rangeKM').innerHTML = this.value
                    " type="range" value="200" step="10" id="rangeInput" min="10" max="200" name="range">
                  </label>

                </div>

              </div>

              

              <?php  if( $terms = get_terms( array(
                'taxonomy'   => 'category',
                'parent' => '4'
              ))) {
                    echo '<div class="job_offers_checkboxes">
                            <div>
                              <input type="checkbox" id="Alle" name="Alle">
                              <label for="Alle">Alle</label>
                            </div>';
                    foreach ($terms as $term) {
                      echo '
                      <div>
                        <input type="checkbox" id="' . $term->name . '" name="' . $term->name . '"/>
                        <label for="' . $term->name . '">' . $term->name . '</label>
                      </div>';
                    }
                    echo '</div>';
              } 
              ?>
            </div>
          </form>


          <div class="job_offers_search_result" id="job_offers_search_result">

            <h2 class="text-center">

              <span><?php echo wp_count_posts()->publish; ?></span> Stellenangebote gefunden

            </h2>

            <div class="job_offers_search_results_wrap">
              <?php
              

                global $wp_query;

                $paged = get_query_var('paged');

                $wp_query = new WP_Query( array(
                  'paged' => $paged,
                  'posts_per_page' => 8
                )); 

                while( have_posts() ){
                    the_post();

                  ?><div class="job_offers_search_results_item">

                      <div class="job_offers_search_results_item_title">
                          <?php the_title();?>
                      </div>

                      <div class="job_offers_search_results_item_info">
                          <div class="job_offers_search_results_item_city">

                              <?php the_field("localisation"); ?>

                          </div>
                          <a href="<?php the_field("url_for_offers")?>" class="job_offers_search_results_item_link">
                              Jetzt bewerben
                              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow.svg" alt="alt">
                          </a>
                      </div>
                    </div>
                <?php }?>
            </div>

            <div class="job_offers_search_results_pagination">

              <?php 
              wp_reset_postdata();
              ?><nav aria-label="...">
                  <ul class="pagination justify-content-center">
                    <?php
                      the_posts_pagination(array(
                        'prev_text'    => '<img src="' . get_template_directory_uri() . '/assets/img/arrow.svg" alt="alt"> Zurück',
                        'next_text'    => 'Weiter <img src="' . get_template_directory_uri() . '/assets/img/arrow.svg" alt="alt">',
                      ));
                    ?>
                  </ul>
                </nav>

            </div>

          </div>


        </div>

      </div>

    </div>

  </section>

  <section class="nothing_for_you_section" style="background-image: url(<?php echo get_template_directory_uri();?>/assets/img/black_bg.jpg);">

    <div class='container'>
      <div class='row'>
        <div class='col-xl-4 col-12'>
          <h2><?php the_field('text_one_sec_two', '152'); ?></h2>
        </div>
        <div class="col-xl-6 col-12 offset-xl-2">
          <p><?php the_field('text_two_sec_two', '152'); ?></p>
          <a href="<?php the_field('url', '152'); ?>" class="nothing_for_you_link">
            Wir freuen uns auf deine Initiativbewerbung!
            <img src="<?php echo get_template_directory_uri();?>/assets/img/arrow.svg" alt="alt">
          </a>
        </div>
      </div>
    </div>


  </section>


  <section class="goes_on_section">

    <div class="container-fluid p-lg-0">

      <div class="row">

        <div class="col-lg-6 col-12">
          <div class="goes_on_section_title" style="background-image: url(<?php echo get_template_directory_uri();?>/assets/img/red_triangle.png);">
            <h2>
                <?php the_field('text_sec_three', '152'); ?>
            </h2>

          </div>

        </div>

        <?php if (have_rows('list', '152')){
          $list = get_field('list', '152');?>
            <div class="col-lg-4 col-12 offset-lg-1">
              <div class="goes_on_section_list">
                <ol>
                  <?php foreach($list as $list_el){?>
                    <li><?php echo $list_el['text']; ?></li>
                  <?php } ?>
                </ol>
              </div>
            </div>
          <?php } ?>

      </div>

    </div>

  </section>

<?php get_footer(); ?>