<?php

/**
 *  Override or insert variables into the page template.
 *  Implements Hook: _preprocess_page
 */
function mcny_preprocess_page(&$vars)
{
    // Get the entire main menu tree
    $main_menu_tree = menu_tree_all_data('main-menu');
    // Add the rendered output to the $main_menu_expanded variable
    $vars['main_menu_expanded'] = menu_tree_output($main_menu_tree);
    // Template suggestion will be automatically be changed and executed if exists
    if (isset($vars['node']->type)) {
        // We don't want to apply this on taxonomy or view pages
        // Splice (2) is based on existing default suggestions. Change it if you need to.
        array_splice($vars['theme_hook_suggestions'], -1, 0, 'page__' . $vars['node']->type);
        // Get the url_alias and make each item part of an array
        $url_alias = drupal_get_path_alias($_GET['q']);
        $split_url = explode('/', $url_alias);
        // Add the full path template pages
        // Insert 2nd to last to allow page--node--[nid] to be last
        $cumulative_path = '';
        foreach ($split_url as $path) {
            $cumulative_path .= '__' . $path;
            $path_name = 'page' . $cumulative_path;
            array_splice($vars['theme_hook_suggestions'], -1, 0, str_replace('-', '_', $path_name));
        }
        // This does just the page name on its own & is considered more specific than the longest path
        // (because sometimes those get too long)
        // Also we don't want to do this if there were no paths on the URL
        // Again, add 2nd to last to preserve page--node--[nid] if we do add it in
        if (count($split_url) > 1) {
            $page_name = end($split_url);
            array_splice($vars['theme_hook_suggestions'], -1, 0, 'page__' . str_replace('-', '_', $page_name));
        }
    }

    // Allow the special templates to taxonomy
    if (arg(0) == 'taxonomy' && arg(1) == 'term' && is_numeric(arg(2))) {
        $term = taxonomy_term_load(arg(2));
        $vars['theme_hook_suggestions'][] = 'page__vocabulary__' . $term->vocabulary_machine_name;
    }

    // Add "jQuery Carousel" library in exhibition page only
    if (arg(0) == 'node' && $vars['node']->type == 'exhibition') {
        drupal_add_js(drupal_get_path('theme', 'mcny') . '/public/common/jquery/js/jquery.jcarousellite.min.js');
    }

    $header = drupal_get_http_header('status');
    if ($header == '404 Not Found') {
        $vars['theme_hook_suggestions'][] = 'page__404';
    }
}

/**
 *  Override the taxonomy term templates
 *  Implements Hook: _preprocess_taxonomy_term
 */
function mcny_preprocess_taxonomy_term(&$variables)
{
    $variables['view_mode'] = $variables['elements']['#view_mode'];
    $variables['term'] = $variables['elements']['#term'];
    $term = $variables['term'];

    $uri = entity_uri('taxonomy_term', $term);
    $variables['term_url'] = url($uri['path'], $uri['options']);
    $variables['term_name'] = check_plain($term->name);
    $variables['page'] = $variables['view_mode'] == 'full' && taxonomy_term_is_page($term);

    // Flatten the term object's member fields.
    $variables = array_merge((array)$term, $variables);

    // Helpful $content variable for templates.
    $variables['content'] = array();
    foreach (element_children($variables['elements']) as $key) {
        $variables['content'][$key] = $variables['elements'][$key];
    }

    // field_attach_preprocess() overwrites the $[field_name] variables with the
    // values of the field in the language that was selected for display, instead
    // of the raw values in $term->[field_name], which contain all values in all
    // languages.
    field_attach_preprocess('taxonomy_term', $term, $variables['content'], $variables);

    // Gather classes, and clean up name so there are no underscores.
    $vocabulary_name_css = str_replace('_', '-', $term->vocabulary_machine_name);
    $variables['classes_array'][] = 'vocabulary-' . $vocabulary_name_css;

    $variables['theme_hook_suggestions'][] = 'taxonomy_term__' . $term->vocabulary_machine_name;
    $variables['theme_hook_suggestions'][] = 'taxonomy_term__' . $term->tid;
}

/**
 *  Override the breadcrumb elements to generate
 *  Implements Hook: _breadcrumb
 */
function mcny_breadcrumb($variables)
{
    $sep = ' <span>&gt;</span> ';
    $breadcrumb = $variables['breadcrumb'];
    if (!empty($breadcrumb)) {
        // Use CSS to hide titile .element-invisible.
        //$output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
        $output = '';

        // Comment below line to hide current page to breadcrumb
        //$breadcrumb[] = drupal_get_title();

        // TODO: Find solution open url in new window here. See hooks more in detail.
        // Add this line to replace the link to custom URL
        $breadcrumb[0] = l('Home', '');
        $output .= '<span class="home">' . implode($sep, $breadcrumb) . '</span>';
        $output .= $sep;
        return $output;
    }
}

/**
 *  Execute when "main menu hook" generate the code for menu
 *  Implements Hook: _menu_tree__
 */
function mcny_menu_tree__main_menu($variables)
{
    return '<ul class="nav navbar-nav">' . $variables['tree'] . '</ul>';
}

/**
 *  Execute when "main menu hook" create the links for menu
 *  Implements Hook: _links__system_
 */
function mcny_links__system_main_menu($vars)
{
    $current_path = request_path();

    $class = implode($vars['attributes']['class'], ' ');
    $html = '<ul class="' . $class . '">';
    foreach ($vars['links'] as $key => $link) {
//        echo '<pre>';
//        drupal_match_path($current_path, $match_pages);
//        print_r($link['#localized_options']['cami']['pages']);
//        echo '</pre>';
        if (is_numeric($key)) {
            $sub_menu = '';
            $link_class = '';
            $link_title = $link['#title'];
            // Check for sub menu - note I've only checked this for 2 levels
            // it might not work for 3 level menus.
            if (!empty($link['#below'])) {
                $link_class = ' class="dropdown"';
                $link['#attributes']['class'][] = 'dropdown-toggle';
                $link['#attributes']['data-toggle'][] = 'dropdown';
                // And recurse.
                $sub_menu = theme('links__system_main_menu', array('links' => $link['#below'], 'attributes' => array('class' => array('dropdown-menu'))));
                // Add drop down caret.
                $link_title .= '<b class="caret"></b>';
            }

            if(isset($link['#localized_options']['attributes']['target'])){
                $link['#attributes']['target'] = $link['#localized_options']['attributes']['target'];
            }

            // Active item for sub pages in navigation
            if(isset($link['#localized_options']['cami']['pages'])) {
                $match_pages = $link['#localized_options']['cami']['pages'];
                $arr_match_pages = explode(',', $match_pages);
                if(is_array($arr_match_pages)){
                    $match_flag = false;
                    foreach($arr_match_pages as $match_page_item) {
                        $match_page_item = trim($match_page_item);
                        if(drupal_match_path($current_path, $match_page_item)) {
                            $match_flag = true;
                        }
                    }
                    if($match_flag){
                        $link['#attributes']['class'][] = 'active';
                    }
                } else if(drupal_match_path($current_path, $arr_match_pages)) {
                    $link['#attributes']['class'][] = 'active';
                }
            }

            $html .= '<li' . $link_class . '>' . l($link_title, $link['#href'], array('html' => 'true', 'attributes' => $link['#attributes'])) . $sub_menu . '</li>';
        }
    }
    $html .= '</ul>';

    return $html;
}

/**
 *  Returns the taxonomy url by object
 */
function mcny_get_taxonomy_url($taxonomy)
{
    $term = taxonomy_term_uri($taxonomy);
    return drupal_lookup_path('alias', $term['path']);
}

/**
 *  Returns an array of taxonomy with fields
 **/
function mcny_get_taxonomy_options($vocabularyMachineName, $label = null)
{
    $vocabulary = taxonomy_vocabulary_machine_name_load($vocabularyMachineName);
    $tree = taxonomy_get_tree($vocabulary->vid);
    $options = array();
    foreach ($tree as $item) {
        $termItem = taxonomy_term_load($item->tid);
        $options[] = array(
            'data' => $termItem,
            'total' => count(mcny_get_exhibition_nodes_by_term_category($termItem->tid, $label))
        );
    }
    return $options;
}

/**
 *  Returns the all nodes by exhibition term category
 */
function mcny_get_exhibition_nodes_by_term_category($tid, $label = null, $limit = 4, $type = 'exhibition')
{
    $node = null;
    $query = new EntityFieldQuery();

    $query->entityCondition('entity_type', 'node')
        ->entityCondition('bundle', $type)
        ->propertyCondition('status', NODE_PUBLISHED)
        ->fieldOrderBy('field_exhibition_weight', 'value', 'ASC')
        ->fieldCondition('field_exhibition_category', 'tid', $tid);
    if ($label !== null) {
        $query->fieldCondition('field_exhibition_label', 'tid', $label);
    }
    $query->range(0, $limit);

    $result = $query->execute();
    $nids = (isset($result['node'])) ? array_keys($result['node']) : null;
    $nodes = entity_load('node', $nids);
    return $nodes;
}

/*
 *  Returns all nodes by exhibition term category (with label and organized array as well)
 */
function mcny_get_exhibition_nodes_by_term_organized($taxonomy, $label = null, $type = 'exhibition')
{
    $results = array();
    $loadTotalPosts = (isset($taxonomy->field_exhibition_category_posts['und'][0]['value'])) ? $taxonomy->field_exhibition_category_posts['und'][0]['value'] : 4;
    $nodes = mcny_get_exhibition_nodes_by_term_category($taxonomy->tid, $label, $loadTotalPosts, $type);
    foreach ($nodes as $node) {
        $label = taxonomy_term_load($node->field_exhibition_label['und'][0]['tid']);
        $results[] = array(
            'label' => $label,
            'node' => $node
        );
    }
    $r = $results;
    return $r;
}

/*
 *  Returns the time line by current exhibition node
 */
function mcny_get_timeline_casestudy($tid, $type = 'timeline')
{
    $node = null;
    $query = new EntityFieldQuery();

    $query->entityCondition('entity_type', 'node')
        ->propertyCondition('status', NODE_PUBLISHED)
        ->entityCondition('bundle', $type)
        ->fieldCondition('field_timeline_exhibition', 'target_id', $tid)
        ->fieldOrderBy('field_timeline_year', 'value', 'ASC');
    //->propertyOrderBy('created', 'DESC');
    $result = $query->execute();

    $nids = (isset($result['node'])) ? array_keys($result['node']) : null;
    $nodes = entity_load('node', $nids);
    return $nodes;
}

/**
 *  Returns an array of " FIRST LESSON PLAN" taxonomy with fields
 */
function mcny_redirect_to_first_lesson_plan_category($vocabularyMachineName = 'lesson_plans_category')
{
    $vocabulary = taxonomy_vocabulary_machine_name_load($vocabularyMachineName);
    $tree = taxonomy_get_tree($vocabulary->vid);
    $term = taxonomy_term_load($tree[0]->tid);
    $url = mcny_get_taxonomy_url($term);
    drupal_goto($url);
}

/**
 *  Returns an array of "Lesson Plans" taxonomy with fields
 **/
function mcny_get_taxonomy_options_lesson_plans($vocabularyMachineName)
{
    $vocabulary = taxonomy_vocabulary_machine_name_load($vocabularyMachineName);
    $tree = taxonomy_get_tree($vocabulary->vid);
    $options = array();
    foreach ($tree as $item) {
        $termItem = taxonomy_term_load($item->tid);
        $nodes = mcny_get_lesson_plans($termItem->tid);
        $options[] = array(
            'data' => $termItem,
            'nodes' => $nodes,
            'total' => count($nodes)
        );
    }
    return $options;
}

/*
 *  Returns the lesson plans
 */
function mcny_get_lesson_plans($tid = null)
{
    $node = null;
    $query = new EntityFieldQuery();

    $query->entityCondition('entity_type', 'node')
        ->entityCondition('bundle', 'lesson_plans')
        ->propertyCondition('status', NODE_PUBLISHED);
        if($tid !== null){
            $query->fieldCondition('field_lesson_plan_category', 'tid', $tid);
        }
    $result = $query->execute();

    $nids = (isset($result['node'])) ? array_keys($result['node']) : null;
    $nodes = entity_load('node', $nids);
    return $nodes;
}

/*
 *  Returns the student programs
 */
function mcny_get_student_programs()
{
    $node = null;
    $query = new EntityFieldQuery();

    $query->entityCondition('entity_type', 'node')
        ->propertyCondition('status', NODE_PUBLISHED)
        ->fieldOrderBy('field_program_weight', 'value', 'ASC')
        ->entityCondition('bundle', 'student_programs');
    $result = $query->execute();

    $nids = (isset($result['node'])) ? array_keys($result['node']) : null;
    $nodes = entity_load('node', $nids);
    return $nodes;
}

/**
 *  Returns an array of "Professional Development" taxonomy with fields
 **/
function mcny_get_taxonomy_options_professional_development($vocabularyMachineName)
{
    $vocabulary = taxonomy_vocabulary_machine_name_load($vocabularyMachineName);
    $tree = taxonomy_get_tree($vocabulary->vid);
    $options = array();
    foreach ($tree as $item) {
        $termItem = taxonomy_term_load($item->tid);
        $nodes = mcny_get_professional_development_programs($termItem->tid);
        $options[] = array(
            'data' => $termItem,
            'nodes' => $nodes,
            'total' => count($nodes)
        );
    }
    return $options;
}

/*
 *  Returns the professional development programs
 */
function mcny_get_professional_development_programs($tid)
{
    $node = null;
    $query = new EntityFieldQuery();

    $query->entityCondition('entity_type', 'node')
        ->propertyCondition('status', NODE_PUBLISHED)
        ->entityCondition('bundle', 'professional_development')
        ->fieldCondition('field_professional_dev_category', 'tid', $tid);
//        ->fieldOrderBy('field_professional_weight', 'value', 'ASC');
    $result = $query->execute();

    $nids = (isset($result['node'])) ? array_keys($result['node']) : null;
    $nodes = entity_load('node', $nids);
    return $nodes;
}

/*
 *  Returns the connect page quiz
 */
function mcny_get_connect_page_quiz()
{
    $node = null;
    $query = new EntityFieldQuery();

    $query->entityCondition('entity_type', 'node')
        ->propertyCondition('status', NODE_PUBLISHED)
        ->entityCondition('bundle', 'connect_quiz');
    $result = $query->execute();

    $nids = (isset($result['node'])) ? array_keys($result['node']) : null;
    $nodes = entity_load('node', $nids);
    return reset($nodes);
}
