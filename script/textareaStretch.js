var $j = jQuery.noConflict();
$j.fn.jGrow = function(options) {
  var opts = $j.extend({}, $j.fn.jGrow.defaults, options);
  return this.each(function() {
    $j(this).css({ overflow: "hidden" }).bind("keypress", function() {
      $this = $j(this);
      var o = $j.meta ? $j.extend({}, opts, $this.data()) : opts;
      if(o.rows == 0 && (this.scrollHeight > this.clientHeight)) {
        this.rows += 1;
      } else if((this.rows <= o.rows) && (this.scrollHeight > this.clientHeight)) {
        this.rows += 1;
      } else if(o.rows != 0 && this.rows > o.rows) {
        $this.css({ overflow: "auto" });
      }
      $this.html();
    });
  });
}
$j.fn.jGrow.defaults = { rows: 0 };