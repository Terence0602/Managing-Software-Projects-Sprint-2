<!DOCTYPE html> 
<HTML lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="GotoGro MRM Project" />
        <link rel="stylesheet" href="./css/style.css">
        <title>Goto Grocery</title>
        
    </head>


    <style>
        body {
            /* FULL PAGE background color */
            background-color: white;
        }

        header {
            /* top display */
            background-color: rgb(84, 0, 0);
            color: rgb(225, 225, 225);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 0;
            border-radius: 20px;
        }

        header a {
            text-decoration: none;
            /* removes thunderline h1 */
        }

        hr {
            border-color: rgb(84, 0, 0);
            margin: 0px;
        }

        h1{
            color: rgb(225, 225, 225); 
            text-align: center;
        }

        p {
            background-color: rgb(84, 0, 0); 
            color: rgb(225, 225, 225); 
            text-align: center; 
            font-size: 20px; 
            padding: 25px; 
            border-radius: 20px;
            box-shadow: 0px 0px 100px rgba(0, 0, 0, 0.3);
            position: fixed; 
            bottom: 0; 
            left: 50%; 
            transform: translateX(-50%); 
        }


        nav {
            text-align: center;
            margin-top: 10px;
        }

        nav a {
            text-decoration: none;
            color: rgb(225, 225, 225); 
            margin: 0 20px;
            font-size: 18px;
            background-color: rgb(84, 0, 0);
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: rgb(120, 0, 0);
            /* changes color when you hover over member records/salesrecords/product records*/

        }

        .image-container {   
            display: flex;
            justify-content: center;
            margin-top: 180px; 
            /* brings images in the middle to centre by 180px*/
        }

        .image-container img {
            margin: 0 50px; 
            width: 200px; 
            height: 200px;
            transition: opacity 0.6s ease-in-out;
            /* size of images, and the speed it fades when you over */
        }

        .image-container img:hover {
            opacity: 0.7; 
            /* amount of fading when you hover over images*/
        }
    </style>

    <body>
        <header>
            <a href="Home.php"><h1>Goto Grocery</h1></a>
            <hr />
            <nav>
                <a href="member.php">Member Records</a>
                <a href="product.php">Product Records</a>
                <a href="sales.php">Sales Records</a>
            </nav>
            <hr />
        </header>

        <article>
            <p>
                Only fresh produce here, for our highly valued members.
            </p>
        </article>

    <div class="image-container">
        <img src="./Images/avocado.jpeg" alt="Image 1">
        <img src="./Images/tomato.jpeg" alt="Image 2">
        <img src="./Images/lettuce.jpeg" alt="Image 3">
    </div>

    </body>
</HTML>