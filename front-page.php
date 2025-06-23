<?php get_header(); ?>

<section class="hero">
  <div class="hero-content">
    <h1>Unlock Limitless Art</h1>
    <p>Join Pro to access premium digital illustrations</p>
    <a href="#" class="btn-primary">Join Pro</a>
  </div>
</section>

<section class="categories">
  <h2>Featured Categories</h2>
  <ul class="featured-categories">
    <li class="category-item">Wall Art</li>
    <li class="category-item">Line Art</li>
    <li class="category-item">Posters</li>
    <li class="category-item">Nature</li>
  </ul>
</section>

<section class="popular-art">
  <h2>Popular Art</h2>
  <div class="art-grid">
    <?php
    // $args = array(
    //   'post_type' => 'product',
    //   'posts_per_page' => 8,
    //   'meta_key' => '_featured',
    //   'meta_value' => 'yes',
    // );
    
    $args = array(
      'post_type' => 'product',
      'posts_per_page' => 8,
      'tax_query' => array(
        array(
          'taxonomy' => 'product_tag',
          'field' => 'slug',
          'terms' => 'popular',
        ),
      ),
    );
    $loop = new WP_Query($args);

    if ($loop->have_posts()) {
      while ($loop->have_posts()):
        $loop->the_post();
        global $product; ?>
        <div class="art-item">
          <a href="<?php the_permalink(); ?>">
            <?php if (has_post_thumbnail()) {
              the_post_thumbnail('medium');
            } ?>
            <p><?php the_title(); ?></p>
          </a>
        </div>
      <?php endwhile;
    } else {
      echo __('No products found');
    }
    wp_reset_postdata();
    ?>
  </div>
</section>

<section class="cta-banner">
  <div class="container">
    <h2>Unlock Exclusive Benefits</h2>
    <p>Join our Year Pass membership and get unlimited access to all digital art downloads.</p>
    <a href="/membership" class="btn btn-primary">Join Pro Now</a>
  </div>
</section>

<?php get_footer(); ?>