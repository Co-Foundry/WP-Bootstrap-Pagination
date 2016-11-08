<?php
/**
 *
 * @author Greg Gunner,
 */


/**
 * Create a bootstrap 3 pagination set of elements
 *
 * @param $wp_query object The QP_Query object to use
 * @param array $args array A list of arguments per https://codex.wordpress.org/Function_Reference/paginate_links
 * @return string The Html output
 */
function wp_bootstrap_pagination($wp_query = null, $args = array()) {

    if ($wp_query == null) {
        global $wp_query;
    }
    //Merge the args with defaults so that we have everything we need
    $args = array_merge(array(
        'prev_next' => true,
        'prev_text' => '&lsaquo;',
        'prev_label' => __('Previous'),
        'next_text' => '&rsaquo;',
        'next_label' => __('Next'),
    ), $args, array(
        'total' => $wp_query->max_num_pages,
        'current' => (get_query_var('paged') > 0) ? get_query_var('paged') : 1,
        'type' => 'array'
    ));

    //render the previous and next links
    if ($args['prev_next'] !== false) {
        if ($args['current'] > 1 && $link = get_previous_posts_page_link()) {
            $prev = '<li><a href="'.$link.'" aria-label="'.$args['prev_label'].'"><span aria-hidden="true">'.$args['prev_text'].'</span></a></li>';
        }
        if ($link = get_next_posts_page_link($wp_query->max_num_pages)) {
            $next = '<li><a href="'.$link.'" aria-label="'.$args['next_label'].'"><span aria-hidden="true">'.$args['next_text'].'</span></a></li>';
        }
    }
    //remove the setting for the default paginate_links call because we have already rendered them
    $args['prev_next'] = false;

    //Get the paginate links as an array
    $links = paginate_links($args);

    $numbers = '';
    for ($i=0;$i<count($links);$i++) {
        $active = '';
        if ($i == $args['current']-1) {
            $active = ' class="active"';
        }
        $numbers .= '<li'.$active.'>'.$links[$i].'</li>';
    }

    //Build the output string
    $out = '<nav aria-label="Page navigation">';
    $out .= '    <ul class="pagination">';
    $out .= $prev.$numbers.$next;
    $out .= '    </ul>';
    $out .= '</nav>';

    return $out;
}
