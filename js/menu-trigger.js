(function($) {
  $(document).ready(function(){
      $("#nav-mobile").html($("#nav-main").html());
      $("#nav-trigger span").click(function(){
          if ($("#nav-mobile ul").hasClass("expanded")) {
              $("#nav-mobile ul.expanded").removeClass("expanded").slideUp(500);
              $(this).removeClass("open");
          } else {
              $("#nav-mobile ul").addClass("expanded").slideDown(500);
              $(this).addClass("open");
          }
      });
  });
})( jQuery );

