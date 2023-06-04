<?php session_start();?>
<?php
        if (isset($_POST['Apply'])){
          if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['image']['tmp_name'];

            $filename = $_POST['effect'];
            if(isset($_SESSION['img'])){
              $filepath=$_SESSION['img'];
            }else{
              $filepath =   'images/'.$filename . '.' . 'jpg';
            }
            move_uploaded_file($image, $filepath);
            $command = escapeshellcmd('python bw.py');
            $ans = exec($command);
            $_SESSION['img']=$filepath;
          } else {
            echo '<div class="alert alert-danger">Please choose an image file.</div>';
          }
        }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Image Effects</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    #imageDisplay {
      padding: 10px;
    }
    #imageDisplay img {
      max-width: 100%;
      max-height: 400px;
      border: 1px solid #ccc;
      padding: 5px;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="index.php">Image Effects</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#blur">Blur</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#sharpen">Sharpen</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#bw">Black and White</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
    <header class="bg-dark text-white py-4">
    <div class="container">
      <center><h1 class="h3 mb-0">Image Effects in Python using PHP</h1></center>
    </div>
  </header>
  <div class="container py-5">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Upload an Image</h5>
            <form id="uploadForm" action="" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="upload">Choose an image:</label>
                <input type="file" class="form-control-file" id="upload" name="image" accept="image/*">
              </div>
              <div class="form-group">
                <label for="effect">Specify a effect name:</label>
                <select name="effect" class="form-control">
                  <option>Blur</option>
                  <option value="bw">Black & White</option>
                  <option>Sharpen</option>
                </select>
              </div>
              <input class="btn btn-primary" type="submit" name="Apply" id="Apply" value="Apply">
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Image Preview</h5>
            <div id="imageDisplay">
              <?php
                if(isset($_SESSION['img'])){?>
                  <img src="<?php echo $_SESSION['img'];?>">
                <?php } ?>
            </div>
            <?php
                if(isset($_SESSION['img'])){?>
                  <div id="downloadButton">
                    <center><a class="btn btn-primary" href="<?php echo $_SESSION['img'];?>" download>Download</a></center>
                  </div>
                <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-5">
      <h2>About Image Effects</h2>
      <p>
        Image effects can transform and enhance images to create visually appealing and artistic results. By applying various filters, adjustments, and transformations, images can be altered in unique ways.
      </p>
      <h3>Common Image Effects:</h3>
      <div id="blur">
      <h3>Blur Effect :</h3>
      <p>
        Applying a blur effect to an image in Python involves manipulating the pixel values of the image to create a smoother, less detailed appearance. This effect is commonly used in photography and graphics to create a sense of depth, soften edges, or add a dreamy atmosphere to an image.
        The process starts by loading the image using a suitable image processing library like PIL, OpenCV, or scikit-image. Once the image is loaded, it needs to be converted to a suitable format for processing
      </p>
      <img src="images/blur-demo.png" alt="blur-img">
      </div>
      <div id="sharpen">
      <h3>Sharepen Image :</h3>
      <p>
        To sharpen an image in Python, you can follow these steps. First, load the image using a suitable library such as PIL, OpenCV, or scikit-image. Convert the image to a format suitable for processing. Next, create a sharpening kernel, which is a matrix defining weights to enhance edges and details. Commonly used sharpening kernels include the Laplacian kernel and the unsharp mask kernel. Then, apply the sharpening effect by convolving the image with the sharpening kernel. This process involves a mathematical operation that boosts the high-frequency components responsible for capturing edges and details, resulting in a sharper appearance. Finally, you can adjust the parameters of the sharpening operation to fine-tune the degree of enhancement. Experimentation with different kernels and parameter values can help achieve the desired sharpening effect.
      </p>
      <img src="images/sharpen-demo.png" alt="sharpen-img">
      </div>
      <div id="bw">
        <h3>Black and White Image :</h3>
        <p>
          Black and white image effect, also known as grayscale or monochrome, is a commonly used technique in image processing to convert a colored image into a grayscale representation. By removing the color information, the focus shifts towards the luminance or brightness values of the image, revealing its underlying structure and enhancing the perception of shapes, textures, and contrast. In Python, applying the black and white effect to an image is straightforward. You can utilize libraries such as PIL, OpenCV, or scikit-image to load the image, convert it to grayscale, and save the resulting image. This effect can be useful in various applications, including artistic renderings, simplifying image analysis, or creating a vintage aesthetic. The simplicity and versatility of the black and white image effect make it a popular choice in the field of image processing and computer vision.
        </p>
      </div>
      <p>
        These effects can be applied using various image processing libraries in Python, such as PIL (Python Imaging Library), OpenCV, or scikit-image. The selected image can be processed with the chosen effect using Python code and displayed on the website.
      </p>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    const uploadInput = document.getElementById('upload');
    const imageDisplay = document.getElementById('imageDisplay');
    const downloadButton = document.getElementById('downloadButton');
    uploadInput.addEventListener('change', (event) => {
      const file = event.target.files[0];
      const reader = new FileReader();
      reader.onload = (e) => {
        const img = document.createElement('img');
        img.src = e.target.result;
        img.classList.add('img-fluid');
        imageDisplay.innerHTML = '';
        imageDisplay.appendChild(img);
        downloadButton.innerHTML = '<a class="btn btn-primary" href="' + img.src + '" download>Download</a>';
      };
      reader.readAsDataURL(file);
    });
  </script>
</body>
</html>
<?php session_destroy();?>