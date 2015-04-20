<!-- content start -->
<div class="admin-content am-margin-bottom">

    <div class="am-cf am-padding">
        <div class="am-fl am-cf">
            <a href="<?= $label->backUrl(); ?>" class="am-margin-right-xs am-text-danger"><i class="am-icon-reply"></i>返回</a>
            <strong class="am-text-primary am-text-lg"><?= $title; ?></strong>
        </div>
    </div>
    <hr>
    <div class="am-g">
        <div class="am-u-sm-12 am-u-sm-centered">
            <div class="doc-example am-margin-bottom">
                <form class="avatar-form" action="<?= $label->url('Team-User-setHead'); ?>" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="method" value="PUT" />
                    <div class="am-form-inline">
                        <div class="am-form-group">
                            <input type="file" name="file" id="inputImage">
                            <input type="hidden" name="height" />
                            <input type="hidden" name="width" />
                            <input type="hidden" name="x" />
                            <input type="hidden" name="y" />
                        </div>
                        <div class="am-form-group">
                            <a href="javascript:;" id="save-head" class="am-btn am-btn-success">保存头像</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="am-g">
                <div class="am-u-md-8 img-container">
                    <img src="<?= DOCUMENT_ROOT ?>/Theme/Team/WorkHard/assets/i/picture.png" alt="Picture">
                </div>
                <div class="am-u-md-4">
                    <div class="avatar-preview img-preview preview-lg">
                        <img src="<?= $_SESSION['team']['user_head']; ?>">
                    </div>
                    <div class="avatar-preview img-preview preview-md">
                        <img src="<?= $_SESSION['team']['user_head']; ?>">
                    </div>
                    <div class="avatar-preview img-preview preview-sm">
                        <img src="<?= $_SESSION['team']['user_head']; ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="<?= DOCUMENT_ROOT ?>/Theme/Team/WorkHard/assets/css/cropper.min.css" />
<link rel="stylesheet" type="text/css" href="<?= DOCUMENT_ROOT ?>/Theme/Team/WorkHard/assets/css/cropper.css" />
<script src="<?= DOCUMENT_ROOT ?>/Theme/Team/WorkHard/assets/js/cropper.min.js"></script>
<script>
    $(function() {
        function CropAvatar($element) {
            this.$container = $element;
            this.$avatarForm = this.$container.find('.avatar-form');
            this.$avatarUpload = this.$avatarForm.find('.avatar-upload');
        }
        var avatarForm = new CropAvatar($('.doc-example'));

        $('.img-container > img').cropper({
            aspectRatio: 1 / 1,
            strict: false,
            guides: false,
            highlight: false,
            setDragMode: 'crop',
            preview: ".img-preview",
            crop: function(data) {
                $("input[name=height]").val(Math.round(data.height));
                $("input[name=width]").val(Math.round(data.width));
                $("input[name=x]").val(Math.round(data.x));
                $("input[name=y]").val(Math.round(data.y));
            }
        });

        $("#save-head").on("click", function() {
            var data = $('.img-container > img').cropper("getData");
            $("input[name=height]").val(Math.round(data.height));
            $("input[name=width]").val(Math.round(data.width));
            $("input[name=x]").val(Math.round(data.x));
            $("input[name=y]").val(Math.round(data.y));
            $("form").submit()
        })

        var $inputImage = $('#inputImage'),
                URL = window.URL || window.webkitURL,
                blobURL;
        if (URL) {
            $('#inputImage').change(function() {
                var files = this.files,
                        file;

                if (files && files.length) {
                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        blobURL = URL.createObjectURL(file);
                        $('.img-container > img').one('built.cropper', function() {
                            URL.revokeObjectURL(blobURL); // Revoke when load complete
                        }).cropper('reset', true).cropper('replace', blobURL);
                    } else {
                        showMessage('Please choose an image file.');
                    }
                }
            });
        } else {
            $inputImage.parent().remove();
        }

    })
</script>
<style>
    .avatar-preview {
        float: left;
        margin-top: 15px;
        margin-right: 15px;
        border: 1px solid #eee;
        border-radius: 4px;
        background-color: #fff;
        overflow: hidden;
    }

    .avatar-preview:hover {
        border-color: #ccf;
        box-shadow: 0 0 5px rgba(0,0,0,.15);
    }

    .avatar-preview img {
        width: 100%;
    }

    .preview-lg {
        height: 300px;
        width: 300px;
        margin-top: 15px;
    }

    .preview-md {
        height: 200px;
        width: 200px;
    }

    .preview-sm {
        height: 100px;
        width: 100px;
    }
</style>