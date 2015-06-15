<pre>
<?php
    require "model.php";

    print_r(api_request("/user/1?", "GET", new ArrayObject()));
?>
</pre>
