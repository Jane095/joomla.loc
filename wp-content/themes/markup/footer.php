        <!--Footer-->
        <footer class="footer" id="footer">
            <a id="footer-scroll"></a>
            <div class="container">
                <div class="footlog">
                    <div class="name">GALYNA MASTER</div>
                    <span>Опыт &bull; Качество &bull; Доверие</span>
                </div>
            </div>
        </footer>
        <!--END OF FOOTER-->
        <script type="text/javascript">
            jQuery (document).ready (function (){
                jQuery ('.mobilemenu_toggle').click (function (eventObject) {
                    eventObject.preventDefault ();
                }).toggle (function (){
                    jQuery (this).parents ('.menuwrapp_mobile').find ('.menu_mobile').slideDown (200);
                }, function (){
                    jQuery (this).parents ('.menuwrapp_mobile').find ('.menu_mobile').slideUp (200);
                });
            });
        </script>
        <?php wp_footer(); ?>
    </body>
</html>