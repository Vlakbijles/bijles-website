<pre>
<?php
    require "api.php";

    print_r(api_request("/user/1/offer?", "GET", new ArrayObject()));

?>
</pre>
