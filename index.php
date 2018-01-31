<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <link rel="stylesheet" type="text/css" href="default.css"/>

</head>

<body>

<div id="page">

    <div class="block_main rounded">

        <div id="comment">

        </div>

        <h2>Comments</h2>

        <form method="post" action="comments.php">
            <input type="text" id="name" name="name" placeholder="Name" required title="Enter your name pls"/>
            <input type="text" id="message" name="message" class="message" placeholder="Your message" required
                   title="Type your message here"/>
            <input type="submit" id="submit" value="Submit"/>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">

    $(function () {
        refresh_comments();
        setInterval("refresh_comments()", 10000);

        $("#submit").click(function () {
            var name = $("#name").val();
            var message = $("#message").val();
            var data = 'name=' + name + '&message=' + message;

            $.ajax({
                type: "POST",
                url: "comments.php",
                data: data,
                success: function (html) {
                    $("#comment").fadeIn(500, function () {
                        $(this).html(html).fadeIn(500);
                        $("#message").val("");
                    });
                }
            });
            return false;
        });
    });

    function refresh_comments() {
        var data = 'refresh=1';

        $.ajax({
            type: "POST",
            url: "comments.php",
            data: data,
            success: function (html) {
                $("#comment").html(html);
            }
        });
    }
</script>
</body>
</html>