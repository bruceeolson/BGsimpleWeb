<?php 

if ( BG::app()->config->codeStage != 'development' ) header('Location: '.BG::app()->baseUrl.'/404');

BG::app()->get_header(); 
?>

<div id="contentContainer" class="clearfix">

    <div id="content" class="contentBox narrowcolumn clearfix">
    	<pre><?php print_r(BG::app());?></pre>
    </div>
    
    <br/>
        
</div> <!-- contentContainer -->

<?php BG::app()->get_footer(); ?>