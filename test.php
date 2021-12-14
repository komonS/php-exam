<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
</head>
<body>

    <a id="user" href="get.php?name=test">Click me ! </a>

    <script>
        $(document).ready(function () {
            $('#user').click(function (e) { 
                e.preventDefault();
                $.ajax({
                url: $(this).attr('href') ,
                dataType: "html",
                success: function (response) {
                    
                }
            });
            });
            
        });
    
    
    </script>
</body>
</html>