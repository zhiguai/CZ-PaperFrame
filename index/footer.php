		
        <!-- 页脚 -->
        <footer id="fh5co-footer">
            <div class="container">
                <div class="row row-bottom-padded-md">
                    <?echo $system_data['friends'];?>
                </div>
                
            </div>
            <div class="fh5co-copyright animate-box fadeInUp animated">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="fh5co-left"><small><?echo $system_data['copyright'];?></small></p>
                            <p class="fh5co-right"><small class="fh5co-right">Strongly driven by PaperPay , Theme Made by <a href="//chizg.cn">Chizg.cn</a></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- END #fh5co-footer -->
    </div>
    <!-- END #fh5co-page -->

    <!-- jQuery -->
    <script src="../assets/index/js/jquery.min.js"></script>
    <!-- jQuery Easing -->
    <script src="../assets/index/js/jquery.easing.1.3.js"></script>
    <!-- Bootstrap -->
    <script src="../assets/index/js/bootstrap.min.js"></script>
    <!-- Waypoints -->
    <script src="../assets/index/js/jquery.waypoints.min.js"></script>
    <!-- Flexslider -->
    <script src="../assets/index/js/jquery.flexslider-min.js"></script>
    <!-- Magnific Popup -->
    <script src="../assets/index/js/jquery.magnific-popup.min.js"></script>
    <script src="../assets/index/js/magnific-popup-options.js"></script>

    <!-- Main JS (Do not remove) -->
    <script src="../assets/index/js/main.js"></script>
    <script src="../assets/index/js/jquery.cookie.js"></script>
    <!--MD解析-->
    <script src="../assets/editor/lib/marked.min.js"></script>
    <script src="../assets/editor/lib/prettify.min.js"></script>
    
    <script src="../assets/editor/lib/raphael.min.js"></script>
    <script src="../assets/editor/lib/underscore.min.js"></script>
    <script src="../assets/editor/lib/sequence-diagram.min.js"></script>
    <script src="../assets/editor/lib/flowchart.min.js"></script>
    <script src="../assets/editor/lib/jquery.flowchart.min.js"></script>
    
    <script src="../assets/editor/editormd.js"></script>
    <script type="text/javascript">
    	$(function() {
    		var testEditormdView;
    		editormdView = editormd.markdownToHTML("editormd-view", {
    			htmlDecode      : "style,script,iframe",  // you can filter tags decode
    			emoji           : true,
    			taskList        : true,
    			tex             : true,  // 默认不解析
    			flowChart       : true,  // 默认不解析
    			sequenceDiagram : true,  // 默认不解析
    		});
    	});
    </script>
</body>
<div title="Google Translator Anywhere" class="itanywhere-activator" style="left: 666px; top: 7097px; display: none;"></div>
</html>