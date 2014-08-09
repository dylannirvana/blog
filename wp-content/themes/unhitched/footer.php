<footer class="content row">
                    <div class="clearfix">                        
                        <div class="col-md-12">
                          <nav class="navbar navbar-default navbar-right" role="navigation">
                              <div class="navbar-header">
                                  <button type="button" class="navbar-toggle"
                                  data-toggle="collapse" data-target="#collapse">
                                      <span class="icon-bar"></span>
                                      <span class="icon-bar"></span>
                                      <span class="icon-bar"></span>
                                  </button> <!-- navbar-toggle -->
                              </div> <!-- navbar-header -->
                              <div class="collapse navbar-collapse" id="collapse">
                                  <ul class="nav navbar-nav">
                                      
                                        <?php wp_list_pages(array('title_li' => '')); ?>

                                  </ul> <!-- navbar-nav -->
                              </div> <!-- collapse -->
                          </nav> <!-- navbar navbar-default --> 
                        </div> <!-- col-md-8 -->
                    </div>
</footer> <!-- content row -->
                
                
</section> <!-- container -->
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>    
    <script src="_/js/bootstrap.js"></script>
    <script src="_/js/myscript.js"></script>    
    <?php wp_footer(); ?>
  </body>
</html>