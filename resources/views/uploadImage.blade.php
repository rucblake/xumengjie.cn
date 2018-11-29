<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>徐梦洁中文网 - xumengjie.cn - 徐梦洁</title>
    <script src="/lib/jquery.min.js"></script>
</head>
<body>
<form class="imgForm">
    <input id="uploaderInput" type="file" accept="image/*" name='file'>
</form>
<script>
    $('#uploaderInput').change(function(){
        if($("#uploaderInput").val() == '')
            return ;
        var formData = new FormData($(".imgForm")[0]);
        $.ajax({
            url: "/uploadImage.php",
            type: 'POST',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success : function(result) {
                alert('success');
            },
            error : function(result) {
                alert('error');
            }
        })
    })
</script>
</body>