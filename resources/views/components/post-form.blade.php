<main>
    <h2>create Post</h2>
    <div class="post">
        <form id="post-form">
            <table>
                <tr>
                    <td><label for="caption">Caption</label></td>
                    <td><input type="text" name="caption" id="" class="caption"></td>
                </tr>
                <tr>
                    <td><label for="file">Photo/Video</label></td>
                    <td><input type="file" name="content[]" class="content" id="" multiple></td>
                </tr>

            </table>
            <div colspan="" style="display:flex;  direction: rtl;">
                <button class="btn-post">Post</button>
            </div>
        </form>
    </div>

    <script>
        // ajax
        $('document').ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#post-form').on('submit', function(e) {
                e.preventDefault();
                // var caption = $('.caption').val();
                // var file = $('.file').val();
                let formData = new FormData(this);
                $.ajax({
                    url: "/posts",
                    type: 'POST',
                    data: formData,
                    contentType: false, 
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            $('#post-form')[0].reset(); 
                        }
                    },
                    error: function(xhr) {
                        alert('An error occurred. Please try again.');
                    }
                });
            })
        })
    </script>
</main>
