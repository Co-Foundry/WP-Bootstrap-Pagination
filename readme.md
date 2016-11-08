#WordPress Bootstrap Pagination

This is a simple function for adding to a WordPress theme to output a Bootstrap 3 pagination component.

##Instructions

1) Copy the file wp_bootstrap_pagination.php to your theme folder.
2) Add the following to your functions.php
```
if (!function_exists('wp_bootstrap_pagination')) {
    include('wp_bootstrap_pagination.php');
}
```
3) In your theme add the following where you would like to output the pagination.
```
<?php echo wp_bootstrap_pagination();?>
```

##Customisation

The function `wp_bootstrap_pagination` was created to support passing in a custom WP_Query object or null if it should use the global `$wp_query` object.
 
In addition, the second parameter for the function accepts the `$args` parameter one would pass to `paginate_links`. For more information see https://codex.wordpress.org/Function_Reference/paginate_links

##Note

This is not an actively maintained project and was only created because we found a luck of simple examples of this online and decided to create one.