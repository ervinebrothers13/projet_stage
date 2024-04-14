<?php
/**
 * Template Name: réinit password péda
 * Description: réinit password péda
 */


// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}
?>
<?php get_header("cust"); ?>


    <section id="content" <?php Avada()->layout->add_style('content_style'); ?>>

        <?php while (have_posts()) : ?>
            <?php the_post(); ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php echo fusion_render_rich_snippets_for_pages(); // phpcs:ignore WordPress.Security.EscapeOutput ?>

                <?php avada_singular_featured_image(); ?>

                <div class="post-content">
                    <?php the_content(); ?>
                    <?php fusion_link_pages(); ?>
                </div>
                <?php if (!post_password_required($post->ID)) : ?>
                    <?php do_action('avada_before_additional_page_content'); ?>
                    <?php if (class_exists('WooCommerce')) : ?>
                        <?php $woo_thanks_page_id = get_option('woocommerce_thanks_page_id'); ?>
                        <?php $is_woo_thanks_page = (!get_option('woocommerce_thanks_page_id')) ? false : is_page(get_option('woocommerce_thanks_page_id')); ?>
                        <?php if (Avada()->settings->get('comments_pages') && !is_cart() && !is_checkout() && !is_account_page() && !$is_woo_thanks_page) : ?>
                            <?php comments_template(); ?>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php if (Avada()->settings->get('comments_pages')) : ?>
                            <?php comments_template(); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php do_action('avada_after_additional_page_content'); ?>
                <?php endif; // Password check. ?>
            </div>
        <?php endwhile; ?>


        <!--form creat compte-->
        <div id="forgetpassworddiv" class="formconnect">
            <form id="forgetpassword-form" method="POST"
                  action="<?php echo get_template_directory_uri(); ?>/actiondev1.php?act=reinitpasswordpeda">
                <input type="hidden" name="token" value="<?php echo $_GET["token"]; ?>"/>
                <br><label>Vous pouvez réinitialiser votre mot de passe ici.</label>
                <br>
                <label for="password1">Tapez un mot de passe :</label>
                <input type="password" id="password1" name="password1">

                <br>
                <label for="password2">Retapez le mot de passe :</label>
                <input type="password" id="password2" name="password2">
                <br>
                <button class="bouttonconnex" type="submit">Valider</button>
            </form>

        </div>


    </section>


<?php do_action('avada_after_content'); ?>
<?php get_footer(); ?>