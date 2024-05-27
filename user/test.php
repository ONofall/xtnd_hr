<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Search</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container" style="max-width: 50%">
    <div class="text-center mt-5 mb-4">
        <h2>PHP Live Search</h2>
    </div>
    <input type="text" class="form-control" id="live_search" autocomplete="off" placeholder="Search ...">
    <div id="searchresult" class="mt-3"></div> <!-- This div will display the search results -->
</div>
<script type="text/javascript">
    $(document).ready(function (){
        $("#live_search").keyup(function (){
            let input = $(this).val();
            if (input != ""){
                $.ajax({
                    url:"testt.php",
                    method:"POST",
                    data:{input},
                    success:function (data){
                        $("#searchresult").html(data);
                        $("#searchresult").css("display","block");
                    }
                });
            } else {
                $("#searchresult").css("display","none");
            }
        });
    });
</script>
</body>
</html>
