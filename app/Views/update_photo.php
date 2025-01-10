<?= $this->extend('layout/main') ?>
<?= $this->section('title'); ?>
Student Management
<?= $this->endSection('title'); ?>

<?= $this->section('content'); ?>
<h3>Update Photo</h3>

<section class="content">
    <div class="card">
        <div class="card-body">
            <form action="<?= site_url('UpdatePhoto/update') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>

               
                <input type="hidden" name="student_name" value="<?= session()->get('name'); ?>">
                <input type="hidden" name="username" value="<?= session()->get('username'); ?>">

                
                <div class="form-group">
                    <label for="photo">Capture Photo</label>
                    <div>
                        <video id="video" width="320" height="240" autoplay></video>
                        <canvas id="canvas" style="display:none;"></canvas>
                        <button type="button" id="capture" class="btn btn-primary mt-2">Capture</button>
                        <input type="hidden" name="photo" id="photoInput">
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Update Photo</button>
            </form>
        </div>
    </div>
</section>

<script>
   
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const photoInput = document.getElementById('photoInput');
    const captureButton = document.getElementById('capture');

  
    navigator.mediaDevices.getUserMedia({ video: true })
        .then((stream) => {
            video.srcObject = stream;
        })
        .catch((err) => {
            console.error("Error accessing the camera: ", err);
        });

   
    captureButton.addEventListener('click', () => {
        const context = canvas.getContext('2d');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        
       
        const imageData = canvas.toDataURL('image/png');
        photoInput.value = imageData;
        alert('Photo captured successfully!');
    });
</script>

<?= $this->endSection('content'); ?>
