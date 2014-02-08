<?php
/**
 * FileDoc:
 * View Partial for YiiFeedWidget.
 * This extension depends on both idna convert and Simple Pie php libraries
 *
 * PHP version 5.3
 *
 * @category Extensions
 * @package  YiiFeedWidget
 * @author   Richard Walker <richie@mediasuite.co.nz>
 * @license  BSD License http://www.opensource.org/licenses/bsd-license.php
 * @link     http://mediasuite.co.nz
 * @see      simplepie.org
 * @see      http://www.phpclasses.org/browse/file/5845.html
 *
 */
foreach ($items as $item):

?>
<div class="yii-feed-widget-item">
    <?php
    if ($enclosure = $item->get_enclosure())
    {
// Check to see if we have a thumbnail.  We need it because this is going to display an image.
        if ($thumb = $enclosure->get_thumbnail())
        {

            ?>
            <img src="<?php echo $thumb ?>">
        <?php


        }
        if ($img_link = $enclosure->get_link()) {
// Add each item: item title, linked back to the original posting, with a tooltip containing the description.
            ?>
            <img src="<?php echo $img_link ?>">
        <?php


        }

    }
    else
    {
// There are feeds that don't use enclosures that none the less are desireable to dsipaly wide as they contain primarily images
// Dakka Dakka and some YouTube feeds fall into this category, not sure what is up with Chest of Colors...
        $htmlDOM = new simple_html_dom();
        $htmlDOM->load($item->get_content());

        $image = $htmlDOM->find('img', 0);
        $link = $htmlDOM->find('a', 0);

// Add each item: item title, linked back to the original posting, with a tooltip containing the description.
        $html .= '<li class="' . $item_classname . '">';
        $html .= '<a href="' . $link->href . '" title="' . $title_attr . '">';
        // Sometimes I'm not getting thumbnails, so I'm going to try to make them on the fly using this tutorial:
        // http://www.webgeekly.com/tutorials/php/how-to-create-an-image-thumbnail-on-the-fly-using-php/
        $html .= '<img src="thumbnail.php?file=' . $image->src . '&maxw=100&maxh=150" alt="' . $item->get_title() . '" border="0" />';
        $html .= '</a>';
        $html .= '</li>' . "\n";

    }

    ?>
    <h2><a href="<?php echo $item->get_permalink(); ?>">
            <?php echo $item->get_title(); ?></a>
    </h2>
    <p><small>Posted on <?php echo $item->get_date('j F Y | g:i a'); ?></small></p>
    <p><?php echo $item->get_description(); ?></p>

</div>
<?php endforeach; ?>
<div class="yii-feed-widget-clear"></div>
<?php
