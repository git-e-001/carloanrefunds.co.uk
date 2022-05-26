<script>
    let randomId = Math.random()
    $("#addNewContentField").on('click', function (event) {
        event.preventDefault()

        randomId = Math.random()

        $("#appendNewContent").append(`
                <div class="col-md-12 mt-5 newContentRemove" id="${randomId}">
                   <div class="text-right">
                        <a href="javascript:void(0)" class="btn btn-danger" onclick="removeNewContentSection(this)">Remove</a>
                    </div>
                    <label>Simple Text</label>
                    <textarea name="body[]" required class="TextEditor"></textarea>
                    <br>
                   <label>Background Color</label>
                   <input type="text" class="colorPicker form-control col-3" name="bg_color[]" required>
                </div>
            `)
        initTinyMce()
        scrollToSpecificDiv()
        colorPicker()
    })

    function scrollToSpecificDiv() {
        var elmnt = document.getElementById(`${randomId}`);
        elmnt.scrollIntoView();
    }

    // end form submit actions

    function removeNewContentSection(el) {
        $(el).parents('.newContentRemove').remove()
    }

</script>
