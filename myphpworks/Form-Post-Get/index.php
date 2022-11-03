<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="send.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
    </br>
        <label for="about">About:</label>
        <textarea name="about" id="about" cols="30" rows="10"></textarea>
        <hr>
        Profession:
        <select name="profession" id="profession">
            <option value="">--choose profession--</option>
            <option value="web">Backend developer</option>
            <option value="">Frontend developer</option>
            <option value="">Designer</option>
        </select>
        Gender:</br>
        <label>
        <input type="radio" name="gender" value="man">
        Man
        </label>
        <label>
            <input type="radio" name="gender" value="women">
            Women
            </label>    
        
            
             <label for="">
                <input type="checkbox" name="interesets[]" value="php">PHP
             </label>
             <label for="">
                <input type="checkbox" name="interesets[]" value="php">PHP
             </label>
             <label for="">
                <input type="checkbox" name="interesets[]" value="php">PHP
             </label>
             <label for="">
                <input type="checkbox" name="interesets[]" value="php">PHP
             </label>
             <input type="file">

             <select name="profession2[]" id="profession2" multiple size="2">
                    <option value="">--choose profession--</option>
                    <option value="web">Backend developer</option>
                    <option value="">Frontend developer</option>
                    <option value="">Designer</option>
            </select>
            <button type="submit">Submit</button>
    </form>
</body>
</html>