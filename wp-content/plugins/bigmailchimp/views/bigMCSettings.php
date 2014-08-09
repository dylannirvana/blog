<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="wrap">
    <?php $title = __('BigMailChimp Settings') ?>
    <div id="icon-options-general" class="icon32"><br></div>
    <h2><?php echo $title . ' '; ?></h2>
    <?php echo Functions_GetMessages($messages, $message_type) ?>
    <form method="post" action="?page=big-mailchimp-settings">
        <h3>General Settings:</h3>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="load_script">Load Scripts</label></th>
                <td><label for="load_script"><input name="load_script" id="load_script" type="checkbox" value="1" <?php checked($bigMailChimpOptions['load_script']) ?>/> Unchecking this option will prevent the plugin to load the supplied Javascript file.</label>
                    <p class="description">
                        Reducing the number of resources called on page load will increase the performance of your page. Remember to copy the content of `bigMailChimp > views > js > bigMailChimp.js` to your main js file and make sure jQuery is loaded.
                    </p>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="load_css">Load CSS</label></th>
                <td><label for="load_css"><input name="load_css" id="load_css" type="checkbox" value="1" <?php checked($bigMailChimpOptions['load_css']) ?>/> Unchecking this option will prevent the plugin to load the supplied CSS file.</label>
                    <p class="description">BigMailChimp uses your default form styles. The `bigMailChimp > views > css > BigMailChimp.css` styles the form's results box.</p>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="form_layout">Form Layout</label>
                </th>
                <td><input type="text" name="form_layout" id="form_layout" class="regular-text" value="<?php echo $bigMailChimpOptions['form_layout'] ?>"/>
                    <p class="description">This option is for programmers only. It allows you to write your own form layout. For more information refer to the plugin's documentation.</p>
                    <p class="description">Default values are `Forms_MC` or `Forms_Plain`</span></p>
                </td>
            </tr>
        </table>
        <p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes"  /></p></form>
</div>