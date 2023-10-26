<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Home page</th>
                <th scope="col">Text</th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
            <tr>
                <td>{{$comment->id}}</td>
                <td>{{$comment->user->name}}</td>
                <td>{{$comment->user->email}}</td>
                <td>{{$comment->user->home_page}}</td>
                <td>{{$comment->text}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>

    </div>
    <div class="container">
        <form method="POST" action="{{route('comments.store')}}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="home_page" class="form-label">Home page:</label>
                <input type="url" name="home_page" id="home_page" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="text" class="form-label">Text:</label>
                <textarea name="text" id="text" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Load file:</label>
                <input type="file" name="file" id="file" class="form-control" multiple accept="image/*">
            </div>

            <div class="mb-3">
                <label for="captcha" class="form-label">Enter captcha:</label>
                <input type="text" name="captcha" id="captcha" class="form-control" required>
                <img src="" id="captchaImage">
                <input type="hidden" id="captcha-key" name="key">
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
    <script>
        function getCaptcha() {
            const captchaImage = document.getElementById('captchaImage');
            const captchaKey = document.getElementById('captcha-key');

            // Make an API request to fetch the actual captcha code
            fetch('http://localhost:8876/captcha/api/flat')
                .then(response => response.json())
                .then(data => {
                    captchaKey.value = data.key;
                    captchaImage.src = data.img;
                })
                .catch(error => {
                    console.error('Error fetching captcha:', error);
                });
        }
        getCaptcha();
    </script>
</body>
</html>
