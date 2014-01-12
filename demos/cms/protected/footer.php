
<div id="footer" class="clearfix">
        <div>
           <h1> Contact Us </h1>
            <div class="clearfix">
                <ul class="left">
                    <li><b>College Media Solutions</b></li>
                    <li>618 North Main St</li>
                    <li>Blacksburg, VA 24060</li>
                    <li>&nbsp;</li>
                   <li><b>Phone:</b>(540) 961-9860 </li>
                   <li><b>Fax:</b> (540) 953- 5057 </li>
                   <li><b>Email:</b> advertising@collegemedia.com</li>
                </ul>
                <ul class="right">
                     <li><b>Hours:</b></li>
                    <li>9:00 a.m. - 5:00 p.m.</li>
                    <li>Monday through Friday</li>
                    <li>when school is in session</li>
                </ul>
            </div>   
        </div>
        <div>
            <h1>Our Brands</h1>
            <div class="logos clearfix">
                <a class="emedia" href=""></a>
                <a class="ct" href=""></a>
                <a class="wuvt" href=""></a>
                <a class="vttv" href=""></a>
                <a class="spps" href=""></a>
                <a class="sil" href=""></a>
                <a class="bugle" href=""></a>
            </div>
        </div>
</div>  <!-- footer -->

</div>  <!-- pageContainer -->


<?php if ( BG::app()->config->GoogleAnalytics->activate ) :  // add Google Analytics ?>
<script>

// Google Analytics

// REMEMBER to add your Google Analytics account number to the _setAccount push
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'XX-XXXXXXXX-X']);
_gaq.push(['_trackPageview']);
(function() {
    var ga = document.createElement('script');     ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:'   == document.location.protocol ? 'https://ssl'   : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>
<?php endif;?>
</body>
</html>