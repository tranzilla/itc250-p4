<?php

require '../inc_0700/config_inc.php';

$config->titleTag = 'Updated news of three aspects';
$config->loadhead .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';

get_header();
echo '<h3 align="center">News List</h3>';

$prev = '<i class="fa fa-chevron-circle-left"></i>';
$next = '<i class="fa fa-chevron-circle-right"></i>';

//TODO: Write SQL to achieve categories, sub-categories and link. And fill them into the table.
//TODO: Extra. Use cache to avoid communication with database continuously.


//Just hard code right now.
echo '
<table class="table table-hover">
    <thead>
        <tr>
          <th scope="col">Category</th>
          <th scope="col">News</th>
        </tr>
    </thead>
    <tbody>
        <tr class="table-active">
            <td>Health</td>
            <td><a href="#">link1</a>
                <a href="#">link2</a>
                <a href="#">link3</a>
            </td>
        </tr>
        <tr class="table-active">
            <td>Technology</td>
            <td><a href="#">link4</a>
                <a href="#">link5</a>
                <a href="#">link6</a>
            </td>
        </tr>
        <tr class="table-active">
            <td>Entertainment</td>
            <td><a href="#">link7</a>
                <a href="#">link8</a>
                <a href="#">link9</a>
            </td>
        </tr>
    </tbody>
</table>
';

get_footer();
?>
