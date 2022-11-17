<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .form-box{
           display: flex;
           justify-content: center;
           align-items: center;
           margin-top:2rem;
           flex-direction: column;
        }

        .form-item{
            margin-bottom:1rem;
        }
    </style>
</head>
<body>
    <!-- dosya eklemek icin enctype="multipart/form-data olmalidir" -->
   <section class="form-box">
    <h4>Email Form</h4>
    <form  action="form.php" method="post" enctype="multipart/form-data">

    <input class="form-item" type="text" name="email" required placeholder="email"/></br>
    <input class="form-item" type="text" name="subject" required placeholder="email-subject"/></br>
<textarea class="form-item" name="content" placeholder="content" cols="30" rows="10"></textarea></br>
<button class="form-item" type="submit">Submit</button>
    </form>
    </section>
</body>
</html>